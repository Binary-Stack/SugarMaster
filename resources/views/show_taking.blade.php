@extends('layout.app')
@section('title') جرد(مخزون) @endsection
@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">بحث عن كميات صرف التاجر</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                    <form action="{{route('show_list_tager')}}" method="POST">
                        @csrf
                            <label for="nameOFtager" class="form-label fw-bold">اختر التاجر</label>
                            <select name="nameOFtager" id="nameOFtager" class="form-select">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary w-100">ابحث</button>
                        </form>
                    </div>

                    <div class="mb-3">
                        <form action="{{route('searchDate')}}" method="POST">
                            @csrf
                            <label for="actionTimestamp" class="form-label fw-bold">جرد(اليوميه)</label>
                            <input type="date" id="actionTimestamp" name="actionTimestamp" class="form-control">
                            <button type="submit" class="btn btn-primary w-100">ابحث</button>
                        </form>
                    </div>

                    <div class="mb-3">
                        <form action="{{route('searchDate')}}" method="POST">
                            @csrf
                            <label for="actionTimestamp" class="form-label fw-bold">جرد(اليوميه) شامل</label>
                            <input type="hidden" id="actionTimestamp" name="hidden" class="form-control">
                            <button type="submit" class="btn btn-primary w-100">ابحث</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">تفاصيل المخزون</h5>
                </div>
                <div class="card-body">
                    @if($stok != null)
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kmia" class="form-label fw-bold">الكمية الإجمالية (كغ)</label>
                                <input class="form-control bg-light" id="kmia" type="number" step="0.01" value="{{$stok->kgg}}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kmia_1" class="form-label fw-bold">الكمية المتبقية (كغ)</label>
                                <input class="form-control bg-light" id="kmia_1" type="number" step="0.01" value="{{$stok->kg}}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kmia_2" class="form-label fw-bold">كمية المعبأ (كغ)</label>
                                <input class="form-control" id="kmia_2" type="number" step="0.01" placeholder="ادخل كمية المعبأ بالكيلوا" onkeyup="calculateRemaining()">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kmia_3" class="form-label fw-bold">الكمية الأصلية (كغ)</label>
                                <input class="form-control bg-light" id="kmia_3" type="number" step="0.01" placeholder="الكمية الأصلية بالكيلوا" readonly>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-warning text-center" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            لا يوجد مخزون لديك
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function calculateRemaining() {
    let kmia_1 = document.getElementById('kmia_1');
    let kmia_2 = document.getElementById('kmia_2');
    let kmia_3 = document.getElementById('kmia_3');
    
    if(kmia_2.value == "") {
        kmia_3.value = "";
    } else {
        kmia_3.value = (parseFloat(kmia_1.value) - parseFloat(kmia_2.value)).toFixed(2);
    }
}

$(document).ready(function() {
    // Initialize select2 for better dropdown experience
    if($.fn.select2) {
        $('#nameOFtager').select2({
            dir: "rtl",
            placeholder: "اختر التاجر"
        });
    }
    
    // Set default timestamp to current date and time
    const now = new Date();
    const tzOffset = now.getTimezoneOffset() * 60000;
    const localDateTime = new Date(now - tzOffset).toISOString().slice(0, 16);
    document.getElementById('actionTimestamp').value = localDateTime;
    
    // You can add your custom timestamp action here
    $('#actionTimestamp').on('change', function() {
        // Your custom action for timestamp change
        console.log('Timestamp changed:', $(this).val());
    });
});
</script>
@endsection