<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSL Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: #fff;
            font-size: 14px;
            color: #444;
            line-height: 1.6;
        }

        /* Header Styles */
        .header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .topbar {
            background: #189eff;
            color: #fff;
            padding: 8px 0;
            font-size: 13px;
        }

        .center {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
        }

        .listtopbar {
            position: absolute;
            top: 0;
            right: 20px;
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            height: 100%;
        }

        .listtopbar li {
            margin-left: 20px;
            position: relative;
        }

        .listtopbar a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .listtopbar a:hover {
            color: #ffba00;
        }

        /* Main header */
        .cenbar {
            background: #189eff;
            padding: 15px 0;
        }

        .logo img {
            height: 50px;
        }

        .search {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            align-items: center;
        }

        .search input {
            width: 400px;
            height: 40px;
            padding: 0 20px;
            border: none;
            border-radius: 20px 0 0 20px;
            font-size: 14px;
            outline: none;
        }

        .search button {
            height: 40px;
            width: 50px;
            background: #ffba00;
            border: none;
            border-radius: 0 20px 20px 0;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s;
        }

        .search button:hover {
            background: #e5a500;
        }

        .cart-section {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            align-items: center;
            color: #fff;
        }

        .cart-icon {
            width: 50px;
            height: 50px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            margin-right: 15px;
            transition: background 0.3s;
        }

        .cart-icon:hover {
            background: rgba(255,255,255,0.3);
        }

        .cart-info {
            font-size: 14px;
        }

        .cart-count {
            font-weight: bold;
            color: #ffba00;
        }

        /* Navigation Menu */
        .thanhmenu {
            background: #393a44;
            padding: 0;
        }

        .menu {
            list-style: none;
            display: flex;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        .menu-category {
            background: #ffba00;
            color: #fff;
            padding: 15px 30px;
            font-size: 16px;
            font-weight: bold;
            position: relative;
            cursor: pointer;
            transition: background 0.3s;
        }

        .menu-category:hover {
            background: #e5a500;
        }

        .menu-item {
            padding: 15px 25px;
        }

        .menu-item a {
            color: #fff;
            text-decoration: none;
            font-size: 15px;
            transition: color 0.3s;
        }

        .menu-item a:hover {
            color: #189eff;
        }

        /* Dropdown Menu */
        .dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            background: #fff;
            min-width: 250px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.175);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .menu-category:hover .dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown a {
            display: block;
            padding: 12px 20px;
            color: #444;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s;
            border-bottom: 1px solid #f0f0f0;
        }

        .dropdown a:hover {
            background: #189eff;
            color: #fff;
        }

        /* Main Content */
        .main-content {
            margin-top: 140px;
            padding: 40px 0;
        }

        /* Banner Section */
        .banner-section {
            margin-bottom: 60px;
        }

        .banner-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 30px;
            align-items: stretch;
        }

        .banner-item {
            position: relative;
            height: 300px;
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .banner-item:hover {
            transform: translateY(-5px);
        }

        .banner-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .banner-item:hover img {
            transform: scale(1.05);
        }

        .banner-small {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .banner-small .banner-item {
            height: 142px;
        }

        /* Products Section */
        .products-section {
            margin-bottom: 60px;
        }

        .section-title {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
        }

        .section-title h2 {
            font-size: 32px;
            color: #333;
            margin-bottom: 10px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: #189eff;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .product-card {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .product-image {
            width: 100%;
            height: 250px;
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.05);
        }

        .product-info {
            padding: 20px;
        }

        .product-title {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 18px;
            color: #189eff;
            font-weight: bold;
        }

        /* Footer */
        .footer {
            background: #189eff;
            color: #fff;
            text-align: center;
            padding: 40px 0;
            margin-top: 80px;
        }

        .footer h3 {
            font-size: 32px;
            margin-bottom: 20px;
        }

        .footer p {
            font-size: 16px;
            opacity: 0.8;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header {
                position: relative;
            }

            .main-content {
                margin-top: 0;
            }

            .search {
                position: relative;
                left: auto;
                top: auto;
                transform: none;
                margin: 20px 0;
            }

            .search input {
                width: 100%;
            }

            .cart-section {
                position: relative;
                right: auto;
                top: auto;
                transform: none;
                justify-content: center;
                margin: 20px 0;
            }

            .banner-grid {
                grid-template-columns: 1fr;
            }

            .banner-small {
                flex-direction: row;
            }

            .menu {
                flex-direction: column;
                align-items: stretch;
            }

            .menu-category {
                text-align: center;
            }

            .products-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px;
            }
        }

        /* Login Dropdown */
        .login-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background: #fff;
            min-width: 200px;
            border-radius: 5px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .listtopbar li:hover .login-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .login-dropdown a {
            display: block;
            padding: 10px 20px;
            color: #333;
            text-decoration: none;
            transition: background 0.3s;
        }

        .login-dropdown a:hover {
            background: #f0f0f0;
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animated {
            animation: fadeInUp 0.8s ease-out;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <!-- Top Bar -->
        <div class="topbar">
            <div class="center">
                <span>Mở cửa: 9h đến 20h, chủ nhật 10h đến 16h</span>
                <ul class="listtopbar">
                    <li>
                        <a href="#"><i class="fas fa-user"></i> Tài khoản</a>
                        <div class="login-dropdown">
                            <a href="#"><i class="fas fa-sign-in-alt"></i> Đăng nhập</a>
                            <a href="#"><i class="fas fa-user-plus"></i> Đăng ký</a>
                        </div>
                    </li>
                    <li><a href="#"><i class="fas fa-star"></i> Khuyến mãi hot</a></li>
                </ul>
            </div>
        </div>

        <!-- Main Header -->
        <div class="cenbar">
            <div class="center">
                <a class="logo" href="#">
                    <img src="https://via.placeholder.com/150x50/189eff/ffffff?text=TSL+SHOP" alt="TSL Shop">
                </a>
                
                <div class="search">
                    <input type="text" placeholder="Tìm kiếm sản phẩm...">
                    <button type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>

                <div class="cart-section">
                    <a href="#" class="cart-icon">
                        <i class="fas fa-shopping-basket"></i>
                    </a>
                    <div class="cart-info">
                        <div class="cart-count">(0) sản phẩm</div>
                        <div>Giỏ hàng</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <div class="thanhmenu">
            <div class="center">
                <ul class="menu">
                    <li class="menu-category">
                        <i class="fas fa-bars"></i> Danh sách sản phẩm
                        <div class="dropdown">
                            <a href="#"><i class="fas fa-laptop"></i> Laptop</a>
                            <a href="#"><i class="fas fa-mobile-alt"></i> Điện thoại</a>
                            <a href="#"><i class="fas fa-tablet-alt"></i> Tablet</a>
                            <a href="#"><i class="fas fa-headphones"></i> Phụ kiện</a>
                            <a href="#"><i class="fas fa-gamepad"></i> Gaming</a>
                        </div>
                    </li>
                    <li class="menu-item"><a href="#">TRANG CHỦ</a></li>
                    <li class="menu-item"><a href="#">KHUYẾN MÃI</a></li>
                    <li class="menu-item"><a href="#">LIÊN HỆ</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="center">
            <!-- Banner Section -->
            <div class="banner-section animated">
                <div class="banner-grid">
                    <div class="banner-item">
                        <img src="https://via.placeholder.com/400x300/189eff/ffffff?text=LAPTOP+SALE" alt="Laptop Sale">
                    </div>
                    <div class="banner-item">
                        <img src="https://via.placeholder.com/400x300/ffba00/ffffff?text=SMARTPHONE" alt="Smartphone">
                    </div>
                    <div class="banner-small">
                        <div class="banner-item">
                            <img src="https://via.placeholder.com/400x150/28a745/ffffff?text=ACCESSORIES" alt="Accessories">
                        </div>
                        <div class="banner-item">
                            <img src="https://via.placeholder.com/400x150/dc3545/ffffff?text=GAMING" alt="Gaming">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Section -->
            <div class="products-section animated">
                <div class="section-title">
                    <h2>Sản phẩm nổi bật</h2>
                </div>
                
                <div class="products-grid">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="https://via.placeholder.com/280x250/f8f9fa/333333?text=Laptop+Gaming" alt="Laptop Gaming">
                        </div>
                        <div class="product-info">
                            <div class="product-title">Laptop Gaming MSI</div>
                            <div class="product-price">25.990.000 VNĐ</div>
                        </div>
                    </div>

                    <div class="product-card">
                        <div class="product-image">
                            <img src="https://via.placeholder.com/280x250/f8f9fa/333333?text=iPhone+15" alt="iPhone 15">
                        </div>
                        <div class="product-info">
                            <div class="product-title">iPhone 15 Pro Max</div>
                            <div class="product-price">32.990.000 VNĐ</div>
                        </div>
                    </div>

                    <div class="product-card">
                        <div class="product-image">
                            <img src="https://via.placeholder.com/280x250/f8f9fa/333333?text=Samsung+Galaxy" alt="Samsung Galaxy">
                        </div>
                        <div class="product-info">
                            <div class="product-title">Samsung Galaxy S24</div>
                            <div class="product-price">22.990.000 VNĐ</div>
                        </div>
                    </div>

                    <div class="product-card">
                        <div class="product-image">
                            <img src="https://via.placeholder.com/280x250/f8f9fa/333333?text=MacBook+Air" alt="MacBook Air">
                        </div>
                        <div class="product-info">
                            <div class="product-title">MacBook Air M2</div>
                            <div class="product-price">28.990.000 VNĐ</div>
                        </div>
                    </div>

                    <div class="product-card">
                        <div class="product-image">
                            <img src="https://via.placeholder.com/280x250/f8f9fa/333333?text=iPad+Pro" alt="iPad Pro">
                        </div>
                        <div class="product-info">
                            <div class="product-title">iPad Pro 12.9 inch</div>
                            <div class="product-price">31.990.000 VNĐ</div>
                        </div>
                    </div>

                    <div class="product-card">
                        <div class="product-image">
                            <img src="https://via.placeholder.com/280x250/f8f9fa/333333?text=AirPods+Pro" alt="AirPods Pro">
                        </div>
                        <div class="product-info">
                            <div class="product-title">AirPods Pro Gen 2</div>
                            <div class="product-price">6.990.000 VNĐ</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="center">
            <h3>TSL SHOP</h3>
            <p>Cửa hàng công nghệ hàng đầu Việt Nam</p>
            <p>Hotline: 1900 1234 | Email: info@tslshop.com</p>
        </div>
    </div>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Add animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.products-section, .banner-section').forEach(section => {
            observer.observe(section);
        });

        // Search functionality
        document.querySelector('.search button').addEventListener('click', function(e) {
            e.preventDefault();
            const searchTerm = document.querySelector('.search input').value;
            if (searchTerm.trim()) {
                alert(`Tìm kiếm: ${searchTerm}`);
            }
        });

        // Cart update simulation
        let cartCount = 0;
        document.querySelectorAll('.product-card').forEach(card => {
            card.addEventListener('click', function() {
                cartCount++;
                document.querySelector('.cart-count').textContent = `(${cartCount}) sản phẩm`;
                
                // Add visual feedback
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });

        // Mobile menu toggle
        function toggleMobileMenu() {
            const menu = document.querySelector('.menu');
            menu.classList.toggle('mobile-open');
        }

        // Responsive search
        function handleResize() {
            if (window.innerWidth <= 768) {
                document.querySelector('.search').style.position = 'relative';
            } else {
                document.querySelector('.search').style.position = 'absolute';
            }
        }

        window.addEventListener('resize', handleResize);
        handleResize();
    </script>
</body>
</html>
