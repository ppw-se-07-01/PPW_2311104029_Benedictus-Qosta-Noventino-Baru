<?php
$total = 750000;

if ($total >= 1000000) {
    $diskon = 0.30;
} elseif ($total >= 500000) {
    $diskon = 0.20;
} elseif ($total >= 100000) {
    $diskon = 0.10;
} else {
    $diskon = 0;
}

$jumlah_diskon = $total * $diskon;
$total_bayar   = $total - $jumlah_diskon;

echo "Total Belanja: Rp $total <br>";
echo "Diskon: Rp $jumlah_diskon <br>";
echo "Total Bayar: Rp $total_bayar <br>";
?>
