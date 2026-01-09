<?php
echo "Welcome to PHP! <br>";

// Variabel
$npm = "2311104029";
$namaMahasiswa = "Noven";

echo "NPM : " . $npm . "<br>";
echo "Nama : " . $namaMahasiswa . "<br>";

// Konstanta
define("NAMA_MHS", "Ghaza Zidane");
define("NPM_MHS", "2301199988");

echo "Nama : " . NAMA_MHS . "<br>";
echo "NPM : " . NPM_MHS . "<br>";

// IF - ELSE
$nilai = 72;

if ($nilai >= 60) {
    echo "Nilai Anda $nilai. Status: Lulus <br>";
} else {
    echo "Nilai Anda $nilai. Status: Tidak Lulus <br>";
}

// Switch Case
$nilai = 72;

switch (true) {
    case ($nilai >= 50 && $nilai < 60):
        echo "Grade C";
        break;
    case ($nilai >= 60 && $nilai < 70):
        echo "Grade B-";
        break;
    case ($nilai >= 70 && $nilai < 80):
        echo "Grade B";
        break;
    case ($nilai >= 80 && $nilai < 90):
        echo "Grade A-";
        break;
    case ($nilai >= 90 && $nilai <= 100):
        echo "Grade A";
        break;
    default:
        echo "Nilai tidak valid";
}

// Looping
echo "<br><br>Loop for:<br>";
for ($i = 1; $i <= 5; $i++) {
    echo "Angka ke-$i <br>";
}

echo "<br>Loop while:<br>";
$i = 2;
while ($i <= 20) {
    echo $i . " ";
    $i += 2;
}

echo "<br><br>Loop do-while:<br>";
$i = 5;
do {
    echo $i . " ";
    $i += 5;
} while ($i <= 50);

// Function tanpa parameter
function tampilGanjil() {
    for ($i = 1; $i <= 50; $i++) {
        if ($i % 2 != 0) {
            echo "$i ";
        }
    }
}

echo "<br><br>";
tampilGanjil();

// Function dengan parameter
function tampilKelipatan($awal, $akhir) {
    for ($i = $awal; $i <= $akhir; $i++) {
        if ($i % 3 == 0) {
            echo "$i ";
        }
    }
}

echo "<br><br>";
tampilKelipatan(10, 60);

// Function dengan return
function hitungPersegiPanjang($panjang, $lebar) {
    return $panjang * $lebar;
}

echo "<br><br>Luas Persegi Panjang: " . hitungPersegiPanjang(8, 12);

// Array indeks
$alatElektronik = ["Laptop", "Smartphone", "Tablet", "Smartwatch"];
echo "<br>" . $alatElektronik[1];
echo "<br>" . $alatElektronik[3];

// Array asosiatif
$dataKota = [
    "Andi" => "Jakarta",
    "Bima" => "Surabaya",
    "Citra" => "Yogyakarta",
    "Dina" => "Makassar"
];

echo "<br>" . $dataKota["Citra"];
echo "<br>" . $dataKota["Dina"];
?>
