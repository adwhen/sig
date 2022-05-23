<html>

<body>
    <table border="1">
        <thead>
            <th>Objek</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Depth</th>
            <th>Strength</th>
        </thead>
        <tbody>
            <?php foreach ($gempa as $g) : ?>
                <tr>

                    <td><?= $g['latitude'] ?></td>
                    <td><?= $g['longitude'] ?></td>
                    <td><?= $g['depth'] ?></td>
                    <td><?= $g['strength'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php

    $SSE = array();
    $SSE_MIN = array();

    $next_SSE = null;
    // $nilai_centroid_min = null;
    $centroid = 5;
    $queue = [5];
    $y = 0;
    $banyak_perulangan = 8;
    $sse_total = array();

    for ($y = 0; $y < $banyak_perulangan; $y++) {
        $nilai_centroid_min = null;
        $total_SSE = 0;
        $x = 0;
        $next_c;
        foreach ($gempa as $g) {

            if (in_array($x, $queue)) {
                $SSE[$x][$y] = 0;
                echo "match found" . $x;
            } else {
                $SSE[$x][$y] = pow(abs($gempa[$x]['latitude'] - $gempa[$centroid]['latitude']), 2) + pow(abs($gempa[$x]['longitude'] - $gempa[$centroid]['longitude']), 2) + pow(abs($gempa[$x]['depth'] - $gempa[$centroid]['depth']), 2) + pow(abs($gempa[$x]['strength'] - $gempa[$centroid]['strength']), 2);
            }
            #NILAI MINIMUM 
            if (empty($SSE_MIN[$x])) {
                $SSE_MIN[$x] = $SSE[$x][$y];
            } elseif ($SSE_MIN[$x] > $SSE[$x][$y]) {
                $SSE_MIN[$x] = $SSE[$x][$y];
            }
            #CENTROID SELANJUTNYA
            if (empty($nilai_centroid_min)) {
                $next_SSE = $x;
                $nilai_centroid_min = $SSE[$x][$y];
            } elseif (in_array($x, $queue)) {
            } elseif ($nilai_centroid_min > $SSE[$x][$y]) {
                $next_SSE = $x;
                $nilai_centroid_min = $SSE[$x][$y];
            }
            $total_SSE = $total_SSE + $SSE_MIN[$x];
            echo $SSE_MIN[$x];
            $x++;
            echo "<BR>";
        }
        echo "total SSE = " . $total_SSE;
        echo "<br>next centroid : " . $next_SSE . "<br>";
        echo "-------------------------------------<br>";
        $centroid = $next_SSE;
        array_push($queue, $centroid);
        $sse_total[$y] = $total_SSE;
    }

    $z = 0;
    $cluster = null;
    $selisih;
    for ($i = 0; $i < $banyak_perulangan; $i++) {
        if ($i == 0) {
            continue;
        }
        $selisih = abs($sse_total[$i] - $sse_total[$i - 1]);

        if (empty($cluster)) {
            $cluster = $i + 1;
            $n_selisih = $selisih;
        } elseif ($n_selisih < $selisih) {
            $n_selisih = $selisih;
            $cluster = $i + 1;
        }
    }
    echo "final cluster =" . $cluster . " || dengan selisih = " . $n_selisih;
    dd($sse_total);

    ?>

</body>

</html>