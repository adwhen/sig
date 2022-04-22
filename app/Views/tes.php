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
                    <td><?= $g['idx'] ?></td>
                    <td><?= $g['latitude'] ?></td>
                    <td><?= $g['longitude'] ?></td>
                    <td><?= $g['depth'] ?></td>
                    <td><?= $g['strength'] ?></td>
                </tr>
            <?php endforeach; ?>
            <?php

            $centroid = 5;
            $SSE = array();

            $next_SSE;
            $queue = [];
            foreach ($gempa as $g) {
                $total_SSE = 0;
                $x = 0;
                $next_c;
                foreach ($gempa as $g) {

                    if (in_array($x, $queue)) {
                        $SSE[$x] = 0;
                        //echo "match found";
                    } else {
                        $SSE[$x] = pow(abs($gempa[$x]['latitude'] - $gempa[$centroid]['latitude']), 2) + pow(abs($gempa[$x]['longitude'] - $gempa[$centroid]['longitude']), 2) + pow(abs($gempa[$x]['depth'] - $gempa[$centroid]['depth']), 2) + pow(abs($gempa[$x]['strength'] - $gempa[$centroid]['strength']), 2);

                        if (empty($next_c)) {
                            $next_SSE = $SSE[$x];
                            $next_c = $x;
                        } elseif ($centroid == $x) {
                        } elseif ($next_SSE > $SSE[$x]) {
                            $next_SSE = $SSE[$x];
                            $next_c = $x;
                        }
                    }
                    echo $SSE[$x];
                    $total_SSE = $total_SSE + $SSE[$x];
                    echo "<br>";
                    $x++;
                }
                echo "----------------------<br>";

                echo "total = " . $total_SSE . "<br>";
                array_push($queue, $centroid);
                $centroid = $next_c;
                echo "next centroid : " . $centroid . "<br>";
            }
            dd($queue);



            ?>
        </tbody>
    </table>
</body>

</html>