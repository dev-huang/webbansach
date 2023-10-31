<?php require(__DIR__.'/layouts/header.php'); ?>  
<?php 
if(!isset($_SESSION['dangnhap'])){
	echo "<script>window.location.href = 'dang-nhap.php';</script>";
}

$taikhoan = $_SESSION['taikhoan'];
$sql_mkh = "SELECT * FROM khachhang WHERE taikhoan = '".$taikhoan."'";
$mkh = queryResult($conn,$sql_mkh)->fetch_assoc()['makhachhang'];

$madonhang = $_GET['id'];
$sql_donhang = "SELECT * FROM donhang WHERE makhachhang = ".$mkh." AND madonhang = ".$madonhang."";
$donhang = queryResult($conn,$sql_donhang)->fetch_assoc();


$sql_chitiet = "SELECT chitietdonhang.*, sanpham.masanpham, sanpham.tensanpham, sanpham.giaban FROM chitietdonhang, sanpham WHERE chitietdonhang.masanpham = sanpham.masanpham AND madonhang = ".$madonhang."";
$chitietdonhang = queryResult($conn,$sql_chitiet);


?>
		<section class="breadcrumb-section">
			<h2 class="sr-only">Site Breadcrumb</h2>
			<div class="container">
				<div class="breadcrumb-contents">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html">Home</a></li>
							<li class="breadcrumb-item">Account</li>
							<li class="breadcrumb-item active">Order Details</li>
						</ol>
					</nav>
				</div>
			</div>
		</section>

		<!-- order complete Page Start -->
		<section class="order-complete inner-page-sec-padding-bottom">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="order-complete-message text-center">
							<h1>Order Information</h1>
							<p>Your order has been placed successfully.</p>
						</div>
						<ul class="order-details-list">
							<li>Order Id: <strong>#000<?php echo $donhang['madonhang']; ?></strong></li>
							<li>Order Time: <strong><?php echo $donhang['thoigian']; ?></strong></li>
							<li>Total Amount: <strong><?php echo number_format($donhang['tongtien']); ?>đ</strong></li>
							<li>Payment Method: <strong>Cash on Delivery (COD)</strong></li>
							<li>
							Status: <strong>
									<?php 
										if($donhang['trangthai'] == 0){
											echo "Pending Approval";
										}else if($donhang['trangthai'] == 1){
											echo "Out for Delivery";
										}else if($donhang['trangthai'] == 2){
											echo "Order Cancelled";
										}else if($donhang['trangthai'] == 3){
											echo "Order Delivered";
										}
									?>
								</strong>
							</li>
						</ul>
						<h3 class="order-table-title">Order details</h3>
						<div class="table-responsive">
							<table class="table order-details-table">
								<thead>
									<tr>
										<th>Product name</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									<?php while($row = $chitietdonhang->fetch_assoc()){ ?>
										<tr> <td><a href="http://localhost/webbansach/san-pham.php?id=<?php echo $row['masanpham']; ?>"><?php echo $row['tensanpham']; ?></a> <strong>× <?php echo $row['soluong']; ?></strong></td> <td><span><?php echo number_format($row['giaban'] * $row['soluong']); ?>đ</span></td> </tr>
									<?php } ?>
								</tbody>
								
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- order complete Page End -->
	</div>
<?php require(__DIR__.'/layouts/footer.php'); ?>  