{{-- {{ dd(function_exists('my_asset')) }} --}}
@extends('layout.app')
@section('title')
    تعديل(يومي)
@endsection()

@section('content')
    <form id="dailyRecordForm" class="m-auto for text-center mt-5" action="{{ route('Update', [$bills->id , 'branch' => $bills->type_branch]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label">رقم الفاتوره</label>
            <input type="number" class="form-control" id="invoiceNumber" name="numberOFlist" value="{{ $bills->bills }}"
                placeholder="رقم الفاتوره">
        </div>

        <div class="mb-3">
            <label class="form-label">اسم التاجر</label>
            <select name="nameOFtager" id="traderName" class="form-control" required>
                <option value="">حدد (التاجر)</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $bills->consumer_id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">الكميه المنصرفه</label>
            <input type="float" onkeyup="change(1)" id="toon_2" class="form-control m-b-3"
                value="{{ $bills->kgg }}" name="numberOFhightT"
                placeholder="الكميه المنصرفه(بالالف كيلوا)"><br><br>
            <input type="float" onkeyup="change_2(2)" id="kg_2" class="form-control"
                value="{{ $bills->kg }}" name="numberOFhightK" placeholder="الكميه المنصرفه(بالكيلوا)">
        </div>

        <input type="file" name="photo" id="photoInput" class="form-control" accept="image/*">
        @if($bills->images && file_exists(public_path('storage/'.$bills->images)))
        <div class="mb-3">
            <label class="form-label">تحميل صورة</label>
                <div class="mt-2">
                    <img src="{{ my_asset('storage/'.$bills->images) }}" alt="صورة الفاتورة" class="img-thumbnail" style="max-height: 100px">
                    <p class="small text-muted">الصورة الحالية</p>
                </div>
            </div>
            @endif

        <div class="mb-3">
            <label class="form-label d-block mt-3">الفرع</label>

            <div class="form-check form-check-inline">
                <input class="form-check-input branchRadio" type="radio" name="type_branch" id="branch1" value="1"
                    {{ $bills->type_branch == 1 ? 'checked' : '' }}>
                <label class="form-check-label" for="branch1">
                    <span class="badge bg-primary">الفرع 1</span>
                </label>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input branchRadio" type="radio" name="type_branch" id="branch2" value="2"
                    {{ $bills->type_branch == 2 ? 'checked' : '' }}>
                <label class="form-check-label" for="branch2">
                    <span class="badge bg-success">الفرع 2</span>
                </label>
            </div>

            <div class="form-check form-check-inline p-3">
                <input class="form-check-input" type="radio" name="type_branch" id="notificationType" value="3"
                    {{ $bills->type_branch == 3 ? 'checked' : '' }}>
                <label class="form-check-label" for="notificationType">
                    <span class="badge bg-warning">اخطار</span>
                </label>
            </div>
        </div>

        <div class="text-center">
            <button class="btn btn-primary w-100" type="button" id="submitBtn">تعديل</button>
        </div>
    </form>

    <!-- نافذة التأكيد -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="confirmModalLabel">تأكيد تعديل البيانات</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center mb-4">هل أنت متأكد من تعديل هذه البيانات؟</p>
                    
                    <div class="card mb-3">
                        <div class="card-body p-3">
                            <div class="row mb-2">
                                <div class="col-5 fw-bold">رقم الفاتورة:</div>
                                <div class="col-7" id="confirmInvoice"></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-5 fw-bold">اسم التاجر:</div>
                                <div class="col-7" id="confirmTrader"></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-5 fw-bold">الكمية بالطن:</div>
                                <div class="col-7" id="confirmToon"></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-5 fw-bold">الكمية بالكيلو:</div>
                                <div class="col-7" id="confirmKg"></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-5 fw-bold">الصورة:</div>
                                <div class="col-7" id="confirmPhoto"></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-5 fw-bold">الفرع:</div>
                                <div class="col-7" id="confirmBranch"></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-5 fw-bold">اخطار:</div>
                                <div class="col-7" id="confirmNotification"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="button" class="btn btn-primary" id="confirmSubmit">تأكيد التعديل</button>
                </div>
            </div>
        </div>
    </div>

<script>
let toon_2 = document.getElementById('toon_2');
let kg_2 = document.getElementById('kg_2');

function change($name) {
    if ($name == 1) {
        if (toon_2.value === "") {
            kg_2.value = "";
        } else {
            kg_2.value = (parseFloat(toon_2.value) * 1000).toFixed(2);
        }
    }
}

function change_2($name) {
    if ($name == 2) {
        if (kg_2.value === "") {
            toon_2.value = "";
        } else {
            toon_2.value = (parseFloat(kg_2.value) / 1000).toFixed(3);
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('submitBtn').addEventListener('click', function() {
        let invoiceNumber = document.getElementById('invoiceNumber').value || 'غير محدد';
        let traderSelect = document.getElementById('traderName');
        let traderName = traderSelect.options[traderSelect.selectedIndex].text;
        let toonValue = toon_2.value || '0';
        let kgValue = kg_2.value || '0';
        
        let branch = "غير محدد";
        let branchRadios = document.getElementsByClassName('branchRadio');
        for (let i = 0; i < branchRadios.length; i++) {
            if (branchRadios[i].checked) {
                branch = branchRadios[i].value === "1" ? "الفرع 1" : "الفرع 2";
                break;
            }
        }
        
        let notification = document.getElementById('notificationType').checked ? "مفعل" : "غير مفعل";
        
        let photoInput = document.getElementById('photoInput');
        let photoText = photoInput.files.length > 0 ? photoInput.files[0].name : "لم يتم تغيير الصورة";
        
        document.getElementById('confirmInvoice').textContent = invoiceNumber;
        document.getElementById('confirmTrader').textContent = traderName;
        document.getElementById('confirmToon').textContent = toonValue + ' طن';
        document.getElementById('confirmKg').textContent = kgValue + ' كجم';
        document.getElementById('confirmPhoto').textContent = photoText;
        document.getElementById('confirmBranch').textContent = branch;
        document.getElementById('confirmNotification').textContent = notification;
        
        var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
        confirmModal.show();
    });
    
    document.getElementById('confirmSubmit').addEventListener('click', function() {
        document.getElementById('dailyRecordForm').submit();
    });
    
    toon_2.addEventListener('input', function() {
        if (parseFloat(this.value) < 0) {
            this.value = 0;
            change(1);
        }
    });

    kg_2.addEventListener('input', function() {
        if (parseFloat(this.value) < 0) {
            this.value = 0;
            change_2(2);
        }
    });
});
</script>
@endsection()