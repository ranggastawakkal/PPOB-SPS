<?php
require_once "../connection.php";

$product_id = $_POST['product_id'];
// $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';

$harga = "SELECT price FROM tb_product WHERE id = '$product_id'";
$price = mysqli_query($connection, $harga);
$biaya_admin = "SELECT admin_fee FROM tb_category JOIN tb_product WHERE tb_product.category_id = tb_category.id WHERE tb_product.id = '$product_id'";
$admin_fee = mysqli_query($connection, $biaya_admin);

$data_harga = mysqli_fetch_assoc($price);
$data_biaya_admin = mysqli_fetch_assoc($admin_fee);

$total = $data_harga + $data_biaya_admin;

$sql = "INSERT INTO tb_transaction (product_id, price, admin_fee, total) VALUES ('$product_id', '$data_harga', '$data_biaya_admin', '$total')";

$query = mysqli_query($connection, $sql);
if ($query) {
    $status = "OK";
    $msg = "Transaksi berhasil";
} else {
    $status = "Error";
    $msg = "Transaksi gagal";
}

$response = array(
    'status' => $status,
    'msg' => $msg
);
echo json_encode($response);
