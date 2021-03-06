<?php

namespace App\Http\Controllers;

use App\Models\Cert;
use App\Models\Comment;
use App\Models\Province;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use phpseclib\Crypt\RSA;
use phpseclib\File\X509;
use App\Http\Requests\CertRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Ward;
use App\Models\Commune;

class CertController extends Controller
{
    const privateKey = '-----BEGIN RSA PRIVATE KEY----- MIICXQIBAAKBgQDG0s64mm9ZLHcCa+IFFYYvcap0xmri9hytJx1O+rI0JFF23bAp K//sWAWgeEvbEBAUGLBKibsJ50iIq+hALoK5O1qy6CIXMoVfiIVqNdA/L3ZWW0yC qNh/uR5IDkoMd2VzWlWa2Ue8ExV1T0AZ2OVu0AYLfS7nF1Uk549BSJNoaQIDAQAB AoGAX9k8ww3gZBLlhItRuLW5rKGVVRpaaPPQu0DCBlMhGbXwd+dDh3WouN1uSP/1 QbQqrCWCx0xCmPGgrBKDsn05kwx6zLKcHtzp/ezWkGTLCJ8oSEH5/zRosnAKIxpc +wNDYKNlXt8/nTNtM2484res2MoqFWJqtywROJcNMAqNZAECQQDzitFa/lyZLOF8 5lfIJlmuzn6ILt9aZ2VO8AqfgOcifCHA+XvL3geULzG/za+pK+pvQQaqxL0mHkBX ACvOnyopAkEA0P5l163Bn7UiDj4i4dzNlN93J/dd7Uo8OtsH92X4+ZbySaDQkEkU XBIDGVaAQQDd23BhbtSW4t6I1rb9TLqUQQJAOoZgexJnJDQh18buz11P7e8Xfxhs eiggs1CB7QSoBqR35AzQEBTCE30n4mTGUswH4UZqGL2Aitl4MrAK1vNuyQJBAMJu Cf0u71VPRBGQCQ+rRa7cfpQ187IQQBxZLP4iZhB9N4b8D0xMUJ6fOzbVXJgc4EmI MXzUVlNVyGRI9Tnu0oECQQDx/DmwAv6dldipvaHX3xwdtNA4yAztmq9o0It4LO0H rh3Wd4ZOXfRdG91jP5XIVVNE2oyu8FYsPXRxazKQRbWU -----END RSA PRIVATE KEY-----';
    const publicKey = '-----BEGIN PUBLIC KEY----- MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDG0s64mm9ZLHcCa+IFFYYvcap0 xmri9hytJx1O+rI0JFF23bApK//sWAWgeEvbEBAUGLBKibsJ50iIq+hALoK5O1qy 6CIXMoVfiIVqNdA/L3ZWW0yCqNh/uR5IDkoMd2VzWlWa2Ue8ExV1T0AZ2OVu0AYL fS7nF1Uk549BSJNoaQIDAQAB -----END PUBLIC KEY-----';
    const certCA = '-----BEGIN CERTIFICATE----- MIICJTCCAY6gAwIBAgIBATANBgkqhkiG9w0BAQUFADA4MQ0wCwYDVQQKDARIVVNU MRAwDgYDVQQGDAdWaWV0bmFtMRUwEwYDVQQDDAxNaW5oIE5WIENlcnQwHhcNMTgw MTAxMDAwMDAwWhcNMjgwMjAxMDAwMDAwWjA4MQ0wCwYDVQQKDARIVVNUMRAwDgYD VQQGDAdWaWV0bmFtMRUwEwYDVQQDDAxNaW5oIE5WIENlcnQwgZ8wDQYJKoZIhvcN AQEBBQADgY0AMIGJAoGBAMbSzriab1ksdwJr4gUVhi9xqnTGauL2HK0nHU76sjQk UXbdsCkr/+xYBaB4S9sQEBQYsEqJuwnnSIir6EAugrk7WrLoIhcyhV+IhWo10D8v dlZbTIKo2H+5HkgOSgx3ZXNaVZrZR7wTFXVPQBnY5W7QBgt9LucXVSTnj0FIk2hp AgMBAAGjPzA9MAsGA1UdDwQEAwIBBjAPBgNVHRMBAf8EBTADAQH/MB0GA1UdDgQW BBQCdfNQ1JNhfl9R7aThW9KWNQvZSTANBgkqhkiG9w0BAQUFAAOBgQDFTMSmVGVu Z9Hs0OvRf2/LL3wffKGoGpH5EMbFmy289+cM9Pvlgxi5wiWDraS4jRtFj0C999si 2mbsYngoacduZxcG/craxBUlldKvgusMcEstO8L4DJhOHyxEgOXi11B1w7Zd93GW 42RPK/K450wmKtzcIJBKl63Og2eDwmHW8A== -----END CERTIFICATE----- ';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!isset($request->status)) {
            $certs = Cert::getAllCerts();
        } else {
            $certs = Cert::getCertWithStatus($request->status);
        }
        return view('cert.index', [
            'certs' => $certs,
        ]);
    }
    public function getMyCert(Request $request)
    {
        if (!isset($request->status)) {
            $certs = Cert::getAllCerts(Auth::user());
        } else {
            $certs = Cert::getCertWithStatus($request->status, Auth::user());
        }
        return view('cert.my-cert', [
            'certs' => $certs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = Province::get(['name', 'matp']);
        $wards = Ward::where('matp', $provinces[0]->matp)->get();
        $communes = Commune::where('maqh', $wards[0]->maqh)->get();

        return view('cert.create', [
            'provinces' => $provinces,
            'wards' => $wards,
            'communes' => $communes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CertRequest $request, Cert $cert)
    {
        $now = Carbon::now();
        $startDay = $now->year . '/' . $now->month . '/' . $now->day;
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

        $endDay = $endYear . '/' . $now->month . '/' . $now->day;
        DB::beginTransaction();
        try {
            // Get address
            $province = Province::where('matp', $request->province_id)->first();
            $ward = Ward::where('maqh', $request->ward_id)->first();
            $commune = Commune::where('xaid', $request->commune_id)->first();
            $organizationname = empty($request->organizationname) ? '' : $request->organizationname;
            $certModel = Cert::create([
                'email' => $request->email,
                'customer_name' => $request->name,
                'user_id' => Auth::user()->id,
                'phone_number' => $request->phone_number,
                'identification_card' => $request->identification_card,
                'date_create_id_cart' => $request->date_create_id_cart,
                'where_create_id_cart' => $request->where_create_id_cart,
                'organizationname' => $organizationname,
                'address' => $commune->name . ', ' . $ward->name . ', ' . $province->name,
            ]);

            // Create key object for CA
            $CAPrivKey = new RSA();
            $CAPrivKey->loadKey(CertController::privateKey);

            $CApubKey = new RSA();
            $CApubKey->loadKey(CertController::publicKey);

            // create private key / x.509 cert for stunnel / website, subject
            $privKeySubject = new RSA();
            $key = $privKeySubject->createKey();
            $privKeySubject->loadKey($key['privatekey']);

            $pubKeySubject = new RSA();
            $pubKeySubject->loadKey($key['publickey']);
            $pubKeySubject->setPublicKey();

            // Subject information
            $subject = new X509();
            $subject->setPublicKey($pubKeySubject);
            $subject->setDNProp('givenname', $request->name);
            $subject->setDNProp('commonname', $commune->name);
            $subject->setDNProp('localityname', $ward->name);
            $subject->setDNProp('description', $request->note);
            $subject->setDNProp('provincename', $province->name);
            $subject->setDNProp('emailaddress', $request->email);
            $subject->setDNProp('organizationalunitname', $request->organizationname);

            // Information CA
            $issuer = new X509();
            $issuer->setPrivateKey($CAPrivKey);
            $issuer->setPublicKey($CApubKey);
            $issuer->setDNProp('id-at-organizationName', 'HUST');
            $issuer->setDNProp('countryname', 'Vietnam');
            $issuer->setDNProp('commonname', 'Minh NV Cert');

            $x509 = new X509();
            $x509->setStartDate($startDay);
            $x509->setEndDate($endDay);
            $x509->setSerialNumber(chr($certModel->id));
            $x509->makeCA();
            $privatekey = str_replace("\r","",$key['privatekey']);
            $privatekey = str_replace("\n", "", $privatekey);
            $result = $x509->sign($issuer, $subject);
//            echo "the stunnel.pem contents are as follows:\r\n\r\n";
//            echo "<br>";
//            echo $privKeySubject->getPrivateKey();
//            echo "\r\n";
//            echo "<br>";

            $cert = $x509->saveX509($result);

            $certModel->update([
                'content' => $cert
            ]);

            $cert = str_replace("\n","",$cert);
            $cert = str_replace("\r","",$cert);
            DB::commit();
            return view('cert.download', [
                'private_key' => json_encode($privatekey),
                'cert' => json_encode($cert)
            ]);
            //return redirect()->route('certs.index')->with('messages', 'Thêm thành công');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('certs.index')->with('errors', 'Thêm thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cert $cert)
    {
        $comments = $cert->comments;
        $x509 = new X509();
        $x509->loadCA(self::certCA);
        $certInfor = $x509->loadX509($cert->content);

        $myCert = new X509();
        $myCert->loadX509($cert->content);
        $key = $myCert->getPublicKey();
        // print_r($certInfor['tbsCertificate']['subjectPublicKeyInfo']['subjectPublicKey']);
        // echo "<br>";
        // Check Cert
        // echo $x509->validateSignature() ? 'valid' : 'invalid';

        return view('cert.show', compact('cert', 'certInfor', 'comments', 'key'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            $cert = Cert::find($request->id);
            $status_current = $cert::getDetailStatus($cert->status);
            $cert->update([
                'status' => $request->status
            ]);
            Comment::create([
                'content' => setComment($status_current, Cert::getDetailStatus($request->status), $request->note),
                'cert_id' => $request->id,
                'user_id' => Auth::user()->id,
            ]);
            DB::commit();
            return redirect()->back()->with('messages', 'Cập nhật trạng thái thành công');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('errors', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cert $cert)
    {
        DB::beginTransaction();
        try {
            $cert->update([
                'status' => 0,
            ]);
            Comment::create([
                'content' => 'Thu hồi',
                'cert_id' => $cert->id,
                'user_id' => Auth::user()->id,
            ]);
            DB::commit();
            return redirect()->route('certs.index')->with('messages', 'Thu hồi thành công');
        } catch (Exception $ex) {
            DB::rollback();
            return redirect()->route('certs.index')->with('errors', 'Không thể thu hồi');
        }
    }

    /*
     * Filter order by order status
     * input: status(0: cancel, 1: pending, 2: shipping, 3: complete)
     * output: json (list order)
     */
    public function getListByStatus($status)
    {
        if ($status == 2) {
            $certs = Cert::get(['id', 'email', 'customer_name', 'identification_card', 'status', 'created_at']);
        } else {
            $certs = Cert::where('status', $status)
                ->get(['id', 'email', 'customer_name', 'identification_card', 'status', 'created_at']);
        }
        return response()->json($certs->toArray());
    }
    public function filter(Request $request)
    {
        $date1 = explode("/",$request->startDate);
        $date2 = explode("/",$request->endDate);

        $start_day = Carbon::create(intval($date1[2]), intval($date1[1]), intval($date1[0]), 0, 0, 0)->startOfDay();
        $end_day = Carbon::create(intval($date2[2]), intval($date2[1]), intval($date2[0]), 0, 0, 0)->endOfDay();

        $certs = Cert::getCertBetweenDay($start_day, $end_day);
        return view('cert.index', [
            'certs' => $certs,
        ]);
    }

    public function checkCert(Request $request)
    {
        $x509 = new X509();
        $x509->loadCA(self::certCA);
        $x509->loadX509('-----BEGIN CERTIFICATE-----
MIICNzCCAaCgAwIBAgIBATANBgkqhkiG9w0BAQUFADA4MQ0wCwYDVQQKDARIVVNUMRAwDgYDVQQGDAdWaWV0bmFtMRUwEwYDVQQDDAxNaW5oIE5WIENlcnQwHhcNMTgwNDIxMDAwMDAwWhcNMTkwNDIxMDAwMDAwWjCBijEbMBkGA1UEAwwSTmd1eeG7hW4gVsSDbiBNaW5oMRowGAYDVQQIDBFIb8OgbmcgVsSDbiBUaOG7pTETMBEGA1UEBgwKSG/DoG5nIE1haTEnMCUGCSqGSIb3DQEJAQwYbWluaDExMDJAZ21haWwuY29tYWFhYXNkMREwDwYDVQQKDAhQYWRpdGVjaDCBnzANBgkqhkiG9w0BAQEFAAOBjQAwgYkCgYEA5wVXYBNdpzDcEzIQO1NlJLBWMG1qoET2a9+FFFDHqls2xk0jqL4MNnXVVFjKhyyL1LruH9e6a5cYz8OeHT4r8xSr2eMNbwyWSrR7uUw3kbY+qOIY/yWXMuDZf0ZwQWVvFHcpQVAfjCUs9awCnwoRqYk4gEwwgDm6kqoA9JoJp2UCAwEAATANBgkqhkiG9w0BAQUFAAOBgQBGNObdjSqr3bafHqHw5MFxnn+dWOiOgoou9xboepRbI7flf/b+Q782PCbk4QmVh0ajhCJRHCxPaI3xLZ5o6A2Db5cEgdOA7oC/8TqwEiYDasSCq1IpeejV6zc6vn13UDvVG6GEmap4F+krBIGkgec24c3HKyja6a+6z266frrVaQ==
-----END CERTIFICATE-----');
        return $x509->validateSignature() ? 1 : 0;
    }
}
