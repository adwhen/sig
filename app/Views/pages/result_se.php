<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Silhoute - Coefficient</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>i</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Kedalaman (KM)</th>
                            <th>Kekuatan (SR)</th>
                            <th>Tanggal</th>
                            <th>a(i)</th>
                            <th>b(i)</th>
                            <th>s(i)</th>
                            <th>Klaster</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $x = 0;
                        $klaster = array();
                        $penyebut = array();
                        foreach ($gempa as $g) : ?>
                            <tr>
                                <td><?= $x + 1 ?></td>
                                <td><?= $g['latitude'] ?></td>
                                <td><?= $g['longitude'] ?></td>
                                <td><?= $g['depth'] ?></td>
                                <td><?= $g['strength'] ?></td>
                                <td><?= $g['created_at'] ?></td>
                                <td><?= $g['ai'] ?></td>
                                <td><?= $g['bi'] ?></td>
                                <td><?= $g['sc'] ?></td>
                                <td><?= $g['klaster'] ?></td>
                                <?php
                                $k = $g['klaster'];
                                #valdiasi perklaster
                                if (empty($klaster[$k])) {
                                    $klaster[$k] = $g['sc'];
                                    $penyebut[$k] = 1;
                                } else {
                                    $klaster[$k] = $klaster[$k] + $g['sc'];
                                    $penyebut[$k] = $penyebut[$k] + 1;
                                }
                                ?>
                            </tr>
                        <?php $x++;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <h6>Validasi Per Klaster</h6>
            <?php $x = 1;
            $total = 0;
            foreach ($klaster as $ks) : ?>
                Silhoute Coefficient Klaster <?= $x ?> : <?= $klaster[$x] / $penyebut[$x] ?>
                <br>

            <?php
                $total = $total +  ($klaster[$x] / $penyebut[$x]);
                $x++;
            endforeach; ?>
            <br>
            <h6>Validasi Global</h6>
            Silhoute Coefficient Global : <?php echo $total / ($x - 1); ?>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <h6>Grafik</h6>
            <div>
                <canvas id="myChart" width="400" height="100"></canvas>
            </div>
        </div>
    </div>



</div>

<!-- /.container-fluid -->

<?= $this->endSection('content'); ?>
<?= $this->Section('script'); ?>
<script src="<?= base_url() ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url() ?>/js/demo/datatables-demo.js"></script>


<script>
    const labels = [
        <?php $x = 1;
        foreach ($klaster as $k) { ?> 'SE <?= $x++ ?>', <?php } ?>
    ];

    const data = {
        labels: labels,
        datasets: [{
            label: 'dataset Silhoute Coefficient',
            backgroundColor: '#4e73df',
            borderColor: '#4e73df',
            data: [<?php $x = 1;
                    foreach ($klaster as $k) { ?> <?= $klaster[$x] / $penyebut[$x] ?>, <?php $x++;
                                                                                    } ?>],
        }]
    };

    const config = {
        type: 'line',
        data: data,
        options: {}
    };
</script>
<script>
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>

<?= $this->endSection('script'); ?>