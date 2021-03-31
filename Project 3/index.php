<!doctype html>

<html lang="en">

<?php
    // Start new session
    session_start();
    
    // Listen for post method
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Check if logout was called
        if(array_key_exists('logout', $_POST)) {
            
            // Delete loginToken cookie
            unset($_SESSION['loggedin']);
            header("Refresh:0");
            
            // Destroy Session
            session_destroy ();
        }
    }
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
                <h3>✅ You're Logged In!</h3>
                <form method="post" >
                    <input type="submit" name="logout" value="logout" class="form-button">
                </form>
                
                <!-- Do Something here-->
            </div>

        <?php } else { ?>

            <div>
                <form method="post" action="connect.php">
                    
                    
                    <!-- If not logged in, show login form -->
                    <label for="username">Username</label>
                    <input type="text" placeholder="Username" name="username"required>
                    <label for="password">Password</label>
                    <input type="password" placeholder="********" name="password" required>
                    <br>
                    <button type="submit" name="login" value="login">Login</button>
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
