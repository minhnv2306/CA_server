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

    public function test()
    {
        // Create key object for CA
        $CAPrivKey = new RSA();
        $CAPrivKey->loadKey(CertController::privateKey);

        $CApubKey = new RSA();
        $CApubKey->loadKey(CertController::publicKey);



        // create private key / x.509 cert for stunnel / website, subject
        $privKeySubject = new RSA();
        extract($privKeySubject->createKey());
        $privKeySubject->loadKey($privatekey);

        $pubKeySubject = new RSA();
        $pubKeySubject->loadKey($publickey);
        $pubKeySubject->setPublicKey();

        // Subject information
        $subject = new X509();
        $subject->setPublicKey($pubKeySubject);
        $subject->setDNProp('cn', 'Hehe');

        // Information CA
        $issuer = new X509();
        $issuer->setPrivateKey($CAPrivKey);
        $issuer->setPublicKey($CApubKey);
        $issuer->setDNProp('id-at-organizationName', 'HUST');
        $issuer->setDNProp('countryname', 'Vietnam');
        $issuer->setDNProp('commonname', 'Minh NV Cert');

        $x509 = new X509();
        $x509->setSerialNumber(chr(1));
        $x509->makeCA();
        $result = $x509->sign($issuer, $subject);
        $cert = $x509->saveX509($result);
        echo $cert;
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
