<?php

namespace App\Http\Controllers;

use App\Models\Consumer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Bill;
use App\Models\Impot;
use App\Models\Stok;
use Carbon\Carbon;

    /* 
    storeList
    index_1
    incomingRegistration
    search
    update
    destroy
     */

class AddController extends Controller
{
    /*
     */


    public function incomingRegistration(Request $request)
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

    public function showList(string  $branch)
    {
        $stok = Stok::first();
        $data = Bill::orderBy('created_at', 'desc')->take(5)->get()->where('type_branch', $branch);
        $data->transform(function ($date) {
            $date->formatted_date = Carbon::parse($date->created_at)->locale('ar')->isoFormat('dddd، YYYY-MM-DD');
            return $date;
        });

        return view("show_list", ["stoks" => $stok, "data" => $data ,"branch" => $branch]);
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





    public function create()
    {
        $user = Consumer::all();
        return view('creat_list_user', ['users' => $user]);
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
}
