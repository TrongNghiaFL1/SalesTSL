<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <?php
    require("db.php");
    include("func.php");
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="TSL Shop - Cửa hàng phụ kiện máy tính, SSD, RAM, ổ cứng chất lượng cao">
    <meta name="keywords" content="TSL Shop, SSD, RAM, ổ cứng, phụ kiện máy tính">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="/giaodien/mystyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <title>TSL Shop - Cửa hàng phụ kiện máy tính</title>
    
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <div class="header">
        <!-- Top Bar -->
        <div class="topbar">
            <div class="center">
                <span><i class="fas fa-clock"></i> Mở cửa: 9h - 20h, Chủ nhật: 10h - 16h</span>
                <ul class="listtopbar">
                    <li>
                        <a href="/">
                            <i class="fas fa-user"></i> 
                            <?php
                                if(isset($_SESSION['username']) && $_SESSION['username']) {
                                    $username = $_SESSION['username'];
                                    $sql = "SELECT * FROM taikhoan WHERE TenDangNhap='$username'";
                                    $query = mysqli_query($connection, $sql);
                                    $row = mysqli_fetch_array($query);
                                    if ($row['Quyen'] == 1) {
                                        echo '<span style="color: #ff6b6b; font-weight: 500;">Admin: '.htmlspecialchars($username).'</span>';
                                    } else {
                                        echo '<span>'.htmlspecialchars($username).'</span>';
                                    }
                                } else {
                                    echo 'Tài khoản';
                                }
                            ?>
                        </a>
                        <ul id="loginout">
                        <?php
                        if(isset($_SESSION['username']) && $_SESSION['username']) {
                            if (isset($row) && $row['Quyen'] == 1) {
                                echo '<li id="adm"><a href="/AdminPanel"><i class="fas fa-cog"></i> Admin Panel</a></li>';
                            }    
                            echo '
                            <li id="login"><a href="/taikhoan/index.php?&id='.htmlspecialchars($row['MaTaiKhoan']).'"><i class="fas fa-user-circle"></i> Trang tài khoản</a></li>
                            <li id="reg"><a href="/dangxuat.php"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a></li>';
                        } else {
                            echo '<li id="login"><a href="/dangnhap.php"><i class="fas fa-sign-in-alt"></i> Đăng nhập</a></li>
                            <li id="reg"><a href="/dangky.php"><i class="fas fa-user-plus"></i> Đăng ký</a></li>';
                        }
                        ?>
                        </ul>
                    </li>
                    <li><a href="/"><i class="fas fa-fire"></i> Khuyến mãi hot</a></li>
                </ul>
            </div>
        </div> 
        
        <!-- Center Bar -->
        <div class="cenbar">
            <div class="center">
                <a class="logo" href="/">
                    <img src="../logo2.png" alt="TSL Shop Logo">
                </a>
                <div class="search">
                    <form action="timkiem.php" method="get">
                        <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." required>
                        <button type="submit" name="ok">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
                <div class="lienlac">
                    <div id="phone">
                        <a href="../giohang/index.php" title="Giỏ hàng">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </div>
                    <div id="number">
                        <?php
                            $cart_count = 0;
                            if(isset($_SESSION['cart'])) {
                                $cart_count = count($_SESSION['cart']);
                            }
                            echo '<a href="../giohang/index.php">
                            <span id="sdt">('.$cart_count.') sản phẩm</span></a>';
                        ?>
                        <a href="../giohang/index.php">
                            <span id="dd">Giỏ hàng</span>
                        </a>
                    </div> 
                </div> 
            </div>
        </div>
        
        <!-- Menu Navigation -->
        <div class="thanhmenu">
            <div class="center">
                <ul class="menu">
                    <li id="danhmucsp">
                        <span><i class="fas fa-bars"></i> <b>Danh mục sản phẩm</b></span>
                        <ul class="dssp">
                            <?php
                            $loai = "SELECT * FROM loaisanpham WHERE BiXoa = 0 ORDER BY TenLoaiSanPham ASC";
                            $loaisp = mysqli_query($connection, $loai);
                            if($loaisp) {
                                while($row = mysqli_fetch_array($loaisp)) {                           
                                    $id = $row['MaLoaiSanPham'];
                                    $ten = htmlspecialchars($row['TenLoaiSanPham']);
                                    echo '<li>
                                    <a href="/SanPham/index.php?mod=dssp&id='.$id.'" title="'.$ten.'">
                                    <i class="fas fa-tag"></i> '.$ten.'</a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </li>
                    <li id="m"><a href="/"><i class="fas fa-home"></i> TRANG CHỦ</a></li>
                    <li id="m"><a href="/khuyenmai.php"><i class="fas fa-percent"></i> KHUYẾN MÃI</a></li>
                    <li id="m"><a href="/lienhe.php"><i class="fas fa-phone"></i> LIÊN HỆ</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- JavaScript for enhanced functionality -->
    <script>
        $(document).ready(function() {
            // Smooth scrolling for anchor links
            $('a[href^="#"]').on('click', function(event) {
                var target = $(this.getAttribute('href'));
                if( target.length ) {
                    event.preventDefault();
                    $('html, body').stop().animate({
                        scrollTop: target.offset().top - 100
                    }, 1000);
                }
            });

            // Search form validation
            $('.search form').on('submit', function(e) {
                var searchInput = $(this).find('input[name="search"]');
                if(searchInput.val().trim() === '') {
                    e.preventDefault();
                    searchInput.focus();
                    alert('Vui lòng nhập từ khóa tìm kiếm');
                }
            });

            // Cart count animation
            function animateCartCount() {
                $('#sdt').addClass('animate__animated animate__bounce');
                setTimeout(function() {
                    $('#sdt').removeClass('animate__animated animate__bounce');
                }, 1000);
            }

            // Mobile menu toggle
            if (window.innerWidth <= 768) {
                $('#danhmucsp').on('click', function() {
                    $(this).find('.dssp').slideToggle();
                });
            }

            // Scroll effect for header
            $(window).scroll(function() {
                if ($(this).scrollTop() > 100) {
                    $('.header').addClass('scrolled');
                } else {
                    $('.header').removeClass('scrolled');
                }
            });
        });
    </script>
</body>
</html>
