<?php
include("../../config/config.php");

$tensanpham = $_POST['tensanpham'];
$masp = $_POST['masp'];
$giasp = $_POST['giasp'];
$soluong = $_POST['soluong'];
$tomtat = $_POST['tomtat'];
$noidung = $_POST['noidung'];
//xuly hinh anh
$hinhanh = $_FILES['hinhanh']['name'];
$hinhanh_tmp  = $_FILES['hinhanh']['tmp_name'];
$hinhanh = time().'_'.$hinhanh;
$tinhtrang = $_POST['tinhtrang'];
$danhmuc = $_POST['danhmuc'];

if(isset($_POST['themsanpham'])){
    //them
    $sql_them = "INSERT INTO tbl_sanpham(tensanpham,masp,giasp,soluong,noidung,tomtat,hinhanh,tinhtrang,id_danhmuc) VALUE('".$tensanpham."','".$masp."','".$giasp."','".$soluong."','".$noidung."','".$tomtat."','".$hinhanh."','".$tinhtrang."','".$danhmuc."')";
    mysqli_query($mysqli,$sql_them);
    move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh);
    header('Location:../../index.php?action=quanlysp&query=them');
}elseif(isset($_POST['suasanpham'])){
    //sua
    if($hinhanh!=''){
        move_uploaded_file($hinhanh_tmp,'uploads/'.$hinhanh);
        $sql_update = "UPDATE tbl_sanpham SET tensanpham='".$tensanpham."',masp='".$masp."',giasp='".$giasp."',soluong='".$soluong."',noidung='".$noidung."',tomtat='".$tomtat."',hinhanh='".$hinhanh."',tinhtrang='".$tinhtrang."',danhmuc='".$danhmuc."' WHERE id_sanpham = '$_GET[idsanpham]'";
        //xoa hinh anh cu
        $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$_GET[idsanpham]' LIMIT 1";
        $query = mysqli_query($mysqli,$sql);
        while($row = mysqli_fetch_array($query)){
            unlink('uploads/'.$row['hinhanh']);
        }
    }else{
        $sql_update = "UPDATE tbl_sanpham SET tensanpham='".$tensanpham."',masp='".$masp."',giasp='".$giasp."',soluong='".$soluong."',noidung='".$noidung."',tomtat='".$tomtat."',tinhtrang='".$tinhtrang."',danhmuc='".$danhmuc."' WHERE id_sanpham = '$_GET[idsanpham]'";
    }
    mysqli_query($mysqli,$sql_update);
        header('Location:../../index.php?action=quanlysp&query=them');
}else{
    $id=$_GET['idsanpham'];
    $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$id' LIMIT 1";
    $query = mysqli_query($mysqli,$sql);
    while($row = mysqli_fetch_array($query)){
        unlink('uploads/'.$row['hinhanh']);
    }
    $sql_xoa = "DELETE FROM tbl_sanpham WHERE id_sanpham='".$id."'";
    mysqli_query($mysqli,$sql_xoa);
    header('Location:../../index.php?action=quanlysp&query=them');
}
?>