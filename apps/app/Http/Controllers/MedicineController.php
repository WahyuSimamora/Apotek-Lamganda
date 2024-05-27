<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = date("Y-m-d H:i:s");

        $medicines = Medicine::where('stock', '>', '0')->whereDate('expired_date','>',$today)->get();
        // dd($medicines);
        return view('welcome', compact('medicines'));
    }

    public function cari(Request $request)
	{
		// menangkap data pencarian
		$keyword = $request->keyword;

		$medicines = Medicine::where('name', 'LIKE', "%".$keyword."%")->orWhere('description', 'LIKE', "%".$keyword."%")->where('stock', '>', 0)->get();
        return view('welcome', compact('medicines'));
	}

    public function viewById(Request $request)
	{
		// menangkap data pencarian
		$keyword = $request->id;
		$medicines = Medicine::where('id', '=', $keyword)->first();
 
        // dd($authUser = auth()->user());

        return view('medicines.detail', compact('medicines'));
	}
}
