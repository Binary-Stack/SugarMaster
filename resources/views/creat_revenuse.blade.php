@extends('layout.app')
@section('title') تسجيل(ايرادات) @endsection
@section('content')

<!-- تحسين رسائل الخطأ -->


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm mt-5">
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="mb-0">تسجيل الإيرادات</h5>
                </div>
                <div class="card-body">
                    <form id="revenueForm" method="POST" action="{{route('creat_revenuse_1')}}" class="mt-3">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-bold">ادخل الكمية (بالألف كيلو جرام)</label>
                            <div class="input-group">
                                <input type="number" step="0.001" id="toon" onkeyup="change(1)" name="toon" value="{{ old('toon') }}" 
                                       class="form-control" placeholder="ادخل الكمية بالطن">
                                <span class="input-group-text">طن</span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">ادخل الكمية (بالكيلو جرام)</label>
                            <div class="input-group">
                                <input type="number" step="0.001" id="kg" onkeyup="change_2(2)" name="kg" value="{{ old('kg') }}" 
                                       class="form-control" placeholder="ادخل الكمية بالكيلو جرام">
                                <span class="input-group-text">كجم</span>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="button" id="submitBtn" class="btn btn-primary w-75 py-2">تسجيل الإيرادات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- نافذة التأكيد -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="confirmModalLabel">تأكيد تسجيل الإيرادات</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>هل أنت متأكد من تسجيل هذه الإيرادات؟</p>
                <div class="row my-3">
                    <div class="col-6">
                        <p class="mb-1 fw-bold">الكمية بالطن:</p>
                        <p id="confirmToon"></p>
                    </div>
                    <div class="col-6">
                        <p class="mb-1 fw-bold">الكمية بالكيلو جرام:</p>
                        <p id="confirmKg"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-primary" id="confirmSubmit">تأكيد التسجيل</button>
            </div>
        </div>
    </div>
</div>

<script>
// دوال التحويل بين الوحدات
let toon = document.getElementById('toon');
let kg = document.getElementById('kg');

function change($name) {
    if($name == 1) {
        if(toon.value === "") {
            kg.value = "";
        } else {
            kg.value = (parseFloat(toon.value) * 1000).toFixed(3);
        }
    }
}

function change_2($name) {
    if($name == 2) {
        if(kg.value === "") {
            toon.value = "";
        } else {
            toon.value = (parseFloat(kg.value) / 1000).toFixed(3);
        }
    }
}

// إضافة التحقق من الإدخال - منع القيم السالبة
toon.addEventListener('input', function() {
    if (parseFloat(this.value) < 0) {
        this.value = 0;
        change(1);
    }
});

kg.addEventListener('input', function() {
    if (parseFloat(this.value) < 0) {
        this.value = 0;
        change_2(2);
    }
});

// نافذة التأكيد
document.getElementById('submitBtn').addEventListener('click', function() {
    let toonValue = toon.value || '0';
    let kgValue = kg.value || '0';
    
    // عرض القيم في نافذة التأكيد
    document.getElementById('confirmToon').textContent = toonValue + ' طن';
    document.getElementById('confirmKg').textContent = kgValue + ' كجم';
    
    // فتح نافذة التأكيد
    var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
    confirmModal.show();
});

// عند الضغط على زر التأكيد
document.getElementById('confirmSubmit').addEventListener('click', function() {
    // إرسال النموذج
    document.getElementById('revenueForm').submit();
});
</script>
@endsection