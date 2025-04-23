<?php
$first_name = value($_POST["first"]);
$last_name = value($_POST["last"]);
$date_of_birth = value($_POST["DateOfBirth"]);
$gender = value($_POST["gender"]);
$phone = value($_POST["phone"]);
$username = value($_POST["username"]);
$password = value($_POST["password"]);


function value($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$connect = new mysqli("localhost", "root", "1243", "library");

$user = mysqli_query($connect, "select User_name from login_details where User_name = '$username'");
if(mysqli_num_rows($user) > 0)
{
    echo "Username is Already exist";
}
else
{
    $infoquery = "INSERT INTO `user_info` (`First_Name`, `Last_Name`, `Age`, `Job`, `Phone`, `Gender`, `Address`, `Date_of_birth`)
    VALUES ('$first_name', '$last_name', 'Default', 'Default', '$phone', '$gender', 'Default', '$date_of_birth');";

    $logquery = "INSERT INTO `login_details` (`User_name`, `Password`)
    VALUES ('$username', '$password');";

    if($connect->query($infoquery) ===true)
    {
        $last_info_id = $connect->insert_id;
    }
    
    if($connect->query($logquery) ===true)
    {
        $last_log_id = $connect->insert_id;
    }
    $accountquery = "INSERT INTO `accounts` (`user_id`, `login_id`)
    VALUES ('$last_info_id', '$last_log_id');";

    if($connect->query($accountquery) ===true)
    {
        echo "New record created sucessfully";
    }
}
?>