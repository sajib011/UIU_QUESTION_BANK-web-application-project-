<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rating</title>
</head>
<body>
   
   <?php
    
    $con = mysqli_connect("localhost","root","","uiu_question_bank");
    
    session_start();
    error_reporting(0);
    
    $id=$_SESSION['id'];
    $date=date("Y-m-d");
    
    $QuesId=$_GET['id'];
    $rate=$_POST["rates"];
    
    echo $QuesId;
    
    if(!$con){
        die("Connection failed : ".mysqli_connect_error());
    }
    $query = "select * from question_bank where Question_id='$QuesId'";
    $result = mysqli_query($con,$query);
    $row = mysqli_fetch_array($result);

    $question_name=$row['Question_name'];
    
    echo $question_name;
    
    if(isset($_POST['rate'])){
    //echo "ok";
        if($rate=="one"){
            $my_rating=1;
        }else if($rate=="two"){
            $my_rating=2;
        }else if($rate=="three"){
            $my_rating=3;
        }else if($rate=="four"){
            $my_rating=4;
        }else if($rate=="five"){
            $my_rating=5;
        }

        //echo $my_rating;
        $qr = "select * from rank where Student_id='$id' && Question_id='$QuesId'";

        $result = mysqli_query($con, $qr);
        $num = mysqli_num_rows($result);
        if($num == 0){
            $qy="INSERT INTO `rank`(`Question_id`, `Student_id`, `rating`) VALUES ('$QuesId','$id','$my_rating')";
            mysqli_query($con,$qy);
                //header('location:allSongs.php');
                //echo "rates success";
        }
    }
    
    
    
    ?>
    
    <div class="ratings">
                  <form method="post" id="ratess" >
                   <div class="levels">
                       Standard Level :
                   </div>
                    
                    <div class="rate-but">
                        <input type="radio" name="rates"  <?php  if (isset($rates) && $rates=="one") echo "checked"; ?> value="one" id="one" >1
                    </div>
                    
                    
                    <div class="rate-but">
                       <input type="radio" name="rates" <?php  if (isset($rates) && $rates=="two") echo "checked"; ?>  value="two" id="two">2
                        
                    </div >
                    
                     <div class="rate-but">
                       <input type="radio" name="rates" <?php  if (isset($rates) && $rates=="three") echo "checked"; ?>  value="three" id="three">3
                        
                    </div >
                    
                     <div class="rate-but">
                       <input type="radio" name="rates" <?php  if (isset($rates) && $rates=="four") echo "checked"; ?>  value="four" id="four">4
                        
                    </div >
                    
                     <div class="rate-but">
                       <input type="radio" name="rates" <?php  if (isset($rates) && $rates=="five") echo "checked"; ?>  value="five" id="five">5
                        
                    </div >
                     
                                      
                     
                     <input name="rate" type="submit" value="Rate" id="rate1">
                 </form>
               </div>
    
</body>
</html>