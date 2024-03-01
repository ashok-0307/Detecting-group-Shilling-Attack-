<?php
include './adminheader.php';
$pid = $_GET['pid'];
$rtr=date('Y-m-d',time());
mysqli_query($link, "delete from rating where userid in (select userid from newuser where rtime like '$rtr%') and pid='$pid'");
$res = mysqli_query($link, "select userid from rating where pid='$pid' group by fdt,userid having count(*)>1");
while($row = mysqli_fetch_row($res)) {
    //mysqli_query($link, "delete from rating where userid in (select userid from newuser where rtime like '$rtr%') and pid='$pid'");
}
mysqli_free_result($res);
    echo "<div class='center'><b>Shilling Attack Ratings Removed Successfully...!</b><br><a href='viewrating.php'>Refresh</a><br></div>";
include './adminfooter.php';
?>