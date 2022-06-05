<?php
$numlocal = 1;
$maxneighbor = 2;
$klaster = $conf[0]['CLUSTER_ELBOW'];
$jumlah_klaster = count($gempa);
$arr = array();
$cek_nomor = array();
$node_m = array();
$final_klaster = array();
#cari secara acak node terpilih  (Node M)
for ($i = 0; $i < $klaster; $i++) {
    $rand[$i] = mt_rand(0, $jumlah_klaster - 1);
    while (in_array($rand[$i], $cek_nomor)) {
        $rand[$i] = mt_rand(1, $jumlah_klaster - 1);
    }
    $cek_nomor[$i] = $rand[$i];
}
sort($rand);
$gabungstring = implode("-", $rand);

array_push($arr, $gabungstring);
$node_M = $gabungstring;

#hitung jarak NODE M
// $node_M = "1-4-7";
$explode = explode("-", $node_M);
print_r($explode);
echo "<br>";
$min_cost_M = 0;
for ($j = 0; $j < $jumlah_klaster; $j++) {
    for ($i = 0; $i < $klaster; $i++) {
        $nilai = $explode[$i];
        echo $k_node_M[$i] = sqrt(pow(($gempa[$j]['latitude'] - $gempa[$nilai]['latitude']), 2) + pow(($gempa[$j]['longitude'] - $gempa[$nilai]['longitude']), 2) + pow(($gempa[$j]['depth'] - $gempa[$nilai]['depth']), 2) + pow(($gempa[$j]['strength'] - $gempa[$nilai]['strength']), 2) + pow(($gempa[$j]['dn'] - $gempa[$nilai]['dn']), 2));

        echo "-";
    }
    sort($k_node_M);
    echo "|||||||" . $min_cost_M = $min_cost_M + $k_node_M[0];
    echo "<br>";
}

for ($i = 0; $i < $numlocal; $i++) {

    // foreach ($gempa as $key) {
    //     #caro secara acak node tetangga(node N)
    //     for ($i = 0; $i < $klaster; $i++) {
    //         $rand[$i] = mt_rand(0, $jumlah_klaster - 1);
    //         while (in_array($rand[$i], $cek_nomor)) {
    //             $rand[$i] = mt_rand(1, $jumlah_klaster - 1);
    //         }
    //         $cek_nomor[$i] = $rand[$i];
    //     }
    //     sort($rand);
    //     $gabungstring = implode("-", $rand);

    //     array_push($arr, $gabungstring);
    //     $node_N = $gabungstring;
    //     #hitung jarak NODE N
    //     #$node_N = "0-4-7";
    //     $explode = explode("-", $node_N);
    //     print_r($explode);
    //     echo "<br>";
    //     $min_cost_N = 0;
    //     for ($j = 0; $j < $jumlah_klaster; $j++) {
    //         for ($i = 0; $i < $klaster; $i++) {
    //             $nilai = $explode[$i];
    //             echo $k_node_N[$i] = sqrt(pow(($gempa[$j]['latitude'] - $gempa[$nilai]['latitude']), 2) + pow(($gempa[$j]['longitude'] - $gempa[$nilai]['longitude']), 2) + pow(($gempa[$j]['depth'] - $gempa[$nilai]['depth']), 2) + pow(($gempa[$j]['strength'] - $gempa[$nilai]['strength']), 2));

    //             echo "-";
    //         }
    //         sort($k_node_N);
    //         echo "|||||||" . $min_cost_N = $min_cost_N + $k_node_N[0];
    //         echo "<br>";
    //     }
    //     if ($min_cost_N < $min_cost_M) {
    //         $min_cost_M = $min_cost_N;
    //         $node_M = $node_N;
    //     }
    // }
    for ($z = 0; $z < $maxneighbor; $z++) {
        #caro secara acak node tetangga(node N)
        for ($i = 0; $i < $klaster; $i++) {
            $rand[$i] = mt_rand(0, $jumlah_klaster - 1);
            while (in_array($rand[$i], $cek_nomor)) {
                $rand[$i] = mt_rand(1, $jumlah_klaster - 1);
            }
            $cek_nomor[$i] = $rand[$i];
        }
        sort($rand);
        $gabungstring = implode("-", $rand);

        array_push($arr, $gabungstring);
        $node_N = $gabungstring;
        #hitung jarak NODE N
        // $node_N = "0-4-7";
        // if ($z == 1) {
        //     $node_N = "0-4-5";
        // }
        $explode = explode("-", $node_N);
        print_r($explode);
        echo "<br>";
        $min_cost_N = 0;
        for ($j = 0; $j < $jumlah_klaster; $j++) {
            for ($i = 0; $i < $klaster; $i++) {
                $nilai = $explode[$i];
                echo $k_node_N[$i] = sqrt(pow(($gempa[$j]['latitude'] - $gempa[$nilai]['latitude']), 2) + pow(($gempa[$j]['longitude'] - $gempa[$nilai]['longitude']), 2) + pow(($gempa[$j]['depth'] - $gempa[$nilai]['depth']), 2) + pow(($gempa[$j]['strength'] - $gempa[$nilai]['strength']), 2) + pow(($gempa[$j]['dn'] - $gempa[$nilai]['dn']), 2));

                echo "-";
            }
            sort($k_node_N);
            echo "|||||||" . $min_cost_N = $min_cost_N + $k_node_N[0];
            echo "<br>";
        }
        if ($min_cost_N < $min_cost_M) {
            $min_cost_M = $min_cost_N;
            $node_M = $node_N;
        }
    }
}
$x = 0;

$explode = explode("-", $node_N);
print_r($explode);
$min_cost_N = 0;
for ($j = 0; $j < $jumlah_klaster; $j++) {

    for ($i = 0; $i < $klaster; $i++) {
        $nilai = $explode[$i];
        $k_node_N[$i] = sqrt(pow(($gempa[$j]['latitude'] - $gempa[$nilai]['latitude']), 2) + pow(($gempa[$j]['longitude'] - $gempa[$nilai]['longitude']), 2) + pow(($gempa[$j]['depth'] - $gempa[$nilai]['depth']), 2) + pow(($gempa[$j]['strength'] - $gempa[$nilai]['strength']), 2) + pow(($gempa[$j]['dn'] - $gempa[$nilai]['dn']), 2));

        if ($explode[$i] == $j) {
            $final = $i + 1;
            break;
        } elseif (!$i == 0) {
            if ($k_node_N[$i] <  $k_node_N_s) {
                $final = $i + 1;
            }
        } else {
            $k_node_N_s = $k_node_N[$i];
            $final = 1;
        }
    }
    $final_klaster[$j]['idx'] = $j + 1;
    $final_klaster[$j]['klaster'] = $final;
    sort($k_node_N);
    echo "|||||||" . $min_cost_N = $min_cost_N + $k_node_N[0];
    echo "<br>";
}

$db = db_connect();
$db->table('tb_earthquake')->updateBatch($final_klaster, 'idx');
