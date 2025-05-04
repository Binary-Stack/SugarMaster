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
    public function showList(string  $branch = "1")
    {
        $stok = Stok::first();
        $data = Bill::where('type_branch', $branch)
    ->orderBy('created_at', 'desc')
    ->get();
        $data->transform(function ($date) {
            $date->formatted_date = Carbon::parse($date->created_at)->locale('ar')->isoFormat('dddd، YYYY-MM-DD');
            return $date;
        });

        return view("show_list", ["stoks" => $stok, "data" => $data ,"branch" => $branch]);
    }



    public function create()
    {
        $user = Consumer::all();
        return view('creat_list_user', ['users' => $user]);
    }
    public function show_taking()
    {
        $stok = Stok::first();
        $user = Consumer::all();
        return view('show_taking', ['stok' => $stok, 'users' => $user]);
    }

    public function edit(string $id)
    {
        $bill = Bill::findOrFail($id);
        $user = Consumer::all();
        return view('edit_1', ['users' => $user, 'bills' => $bill]);
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
}
