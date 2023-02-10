<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
.error {color: #FF0000;}
</style>
</head>
<body>
<?php

$nameerr = $emailerr = $gendererr =$websiteerr= "";
$name = $email = $gender = $comment =$website= "";
    if($_SERVER['REQUEST_METHOD']=="POST"){
        
        if(!empty($_POST['name'])){
            echo"<br>";
            $name=testInput($_POST['name']);
            if(!preg_match("/^[a-zA-Z-' ]*$/",$name)){
                $nameerr="Only letters and white space allowed<br>";
            }
        }else {
            $nameerr="*the name is required<br>";
        }


        if(!empty($_POST['email'])){
            $email=testInput($_POST['email']);
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $emailerr="invalid email <br>";
            }
        }else {
            $emailerr="*the email is required<br>";
        }


        if(!empty($_POST['website'])){
            $website=testInput($_POST['website']);
            if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)){
                $websiteerr="invalid website <br>";
            }
        } else{
            $websiteerr="*the website is required";
        }

        if(!empty($_POST['comment'])){
            $comment=testInput($_POST['comment']);
           
        }

        if(!empty($_POST['gender'])){
            $gender=$_POST['gender'];
        }else{
            $gendererr="*gender is required<br>";
        }
        
    }

    function testInput($input){
        $input=trim($input);
        $input=stripslashes($input);
        $input=htmlspecialchars($input);
        return $input;
    }
    ?>


    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
        Name: <input type="text" name="name"> <br>
        <span class="error"><?php echo $nameerr; ?></span>
        Email: <input type="text" name="email"> <br>
        <span class="error"><?php echo $emailerr; ?></span>
        Website: <input type="text" name="website"> <br>
        <span class="error"><?php echo $websiteerr; ?></span><br>
        comment: <br> <textarea name="comment" id="" cols="30" rows="10"></textarea>
        <br>
        Gender: <br>
        <input type="radio" name="gender" value="male">Male
        <input type="radio" name="gender"value="female" >Female <br>
        <span class="error"><?php echo $gendererr; ?></span>
        <button type="submit">Submit</button>
    </form>

    

    Your input: <br> 
    <?php 
    echo $name   ."<br>";
    echo $email  ."<br>";
    echo $website  ."<br>";
    echo $comment  ."<br>";
    echo $gender  ."<br>";
    ?>
</body>
</html>