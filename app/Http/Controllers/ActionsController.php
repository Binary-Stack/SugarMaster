<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Bill;
use App\Models\Stok;
use App\Models\Consumer;
use App\Models\Impot;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ActionsController extends Controller
{
    public function storeList(Request $request)
    {
        $this->Validator($request, "storeList");

        $path = ($request->hasFile('photo')) ? $request->file('photo')->store('images', 'public') : null;

        $this->checkQuantity($request, "check");

        $bill = $this->fillingColumns($request, $path);

        return ($bill) ? redirect()->back()->with('success', 'تمت العملية بنجاح!') : redirect()->back()->withErrors(['error' => 'فشلت العملية']);
    }


    public function incomingRegistration(Request $request)
    {
        $this->Validator($request, "incomingRegistration");
        $this->checkQuantity($request, "create");
        return redirect()->route('creat_revenuse')->with('success', 'تمت العملية بنجاح!');
    }

    public function search(Request $request)
    {

        // @dd($request);

        $request->validate([
            'nameOFtager' => 'required|exists:consumers,id',
        ]);

        $userId = $request->input('nameOFtager');

        $user = Consumer::find($userId);

        $bills = Bill::where('consumer_id', $userId)->get();

        $bills->transform(function ($date) {
            $date->formatted_date = Carbon::parse($date->created_at)->locale('ar')->isoFormat('dddd، YYYY-MM-DD');
            return $date;
        });
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $monthlyBillsCount = Bill::where('consumer_id', $userId)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->count();

        $monthlyQuantity = Bill::where('consumer_id', $userId)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('kg');

        return view('show_list_tager', [
            'user' => $user,
            'bills' => $bills,
            'monthlyBillsCount' => $monthlyBillsCount,
            'monthlyQuantity' => $monthlyQuantity,
        ]);
    }

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






    protected function fillingColumns(Request $request, string | null $path)
    {
        $data =  Bill::create([
            "consumer_id" => $request->input("nameOFtager"),
            "type_branch" => $request->input("type_branch"),
            'type_list' => $request->filled('type_list') ? $request->input('type_list') : 0,
            "images" => $path,
            "bills" => $request->input("numberOFlist"),
            "kgg" =>   $request->input("numberOFhightT"),
            "kg" =>    $request->input("numberOFhightK"),
        ]);
        return $data;
    }

    protected function Validator(Request $request, string $status)
    {
        if ($status == "storeList") {
            $valedate =  Validator::make($request->all(), [
                "nameOFtager" => 'required|exists:consumers,id',
                "numberOFlist" => 'required|integer|min:1',
                "type_branch" => 'required|integer|max:2',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                "type_list" => 'integer|max:1',
                "numberOFhightT" => 'required|numeric|min:0',
                "numberOFhightK" => 'required|numeric|min:0',
            ]);
        } elseif ($status == "incomingRegistration") {
            $valedate = Validator::make($request->all(), [
                "toon" => 'required|numeric|max:250',
                "kg" => 'required|numeric|max:250000',
            ], [
                'toon.required' => 'عذرا: ادخل كميه من فضلك',
                'kg.max' => 'عذرا: انا اقبل بحد اقصي 250طن',
            ]);
        }


        if ($valedate->fails()) {
            return redirect()->back()->withErrors($valedate)->withInput();
        }
    }

    protected function checkQuantity(Request $request, string $status)
    {
        $stok = Stok::firstOrCreate(['id' => 1]);
        if ($status == "check") {

            if ($stok->kgg < $request->input("numberOFhightT") || $stok->kg < $request->input("numberOFhightT")) {
                return redirect()->back()->withErrors(['error' => 'المخزون غير كاف'])->withInput();
            } else {
                $stok->kgg -= $request->input("numberOFhightT");
                $stok->kg -= $request->input("numberOFhightK");
                $stok->save();
            }
        } elseif ($status == "create") {
            $stok->kgg += $request->input("toon");
            $stok->kg += $request->input("kg");
            /* $result = */ $stok->save();
            // return ( $result ) ? to_route('creat_revenuse_1')->with('success', 'تمت العملية بنجاح!') : to_route('creat_revenuse_1')->withErrors(['error' => 'فشلت العملية']);
        }
    }
}
