<!doctype html>

<html lang="en">

<?php
    // Start new session
    session_start();
?>

<head>
    <meta charset="utf-8">

    <title>Project 3 - Home</title>
    <meta name="description" content="Project 2 - Home">
    <meta name="author" content="Miko Jimenez">

    <link rel="stylesheet" href="css/styles.css">

</head>

<body>
    <div class="content">
        <header>
            <h1>Project 3 – Databases, Sessions, and Encryption</h1>
            <hr>
            <h2>Miko Jimenez</h2>
        </header>
        <nav>
            <a class="active">Home</a>
        </nav>
        
        <div class="body">

        <?php
            // Check if logged in
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']) { ?>
            
            <div>
                <!-- Show logged in content -->
                <h3>✅ You're Logged In, <?php echo $_SESSION['username'] ?>!</h3>
                <form method="post" action="connect.php">
                    <input type="submit" name="logout" value="Logout" class="form-button">
                    <input type="submit" name="delete" value="Delete Account" class="form-button">
                </form>
                
                <!-- Do something here-->
                <?php include("element.php"); ?>
            </div>

        <?php } else { ?>

            <div>
                <form method="post" action="connect.php">
                    
                    <?php

                    // Display any errors
                    if (isset($_SESSION['errs'])) {
                        foreach ($_SESSION['errs'] as $err) {
                            echo ("<p>$err</p>");
                        }

                        // Clear error log
                        unset($_SESSION['errs']);
                    }

                    ?>
                    
                    <!-- If not logged in, show login form -->
                    <label for="username">Username</label>
                    <input type="text" placeholder="Username" name="username"required>
                    <label for="password">Password</label>
                    <input type="password" placeholder="********" name="password" required>
                    <br>
                    <button type="submit" name="login">Login</button>
                    <br>
                    
                    <!-- Account creation form-->
                    <a href="./register.php" target="_self">Dont have an account? Create one now!</a>
                </form>
            </div>

        <?php } ?>

        </div>
    </div>
</body>

</html>
