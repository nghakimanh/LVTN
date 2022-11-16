<?php 
  $title='WEEKEND | SHOP';
  include_once('header.php')
?>
       
      <div class="container">
        <!-- HERO SECTION-->
        <section class="py-5 bg-light">
          <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
              <div class="col-lg-6">
              <?php 
                $maloaihang;
                include('connect.php');
                if(isset($_GET['maloaihang']))
                  $maloaihang=$_GET['maloaihang'];
                else 
                  $maloaihang=0;
                if($maloaihang ==0)
                  echo'<h1 class="h2 text-uppercase mb-0">Tất cả sản phẩm</h1>';
                else{
                  $sql_tenloaihang="select TenLoaiHang from loaihanghoa where MaLoaiHang= $maloaihang";
                  $ds_tlh=$conn->query($sql_tenloaihang);
                  while($row=$ds_tlh->fetch_assoc()){
                    echo'<h1 class="h2 text-uppercase mb-0">'.$row["TenLoaiHang"].'</h1>';
                  }
                }
                $conn->close();
              ?>
                
              </div>
              <div class="col-lg-6 text-lg-right">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shop</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </section>
        <section class="py-5">
          <div class="container p-0">
            <div class="row">
              <!-- SHOP LISTING-->
              <?php 
                include('connect.php');

                if(isset($_GET['page']))
                  $page=$_GET['page'];
                else 
                  $page=1;
                
                $total_row;
                if($maloaihang ==0){
                  $total_row = $conn->query("select * from hanghoa")->num_rows;
                }
                else{
                  $total_row = $conn->query("select * from hanghoa where MaLoaiHang= $maloaihang")->num_rows;
                }
                
                //PHÂN TRANG
                $row_per_page=12; //số sản phẩm mỗi trang
                $start_row = $page*$row_per_page - $row_per_page; //bắt đầu tại
                $total_page= ceil( $total_row/$row_per_page); //tổng số trang
                $list_page=" "; 
                //Trang trước đó
                $pre_page=$page-1;
                if($pre_page==0)
                  $list_page='<li class="page-item"><a class="page-link" href="" aria-label="Previous">
                              <span aria-hidden="true">«</span></a></li>';
                else
                  $list_page='<li class="page-item"><a class="page-link" href="shop.php?mahanghoa='.$maloaihang.'&page='.$pre_page.'" aria-label="Previous">
                                <span aria-hidden="true">«</span></a></li>';
                
                if($page-1 > 1){
                  $list_page.='<li class="page-item"><a class="page-link" href="shop.php?mahanghoa='.$maloaihang.'&page=1">1</a></li>';
                  if($page-1 > 2)
                   $list_page.='<li class="page-item "><span class="page-link" ><i class="fa fa-ellipsis-h"></i></span></li>';
                }
                $start= ($page-1 <1)?1:$page-1;
                $end=($page+1 >$total_page)?$total_page:$page+1;
                
                for($i=$start;$i<= $end;$i++){
                  if($i==$page)
                    $list_page.='<li class="page-item active"><a class="page-link" >'.$i.'</a></li>';
                  else
                    $list_page.='<li class="page-item"><a class="page-link" href="shop.php?mahanghoa='.$maloaihang.'&page='.$i.'">'.$i.'</a></li>';
                } 

                if($page+1<$total_page-1){
                  $list_page.='<li class="page-item "><span class="page-link" ><i class="fa fa-ellipsis-h"></i></span></li>';
                
                }
                if($page+1<$total_page){
                  $list_page.='<li class="page-item"><a class="page-link" href="shop.php?mahanghoa='.$maloaihang.'&page='.$total_page.'">'.$total_page.'</a></li>';

                }
                 
                //Trang kế tiêp
                $next_page=$page+1;
                if($next_page>$total_page)
                  $list_page.=' <li class="page-item"><a class="page-link" href="" aria-label="Next"><span aria-hidden="true">»</span></a></li>';
                else
                $list_page.=' <li class="page-item"><a class="page-link" href="shop.php?mahanghoa='.$maloaihang.'&page='.$next_page.'" aria-label="Next">
                            <span aria-hidden="true">»</span></a></li>';

                $sql_hanghoa;
                if($maloaihang ==0){
                  $sql_hanghoa="select * from hanghoa limit $start_row, $row_per_page";
                }
                else{
                  $sql_hanghoa="select * from hanghoa where MaLoaiHang= $maloaihang limit $start_row, $row_per_page";
                }
                $ds_hh=$conn->query($sql_hanghoa);
              ?>
              <div class="col-lg-12 order-1 order-lg-2 mb-5 mb-lg-0">
                <div class="row mb-3 align-items-center">
                  <div class="col-lg-6 mb-2 mb-lg-0">
                    <p class="text-small text-muted mb-0">Có <?php echo $total_row ?> sản phẩm </p>
                  </div>
                  <div class="col-lg-6">
                  </div>
                </div>
                <div class="row">
                  <!-- PRODUCT-->
                  <?php 
                    while($row=$ds_hh->fetch_assoc()){
                  ?>
                  <div class="col-lg-4 col-sm-6">
                    <div class="product text-center">
                      <div class="mb-3 position-relative">
                        <div class="badge text-white badge-"></div>
                        
                        <img class="img-fluid w-100" src= <?php echo "../weekend.admin/".$row["AnhMinhHoa"] ?> alt="san-pham">
                       
                        <div class="product-overlay">
                          <ul class="mb-0 list-inline">
                            <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="chi-tiet-san-pham.php?mahh=<?php echo $row["MSHH"]?>">Mua hàng</a></li>
                          </ul>
                        </div>
                      </div>
                      <h6> <a class="reset-anchor" href="chi-tiet-san-pham.php?mahh=<?php echo $row["MSHH"]?>"><?php echo $row["TenHH"]?></a></h6>
                      <p class="small text-muted"><?php echo number_format($row["Gia"], 0, ',', '.')?> đ</p>
                    </div>
                  </div>
                  <?php } ?>
                </div>
                <!-- PAGINATION-->
                <nav aria-label="Page navigation example">
                  <ul class="pagination justify-content-center justify-content-lg-end">
                      <?php echo $list_page ?>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </section>
      </div>
     
<?php include_once ('footer.php');