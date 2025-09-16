<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
</head>
<body>
    <h1>Tambah Produk</h1>

    <!-- ALERT SUCCESS -->
    <?php if (session()->getFlashdata('success')): ?>
        <div style="color: green; border: 1px solid green; padding: 5px; margin-bottom: 10px;">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- ALERT ERROR -->
    <?php if (session()->getFlashdata('errors')): ?>
        <div style="color: red; border: 1px solid red; padding: 5px; margin-bottom: 10px;">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach ?>
            </ul>
        </div>
    <?php endif; ?>
    <form action="/products/store" method="post" enctype="multipart/form-data">
        <p>
            <label>Nama Produk:</label><br>
            <input type="text" name="name" value="<?= old('name') ?>" required>
        </p>
        <p>
            <label>Harga:</label><br>
            <input type="number" step="0.01" name="price" value="<?= old('price') ?>" required>
        </p>
        <p>
            <label>Stok:</label><br>
            <input type="number" name="stock" value="<?= old('stock') ?>" required>
        </p>
        <p>
            <label>Deskripsi:</label><br>
            <textarea name="description" cols="30" rows="10"><?= old('description') ?></textarea>
        </p>
        <p>
            <label>Gambar:</label><br>
            <input type="file" name="image" accept="image/*">
        </p>
        <p>
            <button type="submit">Simpan</button>
        </p>
    </form>
</body>
</html>
