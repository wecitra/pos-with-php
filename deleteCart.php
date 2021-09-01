<?php
require 'functions.php';

$id = $_GET["id_keranjang"];

if ( deleteCart($id) > 0 ) {
    echo " <script>
                alert('berhasil');
                document.location.href = 'cart.php';
            </script>";
} else {
    echo " <script>
                alert('gagal');
                document.location.href = 'cart.php';
            </script>";
}