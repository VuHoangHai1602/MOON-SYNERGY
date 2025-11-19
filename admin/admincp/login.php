<?php
session_start();
include('config/config.php');

if(isset($_POST['dangnhap'])){
    $taikhoan = $_POST['username'];
    $matkhau = md5($_POST['password']);
    $sql = "SELECT * FROM tbl_admin WHERE username='".$taikhoan."' AND password = '".$matkhau."' LIMIT 1";
    $row = mysqli_query($mysqli,$sql);
    $count = mysqli_num_rows($row);
    if($count>0){
        $_SESSION['dangnhap'] = $taikhoan;
        header("Location:index.php");
        exit();
    }else{
        echo '<script>alert("Tài khoản hoặc Mật khẩu không đúng, vui lòng nhập lại.")</script>';
        header("Location:login.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập ADMINCP</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #eef3f7;
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .wrapper-login {
            width: 350px;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }

        .wrapper-login h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-size: 22px;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 15px;
            width: 100%;
        }

        .form-group label {
            display: block;
            font-size: 15px;
            color: #444;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
            outline: none;
            transition: 0.2s;
        }

        .form-group input:focus {
            border-color: #0099ff;
            box-shadow: 0 0 5px rgba(0,153,255,0.5);
        }

        .btn-login {
            width: 100%;
            padding: 10px;
            background: #007bff;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.2s;
        }

        .btn-login:hover {
            background: #005fcc;
        }
    </style>
</head>

<body>
<div class="wrapper-login">

    <h2>Đăng nhập Admin</h2>

    <form action="" autocomplete="off" method="POST">
        
        <div class="form-group">
            <label>Tài khoản</label>
            <input type="text" name="username" required>
        </div>

        <div class="form-group">
            <label>Mật khẩu</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" name="dangnhap" class="btn-login">Đăng nhập</button>

    </form>

</div>
</body>
</html>
