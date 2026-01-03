<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\PrescriptionFile;
use App\Models\PrescriptionTag;
use App\Models\PrescriptionReminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PrescriptionController extends Controller
{
    /**
     * Show the prescription builder page.
     */
    public function index()
    {
        $prescriptions = auth()->user()->prescriptions()
            ->with('files', 'tags', 'reminders')
            ->active()
            ->latest('prescription_date')
            ->paginate(10);

        $tags = auth()->user()->prescriptionTags()->get();
        $upcomingReminders = auth()->user()->prescriptions()
            ->whereHas('reminders', function ($query) {
                $query->where('reminder_date', '>=', now())
                    ->where('is_sent', false);
            })
            ->count();

        return view('prescriptions.index', [
            'prescriptions' => $prescriptions,
            'tags' => $tags,
            'upcomingReminders' => $upcomingReminders,
        ]);
    }

    /**
     * Store a new prescription.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'notes' => 'nullable|string|max:1000',
            'doctor_name' => 'nullable|string|max:255',
            'prescription_date' => 'required|date',
            'next_visit_date' => 'nullable|date|after_or_equal:prescription_date',
            'tags' => 'nullable|array',
            'files' => 'nullable|array',
            'files.*' => 'file|mimes:jpg,jpeg,png,pdf|max:10240',
            'reminder_date' => 'nullable|date_format:Y-m-d H:i',
            'reminder_note' => 'nullable|string|max:500',
        ]);

        $prescription = auth()->user()->prescriptions()->create([
            'title' => $validated['title'],
            'notes' => $validated['notes'] ?? null,
            'doctor_name' => $validated['doctor_name'] ?? null,
            'prescription_date' => $validated['prescription_date'],
            'next_visit_date' => $validated['next_visit_date'] ?? null,
        ]);

        // Attach tags
        if (!empty($validated['tags'])) {
            $tags = [];
            foreach ($validated['tags'] as $tagId) {
                $tag = PrescriptionTag::where('id', $tagId)
                    ->where('user_id', auth()->id())
                    ->first();
                if ($tag) {
                    $tags[] = $tagId;
                }
            }
            if (!empty($tags)) {
                $prescription->tags()->attach($tags);
            }
        }

        // Upload files
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('prescriptions/' . auth()->id(), 'public');
                PrescriptionFile::create([
                    'prescription_id' => $prescription->id,
                    'file_path' => $path,
                    'file_type' => $file->getClientOriginalExtension(),
                    'original_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                ]);
            }
        }

        // Create reminder if provided
        if (!empty($validated['reminder_date'])) {
            PrescriptionReminder::create([
                'prescription_id' => $prescription->id,
                'reminder_note' => $validated['reminder_note'] ?? null,
                'reminder_date' => $validated['reminder_date'],
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Prescription saved successfully!',
            'prescription' => $prescription->load('files', 'tags'),
        ]);
    }

    /**
     * Update a prescription.
     */
    public function update(Request $request, Prescription $prescription)
    {
        $this->authorize('update', $prescription);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'notes' => 'nullable|string|max:1000',
            'doctor_name' => 'nullable|string|max:255',
            'prescription_date' => 'required|date',
            'next_visit_date' => 'nullable|date|after_or_equal:prescription_date',
            'tags' => 'nullable|array',
        ]);

        $prescription->update([
            'title' => $validated['title'],
            'notes' => $validated['notes'] ?? null,
            'doctor_name' => $validated['doctor_name'] ?? null,
            'prescription_date' => $validated['prescription_date'],
            'next_visit_date' => $validated['next_visit_date'] ?? null,
        ]);

        // Update tags
        if (isset($validated['tags'])) {
            $tags = array_filter($validated['tags'], function ($tagId) {
                return PrescriptionTag::where('id', $tagId)
                    ->where('user_id', auth()->id())
                    ->exists();
            });
            $prescription->tags()->sync($tags);
        }

        return response()->json([
            'success' => true,
            'message' => 'Prescription updated successfully!',
            'prescription' => $prescription->load('files', 'tags'),
        ]);
    }

    /**
     * Delete a prescription.
     */
    public function destroy(Prescription $prescription)
    {
        $this->authorize('delete', $prescription);

        // Delete files
        foreach ($prescription->files as $file) {
            Storage::disk('public')->delete($file->file_path);
        }

        $prescription->delete();

        return response()->json([
            'success' => true,
            'message' => 'Prescription deleted successfully!',
        ]);
    }

    /**
     * Archive a prescription.
     */
    public function archive(Prescription $prescription)
    {
        $this->authorize('update', $prescription);

        $prescription->update(['is_archived' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Prescription archived successfully!',
        ]);
    }

    /**
     * Restore an archived prescription.
     */
    public function restore(Prescription $prescription)
    {
        $this->authorize('update', $prescription);

        $prescription->update(['is_archived' => false]);

        return response()->json([
            'success' => true,
            'message' => 'Prescription restored successfully!',
        ]);
    }

    /**
     * Search prescriptions.
     */
    public function search(Request $request)
    {
        $query = auth()->user()->prescriptions()->active();

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('doctor_name', 'like', "%{$search}%")
                    ->orWhere('notes', 'like', "%{$search}%");
            });
        }

        if ($request->has('tags') && !empty($request->tags)) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->whereIn('prescription_tags.id', $request->tags);
            });
        }

        if ($request->has('sort')) {
            match ($request->sort) {
                'newest' => $query->latest('prescription_date'),
                'oldest' => $query->oldest('prescription_date'),
                'upcoming' => $query->upcomingVisits(),
                default => $query->latest('prescription_date'),
            };
        }

        $prescriptions = $query->with('files', 'tags', 'reminders')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'prescriptions' => $prescriptions,
        ]);
    }

    /**
     * Get timeline data for a tag.
     */
    public function timeline(PrescriptionTag $tag)
    {
        $this->authorize('view', $tag);

        $prescriptions = $tag->prescriptions()
            ->where('user_id', auth()->id())
            ->active()
            ->orderBy('prescription_date', 'desc')
            ->with('files', 'reminders')
            ->get();

        return response()->json([
            'success' => true,
            'tag' => $tag,
            'prescriptions' => $prescriptions,
        ]);
    }

    /**
     * Get a single prescription.
     */
    public function show(Prescription $prescription)
    {
        $this->authorize('view', $prescription);

        return response()->json([
            'success' => true,
            'prescription' => $prescription->load('files', 'tags', 'reminders'),
        ]);
    }

    /**
     * Upload file to existing prescription.
     */
    public function uploadFile(Request $request, Prescription $prescription)
    {
        $this->authorize('update', $prescription);

        $validated = $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        $file = $request->file('file');
        $path = $file->store('prescriptions/' . auth()->id(), 'public');

        $prescriptionFile = PrescriptionFile::create([
            'prescription_id' => $prescription->id,
            'file_path' => $path,
            'file_type' => $file->getClientOriginalExtension(),
            'original_name' => $file->getClientOriginalName(),
            'file_size' => $file->getSize(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'File uploaded successfully!',
            'file' => $prescriptionFile,
        ]);
    }
}
