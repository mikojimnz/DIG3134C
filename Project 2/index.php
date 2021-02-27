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
            setcookie("loginToken", "", time() - 3600, "/");
            header("Refresh:0");
            
            // Destroy Session
            session_destroy ();
        }
    }
?>

<head>
    <meta charset="utf-8">

    <title>Project 2 - Home</title>
    <meta name="description" content="Project 2 - Home">
    <meta name="author" content="Miko Jimenez">

    <link rel="stylesheet" href="css/styles.css">

</head>

<body>
    <div class="content">
        <header>
            <h1>Project 2 – Intermediate PHP</h1>
            <hr>
            <h2>Miko Jimenez</h2>
        </header>
        <nav>
            <a class="active">Home</a>
        </nav>
        
        <div class="body">

            <div>
                <form method="post">
                    <?php
                    
                    // Define default login
                    $username = 'dig3134user';
                    $password = 'dig3134pass';
                
                    // Listen for post method
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        
                        // Check default credentials or new credentials
                        if (($_POST['username'] == $username && $_POST['password'] == $password) || 
                            (isset($_SESSION['username']) && $_SESSION['username'] == $_POST['username'] && $_SESSION['password'] == $_POST['password'] )) {
                            
                            // Set loginToken
                            setcookie("loginToken", "true", time() + (60 * 5), "/");
                            header("Refresh:0");
                        } else { ?>
                    
                    <!-- Display error message -->
                    <p>❌ Invalid username or password!</p>
                    
                    <?php }
                    }
                
                    // Check if logged in
                    if(isset($_COOKIE['loginToken'])) { ?>
                    
                    <!-- Show logged in content -->
                    <h3>✅ You're Logged In!</h3>
                    <form method="post">
                        <input type="submit" name="logout" value="Logout" class="form-button">
                    </form>

                    <?php } else { ?>
                    
                    <!-- If not logged in, show login form -->
                    <label for="username">Username</label>
                    <input type="text" placeholder="Username" name="username"required>
                    <label for="password">Password</label>
                    <input type="password" placeholder="********" name="password" required>
                    <br>
                    <button type="submit">Login</button>
                    <br>
                    
                    <!-- Account creation form-->
                    <a href="./register.php" target="_self">Dont have an account? Create one now!</a>
                </form>

                <?php } ?>
            </div>

        </div>
    </div>
</body>

</html>
