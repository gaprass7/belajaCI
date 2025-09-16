<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
</head>
<body>
    <h1>Edit Produk</h1>

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
    <form action="/products/update/<?= $product['id'] ?>" method="post" enctype="multipart/form-data">
        <label>Nama:</label>
        <input type="text" name="name" value="<?= old('name', $product['name']) ?>"><br>

        <label>Deskripsi:</label>
        <textarea name="description"><?= old('description', $product['description']) ?></textarea><br>

        <label>Harga:</label>
        <input type="number" name="price" value="<?= old('price', $product['price']) ?>" ><br>

        <label>Stok:</label>
        <input type="number" name="stock" value="<?= old('stock', $product['stock']) ?>"><br><br>

        <label>Gambar:</label>
        <?php if ($product['image']): ?>
            <img src="/uploads/<?= $product['image'] ?>" width="100"><br>
        <?php endif; ?>
        <input type="file" name="image"><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
