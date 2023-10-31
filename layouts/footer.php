<footer class="site-footer">
        <div class="container">
            <div class="row justify-content-between  section-padding">
                <div class=" col-xl-3 col-lg-4 col-sm-6">
                    <div class="single-footer pb--40">
                        <div class="brand-footer footer-title">
                            <img src="image/logo--footer.png" alt="">
                        </div>
                        <div class="footer-contact">
                            <p><span class="label">Address:</span><span class="text">Ngõ 58, Dịch Vọng Hậu, Cầu Giấy, Hà Nội</span></p>
                            <p><span class="label">Hotline:</span><span class="text">0988.888.999</span></p>
                            <p><span class="label">Email:</span><span class="text">hotro@pustok.com</span></p>
                        </div>
                    </div>
                </div>
                <div class=" col-xl-3 col-lg-2 col-sm-6">
                    <div class="single-footer pb--40">
                        <div class="footer-title">
                            <h3>Information</h3>
                        </div>
                        <ul class="footer-list normal-list">
                            <li><a href="">Discount</a></li>
                            <li><a href="">New arrival</a></li>
                            <li><a href="">Best Sale</a></li>
                            <li><a href="">Contact</a></li>
                            <li><a href="">Site map</a></li>
                        </ul>
                    </div>
                </div>
                <div class=" col-xl-3 col-lg-2 col-sm-6">
                    <div class="single-footer pb--40">
                        <div class="footer-title">
                            <h3>Support</h3>
                        </div>
                        <ul class="footer-list normal-list">
                            <li><a href="">Delivery</a></li>
                            <li><a href="">About Us</a></li>
                            <li><a href="">Store</a></li>
                            <li><a href="">Feedback</a></li>
                            <li><a href="">Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class=" col-xl-3 col-lg-4 col-sm-6">
                    <div class="footer-title">
                        <h3>NOTICE</h3>
                    </div>
                    <div class="newsletter-form mb--30">
                        <form action="./php/mail.php">
                            <input type="email" class="form-control" placeholder="Enter your email...">
                            <button class="btn btn--primary w-100">Submit</button>
                        </form>
                    </div>
                    <div class="social-block">
                        <h3 class="title">CONNECT WITH STORE</h3>
                        <ul class="social-list list-inline">
                            <li class="single-social facebook"><a href=""><i class="ion ion-social-facebook"></i></a>
                            </li>
                            <li class="single-social twitter"><a href=""><i class="ion ion-social-twitter"></i></a></li>
                            <li class="single-social google"><a href=""><i
                                        class="ion ion-social-googleplus-outline"></i></a></li>
                            <li class="single-social youtube"><a href=""><i class="ion ion-social-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var giohang = localStorage.getItem('giohang')

            if(giohang == null){
                $('.sanpham_giohang').append('<div class=" single-cart-block " style="text-align: center;"> Không có sản phẩm </div>')
            }else{
                var giohang = JSON.parse(localStorage.getItem('giohang'))
                var tien = 0
                for (var i = 0; i < giohang.length; i++) {
                    var gia = parseInt(giohang[i].giaban) * parseInt(giohang[i].soluong) * 1000
                    $('.sanpham_giohang').append('<div class=" single-cart-block "> <div class="cart-product"> <a href="san-pham.php?id='+giohang[i].masanpham+'" class="image"> <img style="width: 100px; height: 100px;" src="http://localhost/webbansach/'+giohang[i].anhchinh+'" alt=""> </a> <div class="content"> <h3 class="title"><a href="san-pham.php?id='+giohang[i].masanpham+'">'+giohang[i].tensanpham+'</a> </h3> <p class="price"><span class="qty">'+giohang[i].soluong+' ×</span> '+giohang[i].giaban+'đ</p> </div> </div> </div>')
                    tien += gia
                }

                $('.slgiohang').html(giohang.length)

                $('.tiengiohang').html(tien.toLocaleString('vi', {style : 'currency', currency : 'VND'}))

                $('.dh').append('<div class="btn-block"> <a href="gio-hang.php" class="btn">Xem Giỏ Hàng <i class="fas fa-chevron-right"></i></a> <a href="thanh-toan.php" class="btn btn--primary">Thanh Toán <i class="fas fa-chevron-right"></i></a> </div>')
                
            }
        });
    </script>

    <!-- Use Minified Plugins Version For Fast Page Load -->
    <script src="js/plugins.js"></script>
    <script src="js/ajax-mail.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>