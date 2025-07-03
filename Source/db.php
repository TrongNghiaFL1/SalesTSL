<?php
$connection = mysqli_connect('db', 'webuser', 'webpass', 'web3');  // Sửa lại username và password
mysqli_query($connection, "SET NAMES 'utf8'");
if (!$connection) {
    exit('Kết nối không t   hành công!');
}
?>
