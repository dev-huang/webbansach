<?php require(__DIR__.'/layouts/header.php'); ?>    
<?php 

if(isset($_SESSION['dangnhap'])){
	echo "<script>window.location.href = 'index.php';</script>";
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['dangky'])){
	$hoten = $_POST['hoten'];
	$taikhoan = $_POST['taikhoan'];
	$sodienthoai = $_POST['sodienthoai'];
	$matkhau = $_POST['matkhau'];
	$nhaplaimatkhau = $_POST['nhaplaimatkhau'];
	$diachi = $_POST['diachi'];
	$err = "";
	$success = "";
	if($matkhau != $nhaplaimatkhau){
		$err = "The entered passwords do not match!";
	}else{
		$sql_check = "SELECT count(*) AS num FROM khachhang WHERE taikhoan = '".$taikhoan."'";
		$check = queryResult($conn,$sql_check)->fetch_assoc();

		if($check['num'] == 0){
			$sql_insert= "INSERT INTO `khachhang`(`tenkhachhang`, `diachi`, `sodienthoai`, `taikhoan`, `matkhau`) VALUES ('".$hoten."','".$diachi."','".$sodienthoai."','".$taikhoan."','".$matkhau."')";
			$insert = queryExecute($conn,$sql_insert);
			$success = "Registration successful! Please log in!";
		}else{
			$err = "The account already exists!";
		}
	}
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['dangnhap'])){
	$taikhoan = $_POST['taikhoan'];
	$matkhau = $_POST['matkhau'];
	$err_dangnhap = "";
	$sql_check = "SELECT count(*) AS num FROM khachhang WHERE taikhoan = '".$taikhoan."' AND matkhau = '".$matkhau."'";
	$check = queryResult($conn,$sql_check)->fetch_assoc();

	if ($check['num'] == 1) {
		$sql_check2 = "SELECT count(*) AS num FROM khachhang WHERE taikhoan = '".$taikhoan."' AND trangthai = 0";
		$check2 = queryResult($conn,$sql_check2)->fetch_assoc();
		if ($check2['num'] == 1) {
			$err_dangnhap = "The account has been banned by the admin!";
		}else{
			$_SESSION['dangnhap'] = TRUE;
			$_SESSION['taikhoan'] = $taikhoan;
			echo "<script>window.location.href = 'index.php';</script>";
		}
	}else{
		$err_dangnhap = "Incorrect username or password!";
	}
		
}


?>

		<section class="breadcrumb-section">
			<h2 class="sr-only">Site Breadcrumb</h2>
			<div class="container">
				<div class="breadcrumb-contents">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html">Home</a></li>
							<li class="breadcrumb-item active">Login</li>
						</ol>
					</nav>
				</div>
			</div>
		</section>
		<!--=============================================
    =            Login Register page content         =
    =============================================-->
		<main class="page-section inner-page-sec-padding-bottom">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb--30 mb-lg--0">
						<!-- Login Form s-->
						<form method="POST">
							<div class="login-form">
								<h4 class="login-title">New Customer</h4>
								<p><span class="font-weight-bold">Sign up for an account</span></p>
								<?php if(isset($err) && !empty($err)){ ?>
									<div class="col-md-12">
										<p style="font-size: 15px; color: #62ab00; font-weight: bold;"><?php echo $err; ?></p>
									</div>
								<?php } ?>
								<?php if(isset($success) && !empty($success)){ ?>
									<div class="col-md-12">
										<p style="font-size: 15px; color: #62ab00; font-weight: bold;"><?php echo $success; ?></p>
									</div>
								<?php } ?>
								<div class="row">
									<div class="col-md-12 col-12 mb--15">
										<label for="email">Full Name</label>
										<input class="mb-0 form-control" type="text" id="name"
											placeholder="Enter your name..." required name="hoten">
									</div>
									<div class="col-12 mb--20">
										<label for="email">Username</label>
										<input class="mb-0 form-control" type="text" id="email" placeholder="Enter your username..." required name="taikhoan">
									</div>
									<div class="col-12 mb--20">
										<label for="email">Phone number</label>
										<input class="mb-0 form-control" type="text" id="email" placeholder="Enter your phone number..." required name="sodienthoai">
									</div>
									<div class="col-12 mb--20">
										<label for="email">Address</label>
										<input class="mb-0 form-control" type="text" id="email" placeholder="Enter your address..." required name="diachi">
									</div>
									<div class="col-lg-6 mb--20">
										<label for="password">Password</label>
										<input class="mb-0 form-control" type="password" id="password" placeholder="Enter your password..." required name="matkhau">
									</div>
									<div class="col-lg-6 mb--20">
										<label for="password">Re-enter your password</label>
										<input class="mb-0 form-control" type="password" id="repeat-password" placeholder="Enter your password again..." required name="nhaplaimatkhau">
									</div>
									<div class="col-md-12">
										<input type="submit" class="btn btn-outlined" name="dangky" value="Sign up">
									</div>

									
								</div>
							</div>
						</form>
					</div>
					<div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
						<form method="POST">
							<div class="login-form">
								<h4 class="login-title">Customer Login</h4>
								<p><span class="font-weight-bold">Login with account</span></p>
								<?php if(isset($err_dangnhap) && !empty($err_dangnhap)){ ?>
									<div class="col-md-12">
										<p style="font-size: 15px; color: #62ab00; font-weight: bold;"><?php echo $err_dangnhap; ?></p>
									</div>
								<?php } ?>
								<div class="row">
									<div class="col-md-12 col-12 mb--15">
										<label for="email">Username</label>
										<input class="mb-0 form-control" type="text" id="email1"
											placeholder="Enter your username..." name="taikhoan" required>
									</div>
									<div class="col-12 mb--20">
										<label for="password">Password</label>
										<input class="mb-0 form-control" type="password" id="login-password" placeholder="Enter your password.." name="matkhau" required>
									</div>
									<div class="col-md-12">
										<input type="submit" class="btn btn-outlined" name="dangnhap" value="Login">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</main>
	</div>

<?php require(__DIR__.'/layouts/footer.php'); ?>    
