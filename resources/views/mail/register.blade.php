<html>
    <head></head>
    <body>
        <div>Registrasi berhasil, data UMKM kamu sedang diverifikasi.</div>
        <div>Mohon menunggu maksimal 5 hari kerja.</div>
        <div>Berikut ini data yang kamu daftarkan, mohon untuk menginformasikan kepada kami jika terdapat kesalahan</div>
        <p>nama UMKM: {{$register->name}}</p>
        <p>email: {{$register->email}}</p>
        <p>tempat: {{$register->place}}</p>
        <p>nomor wa: {{$register->wa}}</p>
        <p>instagram: {{$register->ig}}</p>
        <footer>Terima kasih</footer>
    </body>
</html>