@extends('layout.app')
@section('title', 'تعديل البيانات')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0">تعديل البيانات الشخصية</h4>
                </div>
                <div class="card-body p-4">                    
                    <form action="{{ route('updateProfile', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-12 mb-4 text-center">
                                @if ($user->image)
                                    <div class="mb-3">
                                        <img src="{{ asset('storage/'.$user->image) }}" alt="صورة المستخدم" 
                                             class="rounded-circle img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                                    </div>
                                @else
                                    <div class="mb-3">
                                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" 
                                             style="width: 150px; height: 150px; font-size: 50px; color: #aaa;">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">الاسم</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                <input type="text" name="name" id="name" class="form-control" 
                                       value="{{ old('name', $user->name) }}" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="email" class="form-label fw-bold">البريد الإلكتروني</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                <input type="email" name="email" id="email" class="form-control" 
                                       value="{{ old('email', $user->email) }}" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="img" class="form-label fw-bold">تغيير الصورة الشخصية</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-image"></i></span>
                                <input type="file" name="image" id="img" class="form-control" accept="image/*">
                            </div>
                            <div class="form-text text-muted">
                                اختر صورة بصيغة jpg، png، أو jpeg (الحجم الأقصى: 2 ميجابايت)
                            </div>
                        </div>
                        
                        <div class="row mt-5">
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('show_list') }}" class="btn btn-secondary w-100">
                                    <i class="bi bi-arrow-right me-2"></i> رجوع
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-check2-circle me-2"></i> حفظ التغييرات
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- بطاقة تغيير كلمة المرور -->
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-warning text-dark text-center py-3">
                    <h4 class="mb-0">تغيير كلمة المرور</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="current_password" class="form-label fw-bold">كلمة المرور الحالية</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-key-fill"></i></span>
                                <input type="password" name="current_password" id="current_password" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="new_password" class="form-label fw-bold">كلمة المرور الجديدة</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" name="password" id="new_password" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="new_password_confirmation" class="form-label fw-bold">تأكيد كلمة المرور الجديدة</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" name="password_confirmation" id="new_password_confirmation" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-warning w-50">
                                <i class="bi bi-shield-lock me-2"></i> تحديث كلمة المرور
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // معاينة الصورة قبل الرفع
    document.getElementById('img').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImage = document.querySelector('.rounded-circle.img-thumbnail');
                if (previewImage) {
                    previewImage.src = e.target.result;
                } else {
                    // إنشاء صورة معاينة إذا لم تكن موجودة
                    const imageContainer = document.querySelector('.col-md-12.mb-4.text-center');
                    imageContainer.innerHTML = `
                        <div class="mb-3">
                            <img src="${e.target.result}" alt="صورة المستخدم" 
                                 class="rounded-circle img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                    `;
                }
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>
@endsection