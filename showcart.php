<?php
include './userheader.php';
if(isset($_GET['delid'])) {    
    mysqli_query($link, "delete from cart where id=$_GET[delid]");
    echo "<script>location.href='showcart.php'</script>";
}
if(isset($_GET['confirm'])) {
    $dt = time()+19800;
    $result = mysqli_query($link, "select pid from cart where userid='$_SESSION[userid]'");
        while($row = mysqli_fetch_row($result)) {
            mysqli_query($link, "insert into pur(userid,dt,pid) values('$_SESSION[userid]',$dt,$row[0])");
        }
    mysqli_free_result($result);
    echo "<script>location.href='crating.php'</script>";
}
$rs = mysqli_query($link, "select c.id,c.pid,cname,brand,pname,price,pimage from cart c,product p where c.pid=p.pid and c.userid='$_SESSION[userid]' order by cname,brand") or die(mysqli_error($link));
echo "<table class='report_tab' style='margin:20px auto;float:none;'><thead><tr><th colspan='6'>ITEMS IN CART<tr><th>Category<th>Brand<th>Name<th>Price<th>Image<th>Task</thead><tbody>";
                    while($r = mysqli_fetch_row($rs)) {
                        echo "<tr>";
                        foreach($r as $k=>$rr) {
                            if($k==6)
                                echo "<td class='center'><img src='$rr' width='50px' height='40px'>";
                            else if($k!=0 && $k!=1)
                            echo "<td>$rr";
                        }
                        echo "<td><a href='showcart.php?delid=$r[0]' onclick=\"javascript:return confirm('Are You Sure to Delete ?')\">Del</a>";
                    }
if(mysqli_num_rows($rs)>0) {
    echo "<tr><th colspan='8' class='top_border'><a href='showcart.php?confirm' onclick=\"Are You Sure to Confirm Purchase ?\">Confirm Purchase</a>";
}
echo "</tbody></table>";
mysqli_free_result($rs);
include './userfooter.php';
?>