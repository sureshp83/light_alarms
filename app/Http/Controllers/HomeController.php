<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route("new-products.index");
    }

    public function getContactUs(){
        $data['user']=\Auth::guard()->user();
        $data['agency_detail']=\App\Models\Agency::find($data['user']->agency_id);

        return view('pages.contact_us',$data);
    }
}
