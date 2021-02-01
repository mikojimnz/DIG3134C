<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">

    <title>Project 1 - Contact</title>
    <meta name="description" content="Project 1 - Contact">
    <meta name="author" content="Miko Jimenez">

    <link rel="stylesheet" href="css/styles.css">

</head>

<body>
    <div class="content">
        <?php
            // Include header template
            $title = 'Contact';
            include 'header.php';
        ?>
        <div class="body">
            <!-- Contact Form -->
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="contact">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="john@appleseed.com" required>
                <label for="comment">Leave A Message:</label>
                <textarea id="message" name="message" placeholder="Hello!"></textarea>
                <button type="submit">Submit</button>
            </form>
        </div>
        <div>
            <?php
                // Form Results Output
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $email = $_POST['email'];
                    
                    if (!empty($email)) {
                        echo "<p>Your email is: {$email}!</p>";
                    }
                    
                    // Check if message is empty
                    if (empty($_POST['message'])) {
                        $msg = "<i>None</i>";
                    } else {
                        $msg = $_POST['message'];
                    }
                    
                    echo "<p>Your comment was: \"{$msg}\"</p>";
                }
            ?>
        </div>
    </div>
</body>

</html>
