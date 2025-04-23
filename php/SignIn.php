<?php
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
// استعلام 
$sql = mysqli_query($connect, "select user_name from login_details where user_name = '$username'");
$num_rows = mysqli_num_rows($sql);
if($num_rows > 0)
{
    $pass = mysqli_query($connect, "select Password from login_details where user_name = '$username'");
    $row = $pass->fetch_assoc();
    $passwordchar = $row["Password"];
    if($passwordchar == $password)
    {
        $user = mysqli_query($connect, "select user_info.First_Name 
        FROM user_info, login_details, accounts
        WHERE User_name = '$username'
        AND
        login_details.Login_ID = accounts.Login_ID
        AND user_info.User_ID = accounts.User_ID;");
        $row = $user->fetch_assoc();
        $name = $row["First_Name"];
        echo "<script>
        window.setTimeout(function(){
            window.location.href = '../index.html';
        }, 1000);
        alert(\"Successfully Login. Hello $name\")
        </script>
    ";
    } else 
    {
        echo "<script>
        window.setTimeout(function(){
            window.location.href = '../signin.html';
        }, 1000);
        alert(\"Wrong Password. Try again\")
        </script>    }";
    }
}
else
{
    echo "<script>
        window.setTimeout(function(){
            window.location.href = '../signin.html';
        }, 1000);
        alert(\"Wrong username. Try again\")
        </script>    }";
}
?>