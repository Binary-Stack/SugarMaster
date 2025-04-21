@extends('layout.app')

@section('title') جرد(مخزون)  @endsection()

@section('content')


<form action="{{route('show_list_tager')}}" method="POST">
    @csrf
    <div class="container  mt-2" style="width:50%;">
        <label for="" class="">ابحث عن كميات صرف التاجر</label>
        <select name="nameOFtager" class="form-control">
            @foreach($users as $user )
            <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
        <div>
        <input type="submit" style=" width: 100%; text-ailgn: center;" class="btn btn-primary "  value="ابحث">
    </div>
    </div>
</form>
@if($stok != null) 
<div class="position-absolute top-0 mt-5 end-0">
    <input class="form-control" id="kmia" type="float"  value="{{$stok->kgg}}">
    <input class="form-control" id="kmia_1" type="float"  value="{{$stok->kg}}">
    <input class="form-control" id="kmia_2"   onkeyup="the()" type="float" placeholder="ادخل كمية المعبأ بالكيلوا" >
    <input class="form-control" id="kmia_3" type="float" placeholder="بالكيلوا الكميه الاصليه " >
</div>
@else 
<div class="position-absolute top-0 mt-5 end-0">
    <input class="form-control" id="kmia_3" type="float" placeholder="لا يوجد مخزون لديك " >
</div>
@endif 




  <script>
      let kmia_1= document.getElementById('kmia_1');
      let kmia_2= document.getElementById('kmia_2');
    let kmia_3= document.getElementById('kmia_3');
function the()
{
    if(kmia_2.value == "" ) {
        kmia_3.value = null;
    } else {

        kmia_3.value = kmia_1.value - kmia_2.value;
    }


}

</script>

@endsection()
