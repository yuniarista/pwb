<?php
    // berita slider
    $sqlslider = "select b.*, u.nama_user from tbl_berita as b, tbl_user as u where b.user_berita = u.id_user and status_berita = 'publish' ORDER BY b.tanggal_berita DESC LIMIT 5";
    $queryslider = mysqli_query($_koneksi, $sqlslider);
    $dataslider = array();
    while($rowslider = mysqli_fetch_array($queryslider)) {
        array_push($dataslider, $rowslider);
    }
    // print_r($dataslider);

    // jumlah berita by category
    $sqljum = "select count(id_berita) as jumlah, kategori_berita from tbl_berita where status_berita = 'publish' group by kategori_berita";
    $queryjum = mysqli_query($_koneksi, $sqljum);
    $datajumlah = array();
    $datajumlah['politik'] = 0;
    $datajumlah['olahraga'] = 0;
    $datajumlah['pendidikan'] = 0;
    $datajumlah['kuliner'] = 0;
    $datajumlah['hiburan'] = 0;
    $datajumlah['lainnya'] = 0;
    while($rowjum = mysqli_fetch_array($queryjum)) {
        if ($rowjum['kategori_berita'] == 'politik') {
            $datajumlah['politik'] = $rowjum['jumlah'];
        }
        if ($rowjum['kategori_berita'] == 'olahraga') {
            $datajumlah['olahraga'] = $rowjum['jumlah'];
        }
        if ($rowjum['kategori_berita'] == 'pendidikan') {
            $datajumlah['pendidikan'] = $rowjum['jumlah'];
        }
        if ($rowjum['kategori_berita'] == 'kuliner') {
            $datajumlah['kuliner'] = $rowjum['jumlah'];
        }
        if ($rowjum['kategori_berita'] == 'hiburan') {
            $datajumlah['hiburan'] = $rowjum['jumlah'];
        }
        if ($rowjum['kategori_berita'] == 'lainnya') {
            $datajumlah['lainnya'] = $rowjum['jumlah'];
        }
    }
    // print_r($datajumlah);

    // data headline news (ambil 2 data dari data slider)
    $dataheadline = $dataslider;

    // berita politik
    $sqlpolitik = "select b.*, u.nama_user from tbl_berita as b, tbl_user as u where b.user_berita = u.id_user and status_berita = 'publish' and kategori_berita = 'politik' ORDER BY b.tanggal_berita DESC LIMIT 3";
    $querypolitik = mysqli_query($_koneksi, $sqlpolitik);
    $datapolitik = array();
    while($rowpolitik = mysqli_fetch_array($querypolitik)) {
        array_push($datapolitik, $rowpolitik);
    }
    // print_r($datapolitik);

    // berita olahraga
    $sqlolahraga = "select b.*, u.nama_user from tbl_berita as b, tbl_user as u where b.user_berita = u.id_user and status_berita = 'publish' and kategori_berita = 'olahraga' ORDER BY b.tanggal_berita DESC LIMIT 3";
    $queryolahraga = mysqli_query($_koneksi, $sqlolahraga);
    $dataolahraga = array();
    while($rowolahraga = mysqli_fetch_array($queryolahraga)) {
        array_push($dataolahraga, $rowolahraga);
    }
    // print_r($dataolahraga);
?>
<!-- Filter -->
<div class="mb-2">
    <div class="row justify-content-md-center">
        <div class="col-md-auto">
            <form class="form-inline mb-2">
                <div class="form-group mr-md-2 mb-2">
                    <select class="form-control w-100" name="kategori">
                        <option value="politik">Politik</option>
                        <option value="olehraga">Olahraga</option>
                        <option value="pendidikan">Pendidikan</option>
                        <option value="kuliner">Kuliner</option>
                        <option value="hiburan">Hiburan</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="form-group mb-2">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Judul" name="judul">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Sub menu category -->
<div class="mb-3">
    <div class="row justify-content-md-center">
        <div class="col-md-12">
            <div class="nav-scroller py-1 mb-2">
                <ul class="nav d-flex justify-content-center">
                    <li class="nav-item mx-1 mb-2">
                        <a class="btn btn-outline-dark btn-lg" href="#" data-toggle="tooltip" data-placement="bottom" title="Kategori: Politik">
                            <i class="fas fa-balance-scale"></i>
                        </a>
                    </li>
                    <li class="nav-item mx-1 mb-2">
                        <a class="btn btn-outline-dark btn-lg" href="#" data-toggle="tooltip" data-placement="bottom" title="Kategori: Olahraga">
                            <i class="fas fa-running"></i>
                        </a>
                    </li>
                    <li class="nav-item mx-1 mb-2">
                        <a class="btn btn-outline-dark btn-lg" href="#" data-toggle="tooltip" data-placement="bottom" title="Kategori: Pendidikan">
                            <i class="fas fa-university"></i>
                        </a>
                    </li>
                    <li class="nav-item mx-1 mb-2">
                        <a class="btn btn-outline-dark btn-lg" href="#" data-toggle="tooltip" data-placement="bottom" title="Kategori: Kuliner">
                            <i class="fas fa-utensils"></i>
                        </a>
                    </li>
                    <li class="nav-item mx-1 mb-2">
                        <a class="btn btn-outline-dark btn-lg" href="#" data-toggle="tooltip" data-placement="bottom" title="Kategori: Hiburan">
                            <i class="fas fa-theater-masks"></i>
                        </a>
                    </li>
                    <li class="nav-item mx-1 mb-2">
                        <a class="btn btn-outline-dark btn-lg" href="#" data-toggle="tooltip" data-placement="bottom" title="Kategori: Lainnya">
                            <i class="fas fa-th"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Slider -->
