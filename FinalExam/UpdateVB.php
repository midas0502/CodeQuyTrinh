<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="./css/baitap5.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<?php 
    //Thêm header vào trang sửa
    //B1:Kết nối đến database
    include "Connection.php";
    //Lấy giá trị id được truyền từ trang Home.php 
     $matb=$_GET['matb'];
     //Tim kiem theo id
    $sql1="select * from thietbi where matb='$matb'";
    $data=mysqli_query($con,$sql1);
    //Hiển thị mảng $data lên các điều khiển của trang web
    //B2: Tạo câu lệnh truy vấn
     if(isset($_POST['btnSua'])){
        $tentb=$_POST['txtTenTB'];
        $khophong=$_POST['txtkhophong'];
        $monnganh=$_POST['txtmonnganh'];
        $soluong=$_POST['txtSoLuong'];
        $hong=$_POST['txtHong'];
        $mat=$_POST['txtMat'];
        $dvt=$_POST['txtDvt'];
        $loai=$_POST['txtloai'];
        $nguongoc=$_POST['txtnguongoc'];
        $sql="update thietbi set tentb='$tentb', khophong='$khophong', monnganh='$monnganh', soluong = '$soluong', hong='$hong', mat='$mat', dvt='$dvt', loai='$loai', nguongoc='$nguongoc' where matb='$matb'";
        $kq=mysqli_query($con,$sql);
        if($kq){
            echo '<script>alert("Sửa thành công")</script>';
            echo '<script>window.location.href = "Home.php";</script>';
            exit; // Thêm exit để dừng việc thực thi mã PHP sau khi chuyển hướng
        }
        else{
             echo '<script>alert("Sửa thất bại")</script>';
             echo '<script>window.location.href = "UpdateVB.php";</script>';
            exit; // Thêm exit để dừng việc thực thi mã PHP sau khi chuyển hướng
        }
       

     }
     //B3:Ngắt kết nối
?>
<div class="container-fluid col-md-6" >
    <br> <br>
    <form action="" method="post" style="width: 600px; box-shadow: rgb(210,210,210) 0px 0px 5px; padding: 10px;padding-right: 30px;; margin-top: 20px" >
    <h5 style="text-align: center">SỬA THÔNG TIN THIẾT BỊ</h5>
        <table style="width: 100%">
            <?php
                if(isset($data) && $data!=""):
                    while($row = mysqli_fetch_assoc($data)):
                        ?>
            <tr>
                <td style="width: 150px; padding: 10px;">
                <label for="">Mã thiết bị</label>
                </td>
                <td>
                    <input type="text" name="txtmatb" class="form-control" value="<?php echo $row['matb']?>" readonly>
                </td>
            </tr>
            <tr>
                <td style="width: 150px; padding: 10px">
                <label for="">Tên thiết bị</label>
                </td>
                <td>
                    <input type="text" name="txtTenTB" class="form-control"value="<?php echo $row['tentb']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 150px; padding: 10px">
                <label for="">Số lượng</label>
                </td>
                <td>
                    <input type="number" name="txtSoLuong" class="form-control"value="<?php echo $row['soluong']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 150px; padding: 10px">
                <label for="">Hỏng</label>
                </td>
                <td>
                    <input type="number" name="txtHong" class="form-control"value="<?php echo $row['hong']?>">
                </td>
            </tr>
            <tr>
                <td style="width: 150px; padding: 10px">
                <label for="">Mất</label>
                </td>
                <td>
                    <input type="number" min=0 name="txtMat" class="form-control"value="<?php echo $row['mat']?>">
                </td>
            </tr>
            
            <tr>
                <td style="width: 150px; padding: 10px">
                <label for="">Đơn vị tính</label>
                </td>
                <td>
                    <input type="text" name="txtDvt" class="form-control"value="<?php echo $row['dvt']?>">
                </td>
            </tr>
            <?php endwhile;?>
            <?php endif;?>   
        </table>

        <div>
        <!-- Danh sách kho phòng -->
  <div style="width: 23%; display: inline-block; margin-left: 20px">
   Kho phòng
    <select class="form-select" name="txtkhophong">
      <?php        
        $sql2 = "SELECT * FROM khophong";
        $result = $con->query($sql2);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<option value ='".$row["tenkp"]."'>".$row["tenkp"]."</option>"   ;          
            }
        }
      ?>
   </select>
   </div>

  <!-- Danh sách môn ngành -->
   <div style="width: 23%; display: inline-block">
    Môn ngành
    <select class="form-select" name="txtmonnganh">
      <option value="">---</option>
        <?php        
          $sql2 = "SELECT * FROM dsmonnganh";
          $result = $con->query($sql2);
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<option value ='".$row["tenmn"]."'>".$row["tenmn"]."</option>"   ;          
              }
          }
        ?>
    </select>
   </div>
   
  <!-- Danh sách phân loại -->
   <div style="width: 23%; display: inline-block">
    Phân loại
    <select class="form-select" name="txtloai">
        <?php        
          $sql2 = "SELECT * FROM phanloaitb";
          $result = $con->query($sql2);
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<option value ='".$row["tenpl"]."'>".$row["tenpl"]."</option>"   ;          
              }
          }
      ?>
      </select>
   </div>
   
  <!-- Danh sách nguồn cấp -->
  <div style="width: 23%; display: inline-block">
   Nguồn gốc
  <select class="form-select" name="txtnguongoc">
      <?php        
        $sql2 = "SELECT * FROM dsnguoncap";
        $result = $con->query($sql2);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<option value ='".$row["ten"]."'>".$row["ten"]."</option>"   ;          
            }
        }
      ?>
   </select>
   </div>
</div>

 <input type="submit" value="Sửa" name="btnSua"class="btn btn-success" style="width: 200px; margin-left: 230px; margin-top:20px">
    </form>

</div>