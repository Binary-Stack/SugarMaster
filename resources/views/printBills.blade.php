{{-- @if(file_exists(storage_path("fonts/Cairo-Regular.ttf"))) 
@dd("file exists");
@endif; --}}
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>طباعة البيانات</title>
    <style>
         /* @font-face {
        font-family: 'Cairo';
        src: url('{{ storage_path("fonts/Cairo-Regular.ttf") }}') format('truetype');    } */

    body {
        font-family: 'Cairo', sans-serif;
        direction: rtl;
        text-align: right;
    }
        .record {
            border: 2px solid #ccc;
            padding: 15px;
            width: 60%;
            margin: 30px auto;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        .record h2 {
            text-align: center;
        }
        .record table {
            width: 100%;
            border-collapse: collapse;
        }
        .record table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .label {
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="record">
        <h2>بيانات الفاتوره</h2>
        <table>
            <tr>
                <td class="label">رقم المعرف (ID):</td>
                <td>{{ $bill->id }}</td>
            </tr>
            <tr>
                <td class="label">نوع الفرع:</td>
                <td>{{ $bill->type_branch }}</td>
            </tr>
            <tr>
                <td class="label">المستهلك:</td>
                <td>{{ $bill->consumer->name }}</td>
            </tr>
            <tr>
                <td class="label">رقم الفاتورة:</td>
                <td>{{ $bill->bills }}</td>
            </tr>
            <tr>
                <td class="label">KGG:</td>
                <td>{{ $bill->kgg }}</td>
            </tr>
            <tr>
                <td class="label">KG:</td>
                <td>{{ $bill->kg }}</td>
            </tr>
            <tr>
                <td class="label">تاريخ الإنشاء:</td>
                <td>{{ $bill->created_at }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
