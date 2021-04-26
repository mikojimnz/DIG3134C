<br>
<table>
<?php

// Generate table
for($i = 0; $i < strlen($_SESSION['username']); $i++) {
    echo ("<tr>");
    $char = $_SESSION['username'][$i];

    for($j = 0; $j < strlen($_SESSION['username']); $j++) {

        $red = 0;
        $green = 0;
        $blue = 0;

        if ($j > $i) $char = " ";

        switch($char) {
            case(preg_match("/[a-z]/", $char)):
                $red = (($i + 1) * ($j + 1) + (ord($char) * 3)) % 255;
                break;
            case(preg_match("/[A-Z]/", $char)):
                $green = (($i + 1) * ($j + 1) + (ord($char) * 3)) % 255;
                break;
            default: 
                $blue = (($i + 1) + ($j + 1) + (ord($char) * 3)) % 255;
                break;
        }

        echo ("<td style=\"background-color:rgb(" . $red . ", " . $green . ", " . $blue . ");\">".$char."</td>");
    }

    echo ("</tr>");
}

for($i = strlen($_SESSION['username'])-2; $i >= 0; $i--) {
    echo ("<tr>");
    
    $char = $_SESSION['username'][$i];
    for($j = 0; $j < strlen($_SESSION['username']); $j++) {
        $red = 0;
        $green = 0;
        $blue = 0;

        if ($j > $i) $char = " ";

        switch($char) {
            case(preg_match("/[a-z]/", $char)):
                $red = (($i + 1) * ($j + 1) + (ord($char) * 3)) % 255;
                break;
            case(preg_match("/[A-Z]/", $char)):
                $green = (($i + 1) * ($j + 1) + (ord($char) * 3)) % 255;
                break;
            default: 
                $blue = (($i + 1) * ($j + 1) + (ord($char) * 3)) % 255;
                break;
        }

        echo ("<td style=\"background-color:rgb(" . $red . ", " . $green. ", " . $blue . ");\">". $char ."</td>");
}

    echo ("</tr>");
}

?>
</table>