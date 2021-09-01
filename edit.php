<?php
    require 'functions.php';
    $id = $_GET["id_barang"];
    $produk = order("SELECT * FROM produk WHERE id_barang = $id")[0];
    if( isset($_POST["submit"]) ) {
        if( edit($_POST) > 0 ) {
            echo " <script>
                        alert('berhasil');
                        document.location.href = 'product.php';
                    </script>";
        } else {
            echo "<script>
                    alert('gagal');
                    document.location.href = 'product.php';
                </script>";
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Starbhak Mart</title>
    <style>
        header { background-color: hsl(180, 90%, 35%); color: #FFFFFF; }
        nav { background-color: hsl(180, 40%, 60%); }
        header a { text-decoration: none; }
        header a:hover { font-weight: bold; border-bottom: solid hsl(180, 90%, 35%); }
        .btn { background-color: hsl(180, 55%, 53%); width: 100%; }
        form img { width: 90px; height: 80px;}
    </style>
</head>
<body>
    <header class="pt-3 fixed-top">
        <h2 class="mb-3 fw-bold text-center fs-1">Starbhak Mart</h2>
        <nav class="text-center p-2">
            <a href="index.php" class="text-white mx-4">Menu</a>
            <a href="cart.php" class="text-white mx-5">Cart <span class="badge bg-dark">4</span></a>
            <a href="product.php" class="text-white mx-4">Product</a>
        </nav>
    </header>
    <main class="m-3 mt-4 pt-5">
        <div class="container p-5 mt-4">
            <h2 class="fw-bold text-center mb-3">Edit Product</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" class="form-control" id="id" name="id_barang" value="<?= $produk["id_barang"]; ?>">
                <input type="hidden" class="form-control" id="id" name="gambar_lama" value="<?= $produk["gambar_barang"]; ?>">
                <div class="mb-3">
                    <label for="nama_barang" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $produk["nama_barang"]; ?>">
                </div>
                <div class="mb-3">
                    <label for="harga_barang" class="form-label">Harga</label>
                    <input type="text" class="form-control" id="harga_barang" name="harga_barang" value="<?= $produk["harga_barang"]; ?>">
                </div>
                <div class="mb-3">
                    <label for="stok_barang" class="form-label">Stok</label>
                    <input type="number" class="form-control" id="stok_barang" name="stok_barang" value="<?= $produk["stok_barang"]; ?>">
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="gambar_barang" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="gambar_barang" name="gambar_barang">
                        </div>
                        <div class="col-2 text-center">
                            <img src="img/<?= $produk["gambar_barang"]; ?>">
                        </div>
                    </div>
                </div>
                <button class="btn" type="submit" name="submit">Submit</button>
            </form>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" 
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" 
    integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>
</html>