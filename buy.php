<?php
include './userheader.php';
if(isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    mysqli_query($link, "insert into cart(userid,pid) values('$_SESSION[userid]',$pid)");
    echo "<script>alert('Item Added To Cart...!');location.href='buy.php';</script>";
}
if(!isset($_POST['submit1'])) {
$rs = mysqli_query($link, "select distinct cname from pcategory") or die(mysqli_error($link));
?>
<br>
<form name="f" action="buy.php" method="post">
    <table class="login">
        <thead>
            <tr>
                <th colspan="2">SELECT PRODUCT</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Choose Category</th>
                <td>
                    <select name="cname" required onchange="call1(this.value)">
                        <option value="">--Choose--</option>
                        <?php
                        while($s=mysqli_fetch_row($rs))                            
                            echo "<option value='$s[0]'>$s[0]</option>";
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Choose Brand</th>
                <td>
                    <div id="d1"><select name="brand" required></select></div>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="center">
                    <input type="submit" name="submit1" value="GO">                  
                </td>
            </tr>
        </tfoot>
    </table>
    <Br><br>
</form>
<?php
} else {
    $cname = $_POST['cname'];
    $brand = $_POST['brand'];
    
    $result = mysqli_query($link, "select pid,pname,price,pimage,ftype from product where cname='$cname' and brand='$brand'");
    $i=0;
    echo "<div class='center'><a href='buy.php'>Choose Another Brand</a></div>";
    echo "<table class='prod_display'><tbody>";
    while($row = mysqli_fetch_row($result)) {
        if($i==0 || $i%3==0) {
            echo "<tr>";
        }
        echo "<td>";
        echo "<table>";
            echo "<tr><th>Name<td>$row[1]";
            echo "<tr><th>Price<td>$row[2]";            
            echo "<tr><th colspan='2' style='text-align:center;'><img src='$row[3]' width='100px' style='float:none;'>";
            $res = mysqli_query($link, "select count(*),avg(prating) from rating where pid='$row[0]'");
            $r = mysqli_fetch_row($res);
            echo "<tr><th colspan='2'>Rating : ".round($r[1],2)." &nbsp;(Total Users : $r[0])";
            mysqli_free_result($res);
            echo "<tr><th colspan='2'><a href='buy.php?pid=$row[0]' onclick=\"javascript:return confirm('Are You Sure to Add to Cart ?')\">Add to Cart</a>";
        echo "</table>";
        $i++;
    }
    echo "</tbody></table>";
    mysqli_free_result($result);    
}
include './userfooter.php';
?>
<script>
    function getObject() {
        if(window.ActiveXObject)
            return new ActiveXObject("Microsoft.XMLHTTP")
        else
            return new XMLHttpRequest()
    }
    
    function call1(p1) {
        if(p1!="") {
            ob1 = getObject()
            ob1.onreadystatechange=doWork1
            ob1.open("GET","getbrands.php?cname="+p1,true)
            ob1.send()
        } else {
            document.getElementById("d1").innerHTML = "<select name='brand' required></select>"
        }
    }
    function doWork1() {
        if(ob1.readyState==4 && ob1.status==200) {
            document.getElementById("d1").innerHTML = ob1.responseText
        }
    }
</script>