<?php
session_start();
ob_start();
if(!isset($_SESSION['userid'])) {
    header("Location:index.php");
}
include './db.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Group Shilling Attacks</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/arial.js"></script>
<script type="text/javascript" src="js/cuf_run.js"></script>
</head>
<body>
<div class="main">
  <div class="header">
    <div class="header_resize">
      <div class="logo">
        <h1><a href="#"><span>Online</span>Shopping <small>Attacks in Recommender System</small></a></h1>
      </div>
      <div class="menu">
        <ul>
          <li><a href="signout.php"><span>SignOut</span></a></li>
        </ul>
      </div>
      <div class="clr"></div>
    </div>
    
  </div>
  <div class="body">
    <div class="body_resize">
        <div class="right_align">
            Welcome, <?php echo $_SESSION['uname'];?> | 
            <img src="<?php echo $_SESSION['imgpath']?>" width="50px" style="float:none;margin:0;">
        </div>
      <div class="left"><p>