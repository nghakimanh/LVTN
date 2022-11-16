<?php 
  $title='WEEKEND | TRANG CHỦ';
  include_once('header.php')
?>
      
      
    
      <!-- HERO SECTION-->
      <div class="container">
        <section class="hero pb-3 bg-cover bg-center d-flex align-items-center" style="background: url(image/banner3.jpg)">
          <div class="container py-5">
            <div class="row px-4 px-lg-5">
              <div class="col-lg-6">
                <p class="text-muted small text-uppercase mb-2">New Collection 2021</p>
                <h1 class="h2 text-uppercase mb-3">BEST GIFT FOR YOU</h1><a class="btn btn-dark" href="shop.php">Mua ngay</a>
              </div>
            </div>
          </div>
        </section>
        <!-- CATEGORIES SECTION-->
        <section class="pt-5">
          <header class="text-center">
            <p class="small text-muted small text-uppercase mb-1">Bộ sưu tập hàng đầu của Weekend</p>
            <h2 class="h5 text-uppercase mb-4">Lựa chọn tốt nhất cho bạn</h2>
          </header>
          <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
              <a class="category-item" href="shop.php"><img class="img-fluid" src="image/vong-tay-poster.jpg" alt="">
                <strong class="category-item-title">shop </strong>
              </a>
            </div>
            <div class="col-md-4 mb-4 mb-md-0">
              <a class="category-item mb-4" href="shop.php"><img class="img-fluid" src="image/nhan-poster.jpg" alt="">
                <strong class="category-item-title">shop </strong>
              </a>
              <a class="category-item" href="shop.php"><img class="img-fluid" src="image/day-chuyen-poster.jpg" alt="">
                <strong class="category-item-title">shop </strong></a>
            </div>
            <div class="col-md-4">
              <a class="category-item" href="shop.php"><img class="img-fluid" src="image/bong-tai-poster.jpg" alt="">
                <strong class="category-item-title">shop </strong>
              </a>
            </div>
          </div>
        </section>
        <!-- TRENDING PRODUCTS-->
        <section class="py-5">
          <header>
            <p class="small text-muted small text-uppercase mb-1">Gia công tinh tế</p>
            <h2 class="h5 text-uppercase mb-4">BEST STELLER</h2>
          </header>
          
          <div class="row">
            <?php 
                include('connect.php');
                $sql_best="select * from  HangHoa hh inner join
                          (select MSHH, Sum(SoLuong)as TongSoLuongBan 
                            from ChiTietDatHang 
                            where SoDonDH in(select SoDonDH from DatHang where TrangThaiDH=1)
                            group by MSHH
                            ORDER BY TongSoLuongBan  DESC
                            limit 4) ct
                          on ct.MSHH=hh.MSHH";
                $ds_hh=$conn->query($sql_best);
                while($row=$ds_hh->fetch_assoc()){
            ?>
            <!-- PRODUCT-->
              <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="product text-center">
                  <div class="position-relative mb-3">
                    <div class="badge text-white badge-"></div><a class="d-block" href="chi-tiet-san-pham.php?mahh=<?php echo $row["MSHH"]?>"><img class="img-fluid w-100" src="<?php echo "../weekend.admin/".$row["AnhMinhHoa"] ?>" alt="ảnh minh họa"></a>
                    <div class="product-overlay">
                      <ul class="mb-0 list-inline">
                        <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="chi-tiet-san-pham.php?mahh=<?php echo $row["MSHH"]?>">XEM CHI TIẾT</a></li>
                      </ul>
                    </div>
                  </div>
                  <h6> <a class="reset-anchor" href="chi-tiet-san-pham.php?mahh=<?php echo $row["MSHH"]?>"><?php echo $row["TenHH"]?></a></h6>
                  <p class="small text-muted"><?php echo $row["Gia"]?> đ</p>
                </div>
              </div>
            <?php } $conn->close() ?>
          </div>
        </section>
       
        <!-- SERVICES-->
        <section class="py-5 bg-light mb-5">
          <div class="container">
            <div class="row text-center">
              <div class="col-lg-4 mb-3 mb-lg-0">
                <div class="d-inline-block">
                  <div class="media align-items-end">
                    <svg class="svg-icon svg-icon-big svg-icon-light">
                      <use xlink:href="#delivery-time-1"> </use>
                    </svg>
                    <div class="media-body text-left ml-3">
                      <h6 class="text-uppercase mb-1">Free shipping</h6>
                      <p class="text-small mb-0 text-muted">Free shipping worlwide</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 mb-3 mb-lg-0">
                <div class="d-inline-block">
                  <div class="media align-items-end">
                    <svg class="svg-icon svg-icon-big svg-icon-light">
                      <use xlink:href="#helpline-24h-1"> </use>
                    </svg>
                    <div class="media-body text-left ml-3">
                      <h6 class="text-uppercase mb-1">PHỤ VỤ 24 x 7 </h6>
                      <p class="text-small mb-0 text-muted">Làm việc cả chủ nhật và ngày lễ</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="d-inline-block">
                  <div class="media align-items-end">
                    <svg class="svg-icon svg-icon-big svg-icon-light">
                      <use xlink:href="#label-tag-1"> </use>
                    </svg>
                    <div class="media-body text-left ml-3">
                      <h6 class="text-uppercase mb-1">ƯU ĐÃI HẤP DẪN</h6>
                      <p class="text-small mb-0 text-muted">Ưu đãi cho thành viên mới</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php 
        include_once('footer.php')
      ?>