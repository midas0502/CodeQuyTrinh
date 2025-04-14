<?php        
    $sql2 = "SELECT * FROM dstoanha";
    $result = $con->query($sql2);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        echo "<li class='dropdown-item'><input type='radio' value ='".$row["ten"]."' name='txttoanha'>&nbsp".$row["ten"]."</li>";              
        }
    }
?>