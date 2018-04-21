<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://travistidwell.com/jsencrypt/bin/jsencrypt.js"></script>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <form method="POST" action="/form" id="my-form">
                {{csrf_field()}}
                <h1>Hello World!</h1>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                           placeholder="Enter email">
                </div>
                <div class="form-group">
                    <div id="page-wrapper">
                        <div>
                            Your cert
                            <input type="file" id="fileInput">
                        </div>
                        <pre id="fileDisplayArea"></pre>

                    </div>
                </div>
                <input type="hidden" id="text-form" name="text_form">
                <input type="hidden" id="sign-form" name="sign_form">
                <input type="hidden" id="cert" name="cert">
            </form>
            <button type="submit" class="btn btn-primary" id="submit">Submit</button>
        </div>
    </div>
</div>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script src="https://kjur.github.io/jsrsasign/jsrsasign-all-min.js"></script>
<script type="text/javascript">
    // Call this code when the page is done loading.
    // $(function () {
    //     $("form").submit(function (event) {
    //         // Encrypt with the public key...
    //         var encrypt = new JSEncrypt();
    //         encrypt.setPublicKey($('#pubkey').val());
    //         var encrypted = encrypt.encrypt($('#email').val());
    //
    //         console.log(encrypted);
    //         // Decrypt with the private key...
    //         var decrypt = new JSEncrypt();
    //         decrypt.setPrivateKey($('#privkey').val());
    //         var uncrypted = decrypt.decrypt(encrypted);
    //
    //         // Now a simple check to see if the round-trip worked.
    //         if (uncrypted == $('#email').val()) {
    //             alert('It works!!!');
    //             return;
    //         }
    //         else {
    //             alert('Something went wrong....');
    //             event.preventDefault();
    //         }
    //
    //     });
    //
    // });
</script>
<script>
    window.onload = function () {
        var fileInput = document.getElementById('fileInput');
        var fileDisplayArea = document.getElementById('fileDisplayArea');

        fileInput.addEventListener('change', function (e) {
            var file = fileInput.files[0];
            var reader = new FileReader();

            reader.onload = function (e) {
                fileDisplayArea.innerText = reader.result;
                console.log(reader.result.indexOf("\n"));
                console.log($('#fileDisplayArea').html());
                console.log("hehe" + reader.result.substr(reader.result.indexOf("\n")));
            }
            reader.readAsText(file);
        });

    }
