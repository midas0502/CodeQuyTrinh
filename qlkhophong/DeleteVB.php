<?php
    //kết nối database
    include_once "Connection.php";
    //Lấy giá trị id được truyền từ trang Home.php 
    $makp=$_GET['makp'];
    //thực hiện câu lệnh sql để xóa
    $sql="delete from khophong where makp='$makp'";
    $kq=mysqli_query($con,$sql);
    //Đóng kết nối
    mysqli_close($con);
    if($kq){
        echo '<script>alert("Xóa thành công")</script>';
        echo '<script>window.location.href = "Home.php";</script>';
        exit; // Thêm exit để dừng việc thực thi mã PHP sau khi chuyển hướng
    }
    else{
        echo '<script>alert("Xóa thất bại")</script>';
        echo '<script>window.location.href = "Home.php";</script>';
        exit; // Thêm exit để dừng việc thực thi mã PHP sau khi chuyển hướng
    }
?>