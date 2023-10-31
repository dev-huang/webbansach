<?php require(__DIR__ . '/layouts/header.php'); ?>
<section class="breadcrumb-section">
	<h2 class="sr-only">Site Breadcrumb</h2>
	<div class="container">
		<div class="breadcrumb-contents">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.html">Home</a></li>
					<li class="breadcrumb-item active">Cart</li>
				</ol>
			</nav>
		</div>
	</div>
</section>
<!-- Cart Page Start -->
<main class="cart-page-main-block inner-page-sec-padding-bottom">
	<div class="cart_area cart-area-padding  ">
		<div class="container">
			<div class="page-section-title">
				<h1>Cart</h1>
			</div>
			<div class="row">
				<div class="col-12">
					<form action="#" class="">
						<!-- Cart Table -->
						<div class="cart-table table-responsive mb--40">
							<table class="table">
								<!-- Head Row -->
								<thead>
									<tr>
										<th class="pro-remove"></th>
										<th class="pro-thumbnail">Image</th>
										<th class="pro-title">Product</th>
										<th class="pro-price">Price</th>
										<th class="pro-quantity">Quantity</th>
										<th class="pro-subtotal">Total</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="cart-section-2">
		<div class="container">
			<div class="row">

				<!-- Cart Summary -->
				<div class="col-lg-6 col-12 d-flex">
					<div class="cart-summary">
						<div class="cart-summary-wrap">
							<h4><span>Purchase Order</span></h4>
							<p>Quantity: <span class="text-primary soluongsanpham">0</span></p>
							<p>Delivery charge: <span class="text-primary">0đ</span></p>
							<h2>Total amount: <span class="text-primary tongtien">0đ</span></h2>
						</div>
						<div class="cart-summary-button">
							<a href="thanh-toan.php" class="checkout-btn c-btn btn--primary">Payment</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<!-- Cart Page End -->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>

	$(document).ready(function () {
		var giohang = localStorage.getItem('giohang')
		var id = 0;

		if (giohang == null) {
			window.location.href = 'index.php'
		} else {
			var giohang = JSON.parse(localStorage.getItem('giohang'))
			var tien = 0
			for (var i = 0; i < giohang.length; i++) {
				var gia = parseInt(giohang[i].giaban) * parseInt(giohang[i].soluong) * 1000
				$('tbody').append('<tr> <td class="pro-remove" "><a href="#" class="xoa" value="' + giohang[i].masanpham + '"><i class="far fa-trash-alt"></i></a> </td> <td class="pro-thumbnail"><a href="#"><img src="http://localhost/webbansach/' + giohang[i].anhchinh + '" alt="Product"></a></td> <td class="pro-title"><a href="#">' + giohang[i].tensanpham + '</a></td> <td class="pro-price"><span>' + gia.toLocaleString('vi', { style: 'currency', currency: 'VND' }) + '</span></td> <td class="pro-quantity"> <div class="pro-qty"> <div class="count-input-block"> <input type="number" class="form-control text-center number" data="' + giohang[i].masanpham + '" value="' + giohang[i].soluong + '"> </div> </div> </td> <td class="pro-subtotal"><span>' + gia.toLocaleString('vi', { style: 'currency', currency: 'VND' }) + '</span></td> </tr>')
				tien += gia
			}

			var number_product = giohang.length == 1 ? giohang.length + " product" : giohang.length + " products"

			$('.soluongsanpham').html(number_product)

			$('.tongtien').html(tien.toLocaleString('vi', { style: 'currency', currency: 'VND' }))

			$('.xoa').click(function (argument) {
				var masanpham = $(this).attr('value')

				var giohangmoi = giohang.filter(function (item) {
					return item.masanpham != masanpham;
				});

				localStorage.setItem("giohang", JSON.stringify(giohangmoi))

				location.reload();

			})
		}



		$(".number").on("input", function () {
			var sl = $(this).val();

			var msp = $(this).attr('data');

			for (var i = 0; i < giohang.length; i++) {
				if (giohang[i].masanpham == msp) {
					id = i
				}
			}


			if (sl <= 0) {

			} else {
				giohang[id].soluong = sl
				localStorage.setItem('giohang', JSON.stringify(giohang))
				location.reload();
			}

		});



	});
</script>

<?php require(__DIR__ . '/layouts/footer.php'); ?>