<!doctype html>

<?php 
    // Start new session
    session_start();
?>

<html lang="en">

<head>
    <meta charset="utf-8">

    <title>Project 4 - Account Registration</title>
    <meta name="description" content="Project 4 - Home">
    <meta name="author" content="Miko Jimenez">

    <link rel="stylesheet" href="css/styles.css">

</head>

<body>
    <div class="content">
        <header>
            <h1>Project 4 – Account Registration</h1>
            <hr>
            <h2>Miko Jimenez</h2>
        </header>
        <nav>
            <a href="./index.php">Login</a>
        </nav>
        <div class="body">
            <?php
                // Check is a login has been created
                if(isset($_SESSION['loggedin'])) { ?>
            
                    <!-- Display success message -->
                    <h3>You have successfully created an account, <?php echo $_SESSION['username'] ?>.</h3>
                    <div><button onclick="window.location.href='index.php'" class="link-button">Home</button></div>
                    <div><button onclick="window.location.href='logout.php'" class="link-button">Logout</button></div>
                    <div><button onclick="window.location.href='delete.php'" class="link-button">Delete Account</button></div>
            
                <?php } else { ?>
            
                    <!-- Show account creaiton form-->
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
                    <label for="email">Email</label>
                    <input type="email" placeholder="your@email.com" name="email" required>
                    <label for="username">Choose a Username</label>
                    <input type="text" placeholder="username" name="username" required>
                    <label for="password">Set Password</label>
                    <input type="password" placeholder="********" name="password" required>
                    <label for="confirmPassword">Confirm your Password</label>
                    <input type="password" placeholder="********" name="confirmPassword" required>
                    <button type="submit" name="register">Create Account</button>
                </form>
                <?php }
            ?>
            
        </div>
    </div>
</body>

</html>
