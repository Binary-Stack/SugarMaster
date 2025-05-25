@php
    use function App\Url\my_asset;
    // my_asset('nool');
@endphp
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="{{ my_asset('bootstrap-5.3.3-dist/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ my_asset('Styles/normalize.css') }}" rel="stylesheet">
    <link href="{{ my_asset('Styles/master.css') }}" rel="stylesheet">
</head>

<body>
    <header>
        <a href="branch">
            <img class="logo" src="{{ asset('Assets/Images/logo.png') }}" alt="System Logo">
        </a>

        <!-- زر القائمة لفتح القائمة في الشاشات الصغيرة -->
        <button class="navbar-toggler bars-btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <!-- القائمة -->
        <nav>
            <div class="container" style="* {display: inline-block;}">

                <!-- الروابط داخل القائمة -->
                <div class="navbar-items" id="navbarNav">
                    <ul class="navbar-nav w-100 d-flex justify-content-between">
                        <li class="nav-item">
                            <a class="  btn the abdo " href="{{ route('show_list', ['branch' => 1]) }}">الرئيسيه</a>
                        </li>
                        <li class="nav-item">
                            <a class="  btn  abdo the" href="{{ route('creat_list') }}">تسجيل (يومي)</a>
                        </li>
                        <li class="nav-item">
                            <a class="  btn  abdo the" href="{{ route('stock_taking') }}">جرد (المخزون)</a>
                        </li>
                        <li class="nav-item">
                            <a class="  btn  abdo the" href="{{ route('creat_revenuse') }}">تسجيل (إيرادات)</a>
                        </li>
                        <li class="nav-item profile-nav-item">
                            <a class="  btn  abdo the" href="{{ route('profile') }}">الملف الشخصي</a>
                            <img src="{{ asset('Assets/Images/avatar.png') }}" alt="Personal Picture">
                            <!-- اجعلها صورة المستخدم -->
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" id="error-alert"
            style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); width: 80%; max-width: 500px; z-index: 1050; text-align: center; box-shadow: 0 4px 8px rgba(0,0,0,0.1); border-radius: 8px;">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <ul class="list-unstyled mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <script>
            setTimeout(function() {
                $("#error-alert").fadeOut(500);
            }, 4000);
        </script>
    @endif

    <!-- تحسين رسائل النجاح -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" id="success-alert"
            style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); width: 80%; max-width: 500px; z-index: 1050; text-align: center; box-shadow: 0 4px 8px rgba(0,0,0,0.1); border-radius: 8px;">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ session('success') }}
        </div>
        <script>
            setTimeout(function() {
                $("#success-alert").fadeOut(500);
            }, 3000);
        </script>
    @endif

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ my_asset('mainStyle/js_frist.js') }}"></script>
    <script src="{{ my_asset('jquery-3.7.1.min.js') }}"></script>

</body>

</html>
