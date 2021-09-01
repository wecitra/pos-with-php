<?php
    require 'functions.php';
    $produk = order("SELECT * FROM produk");

    if( isset($_POST["keyword"])){
        $produk = search($_POST["keyword"]);
    }

    $quantity = order("SELECT SUM(jumlah) FROM keranjang");
    if( isset($_POST["submit"]) ) {
        if( add($_POST) > 0 ) {
            echo " <script>
                        alert('berhasil');
                        document.location.href = 'index.php';
                    </script>";
        } else {
            echo "<script>
                    alert('gagal');
                    document.location.href = 'index.php';
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Starbhak Mart</title>
    <style>
        header { background-color: hsl(180, 90%, 35%); color: #FFFFFF; }
        nav { background-color: hsl(180, 40%, 60%); }
        header a { text-decoration: none; }
        header a:hover { font-weight: bold; border-bottom: solid hsl(180, 90%, 35%); }
        #addon-wrapping { background-color: hsl(180, 55%, 53%); }
        .float-end { background-color: hsl(180, 55%, 53%); }
        tr:first-child { background-color: hsl(180, 90%, 35%); color: #FFFFFF; }
        tr:hover { background-color: hsl(180, 40%, 60%); }
        td img { width: 80px; height: 70px; }
    </style>
</head>
<body>
    <header class="pt-3 fixed-top">
        <h2 class="mb-3 fw-bold text-center fs-1">Starbhak Mart</h2>
        <nav class="text-center p-2">
            <a href="index.php" class="text-white mx-4">Menu</a>
            <a href="cart.php" class="text-white mx-5">Cart 
                <?php foreach($quantity as $jml ) : ?>
                    <span class="badge bg-dark"><?= $jml['SUM(jumlah)']; ?></span>
                <?php endforeach; ?>
            <a href="product.php" class="text-white mx-4">Product</a>
        </nav>
    </header>
    <main class="m-3 mt-4 pt-5">
        <div class="container p-5 mt-4">
            <div class="row my-4">
                <div class="col-10">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">
                            <i class="bi bi-search"></i>
                        </span>
                        <form action="" method="POST">
                            <input type="text" class="form-control d-inline" placeholder="Search..." name="keyword" size="50" autocomplete="off">
                        </form>
                    </div>
                </div>
                <div class="col-2">
                    <a href="newproduct.php" class="btn float-end">New Product</a>
                </div>
            </div>
            <table class="table table-bordered mt-4">
                <tr class="text-center">
                    <th>#</th>
                    <th>Nama</th>
                    <th>Gambar</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
                <?php $i = 1; ?>
                <?php foreach( $produk as $row ) : ?>
                    <tr class="text-center">
                        <td class="my-auto"><?= $i++; ?></td>
                        <td><?= $row["nama_barang"]; ?></td>
                        <td>
                            <img src="img/<?= $row["gambar_barang"]; ?>">
                        </td>
                        <td><?= $row["stok_barang"]; ?></td>
                        <td><?= $row["harga_barang"]; ?></td>
                        <td>
                            <a href="edit.php?id_barang=<?= $row["id_barang"]; ?>" class="btn btn-warning rounded-circle">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <a href="delete.php?id_barang=<?= $row["id_barang"]; ?>" class="btn btn-danger rounded-circle">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
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