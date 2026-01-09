<?php
$nilai = [75, 89, 65, 90, 85, 70, 98, 65, 69, 70, 12];

// Nilai tertinggi
$max = max($nilai);

// Nilai terendah
$min = min($nilai);

// Rata rata
$avg = array_sum($nilai) / count($nilai);

// Jumlah lulus
$lulus = 0;
foreach ($nilai as $n) {
    if ($n >= 70) $lulus++;
}

// Urutkan dari terbesar ke terkecil
rsort($nilai);

echo "Nilai tertinggi: $max <br>";
echo "Nilai terendah: $min <br>";
echo "Rata-rata: " . number_format($avg, 2) . "<br>";
echo "Jumlah lulus: $lulus <br>";

echo "<br>Nilai urut (desc): <br>";
foreach ($nilai as $n) {
    echo $n . " ";
}
?>
