<?php session_start(); ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Lightbox-->
    <link rel="stylesheet" href="vendor/lightbox2/css/lightbox.min.css">
    <!-- Range slider-->
    <link rel="stylesheet" href="vendor/nouislider/nouislider.min.css">
    <!-- Bootstrap select-->
    <link rel="stylesheet" href="vendor/bootstrap-select/css/bootstrap-select.min.css">
    <!-- Owl Carousel-->
    <link rel="stylesheet" href="vendor/owl.carousel2/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="vendor/owl.carousel2/assets/owl.theme.default.css">
    <!-- Google fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.blue.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="image/favicon.png">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    
    
  </head>
  <body>
    <div class="page-holder">
      <!-- navbar-->
      <header class="header bg-white">
        <div class="container px-0 px-lg-3">
          <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0"><a class="navbar-brand" href="index.php"><span class="font-weight-bold text-uppercase text-dark">WEEKEND </span></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <!-- Link--><a class="nav-link active" href="index.php">Home</a>
                </li>
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" id="pagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shop</a>
                  <div class="dropdown-menu mt-3" aria-labelledby="pagesDropdown">
                    <a class="dropdown-item border-0 transition-link" href="shop.php">Tất cả sản phẩm</a>
                    <!-- Xử lý show danh sách loại hàng -->
                    <?php 
                      include('connect.php');
                      $sql_loaihang="select * from loaihanghoa";
                      $ds_lh=$conn->query($sql_loaihang);
                      while($row=$ds_lh->fetch_assoc()){
                        echo '<a class="dropdown-item border-0 transition-link" href="shop.php?maloaihang='.$row["MaLoaiHang"].'">'.$row["TenLoaiHang"].'</a>';
                      }
                      $conn->close();
                    ?>
                </li>
              </ul>
              <ul class="navbar-nav ml-auto">               
                <li class="nav-item"><a class="nav-link" href="gio-hang.php"> 
                  <i class="fas fa-dolly-flatbed mr-1 text-gray"></i>
                    Giỏ hàng (
                    <small class="text-gray">
                      <span >
                        <!--Số lượng trong giỏ hàng-->
                        <?php 
                           $cart=(isset($_SESSION['cart']))? $_SESSION['cart']: [];
                           $count=0;
                           foreach ($cart as $key => $value){
                             $count+=$value['pd_quantity'];
                           }
                           echo $count;
                        ?>
                      </span>
                    </small>)
                  </a></li>

                <!-- Xử lý hiển thị tài khoản hoặc đăng nhập -->
                <?php 
                   if(isset($_SESSION['makh'])){
                     echo '<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" id="pagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tài khoản</a>
                            <div class="dropdown-menu mt-3" aria-labelledby="pagesDropdown">
                              <a class="dropdown-item border-0 transition-link" href="lich-su-dat-hang.php?makh='.$_SESSION['makh'].'">Lịch sử mua hàng</a>
                              <a class="dropdown-item border-0 transition-link" href="dang-xuat.php">Đăng xuất</a>  
                          </li>';
                    } else
                      echo'<li class="nav-item"><a class="nav-link" href="dang-nhap.php"> <i class="fas fa-user-alt mr-1 text-gray"></i>Đăng nhập</a></li>'
                ?>
              </ul>
            </div>
          </nav>
        </div>
       
      </header>

    