</script>
<script>
    /**
     *  Secure Hash Algorithm (SHA1)
     *  http://www.webtoolkit.info/
     **/
    function SHA1(msg) {
        function rotate_left(n,s) {
            var t4 = ( n<<s ) | (n>>>(32-s));
            return t4;
        };
        function lsb_hex(val) {
            var str="";
            var i;
            var vh;
            var vl;
            for( i=0; i<=6; i+=2 ) {
                vh = (val>>>(i*4+4))&0x0f;
                vl = (val>>>(i*4))&0x0f;
                str += vh.toString(16) + vl.toString(16);
            }
            return str;
        };
        function cvt_hex(val) {
            var str="";
            var i;
            var v;
            for( i=7; i>=0; i-- ) {
                v = (val>>>(i*4))&0x0f;
                str += v.toString(16);
            }
            return str;
        };
        function Utf8Encode(string) {
            string = string.replace(/\r\n/g,"\n");
            var utftext = "";
            for (var n = 0; n < string.length; n++) {
                var c = string.charCodeAt(n);
                if (c < 128) {
                    utftext += String.fromCharCode(c);
                }
                else if((c > 127) && (c < 2048)) {
                    utftext += String.fromCharCode((c >> 6) | 192);
                    utftext += String.fromCharCode((c & 63) | 128);
                }
                else {
                    utftext += String.fromCharCode((c >> 12) | 224);
                    utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                    utftext += String.fromCharCode((c & 63) | 128);
                }
            }
            return utftext;
        };
        var blockstart;
        var i, j;
        var W = new Array(80);
        var H0 = 0x67452301;
        var H1 = 0xEFCDAB89;
        var H2 = 0x98BADCFE;
        var H3 = 0x10325476;
        var H4 = 0xC3D2E1F0;
        var A, B, C, D, E;
        var temp;
        msg = Utf8Encode(msg);
        var msg_len = msg.length;
        var word_array = new Array();
        for( i=0; i<msg_len-3; i+=4 ) {
            j = msg.charCodeAt(i)<<24 | msg.charCodeAt(i+1)<<16 |
                msg.charCodeAt(i+2)<<8 | msg.charCodeAt(i+3);
            word_array.push( j );
        }
        switch( msg_len % 4 ) {
            case 0:
                i = 0x080000000;
                break;
            case 1:
                i = msg.charCodeAt(msg_len-1)<<24 | 0x0800000;
                break;
            case 2:
                i = msg.charCodeAt(msg_len-2)<<24 | msg.charCodeAt(msg_len-1)<<16 | 0x08000;
                break;
            case 3:
                i = msg.charCodeAt(msg_len-3)<<24 | msg.charCodeAt(msg_len-2)<<16 | msg.charCodeAt(msg_len-1)<<8  | 0x80;
                break;
        }
        word_array.push( i );
        while( (word_array.length % 16) != 14 ) word_array.push( 0 );
        word_array.push( msg_len>>>29 );
        word_array.push( (msg_len<<3)&0x0ffffffff );
        for ( blockstart=0; blockstart<word_array.length; blockstart+=16 ) {
            for( i=0; i<16; i++ ) W[i] = word_array[blockstart+i];
            for( i=16; i<=79; i++ ) W[i] = rotate_left(W[i-3] ^ W[i-8] ^ W[i-14] ^ W[i-16], 1);
            A = H0;
            B = H1;
            C = H2;
            D = H3;
            E = H4;
            for( i= 0; i<=19; i++ ) {
                temp = (rotate_left(A,5) + ((B&C) | (~B&D)) + E + W[i] + 0x5A827999) & 0x0ffffffff;
                E = D;
                D = C;
                C = rotate_left(B,30);
                B = A;
                A = temp;
            }
            for( i=20; i<=39; i++ ) {
                temp = (rotate_left(A,5) + (B ^ C ^ D) + E + W[i] + 0x6ED9EBA1) & 0x0ffffffff;
                E = D;
                D = C;
                C = rotate_left(B,30);
                B = A;
                A = temp;
            }
            for( i=40; i<=59; i++ ) {
                temp = (rotate_left(A,5) + ((B&C) | (B&D) | (C&D)) + E + W[i] + 0x8F1BBCDC) & 0x0ffffffff;
                E = D;
                D = C;
                C = rotate_left(B,30);
                B = A;
                A = temp;
            }
            for( i=60; i<=79; i++ ) {
                temp = (rotate_left(A,5) + (B ^ C ^ D) + E + W[i] + 0xCA62C1D6) & 0x0ffffffff;
                E = D;
                D = C;
                C = rotate_left(B,30);
                B = A;
                A = temp;
            }
            H0 = (H0 + A) & 0x0ffffffff;
            H1 = (H1 + B) & 0x0ffffffff;
            H2 = (H2 + C) & 0x0ffffffff;
            H3 = (H3 + D) & 0x0ffffffff;
            H4 = (H4 + E) & 0x0ffffffff;
        }
        var temp = cvt_hex(H0) + cvt_hex(H1) + cvt_hex(H2) + cvt_hex(H3) + cvt_hex(H4);

        return temp.toLowerCase();
    }
</script>
<script>
    $(document).ready(function () {
        $("#submit").click(function (e) {
            var file_cert = $('#fileDisplayArea').html();
            var cert = file_cert.substr(file_cert.indexOf("\n"));
            console.log(cert);
            var privateKey = file_cert.substr('0', file_cert.indexOf("\n"));
            var x = SHA1($('#my-form').html());
            $.ajax({
                url: '/checkCert',
                data: {
                  cert: cert,
                },
                type: 'POST',
                success: function (data, status) {
                    if (data == 1) {
                        var rsa = new RSAKey();
                        rsa.readPrivateKeyFromPEMString(privateKey);
                        var hashAlg = 'sha1';
                        var hSig = rsa.sign(x, hashAlg);
                        $("#text-form").val(x);
                        $("#sign-form").val(hSig);
                        $("#cert").val(cert);
                        $("#my-form").submit();
                    }
                }
            });
        })
    })
</script>
</body>
</html>
