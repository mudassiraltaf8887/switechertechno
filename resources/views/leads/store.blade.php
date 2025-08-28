<!DOCTYPE html>
<html>

<head>
    <title>All Leads</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-weight: 700;
            color: #343a40;
            margin-bottom: 20px;
        }

        table {
            border-radius: 10px;
            overflow: hidden;
        }

        thead {
            background-color: #0d6efd;
            color: white;
        }

        tbody tr:hover {
            background-color: #f1f5ff;
            transition: 0.2s;
        }

        .btn-primary {
            border-radius: 30px;
            font-weight: 500;
        }

        .alert {
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>📋 All Leads</h2>
            <a href="{{ route('leads.create') }}" class="btn btn-primary shadow-sm">+ Add New Lead</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Date</th>
                        <th>Contact Person</th>
                        <th>Company</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>City</th>
                        <th>Lead Source</th>
                        <th>Lead For</th>
                        <th>Priority</th>
                        <th>Assign To</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leads as $lead)
                        <tr>
                            <td>{{ $lead->id }}</td>
                            <td>{{ \Carbon\Carbon::parse($lead->lead_date)->format('d-m-Y') }}</td>
                            <td>{{ $lead->contact_person }}</td>
                            <td>{{ $lead->company_name }}</td>
                            <td>{{ $lead->mobile_no }}</td>
                            <td>{{ $lead->email_id }}</td>
                            <td>{{ $lead->city }}</td>
                            <td>{{ $lead->lead_source }}</td>
                            <td>{{ $lead->lead_for }}</td>
                            <td>{{ $lead->lead_priority }}</td>
                           <td>{{ $lead->assignedUser->name ?? 'Not Assigned' }}</td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center text-muted">No leads found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>