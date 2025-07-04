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
    <link rel="stylesheet" type="text/css" href="/giaodien/mystyle.css">
    <title>TSL Shop - Cửa hàng trực tuyến</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            color: #333;
        }
        
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .topbar {
            background: rgba(0,0,0,0.1);
            padding: 8px 0;
            font-size: 14px;
        }
        
        .center {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .topbar .center {
            color: #fff;
        }
        
        .listtopbar {
            display: flex;
            list-style: none;
            gap: 30px;
        }
        
        .listtopbar li {
            position: relative;
        }
        
        .listtopbar a {
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
            padding: 5px 10px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        
        .listtopbar a:hover {
            background: rgba(255,255,255,0.1);
            transform: translateY(-1px);
        }
        
        #loginout {
            position: absolute;
            top: 100%;
            right: 0;
            background: #fff;
            min-width: 180px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            border-radius: 8px;
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
        }
        
        .listtopbar li:hover #loginout {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        #loginout li {
            width: 100%;
        }
        
        #loginout a {
            color: #333;
            padding: 12px 16px;
            border-radius: 0;
            display: block;
            transition: background 0.3s ease;
        }
        
        #loginout a:hover {
            background: #f8f9fa;
            transform: none;
        }
        
        #adm a {
            color: #dc3545 !important;
            font-weight: 500;
        }
        
        .cenbar {
            padding: 20px 0;
        }
        
        .cenbar .center {
            display: grid;
            grid-template-columns: auto 1fr auto;
            gap: 30px;
            align-items: center;
        }
        
        .logo img {
            height: 50px;
            width: auto;
            filter: brightness(0) invert(1);
        }
        
        .search {
            flex: 1;
            max-width: 500px;
        }
        
        .search form {
            display: flex;
            background: #fff;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .search input {
            flex: 1;
            padding: 12px 20px;
            border: none;
            outline: none;
            font-size: 16px;
        }
        
        .search button {
            background: #ff6b6b;
            color: #fff;
            border: none;
            padding: 12px 20px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        
        .search button:hover {
            background: #ff5252;
        }
        
        .lienlac {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #fff;
        }
        
        #phone {
            background: rgba(255,255,255,0.2);
            padding: 12px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }
        
        #phone:hover {
            background: rgba(255,255,255,0.3);
            transform: scale(1.1);
        }
        
        #phone i {
            font-size: 20px;
        }
        
        #number a {
            color: #fff;
            text-decoration: none;
        }
        
        #sdt {
            font-weight: 500;
            font-size: 16px;
        }
        
        #dd {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .thanhmenu {
            background: rgba(0,0,0,0.1);
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        
        .menu {
            display: flex;
            list-style: none;
            align-items: center;
        }
        
        #danhmucsp {
            position: relative;
            background: #ff6b6b;
            margin-right: 20px;
        }
        
        #danhmucsp > a, #danhmucsp > span {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #fff;
            text-decoration: none;
            padding: 15px 20px;
            font-weight: 500;
            cursor: pointer;
        }
        
        .dssp {
            position: absolute;
            top: 100%;
            left: 0;
            background: #fff;
            min-width: 250px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            border-radius: 0 0 8px 8px;
            overflow: hidden;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
        }
        
        #danhmucsp:hover .dssp {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .dssp li {
            border-bottom: 1px solid #eee;
        }
        
        .dssp li:last-child {
            border-bottom: none;
        }
        
        .dssp a {
            color: #333;
            text-decoration: none;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }
        
        .dssp a:hover {
            background: #f8f9fa;
            color: #ff6b6b;
            padding-left: 25px;
        }
        
        .dssp i {
            color: #ff6b6b;
        }
        
        #m {
            margin-right: 30px;
        }
        
        #m a {
            color: #fff;
            text-decoration: none;
            padding: 15px 0;
            font-weight: 500;
            position: relative;
            transition: all 0.3s ease;
        }
        
        #m a:hover {
            color: #ff6b6b;
        }
        
        #m a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: #ff6b6b;
            transition: width 0.3s ease;
        }
        
        #m a:hover::after {
            width: 100%;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .topbar {
                display: none;
            }
            
            .cenbar .center {
                grid-template-columns: 1fr;
                gap: 15px;
                text-align: center;
            }
            
            .search {
                order: 3;
            }
            
            .menu {
                flex-direction: column;
                align-items: stretch;
            }
            
            #danhmucsp {
                margin-right: 0;
                margin-bottom: 10px;
            }
            
            #m {
                margin-right: 0;
                text-align: center;
            }
            
            .dssp {
                position: static;
                opacity: 1;
                visibility: visible;
                transform: none;
                box-shadow: none;
                border-radius: 0;
                margin-top: 10px;
            }
        }
        
        /* Animation cho cart count */
        @keyframes bounce {
            0%, 20%, 60%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-5px);
            }
            80% {
                transform: translateY(-3px);
            }
        }
        
        #sdt {
            animation: bounce 2s infinite;
        }
    </style>
