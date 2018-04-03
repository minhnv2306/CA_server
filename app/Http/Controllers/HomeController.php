<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cert;

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
    public function dashboard()
    {
        return view('dashboard');
    }
    public function index()
    {

        $cert = Cert::find(1)->toJson();
        return view('home', [
            'cert' => json_encode($cert)
        ]);
    }
    public function test(Request $request)
    {
        dd($request->all());
    }
    public function getCA()
    {
        return view('ca');
    }
}
