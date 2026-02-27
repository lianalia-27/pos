<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
</button> -->

<?php
date_default_timezone_set("Asia/Jakarta");
$datetime = date("Y-m-d H:i:s");

$tempOrderCode = 'INV-' . date('Ymd-His')

?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row" style="border: 1px solid blue; padding: 10px">
                        <div class="col-md-4">
                            <label for="" class="form-label">Order Code</label>
                            <input type="text" id="modal-order-code" class="form-control" value="<?= $tempOrderCode ?>" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="" class="form-label">Order Date</label>
                            <input type="text" id="modal-order-date" class="form-control" value="<?= $datetime ?>" disabled>
                        </div>
                    </div>
                    <div class="row my-3" style="border: 1px solid blue; padding: 10px">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Product Name</th>
                                        <th>QTY</th>
                                        <th>Order Price</th>
                                        <th>Order Subtotal</th>
                                        <th>Counting</th>
                                    </tr>
                                </thead>
                                <tbody id="modal-order-items">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5">Total</th>
                                        <td id="modal-total">Rp. 0</td>
                                    </tr>
                                    <tr>
                                        <th colspan="5">Pay</th>
                                        <td><input type="number" id="pay-amount" class="form-control" value="0" required></td>
                                    </tr>
                                    <tr>
                                        <th colspan="5">Change</th>
                                        <td id="change-amount">Rp. 0</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-save-order">Save changes</button>
            </div>
        </div>
    </div>
</div>