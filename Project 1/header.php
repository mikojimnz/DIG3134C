<header>
    <h1>Project 1 – <?php echo $title;?> </h1>
    <hr>
    <h2>Miko Jimenez</h2>
</header>
<nav>
    <a class="<?php if ($title == 'Home') echo 'active'; ?>" href="./index.php">Home</a>
    <a class="<?php if ($title == 'Contact') echo 'active'; ?>" href="./contact.php">Contact</a>
</nav>
