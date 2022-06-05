<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<!-- Begin Page Content -->
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
                            <th>Depth</th>
                            <th>Strenght</th>
                            <th>Date</th>
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
                    <th>Strength</th>
                    <th>Depth</th>
                    <th>Date</th>
                    <th>Count</th>
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



</div>

<!-- /.container-fluid -->

<?= $this->endSection('content'); ?>
<?= $this->Section('script'); ?>
<script src="<?= base_url() ?>/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url() ?>/js/demo/datatables-demo.js"></script>

<?= $this->endSection('script'); ?>