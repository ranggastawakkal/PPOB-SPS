<?php
require_once "../connection.php";

$id = $_GET['id'];

if (!$id) {
    $sql = "SELECT p.product_title, c.category_title, p.price, c.admin_fee FROM tb_product p JOIN tb_category c ON c.id = p.category_id";
} else {
    $sql = "SELECT p.product_title, c.category_title, p.price, c.admin_fee FROM tb_product p JOIN tb_category c ON c.id = p.category_id WHERE p.id = '$id'";
}
$query = mysqli_query($connection, $sql);
$array_data = array();

while ($data = mysqli_fetch_assoc($query)) {
    array_push($array_data, array(
        'Product' => $data['product_title'],
        'Category' => $data['category_title'],
        'Price' => $data['price'],
        'Admin Fee' => $data['admin_fee'],
        'Total' => $data['price'] + $data['admin_fee']
    ));
}

echo json_encode($array_data);
