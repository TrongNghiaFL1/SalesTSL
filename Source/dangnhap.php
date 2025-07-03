<?php
include('header.php');
if (isset($_SESSION['username']) && $_SESSION['username']){
    echo'<div class="success-message">
            <h3>Bạn đã đăng nhập thành công!</h3>
            <a href="/index.php" class="btn btn-primary">Quay về trang chủ</a>
          </div>';
} else {
    //Xử lý đăng nhập
if (isset($_POST['dangnhap'])) 
{
     
    //Lấy dữ liệu nhập vào
    $username = addslashes($_POST['TenDangNhap']);
    $password = addslashes($_POST['MatKhau']);
    //Kiểm tra tên đăng nhập có tồn tại không
    $sql = "SELECT TenDangNhap, MatKhau FROM taikhoan WHERE TenDangNhap='$username'";
    $query = mysqli_query($connection, $sql);
    if ($query == NULL) 
    {        
        echo '<div class="error-message">
                <p>Tên đăng nhập này không tồn tại. Vui lòng kiểm tra lại.</p>
                <a href="javascript: history.go(-1)" class="btn btn-secondary">Trở lại</a>
              </div>';
        exit;
    }
     
    //Lấy mật khẩu trong database ra
    $row = mysqli_fetch_array($query);
     
    //So sánh 2 mật khẩu có trùng khớp hay không
    if ($password != $row['MatKhau']) {
        echo '<div class="error-message">
                <p>Mật khẩu không đúng. Vui lòng nhập lại.</p>
                <a href="javascript: history.go(-1)" class="btn btn-secondary">Trở lại</a>
              </div>';
        exit;
    }
     
    //Lưu tên đăng nhập
    $_SESSION['username'] = $username;
    ChangeURL("../index.php");
    
}
?>

<style>
/* CSS cho giao diện đăng nhập */
.login-container {
    max-width: 450px;
    margin: 50px auto;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.breadcrumb {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 15px 25px;
    border-radius: 10px 10px 0 0;
    margin-bottom: 0;
}

.breadcrumb a {
    color: #fff;
    text-decoration: none;
    opacity: 0.8;
    transition: opacity 0.3s;
}

.breadcrumb a:hover {
    opacity: 1;
}

.login-form {
    background: white;
    padding: 40px;
    border-radius: 0 0 10px 10px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    border: 1px solid #e0e0e0;
}

.login-form h2 {
    text-align: center;
    color: #333;
    margin-bottom: 10px;
    font-size: 28px;
    font-weight: 600;
}

.login-form .subtitle {
    text-align: center;
    color: #666;
    margin-bottom: 30px;
    font-size: 14px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    color: #333;
    font-weight: 500;
    font-size: 14px;
}

.form-control {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #e0e0e0;
    border-radius: 6px;
    font-size: 16px;
    transition: border-color 0.3s, box-shadow 0.3s;
    box-sizing: border-box;
}

.form-control:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.btn {
    padding: 12px 24px;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s;
    text-align: center;
}

.btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #5a6268;
}

.btn-link {
    background: none;
    color: #667eea;
    text-decoration: none;
    margin-left: 15px;
}

.btn-link:hover {
    color: #764ba2;
    text-decoration: underline;
}

.form-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 30px;
}

.success-message, .error-message {
    max-width: 450px;
    margin: 50px auto;
    padding: 30px;
    text-align: center;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.success-message {
    background: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
}

.error-message {
    background: #f8d7da;
    border: 1px solid #f5c6cb;
    color: #721c24;
}

.success-message h3, .error-message p {
    margin-bottom: 20px;
}

/* Responsive */
@media (max-width: 768px) {
    .login-container {
        margin: 20px;
        max-width: none;
    }
    
    .login-form {
        padding: 30px 20px;
    }
    
    .form-actions {
        flex-direction: column;
        gap: 15px;
    }
    
    .btn-link {
        margin-left: 0;
    }
}
</style>

<div class="login-container">
    <div class="breadcrumb">
        <a href="/index.php">Trang chủ</a> > <span>Đăng nhập tài khoản</span>
    </div>
    
    <div class="login-form">
        <h2>ĐĂNG NHẬP TÀI KHOẢN</h2>
        <p class="subtitle">Nếu đã có tài khoản, đăng nhập tại đây</p>
        
        <form action='/dangnhap.php?do=login' method='POST'>
            <div class="form-group">
                <label for="TenDangNhap">Tên đăng nhập</label>
                <input id="TenDangNhap" type='text' name='TenDangNhap' class="form-control" placeholder="Nhập tên đăng nhập" />
            </div>
            
            <div class="form-group">
                <label for="MatKhau">Mật khẩu</label>
                <input id="MatKhau" type='password' name='MatKhau' class="form-control" placeholder="Nhập mật khẩu" />
            </div>
            
            <div class="form-actions">
                <input type='submit' name="dangnhap" value='Đăng nhập' class="btn btn-primary" onclick="return Check()" />
                <a href='dangky.php' class="btn-link">Đăng ký tài khoản</a>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    function Check() {
        var tendangnhap = document.getElementById('TenDangNhap').value;
        var matkhau = document.getElementById('MatKhau').value;
        
        if (tendangnhap.trim() === "" || matkhau.trim() === "") {
            alert("Vui lòng điền đầy đủ thông tin.");
            return false;
        }
        
        if (tendangnhap.length < 3) {
            alert("Tên đăng nhập phải có ít nhất 3 ký tự.");
            return false;
        }
        
        if (matkhau.length < 6) {
            alert("Mật khẩu phải có ít nhất 6 ký tự.");
            return false;
        }
        
        return true;
    }
</script>

<?php
}
?>
