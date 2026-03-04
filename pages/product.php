<?php
$selectProducts = mysqli_query($koneksi, "SELECT products.*, categories.category_name 
    FROM products
    LEFT JOIN categories ON products.category_id = categories.id
    ORDER BY products.id DESC");

$rowProducts = mysqli_fetch_all($selectProducts, MYSQLI_ASSOC);

if (isset($_GET['idDel'])) {
  $idDel = $_GET['idDel'];
  // check foto

  $foto = mysqli_query($koneksi, "SELECT product_photo FROM products WHERE id=$idDel");
  $row = mysqli_fetch_assoc($foto);
  unlink("assets/img/" . $row['product_photo']);
  
  $deleteProduct = mysqli_query($koneksi, "DELETE FROM products WHERE id='$idDel'");
  if ($deleteProduct) {
    header("location:?page=product");
  }
}
?>
<div class="card table-responsive">
  <div class="card-header">
    <div class="card-title">
      <h4>Data Produk</h4>
    </div>
  </div>
  <div class="card-body">
    <div align="right">
      <a href="?page=tambah-edit-product" class="btn btn-primary my-2">Tambah Produk Baru</a>
    </div>
    <table class="table table-bordered text-center" id="myTable">
      <thead>
        <tr>
          <th>No</th>
          <th>Kategori</th>
          <th>Nama Produk</th>
          <th>Gambar</th>
          <th>Harga</th>
          <th>Stok</th>
          <th>Tindakan</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($rowProducts as $product) {
        ?>
        <tr>
          <td>
            <?= $no++ ?></td>
          <td><?= $product['category_name'] ?></td>
          <td><?= $product['product_name'] ?></td>
          <td><img src="assets/img/<?= $product['product_photo'] ?> " alt="" width="50"></td>
          <td>Rp. <?= number_format($product['product_price'], 2, ',', '.')  ?></td>
          <td><?= $product['qty'] ?></td>
          <td>
            <a class=" btn btn-success btn-sm" href="?page=tambah-edit-product&id=<?= base64_encode($product['id'])?>">
              Ubah</a>
            <form action="?page=product&idDel=<?= $product['id'] ?>" method="post"
              onclick="return confirm('Apakah anda yakin data ini akan di delete?')" class="d-inline">
              <button class="btn btn-danger btn-sm" href="">Hapus</button>
            </form>
          </td>
        </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</div>