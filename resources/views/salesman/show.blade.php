<div class="container">
    <h2>Notification Details</h2>

    <div class="card p-3 mb-3">
        <h5>{{ $notification->title }}</h5>
        <p>{{ $notification->message }}</p>
        <p><small>{{ $notification->created_at->diffForHumans() }}</small></p>
    </div>

    @if($lead)
    <div class="card p-3">
        <h4>Lead Details</h4>
        <p><strong>Contact Person:</strong> {{ $lead->contact_person }}</p>
        <p><strong>Company Name:</strong> {{ $lead->company_name }}</p>
        <p><strong>Mobile No:</strong> {{ $lead->mobile_no }}</p>
        <p><strong>Email:</strong> {{ $lead->email_id }}</p>
    </div>
    @else
    <div class="alert alert-warning">Lead not found for this notification.</div>
    @endif
</div>