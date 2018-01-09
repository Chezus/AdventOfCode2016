<?php
$input = file_get_contents("day09.input");
$output = "";

for($i = 0; $i < strlen($input); $i++) {
    if($input[$i] === "(") { 
        $substr = substr($input, $i, strpos($input, ")", $i) - $i + 1);
        $i += strlen($substr);
        preg_match_all("/\d+/", $substr, $args);

        $args = $args[0];
        $length = $args[0];
        $times = $args[1];

        $substr = substr($input, $i, $length);
        for($j = 0; $j < $times; $j++) {
            $output .= $substr;
        }

        $i += $length - 1;

        continue;
    } else if($input[$i] === " ") {
        continue;
    }

    $output .= $input[$i];
}

print(strlen($output));