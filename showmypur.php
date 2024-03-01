<?php
include './userheader.php';
$rs = mysqli_query($link, "select p.dt,p.pid,cname,brand,pname,price,pimage from pur p,product o where o.pid=p.pid and p.userid='$_SESSION[userid]' order by p.dt desc") or die(mysqli_error($link));
echo "<table class='report_tab' style='margin:20px auto;float:none;'><thead><tr><th colspan='8'>ITEMS YOU PURCHASED<tr><th>Date<th>PId<th>Category<th>Brand<th>Name<th>Price<th>Image<th>Delivered</thead><tbody>";
while($r = mysqli_fetch_row($rs)) {
    echo "<tr>";
    foreach($r as $k=>$rr) {
        if($k==0)
            echo "<td>".date('Y-m-d',$rr);
        else if($k==6)
            echo "<td class='center'><img src='$rr' width='50px' height='40px'>";
        else 
            echo "<td>$rr";
    }
}
echo "</tbody></table>";
mysqli_free_result($rs);
include './userfooter.php';
?>