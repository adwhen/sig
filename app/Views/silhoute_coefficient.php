<?php
$banyak_klaster = $conf[0]['CLUSTER_ELBOW'];
$db = db_connect();
$ai = array();
$diff_cluster = array();
for ($i = 0; $i < $banyak_klaster; $i++) {
    $klaster = $i + 1;
    $where['klaster'] = $i + 1;
    $data = $db->table('tb_earthquake')->getWhere($where)->getResultArray();
    #hitung jarak
    $jumlah_data_perklaster = count($data);

    $y = 0;
    foreach ($data as $dt) {
        $x = 0;
        $total = 0;
        foreach ($data as $dt2) {
            echo $eulidean[$klaster][$x][$y] = sqrt(pow($dt['latitude'] - $dt2['latitude'], 2) + pow($dt['longitude'] - $dt2['longitude'], 2) + pow($dt['strength'] - $dt2['strength'], 2) + pow($dt['depth'] - $dt2['depth'], 2));
            echo "||";
            $total = $total + $eulidean[$klaster][$x][$y];
            $x++;
        }
        #menghitung nilai a[i]

        echo "<br>";
        $ai[$klaster][] = (1 / ($jumlah_data_perklaster - 1)) * $total;
        echo "<br>";
        $y++;
    }
}
echo "----";
#menghitung jarak pada cluster yang berbeda
for ($a = 1; $a <= $banyak_klaster; $a++) {
    $where['klaster'] = $a;
    $data = $db->table('tb_earthquake')->getWhere($where)->getResultArray();

    for ($b = $a + 1; $b <= $banyak_klaster; $b++) {
        $where2['klaster'] = $b;
        $data2 = $db->table('tb_earthquake')->getWhere($where2)->getResultArray();

        $x = 0;
        foreach ($data2 as $dt) {
            $y = 0;
            $total = 0;
            foreach ($data as $dt2) {
                $eulidean_berbeda[$a][$b][$x][$y] = sqrt(pow($dt['latitude'] - $dt2['latitude'], 2) + pow($dt['longitude'] - $dt2['longitude'], 2) + pow($dt['strength'] - $dt2['strength'], 2) + pow($dt['depth'] - $dt2['depth'], 2));
                $total +=  $eulidean_berbeda[$a][$b][$x][$y];
                $y++;
            }
            $eulidean_berbeda[$a][$b][$x]['mean'] = $total / $y;
            $mean[$a][$b][] = $total / $y;
            $x++;
        }
    }
}

for ($i = 1; $i <= $banyak_klaster; $i++) {
    $where['klaster'] = $i;
    $data = $db->table('tb_earthquake')->getWhere($where)->getResultArray();
    $x = 0;

    //echo $ai[$i][$x];
    foreach ($data as $dt) {
        if ($mean[$i][$i + 1][$x] > $ai[$i][$x]) {
            $max = $mean[$i][$i + 1][$x];
        } else {
            $max = $ai[$i][$x];
        }
        echo $hasil[$i][] = ($mean[$i][$i + 1][$x] - $ai[$i][$x]) / $max;

        echo "<br>";
        $x++;
    }
}
