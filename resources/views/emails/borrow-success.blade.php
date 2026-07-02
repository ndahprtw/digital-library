<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>

    <h2>Peminjaman Berhasil</h2>

    <p>Halo, {{ $borrow->user->name }}</p>

    <p>Peminjaman buku berhasil dilakukan.</p>

    <ul>
        <li>Judul Buku : {{ $borrow->buku->judul }}</li>
        <li>Tanggal Pinjam : {{ $borrow->tanggal_pinjam }}</li>
    </ul>

    <p>Terima kasih.</p>

</body>

</html>