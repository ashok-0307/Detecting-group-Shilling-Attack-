<?php
include './header.php';
if(!isset($_POST['submit1'])) {
?>
<form name="f" method="post">
    <table class="login">
        <thead>
            <tr>
                <th colspan="2">USER LOGIN</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>User Id</th>
                <td><input type="text" name="userid" autofocus required></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><input type="password" name="pwd" required></td>
            </tr>
            <!--tr>
                <th>User Type</th>
                <td>
                    <select name="utype">
                        <option value="user">User</option>
                        <option value="admin">Administrator</option>
                    </select>
                </td>
            </tr--> 
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="center">
                    <input type="submit" name="submit1" value="Login">
                    <br>
                    Don't have an Id ? <a href="regn.php">Register</a>
                </td>
            </tr>
        </tfoot>
    </table>
    <Br><br>
</form>
<?php
} else {
    extract($_POST);
    /*if(strcasecmp($utype, "admin")==0) {
        $result = mysqli_query($link, "select * from admin where userid='$userid' and 
pwd='$pwd'") or die(mysqli_error($link));
        if(mysqli_num_rows($result)>0) {
            $_SESSION['adminuserid'] = $userid;
            header("Location:adminhome.php");
        } else {
            echo "<div class='center'>Invalid Userid/Password...!<br><a href='index.php'>Back</a></div>";
        }
        mysqli_free_result($result);
    } else {*/
        $result = mysqli_query($link, "select * from newuser where userid='$userid' 
and pwd='$pwd'") or die(mysqli_error($link));
        if(mysqli_num_rows($result)>0) {
                $row = mysqli_fetch_row($result);
                $_SESSION['userid'] = $userid;
                $_SESSION['uname'] = $row[0];
                $_SESSION['imgpath'] = $row[7];
                header("Location:userhome.php");
        } else {
            echo "<div class='center'>Invalid Userid/Password...!<br><a href='index.php'>Back</a></div>";
        }
        mysqli_free_result($result);
    //}
}
include './footer.php';
?>