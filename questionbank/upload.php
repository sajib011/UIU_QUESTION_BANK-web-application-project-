<?php

if(isset($_POST['submit'])){
    $file=$_FILES['file'];
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
                savefile($fileDestination);
                header("Location: upload.php?uploadsuccess");
                
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


function savefile($fileName){
    
    $date=date("Y-m-d");
    $name="bla";
    
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
    $query="INSERT INTO `documents`(`name`, `path`) VALUES ('$name','$var');";
    
    
    mysqli_query($con,$query);

    if(mysqli_affected_rows($con)>0){
        echo "pdf file path saved in database";
    }

    mysqli_close($con);

}

