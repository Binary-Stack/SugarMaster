@extends('layout.app')

@section('content')

<form class="form mt-5" action="{{route('the_5_U' , $bills->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label  class="form-label">رقم الفاتوره</label>
        <input type="number" value="{{$bills->bills}}" class="form-control" name="numberOFlist" placeholder="رقم الفاتوره">
      </div>
      <div class="mb-3">
        <label class="form-label">اسم التاجر</label>

        <select name="nameOFtager" class="form-control">
            @foreach($users as $user )
            <option @if($user->id==$bills->user_id) selected @endif value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">الكميه المنصرفه</label>
        <input type="float" value="{{$bills->kgg}}" onkeyup="change(1)" id="toon" class="form-control" name="numberOFhightT" placeholder="الكميه المنصرفه(بالالف كيلوا)">
        <input type="float" value="{{$bills->kg}}" onkeyup="change_2(2)" id="kg" class="form-control" name="numberOFhightK" placeholder="الكميه المنصرفه(بالكيلوا)">
</div>

    <div class="text-center ">
        <button class="btn btn-primary w-100" type="submit">ارسال</button>
  </div>

</form>



<script>
    let toon = document.getElementById('toon');
    let kg = document.getElementById('kg');

    function change($name){
        if($name == 1){

            kg.value = toon.value * (1000);
            if(toon.value==""){
                kg.value = "";
            }

        }
    }

    function change_2($name){
        if($name == 2){
            toon.value = kg.value / (1000);
            if(kg.value==""){
                toon.value = "";
            }
        }
    }
    </script>


@endsection
