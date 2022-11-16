<?php 
  $title='LỊCH SỬ ĐẶT HÀNG';
  include_once('header.php')
?>

      <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Lịch sử đặt hàng</h1>
              </div>
              <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Lịch sử đặt hàng</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
          <h2 class="h5 text-uppercase mb-4">Đơn hàng chờ xử lý</h2>
          <div class="row">
            <div class="col-lg-12 col-md-12 mb-4 mb-lg-0 mt-2">
              <!-- CART TABLE-->
              <div class="table-responsive mb-4">
                <table class=" table">
                  <thead class="bg-light">
                    <tr>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Mã đơn hàng</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Ngày đặt hàng</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Tổng tiền</strong></th>
                    </tr>
                  </thead>
                  <tbody class="list-cart">
                    <?php 
                    include('connect.php');
                    $makh=$_GET["makh"];
                    $sql_dh="select DatHang.SoDonDH, DatHang.NgayDH, ct.TongTien from DatHang inner join KhachHang on DatHang.MSKH= KhachHang.MSKH
                                                    inner join (select SoDonDH, sum(Soluong *GiaDatHang) as tongtien from chitietdathang
                                                                group by SoDonDH) ct 
                                                    on ct.SoDonDH= DatHang.SoDonDH
                                                  where KhachHang.MSKH='$makh' and DatHang.TrangThaiDH='0';";
                    $ds_dh=$conn->query($sql_dh);
                    while($row=$ds_dh->fetch_assoc()){
                       
                    ?>
                    <tr class="row-cart">
                      <th class="pl-0 border-0" scope="row">
                        <div class="media align-items-center">
                          <div class="media-body ml-3">
                            <strong class="h6">
                              <a class="reset-anchor animsition-link" href="chi-tiet-dat-hang.php?madh=<?php echo $row["SoDonDH"] ?>">
                                <?php echo $row["SoDonDH"] ?></a>
                            </strong>
                          </div>
                        </div>
                      </th>
                      <td class="align-middle border-0">
                        <p class="price-cart mb-0 small "><?php echo $row["NgayDH"] ?></p>
                      </td>
                      <td class="align-middle border-0">
                        <div class="d-flex align-items-center justify-content-between px-3">
                            <p class="total-item-cart mb-0 small "><?php echo $row["TongTien"]  ?></p>                          
                        </div>
                      </td>
                    </tr>
                    <?php
                    }
                    $conn->close();

                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          
          
          <!-- CART NAV-->
          <div class="bg-light px-4 py-3 mt-2">
            <div class="row align-items-center text-center">
              <div class="col-md-12 col-sm-12 col-12 mb-3 mb-md-0 text-md-left">
                <a class="btn btn-link p-0 text-dark btn-sm" href="shop.php"><i class="fas fa-long-arrow-alt-left mr-2"> </i>Tiếp tục mua sắm</a>
              </div>
          </div>
        </section>
        <section class="py-5">
          <h2 class="h5 text-uppercase mb-4">Lịch sử đặt hàng</h2>
          <div class="row">
            <div class="col-lg-12 col-md-12 mb-4 mb-lg-0">
              <!-- CART TABLE-->
              <div class="table-responsive mb-4">
                <table class=" table">
                  <thead class="bg-light">
                    <tr>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Mã đơn hàng</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Ngày đặt hàng</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Ngày giao hàng</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Tổng tiền</strong></th>
                    </tr>
                  </thead>
                  <tbody class="list-cart">
                    <?php 
                    include('connect.php');
                    $makh=$_GET["makh"];
                    $sql_dh="select DatHang.SoDonDH, DatHang.NgayDH, DatHang.NgayGH, ct.TongTien from DatHang inner join KhachHang on DatHang.MSKH= KhachHang.MSKH
                                                    inner join (select SoDonDH, sum(Soluong *GiaDatHang) as tongtien from chitietdathang
                                                                group by SoDonDH) ct 
                                                    on ct.SoDonDH= DatHang.SoDonDH
                                                  where KhachHang.MSKH='$makh' and DatHang.TrangThaiDH='1';";
                    $ds_dh=$conn->query($sql_dh);
                    while($row=$ds_dh->fetch_assoc()){
                       
                    ?>
                    <tr class="row-cart">
                      <th class="pl-0 border-0" scope="row">
                        <div class="media align-items-center">
                          <div class="media-body ml-3">
                            <strong class="h6">
                              <a class="reset-anchor animsition-link" href="chi-tiet-dat-hang.php?madh=<?php echo $row["SoDonDH"] ?>">
                                <?php echo $row["SoDonDH"] ?></a>
                            </strong>
                          </div>
                        </div>
                      </th>
                      <td class="align-middle border-0">
                        <p class="price-cart mb-0 small "><?php echo $row["NgayDH"] ?></p>
                      </td>
                      <td class="align-middle border-0">
                        <p class="price-cart mb-0 small "><?php echo $row["NgayGH"] ?></p>
                      </td>
                      <td class="align-middle border-0">
                        <div class="d-flex align-items-center justify-content-between px-3">
                            <p class="total-item-cart mb-0 small "><?php echo $row["TongTien"]  ?></p>                          
                        </div>
                      </td>
                    </tr>
                    <?php
                    }
                    $conn->close();

                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            
          </div>
        </section>
      </div>
<?php 
  include_once('footer.php')
?>
