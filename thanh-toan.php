<?php require(__DIR__.'/layouts/header.php'); ?>  
<?php 
if(!isset($_SESSION['dangnhap'])){
	echo "<script>window.location.href = 'dang-nhap.php';</script>";
}

$taikhoan = $_SESSION['taikhoan'];
$sql_khachhang = "SELECT * FROM khachhang WHERE taikhoan = '".$taikhoan."'";
$khachhang = queryResult($conn, $sql_khachhang)->fetch_assoc();
 ?>
		<section class="breadcrumb-section">
			<h2 class="sr-only">Site Breadcrumb</h2>
			<div class="container">
				<div class="breadcrumb-contents">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html">Home</a></li>
							<li class="breadcrumb-item active">Payment</li>
						</ol>
					</nav>
				</div>
			</div>
		</section>
		<main id="content" class="page-section inner-page-sec-padding-bottom space-db--20">
			<form method="POST">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<!-- Checkout Form s-->
							<div class="checkout-form">
								<div class="row row-40">
									<div class="col-lg-7 mb--20">
										<!-- Billing Address -->
										<div id="billing-form" class="mb-40">
											<h4 class="checkout-title">Payment Information</h4>
											<div class="row">
												<div class="col-md-6 col-12 mb--20">
													<label>Full name</label>
													<input type="text" value="<?php echo $khachhang["tenkhachhang"]; ?>" placeholder="Recipient's full name..." required class="hoten" disabled>
												</div>
												<div class="col-md-6 col-12 mb--20">
													<label>Phone number</label>
													<input type="text" placeholder="Phone number" value="<?php echo $khachhang["sodienthoai"]; ?>" required class="sodienthoai" disabled>
												</div>
												<div class="col-12 mb--20">
													<label>House number</label>
													<input type="text" placeholder="House number..." required class="sonha">
												</div>
												<div class="col-12 mb--20">
													<label>Hamlet</label>
													<input type="text" placeholder="Hamlet..." required class="thonxom">
												</div>
												<div class="col-12 mb--20">
													<label>Ward/Commune</label>
													<input type="text" placeholder="Ward or commune..." required class="phuongxa">
												</div>
												<div class="col-12 mb--20">
													<label>District</label>
													<input type="text" placeholder="District.." required class="huyen">
												</div>
												<div class="col-12 mb--20">
													<label>City</label>
													<input type="text" placeholder="City..." required class="tinhthanh">
												</div>
											</div>
										</div>

									</div>
									<div class="col-lg-5">
										<div class="row">
											<!-- Cart Total -->
											<div class="col-12">
												<div class="checkout-cart-total">
													<h2 class="checkout-title">ORDER INFORMATION</h2>
													<h4>Products <span>Total amount</span></h4>
													<ul class="thongtinsanpham">
														
														
													</ul>
													<p>Quantity <span class="sl">0</span></p>
													<p>Shipping fee <span>0</span></p>
													<h4>Total <span class="tt">0</span></h4>
													<br>
													<div class="term-block">
														<input type="checkbox" id="accept_terms2">
														<label for="accept_terms2">I agree to the terms and services.</label>
													</div>
													<button class="place-order w-100 dathang">PLACE AN ORDER</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</main>
	</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var giohang = localStorage.getItem('giohang')
        var tien = 0
        if(giohang == null){
        	window.location.href = 'index.php'
        }else{
            var giohang = JSON.parse(localStorage.getItem('giohang'))
            
            for (var i = 0; i < giohang.length; i++) {
            	var gia = parseInt(giohang[i].giaban) * parseInt(giohang[i].soluong) * 1000
                $('.thongtinsanpham').append('<li><span class="left">'+giohang[i].tensanpham+' X '+giohang[i].soluong+'</span> <span class="right">'+gia.toLocaleString('vi', {style : 'currency', currency : 'VND'})+'</span></li>')
                tien += parseInt(gia)
            }

			var number_product = giohang.length == 1 ? giohang.length + " product" : giohang.length + " products"


            $('.sl').html(number_product)
            $('.tt').html(tien.toLocaleString('vi', {style : 'currency', currency : 'VND'}))
        }

        var soluong = [] 
        $('.dathang').click(function(event) {
        	event.preventDefault()
        	var diachi = $('.sonha').val() + ", " + $('.thonxom').val() + ", " + $('.phuongxa').val() + ", " + $('.huyen').val() + ", " + $('.tinhthanh').val()
        	var makhachhang = '<?php echo $khachhang["makhachhang"] ?>'
        	var sanpham = JSON.parse(localStorage.getItem('giohang'))

        	soluong.length = 0;
        	for (var i = 0; i < sanpham.length; i++) {
        		soluong.push(sanpham[i].soluong)
        	}


       		$.post('xu-ly-thanh-toan.php', {makhachhang: makhachhang, diachi:diachi, sanpham:sanpham, tongtien: tien, soluong: soluong}, function(data) {
       			var madonhang = data
       			var thoigian = '<?php echo date("d/m/Y") ?>'
       			var thongtindonhang = localStorage.getItem('giohang')

       			localStorage.clear()

       			localStorage.setItem('madonhang',madonhang)
       			localStorage.setItem('thoigian',thoigian)
       			localStorage.setItem('thongtindonhang',thongtindonhang)
       			localStorage.setItem('tt',tien.toLocaleString('vi', {style : 'currency', currency : 'VND'}))

       			window.location.href = 'hoan-thanh-thanh-toan.php'
       		});

        });

    });
</script>
<?php require(__DIR__.'/layouts/footer.php'); ?>  