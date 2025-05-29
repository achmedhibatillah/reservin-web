<!DOCTYPE html>
<html>
<head>
    <title>Registrasi Reservin</title>
</head>
<body>
    <h2>Hello, {{ $data['registrasi_fullname'] }}!</h2>
    <p>Terimakasih telah mendaftar pada layanan Reservin.</p>
    <p>Untuk melanjutkan proses registrasi, silakan klik tombol di bawah ini.</p>
    <a href="{{ url('registrasi/' . $data['registrasi_url']) }}"
        style="
            background-color: blue;
            color: white;
            padding: 5px 20px;
            border-radius:4px;
            text-decoration: none;
        "
    >Lanjutkan registrasi</a>
    <p>Terimakasih!</p>
</body>
</html>