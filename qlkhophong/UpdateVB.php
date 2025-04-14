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
         $makp = $_GET['makp'];
     //Tim kiem theo id
    $sql1="select * from khophong where makp='$makp'";
    $data=mysqli_query($con,$sql1);
    //Hiển thị mảng $data lên các điều khiển của trang web
    //B2: Tạo câu lệnh truy vấn
     if(isset($_POST['btnSua'])){
        $tenkp=$_POST['txtTenKP'];
        $toanha=$_POST['txttoanha'];
        $tang=$_POST['txttang'];
        $loai=$_POST['txtloai'];
        $tinhtrang=$_POST['txtTinhTrang'];
        $ghichu=$_POST['txtGhiChu'];
        $sql="update khophong set tenkp='$tenkp', toanha='$toanha', tang='$tang', loai = '$loai', tinhtrang='$tinhtrang', ghichu='$ghichu' WHERE makp='$makp' ";
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
    <h5 style="text-align: center">SỬA THÔNG TIN KHO PHÒNG</h5>
        <table style="width: 100%">
            <?php
                if(isset($data) && $data!=""):
                    while($row = mysqli_fetch_assoc($data)):
                        ?>
            <tr>
                <td style="width: 170px; padding: 10px">
                <label for="">Mã kho phòng</label>
                </td>
                <td>
                    <input type="text" name="txtMaKP" class="form-control" value="<?php echo $row['makp']?>" readonly>
                </td>
            </tr>
            <tr>
            <td style="width: 170px; padding: 10px">
                <label for="">Tên kho phòng</label>
                </td>
                <td>
                    <input type="text" name="txtTenKP" class="form-control"value="<?php echo $row['tenkp']?>">
                </td>
            </tr>
            <tr>
            <td style="width: 170px; padding: 10px">
                <label for="">Tình trạng</label>
                </td>
                <td>
                <select name="txtTinhTrang" class="form-control">
                    <option value="Hoạt động" <?= $row['tinhtrang'] == 'Hoạt động' ? 'selected' : '' ?>>Hoạt động</option>
                    <option value="Không hoạt động" <?= $row['tinhtrang'] == 'Không hoạt động' ? 'selected' : '' ?>>Không hoạt động</option>
                </select>                   
                </td>
            </tr>
            <tr>
            <td style="width: 170px; padding: 10px">
                <label for="">Ghi chú</label>
                </td>
                <td>
                    <input type="text" name="txtGhiChu" class="form-control"value="<?php echo $row['ghichu']?>">
                </td>
            </tr>
 
            <?php endwhile;?>
            <?php endif;?>   
        </table>

<!-- Danh sách toà nhà -->
<div style="width: 20%; display: inline-block; margin-left: 100px">
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

  <input type="submit" value="Sửa" name="btnSua"class="btn btn-success" style="width: 200px; margin-left: 200px; margin-top:20px">
    </form>
</div>

