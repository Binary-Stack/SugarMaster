@extends('layout.app')

@section('title') تسجيل(يومي)  @endsection()

@section('content')




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




<div class=" justfiy-content-start col-4  ms-80">
    <button onclick="display()" ondblclick="display_2()" class="the boy abdo btn ms-3">اضف تاجر</button>

        <form id="form" action="{{route('create_user')}}"  method="POST"   class="two"    style="width: 40%;   ">
            @csrf
            <div class="mb-3 mt-3 ms-3">
                <input type="text" name="tager" class="form-control  don  "  placeholder="اضف تاجر(جديد)" >
            </div>
            <input type="submit" value="أضف" class="btn the boy abdo ms-3"  >
        </form>
        </div>



<form class= " m-auto for text-center mt-5"  action="{{route('createTheList')}}" method="POST">
    @csrf
    <div class="mb-3 ">
        <label  class="form-label">رقم الفاتوره</label>
        <input type="number" class="form-control" name="numberOFlist" value="{{old('numberOFlist')}}" placeholder="رقم الفاتوره">
      </div>
      <div class="mb-3">
        <label class="form-label">اسم التاجر</label>

        <select name="nameOFtager" class="form-control">
            @foreach($users as $user )
            <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">الكميه المنصرفه</label>
        <input type="float" onkeyup="change(1)" id="toon_2" class="form-control m-b-3" value="{{old('numberOFhightT')}}" name="numberOFhightT" placeholder="الكميه المنصرفه(بالالف كيلوا)"><br><br>
        <input type="float" onkeyup="change_2(2)" id="kg_2" class="form-control" value="{{old('numberOFhightK')}}" name="numberOFhightK" placeholder="الكميه المنصرفه(بالكيلوا)">
</div>

    <div class="text-center ">
        <button class="btn btn-primary w-100" type="submit">ارسال</button>
  </div>

</form>




@endsection()
