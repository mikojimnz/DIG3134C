<table>
<?php

// Generate seed from current UNIX time
$seed = date_timestamp_get(date_create());

// Convert int to array
$nums  = array_map('intval', str_split($seed));

echo("UNIX Seed: " . $seed);

// Generate table
for($i = 1; $i <= 50 ; $i++) {
    echo ("<tr>");

    for($j = 1; $j <= 50; $j++) {

            // Calculate colors
            $red = (10 * $i * $j * ($nums[7] % 2 == 0 ? $seed : $nums[7])) % 255;
            $green = (10 * $i * $j * ($nums[8] % 2 == 0 ? $seed : $nums[8])) % 255;
            $blue = (10 * $i * $j * ($nums[9] % 2 == 0 ? $seed : $nums[9])) % 255;

            echo ("<td style=\"background-color:rgb(". $red . ", " . $green. ", " . $blue . ");\"></td>");
    }

    echo ("</tr>");
}

?>
</table>