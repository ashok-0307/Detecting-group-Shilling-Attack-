<?php
include './adminheader.php';
if(isset($_GET['duid'])) {
    mysqli_query($link, "delete from newuser where userid='$_GET[duid]'");
}
$result = mysqli_query($link, "select uname,addr,gender,dob,mobile,userid,uphoto from newuser");
    echo "<table class='report_tab' style='float:none;margin:20px auto;min-width:80%;'><thead><tr><th colspan='8'>USER LIST<tr>";
    echo "<tr><th>Name<th>Address<th>Gender<th>DOB<th>Mobile<th>Userid<th>Photo<th>Task<tbody>";
    while($row=  mysqli_fetch_row($result)) {
	echo "<tr>";
        foreach($row as $k=>$r) {
            if($k==6)
                echo "<td><img src='$r' width='50px'>";
            else
                echo "<td>$r";
        }
	echo "<td><a href='adminhome.php?duid=$row[5]' onclick=\"javascript:return confirm('Are You Sure to Remove ?')\">Delete</a>";
    }
    echo "</tbody></table>";
mysqli_free_result($result);
include './adminfooter.php';
?>