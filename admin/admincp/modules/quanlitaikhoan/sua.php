<?php
    $sql_sua_tk = "SELECT * FROM tbl_dangky WHERE id_dangky='$_GET[idtaikhoan]' LIMIT 1";
    $query_sua_tk = mysqli_query($mysqli, $sql_sua_tk);
    $row_tk = mysqli_fetch_array($query_sua_tk);
?>

<h3>Sửa thông tin Tài khoản</h3>

<form method="POST" action="modules/quanlitaikhoan/xuly.php?idtaikhoan=<?php echo $row_tk['id_dangky'] ?>">
    <table class="table_themsua">
        <tr>
            <td>Họ và Tên</td>
            <td><input type="text" name="hovaten" value="<?php echo $row_tk['hovaten'] ?>"></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email" value="<?php echo $row_tk['email'] ?>"></td>
        </tr>
        <tr>
            <td>Điện thoại</td>
            <td><input type="text" name="dienthoai" value="<?php echo $row_tk['dienthoai'] ?>"></td>
        </tr>
        <tr>
            <td>Mật khẩu mới</td>
            <td><input type="password" name="matkhau" placeholder="Để trống nếu không muốn đổi"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="suataikhoan" value="Cập nhật tài khoản"></td>
        </tr>
    </table>
</form>