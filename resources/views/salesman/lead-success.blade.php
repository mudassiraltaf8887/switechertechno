<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lead Updated Successfully</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .success-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            padding: 40px;
            margin: 50px auto;
            max-width: 800px;
            position: relative;
            overflow: hidden;
        }
        
        .success-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, #28a745, #20c997, #17a2b8);
        }
        
        .success-icon {
            font-size: 4rem;
            color: #28a745;
            animation: bounceIn 1s ease-in-out;
        }
        
        @keyframes bounceIn {
            0% { transform: scale(0); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        .lead-info {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .info-row:last-child {
            border-bottom: none;
        }
        
        .info-label {
            font-weight: 600;
            color: #495057;
        }
        
        .info-value {
            color: #6c757d;
        }
        
        .btn-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 12px 30px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            color: white;
        }
        
        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        
        .badge-success { background: #d4edda; color: #155724; }
        .badge-warning { background: #fff3cd; color: #856404; }
        .badge-info { background: #d1ecf1; color: #0c5460; }
    </style>
</head>
<body>
    <div class="container">
        <div class="success-container">
            <div class="text-center mb-4">
                <i class="fas fa-check-circle success-icon"></i>
                <h1 class="mt-3 mb-2">Lead Updated Successfully!</h1>
                <p class="text-muted">Your lead has been saved and is now ready for follow-up.</p>
            </div>
            
            <div class="lead-info">
                <h4 class="mb-3"><i class="fas fa-user"></i> Lead Information</h4>
                
                <div class="info-row">
                    <span class="info-label">Contact Person:</span>
                    <span class="info-value">{{ $salesmanLead->contact_person }}</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Company Name:</span>
                    <span class="info-value">{{ $salesmanLead->company_name ?? 'N/A' }}</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Mobile Number:</span>
                    <span class="info-value">{{ $salesmanLead->mobile_no }}</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Lead Source:</span>
                    <span class="info-value">{{ $salesmanLead->lead_source ?? 'N/A' }}</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Demo Type:</span>
                    <span class="status-badge badge-info">{{ $salesmanLead->demo_type }}</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Status:</span>
                    <span class="status-badge badge-success">{{ $salesmanLead->status }}</span>
                </div>
                
                @if($salesmanLead->next_followup_date)
                <div class="info-row">
                    <span class="info-label">Next Follow-up:</span>
                    <span class="info-value">{{ $salesmanLead->next_followup_date->format('M d, Y') }}</span>
                </div>
                @endif
                
                @if($salesmanLead->amount_quotated)
                <div class="info-row">
                    <span class="info-label">Amount Quoted:</span>
                    <span class="info-value">Rs{{ number_format($salesmanLead->amount_quotated, 2) }}</span>
                </div>
                @endif
                
                <div class="info-row">
                    <span class="info-label">Updated By:</span>
                    <span class="info-value">{{ $salesmanLead->salesman->name }}</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Updated At:</span>
                    <span class="info-value">{{ $salesmanLead->created_at->format('M d, Y - h:i A') }}</span>
                </div>
            </div>
            
            @if($salesmanLead->salesman_remarks)
            <div class="lead-info">
                <h5><i class="fas fa-comment"></i> Salesman Remarks</h5>
                <p class="mb-0">{{ $salesmanLead->salesman_remarks }}</p>
            </div>
            @endif
            
            <div class="text-center mt-4">
                <a href="{{ route('salesman.dashboard') }}" class="btn btn-custom me-3">
                    <i class="fas fa-tachometer-alt"></i> Go to Dashboard
                </a>
                <button onclick="window.print()" class="btn btn-outline-secondary">
                    <i class="fas fa-print"></i> Print Details
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto redirect after 10 seconds (optional)
        setTimeout(function() {
            // window.location.href = "{{ route('salesman.dashboard') }}";
        }, 10000);
    </script>
</body>
</html>