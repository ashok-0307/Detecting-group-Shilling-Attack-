<?php
include './userheader.php';
if(!isset($_POST['submit1']) && !isset($_POST['submit2'])) {
    $result = mysqli_query($link, "select * from newuser where userid='$_SESSION[userid]'");
    $row = mysqli_fetch_row($result);
?>
<br>
<form name="f" action="userhome.php" method="post" onsubmit="return check_regn()" style="float:left;">
    <table class="login">
        <thead>
            <tr>
                <th colspan="2">YOUR PROFILE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Name</th>
                <td><input type="text" name="uname" value="<?php echo $row[0]?>" autofocus required></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><textarea name="addr" required><?php echo $row[1]?></textarea></td>
            </tr>
            <tr>
                <th>Gender</th>
                <td><input type="radio" name="gender" value="Male" checked>Male&nbsp;<input type="radio" name="gender" value="Female">Female</td>
            </tr>
            <tr>
                <th>DOB</th>
                <td><input type="date" name="dob" required value="<?php echo $row[3]?>"></td>
            </tr>
            <tr>
                <th>Mobile</th>
                <td><input type="text" name="mobile" value="<?php echo $row[4]?>" maxlength="10" required></td>
            </tr>
            <tr>
                <th>E-Mail (Userid)</th>
                <td><input type="text" name="email" value="<?php echo $row[5]?>" required readonly></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><input type="password" name="pwd" value="<?php echo $row[6]?>" required></td>
            </tr>
            <tr>
                <th>Confirm Pwd</th>
                <td><input type="password" name="cpwd" value="<?php echo $row[6]?>" required></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="center">
                    <input type="submit" name="submit1" value="Update">                  
                </td>
            </tr>
        </tfoot>
    </table>
    <Br><br>
</form>

<form name="f" action="userhome.php" method="post" enctype="multipart/form-data" style="float:right;">
    <table class="login">
        <thead>
            <tr>
                <th colspan="2">PROFILE IMAGE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Choose Image</th>
                <td><input type="file" name="ff" accept="image/*" required></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="center">
                    <input type="submit" name="submit2" value="Upload">                  
                </td>
            </tr>
        </tfoot>
    </table>
    <Br><br>
</form>            
<?php
} else if(isset($_POST['submit1'])) {
    extract($_POST);
    mysqli_query($link, "update newuser set uname='$uname',addr='$addr',gender='$gender',dob='$dob',mobile='$mobile',pwd='$pwd' where userid='$email'") or die(mysqli_error($link));
    echo "<div class='center'>UserId Modified Successfully...!<br><a href='userhome.php'>Refresh</a></div>";  
} else if(isset($_POST['submit2'])) {
    if(is_uploaded_file($_FILES['ff']['tmp_name'])) {
        $fname = "ups/".time().$_FILES['ff']['name'];
        $ftype = $_FILES['ff']['type'];
        move_uploaded_file($_FILES['ff']['tmp_name'], $fname);
        mysqli_query($link, "update newuser set uphoto='$fname',ftype='$ftype' where userid='$_SESSION[userid]'");
        echo "<div class='center'>Profile Image Changed...!</div>";
    } else {
        echo "<div class='center'>Photo Not Uploaded...!</div>";
    }
    echo "<div class='center'><a href='userhome.php'>Refresh</a></div>";
}
include './userfooter.php';
?>
<script>
    function check_regn() {
        var mobile = f.mobile.value
        var email = f.email.value
        var pwd = f.pwd.value
        var cpwd = f.cpwd.value
        
        if(!check_mobile(mobile)) {
            alert("Invlid Mobile Number")
            f.mobile.focus()
            return false
        }
        if(!check_email(email)) {
            alert("Invalid Email Id")
            f.email.focus()
            return false
        }
        if(pwd!=cpwd) {
            alert("Confirm Password not Match")
            f.cpwd.focus()
            return false
        }
        return true
    }
    function check_email(e) {
	var ep = /^\w+\.{0,1}\w+\@[a-z]+\.([a-z]{3}|[a-z]{2}\.[a-z]{2}){1}$/
	return e.match(ep)
    }
    function check_mobile(m) {
	var mp = /^[987]\d{9}$/
	return m.match(mp)
    }
</script>