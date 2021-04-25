<!doctype html>

<html lang="en">

<?php
    // Start new session
    session_start();
?>

<head>
    <meta charset="utf-8">

    <title>Project 4 - Home</title>
    <meta name="description" content="Project 4 - Home">
    <meta name="author" content="Miko Jimenez">

    <link rel="stylesheet" href="css/styles.css">

</head>

<body>
    <div class="content">
        <header>
            <h1>Project 4 – Database CRUD</h1>
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
                <div><button onclick="window.location.href='logout.php'" class="link-button">Logout</button></div>
                <div><button onclick="window.location.href='delete.php'" class="link-button">Delete Account</button></div>
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
