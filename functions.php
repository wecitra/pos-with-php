<?php
    $conn = mysqli_connect("localhost", "root", "", "ujilevel_3");
    function order($query) {
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result) ) {
            $rows[] = $row;
        }
        return $rows;
    }
    function add($data) {
        global $conn;
        $nama =  $data['nama_barang'];
        $harga =  $data['harga_barang'];
        $stok =  $data['stok_barang'];

        // upload gambar
        $gambar = upload();
        if( !$gambar ) {
            return false;
        }

        $query = "INSERT INTO produk (nama_barang, harga_barang, stok_barang, gambar_barang) 
                    VALUES ('$nama', '$harga', '$stok', '$gambar')";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
    function upload() {
        $namaFile = $_FILES["gambar_barang"]['name'];
        $ukuran = $_FILES["gambar_barang"]['size'];
        $error = $_FILES["gambar_barang"]['error'];
        $tmpName = $_FILES["gambar_barang"]['tmp_name'];

        // cek apa ada gambar yg di upload atau tidak, kalau tidak
        if( $error === 4 ){
            echo "<script>
                    alert('pilih gambar dulu');
                </script>";
            return false;
        }

        // hanya gambar yg boleh di upload
        $extensiGambarValid = ['jpg', 'jpeg', 'png'];
        $extensiGambar = explode('.', $namaFile);
        $extensiGambar = strtolower(end($extensiGambar));
        if( !in_array($extensiGambar, $extensiGambarValid) ) {
            echo "<script>
                    alert('bukan gambar');
                </script>";
            return false;
        }

        // jika ukurannya terlalu besar
        if( $ukuran > 1000000) {
            echo "<script>
                    alert('gambar terlalu besar');
                </script>";
            return false;
        }

        // lolos pengecekan, gambar siap di upload

        // generate nama gambar baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.' ;
        $namaFileBaru .= $extensiGambar;
        move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

        return $namaFileBaru;
    }
    function delete($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM produk WHERE id_barang = $id");
        return mysqli_affected_rows($conn);
    }
    function edit($data) {
        // var_dump($data); die;
        global $conn;
        $id =  $data['id_barang'];
        $nama =  $data['nama_barang'];
        $harga =  $data['harga_barang'];
        $stok =  $data['stok_barang'];
        $gambarLama =  $data['gambar_lama'];

        // cek apakah user pilih gambar baru atau tidak
        if( $_FILES['gambar_barang']['error'] === 4 ) {
            $gambar = $gambarLama;
        } else {
            $gambar = upload();
        }
        
        $query = "UPDATE produk SET nama_barang = '$nama', 
                                    harga_barang = '$harga', 
                                    stok_barang = $stok, 
                                    gambar_barang = '$gambar'
                                    WHERE id_barang = $id";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
    function addToCart($data) {
        global $conn;
        $id =  $data['id_barang'];
        $jumlah =  $data['jumlah'];

        $result = mysqli_query($conn, "SELECT nama_barang, harga_barang, gambar_barang FROM produk WHERE id_barang = $id");

        if(!$result) {
            die('Could not get data: ' . mysqli_error());
        }

        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $nama =  $row['nama_barang'];
            $harga =  $row['harga_barang'];
            $gambar = $row['gambar_barang'];
        }
        
        $query = "INSERT INTO keranjang (barang, nama_barang, harga_barang, gambar_barang, jumlah) VALUES ('$id', '$nama', '$harga', '$gambar', $jumlah)";
        
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
    function deleteCart($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM keranjang WHERE id_keranjang = $id");
        return mysqli_affected_rows($conn);
    }
    function search($keyword){
        $query = "SELECT * FROM produk WHERE 
                    nama_barang LIKE '%$keyword%' OR
                    harga_barang LIKE '%$keyword%' OR
                    stok_barang LIKE '%$keyword%'";
        return order($query);
    }
?> 