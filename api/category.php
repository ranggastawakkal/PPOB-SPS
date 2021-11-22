<?php
require_once "../connection.php";

$id = $_GET['id'];

if (!$id) {
    $sql = "SELECT * FROM tb_category";
} else {
    $sql = "SELECT * FROM tb_category WHERE id = '$id'";
}

$query = mysqli_query($connection, $sql);
$array_data = array();

while ($data = mysqli_fetch_assoc($query)) {
    array_push($array_data, array(
        'ID' => $data['id'],
        'Category' => $data['category_title'],
        'Admin Fee' => $data['admin_fee']
    ));
}
echo json_encode($array_data);
