<?php
function Node_M($arr, $jumlah_klaster, $klaster)
{


    if (in_array($gabungstring, $arr)) {
        Node_M($arr, $jumlah_klaster, $klaster);
    } else {
        return $gabungstring;
    }
}

$numlocal = 1;
$maxneighbor = 2;
$klaster = 3;
$jumlah_klaster = 10;
$arr = array();

for ($i = 0; $i < $numlocal; $i++) {
    #cari secara acak node terpilih  (Node M)
    echo $hasil = Node_M($arr, $jumlah_klaster, $klaster);
    array_push($arr, $hasil);

    dd($arr);
}
