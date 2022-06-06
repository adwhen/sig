<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="container-fluid">



    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Clarans - Getting Cluster</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Kedalaman (KM)</th>
                            <th>Kekuatan (SR)</th>
                            <th>Tanggal</th>
                            <th>Klaster</th>
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
                                <td><?= $g['klaster'] ?></td>
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
            <h6>Range Masing-masing Variabel</h6>
            <?php
            $db = db_connect();
            $set = $db->table('tb_earthquake');
            $data = $set->select('max(depth),min(depth),max(latitude),min(latitude),max(longitude),min(longitude),max(strength),min(strength),max(created_at),min(created_at),klaster,count(idx)')->groupBy("klaster")->get()->getResultArray();
            ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <th>Klaster</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Kekuatan (KM)</th>
                    <th>Kedalaman (SR)</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                </thead>
                <tbody>
                    <?php foreach ($data as $dt) : ?>
                        <tr>
                            <td><?= $dt['klaster'] ?></td>
                            <td><?= "(" . $dt['min(latitude)'] . ") - (" . $dt['max(latitude)'] . ")" ?></td>
                            <td><?= "(" . $dt['min(longitude)'] . ") - (" . $dt['max(longitude)'] . ")" ?></td>
                            <td><?= "(" . $dt['min(strength)'] . ") - (" . $dt['max(strength)'] . ")" ?></td>
                            <td><?= "(" . $dt['min(depth)'] . ") - (" . $dt['max(depth)'] . ")" ?></td>
                            <td><?= "(" . $dt['min(created_at)'] . ") - (" . $dt['max(created_at)'] . ")" ?></td>
                            <td><?= $dt['count(idx)'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <h6>tahun</h6>
            <?php
            $grafik = $set->select('YEAR(created_at) as tahun,
            sum(if(klaster=1,1,0)) as C1,
            sum(if(klaster=2,1,0)) as C2,
            sum(if(klaster=3,1,0)) as C3,
            sum(if(klaster=4,1,0)) as C4,
            sum(if(klaster=5,1,0)) as C5,
            sum(if(klaster=6,1,0)) as C6')->groupBy("year(created_at)")->get()->getResultArray();
            ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <th>Tahun</th>
                    <th>C1</th>
                    <th>C2</th>
                    <th>C3</th>
                    <th>C4</th>
                    <th>C5</th>
                    <th>C6</th>
                </thead>
                <tbody>
                    <?php foreach ($grafik as $dt) : ?>
                        <tr>
                            <td><?= $dt['tahun'] ?></td>
                            <td><?= $dt['C1'] ?></td>
                            <td><?= $dt['C2'] ?></td>
                            <td><?= $dt['C3'] ?></td>
                            <td><?= $dt['C4'] ?></td>
                            <td><?= $dt['C5'] ?></td>
                            <td><?= $dt['C6'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <h6>Grafik</h6>
            <canvas id="myChart" width="400" height="100"></canvas>
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
    var c1 = {
        label: 'Klaster 1',
        data: [<?php foreach ($grafik as $g) {
                    echo $g['C1'] . ",";
                } ?>],
        backgroundColor: 'red',
        borderColor: 'rgba(99, 132, 0, 1)',
        yAxisID: "y-axis-gravity"
    };
    var c2 = {
        label: 'Klaster 2',
        data: [<?php foreach ($grafik as $g) {
                    echo $g['C2'] . ",";
                } ?>],
        backgroundColor: 'blue',
        borderColor: 'rgba(99, 132, 0, 1)',
        yAxisID: "y-axis-gravity"
    };
    var c3 = {
        label: 'Klaster 3',
        data: [<?php foreach ($grafik as $g) {
                    echo $g['C3'] . ",";
                } ?>],
        backgroundColor: 'green',
        borderColor: 'rgba(99, 132, 0, 1)',
        yAxisID: "y-axis-gravity"
    };
    var c4 = {
        label: 'Klaster 4',
        data: [<?php foreach ($grafik as $g) {
                    echo $g['C4'] . ",";
                } ?>],
        backgroundColor: 'yellow',
        borderColor: 'rgba(99, 132, 0, 1)',
        yAxisID: "y-axis-gravity"
    };
    var c5 = {
        label: 'Klaster 5',
        data: [<?php foreach ($grafik as $g) {
                    echo $g['C5'] . ",";
                } ?>],
        backgroundColor: 'orange',
        borderColor: 'rgba(99, 132, 0, 1)',
        yAxisID: "y-axis-gravity"
    };
    var c6 = {
        label: 'Klaster 6',
        data: [<?php foreach ($grafik as $g) {
                    echo $g['C6'] . ",";
                } ?>],
        backgroundColor: 'gray',
        borderColor: 'rgba(99, 132, 0, 1)',
        yAxisID: "y-axis-gravity"
    };

    var data = {
        labels: ["2000", "2001", "2002", "2003", "2004", "2005", "2006", "2007", "2008", "2009", "2010", "2011", "2012", "2013", "2014", "2015", "2016", "2017", "2018", "2019", "2020", "2021"],
        datasets: [c1, c2, c3, c4, c5, c6]
    };

    const ctx = document.getElementById('myChart').getContext('2d');
    const config = {
        type: 'bar',
        data: data,
        options: {
            indexAxis: 'x',
            // Elements options apply to all of the options unless overridden in a dataset
            // In this case, we are setting the border of each horizontal bar to be 2px wide
            elements: {
                bar: {
                    borderWidth: 1,
                }
            },
            responsive: true,
            plugins: {
                legend: {
                    position: 'right',
                },
                title: {
                    display: true,
                    text: 'Grafik'
                }
            }
        },
    };
    const myChart = new Chart(ctx, config);
</script>
<?= $this->endSection('script'); ?>