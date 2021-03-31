<?php
    // Define Database Login
    $host = "107.180.12.113";
    $username = "demoUser";
    $password = "demoPass1234$";
    $dbname = "DIG3134";

    if ($_SERVER["REQUEST_METHOD"] != "POST")  die("Invalid Method");

    switch($_POST) {
        case(array_key_exists('login', $_POST)):
            checkLogin();
            // header("Location: index.php"); 
            break;
        case(array_key_exists('register', $_POST)):
            setLogin();
            // header("Location: index.php"); 
            break;
        case(array_key_exists('delete', $_POST)):
            deleteLogin();
            // header("Location: index.php"); 
            break;
        default:
            die("Invalid request made");
            break;
        }

    function getLogin() {
        global $host, $username, $password, $dbname;

        // Create connection
        $conn = new mysqli($host, $username, $password, $dbname);

        // Check connection
        if ( $conn->connect_error ) {
            die( "Connection to database failed: " . $conn->connect_error );
        }
        
        $sql = "INSERT INTO `Users`;";
        $result = $conn->query($sql); // Execute query

        // Close connection
        mysqli_close($conn);

        return true;
    }

    function setLogin() {
        global $host, $username, $password, $dbname;

        // Encrypt password
        $passHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Create connection
        $conn = new mysqli($host, $username, $password, $dbname);

        // Check connection
        if ( $conn->connect_error ) {
            die( "Connection to database failed: " . $conn->connect_error );
        }
        
        $sql = "INSERT INTO `Project3` (`id`, `username`, `password`, `email`) VALUES (?, ?, ?, ?);";
        $stmt = $conn->prepare($sql); // Prepare statement
        $stmt->bind_param("isss", date_timestamp_get(date_create()), $_POST['username'], $passHash, $_POST['email']); // Add variables to statement
        $stmt->execute(); // Execute statement

        // Close connection
        mysqli_close($conn);

        return true;
    }

    function deleteLogin() {
        global $host, $username, $password, $dbname;

        // Create connection
        $conn = new mysqli($host, $username, $password, $dbname);

        // Check connection
        if ( $conn->connect_error ) {
            die( "Connection to database failed: " . $conn->connect_error );
        }
        
        $sql = "DELETE FROM `Project3` WHERE `username` = ? ;";
        $stmt = $conn->prepare($sql); // Prepare statement
        $stmt->bind_param("s", $_POST['username']); // Add variables to statement
        $stmt->execute(); // Execute statement

        // Close connection
        mysqli_close($conn);

        return true;
    }

    function checkLogin() {
        global $host, $username, $password, $dbname;
        
        // Create connection
        $conn = new mysqli($host, $username, $password, $dbname);

        // Check connection
        if ( $conn->connect_error ) {
            die( "Connection to database failed: " . $conn->connect_error );
        }
        
        $sql = "SELECT `password` from `Project3` WHERE `username` = ?";
        $stmt = $conn->prepare($sql); // Prepare statement
        $stmt->bind_param("s", $_POST['username']); // Add variables to statement
        $stmt->execute(); // Execute statement
        $result = $stmt->get_result(); // Get result
        $row = mysqli_fetch_array($result);

        echo($result->num_rows);
        echo($row);

        // if ($result->num_rows != 1) {
        //     $_SESSION['err_msg'] = "Unexpexted Error! Query return more than 1 result.";
        //     header("Location: index.php");
        // }

        

        // if (password_verify($_POST['password'], $result)) {
        //     // Set session state
        //     $_SESSION['loggedin'] = true;
        // }

        // Close connection
        mysqli_close($conn);

        return true;
    }
?>
