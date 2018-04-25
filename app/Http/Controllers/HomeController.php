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
        $pubkeyid = openssl_pkey_get_public("-----BEGIN CERTIFICATE-----MIICIjCCAYugAwIBAgIBATANBgkqhkiG9w0BAQUFADA4MQ0wCwYDVQQKDARIVVNUMRAwDgYDVQQGDAdWaWV0bmFtMRUwEwYDVQQDDAxNaW5oIE5WIENlcnQwHhcNMTgwNDE3MDAwMDAwWhcNMTkwNDE3MDAwMDAwWjB2MRswGQYDVQQDDBJOZ3V54buFbiBWxINuIE1pbmgxGjAYBgNVBAgMEUhvw6BuZyBWxINuIFRo4bulMRMwEQYDVQQGDApIb8OgbmcgTWFpMSYwJAYJKoZIhvcNAQkBDBdtaW5oMTEwMkBnbWFpbC5jb21hc2RhZDCBnzANBgkqhkiG9w0BAQEFAAOBjQAwgYkCgYEA44rFR0xoIyGC9nE4FKuQ9I8Jr0J1oWZPRDbo0pjXSb+LbofCL0Z8doskBaW4nASHPk7+Yrr0KVumCXwRFRbwad1goBmq+LFMCGqeWU3ny/uTiURTwNWOV/nZg9BuvJHWIAeJsmYFChGE5yaH9TwXdLquYUO3PiTOQtC/5lxqnc0CAwEAATANBgkqhkiG9w0BAQUFAAOBgQBnZXizvw08GIStbp1bOa4f3wH5ZyzvpiZtrV6DKAC95Q4uPYUYBaQMQpBIgZDfHZIl94W5EQTWexJ7NDBrzMQWn0oUvw/8VNGRzR8gv0D8s6kZXnBz6eByE4p04q9xOdsIPWKaJG7qSgZhVaoGuoG3vrlgU/SNMdWVqZDvopvAGw==-----END CERTIFICATE-----
");
        dd($pubkeyid);

// state whether signature is okay or not
        $ok = openssl_verify('aaa', hex2bin('95619e8623866ae06a2c908a4a0a7e56d0bf83763f0055cf5d8c38066655a871da18f29be8bd0e8f48076355d6cf19f39171839925c247d026f7e6b35ea921f4de567ad6bdb3c1ecfb758343040d8c93c2d7a3ace433824e95f672390c5649162618228754fa7e2d5f30c1122e40c4a0af9771c4832ce06de17cc1c86326cc95'), $pubkeyid);
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
        // $data and $signature are assumed to contain the data and the signature
// fetch public key from certificate and ready it
        $pubkeyid = openssl_pkey_get_public($request->cert);
// state whether signature is okay or not
        $ok = openssl_verify($request->text_form, hex2bin($request->sign_form), $pubkeyid);
        if ($ok == 1) {
            echo "good";
        } elseif ($ok == 0) {
            echo "bad";
        } else {
            echo "ugly, error checking signature";
        }
    }

    public function getApi($uri, $params = [])
    {
        $url = $uri;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'cURL Request',
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => http_build_query($params)
        ));
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }
    public function getApiCheck()
    {
        $param['cert'] = '-----BEGIN CERTIFICATE-----
MIICHTCCAYagAwIBAgIBATANBgkqhkiG9w0BAQUFADA4MQ0wCwYDVQQKDARIVVNU
MRAwDgYDVQQGDAdWaWV0bmFtMRUwEwYDVQQDDAxNaW5oIE5WIENlcnQwHhcNMTgw
NDIxMDAwMDAwWhcNMTkwNDIxMDAwMDAwWjBxMRswGQYDVQQDDBJOZ3V54buFbiBW
xINuIE1pbmgxGjAYBgNVBAgMEUhvw6BuZyBWxINuIFRo4bulMRMwEQYDVQQGDApI
b8OgbmcgTWFpMSEwHwYJKoZIhvcNAQkBDBJtaW5oMTEwMUBnbWFpbC5jb20wgZ8w
DQYJKoZIhvcNAQEBBQADgY0AMIGJAoGBALRRt2QKRGko7pHuJNcaybhD4qHeVRKy
OCVWP0mqmebs2jLdw1ZCCV3VO98OqLuc+ZuBO2fHdcD3cH5YyTUCpaKhvmYyOdqq
VHx2WS4eEeWdRZSIqq8rkotkvdQNwIwcIgLwz6MQFO5MDMVCSjpiseb50lgm3jSD
n/920+5oOKo1AgMBAAEwDQYJKoZIhvcNAQEFBQADgYEAMhY+XTniEBvtQqLG0pjR
2+Vy3UhEHrpttpxS6qyTWjvc5b3SPL1mxQF4lCuIpoT7GH37bV6hVmB8g8BSZKWH
fj2SXJ0Ju5vU1O2j1YUTmyfbkpF139uM4BJBM/AngfTYj0UapynAw2RsMs6bpy0f
pyQTtwsBbwtKiNYmKIjq3ao=
-----END CERTIFICATE-----';
        $uri = 'http://cert.local/api/v1/check-cert';
        $homeAboutUs = self::getApi($uri, $param);
        $data = json_decode($homeAboutUs, true);
        dd($data);
    }
}
