<?php

namespace App\Http\Controllers;

use App\Cert;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use phpseclib\Crypt\RSA;
use phpseclib\File\X509;
use Illuminate\Support\Facades\Auth;

class CertController extends Controller
{
    const privateKey = '-----BEGIN RSA PRIVATE KEY----- MIICXQIBAAKBgQDG0s64mm9ZLHcCa+IFFYYvcap0xmri9hytJx1O+rI0JFF23bAp K//sWAWgeEvbEBAUGLBKibsJ50iIq+hALoK5O1qy6CIXMoVfiIVqNdA/L3ZWW0yC qNh/uR5IDkoMd2VzWlWa2Ue8ExV1T0AZ2OVu0AYLfS7nF1Uk549BSJNoaQIDAQAB AoGAX9k8ww3gZBLlhItRuLW5rKGVVRpaaPPQu0DCBlMhGbXwd+dDh3WouN1uSP/1 QbQqrCWCx0xCmPGgrBKDsn05kwx6zLKcHtzp/ezWkGTLCJ8oSEH5/zRosnAKIxpc +wNDYKNlXt8/nTNtM2484res2MoqFWJqtywROJcNMAqNZAECQQDzitFa/lyZLOF8 5lfIJlmuzn6ILt9aZ2VO8AqfgOcifCHA+XvL3geULzG/za+pK+pvQQaqxL0mHkBX ACvOnyopAkEA0P5l163Bn7UiDj4i4dzNlN93J/dd7Uo8OtsH92X4+ZbySaDQkEkU XBIDGVaAQQDd23BhbtSW4t6I1rb9TLqUQQJAOoZgexJnJDQh18buz11P7e8Xfxhs eiggs1CB7QSoBqR35AzQEBTCE30n4mTGUswH4UZqGL2Aitl4MrAK1vNuyQJBAMJu Cf0u71VPRBGQCQ+rRa7cfpQ187IQQBxZLP4iZhB9N4b8D0xMUJ6fOzbVXJgc4EmI MXzUVlNVyGRI9Tnu0oECQQDx/DmwAv6dldipvaHX3xwdtNA4yAztmq9o0It4LO0H rh3Wd4ZOXfRdG91jP5XIVVNE2oyu8FYsPXRxazKQRbWU -----END RSA PRIVATE KEY-----';
    const publicKey = '-----BEGIN PUBLIC KEY----- MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDG0s64mm9ZLHcCa+IFFYYvcap0 xmri9hytJx1O+rI0JFF23bApK//sWAWgeEvbEBAUGLBKibsJ50iIq+hALoK5O1qy 6CIXMoVfiIVqNdA/L3ZWW0yCqNh/uR5IDkoMd2VzWlWa2Ue8ExV1T0AZ2OVu0AYL fS7nF1Uk549BSJNoaQIDAQAB -----END PUBLIC KEY-----';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certs = Cert::get();

        return view('cert.index', compact('certs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cert.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Cert $cert)
    {

        $now = Carbon::now();
        $startDay = $now->year . '/' . $now->month . '/'. $now->day;
        switch ($request->deadline) {
            case 1:
                $endYear = $now->year + 1;
                break;
            case 2:
                $endYear = $now->year + 2;
                break;
            case 3:
                $endYear = $now->year + 3;
                break;
        }

        $endDay = $endYear . '/' . $now->month . '/'. $now->day;
        $CAPrivKey = new RSA();
        $CAPrivKey->loadKey(CertController::privateKey);

        $pubKey = new RSA();
        $pubKey->loadKey(CertController::publicKey);

        // Information CA

        $subject = new X509();
        $subject->setPublicKey($pubKey);
        $subject->setDNProp('id-at-organizationName', 'HUST');
        $subject->setDNProp('countryname', 'Vietnam');
        $subject->setDNProp('commonname', 'Minh NV Cert');

        $CASubject = $subject->getDN();

        // create private key / x.509 cert for stunnel / website
        // Ký cho các đối tượng nào
        $privKeySubject = new RSA();
        extract($privKeySubject->createKey());
        $privKeySubject->loadKey($privatekey);

        try {
            /* Ghi ra USB
            $myfile = fopen("H:\privatekey.txt", "w");
            fwrite($myfile, $privatekey);
            fclose($myfile);
            */

            $pubKeySubject = new RSA();
            $pubKeySubject->loadKey($publickey);
            $pubKeySubject->setPublicKey();

            $subject = new X509();
            $subject->setPublicKey($pubKeySubject);
            $subject->setDNProp('cn', $request->name);
            $subject->setDNProp('state', $request->district);
            $subject->setDNProp('id-at-organizationName', $request->note);
            $subject->setDNProp('countryname', $request->ward);
            $subject->setDNProp('st', $request->city);
            $subject->setDNProp('id-emailaddress', $request->email);
            $subject->setDNProp('o', $request->organizationname);

            $issuer = new X509();
            $issuer->setPrivateKey($CAPrivKey);
            $issuer->setDN($CASubject);

            $x509 = new X509();
            $x509->setStartDate($startDay);
            $x509->setEndDate($endDay);
            $x509->setSerialNumber(chr(1));


            $result = $x509->sign($issuer, $subject);
//            echo "the stunnel.pem contents are as follows:\r\n\r\n";
//            echo "<br>";
//            echo $privKeySubject->getPrivateKey();
//            echo "\r\n";
//            echo "<br>";
            $data =  $x509->saveX509($result);
            $cert->create([
                'content' => $data,
                'email' => $request->email,
                'customer_name' => $request->name,
                'user_id' => Auth::user()->id
            ]);

            return redirect()->route('certs.index')->with('messages', 'Thêm thành công');
        } catch (Exception $e) {
            dd($e);
            echo "Hay ket noi voi USB";
            return redirect()->route('certs.index')->with('errors', 'Thêm thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cert $cert)
    {
        return view('cert.show', compact('cert'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
