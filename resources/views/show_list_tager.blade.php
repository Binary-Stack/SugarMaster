@extends('layout.app')

@section('content')
<div class="contaner text-center mt-3">  
<h5>بيانات التاجر: {{ $user->name }}</h5>
<div class="mt-3">
<h6>الفواتير المرتبطة</h6>
</div>
</div>

    <table class="table">
        <thead>
            <tr>
                <th>رقم الفاتورة</th>
                <th>الكمية (طن)</th>
                <th>الكمية (كيلو)</th>
                <th>عدد الباكتات</th>
                <th>تاريخ الإنشاء</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bills as $bill)
                <tr>
                    <td>{{ $bill->bills }}</td>
                    <td>{{ $bill->kgg }}</td>
                    <td>{{ $bill->kg }}</td>
                    <td>{{ $bill->kg / 20 }}</td>
                    <td>{{ $bill->formatted_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h5>إحصائيات الشهر الحالي</h5>
    <table class="table">
        <thead>
            <tr>
                <th>عدد الفواتير المصروفة</th>
                <th>الكمية المصروفة (كيلو)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $monthlyBillsCount }}</td>
                <td>{{ $monthlyQuantity }}</td>
            </tr>
        </tbody>
    </table>
@endsection
