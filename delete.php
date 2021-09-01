<?php
require 'functions.php';

$id = $_GET["id_barang"];

if ( delete($id) > 0 ) {
    echo " <script>
                alert('berhasil');
                document.location.href = 'product.php';
            </script>";
} else {
    echo " <script>
                alert('gagal');
                document.location.href = 'product.php';
            </script>";
}