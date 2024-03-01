<?php
include './adminheader.php';
if(isset($_GET['rid'])) {
    mysqli_query($link, "delete from pur where id='$_GET[rid]'");
}
if(isset($_GET['did'])) {
    mysqli_query($link, "update pur set delivery='yes' where id='$_GET[did]'");
}
$result = mysqli_query($link, "select p.id,p.userid,n.uname,brand,pname,pimage from pur p,newuser n,product r where p.userid=n.userid and p.pid=r.pid and p.delivery='no' order by p.id desc");
    echo "<div class='scrolldiv'><table class='report_tab' style='float:none;margin:20px auto;min-width:80%;'><thead><tr><th colspan='7'>PRODUCT DELIVERY<tr>";
    echo "<tr><th>User Id<th>Name<th>Brand<th>Product Name<th>Image<th>Task<tbody>";
    while($row=  mysqli_fetch_row($result)) {
	echo "<tr>";
                echo "<td>$row[1]<td>$row[2]<td>$row[3]<td>$row[4]<td><img src='$row[5]' width='50px'>";        
	echo "<td><a href='delivery.php?rid=$row[0]' onclick=\"javascript:return confirm('Are You Sure to Remove ?')\">Remove</a> | <a href='delivery.php?did=$row[0]' onclick=\"javascript:return confirm('Are You Sure to Deliver ?')\">Delivered</a>";
    }
    echo "</tbody></table></div>";
mysqli_free_result($result);
include './adminfooter.php';
?>