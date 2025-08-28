<!DOCTYPE html>
<html>

<head>
    <title>Add Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 40px;
        }

        .form-section {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Add Contact</h3>

        <form action="{{ route('leads.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <!-- Lead Source -->
                <div class="col-md-4">
                    <label for="lead_source" class="form-label">Lead Source</label>
                    <select name="lead_source" id="lead_source" class="form-select" required>
                        <option value="" selected disabled>-- Select Source --</option>
                        <option value="Facebook">Facebook</option>
                        <option value="Google Ads">Google Ads</option>
                        <option value="Olx">Olx</option>
                        <option value="Reference">Reference</option>
                        <option value="Youtube">Youtube</option>
                    </select>
                </div>

                <!-- Lead For -->
                <div class="col-md-4">
                    <label for="lead_for" class="form-label">Lead For</label>
                    <select name="lead_for" id="lead_for" class="form-select" required>
                        <option value="" selected disabled>-- Select Purpose --</option>
                        <option value="ERP Software">ERP Software</option>
                        <option value="FBR Digital Invoicing">FBR Digital Invoicing</option>
                        <option value="Accounting Software">Accounting Software</option>
                        <option value="POS Software">POS Software</option>
                        <option value="Restaurant POS Software">Restaurant POS Software</option>
                        <option value="Distribution Software">Distribution Software</option>
                        <option value="Wholesale Software">Wholesale Software</option>
                    </select>
                </div>

                <!-- Lead Priority -->
                <div class="col-md-4">
                    <label for="lead_priority" class="form-label">Lead Priority</label>
                    <select name="lead_priority" id="lead_priority" class="form-select" required>
                        <option value="" selected disabled>-- Select Priority --</option>
                        <option value="High">High</option>
                        <option value="Low">Low</option>
                    </select>
                </div>
            </div>

            <div class="row form-section">
                <div class="col-md-6">
                    <label class="form-label">Contact Person *</label>
                    <input type="text" name="contact_person" class="form-control" placeholder="John Doe" required>
                </div>

                <div class="col-md-4">
                    <label for="lead_date" class="form-label">Lead Date</label>
                    <input type="date" name="lead_date" id="lead_date" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Company Name</label>
                    <input type="text" name="company_name" class="form-control">
                </div>
            </div>

            <div class="row form-section">
                <div class="col-md-4">
                    <label class="form-label">Mobile No *</label>
                    <input type="tel" name="mobile_no" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label">WhatsApp No</label>
                    <input type="tel" name="whatsapp_no" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Email ID</label>
                    <input type="email" name="email_id" class="form-control" placeholder="Enter Email">
                </div>
            </div>

            <div class="form-section">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control">
            </div>

            <div class="row form-section">
                <div class="col-md-3">
                    <label class="form-label">Country</label>
                    <input type="text" name="country" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label">State</label>
                    <input type="text" name="state" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label">City</label>
                    <input type="text" name="city" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Pincode</label>
                    <input type="text" name="pincode" class="form-control">
                </div>
            </div>

            <div class="col-md-4 mt-3">
                <label for="assigned_to" class="form-label">Assign To</label>
                <select name="assigned_to" class="form-select">
                    <option value="" selected disabled>-- Select Person --</option>
                    @foreach($managers as $manager)
                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                    @endforeach
                
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
</body>

</html>