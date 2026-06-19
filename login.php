<?php
session_start();
include 'config/database.php';

$error = "";

if(isset($_POST['login'])){

    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_query($conn,
        "SELECT * FROM users WHERE username='$username'"
    );

    if(mysqli_num_rows($query) > 0){

        $user = mysqli_fetch_assoc($query);

        if($password == $user['password']){
            // login success
        }
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['role'] = $user['role'];

            header("Location: dashboard.php");
            exit();

        }else{
            $error = "Invalid Password";
        }

    }else{
        $error = "User not found";
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>

<div class="container">

    <form method="POST">

        <div class="card">

            <a class="login">Log in</a>

            <?php if($error != ""){ ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>

            <div class="inputBox">
                <input
                    type="text"
                    name="username"
                    required
                >
                <span class="user">Username</span>
            </div>

            <div class="inputBox">
                <input
                    type="password"
                    name="password"
                    required
                >
                <span>Password</span>
            </div>

            <button
                type="submit"
                name="login"
                class="enter"
            >
                Enter
            </button>

        </div>

    </form>

</div>

</body>
</html>