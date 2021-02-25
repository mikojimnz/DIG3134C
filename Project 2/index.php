<!doctype html>

<html lang="en">

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(array_key_exists('logout',$_POST)) {
            setcookie("loginToken", "", time() - 3600, "/");
            header("Refresh:0");
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
            <a href="./index.php">Home</a>
        </nav>
        <div class="body">

            <div>
                <form method="post">
                    <?php
                    $username = 'dig3134user';
                    $password = 'dig3134pass';
                
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if ($_POST['username'] == $username && $_POST['password'] == $password) {
                            setcookie("loginToken", "true", time() + (60 * 5), "/");
                            header("Refresh:0");
                        } else { ?>
                    
                    <p>❌ Invalid username or password!</p>
                    
                    <?php }
                    }
                
                    if(isset($_COOKIE['loginToken'])) { ?>

                    <h3>✅ You're Logged In!</h3>
                    <form method="post">
                        <input type="submit" name="logout" id="logout" value="Logout">
                    </form>

                    <?php } else { ?>

                    <label for="username">Username</label>
                    <input type="text" placeholder="Username" name="username" id="username" required>
                    <label for="password">Password</label>
                    <input type="password" placeholder="********" name="password" id="password" required>
                    <br>
                    <button type="submit">Login</button>
                    <br>
                    <a href="./register.php" target="_self">Create a new account</a>
                </form>

                <?php } ?>
            </div>

        </div>
    </div>
</body>

</html>
