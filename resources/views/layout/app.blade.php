<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'title')</title>
    <link href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('pro.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>
<style>
    * {
        font-family: Tahoma, Verdana, sans-serif;
    }

    .one:hover {
        opacity: .5;
    }

    body {
        height: 100vh;
    }

    .two {
        display: none;
    }
</style>

<body>
    <nav class="navbar navbar-expand bg-info-subtle m-auto mt-3 mb-3 boy go" style=" border:solid 2px  whit;">
        <div class="container">
            <!-- زر القائمة لفتح القائمة في الشاشات الصغيرة -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- الروابط داخل القائمة -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav w-100 d-flex justify-content-between">
                    <li class="nav-item">
                        <a class="  btn the abdo " href="{{ route('show_list', ['branch' => 1]) }}">الجوهرة</a>
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
                    <li class="nav-item">
                        <a class="  btn  abdo the" href="{{ route('profile') }}">الملف الشخصي</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('mainStyle/js_frist.js') }}"></script>
    <script src="{{ asset('jquery-3.7.1.min.js') }}"></script>

</body>

</html>
