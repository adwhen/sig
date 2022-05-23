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
                    <td><?= $g['NUMB'] ?></td>
                    <td><?= $g['latitude'] ?></td>
                    <td><?= $g['longitude'] ?></td>
                    <td><?= $g['depth'] ?></td>
                    <td><?= $g['strength'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php
    $centroid = 5;

    $SSE = array();
    $SSE_MIN = array();

    $next_SSE = null;
    $nilai_centroid_min = null;

    $queue = [5];
    $y = 0;

    $sse_total = array();
    foreach ($gempa as $g) {
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

            $total_SSE = $total_SSE + $SSE[$x][$y];


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

            echo $SSE[$x][$y];
            $x++;
            echo "<BR>";
        }
        echo "total SSE = " . $total_SSE;
        echo "<br>next centroid : " . $next_SSE . "<br>";
        echo "-------------------------------------<br>";
        $centroid = $next_SSE;
        array_push($queue, $centroid);
        $sse_total[$y] = $total_SSE;

        $y++;
    }


    ?>

</body>

</html>