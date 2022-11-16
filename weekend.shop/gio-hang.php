<?php 
  $title='GIỎ HÀNG';
  include_once('header.php');

?>

      <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Giỏ hàng</h1>
              </div>
              <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
          <h2 class="h5 text-uppercase mb-4">Giỏ hàng</h2>
          <div class="row">
            <div class="col-lg-12 col-md-12 mb-4 mb-lg-0">
              <!-- CART TABLE-->
              <div class="table-responsive mb-4">
                <table class=" table">
                  <thead class="bg-light">
                    <tr>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Sản phẩm</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Giá</strong></th>
                      <th class="border-0" scope="col" > <strong class="text-small text-uppercase ">Số lượng</strong></th>
                      <th class="border-0" scope="col"> <strong class="text-small text-uppercase">Thành tiền</strong></th>
                      <th class="border-0" scope="col"> </th>
                      <th class="border-0" scope="col"> </th>
                    </tr>
                  </thead>
                  <tbody class="list-cart">
                    <?php 
                      $total=0;
                      foreach ($cart as $key => $value){

                    ?>
                    <tr class="row-cart">
                      <th class="pl-0 border-0" scope="row">
                        <div class="media align-items-center"><a class="reset-anchor d-block animsition-link" href="chi-tiet-san-pham.php?mahanghoa=<?php echo $value['pd_id'] ?>"><img src= <?php echo "../weekend.admin/".$value['pd_img']?>  alt="Ảnh minh họa" width="70"/></a>
                          <div class="media-body ml-3"><strong class="h6"><a class="reset-anchor animsition-link" href="chi-tiet-san-pham.php?mahanghoa=<?php echo $value['pd_id'] ?>"><?php echo $value['pd_name'] ?></a></strong></div>
                        </div>
                      </th>
                      <td class="align-middle border-0">
                        <p class="price-cart mb-0 small "><?php echo $value['pd_price'] ?></p>
                      </td>
                    <form action="" method="post">
                      <td class="align-middle border-0">
                        <div class="border d-flex align-items-center justify-content-between px-3">
                          <div class="quantity">
                            <a class="dec-btn p-0"><i class="fas fa-caret-left"></i></a>
                              <input name="quantity" class=" form-control form-control-sm border-0 shadow-0 p-0" type="text"  value="<?php echo $value['pd_quantity'] ?>"/>
                            <a class="inc-btn p-0"><i class="fas fa-caret-right"></i></a>
                           </div>
                        </div>
                       
                      </td>
                      <td class="align-middle border-0">
                        <p class="total-item-cart mb-0 small "><?php echo $value['pd_price']*$value['pd_quantity'] ?></p>
                      </td>
                     
                      <td class=" align-middle border-0 ">
                        <button type="submit" name="delete" class="btn-trash reset-anchor btn-light" ><i class="fas fa-trash-alt small text-muted"></i></button>
                        <input  type="number" name="id" value="<?php echo  $value['pd_id'] ?>" hidden>
                      </td>
                      <td class=" align-middle border-0 ">
                        <button type="submit" name="update" class="btn-trash reset-anchor btn-light"><small>Cập nhật</small></button>
                      </td>
                    </form>
                      
                    </tr>
                    <?php 
                      $total+=$value['pd_price']*$value['pd_quantity'];
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            
            <!-- ORDER TOTAL-->
            <div class="col-lg-6 offset-lg-6 col-md-12">
              <div class="card border-0 rounded-0 p-lg-4 bg-light">
                <div class="card-body">
                  <h5 class="text-uppercase mb-4">Thanh toán</h5>
                  <ul class="list-unstyled mb-0">
                    <li class="border-bottom my-2"></li>
                    <li class="d-flex align-items-center justify-content-between mb-4">
                      <strong class="text-uppercase small font-weight-bold">Tổng cộng</strong>
                      <span class="total-cart"><?php echo $total?></span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          
          
          <!-- CART NAV-->
          <div class="bg-light px-4 py-3">
            <div class="row align-items-center text-center">
              <div class="col-md-6 col-sm-6 col-6 mb-3 mb-md-0 text-md-left">
                <a class="btn btn-link p-0 text-dark btn-sm" href="shop.php"><i class="fas fa-long-arrow-alt-left mr-2"> </i>Tiếp tục mua sắm</a>
              </div>
              <div class="col-md-6 col-sm-6 col-6 text-md-right">
                <a class="btn btn-outline-dark btn-sm" href="dat-hang.php">Đặt hàng<i class="fas fa-long-arrow-alt-right ml-2"></i></a></div>
            </div>
          </div>
        </section>
      </div>
      
      <!-- Xử lý cập nhật giỏ hàng-->
      <?php 
          if(isset($_POST["delete"])){
            $id=$_POST["id"];
            unset($_SESSION['cart'][$id]);
            echo "<meta http-equiv='refresh' content='0'>";
          }
          if(isset($_POST["update"])){
            $quantity=(int)$_POST["quantity"];
            $id=$_POST["id"];
            $stored=$_SESSION['cart'][$id]['pd_stored'];
            $name=$_SESSION['cart'][$id]['pd_name'];
            if($quantity<=0 ||$quantity ==''){
              $_SESSION['cart'][$id]['pd_quantity']=1;
            }else{
              if($quantity >$stored ){
                $_SESSION['cart'][$id]['pd_quantity']=$quantity;
                echo'<div class="row align-items-center pb-5">
                    <div class="col-md-12 col-sm-12 text-md-right">
                      <span class="text-danger" > Số lượng hàng'.$name.'hiện có là'. $stored.' </span>
                    </div>
                  </div>';
              }else{
                $_SESSION['cart'][$id]['pd_quantity']=$quantity;
              }
            }
            echo "<meta http-equiv='refresh' content='0'>";
          }
          
        ?>
<?php 
  include_once('footer.php')
?>
