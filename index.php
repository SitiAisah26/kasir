<?php
session_start();

if(!isset($_SESSION["data_barang"])){
    $_SESSION["data_barang"] = array();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn-submit'])){
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];
    $total = $harga * $jumlah;

    $_SESSION['data_barang'][] = array(
        "nama" => $nama,
        "harga" => $harga,
        "jumlah" => $jumlah,
        "total" => $total
    );
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn-delete'])) {
    $index = $_POST['delete-index'];
    unset($_SESSION['data_barang'][$index]);
    $_SESSION['data_barang'] = array_values($_SESSION['data_barang']);
    header("Location: " . $_SERVER['PHP_SELF']);
    exite();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <div class="form-container">
            <h3 class="text-center">Masukan Data Barang</h3>
            <form action="" method="post">
                <div class="input-container d-flex gap-2">
                    <input class="form-control" type="text" name="nama" placeholder="Masukan Nama Barang" required/>
                    <input class="form-control" type="text" name="harga" placeholder="Masukan Harga Barang" required/>
                    <input class="form-control" type="text" name="jumlah" placeholder="Masukan Jumlah Barang" required/>
                </div>
                <div class="btn-collapse mt-2">
                    <button class="btn btn-primary" type="submit" name="btn-submit">Tambah +</button>
                </div>
            </form>
        </div>
        <hr>
        <p>List Barang</p>
        <table class="table table-bordered table-stripped-columns">
            <thead>
                <tr class="table-container" style="text-align: center;">
                    <th scope="col">No</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php
                if (isset($_SESSION["data_barang"]) && is_array($_SESSION["data_barang"]) && !empty($_SESSION["data_barang"])){
                $nomor = 1;
                foreach ($_SESSION["data_barang"] as $index => $barang) {
                    $total = $barang['harga'] * $barang['jumlah'];
                    echo "<tr style='text-align: center;'>";
                    echo "<td>$nomor</td>";
                    echo "<td>" . $barang['nama'] . "</td>";
                    echo "<td>" . $barang['harga'] . "</td>";
                    echo "<td>" . $barang['jumlah'] . "</td>";
                    echo "<td>$total</td>";
                    echo "<td>
                        <form method='post' class='d-inline-block'>
                            <input type='hidden' name='delete-index' value='$index'>
                            <button class='btn btn-danger btn-sm' type='submit' name='btn-delete'>Delete</button>
                        </form>
                    </td>";
                    echo "</tr>";
                    $nomor++;
                }
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>