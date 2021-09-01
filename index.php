<?php
    require 'functions.php';
    $produk = order("SELECT * FROM produk");
    $jumlah = order("SELECT SUM(jumlah) FROM keranjang");

    if( isset($_POST["submit"]) ) {
        if( addToCart($_POST) > 0 ) {
            echo "<script>
                        document.location.href = 'index.php';
                    </script>";
        } else {
            echo "<script>
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
    <title>Starbhak Mart</title>
    <style>
        header { background-color: hsl(180, 90%, 35%); color: #FFFFFF; }
        nav { background-color: hsl(180, 40%, 60%); }
        header a { text-decoration: none; }
        header a:hover { font-weight: bold; border-bottom: solid hsl(180, 90%, 35%); }
        .card { border: none; }
        .card img { width: 120px; height: 100px; }
        button.btn { background-color: hsl(180, 90%, 35%); width: 90%; }
        .card:hover button.btn { background-color: hsl(180, 55%, 53%); }
        input[type="number"] { height: 30px; width: 70px; margin-left: 17px; }
    </style>
</head>
<body>
    <header class="pt-3 fixed-top">
        <h2 class="mb-3 fw-bold text-center fs-1">Starbhak Mart</h2>
        <nav class="text-center p-2">
            <a href="index.php" class="text-white mx-4">Menu</a>
            <a href="cart.php" class="text-white mx-5">Cart 
                <?php foreach($jumlah as $jml ) : ?>
                    <span class="badge bg-dark"><?= $jml['SUM(jumlah)']; ?> </span>
                <?php endforeach; ?>
            </a>
            <a href="product.php" class="text-white mx-4">Product</a>
        </nav>
    </header>
    <main class="m-3 mt-5 pt-5">
        <div class="container d-flex flex-wrap overflow-auto mt-4 pt-3" style="height: 495px;">
            <?php foreach( $produk as $row ) : ?>
                <div class="card text-center" style="width: 8.5rem;">
                    <img src="img/<?= $row["gambar_barang"]; ?>" class="card-img-top mx-auto">
                    <div class="card-body">
                        <h6 class="card-title fw-bold">
                            <?= $row["nama_barang"]; ?>(<?= $row["stok_barang"]; ?>)
                        </h6>
                        <p>
                            <span>RP.</span>
                            <?= $row["harga_barang"]; ?>
                        </p>
                        <form action="" method="post">
                            <input type="hidden" name="id_barang" value="<?= $row["id_barang"]; ?>">
                            <input type="number" class="form-control mb-3" name="jumlah" size="20" min="1">
                            <button class="btn mx-2 fw-bold text-white" type="submit" name="submit">Buy</button>
                        </form>
                    </div>
                </div>
                |
            <?php endforeach; ?>
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