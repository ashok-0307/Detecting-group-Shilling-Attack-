<?php
include './userheader.php';
if(!isset($_POST['sub1'])) {
$result = mysqli_query($link, "select pid from cart where userid='$_SESSION[userid]'");
echo "<form name='f' method='post'>";
echo "<table class='prod_display' style='border:none;'><tbody><tr><th>GIVE YOUR RATING...!";
while($row = mysqli_fetch_row($result)) {
    $res = mysqli_query($link, "select pid,pname,price,pimage,ftype from product where pid=$row[0]");    
    $r = mysqli_fetch_row($res);
    echo "<tr><td>";
        echo "<table style='width:60%;'><tbody>";
            echo "<tr><th style='width:20%;'>Name<td>$r[1]";
            echo "<td rowspan='3' style='border:0;width:250px;'>";
                echo "<select name='prating[]' required style='width:80%;'><option value=''>Your Rating</option>";
                    for($i=5; $i>=0; $i--)
                    echo "<option value=$i>$i</option>";
                echo "</select>";                
                echo "<input type='hidden' name='pid[]' value='$row[0]'>";
            echo "<tr><th>Price<td>$r[2]";
            echo "<tr><th colspan='2'><img src='$r[3]' width='100px'>";            
        echo "</tbody></table>";
    mysqli_free_result($res);
}
echo "<tr><th><input type='submit' name='sub1' value='Store Rating'>";
echo "</tbody></table>";
echo "</form>";
mysqli_free_result($result);
} else {
    $prating = $_POST['prating'];
    $pid = $_POST['pid'];
    $dt = date('Y-m-d',time()+19800);
    $userid = $_SESSION['userid'];
    $fdt = date('Y-m-d',time()+19800);
    foreach($pid as $k=>$v) {        
            mysqli_query($link, "insert into rating(dt,userid,pid,prating,fdt) values('$dt','$userid',$pid[$k],$prating[$k],'$fdt')");
    }
    mysqli_query($link, "delete from cart where userid='$userid'");
    echo "<script>location.href='showcart.php'</script>";
}
include './userfooter.php';
?>