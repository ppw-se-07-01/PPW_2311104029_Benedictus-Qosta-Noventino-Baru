<?php
$celcius = 30;
$fahrenheit = 86;

// Celcius ke Fahrenheit
$c_to_f = ($celcius * 9/5) + 32;

// Fahrenheit ke Celcius
$f_to_c = ($fahrenheit - 32) * 5/9;

// Celcius ke Kelvin
$c_to_k = $celcius + 273.15;

echo "C → F : " . number_format($c_to_f, 2) . "<br>";
echo "F → C : " . number_format($f_to_c, 2) . "<br>";
echo "C → K : " . number_format($c_to_k, 2) . "<br>";
?>
