<?php
header("Content-Type: application/json");
include 'config/koneksi.php';

$data = json_decode(file_get_contents("php://input")); //objek ke array

// echo "Data berhasil disimpan"; res.text

if (!$data) {
    echo json_encode([ //array ke objek
        'status' => false,
        'message' => "invalid json"
    ]);
}
$code = $data->code;
$date = $data->date;
$customer_name = $data->customer_name;
$amount = $data->amount;
$order_change = $data->order_change;
$order_pay = $data->order_pay;
$cart = $data->cart;
try {
    $insertOrder = mysqli_query($koneksi, "INSERT INTO orders (code, date, customer_name, amount, order_change, order_status) VALUES ('$code', '$date', '$customer_name', '$amount','$order_change',1)");

    if (!$insertOrder) {
        throw new Exception("Gagal melakukan insert order");
    }

    $id_order = mysqli_insert_id($koneksi); // ambil id terakhir di table orders
    foreach ($cart as $item) {
        $product_id = $item->id;
        $product_qty = $item->qty;
        $product_price = $item->price;
        $subtotal_products = $item->subtotal;

        $insertOrderDetails = mysqli_query($koneksi, "INSERT INTO orderdetails (order_id, product_id, qty, order_price, order_subtotal) VALUES ('$id_order', '$product_id', '$product_qty', '$product_price', '$subtotal_products')");

        if (!$insertOrderDetails) {
            throw new Exception("Gagal menyimpan detail order");
        }

        $updateStock = mysqli_query($koneksi, "UPDATE products SET qty = qty - $product_qty WHERE id = '$product_id'");
    }

    echo json_encode([
        "status" => true,
        "message" => "transaksi berhasil",
        "order_id" => $data->code,
    ]);
} catch (\Throwable $th) {
    echo json_encode([
        "status" => false,
        "message" => $th->getMessage(),
    ]);
}
