<?php
include './adminheader.php';
if(!isset($_POST['submit1'])) {
$rs = mysqli_query($link, "select distinct cname from pcategory") or die(mysqli_error($link));
?>
<br>
<form name="f1" action="product.php" method="post" enctype="multipart/form-data" style="float:left;">
        <table class="login">
            <thead>
                <tr>
                    <th colspan="2">NEW PRODUCT</th>
                </tr>
            </thead>
            <tbody>                
                <tr>
                    <th>Product Category</th>
                    <td><select name="cname" required>
                            <option value="">Select Category</option>
                        <?php
                        while($s=mysqli_fetch_row($rs))                            
                            echo "<option value='$s[0]'>$s[0]</option>";
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Product Name</th>
                    <td><input type="text" name="pname" required autofocus></td>
                </tr>
                <tr>
                    <th>Brand</th>
                    <td><input type="text" name="brand" required></td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td><input type="text" name="price" pattern="\d+(\.{1}\d{1,2})?" title="Enter Only Digits" required></td>
                </tr>
                <tr>
                    <th>Product Image</th>
                    <td><input type="file" name="ff" accept="image/*" title="Select Image" required></td>
                </tr>                
            </tbody>
            <tfoot>
            <tr>
                <td colspan="2" class="center">
                    <input type="submit" name="submit1" value="Create">                  
                </td>
            </tr>
            </tfoot>
        </table>
</form>
<?php
if(isset($_GET['delid'])) {
    mysqli_query($link, "delete from product where pid=$_GET[delid]");
    mysqli_query($link, "delete from stock where pid=$_GET[delid]");
    echo "<script>location.href='product.php'</script>";
}
$rs = mysqli_query($link, "select pid,cname,pname,brand,price,pimage from product order by cname,brand") or die(mysqli_error($link));
echo "<div class='scrolldiv'><table class='report_tab'><thead><tr><th colspan='6'>PRODUCT LIST<tr><th>Category<th>Name<th>Brand<th>Price<th>Image<th>Task</thead><tbody>";
                    while($r = mysqli_fetch_row($rs)) {
                        echo "<tr>";
                        foreach($r as $k=>$rr) {
                            if($k==5)
                                echo "<td class='center'><img src='$rr' width='50px' height='40px'>";
                            else if($k!=0 && $k!=6)
                            echo "<td>$rr";
                        }
                        echo "<td><a href='product.php?delid=$r[0]' onclick=\"javascript:return confirm('Are You Sure to Delete ?')\">Del</a>";
                    }
echo "</tbody></table></div>";
mysqli_free_result($rs);
} else {
    if(is_uploaded_file($_FILES['ff']['tmp_name'])) {
            extract($_POST);
            $path = "pimages/".time().$_FILES['ff']['name'];
            $ftype = $_FILES['ff']['type'];
            move_uploaded_file($_FILES['ff']['tmp_name'], $path) or die("Cannot move File...");
            
            mysqli_query($link, "insert into product (cname,pname,brand,price,pimage,ftype) values ('$cname','$pname','$brand',$price,'$path','$ftype')") or die(mysqli_error($link));
            $res1 = mysqli_query($link, "select max(pid) from product");
            $r1 = mysqli_fetch_row($res1);
            mysqli_query($link, "insert into stock (pid,count) values ($r1[0],0)");
            echo "<div class='center'>Product Created...!<br><a href='product.php'>Refresh</a></div>";
    } else {
            echo "<div class='center'>Image Not Uploaded...<br><a href='product.php'>Refresh</a></div>";
    }
}
include './adminfooter.php';
?>