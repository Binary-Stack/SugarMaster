<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Bill;
use App\Models\Stok;
use App\Models\Consumer;
use App\Models\Impot;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ActionsController extends Controller
{
    public function storeList(Request $request)
    {
        $valedate = $this->Validator($request, "storeList");
        if ($valedate->fails()) {
            return redirect()->back()->withErrors($valedate)->withInput();
        }

        $path = ($request->hasFile('photo')) ? $request->file('photo')->store('bills_photos', 'public') : null;

        $check = $this->checkQuantity($request, "check");
        if ($check == false) {

            return redirect()->back()->withErrors(['error' => 'المخزون غير كاف'])->withInput();
        }

        $bill = $this->fillingColumns($request, $path);

        return ($bill) ? redirect()->back()->with('success', 'تمت العملية بنجاح!') : redirect()->back()->withErrors(['error' => 'فشلت العملية']);
    }



    public function storeTager(Request $request)
    {
        $request->validate([
            'tager' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-]+$/u'],
        ]);
        Consumer::create([
            "name" => $request->input("tager"),
        ]);
        return to_route("creat_list");
    }


    public function incomingRegistration(Request $request)
    {
        $valedate = $this->Validator($request, "incomingRegistration");

        if ($valedate->fails()) {
            return redirect()->back()->withErrors($valedate)->withInput();
        }
        $result =  $this->checkQuantity($request, "create");

        return ($result) ? redirect()->route('creat_revenuse')->with('success', 'تمت العملية بنجاح!')
            : redirect()->route('creat_revenuse')->withErrors(['error' => 'فشلت العملية']);
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

    public function searchDate(Request $request)
    {
        $request->validate([
            'actionTimestamp' => 'required|date',
        ]);

        return $this->returnExchange($request,  "alone", "total_exchange");
    }


    public function searchDateComprehensive(Request $request)
    {


        return $this->returnExchange($request, "comprehensive", "comprehensive_exchange");
    }


    public function update(Request $request, string $id, string $branch)
    {
        $validatedData = $request->validate([
            'numberOFlist' => 'required|numeric',
            'nameOFtager' => 'required|exists:consumers,id',
            'numberOFhightT' => 'required|numeric|min:0',
            'numberOFhightK' => 'required|numeric|min:0',
            'type_branch' => 'required|in:1,2,3',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $updata = Bill::findOrFail($id);

        $stok = Stok::firstOrCreate();

        $stok->kgg += $updata->kgg;
        $stok->kg += $updata->kg;
        $stok->save();

        $updateData = [
            "bills" => filter_var($request->numberOFlist, FILTER_SANITIZE_NUMBER_INT),
            "kgg" => filter_var($request->numberOFhightT, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            "kg" => filter_var($request->numberOFhightK, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            "user_id" => filter_var($request->nameOFtager, FILTER_SANITIZE_NUMBER_INT),
            "type_branch" => filter_var($request->type_branch, FILTER_SANITIZE_NUMBER_INT)
        ];

        if ($request->hasFile('photo')) {
            if ($updata->images && Storage::disk('public')->exists($updata->images)) {
                Storage::disk('public')->delete($updata->images);
            }

            $photo = $request->file('photo');
            $photoPath = $photo->store('bills_photos', 'public');
            $updateData['images'] = $photoPath;
        }

        $updata->update($updateData);

        $stok->kgg -= $updata->kgg;
        $stok->kg -= $updata->kg;
        $stok->save();

        return to_route('show_list', ['branch' => $branch])->with('success', 'تم تحديث البيانات بنجاح');
    }

    public function destroy(string $id, string $branch)
    {
        $bill = Bill::find($id);
        $bill->delete();

        return to_route('show_list', ['branch' => $branch])->with('success', 'تمت العملية بنجاح!');
    }






    protected function fillingColumns(Request $request, string | null $path)
    {
        $data =  Bill::create([
            "consumer_id" => $request->input("nameOFtager"),
            "type_branch" => $request->input("type_branch"),
            // 'type_list' => $request->filled('type_list') ? $request->input('type_list') : 0,
            "images" => $path,
            "bills" => $request->input("numberOFlist"),
            "kgg" =>   $request->input("numberOFhightT"),
            "kg" =>    $request->input("numberOFhightK"),
        ]);
        return $data;
    }

    protected function Validator(Request $request, string $status): object
    {
        if ($status == "storeList") {
            $valedate =  Validator::make($request->all(), [
                "nameOFtager" => 'required|exists:consumers,id',
                "numberOFlist" => 'required|integer|min:1',
                "type_branch" => 'required|integer|in:1,2,3',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
        return $valedate;
    }

    protected function checkQuantity(Request $request, string $status)
    {
        $stok = Stok::firstOrCreate(['id' => 1]);
        if ($status == "check") {

            if ($stok->kgg < $request->input("numberOFhightT") || $stok->kg < $request->input("numberOFhightT")) {
                return false;
            } else {
                $stok->kgg -= $request->input("numberOFhightT");
                $stok->kg -= $request->input("numberOFhightK");
            }
        } elseif ($status == "create") {
            $stok->kgg += $request->input("toon");
            $stok->kg += $request->input("kg");
        }
        return $stok->save();
    }

    public function returnExchange(Request $request, $status, string $view)
    {
        if ($status == "alone") {
            $bills = Bill::whereDate('created_at', $request->input('actionTimestamp'))
                ->select('kgg', 'type_branch')
                ->get();
        } elseif ($status == "comprehensive") {
            App::setLocale('ar');
            Carbon::setLocale('ar');
            $bills = Bill::selectRaw("
    DATE(created_at) as date_only, 
    SUM(kg) as total_bills,
    COUNT(CASE WHEN type_branch = 1 THEN 1 END) as branch_1,
    COUNT(CASE WHEN type_branch = 2 THEN 1 END) as branch_2,
    COUNT(CASE WHEN type_branch = 3 THEN 1 END) as branch_3
")
                ->groupBy('date_only')
                ->orderByDesc('date_only')
                ->get();
            $bills->transform(function ($item) {
                $carbonDate = Carbon::parse($item->date_only);
                $item->formatted_date = $carbonDate->translatedFormat('l d F Y');
                $item->day_name = $carbonDate->translatedFormat('l');
                return $item;
            });
            return view($view, [
                "bills" => $bills
            ]);
        }

        $total_sales = 0;
        $countBranche_1 = 0;
        $countBranche_2 = 0;
        $countBranche_3 = 0;
        foreach ($bills as $bill) {
            switch ($bill->type_branch) {
                case 1:
                    $countBranche_1++;
                    break;
                case 2:
                    $countBranche_2++;
                    break;
                case 3:
                    $countBranche_3++;
                    break;
            }
            $total_sales += $bill->kgg;
        }
        return view($view, [
            "total_sales" => $total_sales,
            "countBranche_1" => $countBranche_1,
            "countBranche_2" => $countBranche_2,
            "countBranche_3" => $countBranche_3
        ]);
    }
}
