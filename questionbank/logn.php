<?php

    session_start();
    $con = mysqli_connect("localhost","root","","uiu_question_bank");

    if($con){
        
    }
    else{
        die("Connection failed : ".mysqli_connect_error());
    }

    mysqli_select_db($con,'sessionpractical');

    error_reporting(0);

    $id=$_POST['id'];
    $pass=$_POST['pass'];

    if (isset($_POST['submit'])){
        
        $qur="select * from student where student_id='$id' && password='$pass'";
        $res = mysqli_query($con,$qur);
        $chk= mysqli_num_rows($res);
        
        $qur2="select * from faculty where Faculty_id='$id' && f_password='$pass'";
        $res2 = mysqli_query($con,$qur2);
        $chk2= mysqli_num_rows($res2);
        
        if($chk==1){
            $_SESSION['id']=$id;
            $_SESSION['membertype']=1;
            header('location:cong_stu.php');
            
        }
        
        else if($chk2==1){
            $_SESSION['id']=$id;
            
            $_SESSION['membertype']=2; 
            
            
            header('location:cong_fac.php');
            
        }
        else{
            header('location:logn.php');
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
        <title>Congratulation</title>
    <link href="css/cong_fac.css" rel="stylesheet" type="text/css">
    </head>

<body>
   <header>
      <div class="container">
         <div class="contact"> 
            <div id="margin1">
                <ul>
                    <li><a href=""><p>skarim1711151@bscse.uiu.ac.bd</p></a></li>
                    <li><a href=""><p>+88-01521325398</p></a></li>
                 </ul>
            </div>
             
         </div>
         <nav> 
            <div class="navbar1"> 
                <div class="logo">
                 <h1>UIUQuestionBank</h1> 
             </div>
                <div class="navlist">
                     <ul>
                         <li><a href="logn.php" >Home</a></li>
                         <li><a href="" >About US</a></li>
                         <li><a href="" >Other</a></li>
                     </ul>
                 </div>
             </div>
         </nav>
       </div>
    </header>
<head>
<meta charset="UTF-8">
<title>LogIn</title>
<link href="css/logn.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="signin">
<form method="post" id="login">
<h2 style="color: white">Log In </h2>

<input type="id" name="id"
placeholder="ID"><br><br>

<input type="password" name="pass"
placeholder="password"><br><br>


<input type="submit" name="submit" value="Log In" id="sub"><br><br>
<div id="container">
</div>
<!--
<a href="#" style=" margin-right:0px; font-size:13px;
font-family:Tahoma, Geneva, sans-serif;">Reset password</a>
<a href="#" style=" margin-right:0px; font-size:13px;
font-family:Tahoma, Geneva, sans-serif;">Forget password</a>
</div><br><br><br><br><br><br>

-->
Do not have account?<a href="sgnup.php">&nbsp;Sign Up</a><br><br>
Go to Home Page<a href="index.php">&nbsp;Home Page</a>


</form>
</div>
</body>
</html>