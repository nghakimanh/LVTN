<?php 
  $title='LỊCH SỬ ĐẶT HÀNG';
  include_once('header.php');
  $makh;
  if(isset($_SESSION['makh']))
    $makh=$_SESSION['makh'];
  
?>

      <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Chi tiết đặt hàng</h1>
              </div>
              <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="lich-su-dat-hang.php?makh=<?php echo $makh?>">Lịch sử đặt hàng</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Chi tiết đặt hàng</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
         <?php
          $madh=0; 
          include('connect.php');
          if(isset($_GET['madh']))
            $madh=$_GET['madh'];

          include('connect.php');
          $sql_dh="select * from DatHang where SoDonDH='$madh' ";
          $ds_dh=$conn->query($sql_dh);
          while($row=$ds_dh->fetch_assoc()){
         
         ?>
          <div class="row">
            <!-- ORDER TOTAL-->
            <div class="col-lg-8 col-md-12">
              <div class="card border-0 rounded-0 p-lg-4 bg-light">
                <div class="card-body">
                  <h5 class="text-uppercase mb-4">Đơn hàng #<?php echo $row["SoDonDH"] ?></h5>
                  <ul class="list-unstyled mb-0">
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between mb-4">
                      <strong class="text-uppercase small font-weight-bold">Ngày đặt hàng</strong>
                      <span class="total-cart"><?php echo $row["NgayDH"] ?></span>
                    </li>
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between mb-4">
                      <strong class="text-uppercase small font-weight-bold">Ngày giao hàng</strong>
                      <span class="total-cart"><?php echo $row["NgayGH"] ?></span>
                    </li>
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between mb-4">
                      <strong class="text-uppercase small font-weight-bold">Tình trạng</strong>
                      <span class="total-cart"><?php if($row["TrangThaiDH"]==0) echo "Chờ xử lý"; else echo"Đã giao hàng" ?></span>
                    </li>
                    
                  </ul>
                </div>
              </div>
            </div>
          <?php
          }
          $conn->close();
          ?>
            <div class="col-lg-12 col-md-12 mb-4 mb-lg-0 mt-2">
              <!-- CART TABLE-->
              <div class="table-responsive mb-4">
                <table class=" table">
                  <thead class="bg-light">
                    <tr>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Sản phẩm</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Giá mua</strong></th>
                      <th class="border-0" scope="col" > <strong class="text-small text-uppercase ">Số lượng</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Thành tiền</strong></th>
                    </tr>
                  </thead>
                  <tbody class="list-cart">
                    <?php 
                      $total=0;
                      include('connect.php');
                      $sql_dh="select * from ChiTietDatHang inner join HangHoa 
                                on ChiTietDatHang.MSHH=HangHoa.MSHH where SoDonDH='$madh' ";
                      $ds_dh=$conn->query($sql_dh);
                      while($row=$ds_dh->fetch_assoc()){
                    ?>
                    <tr class="row-cart">
                      <th class="pl-0 border-0" scope="row">
                        <div class="media align-items-center"><a class="reset-anchor d-block animsition-link" href="chi-tiet-san-pham.php?mahanghoa=<?php echo $row["MSHH"] ?>"><img src= <?php echo "../weekend.admin/".$row["AnhMinhHoa"]?>  alt="Ảnh minh họa" width="70"/></a>
                          <div class="media-body ml-3"><strong class="h6"><a class="reset-anchor animsition-link" href="chi-tiet-san-pham.php?mahanghoa=<?php echo $row["MSHH"] ?>"><?php echo $row["TenHH"] ?></a></strong></div>
                        </div>
                      </th>
                      <td class="align-middle border-0">
                        <p class="price-cart mb-0 small "><?php echo $row["GiaDatHang"] ?></p>
                      </td>
                      <td class="align-middle border-0">
                        <div class="d-flex align-items-center justify-content-between px-3">
                            <p class="total-item-cart mb-0 small "><?php echo $row["SoLuong"] ?></p>                          
                        </div>
                      </td>
                      <td class="align-middle border-0">
                        <p class="total-item-cart mb-0 small "><?php echo $row["GiaDatHang"]* $row["SoLuong"] ?></p>
                      </td>
                    </tr>
                    <?php
                        $total+=$row["GiaDatHang"]* $row["SoLuong"];
                      }
                      $conn->close();
                      ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-lg-6 offset-lg-6 col-md-12">
              <div class="card border-0 rounded-0 p-lg-4 bg-light">
                <div class="card-body">
                  <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-center justify-content-between mb-4">
                      <strong class="text-uppercase small font-weight-bold">Tổng cộng</strong>
                      <span class="total-cart"><?php echo $total ?></span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          
          
          <!-- CART NAV-->
          <div class="bg-light px-4 py-3 mt-2">
            <div class="row align-items-center text-center">
              <div class="col-md-12 col-sm-12 col-12 mb-3 mb-md-0 text-md-left">
                <a class="btn btn-link p-0 text-dark btn-sm" href="lich-su-dat-hang.php?makh=<?php echo $makh?>"><i class="fas fa-long-arrow-alt-left mr-2"> </i>Quay lại</a>
              </div>
          </div>
        </section>
        
      </div>
<?php 
  include_once('footer.php')
?>
