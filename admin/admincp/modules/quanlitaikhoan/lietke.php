<?php
    $sql_lietke_taikhoan = "SELECT * FROM tbl_dangky ORDER BY id_dangky DESC";
    $query_lietke_taikhoan = mysqli_query($mysqli, $sql_lietke_taikhoan);
?>

<h3>Quản lý Tài khoản Khách hàng</h3>

<table class="table_lietke">
    <tr>
        <th>ID</th>
        <th>Họ và Tên</th>
        <th>Email</th>
        <th>Điện thoại</th>
        <th>Quản lý</th> </tr>
    <?php
    $i = 0;
    while($row = mysqli_fetch_array($query_lietke_taikhoan)){
        $i++;
    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $row['hovaten'] ?></td>
        <td><?php echo $row['email'] ?></td>
        <td><?php echo $row['dienthoai'] ?></td>
        <td>
            <a href="modules/quanlitaikhoan/xuly.php?idtaikhoan=<?php echo $row['id_dangky'] ?>">Xoá</a> | 
            <a href="index.php?action=quanlitaikhoan&query=sua&idtaikhoan=<?php echo $row['id_dangky'] ?>">Sửa</a>
        </td>
    </tr>
    <?php
    }
    ?>
</table>