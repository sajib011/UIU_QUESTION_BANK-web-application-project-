<?php
    
    $con = mysqli_connect("localhost","root","","uiu_question_bank");

    if($con){
        
    }
    else{
        die("Connection failed : ".mysqli_connect_error());
    }

    session_start();
    error_reporting(0);
    
    

    if(!isset($_SESSION['id'])){
       header('location:logn.php');
    }

    
    
    $memberType = $_SESSION['membertype'];
    
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
        <title>Congratulation</title>
    <link href="css/cong.css" rel="stylesheet" type="text/css">
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
                         <li><a href="swelcome.php" >Home</a></li>
                         <li><a href="" >About US</a></li>
                         <li><a href="" >Other</a></li>
                         <li><a href="logout.php" >Log Out</a></li>
                     </ul>
                 </div>
             </div>
         </nav>
       </div>
    </header>
    <?php 
            $query = "select * from student where student_id='$id'";
               $result = mysqli_query($con,$query);
                $row = mysqli_fetch_array($result);
                $name=$row['student_name'];
           
           
       ?>

   <div class="cong">
       <p style="color: black;text-align:center">Welcome :
          <?php 
           echo $name;
           
           ?></p>
       </div>
       <div class="input-form">
           
           
           
       </div>
       
    </body>
</html>






