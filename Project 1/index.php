<!doctype html>

<html lang="en">

<head>
    <meta charset="utf-8">

    <title>Project 1 - Home</title>
    <meta name="description" content="Project 1 - Home">
    <meta name="author" content="Miko Jimenez">

    <link rel="stylesheet" href="css/styles.css">

</head>

<body>
    <div class="content">
        <?php
            $title = 'Home';
            include 'header.php';
        ?>
        <div class="body">
            <?php 
                foreach(file("paragraphs.txt") as $line) {
                    echo "<p>$line</p>";
                }
            ?>
        </div>
    </div>
</body>

</html>
