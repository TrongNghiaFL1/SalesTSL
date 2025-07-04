<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Tài Khoản</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 800px;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .header h2 {
            font-size: 2.5em;
            margin-bottom: 10px;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            position: relative;
            z-index: 1;
        }

        .header p {
            font-size: 1.1em;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .form-container {
            padding: 40px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .form-group {
            position: relative;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 0.95em;
        }

        .required::after {
            content: " *";
            color: #e74c3c;
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e1e8ed;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #fff;
            outline: none;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .form-control:hover {
            border-color: #667eea;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-top: 30px;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: transparent;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-secondary:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }

        .login-already {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }

        .login-already a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .login-already a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .form-container {
                padding: 30px 20px;
            }
            
            .header {
                padding: 25px 20px;
            }
            
            .header h2 {
                font-size: 2em;
            }
            
            .form-actions {
                flex-direction: column;
                gap: 15px;
            }
            
            .btn {
                width: 100%;
            }
        }

        /* Input Animation */
        .form-group {
            position: relative;
        }

        .form-control:focus + .form-label,
        .form-control:not(:placeholder-shown) + .form-label {
            transform: translateY(-25px) scale(0.85);
            color: #667eea;
        }

        /* Success Message */
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }

        /* Error Message */
        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>ĐĂNG KÝ TÀI KHOẢN</h2>
            <p>Nếu chưa có tài khoản vui lòng đăng ký tại đây</p>
        </div>
        
        <div class="form-container">
            <form action="xulydangky.php" method="POST" onsubmit="return KiemTra()">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="TenDangNhap" class="required">Tên đăng nhập</label>
                        <input type="text" id="TenDangNhap" name="TenDangNhap" class="form-control" placeholder="Nhập tên đăng nhập">
                    </div>
                    
                    <div class="form-group">
                        <label for="password" class="required">Mật khẩu</label>
                        <input type="password" id="password" name="MatKhau" class="form-control" placeholder="Nhập mật khẩu">
                    </div>
                    
                    <div class="form-group">
                        <label for="hoten">Họ và tên</label>
                        <input type="text" id="hoten" name="HoTen" class="form-control" placeholder="Nhập họ và tên">
                    </div>
                    
                    <div class="form-group">
                        <label for="diachi">Địa chỉ</label>
                        <input type="text" id="diachi" name="DiaChi" class="form-control" placeholder="Nhập địa chỉ">
                    </div>
                    
                    <div class="form-group">
                        <label for="sodienthoai">Số điện thoại</label>
                        <input type="tel" id="sodienthoai" name="DienThoai" class="form-control" placeholder="Nhập số điện thoại">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="Email" class="form-control" placeholder="Nhập email">
                    </div>
                    
                    <div class="form-group">
                        <label for="ngaysinh">Ngày sinh</label>
                        <input type="date" id="ngaysinh" name="NgaySinh" class="form-control">
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="submit" name="dangky" class="btn btn-primary">
                        Đăng ký
                    </button>
                    <a href="/dangnhap.php" class="btn btn-secondary">
                        Đăng nhập
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function KiemTra() {
            var tendangnhap = document.getElementById('TenDangNhap').value;
            var matkhau = document.getElementById('password').value;
            var hoten = document.getElementById('hoten').value;
            var diachi = document.getElementById('diachi').value;
            var sdt = document.getElementById('sodienthoai').value;
            var email = document.getElementById('email').value;
            var ngaysinh = document.getElementById('ngaysinh').value;
            
            if (tendangnhap == "" || matkhau == "" || hoten == "" || diachi == "" || sdt == "" || email == "" || ngaysinh == "") {
                alert("Vui lòng điền đầy đủ thông tin.");
                return false;
            }
            if (tendangnhap.length < 5) {
                alert("Tên đăng nhập phải nhiều hơn 4 ký tự.");
                return false;
            }
            if (matkhau.length < 6) {
                alert("Mật khẩu phải nhiều hơn 6 ký tự.");
                return false;
            }
            return true;
        }

        // Add smooth scroll effect
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                input.addEventListener('blur', function() {
                    if (this.value === '') {
                        this.parentElement.classList.remove('focused');
                    }
                });
            });
        });
    </script>
</body>
</html>
