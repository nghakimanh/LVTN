<?php 
  $title='WEEKEND | ĐĂNG NHẬP';
  include_once('header.php')
?>
      <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-12">
                <h1 class="h2 text-uppercase mb-0 text-center">ĐĂNG NHẬP</h1>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
          <!-- BILLING ADDRESS-->
          <div class="row">
            <div class="col-lg-4 m-auto">
              <form action="#" method="POST">
                <div class="row">
                  <div class="col-lg-12 form-group">
                    <label class="text-small text-uppercase" for="phone">Số điện thoại </label>
                    <input class="form-control form-control-lg" name="phone" type="text" placeholder="">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12 form-group">
                    <label class="text-small text-uppercase" for="password">password  </label>
                    <input class="form-control form-control-lg" name="password" type="password" placeholder="">
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12 form-group text-center mt-2">
                      <button class="btn btn-dark" name="login" type="submit">Đăng nhập</button>
                  </div>
                </div>
              </form>

              <?php 
                include('connect.php');
                if(isset($_POST['login'])){
                  $sdt=$_POST['phone'];
                  $pass=md5($_POST['password']);
                  if(!$sdt||!$pass){
                    echo' <div class="row">
                            <div class="col-lg-12 col-md-6 form-group text-left mt-2">
                                <span>Vui lòng nhập thông tin!</span>
                            </div>
                          </div>' ;
                    exit;
                  }else{
                     $sql = "SELECT * FROM KhachHang WHERE SoDienThoai='$sdt'";
                     $result=$conn->query($sql);
                      if($result->num_rows==0){
                        echo ' <div class="row">
                                <div class="col-lg-12 col-md-6 form-group text-left mt-2">
                                    <span>Tài khoản không tồn tại. Vui lòng đặt hàng để tạo tài khoản mới!</span>
                                </div>
                              </div>' ;
                        exit;
                      }else{
                        while($row=$result->fetch_assoc()){
                          if($row['KHPass']!=$pass)
                            echo ' <div class="row">
                                  <div class="col-lg-12 col-md-6 form-group text-left mt-2">
                                      <span>Mật khẩu không chính xác!</span>
                                  </div>
                                </div>' ;
                          else{
                            $_SESSION['makh']=$row['MSKH'];
                            echo ' <div class="row">
                                  <div class="col-lg-6 col-md-6 form-group text-left mt-2">
                                      <span>Đăng nhập thành công !</span>
                                  </div>
                                  <div class="col-lg-6 col-md-6 form-group text-right mt-2">
                                    <a class="btn btn-link p-0 text-dark btn-sm" href="dat-hang.php">
                                    <i class="fas fa-long-arrow-alt-left mr-2"> <strong>Quay lại đặt hàng</strong></i>
                                  </div>
                                </div>' ;
                          }
                        }
                      }
                  }
                 
                }
                $conn->close();
              ?>
             
            </div>
          </div>
        </section>
      </div>
     <?php include_once('footer.php') ?>