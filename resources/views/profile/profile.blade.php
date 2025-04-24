@section('content')
@extends('layout.app')

@section('title') بينات الحساب  @endsection()

<div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm p-4">
            <div class="text-end mb-3">
                <img src="{{ asset('images/user.png') }}" 
                     alt="صورة المستخدم" 
                     class="rounded-circle img-thumbnail profile-thumb"
                     style="width: 60px; cursor: pointer;"
                     data-bs-toggle="modal" data-bs-target="#profileModal">
              </div>  
          <h2 class="text-center mb-4">بيانات المستخدم</h2>
          <div class="row mb-3">
            <div class="col-sm-4 fw-bold">الاسم الكامل:</div>
            <div class="col-sm-8">{{$user->name}}</div>
          </div>
          <div class="row mb-3">
            <div class="col-sm-4 fw-bold">البريد الإلكتروني:</div>
            <div class="col-sm-8">{{$user->email}}</div>
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
            <div class="col-sm-8">{{$user->created_at}}</div>
          </div>
          <div class="d-flex justify-content-between align-items-center mt-4">
            <a href="{{ route('EditProfile') }}" class="btn btn-primary">تعديل البيانات</a>
          
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
  <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content p-3">
              <img src="{{ asset('images/user.png') }}" 
              alt="الصورة المكبرة"
              class="img-fluid rounded">
            </div>
        </div>
        <!-- Modal -->
  </div>
  
@endsection