<?php
    
    $con = mysqli_connect("localhost","root","","uiu_question_bank");

    if($con){
        
    }
    else{
        die("Connection failed : ".mysqli_connect_error());
    }

    session_start();
    error_reporting(0);
    
    $qname=$_POST['qname'];
    $dname=$_POST['dname'];
    $tname=$_POST['tname'];
    $cname=$_POST['cname'];
    $id=$_SESSION['id'];

    if(!isset($_SESSION['id'])){
       header('location:logn.php');
    }

    

    if(isset($_POST['submit'])){
        $file=$_FILES['file'];
        
        $qname=$_POST['qname'];
        $dname=$_POST['dname'];
        $tname=$_POST['tname'];
        $cname=$_POST['cname'];
        //print_r($file);

        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.',$fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('pdf');

        if(in_array($fileActualExt,$allowed)){
            if($fileError === 0){
                if($fileSize < 1000000){
                    $fileNameNew=uniqid('',true).".".$fileActualExt;
                    $fileDestination='uploads/'.$fileNameNew;
                    move_uploaded_file($fileTmpName,$fileDestination);
                    savefile($fileDestination,$dname,$tname,$cname,$id);
                    header("Location: cong.php?uploadsuccess");

                }else{
                    echo "your file is too big";
                }

            }else{
                echo "there was an error uploading your file";
            }

        }else{
            echo "you can not upload files of this type";
        }
    
    
    }


    function savefile($fileName,$dname,$tname,$cname,$id){

        $date=date("Y-m-d");
        
        

    // Create connection
        $con = mysqli_connect("localhost","root","","uiu_question_bank");
    // Check connection
        if ($con) {
            //echo"ok";
        }
        else{
            die("Connection failed because ".mysqli_connect_error());
        }
        //$query="insert into aaa(song_name)values('{$fileName}')";
        $var =$fileName;
        $query="INSERT INTO `question_bank`(Question_name, Dept_name,Trimester_name,Course_name,Faculty_id) VALUES ('$var','$dname','$tname','$cname','$id');";


        mysqli_query($con,$query);

        if(mysqli_affected_rows($con)>0){
            echo "pdf file path saved in database";
        }

        mysqli_close($con);
    
    }

    
    $memberType = $_SESSION['membertype'];
    
    
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
                         <li><a href="cong.php" >Home</a></li>
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
            echo " (f)";
           
           ?></p>
       </div>
       <div class="main-body">
           <div class="input-form">
           <form  method="post" enctype="multipart/form-data" >
               <input type="file" name="file">
               
           
           
           
           <br>
           
           <level>Question name : </level>
           <input type = "text" name = "qname" placeholder = "">
                   <?php if(isset($error_msg['namemsg'])){
                    echo $error_msg['namemsg'];  
                }
            ?>
            <br>
            <level>Dept. name : </level>
           <input type = "text" name = "dname" placeholder =    "">
                   <?php if(isset($error_msg['namemsg'])){
                    echo $error_msg['namemsg'];  
                }
            ?>
           
           <br>
           
           <level>Trimester name : </level>
           <input type = "text" name = "tname" placeholder = "">
                   <?php if(isset($error_msg['namemsg'])){
                    echo $error_msg['namemsg'];  
                }
            ?>
            <br>
           
           <level>Course name : </level>
           <input type = "text" name = "cname" placeholder =     "">
                   <?php if(isset($error_msg['namemsg'])){
                    echo $error_msg['namemsg'];  
                }
            ?>
            <br>
            <input type="submit" name="submit" value="Upload">
           </form>
           
           
       </div>
          
          <div class="requests">
              <?php $con=mysqli_connect("localhost","root","","uiu_question_bank");

                if(!$con){
                    die("Connection failed : ".mysqli_connect_error());
                }
              
              $db=new PDO("localhost","uiu_question_bank","root","");
              $stmt=$db->prepare(select * from question_bank);
              $stmt->execute();
              while($row=$stmt->fetch()){
                  ?>
                  <span><?php echo $row['Question_id'] ?></span>
                  <span><?php echo $row['Question_name'] ?></span>
                  <span> <a href="download.php?id=<?php echo $row['Question_name'] ?>"></a></span>
                  
              }
           
          </div>
           
       </div>
       
       
    </body>
</html>






