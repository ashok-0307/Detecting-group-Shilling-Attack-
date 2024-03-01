<?php
include './db.php';
    $cname = $_GET['cname'];
    $rs = mysqli_query($link, "select distinct brand from product where cname='$cname'");
    $s = "<select name='brand' onchange='call2(this.value)' required>";
    $s .= "<option value=''>--Choose--</option>";
        while($r = mysqli_fetch_row($rs)) {
            $s.= "<option value='$r[0]'>$r[0]</option>";
        }
    $s.= "</select>";
    echo $s;
    mysqli_free_result($rs);
    mysqli_close($link);
?>