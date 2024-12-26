<?php


include "config.php";

if(isset($_SESSION['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    // check user

    $sql = "SELECT * FROM `loginsystem` WHERE email='$email' ";

    $result = mysqli_query($conn,$sql);

    if($result)
    {
        if(mysqli_num_rows($result)==1) // is user found
        {
            $fetch = mysqli_fetch_assoc($result);
            if($fetch['password']==$_POST['password']) //if password match
            {
                $_SESSION['login'] = true;
                $_SESSION['email'] = $fetch['email'];

                echo alert ("login successfully");

                header('Location: home.php');
                exit();

            }
            else //if password doesnot match
            {
                echo ("invalid password");

            }

        }
        else// if a user not found
        {
            echo alert("user not found");

        }

    }

    else{
        echo alert("Query failed");
    }
}
?>




