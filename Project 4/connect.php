<?php
    session_start();

    // Define Database Login
    $host = "107.180.12.113";
    $username = "demoProject3";
    $password = "demoPass1234$";
    $dbname = "DIG3134";

    // Clear previous errors
    if (isset($_SESSION['errs'])) unset($_SESSION['errs']);
    $_SESSION['errs'] = array();

    // Call appropraite methods
    switch($_POST) {
        case(array_key_exists('login', $_POST)): // Login
            check_login();
            header("Location: index.php"); 
            break;
        case(array_key_exists('register', $_POST)): // Regiser account
            set_login();
            header("Location: register.php"); 
            break;
        case(array_key_exists('delete', $_POST)): // Delete account
            delete_login();
        case(array_key_exists('logout', $_POST)): // Logout of account
            include('logout.php');
            header("Location: index.php"); 
            break;
        default:
            die("Invalid Method");
            break;
        }

    // Input sanitization function
    function sanatize_inp(String $inp) {

        switch ($inp) {
            case "email":
                $_POST[$inp] = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
            case "username":
            case "password":
                $_POST[$inp] = trim($_POST[$inp]);
                $_POST[$inp] = strip_tags($_POST[$inp]);
                break;
            default:
                break;
        }
    }

    function get_login() {
        global $host, $username, $password, $dbname;
        $userCheck = array();

        // Create connection
        $conn = new mysqli($host, $username, $password, $dbname);

        // Check connection
        if ( $conn->connect_error ) {
            die( "Connection to database failed: " . $conn->connect_error );
        }

        $stmt = $conn->prepare("SELECT `username` FROM `Project3` WHERE `username` = ?;"); // Execute query
        $stmt->bind_param("s", $_POST['username']); // Add variables to statement
        $stmt->execute(); // Execute statement
        $result = $stmt->get_result(); // Get result
        $row = mysqli_fetch_array($result);

        // Check for normal result
        if ($result->num_rows != 0) array_push($userCheck, "username");

        $stmt = $conn->prepare("SELECT `email` FROM `Project3` WHERE `email` = ?;"); // Execute query
        $stmt->bind_param("s", $_POST['email']); // Add variables to statement
        $stmt->execute(); // Execute statement
        $result = $stmt->get_result(); // Get result
        $row = mysqli_fetch_array($result);
        mysqli_close($conn); // Close connection

        // Check for normal result
        if ($result->num_rows != 0) array_push($userCheck, "email");

        return $userCheck;
    }

    function set_login() {
        global $host, $username, $password, $dbname;

        // Validate form fields before continuing
        if (registration_validation()) {
            $_SESSION['loggedIn'] = false;
            unset($_SESSION['username']);
            header("Location: register.php");
            exit();
        }

        sanatize_inp("username");
        sanatize_inp("password");
        sanatize_inp("email");

        // Create entry id based on current unix time
        $key = date_timestamp_get(date_create());

        // Encrypt password
        $passHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Create connection
        $conn = new mysqli($host, $username, $password, $dbname);

        // Check connection
        if ( $conn->connect_error ) {
            die( "Connection to database failed: " . $conn->connect_error );
        }
        
        $stmt = $conn->prepare("INSERT INTO `Project3` (`id`, `username`, `password`, `email`) VALUES (?, ?, ?, ?);"); // Prepare statement
        $stmt->bind_param("isss", $key, $_POST['username'], $passHash, $_POST['email']); // Add variables to statement
        $stmt->execute(); // Execute statement
        mysqli_close($conn); // Close connection

        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $_POST['username'];
    }

    function delete_login() {
        global $host, $username, $password, $dbname;

        // Create connection
        $conn = new mysqli($host, $username, $password, $dbname);

        // Check connection
        if ( $conn->connect_error ) {
            die( "Connection to database failed: " . $conn->connect_error );
        }
        
        $stmt = $conn->prepare("DELETE FROM `Project3` WHERE `username` = ? ;"); // Prepare statement
        $stmt->bind_param("s", $_SESSION['username']); // Add variables to statement
        $stmt->execute(); // Execute statement
        mysqli_close($conn); // Close connection
    }

    function check_login() {
        global $host, $username, $password, $dbname;
        
        // Create connection
        $conn = new mysqli($host, $username, $password, $dbname);

        // Check connection
        if ( $conn->connect_error ) {
            die( "Connection to database failed: " . $conn->connect_error );
        }

        sanatize_inp("username");
        sanatize_inp("password");
        
        $stmt = $conn->prepare("SELECT `password` from `Project3` WHERE `username` = ?"); // Prepare statement
        $stmt->bind_param("s", $_POST['username']); // Add variables to statement
        $stmt->execute(); // Execute statement
        $result = $stmt->get_result(); // Get result
        $row = mysqli_fetch_array($result);
        mysqli_close($conn); // Close connection

        // Check for normal result
        if ($result->num_rows != 1) {
            array_push($_SESSION['errs'], "❌ User not found!");
            header("Location: index.php");
            exit();
        }

        // Check password
        if (password_verify($_POST['password'], $row[0])) {
            // Set session state
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $_POST['username'];
        } else {
            array_push($_SESSION['errs'], "❌ Wrong Password!");
            header("Location: index.php");
            exit();
        }
    }

    function registration_validation() {
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

        $err = false;

        // Check for valid email
        if (!preg_match($emailReg, $_POST['email'])) {
            array_push($_SESSION['errs'],  '❌ Invalid Email');
            $err = true;
        } 

        // Check for valid username
        if (!preg_match($usernameReg, $_POST['username'])) {
            array_push($_SESSION['errs'],  '❌ Invalid Username. Usernames must be 5-20 characters and consist of letters, numbers, and underscores only.');
            $err = true;
        } 

        // Check for valid password
        if (!preg_match($passwordReg, $_POST['password'])) {
            array_push($_SESSION['errs'],  '❌ Weak Password. Passwords must be 8-32 characters long, include 1 lowercase, 1 uppercase, and 1 special character.');
            $err = true;
        } 

        // Check for marching password
        if ($_POST['confirmPassword'] != $_POST['password']) {
            array_push($_SESSION['errs'],  '❌ Passwords don\'t match!');
            $err = true;
        }

        // Check if username is already taken
        if (in_array("username", get_login())) {
            array_push($_SESSION['errs'],  '❌ Username already taken!');
            $err = true;
        }

        // Check if email is already taken
        if (in_array("email", get_login())) {
            array_push($_SESSION['errs'],  '❌ Email already registered!');
            $err = true;
        }
        
        return $err;
    }
?>
