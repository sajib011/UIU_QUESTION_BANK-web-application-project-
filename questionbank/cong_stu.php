<?php
    
    $con = mysqli_connect("localhost","root","","uiu_question_bank");

    if($con){
        
    }
    else{
        die("Connection failed : ".mysqli_connect_error());
    }

    session_start();
    error_reporting(0);
    
    $id=$_SESSION['id'];
    $date=date("Y-m-d");

    if(!isset($_SESSION['id'])){
       header('location:logn.php');
    }
 
    $memberType = $_SESSION['membertype'];

    $facId=$_POST['faculty'];
    $msg=$_POST['message'];

    if(isset($_POST['request'])){
        //echo $facId;
        //echo $msg;
        //echo $id;
        if($msg!=""){
        $qr = "select * from faculty where Faculty_id='$facId'";
        $result = mysqli_query($con, $qr);
        $num = mysqli_num_rows($result);
        if($num == 1)
        {
            $qy="INSERT INTO `requests`(`Student_id`, `faculty_id`, `req_dates`, `req`) VALUES ('$id','$facId','$date','$msg')";
             mysqli_query($con,$qy);
            header('location:cong_stu.php');
            //echo "done";
        }
       }
        
    }

    
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
        <title>Congratulation</title>
    <link href="css/cong_stu.css" rel="stylesheet" type="text/css">
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
                         <li><a href="cong_stu.php" >Home</a></li>
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
        
       //select * from student where student_id='$id' && password='$pass'
        if($memberType==1){
               $query = "select * from student where student_id='$id'";
               $result = mysqli_query($con,$query);
                $row = mysqli_fetch_array($result);
                $name=$row['student_name'];
           }
           else{
               $query = "select * from faculty where Faculty_id='$id'";
           $result = mysqli_query($con,$query);
            $row = mysqli_fetch_array($result);
            $name=$row['Faculty_name'];
           }
           
       ?>

   <div class="cong">
       <p style="color: black;text-align:center">Welcome :<?php 
           echo $name;
           echo " (s)";
           ?></p>
       </div>
       
       <div class="main-body">
          <div class="question-solution">
               <div class="questions">
                  <span style="font-weight:bold;font-size:20px;margin:20px">Questions :</span>
                  <br>
                   <?php
                   $con = mysqli_connect("localhost","root","","uiu_question_bank");

                    if(!$con){
                        die("Connection failed : ".mysqli_connect_error());
                    }
                   //$query = "SELECT * FROM question_bank q LEFT join rank r on q.Question_id=r.Question_id ";
                   $query = "SELECT * FROM question_bank";
                   $r=mysqli_query($con,$query);
                    while($row=mysqli_fetch_array($r)){             
                     ?>
                     <div class="question-block" style="">
                        <a href="<?php echo $row['Question_path']; ?>"><?php echo $row['Question_name']; ?></a>
                         
                         <?php
                            $Qid=$row['Question_id'];
                            $que = "select * from rank where Question_id='$Qid'";
                            $res = mysqli_query($con,$que);
                            $row1 = mysqli_fetch_array($res);

                            $Qrate=$row1['rating'];
                        
                        if($row1['rating']==0){
                            echo "[QR : Not Rated]";
                        }else{
                            echo "[QR : ".$row1['rating']."]";
                        }
                        
                         echo '<div class=""><a target="_blank" style="color:black" href="rate.php?id='.$row['Question_id'].'">'."Rate".'</a></div>';
                        
                        ?>
                        
                     </div> 
                   <?php       
                     }
                   ?>

               </div>

               <div class="solutions">
                  <span style="font-weight:bold;font-size:20px;margin:20px">Solutions :</span>
                  <br>
                   <?php
                   $con = mysqli_connect("localhost","root","","uiu_question_bank");

                    if(!$con){
                        die("Connection failed : ".mysqli_connect_error());
                    }
                   $query = "SELECT * FROM `question_bank`";
                   $r=mysqli_query($con,$query);
                    while($row=mysqli_fetch_array($r)){             
                     ?>

                    <div class="solution-block">
                        <a href="<?php echo $row['solution_path']; ?>"><?php echo $row['Question_name']." solution"; ?></a>
                    </div>

                   <?php       
                     }
                   ?>

               </div>
             </div>
           
           <div class="request" >
                   <P style="font-weight:bold;">Request For A Question</P>
                    <form method="post" id="req" value="requests" >
                       
                        <input style="margin:3px;" type="text" name="faculty" Placeholder="FacultyId">
                        
                        <textarea Placeholder="Request" style="width:100%;" name="message" id="comm-box" cols="30" rows="3"></textarea>
                        
                        <input value="Request" type="submit" name="request" id="comm-sub-box" style="font-weight:bold;background-color:darkgrey;padding:3px;">
                        
                    </form>
              </div>
              <div class="fac-name" >
                   <br>
                           <p style="background-color: grey; border-radius:auto">Faculty Details :</p>
                           
                           <?php
                            
                            $query = "SELECT * FROM faculty";
                            $r=mysqli_query($con,$query);
                            while($row=mysqli_fetch_array($r)){
                                
                             ?>
                                
                              <div class="" style="background-color: grey">
                                  <?php echo $row['Faculty_name'];?>
                                  <?php echo ":"?>
                                  <?php echo $row['Faculty_id'];?> 
                              </div>
                                
                                
                                
                            <?php
                                
                            }
                           ?>
              </div>
              
       </div>
       
       
    </body>
</html>






