<!doctype html>

<?php 
    session_start();
?>

<html lang="en">

<head>
    <meta charset="utf-8">

    <title>Project 2 - Account Registration</title>
    <meta name="description" content="Project 2 - Home">
    <meta name="author" content="Miko Jimenez">

    <link rel="stylesheet" href="css/styles.css">

</head>

<body>
    <div class="content">
        <header>
            <h1>Project 2 – Account Registration</h1>
            <hr>
            <h2>Miko Jimenez</h2>
        </header>
        <nav>
            <a href="./index.php">Login</a>
        </nav>
        <div class="body">
            <form method="post">
                <?php
                    // Check if form submitted
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Simple email regex
                        $emailReg = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+.[a-zA-Z]{2,}$/"; 

                        // Username regex
                        $usernameReg = "/^[a-zA-Z0-9_]{5,20}$/"; 

                        // Password regex
                        // 8-32 characters
                        // At least 1 lowercase character
                        // At least 1 uppercase character
                        // At least 1 special character
                        $passwordReg = "/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[*.!@$%^&(){}[\]:;<>,.?\/\~_+-=\|]).{8,32}$/";

                        // Check for valid email
                        if (!preg_match($emailReg, $_POST['email'])) { ?>
                            <p>❌ Invalid Email</p>
                        <?php } 
                        
                        // Check for valid email
                        if (!preg_match($usernameReg, $_POST['username'])) { ?>
                            <p>❌ Invalid Username. Usernames must be 5-20 characters and consist of letters, numbers, and underscores only.</p>
                        <?php }
                        
                        // Check for valid email
                        if (!preg_match($passwordReg, $_POST['password'])) { ?>
                            <p>❌ Weak Password. Passwords must be 8-32 characters long, include 1 lowercase, 1 uppercase, and 1 special character.</p>
                        <?php }
                        
                        // Check for valid email
                        if ($_POST['confirmPassword'] != $_POST['password']) { ?>
                            <p>❌ Passwords don't match!</p>
                        <?php }
                    }
                ?>
                <label for="email">Email</label>
                <input type="email" placeholder="your@email.com" name="email" required>
                <label for="username">Choose a Username</label>
                <input type="text" placeholder="username" name="username" required>
                <label for="password">Set Password</label>
                <input type="password" placeholder="********" name="password" required>
                <label for="confirmPassword">Confirm your Password</label>
                <input type="password" placeholder="********" name="confirmPassword" required>
                <button type="submit">Create Account</button>
            </form>
        </div>
    </div>
</body>

</html>
