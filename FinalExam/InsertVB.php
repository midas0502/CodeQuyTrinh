<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="./css/baitap5.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<?php 

    include "Connection.php";
    $matb = ""; // Khởi tạo giá trị mặc định cho ma
    $tentb = ""; // Khởi tạo giá trị mặc định cho tentb
    $khophong = ""; // Khởi tạo giá trị mặc định cho sohieuvb
    $monnganh = "";
    $soluong = "";
    $hong = "";
    $mat = "";
    $dvt = "";
    $loai = "";
    $nguongoc = "";
    if(isset($_POST['btnluu'])){
        $matb=$_POST['txtmatb'];
        $tentb=$_POST['txttentb'];
        $khophong=$_POST['txtkhophong'];
        $monnganh=$_POST['txtmonnganh'];
        $soluong=$_POST['txtsoluong'];
        $hong=$_POST['txthong'];
        $mat=$_POST['txtmat'];
        $dvt=$_POST['txtdvt'];
        $loai=$_POST['txtloai'];
        $nguongoc=$_POST['txtnguongoc'];
        $sql="select count(*) from thietbi where matb='$matb'";
        $kq=mysqli_query($con,$sql);
        $row = mysqli_fetch_array($kq);
        if($row[0] > 0){ // Kiểm tra nếu ID đã tồn tại
            echo '<script>alert("Thiết bị đã tồn tại")</script>';
            $matb = $_POST['txtmatb']; // Lấy giá trị đã nhập cho ID
            $tentb = $_POST['txttentb']; // Lấy giá trị đã nhập cho Tên văn bằng
            $khophong = $_POST['txtkhophong']; // Lấy giá trị đã nhập cho Số hiệu văn bằng
        }
        else{
            $sql="insert thietbi values('$matb',N'$tentb',N'$khophong',N'$monnganh','$soluong','$hong','$mat','$dvt','$nguongoc',N'$loai')";
            $kq=mysqli_query($con,$sql);
            if($kq==true){
                echo '<script>alert("Thêm mới thành công")</script>';
                echo '<script>window.location.href = "Home.php";</script>';
                exit; // Thêm exit để dừng việc thực thi mã PHP sau khi chuyển hướng
            }else{
                echo '<script>alert("Thêm mới không thành công")</script>';
                echo '<script>window.location.href = "Home.php";</script>';
                exit; // Thêm exit để dừng việc thực thi mã PHP sau khi chuyển hướng
            }
        }
    } 
?>
<div class="container-fluid col-md-6" style="box-shadow: gray 0px 0px 5px; padding: 30px; margin-top: 20px">
<h5 style="text-align: center">THÊM MỚI THIẾT BỊ</h5>
<form method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Mã thiết bị</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtmatb" value="<?= $matb?>" autofocus> 
    <!-- Sử dụng thuộc tính autofocus để tập trung vào ô input ID -->
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Tên thiết bị</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txttentb" value="<?= $tentb?>">
  </div>

<div>
        <!-- Danh sách kho phòng -->
  <div style="width: 24%; display: inline-block">
   Kho phòng
    <select class="form-select" name="txtkhophong">
      <?php        
        $sql2 = "SELECT * FROM khophong";
        $result = $con->query($sql2);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<option value ='".$row["makp"]."'>".$row["tenkp"]."</option>"   ;          
            }
        }
      ?>
   </select>
   </div>

  <!-- Danh sách môn ngành -->
   <div style="width: 24%; display: inline-block">
    Môn ngành
    <select class="form-select" name="txtmonnganh">
      <option value="">---</option>
        <?php        
          $sql2 = "SELECT * FROM dsmonnganh";
          $result = $con->query($sql2);
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<option value ='".$row["mamn"]."'>".$row["tenmn"]."</option>"   ;          
              }
          }
        ?>
    </select>
   </div>
   
  <!-- Danh sách phân loại -->
   <div style="width: 24%; display: inline-block">
    Phân loại
    <select class="form-select" name="txtloai">
        <?php        
          $sql2 = "SELECT * FROM phanloaitb";
          $result = $con->query($sql2);
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<option value ='".$row["mapl"]."'>".$row["tenpl"]."</option>"   ;          
              }
          }
      ?>
      </select>
   </div>
   
  <!-- Danh sách nguồn cấp -->
  <div style="width: 24%; display: inline-block">
   Nguồn gốc
  <select class="form-select" name="txtnguongoc">
      <?php        
        $sql2 = "SELECT * FROM dsnguoncap";
        $result = $con->query($sql2);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<option value ='".$row["manc"]."'>".$row["ten"]."</option>"   ;          
            }
        }
      ?>
   </select>
   </div>
</div>
  

  <div class="form-group form-check" style="padding:0">
    <label for="exampleInputEmail1">Số lượng</label>
    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtsoluong" value="<?= $soluong?>"  min=0>
  </div>
  <div class="form-group form-check" style="padding:0">
    <label for="exampleInputEmail1">Hỏng</label>
    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txthong" value="<?= $hong?>" min=0>
  </div>
  <div class="form-group form-check" style="padding:0">
    <label for="exampleInputEmail1">Mất</label>
    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtmat" value="<?= $mat?>"  min=0>
  </div>
  <div class="form-group form-check" style="padding:0">
    <label for="exampleInputEmail1">Đơn vị tính</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtdvt" value="<?= $dvt?>">
  </div>
  <button type="submit" class="btn btn-primary" name="btnluu" style="width: 200px; margin-left: 230px; margin-top:20px">Lưu</button>
</form>
</div>
