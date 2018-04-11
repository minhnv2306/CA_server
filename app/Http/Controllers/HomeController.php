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
        // create private key / x.509 cert for stunnel / website
        $privKey = new RSA();
        extract($privKey->createKey());
        $privKey->loadKey($privatekey);

        $pubKey = new RSA();
        $pubKey->loadKey($publickey);
        $pubKey->setPublicKey();

        $subject = new X509();
        $subject->setPublicKey($pubKey);
        $subject->setDNProp('id-at-organizationName', 'phpseclib demo cert');
        $subject->setDomain('www.whatever.com');

        $issuer = new X509();
        $issuer->setPrivateKey($privKey);
        $issuer->setDN($subject->getDN());

        $x509 = new X509();
//$x509->setStartDate('-1 month'); // default: now
//$x509->setEndDate('+1 year'); // default: +1 year
//$x509->setSerialNumber(chr(1)); // default: 0

        $result = $x509->sign($issuer, $subject);
        echo "the stunnel.pem contents are as follows: <br/>";
        echo $privKey->getPrivateKey();
        echo "<br/>";
        echo $publickey;
        echo "<br/>";
        echo $x509->saveX509($result);
        echo "<br/>";

        echo "<br>";
        // Check Cert
        $x5091 = new X509();
        $x5091->loadCA(CertController::certCA);
        $cert = $x5091->loadX509($x509->saveX509($result));

        echo $x5091->validateSignature() ? 'valid' : 'invalid';
        echo "<br/>";
        $hehe = new X509();
        $hehe->loadX509('-----BEGIN CERTIFICATE-----
MIICIjCCAYugAwIBAgIBATANBgkqhkiG9w0BAQUFADA4MQ0wCwYDVQQKDARIVVNU
MRAwDgYDVQQGDAdWaWV0bmFtMRUwEwYDVQQDDAxNaW5oIE5WIENlcnQwHhcNMTgw
NDExMDAwMDAwWhcNMTkwNDExMDAwMDAwWjB2MRswGQYDVQQDDBJOZ3V54buFbiBW
xINuIE1pbmgxGjAYBgNVBAgMEUhvw6BuZyBWxINuIFRo4bulMRMwEQYDVQQGDApI
b8OgbmcgTWFpMSYwJAYJKoZIhvcNAQkBDBdtaW5oMTEwMUBnbWFpbC5jb20xMTEx
MTCBnzANBgkqhkiG9w0BAQEFAAOBjQAwgYkCgYEA1zayWWTxToDBrZin7AUMoU7U
53iHG06fA62arFZmLT+2EfhEaYwySQlKxjagQf275qqYoHkGxZIp1hkD2TNvEwiz
4UPMnHrVDHzAZOxtPFcWXeutTYUxQXAdMCzVSPCcKDkr7MnqZiV0O9mrwuQBWj4j
TBunz8YxWVwWZ6s9becCAwEAATANBgkqhkiG9w0BAQUFAAOBgQBhXS7xHO2AehhH
QuGeOsaXkD7gBBoP4R87J8I4rn4qNVUGyyuuDTPtKRMhMwbY3OQZNKmIJyEoRgIm
ToDXAerJaHvY0xFFuiY6ppkw/CT2KNOVcSgJLBkBsjt9c7TjYRkHyX7dVZEtUVJr
A7wVWqG5NA1EuhMX6b50G8ecQ3vhGw==
-----END CERTIFICATE-----');
        echo $hehe->getPublicKey();
    }
    public function getCA()
    {
        return view('ca');
    }
}
