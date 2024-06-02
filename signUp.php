<?php 
include 'connect.php';

if(isset($_POST['signUp'])){
    $Name=$_POST['Name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);

    $checkEmail="SELECT * From loginuser where email='$email'";
    $result=$conn->query($checkEmail);
    if($result->num_rows>0){
        echo "Email Address Already Exists !";
    }
    else{
        $insertQuery="INSERT INTO loginuser(Name,email,password)
                       VALUES ('$Name','$email','$password')";
        if($conn->query($insertQuery)==TRUE){
            header("location: signIn.html");
        }
        else{
            echo "Error:".$conn->error;
        }
    }
}
?>
