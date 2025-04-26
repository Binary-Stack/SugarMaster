@extends('layout.app')
@section('title') الجوهرة لتعبية المواد الغذاءيه @endsection
@section('content') 

    <div class="container">
        <h2 class="mb-4 text-primary">عرض شامل لليوميه</h2>
        @if ($bills != null)
        
        <table class="table table-bordered table-blue text-center">
            <thead>
                <tr>
                    <th>التاريخ</th>
                    <th>الكميه بالطن</th>
                    <th>الكميه بالكغ</th>
                    <th>الفرع 1</th>
                    <th>الفرع 2</th>
                    <th>الاخطارات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bills as $bill)
                <tr>
                    <td>{{$bill->formatted_date}} </td>
                    <td>{{$bill->total_bills}}</td>
                    <td>{{$bill->total_bills * 1000}}</td>
                    <td>{{$bill->branch_1}} فاتوره</td>
                    <td>{{$bill->branch_2}} فاتوره</td>
                    <td>{{$bill->branch_3}} اخطار</td>                    
                </tr>
                @endforeach
        </tbody>
    </table>
    @else
    @endif
  </div>

</body>
</html>

@endsection