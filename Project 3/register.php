<!doctype html>

<?php 
    // Start new session
    session_start();

    // Listen for post method
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Check if logout was called
        if(array_key_exists('logout', $_POST)) {
            
            // Delete loginToken cookie
            setcookie("loginToken", "", time() - 3600, "/");
            header("Refresh:0");
            
            // Destroy Session
            session_destroy ();
        }
        
        // Check if home was called
        if(array_key_exists('home', $_POST)) {
            header("Location: ./index.php");
        }
    }
?>

<html lang="en">

<head>
    <meta charset="utf-8">

    <title>Project 3 - Account Registration</title>
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
            <?php
                // Check is a login has been created
                if(isset($_SESSION['username'])) { ?>
            
                    <!-- Display success message -->
                    <h3>You have successfully created an account, <?php echo $_SESSION['username'] ?>.</h3>
                    <form method="post">
                        <input type="submit" name="home" value="Return Home" class="form-button">
                        <input type="submit" name="logout" value="Delete Account" class="form-button">
                    </form>
            
                <?php } else { ?>
            
                    <!-- Show account creaiton form-->
                    <form method="post">
                        
                    <?php
                        // Account creation logic
                    
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

                            $err = 0;

                            // Check for valid email
                            if (!preg_match($emailReg, $_POST['email'])) {
                                echo '<p>❌ Invalid Email</p>';
                                $err = 1;
                            } 

                            // Check for valid email
                            if (!preg_match($usernameReg, $_POST['username'])) {
                                echo '<p>❌ Invalid Username. Usernames must be 5-20 characters and consist of letters, numbers, and underscores only.</p>';
                                $err = 1;
                            } 

                            // Check for valid email
                            if (!preg_match($passwordReg, $_POST['password'])) {
                                echo '<p>❌ Weak Password. Passwords must be 8-32 characters long, include 1 lowercase, 1 uppercase, and 1 special character.</p>';
                                $err = 1;
                            } 

                            // Check for valid email
                            if ($_POST['confirmPassword'] != $_POST['password']) {
                                echo '<p>❌ Passwords don\'t match!</p>';
                                $err = 1;
                            } 

                            // Check if there are any validation errors
                            if ($err == 0) {
                                // Store values in session
                                $_SESSION['email'] = $_POST['email'];
                                $_SESSION['username'] = $_POST['username'];
                                $_SESSION['password'] = $_POST['password'];
                                header("Refresh:0");
                            }
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
                <?php }
            ?>
            
        </div>
    </div>
</body>

</html>
