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
    <link rel="stylesheet" href="C:\xampp\htdocs\QuanLyTrangThietBi\Linh\format1.css">
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
    .menutrai{
    display: inline-block;
    color: white;
    width: 200px;
    height: 100vh;
    background-color: rgb(31, 37, 56) ;
    box-shadow: 0px 0px 5px gray;
    }
    .menutrai>ul{
        padding-left: 0;
    }
    .menutrai>ul>li{
        display: flex;
        align-items: center;
        padding-left: 20px;
        border: 1px solid rgb(26, 39, 87);
        list-style: none;
        height: 50px;
        font-size: 120%;
    }
    .menutrai>ul>li:hover{
        background-color: rgb(59, 65, 87);
    }
    .menutrai>ul>li>a{
    text-decoration: none;
    color: white;
    }
  </style>
</head>
<body class="content">
<?php 
require_once 'C:\xampp\htdocs\QuanLyTrangThietBi\menutrai.php'
?>
<div style="display: inline-block; vertical-align: top; flex:1">
  <div class="thanhtren">
    <div>
      <a href="http://localhost/QuanLyTrangThietBi/VietAnh/qlkhophong/Home.php" style="color: rgb(0, 172, 0); width:fit-content; display: inline-block; font-weight: bold; font-size:120%">QUẢN LÝ KHO PHÒNG</a>
      <a href="http://localhost/QuanLyTrangThietBi/VietAnh/FinalExam/Home.php"style="color: rgb(200,200,200); width:fit-content; display: inline-block" >QUẢN LÝ THIẾT BỊ</a> 
    </div>
      <a href="http://localhost/QuanLyTrangThietBi/login/login.php" style="color: gray; display: inline-block;" onclick="return confirm('Bạn có muốn đăng xuất không')">Đăng xuất</a>
  </div>
<?php 
    include "Connection.php";
    $sql="select * from khophong order by makp desc";
    $data=mysqli_query($con,$sql);
    //Tìm kiếm dữ liệu
    $makp='';
    $tenkp='';
    $toanha='';
    $tang='';
    $loai='';
    $tinhtrang='';
    $ghichu='';
    if(isset($_POST['btntimkiem'])){
        $tenkp=$_POST['txtTenKP'];
        $makp=$_POST['txtMaKP'];
        
        $sql1="select * from khophong where tenkp like N'%$tenkp%' and makp like N'%$makp%'";
        $data=mysqli_query($con,$sql1);
    }  
?>
<div class="container-fluid col-md-6">
    <div class="row">
    <div style="margin-top: 125px">
    <a href="InsertVB.php"><button type="button" class="btn btn-success">Thêm kho phòng</button></a>
    </div>
    <div style="margin-bottom: 20px;">
    <form action="" method="post">
    <table>
        <tr>
            <td style="text-align: center" ><label for="">Tên kho phòng</label><input class="inputvtb" type="text" name="txtTenKP" id="" value="<?= $tenkp?>"></td>
         </tr>
        <tr>
            <td><label for="">Mã kho phòng</label><input type="text"name="txtMaKP" id="" value="<?= $makp?>"></td>
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
<table class="table">
  <thead>
    <tr>
      <th scope="col">Mã kho phòng</th>
      <th scope="col">Tên kho phòng</th>
      <th scope="col">Tòa nhà</th>
      <th scope="col">Tầng</th>
      <th scope="col">Loại phòng</th>
      <th scope="col">Tình trạng</th>
      <th scope="col">Ghi chú</th>
      <th scope="col">Thao tác</th>
    </tr>
  </thead>
  <tbody>
    <?php
        if(isset($data) && $data!=""):
        while($row=mysqli_fetch_assoc($data)):    
    ?>
    
    <tr>
      <th scope="row"><?php echo $row['makp']?></th>
      <td><?php echo $row['tenkp']?></td>
      <td><?php echo $row['toanha']?></td>
      <td><?php echo $row['tang']?></td>
      <td><?php echo $row['loai']?></td>
      <td><?php echo $row['tinhtrang']?></td>
      <td><?php echo $row['ghichu']?></td>
      <td><a href="UpdateVB.php?makp=<?php echo $row['makp']?>">Sửa</a>
          <a href="DeleteVB.php?makp=<?php echo $row['makp']?>">Xóa</a>
    </td>
    </tr>
 
    <?php endwhile;?>
    <?php endif;?>
  </tbody>
</table>

</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>