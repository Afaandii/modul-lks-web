<?php
$factor = isset($_GET['factor']) ? intval($_GET['factor']) : 1;

$numbers = range(1, 40);

foreach ($numbers as $index => $value) {
  if ($index % $factor == 0) {
    $numbers[$index] = "$value*";
  }
}

echo "<pre>";
print_r($numbers);
echo "</pre>";
