<?php
    $con = mysqli_connect("localhost","root","","uiu_question_bank");

    if($con){
        
    }
    else{
        die("Connection failed : ".mysqli_connect_error());
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Title of the document</title>
    <link rel="stylesheet" href="css/main.css" type="text/css">
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
                         <li><a href="index.php" >Home</a></li>
                         <li><a href="" >About US</a></li>
                         <li><a href="" >Other</a></li>
                         <li><a href="sgnup.php" >Sign Up</a></li>
                         <li><a href="logn.php" >Log In</a></li>
                     </ul>
                 </div>
             </div>
         </nav>

         