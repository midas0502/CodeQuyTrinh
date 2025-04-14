<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/baitap5.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<?php 
    include "Connection.php";
    $makp = ""; // Khởi tạo giá trị mặc định cho ma
    $tenkp = ""; // Khởi tạo giá trị mặc định cho tentb
    $toanha = ""; // Khởi tạo giá trị mặc định cho sohieuvb
    $tang = "";
    $loai = "";
    $tinhtrang = "";
    $ghichu = "";
    if(isset($_POST['btnluu'])){
        $makp=$_POST['txtmakp'];
        $tenkp=$_POST['txttenkp'];
        $toanha=$_POST['txttoanha'];
        $tang=$_POST['txttang'];
        $loai=$_POST['txtloai'];
        $tinhtrang=$_POST['txttinhtrang'];
        $ghichu=$_POST['txtghichu'];
        $sql="select count(*) from khophong where makp='$makp'";
        $kq=mysqli_query($con,$sql);
        $row = mysqli_fetch_array($kq);
        if($row[0] > 0){ // Kiểm tra nếu ID đã tồn tại
            echo '<script>alert("Thiết bị đã tồn tại")</script>';
            $makp = $_POST['txtmakp']; // Lấy giá trị đã nhập cho ID
            $tenkp = $_POST['txttenkp']; // Lấy giá trị đã nhập cho Tên văn bằng
            $toanha = $_POST['txttoanha']; // Lấy giá trị đã nhập cho Số hiệu văn bằng
        }
        else{
            $sql="insert khophong values('$makp',N'$tenkp',N'$toanha',N'$tang','$loai','$tinhtrang','$ghichu')";
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
<div class="container-fluid col-md-6" style="box-shadow: gray 0px 0px 5px; padding: 30px; margin-top: 50px">
  <h5 style="text-align: center">THÊM MỚI KHO PHÒNG</h5>
<form method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Mã kho phòng</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtmakp" value="<?= $makp?>" autofocus> 
    <!-- Sử dụng thuộc tính autofocus để tập trung vào ô input ID -->
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Tên kho phòng</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txttenkp" value="<?= $tenkp?>">
  </div>
  <!-- Danh sách toà nhà -->
  <div style="width: 20%; display: inline-block">
   Toà nhà
  <select class="form-select" name="txttoanha">
      <?php        
        $sql2 = "SELECT * FROM dstoanha";
        $result = $con->query($sql2);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<option value ='".$row["ten"]."'>".$row["ten"]."</option>"   ;          
            }
        }
      ?>
   </select>
   </div>
  <!-- Danh sách tầng -->
  <div style="width: 10%; display: inline-block">
   Tầng
  <select class="form-select" name="txttang">
      <option value="1">1</option>;
      <option value="1">2</option>;
      <option value="1">3</option>;
      <option value="1">4</option>;
      <option value="1">5</option>;
   </select>
   </div>
  <?php 
  // for( $i=1; $i <= $sotang; $i++){
  //   echo "<li class='dropdown-item'><input type='radio' value ='$i' name='txttoanha'>&nbsp $i</li>"; 
  // }
 
  ?>
  <!-- Danh sách phân loại -->
  <div style="width: 30%; display: inline-block">
   Loại phòng
  <select class="form-select" name="txtloai">
      <?php        
        $sql2 = "SELECT * FROM phanloaikp";
        $result = $con->query($sql2);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<option value ='".$row["tenpl"]."'>".$row["tenpl"]."</option>"   ;          
            }
        }
      ?>
   </select>
   </div>
  <div class="form-group form-check" style="display: inline-block" >
    Tình trạng
    <select name="txttinhtrang">
    <option value="Hoạt động" <?= $tinhtrang == "Hoạt động" ? "selected" : "" ?>>Hoạt động</option>
    <option value="Không hoạt động" <?= $tinhtrang == "Không hoạt động" ? "selected" : "" ?>>Không hoạt động</option>
    </select>
  </div>
  <div class="form-group form-check" style="padding:0">
    Ghi chú
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtghichu" value="<?= $ghichu?>">
  </div>
  <button type="submit" class="btn btn-primary" name="btnluu" style="width: 200px; margin-left: 230px; margin-top:20px">Lưu</button>
</form>
</div>

<script>
const radioInputs = document.querySelectorAll('input[name="txttoanha"]');
radioInputs.forEach(input => {
    input.addEventListener('change', () => {
      
    });
});
</script>