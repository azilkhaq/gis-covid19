<?php include("layouts/head.php") ?>

<style>
    #maps {
        height: 530px;
    }
</style>

<body id="app-container" class="menu-sub-hidden show-spinner right-menu">
    <nav class="navbar fixed-top" style="justify-content: center;">
        <h1 style="font-size: 30px;">Peta Sebaran Covid 19 Indonesia Tahun 2022</h1>
    </nav>

    <main>
        <div class="container-fluid">
            <div class="row app-row">
                <div class="col-12">
                    <div id="maps"></div>
                </div>
            </div>
        </div>

        <div class="app-menu">
            <div class="p-4 h-100">
                <form>
                    <h4>Filter Berdasarkan Provinsi</h4><br>
                    <div class="form-group">
                        <label>Pilih Provinsi</label>
                        <select class="form-control select2-single" id="filterProvinsi" data-width="100%">

                        </select>
                    </div>

                    <div class="form-group">
                        <button type="button" id="submit" onclick="FilterData()" class="btn btn-secondary mb-1">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php include("layouts/footer.php") ?>
</body>

<?php include("layouts/script.php") ?>
<?php include("services/draw.php") ?>