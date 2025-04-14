<?php
if (isset($_POST['txttoanha'])) {
    $toanha = $_POST['txttoanha'];
    $sql3="SELECT sotang FROM dstoanha WHERE ten='$toanha'"
    $result = $con->query($sql3);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sotang=row["sotang"];
        }
    }
    echo $sotang;
}
?>
