<?php
include './header.php';
if(!isset($_POST['submit1'])) {
?>
<br>
<form name="f" action="regn.php" method="post" onsubmit="return check_regn()">
    <table class="login">
        <thead>
            <tr>
                <th colspan="2">USER REGISTRATION</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Name</th>
                <td><input type="text" name="uname" autofocus required></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><textarea name="addr" required></textarea></td>
            </tr>
            <tr>
                <th>Gender</th>
                <td><input type="radio" name="gender" value="Male" checked>Male&nbsp;<input type="radio" name="gender" value="Female">Female</td>
            </tr>
            <tr>
                <th>DOB</th>
                <td><input type="date" name="dob" required></td>
            </tr>
            <tr>
                <th>Mobile</th>
                <td><input type="text" name="mobile" maxlength="10" required></td>
            </tr>
            <tr>
                <th>E-Mail (Userid)</th>
                <td><input type="text" name="email" required></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><input type="password" name="pwd" required></td>
            </tr>
            <tr>
                <th>Confirm Pwd</th>
                <td><input type="password" name="cpwd" required></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="center">
                    <input type="submit" name="submit1" value="Register">                  
                </td>
            </tr>
        </tfoot>
    </table>
    <Br><br>
</form>
<?php
} else {
    extract($_POST);
    $rtime = date('Y-m-d h a',time()+19800);
    mysqli_query($link, "insert into newuser(uname,addr,gender,dob,mobile,userid,pwd,uphoto,ftype,rtime) values('$uname','$addr','$gender','$dob','$mobile','$email','$pwd','ups/userpic.gif','image/jpeg','$rtime')") or die(mysqli_error($link));
    echo "<div class='center'>UserId Generated Successfully...!<br><a href='userlogin.php'>Login</a></div>";  
}
include './footer.php';
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