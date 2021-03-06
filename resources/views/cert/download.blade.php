<!DOCTYPE html>
<html>
<body>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<h1>
    <a class="btn btn-primary" href="{{route('certs.index')}}">Quay về trang chủ </a>
</h1>

</body>
<script>
    function download(filename, text) {
        var element = document.createElement('a');
        element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
        element.setAttribute('download', filename);

        element.style.display = 'none';
        document.body.appendChild(element);

        element.click();

        document.body.removeChild(element);
    }

    // Generate download of cert.pem file with some content
    var cert = "{!! json_decode($cert) !!}";
    cert = cert.replace('-----BEGIN CERTIFICATE-----', '-----BEGIN CERTIFICATE-----\n');
    cert = cert.replace('-----END CERTIFICATE-----', '\n-----END CERTIFICATE-----');
    var text = "{!! json_decode($private_key) !!}" + "\n" + cert;
    var filecert = 'cert.pem';
    download(filecert, text);
</script>
</html>
