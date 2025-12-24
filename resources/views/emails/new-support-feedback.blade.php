<!-- Email Template for New Support Feedback Notification -->
<x-mail::message>
# New Support Feedback Received

You have received new feedback from a customer.

<x-mail::panel>
**Customer Name:** {{ $feedback->name }}

**Phone Number:** {{ $feedback->phone }}

**Message:**

{{ $feedback->message }}

**Received:** {{ $feedback->created_at->format('M d, Y H:i A') }}
</x-mail::panel>

<x-mail::button :url="route('admin.support-feedback.index')">
View in Admin Dashboard
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
