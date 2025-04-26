<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.css') }}" rel="stylesheet">
    <title>عرض المبيعات</title>
    <style>
        .card {
            transition: all 0.3s ease;
            border-radius: 10px;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
        
        .display-5 {
            font-size: 2.5rem;
        }
        
        .alert {
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        /* RTL specific styling */
        body {
            direction: rtl;
            text-align: right;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            padding-top: 10px; /* إضافة مسافة صغيرة من الأعلى */
        }
        
        .alert ul {
            padding-right: 0;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .text-primary {
            color: #0d6efd !important;
        }
        
        .text-success {
            color: #198754 !important;
        }
        
        .text-info {
            color: #0dcaf0 !important;
        }
    </style>
</head>
<body>
    <!-- Alert Messages -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" id="error-alert_1"
            style="width: 50%; margin: 10px auto; text-align: center;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('error-alert_1').style.display = 'none';
            }, 2000);
        </script>
    @endif
    
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" id="error-alert_2"
            style="width: 50%; margin: 10px auto; text-align: center;">
            <ul class="mb-0 list-unstyled">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('error-alert_2').style.display = 'none';
            }, 3000);
        </script>
    @endif
    <div class="container mt-2">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mb-3">
            <i class="bi bi-arrow-right"></i> رجوع
        </a>
        <h2 class="mb-3 text-center">ملخص اليوميه</h2>
    </div>
    
    <!-- Sales Summary -->
    <div class="container mt-2">
        <div class="row">

            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <h6 class="text-muted mb-2">إجمالي الصرف</h6>
                        <h3 class="display-5 fw-bold text-primary mb-0">{{ $total_sales ?? 0 }}طن</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <h6 class="text-muted mb-2">إجمالي الصرف</h6>
                        <h3 class="display-5 fw-bold text-primary mb-0">{{ $total_sales ? $total_sales * 1000 : 0; }}كغ</h3>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <h6 class="text-muted mb-2">جمله (1)</h6>
                        <h3 class="display-5 fw-bold text-success mb-0">{{ $countBranche_1 ?? 0 }} فاتوره</h3>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <h6 class="text-muted mb-2">جمله (2)</h6>
                        <h3 class="display-5 fw-bold text-info mb-0">{{ $countBranche_2 ?? 0 }} فاتوره</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <h6 class="text-muted mb-2">اخطار</h6>
                        <h3 class="display-5 fw-bold text-info mb-0">{{ $countBranche_3 ?? 0 }} أخطار</h3>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- <script src="{{ asset('mainStyle/js_frist.js') }}"></script> --}}
    <script src="{{ asset('jquery-3.7.1.min.js') }}"></script>
</body>
</html>