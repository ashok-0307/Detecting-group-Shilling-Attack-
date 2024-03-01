<?php
include './adminheader.php';
if(!isset($_POST['submit1'])) {
$rs = mysqli_query($link, "select pid,pname,brand,cname from product order by cname,brand") or die(mysqli_error($link));
?>
<br>
<form name="f1" action="viewrating.php" method="post">
        <table class="login">
            <thead>
                <tr>
                    <th colspan="2">VIEW RATING</th>
                </tr>
            </thead>
            <tbody>                
                <tr>
                    <th>Select Product</th>
                    <td><select name="pid" required>
                            <option value="">Select Product</option>
                        <?php
                        while($s=mysqli_fetch_row($rs)) {
                            echo "<option value='$s[0]'>$s[2]-$s[1] ($s[3])</option>";
                        }
                        mysqli_free_result($rs);
                        ?>
                        </select>
                    </td>
                </tr>
                </tbody>
            <tfoot>
            <tr>
                <td colspan="2" class="center">
                    <input type="submit" name="submit1" value="Show">                  
                </td>
            </tr>
            </tfoot>
        </table>
</form>
<?php
} else {
    extract($_POST);
    $result = mysqli_query($link, "select cname,brand,pname,pimage from product where pid='$pid'");
    $row =  mysqli_fetch_row($result);
    mysqli_free_result($result);
    $result1 = mysqli_query($link, "select avg(prating) from rating where pid='$pid'");
    $row1 = mysqli_fetch_row($result1);
    echo "<h3 style='text-align:center;'>RATING WITH GROUP SHILLING ATTACK</h3>";
    echo "<table class='login' border='1' width='40%'>";
    echo "<tr><th>Category<td>$row[0]<th rowspan='3'><img src='$row[3]' width='100px'>";
    echo "<tr><th>Brand<td>$row[1]";
    echo "<tr><th>Product Name<td>$row[2]";
    echo "<tr><th>Rating<td colspan='2'>".round($row1[0],2);
    echo "</table>";
    mysqli_free_result($result1);
    
    $result1 = mysqli_query($link, "select max(prating) from rating where pid='$pid' group by fdt,userid");
    $rt=0;
    $cnt=0;
    while($row1 = mysqli_fetch_row($result1)) {
        $rt+=$row1[0];
        $cnt++;
    }
    mysqli_free_result($result1);
    if($cnt>0)
    $art = $rt/$cnt;
    else
        $art=$rt;
        
$rtr = date('Y-m-d',time());
$ress1 = mysqli_query($link, "select avg(prating) from rating where pid='$pid' and userid in (select userid from newuser where rtime not like '$rtr%')");
$rows1 = mysqli_fetch_row($ress1);
    echo "<h3 style='text-align:center;'>RATING EXCLUDING GROUP SHILLING ATTACK</h3>";
    echo "<table class='login' border='1' width='40%'>";
    echo "<tr><th>Category<td>$row[0]<th rowspan='3'><img src='$row[3]' width='100px'>";
    echo "<tr><th>Brand<td>$row[1]";
    echo "<tr><th>Product Name<td>$row[2]";
//    echo "<tr><th>Rating<td colspan='2'>".round($art,2);
    echo "<tr><th>Rating<td colspan='2'>".round($rows1[0],2);
    echo "</table>";    
        
    
    if(strcasecmp($pid, "")!=0) {    
    echo "<div class='center'><br><a href='viewrating1.php?pid=$pid' onclick=\"javascript:return confirm('Are You Sure to Remove ?')\">Remove Shilling Attack Ratings...!</a><br></div>";
    }
    
}
include './adminfooter.php';
?>