<div class="mb-3">
    <div class="row justify-content-md-center">
        <div class="col-md-9">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php for ($i=0; $i < count($dataslider); $i++){ ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i;?>" class="<?php echo $i == 0 ? 'active' : '';?>"></li>
                    <?php } ?>
                </ol>
                <div class="carousel-inner">
                    <?php for ($i=0; $i < count($dataslider); $i++){ ?>
                        <div class="carousel-item <?php echo $i == 0 ? 'active' : '';?>">
                            <img class="d-block w-100 img-slider-custom" src="files/<?php echo $dataslider[$i]['img_berita']; ?>" alt="<?php echo $dataslider[$i]['judul_berita']; ?>">
                            <div class="carousel-caption d-none d-md-block">
                                <h5><?php echo $dataslider[$i]['judul_berita'];?></h5>
                                <p><?php echo $dataslider[$i]['isi_berita'];?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    Kategori Berita
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Politik
                        <span class="badge badge-primary badge-pill"><?php echo $datajumlah['politik'];?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Olahraga
                        <span class="badge badge-primary badge-pill"><?php echo $datajumlah['olahraga'];?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Pendidikan
                        <span class="badge badge-primary badge-pill"><?php echo $datajumlah['pendidikan'];?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Kuliner
                        <span class="badge badge-primary badge-pill"><?php echo $datajumlah['kuliner'];?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Hiburan
                        <span class="badge badge-primary badge-pill"><?php echo $datajumlah['hiburan'];?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Lainnya
                        <span class="badge badge-primary badge-pill"><?php echo $datajumlah['lainnya'];?></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Headline -->
<div class="mb-3">
    <h3 class="pb-2 mb-3 font-italic border-bottom">Headline News</h3>
    <div class="row">
        <?php
            $jumheadline = count($dataheadline);
            if ($jumheadline > 2) {
                $jumheadline = 2;
            }
            for ($i=0; $i < $jumheadline; $i++){
        ?>
        <div class="col-md-6">
            <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                <div class="card-body d-flex flex-column align-items-start">
                    <strong class="d-inline-block mb-2 text-primary"><?php echo $dataheadline[$i]['kategori_berita'];?></strong>
                    <h3 class="mb-0">
                        <a class="text-dark" href="#"><?php echo $dataheadline[$i]['judul_berita'];?></a>
                    </h3>
                    <div class="mb-1 text-muted"><?php echo $dataheadline[$i]['tanggal_berita'];?></div>
                    <p class="card-text mb-auto">
                        <?php echo $dataheadline[$i]['isi_berita'];?>
                    </p>
                    <a href="#">Continue reading</a>
                </div>
                <div class="card-img-right img-card-headline flex-auto d-none d-lg-block" style="background-image: url('files/<?php echo $dataheadline[$i]['img_berita']; ?>');" alt="<?php echo $dataheadline[$i]['judul_berita'];?>"></div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<!-- By category -->
<div class="mb-3">
    <h3 class="pb-2 mb-3 font-italic border-bottom">Berita Politik</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="card-columns">
                <?php for ($i=0; $i < count($datapolitik); $i++){ ?>
                    <div class="card">
                        <img class="card-img-top img-fluid img-card-bycategori" src="files/<?php echo $datapolitik[$i]['img_berita']; ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $datapolitik[$i]['judul_berita']?></h5>
                            <p class="card-text"><?php echo $datapolitik[$i]['isi_berita']?></p>
                            <p class="card-text"><small class="text-muted"><?php echo $datapolitik[$i]['tanggal_berita']?></small></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="mb-3">
    <h3 class="pb-2 mb-3 font-italic border-bottom">Berita Olahraga</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="card-columns">
                <?php for ($i=0; $i < count($dataolahraga); $i++){ ?>
                    <div class="card">
                        <img class="card-img-top img-fluid img-card-bycategori" src="files/<?php echo $dataolahraga[$i]['img_berita']; ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $dataolahraga[$i]['judul_berita']?></h5>
                            <p class="card-text"><?php echo $dataolahraga[$i]['isi_berita']?></p>
                            <p class="card-text"><small class="text-muted"><?php echo $dataolahraga[$i]['tanggal_berita']?></small></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>