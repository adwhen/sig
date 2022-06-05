<?= $this->extend('layout/template') ?>
<!-- Page Wrapper -->
<?= $this->section('content') ?> <div class="container-fluid">

    <style>
        #legend {
            font-family: Arial, sans-serif;
            background: #fff;
            padding: 10px;
            margin: 10px;
            border: 3px solid #000;
        }

        #legend h3 {
            margin-top: 0;
        }

        #legend img {
            vertical-align: middle;
        }
    </style>

    <!-- DataTales Example -->
    <form action="/" method="GET" action="<?= base_url(); ?>">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-3">
                        <input class="form-control" type="date" name="AWAL" value="<?= $awal ?>">
                    </div>
                    <div class="col-md-1">
                        <center>
                            <h2>-</h2>
                        </center>

                    </div>
                    <div class="col-md-3"> <input class="form-control" type="date" name="AKHIR" value="<?= $akhir ?>"></div>
                    <div class="col-md-2">
                        <select class="form-control" name="klaster" id="klaster">
                            <option value="">Klaster</option>
                            <option value="1" <?php if ($klaster == 1) {
                                                    echo "selected";
                                                } ?>>1</option>
                            <option value="2" <?php if ($klaster == 2) {
                                                    echo "selected";
                                                } ?>>2</option>
                            <option value="3" <?php if ($klaster == 3) {
                                                    echo "selected";
                                                } ?>>3</option>
                            <option value="4" <?php if ($klaster == 4) {
                                                    echo "selected";
                                                } ?>>4</option>
                            <option value="5" <?php if ($klaster == 5) {
                                                    echo "selected";
                                                } ?>>5</option>
                            <option value="6" <?php if ($klaster == 6) {
                                                    echo "selected";
                                                } ?>>6</option>
                        </select>
                    </div>
                    <div class="col-md-1"> <button class="btn btn-primary" type="submit">Search</button></div>
                </div>

            </div>
    </form>
    <div class="card-body">
        <div id="map" style="height: 80vh;"></div>
        <div id="legend">
            <h3>Legend</h3>
        </div>
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


        const icons = {
            klaster1: {
                name: "Klaster 1",
                icon: iconBase + "orange-blank.png",
            },
            klaster2: {
                name: "Klaster 2",
                icon: iconBase + "blu-blank.png",
            },
            klaster3: {
                name: "Klaster 3",
                icon: iconBase + "grn-blank.png",
            },
            klaster4: {
                name: "Klaster 4",
                icon: iconBase + "ltblu-blank.png",
            },
            klaster5: {
                name: "Klaster 5",
                icon: iconBase + "pink-blank.png",
            },
            klaster6: {
                name: "Klaster 6",
                icon: iconBase + "purple-blank.png",
            },
        };

        const features = [
            <?php foreach ($gempa as $g) : ?> {
                    position: new google.maps.LatLng(<?= $g['latitude'] ?>, <?= $g['longitude'] ?>),
                    <?php if ($g['klaster'] == 1) { ?>
                        type: "klaster1",
                    <?php } elseif ($g['klaster'] == 2) { ?>
                        type: "klaster2",
                    <?php } elseif ($g['klaster'] == 3) { ?>
                        type: "klaster3",
                    <?php } elseif ($g['klaster'] == 4) { ?>
                        type: "klaster4",
                    <?php } elseif ($g['klaster'] == 5) { ?>
                        type: "klaster5",
                    <?php } elseif ($g['klaster'] == 6) { ?>
                        type: "klaster6",
                    <?php } ?>
                },
            <?php endforeach; ?>
        ];

        features.forEach((feature) => {
            new google.maps.Marker({
                position: feature.position,
                icon: icons[feature.type].icon,
                map: map,
            });
        });




        const legend = document.getElementById("legend");
        for (const key in icons) {
            const type = icons[key];
            const name = type.name;
            const icon = type.icon;
            const div = document.createElement("div");

            div.innerHTML = '<img src="' + icon + '"> ' + name;
            legend.appendChild(div);
        }

        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);
    }

    window.initMap = initMap;
</script>

<?= $this->endSection('script') ?>