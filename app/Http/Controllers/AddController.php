<?php

namespace App\Http\Controllers;

use App\Models\Consumer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Bill;
use App\Models\Impot;
use App\Models\Stok;
use Carbon\Carbon;


class AddController extends Controller
{
    /*
     */


    public function store(Request $request)

    {

        $valedate = Validator::make($request->all(), [
            "toon" => 'required|numeric|max:250',
            "kg" => 'required|numeric|max:250000',
        ], [
            'toon.required' => 'عذرا: ادخل كميه من فضلك',
            'kg.max' => 'عذرا: انا اقبل بحد اقصي 250طن',
        ]);
        if ($valedate->fails()) {
            return redirect()->back()->withErrors($valedate)->withInput();
        }

        $toon = $request->input("toon");
        $kg = $request->input("kg");

        $stok = Stok::firstOrCreate(['id' => 1]);
        $stok->kgg += $toon;
        $stok->kg += $kg;
        $stok->save();
        return redirect()->back()->with('success', 'تمت العملية بنجاح!');
    }

    public function show_data()
    {
        $stok = Stok::first();
        $data = Bill::orderBy('created_at', 'desc')->take(5)->get();

        $data->transform(function ($date) {
            $date->formatted_date = Carbon::parse($date->created_at)->locale('ar')->isoFormat('dddd، YYYY-MM-DD');
            return $date;
        });

        return view("show_list", ["stoks" => $stok, "data" => $data]);
    }





    public function index_1(Request $request)
    {
        Consumer::create([
            "name" => $request->input("tager"),
        ]);
        return to_route("creat_list");
    }





    public function creat_list()
    {
        $user = Consumer::all();
        return view('creat_list_user', ['users' => $user]);
    }


    public function create_list_1(Request $request)
    {
        $valedate = Validator::make($request->all(), [
            "nameOFtager" => 'required|exists:consumers,id',
            "numberOFlist" => 'required|integer|min:1',
            "numberOFhightT" => 'required|numeric|min:0',
            "numberOFhightK" => 'required|numeric|min:0',
        ]);
        if ($valedate->fails()) {
            return redirect()->back()->withErrors($valedate)->withInput();
        }

        $stok = Stok::firstOrCreate(['id' => 1]);
        if ($stok->kgg < $request->input("numberOFhightT") || $stok->kg < $request->input("numberOFhightT")) {
            return redirect()->back()->withErrors(['error' => 'المخزون غير كاف'])->withInput();
        } else {
            $stok->kgg -= $request->input("numberOFhightT");
            $stok->kg -= $request->input("numberOFhightK");
            $stok->save();
        }

        Bill::create([
            "consumer_id" => $request->input("nameOFtager"),
            "bills" => $request->input("numberOFlist"),
            "kgg" =>   $request->input("numberOFhightT"),
            "kg" =>    $request->input("numberOFhightK"),
        ]);
        return redirect()->back()->with('success', 'تمت العملية بنجاح!');
    }




    public function search(Request $request)
    {

        // @dd($request);

        $request->validate([
            'nameOFtager' => 'required|exists:consumers,id',
        ]);

        // جلب معرف التاجر من النموذج
        $userId = $request->input('nameOFtager');

        // البحث عن بيانات التاجر
        $user = Consumer::find($userId);

        // جلب جميع الفواتير المرتبطة بهذا التاجر
        $bills = Bill::where('consumer_id', $userId)->get();

        $bills->transform(function ($date) {
            $date->formatted_date = Carbon::parse($date->created_at)->locale('ar')->isoFormat('dddd، YYYY-MM-DD');
            return $date;
        });
        // حساب عدد الفواتير المصروفة خلال الشهر
        $startOfMonth = Carbon::now()->startOfMonth(); // بداية الشهر الحالي
        $endOfMonth = Carbon::now()->endOfMonth(); // نهاية الشهر الحالي

        $monthlyBillsCount = Bill::where('consumer_id', $userId)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->count(); // عدد الفواتير

        $monthlyQuantity = Bill::where('consumer_id', $userId)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('kg'); // مجموع الكمية المصروفة بالكيلو

        // إرجاع النتائج إلى الواجهة
        return view('show_list_tager', [
            'user' => $user,
            'bills' => $bills,
            'monthlyBillsCount' => $monthlyBillsCount,
            'monthlyQuantity' => $monthlyQuantity,
        ]);
    }





    /**
     * Show the form for creating a new resource.
     */










    /**
     * Store a newly created resource in storage.
     */








    /**
     * Display the specified resource.
     */
    public function show_taking()
    {
        $stok = Stok::first();
        $user = Consumer::all();
        return view('show_taking', ['stok' => $stok, 'users' => $user]);
    }





    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bill = Bill::findOrFail($id);
        $user = Consumer::all();
        return view('edit_1', ['users' => $user, 'bills' => $bill]);
    }





    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updata = Bill::findOrFail($id);

        $stok = Stok::firstOrCreate();
        $stok->kgg += $updata->kgg;
        $stok->kg += $updata->kg;
        $stok->save();

        $updata->update([
            "bills" => $request->numberOFlist,
            "kgg" => $request->numberOFhightT,
            "kg" => $request->numberOFhightK,
            "consumer_id" => $request->nameOFtager,
        ]);

        $stok->kgg -= $updata->kgg;
        $stok->kg -= $updata->kg;
        $stok->save();

        return to_route('show_list');
    }



    public function destroy(string $id)
    {
        $bill = Bill::find($id);
        $stok = Stok::firstOrCreate(['id' => 1]);
        $stok->kgg += $bill->kgg;
        $stok->kg += $bill->kg;
        $stok->save();
        $bill->delete();

        return to_route('show_list');
    }
}
