<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    {{-- puopup_success&&error --}}
    @if (session('success'))
        <div class="alert alert-success" id="error-alert_1" style="width: 50%; margin-left: 30%; text-align: center; position: absolute;">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('error-alert_1').style.display = 'none';
            }, 2000);
        </script>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger" id="error-alert_2" style="width: 50%; margin-left: 30%; text-align: center; position: absolute;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <script>
            setTimeout(function() {
                document.getElementById('error-alert_2').style.display = 'none';
            }, 3000);
        </script>
        
    @endif
    {{-- puopup_success&&error --}}
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 col-lg-4">
                <div class="card p-4 shadow-lg">
                    <h3 class="text-center mb-4">تسجيل الدخول</h3>
                    <form method="POST" action="{{ route('loginAthentication') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">كلمة المرور</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">تسجيل الدخول</button>
                    </form>
                    <div class="mt-3 text-center">
                        <a href="{{route('register')}}">إنشاء حساب جديد</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

