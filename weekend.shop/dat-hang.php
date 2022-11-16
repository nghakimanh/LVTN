<?php 
  $title='THANH TOÁN';
  include_once('header.php');
 
?>

      <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">ĐẶT HÀNG</h1>
              </div>
              <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="cart.php">Giỏ hàng</a></li>
                    <li class="breadcrumb-item active" aria-current="page">ĐẶT HÀNG</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
          <!-- BILLING ADDRESS-->
          
          <div class="row mb-3">
              <?php
                if( !isset($_SESSION['makh'])){
                  echo' <div class="col-lg-12 form-group">
                    <div class="custom-control pl-0">
                      <a href="dang-nhap.php">
                        <span class="custom-control-span text-uppercase" >
                          Đăng nhập nếu đã từng mua hàng
                        </span>
                      </a>
                    </div>
                  </div>';
                }
              ?>
          </div>
         
          <div class="row">
            <!-- ORDER SUMMARY-->
            <div class="col-lg-6 ">
              <div class="card border-0 rounded-0 p-lg-4 bg-light">
                <div class="card-body">
                  <h5 class="text-uppercase mb-4">Thanh toán</h5>
                  <ul class="list-unstyled mb-0">
                  <!--Xử lý thanh toán-->
                    <?php 
                      $total=0;
                      $product_total=0;
                      foreach ($cart as $key => $value){
                        $product_total=$value['pd_price']*$value['pd_quantity'];
                        $total+=$product_total;
                        echo' <li class="d-flex align-items-center justify-content-between">
                                <strong class="small font-weight-bold">'.$value['pd_name'].'</strong>
                                <span class="text-muted small">'.$product_total.'đ</span></li>
                              <li class="border-bottom my-2"></li>';
                      }
                      echo'<li class="d-flex align-items-center justify-content-between">
                            <strong class="text-uppercase small font-weight-bold">Tổng cộng</strong>
                            <span>'.$total.' đ</span></li>';
                   ?>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-12 pt-5">
              <h2 class="h5 text-uppercase mb-4">Thông tin giao hàng</h2>
            </div>
            <div class="col-lg-12 form-group">
              <span class="text-small ">(*) Thông tin bắt buộc nhập</span>
            </div>
            <?php 
              include('connect.php');
              if( isset($_SESSION['makh'])){
                $makh= $_SESSION['makh'];
                $sql_kh="select * from KhachHang inner join DiaChiKH on KhachHang.MSKH = DiaChiKH.MSKH where KhachHang.MSKH='$makh'";
                $kh=$conn->query($sql_kh);
                while($row=$kh->fetch_assoc()){
                  
            ?>
              <div class="col-12">
               <form action="" method="GET">
                <div class="row">
                  <!-- Họ tên -->
                  <div class="col-lg-12 form-group">
                    <label class="text-small text-uppercase" for="name">Họ và tên (*)</label>
                    <input class="form-control form-control-lg" id="name" name="name" type="text" placeholder="Nhập họ và tên" value="<?php echo $row["HoTenKH"]?>" onblur="CheckName()">
                  </div>
                  <div class="col-lg-12 form-group">
                    <span class="text-danger" id="mess_name"></span>
                  </div> 
                </div>
                <div class="row">
                  <!-- Số điện thoại -->
                  <div class="col-lg-12 form-group">
                    <label class="text-small text-uppercase" for="phone">Số điện thoại (*)</label>
                    <input class="form-control form-control-lg" name="phone" id="phone" type="tel" placeholder="024 535 4445" value="<?php echo $row["SoDienThoai"]?>" onblur="CheckPhone()">
                  </div>
                  <div class="col-lg-12 form-group">
                    <span class="text-danger" id="mess_phone"></span>
                  </div>
                </div>
                <div class="row">
                  <!-- Email -->
                  <div class="col-lg-6 form-group">
                    <label class="text-small text-uppercase" for="email">Email address </label>
                    <input class="form-control form-control-lg" name="email" type="email" placeholder="baoni@example.com" value="<?php echo $row["Email"]?>">
                  </div>
                  <!-- Tên công ty -->
                  <div class="col-lg-6 form-group">
                    <label class="text-small text-uppercase" for="company">Tên công ty</label>
                    <input class="form-control form-control-lg" name="company" type="text" placeholder="Nhập tên công ty" value="<?php echo $row["TenCongTy"]?>">
                  </div>
                </div>
                  <!-- Địa chỉ nhận hàng -->
                <div class="row">
                  <div class="col-lg-12 form-group">
                    <label class="text-small text-uppercase" for="address">Địa chỉ nhận hàng (*)</label>
                    <input class="form-control form-control-lg" id="address" name="address"  type="text" placeholder="số, đường/tên tòa nhà, xã/phường, quận/huyện, tỉnh/TP" value="<?php echo $row["DiaChi"]?>" onblur="CheckAddress()">
                  </div>
                  <div class="col-lg-12 form-group">
                    <span class="text-danger" id="mess_address"></span>
                  </div>
                </div>
              <?php 
                  }
                  
                }
                else{
                
              ?>
            
              <div class="col-lg-12">
              <form action="" method="GET">
                <div class="row">
                  <!-- Họ tên -->
                  <div class="col-lg-12 form-group">
                    <label class="text-small text-uppercase" for="name">Họ và tên (*)</label>
                    <input class="form-control form-control-lg" id="name" name="name" type="text" placeholder="Nhập họ và tên" value="" onblur="CheckName()">
                  </div>
                  <div class="col-lg-12 form-group">
                    <span class="text-danger" id="mess_name"></span>
                  </div> 
                </div>
                <div class="row">
                  <!-- Số điện thoại -->
                  <div class="col-lg-12 form-group">
                    <label class="text-small text-uppercase" for="phone">Số điện thoại (*)</label>
                    <input class="form-control form-control-lg" name="phone" id="phone" type="tel" placeholder="024 535 4445" value="" onblur="CheckPhone()">
                  </div>
                  <div class="col-lg-12 form-group">
                    <span class="text-danger" id="mess_phone"></span>
                  </div>
                </div>
                <div class="row">
                  <!-- Email -->
                  <div class="col-lg-6 form-group">
                    <label class="text-small text-uppercase" for="email">Email address </label>
                    <input class="form-control form-control-lg" name="email" type="email" placeholder="baoni@example.com" value="">
                  </div>
                  <!-- Tên công ty -->
                  <div class="col-lg-6 form-group">
                    <label class="text-small text-uppercase" for="company">Tên công ty</label>
                    <input class="form-control form-control-lg" name="company" type="text" placeholder="Nhập tên công ty" value="">
                  </div>
                </div>
                  <!-- Địa chỉ nhận hàng -->
                <div class="row">
                  <div class="col-lg-12 form-group">
                    <label class="text-small text-uppercase" for="address">Địa chỉ nhận hàng (*)</label>
                    <input class="form-control form-control-lg" id="address" name="address"  type="text" placeholder="số, đường/tên tòa nhà, xã/phường, quận/huyện, tỉnh/TP" onblur="CheckAddress()">
                  </div>
                  <div class="col-lg-12 form-group">
                    <span class="text-danger" id="mess_address"></span>
                  </div>
                </div>
                  <!-- Mật khẩu -->
                <div class="row">
                  <div class="col-lg-12 form-group">
                    <div class="custom-control pl-0">
                      <span class="custom-control-span text-uppercase" >
                        <strong>Tạo tài khoản mới</strong>
                      </span>
                    </div>
                  </div>
                  <div class="col-lg-12 form-group">
                    <label class="text-small text-uppercase" for="password">Mật khẩu (*)</label>
                    <input class="form-control form-control-lg" id="password" name="password" type="password" placeholder="6-16 ký tự" onblur="CheckPass()">
                  </div>
                  <div class="col-lg-12 form-group">
                    <span class="text-danger" id="mess_pass"></span>
                  </div>
                </div>
                  <?php 
                    }
                  ?>
                <div class="row">
                  <div class="col-lg-12 form-group">
                    <span class="text-danger" id="messenger_all"></span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-6 form-group">
                      <a href="gio-hang.php"><button class="btn btn-outline-dark btn-light" type="button"><i class="fas fa-long-arrow-alt-left mr-2"> </i>Quay lại</button></a>
                    </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-6 form-group text-right">
                      <button class="btn btn-dark" type="submit" name="checkout">Đặt hàng</button>
                  </div>
                </div>
              </div> 
            </form>
          </div>
        </section>
      </div>
      <script>
        function messenger(){
            messenger_all.textContent="Vui lòng nhập thông tin hợp lệ!" ;
        }

        function messengerNewPhone(){
          messenger_all.innerHTML+=`Số điện thoại đã được sử dụng! 
                \n Vui lòng nhập số khác. Hoặc ĐĂNG NHẬP nếu bạn từng mua hàng.`;
        }

        function messengerNewDH(){
            messenger_all.textContent="Thêm thành công. Đăng nhập để xem tình trạng đơn hàng" ;
        }
        function messengerError(){
            messenger_all.textContent="Đã xảy ra lỗi" ;
        }

        function CheckName(){
          var x = document.getElementById("name");
          if(!x.value)
            mess_name.textContent="Vui lòng nhập thông tin";
          else{
            mess_name.textContent="";
          }
        };
        function CheckAddress(){
          var x = document.getElementById("address");
          if(!x.value)
            mess_address.textContent="Vui lòng nhập thông tin";
          else{
            mess_address.textContent="";
          }
        };

        function CheckPhone(){
          var x = document.getElementById("phone");
          if(!x.value){
             mess_phone.textContent="Vui lòng nhập số điện thoại";
          }else{
            if(isNaN(x.value)){
               mess_phone.textContent="Vui lòng nhập số điện thoại hợp lệ";
            }else{
              mess_phone.textContent="";
            }
          }
        };

        function CheckPass(){
          var x = document.getElementById("password");
          if(!x.value){
             mess_pass.textContent="Vui lòng nhập mật khẩu";
          }else{
            if(x.value.length >16 ||x.value.length <6  ){
               mess_pass.textContent="Mật khẩu có độ dài từ 6- 16 ký tự";
            }else{
              mess_pass.textContent="";
            }
          }
        };
        
        


        
      </script>

      <?php
        include('connect.php');
        if(isset($_GET["checkout"])){
          $name=$_GET["name"];
          $email=$_GET["email"];
          $phone=$_GET["phone"];
          $company=$_GET["company"];
          $address=$_GET["address"];
         
          $last_id_dathang=0;
          //kiểm tra thông tin nhập
          if(!$name || !$phone ||!$address || !is_numeric($phone)){
              echo '<script> messenger()</script>';
              exit;
          }else{
            if(!isset($_SESSION['makh'])){
              $password=$_GET["password"];
              
              if(strlen($password)<6||strlen($password)>16){
                  echo '<script> messenger()</script>';
              }
              else{
              // kiểm tra số điện thoại của khách hàng mới
                $check=$conn->query("select mskh from KhachHang where SoDienThoai='$phone' ");
                if($check->num_rows > 0){
                  echo '<script> messengerNewPhone()</script>';
                }else{
                  $last_id_kh;
                  $pass=md5($password);
                  //thêm khách hàng mới
                  $sql_kh="insert into KhachHang (HoTenKH,TenCongTy,SoDienThoai,Email,KHPass) values('$name','$company','$phone','$email','$pass')";
                  if($conn->query($sql_kh)){
                    $last_id_kh = $conn->insert_id;
                    // echo $last_id_kh;
                    //Thêm địa chỉ
                    $sql_dc="insert into DiaChiKH (DiaChi,MSKH) values('$address','$last_id_kh')";
                    if(!$conn->query($sql_dc)){
                      echo '<script> messengerError()</script>';
                      $conn->query("delete from KhachHang where MSKH='$last_id_kh'");
                    }else{
                      //tạo đơn đặt hàng
                      $date=date("Y-m-d");
                      $sql_dathang="insert into dathang (MSKH,NgayDH,TrangThaiDH) values( '$last_id_kh','$date',0)";
                      if($conn->query($sql_dathang)){
                        $last_id_dathang = $conn->insert_id;
                      }
                    }
                  }else{
                    echo '<script> messengerError()</script>';
                  }
                }
              }
            }else{
              $makh=$_SESSION["makh"];
              //Câp nhật thông tin khách hàng
              $sql_kh="UPDATE khachhang SET HoTenKH= '$name', TenCongTy='$company',SoDienThoai='$phone',Email='$email' 
                        WHERE MSKH = '$makh'";
              $sql_dc="UPDATE diachikh SET DiaChi = '$address' WHERE MSKH =$makh" ;
              if(!$conn->query($sql_kh)||!$conn->query($sql_dc)){
                echo '<script> messengerError()</script>';
              }else{
                $date=date("Y-m-d");
                $sql_dathang="insert into dathang (MSKH,NgayDH,TrangThaiDH) values( '$makh','$date',0)";
                if($conn->query($sql_dathang)){
                  $last_id_dathang = $conn->insert_id;
                }
              }
            }
            foreach ($cart as $key => $value){
              $id= $value['pd_id'];
              $soluong= $value['pd_quantity'];
              $gia=$value['pd_price'];
              $sql_ctdh="insert into Chitietdathang (SoDonDH,MSHH,SoLuong,GiaDatHang) values('$last_id_dathang','$id','$soluong','$gia')";
              if(!$conn->query($sql_ctdh)){
                echo '<script> messengerError()</script>';
              }
            }
            unset($_SESSION['cart']);
            echo '<script> messengerNewDH()</script>';
            echo '<meta http-equiv="refresh" content="2;url=/weekend.shop/index.php">';
          }
          
        }

      ?>

     <?php $conn->close(); include_once('footer.php') ?>