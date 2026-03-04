<?php
include '../config/koneksi.php';
date_default_timezone_set("Asia/Jakarta");

$date = date("Y-m-d H:i:s");
if (isset($_POST['pdf'])) {
    require_once '../assets/vendor/autoload.php';


    $start = $_POST['start_date'];
    $end = $_POST['end_date'];

    $printPDF = mysqli_query($koneksi, "SELECT * FROM orders WHERE order_date BETWEEN '$start' AND '$end'");
    $rows = mysqli_fetch_all($printPDF, MYSQLI_ASSOC);


    $mpdf = new \Mpdf\Mpdf([
        'format' => 'A4',
        'orientation' => 'P'
    ]);
    $html = '<h2 style="text-align:center;">LAPORAN PENJUALAN</h2> 
<hr>
<table border="1" width="100%" cellpadding="8" cellspacing="0">
<tr>
<th>No</th>
<th>Order Code</th>
<th>Order Date</th>
<th>Order Pay</th>
<th>Order Amount</th>
</tr>';
    $no = 1;
    foreach ($rows as $value) {

        $html .= '
    <tr>
    <td>' . $no++ . '</td>
    <td>' . $value['order_code'] . '</td>
    <td>' . $value['order_date'] .  '</td>
    <td>Rp. ' .  number_format($value['order_pay'], 2, ',', '.') . '</td>
    <td>Rp. ' .  number_format($value['order_amount'], 2, ',', '.') . '</td>
    </tr>';
        $total += $value['order_amount'];
    }
    $html .= '
<tr>
<th colspan="4">Total</th>
<td>Rp. ' . number_format($total, 2, ',', '.') . '</td>
</tr>
    </table>
    ';


    $mpdf->WriteHTML($html);
    $mpdf->Output('Laporan-penjualan-' . $date . '.pdf', 'I');
}
if (isset($_POST['excel'])) {
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Laporan-Penjualan-" . $date . ".xls");
    $start = $_POST['start_date'];
    $end = $_POST['end_date'];

    $printExcel = mysqli_query($koneksi, "SELECT * FROM orders WHERE order_date BETWEEN '$start' AND '$end'");
    $rowExcels = mysqli_fetch_all($printExcel, MYSQLI_ASSOC);
?>
    <h2>Laporan Penjualan</h2>
    <table border="1">
        <tr>
            <td>No</td>
            <td>Order Code</td>
            <td>Order Date</td>
            <td>Order Pay</td>
            <td>Order Amount</td>
        </tr>
        <?php
        $no = 1;
        $total = 0;
        foreach ($rowExcels as $value) {
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $value['order_code'] ?></td>
                <td><?= $value['order_date'] ?></td>
                <td><?= $value['order_pay'] ?></td>
                <td><?= $value['order_amount'] ?></td>
            </tr>
        <?php
            $total += $value['order_amount'];
        }
        ?>
        <tr>
            <th colspan="4">Total</th>
            <td><?= $total ?></td>
        </tr>
    </table>


<?php
}
