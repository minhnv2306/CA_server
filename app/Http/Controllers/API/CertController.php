<?php

namespace App\Http\Controllers\API;

use App\Models\Cert;
use Illuminate\Http\Request;
use phpseclib\File\X509;
use App\Http\Controllers\Controller;

class CertController extends Controller
{
    const privateKey = '-----BEGIN RSA PRIVATE KEY----- MIICXQIBAAKBgQDG0s64mm9ZLHcCa+IFFYYvcap0xmri9hytJx1O+rI0JFF23bAp K//sWAWgeEvbEBAUGLBKibsJ50iIq+hALoK5O1qy6CIXMoVfiIVqNdA/L3ZWW0yC qNh/uR5IDkoMd2VzWlWa2Ue8ExV1T0AZ2OVu0AYLfS7nF1Uk549BSJNoaQIDAQAB AoGAX9k8ww3gZBLlhItRuLW5rKGVVRpaaPPQu0DCBlMhGbXwd+dDh3WouN1uSP/1 QbQqrCWCx0xCmPGgrBKDsn05kwx6zLKcHtzp/ezWkGTLCJ8oSEH5/zRosnAKIxpc +wNDYKNlXt8/nTNtM2484res2MoqFWJqtywROJcNMAqNZAECQQDzitFa/lyZLOF8 5lfIJlmuzn6ILt9aZ2VO8AqfgOcifCHA+XvL3geULzG/za+pK+pvQQaqxL0mHkBX ACvOnyopAkEA0P5l163Bn7UiDj4i4dzNlN93J/dd7Uo8OtsH92X4+ZbySaDQkEkU XBIDGVaAQQDd23BhbtSW4t6I1rb9TLqUQQJAOoZgexJnJDQh18buz11P7e8Xfxhs eiggs1CB7QSoBqR35AzQEBTCE30n4mTGUswH4UZqGL2Aitl4MrAK1vNuyQJBAMJu Cf0u71VPRBGQCQ+rRa7cfpQ187IQQBxZLP4iZhB9N4b8D0xMUJ6fOzbVXJgc4EmI MXzUVlNVyGRI9Tnu0oECQQDx/DmwAv6dldipvaHX3xwdtNA4yAztmq9o0It4LO0H rh3Wd4ZOXfRdG91jP5XIVVNE2oyu8FYsPXRxazKQRbWU -----END RSA PRIVATE KEY-----';
    const publicKey = '-----BEGIN PUBLIC KEY----- MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDG0s64mm9ZLHcCa+IFFYYvcap0 xmri9hytJx1O+rI0JFF23bApK//sWAWgeEvbEBAUGLBKibsJ50iIq+hALoK5O1qy 6CIXMoVfiIVqNdA/L3ZWW0yCqNh/uR5IDkoMd2VzWlWa2Ue8ExV1T0AZ2OVu0AYL fS7nF1Uk549BSJNoaQIDAQAB -----END PUBLIC KEY-----';
    const certCA = '-----BEGIN CERTIFICATE----- MIICJTCCAY6gAwIBAgIBATANBgkqhkiG9w0BAQUFADA4MQ0wCwYDVQQKDARIVVNU MRAwDgYDVQQGDAdWaWV0bmFtMRUwEwYDVQQDDAxNaW5oIE5WIENlcnQwHhcNMTgw MTAxMDAwMDAwWhcNMjgwMjAxMDAwMDAwWjA4MQ0wCwYDVQQKDARIVVNUMRAwDgYD VQQGDAdWaWV0bmFtMRUwEwYDVQQDDAxNaW5oIE5WIENlcnQwgZ8wDQYJKoZIhvcN AQEBBQADgY0AMIGJAoGBAMbSzriab1ksdwJr4gUVhi9xqnTGauL2HK0nHU76sjQk UXbdsCkr/+xYBaB4S9sQEBQYsEqJuwnnSIir6EAugrk7WrLoIhcyhV+IhWo10D8v dlZbTIKo2H+5HkgOSgx3ZXNaVZrZR7wTFXVPQBnY5W7QBgt9LucXVSTnj0FIk2hp AgMBAAGjPzA9MAsGA1UdDwQEAwIBBjAPBgNVHRMBAf8EBTADAQH/MB0GA1UdDgQW BBQCdfNQ1JNhfl9R7aThW9KWNQvZSTANBgkqhkiG9w0BAQUFAAOBgQDFTMSmVGVu Z9Hs0OvRf2/LL3wffKGoGpH5EMbFmy289+cM9Pvlgxi5wiWDraS4jRtFj0C999si 2mbsYngoacduZxcG/craxBUlldKvgusMcEstO8L4DJhOHyxEgOXi11B1w7Zd93GW 42RPK/K450wmKtzcIJBKl63Og2eDwmHW8A== -----END CERTIFICATE----- ';


    public function checkCert(Request $request)
    {
        $x509 = new X509();
        $x509->loadCA(self::certCA);
        $cert = $x509->loadX509($request->cert);
        if ($x509->validateSignature()) {
            $array = [
                'name' => $cert['tbsCertificate']['subject']['rdnSequence'][0][0]['value']['utf8String'],
                'email' => $cert['tbsCertificate']['subject']['rdnSequence'][4][0]['value']['utf8String'],
            ];

            $certModel = Cert::where('email', $array['email'])->first();
            if (!empty($certModel) && $certModel->status == 1) {
                return self::successResponse($array, 'Response Successfully');
            } else {
                return self::errorResponse([],'Cert have been evicted');
            }

            //return self::successResponse($array, 'Response Successfully');
        } else {
            return self::errorResponse([],'Cert is not found');
        }
    }

    /**
     * Success response
     * @param $data
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data, $message = '')
    {
        return $this->apiResponse(1, $data, $message);
    }
    
    /**
     * Error response
     * @param $data
     * @param $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($data, $message, $code = 0)
    {
        return $this->apiResponse($code, $data, $message);
    }
    
    /**
     * Api response
     * @param $code
     * @param $data
     * @param $message
     * @param array $error
     * @return \Illuminate\Http\JsonResponse
     */
    protected function apiResponse($code, $data, $message, $error = [])
    {
        return \response()->json([
            'result' => $code,
            'current_time' => time(),
            'message' => $message,
            'data' => !empty($data) ? $data : new \stdClass(),
            'error' => !empty($error) ? $error : new \stdClass()
        ]);
    }
}
