@extends('layout.app')

@section('title') تسجيل(ايرادات)  @endsection()

@section('content')


@if ($errors->any())
    <div class="alert alert-danger" id="error-alert_2" style="width: 50%; margin-left: 30%; text-align: center; position: absolute;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif
    <script>
        setTimeout(function() {
            document.getElementById('error-alert_2').style.display = 'none';
        }, 3000);
    </script>
{{-- @if (session('error'))
    <div class="alert alert-danger" id="error-alert" style="width: 50%; margin-left: 30%; text-align: center; position: absolute;">
        {{ session('error') }}
    </div>

    <script>
        setTimeout(function() {
            document.getElementById('error-alert').style.display = 'none';
        }, 3000);
    </script>
@endif --}}
@if (session('success'))
    <div class="alert alert-success z-1" id="error-alert_1" style="width: 50%; margin-left: 30%; text-align: center; position: absolute;">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(function() {
            document.getElementById('error-alert_1').style.display = 'none';
        }, 800);
    </script>
@endif



<form  method="POST" action="{{route('creat_revenuse_1')}}" style="margin-top: 50px">
    @csrf
<div class="mb-3 ">
    <label  class="form-label">ادخل الكميه (بلألف كيلوا جرام)</label>
    <input type="float" id="toon" onkeyup="change(1)" name="toon" value="{{ old('toon') }}" class="form-control"  placeholder="(بلألف كيلوا جرام)">
  </div>
  <div class="mb-3">
    <label  class="form-label">ادخل الكميه (بالكيلوا جرام)</label>
    <input type="float" id="kg" onkeyup="change_2(2)" name="kg" value="{{ old('kg') }}" class="form-control" id="formGroupExampleInput2" placeholder="(بالكيلوا جرام)">
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
@endsection()
