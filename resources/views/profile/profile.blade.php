@section('content')
    @extends('layout.app')

@section('title')
    بينات الحساب
@endsection()

<div class="py-5 profile-container">
    <div class="sub-container">
        <div class="col-md-8" style="margin: 0 auto;">
            <div class="card shadow-sm p-4">
                <div class="text-end mb-3 profile-card-head">
                    <img src="{{ asset('storage/' . $user->image) }}" alt="صورة المستخدم" data-bs-toggle="modal"
                        data-bs-target="#profileModal">
                    <h2 class="text-center mb-4">بيانات المستخدم</h2>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 fw-bold">الاسم الكامل:</div>
                    <div class="col-sm-8">{{ $user->name }}</div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4 fw-bold">البريد الإلكتروني:</div>
                    <div class="col-sm-8">{{ $user->email }}</div>
                </div>
                {{-- <div class="row mb-3">
            <div class="col-sm-4 fw-bold">رقم الهاتف:</div>
            <div class="col-sm-8">{{$user->phone}}</div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-4 fw-bold">العنوان:</div>
            <div class="col-sm-8">{{$user->address}}</div>
          </div> --}}
                <div class="row mb-3">
                    <div class="col-sm-4 fw-bold">تاريخ التسجيل:</div>
                    <div class="col-sm-8">{{ $user->created_at }}</div>
                </div>
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('profile', ['status' => 'edit']) }}" class="btn btn-primary">تعديل البيانات</a>
                    {{-- <a href="{{ route('EditPassword') }}" class="btn btn-primary">تغيير كلمه المرور</a> --}}

                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">تسجيل الخروج</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content p-3 position-relative">


            <button type="button" class="btn-close btn-close-primary position-absolute top-0 end-0 m-2"
                data-bs-dismiss="modal" aria-label="Close"></button>

            <img src="{{ asset('storage/' . $user->image) }}" alt="الصورة المكبرة"
                class="img-fluid rounded w-50 mx-auto d-block">
        </div>
    </div>
</div>
@endsection
