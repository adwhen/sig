<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <center>
        <table cellspacing="0" border="1">
            <thead>
                <tr>
                    <th>Nomor</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Depth</th>
                    <th>Strenght</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php $x = 0;
                foreach ($gempa as $g) : ?>
                    <tr>
                        <td><?= $x + 1 ?></td>
                        <td><?= $g['latitude'] ?></td>
                        <td><?= $g['longitude'] ?></td>
                        <td><?= $g['depth'] ?></td>
                        <td><?= $g['strength'] ?></td>
                        <td><?= $g['created_at'] ?></td>
                    </tr>
                <?php $x++;
                endforeach; ?>
            </tbody>
        </table>
    </center>
</body>

</html>