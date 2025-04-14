<?php
ini_set('display_errors', 0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/baitap5.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="C:\xampp\htdocs\QuanLyTrangThietBi\Duc\format1.css">
  <title>Document</title>
  <style>
    .thanhtren{
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 50px;
    background-color: white;
    padding-left: 10px;
    padding-right: 10px;
    box-shadow: gray 0px 0px 5px;
}
  </style>
</head>
<body class="content">
<?php 
require_once 'C:\xampp\htdocs\QuanLyTrangThietBi\menutrai2.php'
?>
<div style="display: inline-block; vertical-align: top; flex:1">
  <div class="thanhtren">
    <div>
      <a href="http://localhost/QuanLyTrangThietBi/Tam/FinalExam/Home2.php" style="color: rgb(0, 172, 0); width:fit-content; display: inline-block; font-weight: bold; font-size:120%">DANH SÁCH THIẾT BỊ</a>
      <a href="http://localhost/QuanLyTrangThietBi/Tam/qlkhophong/Home2.php" style="color: rgb(200,200,200); width:fit-content; display: inline-block">DANH SÁCH KHO PHÒNG</a>
    </div>
      <a href="http://localhost/QuanLyTrangThietBi/login/login.php" style="color: gray; display: inline-block;" onclick="return confirm('Bạn có muốn đăng xuất không')">Đăng xuất</a>
  </div>
<?php 
    include "Connection.php";
    $sql = "SELECT
    thietbi.*,
    thietbi2.dangmuon,
    thietbi2.choxacnhan,
    COALESCE(soluong - hong - mat - choxacnhan - dangmuon, soluong) AS conlai
FROM
    (thietbi
LEFT JOIN
    (SELECT
        phieumuontb.matb,
        SUM(CASE WHEN dsphieumuon.tinhtrang = 'chưa xác nhận' THEN phieumuontb.soluong ELSE 0 END) AS choxacnhan,
        SUM(CASE WHEN dsphieumuon.tinhtrang = 'chưa trả' THEN phieumuontb.soluong ELSE 0 END) AS dangmuon
    FROM
        phieumuontb
    JOIN dsphieumuon ON phieumuontb.maphieu = dsphieumuon.maphieu
    GROUP BY
        phieumuontb.matb) AS thietbi2
ON thietbi.matb = thietbi2.matb)

" ;
    $data=mysqli_query($con,$sql);
    //Tìm kiếm dữ liệu
    $matb='';
    $tentb='';
    $khophong='';
    $monnganh='';
    $soluong='';
    $hong='';
    $mat='';
    $dvt='';
    $loai='';
    $nguongoc='';
    if(isset($_POST['btntimkiem'])){
        $tentb=$_POST['txtTenTB'];
        $matb=$_POST['txtMaTB'];
        $khophong = $_POST['txtKhoPhong'];
        $monnganh = $_POST['txtMonNganh'];
        $soluong = $_POST['txtSoLuong'];
        $hong = $_POST['txtHong'];
        $mat = $_POST['txtMat'];
        $dvt = $_POST['txtDvt'];
        $loai = $_POST['txtLoai'];
        $nguongoc = $_POST['txtNguonGoc'];
        $sql1="select * from thietbi where tentb like N'%$tentb%' and matb like N'%$matb%'";
        $data=mysqli_query($con,$sql1);
    }  
?>
<div class="container-fluid col-md-6">
    <div class="row">
    <div style="margin-bottom: 20px;">
    <form action="" method="post">
    <table>
        <tr>
            <td style="text-align: center" ><label for="">Tên thiết bị</label><input class="inputvtb" type="text" name="txtTenTB" id="" value="<?= $tentb?>"></td>
         </tr>
        <tr>
            <td><label for="">Mã thiết bị</label><input type="text"name="txtMaTB" id="" value="<?= $matb?>"></td>
        </tr>
        <tr>
            <td style="text-align: center; padding:40px"><button name="btntimkiem" class="btn btn-danger" >Tìm kiếm</button></td>
        </tr>    
    </table>
              
    </form>
    </div>
    </div>
</div>
<div>
<table class="table table-bordered">
  <thead style="font-size:85%">
    <tr>
      <th scope="col">Mã thiết bị</th>
      <th scope="col">Tên thiết bị</th>
      <th scope="col">Kho/phòng</th>
      <th scope="col">Môn ngành</th>
      <th scope="col">Số lượng</th>
      <th scope="col">Hỏng</th>
      <th scope="col">Mất</th>
      <th scope="col">Đang mượn</th>
      <th scope="col">Chờ xác nhận</th>
      <th scope="col">Còn lại</th>
      <th scope="col">Đơn vị tính</th>
      <th scope="col">Loại</th>
      <th scope="col">Nguồn gốc</th>
    </tr>
  </thead>
  <tbody>
    <?php
        if(isset($data) && $data!=""):
        while($row=mysqli_fetch_assoc($data)):    
    ?>
    <tr>
      <th scope="row"><?php echo $row['matb']?></th>
      <td><?php echo $row['tentb']?></td>
      <td><?php echo $row['khophong']?></td>
      <td><?php echo $row['monnganh']?></td>
      <td><?php echo $row['soluong']?></td>
      <td><?php echo $row['hong']?></td>
      <td><?php echo $row['mat']?></td>
      <td><?php echo $row['dangmuon']?></td>
      <td><?php echo $row['choxacnhan']?></td>
      <td><?php echo $row['conlai']?></td>
      <td><?php echo $row['dvt']?></td>
      <td><?php echo $row['loai']?></td>
      <td><?php echo $row['nguongoc']?></td>
    </tr>
 
    <?php endwhile;?>
    <?php endif;?>
  </tbody>
</table>

</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</div>

</body>
</html>
