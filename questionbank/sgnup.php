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
    $name=$_POST['name'];
    $email=$_POST['email'];
    $dept=$_POST['dept'];
    $pass=$_POST['pass'];

    $acctype=$_POST["acctype"];
    //echo $acctype;

    $date=date("Y-m-d");

    if (isset($_POST['submit'])){
        
        if($_POST['id']==""){
            $error_msg['idmsg']="required!";
        }
        if($_POST['name']==""){
            $error_msg['namemsg']="required!";
        }
        if($_POST['email']==""){
            $error_msg['emailmsg']="required!";
        }
        if($_POST['dept']==""){
            $error_msg['deptmsg']="required!";
        }
        if($_POST['pass']==""){
            $error_msg['passmsg']="required!";
        }
        
        if($acctype=="stu"){
            $qur="insert into student(student_id,student_name,s_email,password,s_reg_date) values ('$id','$name','$email','$pass','$date')";
        }
        else if ($acctype=="fac"){
            $qur="insert into faculty(Faculty_id,Faculty_name,f_email,f_password,f_reg_date) values ('$id','$name','$email','$pass','$date')";
        }
        
        mysqli_query($con,$qur);
    }
    

?>
   
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link href="css/sgnup.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class = "signup">
        <form method="post" id="signup">
            <h2 style = "color: #fff;">Sign Up</h2>
            <nav>
             
            <div class="navbar1"> 
                <div class="logo">
         </nav>
            <input type = "id" name = "id" placeholder = "ID"> 
                    <?php if(isset($error_msg['idmsg'])){
                    echo $error_msg['idmsg'];  
                }
            ?>
            <br> <br>
            <input type = "text" name = "name" placeholder = "Name">
                   <?php if(isset($error_msg['namemsg'])){
                    echo $error_msg['namemsg'];  
                }
            ?>
            <br> <br>
            <input type = "email" name = "email" placeholder = "Email Address"> 
                    <?php if(isset($error_msg['emailmsg'])){
                    echo $error_msg['emailmsg'];  
                }
            ?>
            <br> <br>
            <input type = "text" name = "dept" placeholder = "Department Name"> 
                    <?php if(isset($error_msg['deptmsg'])){
                    echo $error_msg['idmsg'];  
                }
            ?>
            <br> <br>
            <input type = "password" name = "pass" placeholder = "Password"> 
                    <?php if(isset($error_msg['passmsg'])){
                    echo $error_msg['idmsg'];  
                }
            ?>
            <br> <br>
            <label> Select:</label>
                                      <?php
                                            if(isset($error_msg['acctype'])){
                                                //echo  $error_msg['name'];
                                                echo "<span style='color:red'>".$error_msg['acctype']."</span>";
                                            }
                                        ?>
                                        <br>
                                        
                                        <input type="radio" name="acctype" <?php  if (isset($acctype) && $acctype=="stu") echo "checked"; ?> value="stu" id="stu" > <p style="color: dodgerblue">Student</p>
                                        
                                        <input type="radio" name="acctype" <?php  if (isset($acctype) && $acctype=="fac") echo "checked"; ?>  value="fac" id="fac"><p style="color: dodgerblue">Faculty</p>
                                        
                                        <br>

            <!--
            <input type = "Password" name = "Password" placeholder = "Confirm Password"> <br> <br>
            -->
            <input type="submit" name="submit" value="SignUp" id="sub"><br><br>
            Go to Home Page<a href="index.php">&nbsp;Home Page</a>
            
        </form>
    </div>
</body>
</html>