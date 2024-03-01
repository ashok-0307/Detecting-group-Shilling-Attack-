<?php
include './adminheader.php';
if(!isset($_POST['submit1'])) {    
?>
<br>
<form name="f" action="category.php" method="post" onsubmit="" style="float:left;">
    <table class="login">
        <thead>
            <tr>
                <th colspan="2">PRODUCT CATEGORY</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Enter Name</th>
                <td><input type="text" name="cname" autofocus required></td>
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
    <Br><br>
</form>          
<?php
    if(!isset($_GET['catname'])) {
    $rs = mysqli_query($link, "select * from pcategory") or die(mysqli_error($link));
    echo "<table class='report_tab'><thead><tr><th colspan='2'>AVAILABLE CATEGORIES<tr><th>Name<th>Task</thead><tbody>";
    while($r = mysqli_fetch_row($rs)) {
        echo "<tr>";
        foreach($r as $rr)
            echo "<td>$rr";
        echo "<td><a href='category.php?catname=$r[0]' onclick=\"javascript:return confirm('Are you sure to Delete ?')\">Delete</a>";
    }
    echo "</tbody></table>";
    } else {
    $catname = $_GET['catname'];
    mysqli_query($link, "delete from pcategory where cname='$catname'") or die(mysqli_error($link));
    echo "<div class='center'>Category Deleted<br><a href='category.php'>Refresh</a></div>";
    }
} else if(isset($_POST['submit1'])) {
    extract($_POST);
    mysqli_query($link, "insert into pcategory (cname) values ('$cname')") or die(mysqli_error($link));
    echo "<div class='center'>Category Created...!<br><a href='category.php'>Refresh</a></div>";    
}
include './adminfooter.php';
?>