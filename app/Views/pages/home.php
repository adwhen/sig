<?= $this->extend('layout/template') ?>
<!-- Page Wrapper -->
<?= $this->section('content') ?> <div class="container-fluid">



    <!-- DataTales Example -->
    <form action="/" method="GET">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-3">
                        <input class="form-control" type="date" name="AWAL">
                    </div>
                    <div class="col-md-1">
                        <center>
                            <h2>-</h2>
                        </center>

                    </div>
                    <div class="col-md-3"> <input class="form-control" type="date" name="AKHIR"></div>
                    <div class="col-md-3"> <button class="btn btn-primary" type="submit">Search</button></div>
                </div>

            </div>
    </form>
    <div class="card-body">
        <div id="map" style="height: 80vh;"></div>
    </div>
</div>

</div>
<!-- /.container-fluid -->
<?= $this->endSection('content') ?>
<?= $this->section('script') ?>
<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAL3wnR5RPZiMKWjzoitiujIowGzdzzvU&callback=initMap">
</script>
<script>
    let map;

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: -3.810444504458368,
                lng: 102.28569599925066
            },
            zoom: 10,
            mapTypeId: 'satellite',
        });
        var iconBase = 'http://maps.google.com/mapfiles/kml/paddle/';
        <?php foreach ($gempa as $g) : ?>
            new google.maps.Marker({
                position: {
                    lat: <?= $g['latitude'] ?>,
                    lng: <?= $g['longitude'] ?>
                },
                map,
                icon: iconBase + '<?= $g['klaster'] ?>.png'

            });
        <?php endforeach; ?>
    }

    window.initMap = initMap;
</script>

<?= $this->endSection('script') ?>