</head>
<body>
    <div class="header">
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
                                        echo '<span style="color: #ff6b6b; font-weight: 500;">Admin: '.$username.'</span>';
                                    } else {
                                        echo '<span>'.$username.'</span>';
                                    }
                                } else {
                                    echo 'Tài khoản';
                                }
                            ?>
                        </a>
                        <ul id="loginout">
                        <?php
                        if(isset($_SESSION['username']) && $_SESSION['username']) {
                            if ($row['Quyen'] == 1) {
                                echo '<li id="adm"><a href="/AdminPanel"><i class="fas fa-cog"></i> Admin Panel</a></li>';
                            }    
                            echo '
                            <li id="login"><a href="/taikhoan/index.php?&id='.$row['MaTaiKhoan'].'"><i class="fas fa-user-circle"></i> Trang tài khoản</a></li>
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
        
        <div class="cenbar">
            <div class="center">
                <a class="logo" href="/"><img src="../logo2.png" alt="TSL Shop"></a>
                <div class="search">
                    <form action="timkiem.php" method="get">
                        <input type="text" name="search" placeholder="Tìm kiếm sản phẩm...">
                        <button type="submit" name="ok">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
                <div class="lienlac">
                    <div id="phone">
                        <a href="../giohang/index.php">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </div>
                    <div id="number">
                        <?php
                            if(isset($_SESSION['cart'])) {
                                echo '<a href="../giohang/index.php">
                                <span id="sdt">('.count($_SESSION['cart']).') sản phẩm</span></a><br/>';
                            } else { 
                                echo '<a href="../giohang/index.php">
                                <span id="sdt">(0) sản phẩm</span></a><br/>';
                            }
                        ?>
                        <a href="../giohang/index.php">
                            <span id="dd">Giỏ hàng</span>
                        </a>
                    </div> 
                </div> 
            </div>
        </div>
        
        <div class="thanhmenu">
            <div class="center">
                <ul class="menu">
                    <li id="danhmucsp">
                        <span><i class="fas fa-bars"></i> <b>Danh mục sản phẩm</b></span>
                        <ul class="dssp">
                            <?php
                            $loai = "SELECT * FROM loaisanpham WHERE BiXoa = 0";
                            $loaisp = mysqli_query($connection, $loai);
                            while($row = mysqli_fetch_array($loaisp)) {                           
                                $id = $row['MaLoaiSanPham'];
                                echo '<li>
                                <a href="/SanPham/index.php?mod=dssp&id='.$id.'">
                                <i class="fas fa-tag"></i> '.$row['TenLoaiSanPham'].'</a></li>';
                            }
                            ?>
                        </ul>
                    </li>
                    <li id="m"><a href="/"><i class="fas fa-home"></i> TRANG CHỦ</a></li>
                    <li id="m"><a href="/"><i class="fas fa-percent"></i> KHUYẾN MÃI</a></li>
                    <li id="m"><a href="/"><i class="fas fa-phone"></i> LIÊN HỆ</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
