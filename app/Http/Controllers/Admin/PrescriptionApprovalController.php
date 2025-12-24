<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PrescriptionApprovalController extends Controller
{
    /**
     * Display all orders requiring prescription approval
     */
    public function index()
    {
        // Get orders that have prescription-required items
        $pendingOrders = Order::where('prescription_required', true)
            ->where('prescription_status', 'pending')
            ->with(['user', 'items.product'])
            ->orderBy('created_at', 'desc')
            ->get();

        $approvedOrders = Order::where('prescription_required', true)
            ->where('prescription_status', 'approved')
            ->with(['user', 'items.product'])
            ->orderBy('prescription_reviewed_at', 'desc')
            ->limit(20)
            ->get();

        $rejectedOrders = Order::where('prescription_required', true)
            ->where('prescription_status', 'rejected')
            ->with(['user', 'items.product'])
            ->orderBy('prescription_reviewed_at', 'desc')
            ->limit(20)
            ->get();

        $pendingCount = $pendingOrders->count();

        return view('admin.prescriptions.index', compact(
            'pendingOrders',
            'approvedOrders',
            'rejectedOrders',
            'pendingCount'
        ));
    }

    /**
     * Show detailed view of a single order
     */
    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);

        // Get prescription files from order items
        $prescriptionFiles = $order->items()
            ->whereNotNull('prescription_file_path')
            ->get()
            ->pluck('prescription_file_path')
            ->unique()
            ->values();

        return view('admin.prescriptions.show', compact('order', 'prescriptionFiles'));
    }

    /**
     * Approve a prescription order
     */
    public function approve(Request $request, Order $order)
    {
        $request->validate([
            'notes' => 'nullable|string|max:500'
        ]);

        if (!$order->prescription_required) {
            return back()->with('error', 'This order does not require prescription approval.');
        }

        if ($order->prescription_status !== 'pending') {
            return back()->with('error', 'This order has already been reviewed.');
        }

        $order->update([
            'prescription_status' => 'approved',
            'prescription_reviewed_at' => now(),
            'prescription_reviewed_by' => Auth::id(),
            'prescription_rejection_reason' => $request->notes
        ]);

        return redirect()
            ->route('admin.prescriptions.index')
            ->with('success', "Order #{$order->id} prescription has been approved successfully.");
    }

    /**
     * Reject/Cancel a prescription order
     */
    public function reject(Request $request, Order $order)
    {
        $request->validate([
            'reason' => 'required|string|max:500'
        ]);

        if (!$order->prescription_required) {
            return back()->with('error', 'This order does not require prescription approval.');
        }

        if ($order->prescription_status !== 'pending') {
            return back()->with('error', 'This order has already been reviewed.');
        }

        $order->update([
            'prescription_status' => 'rejected',
            'order_status' => 'cancelled',
            'prescription_rejection_reason' => $request->reason,
            'prescription_reviewed_at' => now(),
            'prescription_reviewed_by' => Auth::id()
        ]);

        return redirect()
            ->route('admin.prescriptions.index')
            ->with('success', "Order #{$order->id} prescription has been rejected and order cancelled.");
    }

    /**
     * Get prescription image for preview
     */
    public function viewPrescription(OrderItem $orderItem)
    {
        if (!$orderItem->prescription_file_path) {
            abort(404, 'Prescription file not found');
        }

        $path = storage_path('app/private/' . $orderItem->prescription_file_path);

        if (!file_exists($path)) {
            abort(404, 'Prescription file not found');
        }

        return response()->file($path);
    }
}
