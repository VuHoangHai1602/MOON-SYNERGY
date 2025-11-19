<?php
include("../../config/config.php");

$id = $_GET['idtaikhoan'];

// --- Xử lý CẬP NHẬT/SỬA tài khoản ---
if(isset($_POST['suataikhoan'])){
    $hovaten = $_POST['hovaten'];
    $email = $_POST['email'];
    $dienthoai = $_POST['dienthoai'];
    $matkhau_moi = $_POST['matkhau']; // Lấy mật khẩu mới

    // Khởi tạo truy vấn UPDATE cơ bản (không đổi mật khẩu)
    $sql_update = "UPDATE tbl_dangky 
                   SET hovaten='".$hovaten."', email='".$email."', dienthoai='".$dienthoai."'";
                   
    // Nếu có nhập mật khẩu mới, thì mã hóa và thêm vào truy vấn UPDATE
    if(!empty($matkhau_moi)){
        $matkhau_hashed = md5($matkhau_moi);
        $sql_update .= ", matkhau='".$matkhau_hashed."'"; // matkhau là tên cột mật khẩu trong database của bạn
    }

    // Kết thúc truy vấn UPDATE
    $sql_update .= " WHERE id_dangky='".$id."'";

    mysqli_query($mysqli, $sql_update);
    header('Location:../../index.php?action=quanlitaikhoan&query=lietke');

} 
// --- Xử lý XOÁ tài khoản ---
elseif(isset($_GET['idtaikhoan'])){
    $sql_xoa = "DELETE FROM tbl_dangky WHERE id_dangky='".$id."'";
    mysqli_query($mysqli, $sql_xoa);
    header('Location:../../index.php?action=quanlitaikhoan&query=lietke');
}

?>