<?php 
  $title='CHI TIẾT SẢN PHẨM';
  include_once('header.php')
?>
      
      <section class="py-5">
        <div class="container">
          <div class="row mb-5">
            <!-- PRODUCT SLIDER-->
            <?php
                $malh=0; 
                include('connect.php');
                if(isset($_GET['mahh']))
                  $mahh=$_GET['mahh'];

                $sql_hh="select *from hanghoa inner join loaihanghoa on hanghoa.MaLoaiHang= loaihanghoa.MaLoaiHang where MSHH=$mahh ";
                $hh=$conn->query($sql_hh);
                while($row=$hh->fetch_assoc()){
                  $malh=$row["MaLoaiHang"];
            ?>
            <div class="col-lg-5 mb-5">
              <div class="row m-sm-0">
                <div class="col-sm-12 order-1 order-sm-2">
                  <div class="owl-carousel product-slider" data-slider-id="1">
                    <a class="d-block" href=<?php echo "../weekend.admin/".$row["AnhMinhHoa"] ?> data-lightbox="product" title="<?php echo $row["TenHH"] ?>">
                      <img class="img-fluid" id="anhminhhoa" src=<?php echo "../weekend.admin/".$row["AnhMinhHoa"] ?> alt="anhsanpham"></a>
                  </div>
                </div>
              </div>
            </div>
            <!-- PRODUCT DETAILS-->
            <div class="col-lg-7">
              <h1 id="name-product"><?php echo $row["TenHH"] ?></h1>
              <p class="text-muted lead " id="price-product"><?php echo number_format($row["Gia"], 0, ',', '.') ?> đ</p>
              <p class="text-small mb-4" ><?php echo $row["GhiChu"] ?></p>
                <!-- Form add to cart-->
              <form action="" method="post">
                <div class="row align-items-stretch mb-4">
                    <div class="col-lg-5 col-md-5 col-sm-5 pr-sm-0">
                      <div class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white">
                        <span class="small text-uppercase text-gray mr-2 no-select">Số lượng</span>
                        <div class="quantity ">
                          <a class="dec-btn p-0"><i class="fas fa-caret-left"></i></a>
                            <input name="quantity" class="form-control border-0 shadow-0 p-0 " type="number" id="num-cart-input" value="1">
                          <a class="inc-btn p-0"><i class="fas fa-caret-right"></i></a> 
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-5 pl-sm-0">
                      <button name="add-to-cart" type="submit" class=" btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0" id="add-cart-btn" >Thêm vào giỏ hàng</button>
                    </div>
                </div>
                <input type="text" name="id" value="<?php echo $row["MSHH"] ?>"hidden>
                <input type="text" name="name" value="<?php echo $row["TenHH"] ?>"hidden>
                <input type="text" name="img" value="<?php echo $row["AnhMinhHoa"] ?>"hidden>
                <input type="text" name="price" value="<?php echo $row["Gia"] ?>"hidden>
                <input type="text" name="stored" value="<?php echo $row["SoLuongHang"] ?>"hidden>
              </form>
              <ul class="list-unstyled small d-inline-block">
                <li class="px-3 py-2 mb-1 bg-white"><strong class="text-uppercase">KHO:</strong><span class="ml-2 text-muted"><strong><?php echo $row["SoLuongHang"] ?></strong></span></li>
                <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">LOẠI SẢN PHẨM:</strong><span class="reset-anchor ml-2" href="#"><?php echo $row["TenLoaiHang"] ?></span></li>
                <li class="px-3 py-2 mb-1 bg-white text-muted"><strong class="text-uppercase text-dark">TÌNH TRẠNG:</strong>
                  <span class="reset-anchor ml-2" href="#">
                    <?php 
                      if($row["SoLuongHang"]==0) 
                        echo 'Hết hàng';
                      else{
                        if($row["TinhTrang"]==1) echo 'Đang bán';
                        else echo "Ngừng bán";
                      }
                    ?>
                  </span>
                </li>
              </ul>
            </div>
            
          </div>
          <?php 
            }
            if(isset($_POST['add-to-cart'])){
              $id=$_POST["id"];
              $name=$_POST["name"];
              $quantity=(int)$_POST["quantity"];
              $price=$_POST["price"];
              $img=$_POST["img"];
              $stored=(int)$_POST["stored"];
              if($quantity ==''||$quantity<1||$quantity> $stored){
                echo '
                  <div class="row pb-3">
                    <div class="col-12 text-center">
                      <span class="text-danger" ><strong> Vui lòng chọn số lượng hợp lệ</strong></span>
                    </div>
                  </div> ';
              }
              else{
                
                //unset($_SESSION['cart']);
                if(isset($_SESSION['cart'][$id])){
                  $_SESSION['cart'][$id]['pd_quantity'] +=$quantity;
                 
                }
                else{
                  $product=array(
                    'pd_id'=>$id,
                    'pd_name'=>$name,
                    'pd_quantity'=>$quantity,
                    'pd_price'=> $price,
                    'pd_img'=>$img,
                    'pd_stored'=>$stored,
                  );
                  $_SESSION['cart'][$id]=$product;
                 
                }
                 echo "<meta http-equiv='refresh' content='0'>";
              }
            }
          ?>
          <div class="bg-light px-4 py-3">
            <div class="row align-items-center text-center">
              <div class="col-md-6 col-sm-6 mb-3 mb-md-0 text-md-left"><a class="btn btn-link p-0 text-dark btn-sm" href="shop.php"><i class="fas fa-long-arrow-alt-left mr-2"> </i>Tiếp tục mua sắm</a></div>
              <div class="col-md-6 col-sm-6 text-md-right"><a class="btn btn-outline-dark btn-sm" href="gio-hang.php">Đi đến giỏ hàng<i class="fas fa-long-arrow-alt-right ml-2"></i></a></div>
            </div>
          </div>
        </div>
      </section>
      <!-- <script src="js/addcart.js" async></script> -->
      <?php 
        $conn->close();
        include_once('footer.php')
      ?>

      