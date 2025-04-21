@extends('layout.app')

@section('title')
    الجوهرة لتعبية المواد الغذاءيه
@endsection




@section('content')
    <style>
        .two {
            display: none;
        }

        ;

        .three {
            display: none;
        }
    </style>


    @if ($errors->any())
        <div class="alert alert-danger z-1" id="error-alert"
            style="width: 50%; margin-left: 30%; text-align: center; position: absolute;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

        <script>
            setTimeout(function() {
                document.getElementById('error-alert').style.display = 'none';
            }, 5000); // يمكنك تغيير 5000 إلى عدد الثواني المطلوب
        </script>
    @endif


    @if (session('success'))
        <div class="alert alert-success z-1" id="error-alert_1"
            style="width: 50%; margin-left: 30%; text-align: center; position: absolute;">
            {{ session('success') }}
        </div>

        <script>
            setTimeout(function() {
                document.getElementById('error-alert_1').style.display = 'none';
            }, 800);
        </script>
    @endif




    <div class="d-flex">

        <div class="card    position-absolute  end-0 mt-1     col-4 " style="width: 13rem; font-size: 16px; ">
            <div class="card-header bg-primary text-light text-end">
                الكميه بالمخازن
            </div>
            <ul class="list-group list-group-flush">
                @if ( isset($stoks->kgg)  && $stoks->kgg != null)
                    <li class="list-group-item ">{{ $stoks->kgg }}طن</li>
                    <li class="list-group-item "> {{ $stoks->kg }}كيلو جرام</li>
                    @else
                    <li class="list-group-item ">طن</li>
                    <li class="list-group-item ">كيلو جرام</li>
                    @endif
            </ul>
        </div>



        <div class="col-4" style="margin-left:400px;">
            <div class="alert alert-dark fs-5 p-1 mt-5  w-30  text-center" role="alert">
                (حد اقصي(150))قاءمة صرف فواتير هذا الشهر
            </div>
        </div>
    </div>



    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">رقم الفاتوره</th>
                    <th scope="col">اسم التاجر</th>
                    <th scope="col">كميه(طن)</th>
                    <th scope="col">الكميه (كيلوا)</th>
                    <th scope="col">معاد(الصرف)</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($data as $date)
                    <tr style="font-size: 18px">
                        <th scope="row">{{ $date->bills }} </th>
                        <td>{{ $date->consumer->name }}</td>
                        <td style="font-size: 20px">{{ $date->kgg }}طن</td>
                        <td style="font-size: 20px">{{ $date->kg }}كيلوا</td>
                        <td>{{ $date->formatted_date }}</td>
                        <td><a href="{{ route('edit_1', $date['id']) }}" class="btn btn-primary">تعديل</a></td>
                        <td>
                            <form action="{{ route('the_5_D', $date['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

















@endsection
