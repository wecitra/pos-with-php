<?php
    require 'functions.php';
    $keranjang = order("SELECT * FROM keranjang");
    $quantity = order("SELECT SUM(jumlah) FROM keranjang");
    $total = order("SELECT SUM(harga_barang) FROM keranjang");
    $diskon = 10;
    foreach($total as $ttl ) : 
        if ($ttl['SUM(harga_barang)'] >= 50000) {
            $totalDiskon = ($diskon/100) * $ttl['SUM(harga_barang)'];
            $amount = $ttl['SUM(harga_barang)'] - $totalDiskon;
        } else {
            $amount = $ttl['SUM(harga_barang)'];
        }
    endforeach;
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
        .card { border: none; }
        .card img { width: 120px; height: 100px; }
        .quantity, .total { background-color: hsl(180, 40%, 60%); }
        .discount, button { background-color: hsl(180, 90%, 35%); color: #FFFFFF; }
        .col-2 button { width: 100%; height: 100%; border: none; font-size: 1.8rem; font-weight: bold; border-radius: 5px; }
        .col-2 button i { font-size: 2rem; }
        .col-2 button:hover { background-color: hsl(180, 55%, 53%); }
    </style>
</head>
<body>
    <header class="pt-3">
        <h2 class="mb-3 fw-bold text-center fs-1">Starbhak Mart</h2>
        <nav class="text-center p-2">
            <a href="index.php" class="text-white mx-4">Menu</a>
            <a href="cart.php" class="text-white mx-5">Cart</a>
            <a href="product.php" class="text-white mx-4">Product</a>
        </nav>
    </header>
    <main class="mt-3">
        <div class="container d-flex flex-wrap overflow-auto mb-3" style="height: 375px;">
            <?php foreach( $keranjang as $row ) : ?>
                <div class="card text-center" style="width: 8rem;">
                    <img src="img/<?= $row["gambar_barang"]; ?>" class="card-img-top mx-auto">
                    <div class="card-body">
                        <h6 class="card-title fw-bold">
                            <?= $row["nama_barang"]; ?> <sup><?= $row["jumlah"]; ?></sup>
                        </h6>
                        <p><span>RP.</span><?= $row["harga_barang"]; ?></p>
                        <a href="deleteCart.php?id_keranjang=<?= $row["id_keranjang"]; ?>" class="btn fw-bold bg-danger text-white">
                            <i class="bi bi-trash-fill"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-10">
                    <div class="quantity p-1">
                        <?php foreach($quantity as $jml ) : ?>
                            <h6>Quantity: <span><?= $jml['SUM(jumlah)']; ?></span></h6>
                        <?php endforeach; ?>
                    </div>
                    <div class="discount p-1">
                        <h6>Discount: <span><?= $diskon; ?>%</span></h6>
                    </div>
                    <div class="total p-1">
                        <h6>Total Amount: <span><?= $ttl['SUM(harga_barang)']. ' / ' .$diskon . '% = ' . $amount; ?></span></h6>
                    </div>
                </div>
                <div class="col-2">
                    <button type="button" data-bs-target="#paymentModal" data-bs-toggle="modal">
                        <i class="bi bi-credit-card-2-back"></i>
                        PAYMENT
                    </button>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body overflow-auto" style="height: 400px;">
                    <table class="table table-borderless">
                        <tr class="text-center">
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                        <?php foreach( $keranjang as $row ) : ?>
                            <tr class="overflow-auto ps-3 text-center">
                                <td><?= $row["nama_barang"]; ?></td>
                                <td><?= $row["harga_barang"]; ?></td>
                                <td><?= $row["jumlah"]; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <div class="modal-footer">
                    <h3 class="float-start"><?= $amount; ?></h3>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" 
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" 
    integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</body>
</html>