@php
    use function App\Url\my_asset;
@endphp
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ my_asset('Styles/normalize.css') }}" rel="stylesheet">
    <link href="{{ my_asset('Styles/master.css') }}" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3498db;
            --dark-color: #2c3e50;
            --light-color: #ecf0f1;
            --success-color: #27ae60;
            --danger-color: #e74c3c;
        }

        body {
            visibility: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            padding-top: 70px;
        }

        #loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: white;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loader {
            border: 10px solid #f3f3f3;
            border-top: 10px solid var(--primary-color);
            border-radius: 50%;
            width: 80px;
            height: 80px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* شريط التنقل الجديد */
        .custom-navbar {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            padding: 10px 0;
        }

        .custom-navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .custom-logo {
            height: 50px;
        }

        .custom-nav-items {
            display: flex;
            gap: 10px;
        }

        .custom-nav-link {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 15px;
            font-weight: 500;
            transition: all 0.3s;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .custom-nav-link:hover {
            background-color: var(--dark-color);
            transform: translateY(-2px);
        }

        .profile-nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile-image {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--light-color);
        }

        /* قائمة الجوال */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 10px;
        }

        .mobile-menu-btn span {
            display: block;
            width: 30px;
            height: 3px;
            background-color: var(--dark-color);
            margin: 5px 0;
            border-radius: 2px;
            transition: all 0.3s;
        }

        .mobile-menu-btn.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .mobile-menu-btn.active span:nth-child(2) {
            opacity: 0;
        }

        .mobile-menu-btn.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }

        .mobile-nav-container {
            display: none;
            position: fixed;
            top: 70px;
            left: 0;
            width: 100%;
            background-color: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            z-index: 999;
            padding: 15px;
        }

        .mobile-nav-items {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* رسائل التنبيه */
        .alert-custom {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 500px;
            z-index: 1050;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            animation: slideIn 0.5s, fadeOut 1s 3s forwards;
        }

        @keyframes slideIn {
            from {
                top: -100px;
                opacity: 0;
            }

            to {
                top: 20px;
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
                visibility: hidden;
            }
        }

        /* محتوى الصفحة */
        .page-content {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        /* تصميم متجاوب */
        @media (max-width: 992px) {
            .custom-nav-items {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }
        }

        @media (max-width: 768px) {
            .custom-logo {
                height: 40px;
            }

            body {
                padding-top: 60px;
            }
        }
    </style>
</head>

<body>
    <div id="loader-wrapper">
        <div class="loader"></div>
    </div>

    <!-- شريط التنقل الجديد -->
    <nav class="custom-navbar">
        <div class="custom-navbar-container">
            <a href="branch">
                <img class="custom-logo" src="{{ my_asset('Assets/Images/logo.png') }}" alt="System Logo">
            </a>

            <div class="custom-nav-items">
                <a class="custom-nav-link" href="{{ route('show_list', ['branch' => 1]) }}">الرئيسيه</a>
                <a class="custom-nav-link" href="{{ route('creat_list') }}">تسجيل (يومي)</a>
                <a class="custom-nav-link" href="{{ route('stock_taking') }}">جرد (المخزون)</a>
                <a class="custom-nav-link" href="{{ route('creat_revenuse') }}">تسجيل (إيرادات)</a>
                <div class="profile-nav-item">
                    <a class="custom-nav-link" href="{{ route('profile') }}">الملف الشخصي</a>
                    @if (Auth::user()->image)
                        <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Personal Picture"
                            class="profile-image">
                    @endif
                </div>
            </div>

            <!-- زر قائمة الجوال -->
            <button id="mobileMenuBtn" class="mobile-menu-btn">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>

    <!-- قائمة الجوال -->
    <div id="mobileNavContainer" class="mobile-nav-container">
        <div class="mobile-nav-items">
            <a class="custom-nav-link" href="{{ route('show_list', ['branch' => 1]) }}">الرئيسيه</a>
            <a class="custom-nav-link" href="{{ route('creat_list') }}">تسجيل (يومي)</a>
            <a class="custom-nav-link" href="{{ route('stock_taking') }}">جرد (المخزون)</a>
            <a class="custom-nav-link" href="{{ route('creat_revenuse') }}">تسجيل (إيرادات)</a>
            <div class="profile-nav-item">
                <a class="custom-nav-link" href="{{ route('profile') }}">الملف الشخصي</a>
                @if (Auth::user()->image)
                    <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Personal Picture"
                        class="profile-image">
                @endif
            </div>
        </div>
    </div>

    <!-- رسائل التنبيه -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible alert-custom">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <ul class="list-unstyled mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible alert-custom">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ session('success') }}
        </div>
    @endif

    <!-- المحتوى الرئيسي -->
    <div class="page-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ my_asset('jquery-3.7.1.min.js') }}"></script>
    <script>
        // تحميل الصفحة
        window.addEventListener("load", function() {
            document.body.style.visibility = "visible";

            const loader = document.getElementById("loader-wrapper");
            if (loader) {
                loader.style.transition = "opacity 0.5s ease";
                loader.style.opacity = 0;
                setTimeout(() => {
                    loader.remove();
                }, 500);
            }
        });

        // قائمة الجوال
        document.getElementById('mobileMenuBtn').addEventListener('click', function() {
            this.classList.toggle('active');
            const mobileNav = document.getElementById('mobileNavContainer');
            if (mobileNav.style.display === 'block') {
                mobileNav.style.display = 'none';
            } else {
                mobileNav.style.display = 'block';
            }
        });

        // إغلاق قائمة الجوال عند النقر خارجها
        document.addEventListener('click', function(event) {
            const mobileBtn = document.getElementById('mobileMenuBtn');
            const mobileNav = document.getElementById('mobileNavContainer');

            if (!mobileBtn.contains(event.target) && !mobileNav.contains(event.target)) {
                mobileBtn.classList.remove('active');
                mobileNav.style.display = 'none';
            }
        });

        // إغلاق رسائل التنبيه تلقائياً
        setTimeout(function() {
            $('.alert-custom').fadeOut(500);
        }, 5000);
    </script>
</body>

</html>
