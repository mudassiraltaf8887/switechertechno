<!DOCTYPE html>
<html>

<head>
    <title>Edit Lead - {{ $lead->contact_person }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-weight: 700;
            color: #343a40;
            margin-bottom: 30px;
        }

        .form-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-left: 4px solid #0d6efd;
        }

        .manager-section {
            background: #e8f5e8;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-left: 4px solid #198754;
        }

        .section-title {
            color: #0d6efd;
            font-weight: 600;
            margin-bottom: 20px;
            font-size: 1.1em;
        }

        .manager-title {
            color: #198754;
            font-weight: 600;
            margin-bottom: 20px;
            font-size: 1.1em;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            padding: 10px 15px;
            margin-bottom: 15px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .btn {
            border-radius: 25px;
            font-weight: 500;
            padding: 12px 30px;
        }

        .required {
            color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-edit"></i> Add Lead #{{ $lead->id }}</h2>
            <a href="{{ route('manager.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>

        <form action="{{ route('managerlead.store') }}" method="POST">
            @csrf

            <!-- Lead Information Section -->
            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-chart-line"></i> Lead Information
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Lead Source</label>
                        <select class="form-select" name="lead_source">
                            <option value="">Select Source</option>
                            <option value="Facebook" {{ $lead->lead_source == 'Facebook' ? 'selected' : '' }}>Facebook
                            </option>
                            <option value="Google Ads" {{ $lead->lead_source == 'Google Ads' ? 'selected' : '' }}>Google
                                Ads</option>
                            <option value="Olx" {{ $lead->lead_source == 'Olx' ? 'selected' : '' }}>Olx</option>
                            <option value="Reference" {{ $lead->lead_source == 'Reference' ? 'selected' : '' }}>Reference
                            </option>
                            <option value="Youtube" {{ $lead->lead_source == 'Youtube' ? 'selected' : '' }}>Youtube
                            </option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Lead For</label>
                        <select class="form-select" name="lead_for">
                            <option value="">Select Product</option>
                            <option value="ERP Software" {{ $lead->lead_for == 'ERP Software' ? 'selected' : '' }}>ERP
                                Software</option>
                            <option value="FBR Digital Invoicing" {{ $lead->lead_for == 'FBR Digital Invoicing' ? 'selected' : '' }}>FBR Digital Invoicing</option>
                            <option value="Accounting Software" {{ $lead->lead_for == 'Accounting Software' ? 'selected' : '' }}>Accounting Software</option>
                            <option value="POS Software" {{ $lead->lead_for == 'POS Software' ? 'selected' : '' }}>POS
                                Software</option>
                            <option value="Restaurant POS Software" {{ $lead->lead_for == 'Restaurant POS Software' ? 'selected' : '' }}>Restaurant POS Software</option>
                            <option value="Distribution Software" {{ $lead->lead_for == 'Distribution Software' ? 'selected' : '' }}>Distribution Software</option>
                            <option value="Wholesale Software" {{ $lead->lead_for == 'Wholesale Software' ? 'selected' : '' }}>Wholesale Software</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Lead Priority</label>
                        <select class="form-select" name="lead_priority">
                            <option value="Low" {{ $lead->lead_priority == 'Low' ? 'selected' : '' }}>Low</option>
                            <option value="Medium" {{ $lead->lead_priority == 'Medium' ? 'selected' : '' }}>Medium
                            </option>
                            <option value="High" {{ $lead->lead_priority == 'High' ? 'selected' : '' }}>High</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Lead Date</label>
                        <input type="date" class="form-control" name="lead_date" value="{{ $lead->lead_date }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Assign To</label>
                        <select class="form-select" name="assigned_to">
                            <option value="">Select Salesman</option>
                            @foreach($salesmen as $salesman)
                                <option value="{{ $salesman->id }}" {{ $lead->assigned_to == $salesman->id ? 'selected' : '' }}>
                                    {{ $salesman->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>

            <!-- Personal Information Section -->
            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-user"></i> Personal Information
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Contact Person <span class="required">*</span></label>
                        <input type="text" class="form-control" name="contact_person"
                            value="{{ $lead->contact_person }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Company Name</label>
                        <input type="text" class="form-control" name="company_name" value="{{ $lead->company_name }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label">Mobile Number <span class="required">*</span></label>
                        <input type="text" class="form-control" name="mobile_no" value="{{ $lead->mobile_no }}"
                            required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">WhatsApp Number</label>
                        <input type="text" class="form-control" name="whatsapp_no" value="{{ $lead->whatsapp_no }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Email ID</label>
                        <input type="email" class="form-control" name="email_id" value="{{ $lead->email_id }}">
                    </div>
                </div>
            </div>

            <!-- Address Information Section -->
            <div class="form-section">
                <div class="section-title">
                    <i class="fas fa-map-marker-alt"></i> Address Information
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label">Address</label>
                        <textarea class="form-control" name="address" rows="3">{{ $lead->address }}</textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Country</label>
                        <input type="text" class="form-control" name="country" value="{{ $lead->country }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">State</label>
                        <input type="text" class="form-control" name="state" value="{{ $lead->state }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">City</label>
                        <input type="text" class="form-control" name="city" value="{{ $lead->city }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Pincode</label>
                        <input type="text" class="form-control" name="pincode" value="{{ $lead->pincode }}">
                    </div>
                </div>
            </div>

            <!-- Manager Input Section -->
            <div class="manager-section">
                <div class="manager-title">
                    <i class="fas fa-user-tie"></i> Manager Input
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Lead Priority <span class="required">*</span></label>
                        <select class="form-select" name="manager_lead_priority" required>
                            <option value="">Select Priority</option>
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                            <option value="Urgent">Urgent</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Physical Demo Date <span class="required">*</span></label>
                        <input type="datetime-local" class="form-control" name="physical_demo_date" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Assign to Salesman <span class="required">*</span></label>
                        <select class="form-select" name="assigned_to_salesman" required>
                            <option value="">Select Salesman</option>
                            @foreach($salesmen as $salesman)
                                <option value="{{ $salesman->id }}">{{ $salesman->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Remarks</label>
                        <textarea class="form-control" name="manager_remarks" rows="3"
                            placeholder="Manager's notes..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Hidden field for original lead ID -->
            <input type="hidden" name="original_lead_id" value="{{ $lead->id }}">

            <!-- Action Buttons -->
            <div class="text-center">
                <button type="submit" class="btn btn-success btn-lg me-3">
                    <i class="fas fa-save"></i> Assign to Salesman
                </button>
                <a href="{{ route('manager.dashboard') }}" class="btn btn-secondary btn-lg">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>