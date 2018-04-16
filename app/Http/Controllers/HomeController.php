<?php

namespace App\Http\Controllers;

use App\Models\Cert;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use phpseclib\Crypt\RSA;
use phpseclib\File\X509;
use App\Http\Requests\CertRequest;
use Illuminate\Support\Facades\Auth;

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
        // $data and $signature are assumed to contain the data and the signature

// fetch public key from certificate and ready it
        $pubkeyid = openssl_pkey_get_public("-----BEGIN CERTIFICATE-----
MIIBvTCCASYCCQD55fNzc0WF7TANBgkqhkiG9w0BAQUFADAjMQswCQYDVQQGEwJK
UDEUMBIGA1UEChMLMDAtVEVTVC1SU0EwHhcNMTAwNTI4MDIwODUxWhcNMjAwNTI1
MDIwODUxWjAjMQswCQYDVQQGEwJKUDEUMBIGA1UEChMLMDAtVEVTVC1SU0EwgZ8w
DQYJKoZIhvcNAQEBBQADgY0AMIGJAoGBANGEYXtfgDRlWUSDn3haY4NVVQiKI9Cz
Thoua9+DxJuiseyzmBBe7Roh1RPqdvmtOHmEPbJ+kXZYhbozzPRbFGHCJyBfCLzQ
fVos9/qUQ88u83b0SFA2MGmQWQAlRtLy66EkR4rDRwTj2DzR4EEXgEKpIvo8VBs/
3+sHLF3ESgAhAgMBAAEwDQYJKoZIhvcNAQEFBQADgYEAEZ6mXFFq3AzfaqWHmCy1
ARjlauYAa8ZmUFnLm0emg9dkVBJ63aEqARhtok6bDQDzSJxiLpCEF6G4b/Nv/M/M
LyhP+OoOTmETMegAVQMq71choVJyOFE5BtQa6M/lCHEOya5QUfoRF2HF9EjRF44K
3OK+u3ivTSj3zwjtpudY5Xo=
-----END CERTIFICATE-----
");

// state whether signature is okay or not
        $ok = openssl_verify('aaa', hex2bin('6f7df91d8f973a0619d525c319337741130b77b21f9667dc7d1d74853b644cbe5e6b0e84aacc2faee883d43affb811fc653b67c38203d4f206d1b838c4714b6b2cf17cd621303c21bac96090df3883e58784a0576e501c10cdefb12b6bf887e548f6b07b09ae80d8416151d7dab7066d645e2eee57ac5f7af2a70ee0724c8e47'), $pubkeyid);
        if ($ok == 1) {
            echo "good";
        } elseif ($ok == 0) {
            echo "bad";
        } else {
            echo "ugly, error checking signature";
        }
        //return view('test');
    }

    public function getCA()
    {
        return view('ca');
    }
    public function form(Request $request)
    {
        dd($request->all());
    }
}
