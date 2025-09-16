<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk</title>
</head>
<body>
    <h1>Daftar Produk</h1>
    <?php if (session()->getFlashdata('success')): ?>
        <div style="color: green; border: 1px solid green; padding: 5px; margin-bottom: 10px;">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
    <a href="/products/create">Tambah Produk</a>

    <table border="1" cellpadding="5">
    <tr>
        <th>ID</th><th>Nama</th><th>Harga</th><th>Stok</th><th>Deskripsi</th><th>Gambar</th>
    </tr>
    <?php foreach ($products as $p): ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= $p['name'] ?></td>
        <td><?= $p['price'] ?></td>
        <td><?= $p['stock'] ?></td>
        <td><?= $p['description'] ?></td>
        <td>
            <?php if ($p['image']): ?>
                <img src="/uploads/<?= $p['image'] ?>" width="100">
            <?php else: ?>
                (tidak ada gambar)
            <?php endif; ?>
        </td>
        <td>
                <a href="/products/edit/<?= $p['id'] ?>">Edit</a> | 
                <a href="/products/delete/<?= $p['id'] ?>" onclick="return confirm('Hapus produk?')">Hapus</a>
            </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
