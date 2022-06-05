<?php
$banyak_klaster = $conf[0]['CLUSTER_ELBOW'];
$db = db_connect();

$set = $db->table('tb_earthquake');

$ai = array();
$euc = array();
$bi = array();
$x = 0;

// $tes = $db->query('SELECT klaster, count(klaster) as jumlah  FROM tb_earthquake where klaster !=1 group by klaster')->getResultArray();
// dd($tes);

foreach ($gempa as $dt) {
    $y = 0;
    foreach ($gempa as $dt2) {
        $euc[$dt['idx']][$dt2['idx']] = euclidean($dt['latitude'], $dt['longitude'], $dt['depth'], $dt['strength'], $dt['dn'], $dt2['latitude'], $dt2['longitude'], $dt2['depth'], $dt2['strength'], $dt2['dn']);
        $y++;
    }
    $x++;
}
#mencari Ai
for ($i = 1; $i <= $banyak_klaster; $i++) {
    $where['klaster'] = $i;
    $data = $set->getWhere($where)->getResultArray();
    echo $jumlah = count($data);
    foreach ($data as $dt) {
        $total = 0;
        foreach ($data as $dt2) {
            $total += $euc[$dt['idx']][$dt2['idx']];
        }
        $ai[$dt['idx']] = (1 / ($jumlah - 1)) * $total;
    }
}
#mencari Bi
for ($i = 1; $i <= $banyak_klaster; $i++) {
    $where['klaster'] = $i;
    $data_b1 = $set->getWhere($where)->getResultArray();

    $where2['klaster !='] = $i;
    $data_banding = $set->getWhere($where2)->getResultArray();

    foreach ($data_b1 as $dt) {

        $total = 0;
        $min = array();
        $result = array();
        foreach ($data_banding as $db) {
            $kt = $db['klaster']; #klaster tujuan
            $total = $euc[$dt['idx']][$db['idx']];

            if (empty($result[$kt]['total'])) {
                $result[$kt]['total'] = $total;
                $result[$kt]['count'] = 1;
            } else {
                $result[$kt]['total'] = $result[$kt]['total'] + $total;
                $result[$kt]['count'] = $result[$kt]['count'] + 1;
            }
        }
        //dd($result);
        foreach ($result as $rs) {
            $min[] = $rs['total'] / $rs['count'];
        }
        sort($min);
        $bi[$dt['idx']] = $min[0];
        //dd($min);
    }
}
#mencari nilai silhoute
foreach ($gempa as $g) {
    $i = $g['idx'];
    if ($bi[$i] > $ai[$i]) {
        $penyebut = $bi[$i];
    } else {
        $penyebut = $ai[$i];
    }
    $silhoute[$i]['idx'] = $i;
    $silhoute[$i]['bi'] = $bi[$i];
    $silhoute[$i]['ai'] = $ai[$i];
    $silhoute[$i]['sc'] = ($bi[$i] - $ai[$i]) / $penyebut;
}
$set->updateBatch($silhoute, 'idx');
//$silhoute_all = $set->select('avg(sc) as total,klaster')->groupBy("klaster")->get()->getResultArray();
#dd($silhoute_all);
