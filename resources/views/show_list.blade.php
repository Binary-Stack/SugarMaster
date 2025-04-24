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

                @if (isset($stoks->kgg) && $stoks->kgg != null)
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


    <div class="d-flex justify-content-center gap-3 mt-4">
        <a class="btn btn-outline-primary @if ($branch == 1) {{ 'active' }} @endif"
            href="{{ route('show_list', ['branch' => 1]) }}"> فواتير جمله 1</a>
        <a class="btn btn-outline-primary @if ($branch == 2) {{ 'active' }} @endif "
            href="{{ route('show_list', ['branch' => 2]) }}">فواتير جمله 2</a>
    </div>




    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">صورة الفاتوره</th>
                    <th scope="col">رقم الفاتوره</th>
                    <th scope="col">اسم التاجر</th>
                    <th scope="col">كميه(طن)</th>
                    <th scope="col">الكميه (كيلوا)</th>
                    <th scope="col">معاد(الصرف)</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @if (!empty($data))
                    @foreach ($data as $date)
                        <tr style="font-size: 18px">
                            <td>
                                @if ($date->images)
                                    <img src="{{ asset('storage/' . $date->images) }}" alt="image"
                                        style="width: 30px; height: 30px; border-radius: 50%; cursor: pointer; border: 1px solid #aaa;"
                                        data-bs-toggle="modal" data-bs-target="#imageModal_{{ $date->id }}">

                                    <div class="modal fade" id="imageModal_{{ $date->id }}" tabindex="-1"
                                        aria-labelledby="modalLabel_{{ $date->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                            <div class="modal-content text-center">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel_{{ $date->id }}">عرض
                                                        الصورة
                                                        بالحجم الكامل</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="إغلاق"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{ asset('storage/' . $date->images) }}"
                                                        class="img-fluid rounded shadow"
                                                        style="max-height: 80vh; object-fit: contain;" alt="image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-muted">...</span>
                                @endif
                            </td>
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
            @endif
        </table>
    </div>
@endsection
