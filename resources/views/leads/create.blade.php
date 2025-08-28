<!DOCTYPE html>
<html>
<head>
    <title>Create Lead</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Create Lead</h2>

    <form action="{{ route('leads.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Lead Source</label>
            <input type="text" name="lead_source" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Lead For</label>
            <input type="text" name="lead_for" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Priority</label>
            <input type="text" name="priority" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Contact Person</label>
            <input type="text" name="contact_person" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="lead_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Assign To</label>
            <select name="assigned_to" class="form-control" required>
                <option value="Haris Shahid">Haris Shahid</option>
                <option value="Zaid Shahid">Zaid Shahid</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Mobile No</label>
            <input type="text" name="mobile_no" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Save Lead</button>
    </form>
</div>
</body>
</html>
