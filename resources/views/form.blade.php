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
                <button type="submit" class="btn btn-primary" id="submit">Submit</button>
            </form>
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
    $(document).ready(function () {
        $("#submit").click(function (e) {
            e.preventDefault();
            var file_cert = $('#fileDisplayArea').html();
            var cert = file_cert.substr(file_cert.indexOf("\n"));
            console.log(cert);
            $.ajax({
                url: '/checkCert',
                data: {
                  cert: cert,
                },
                type: 'POST',
                success: function (data, status) {
                    if (data == 1) {

                    }
                }
            });
        })
    })
</script>
</body>
</html>
