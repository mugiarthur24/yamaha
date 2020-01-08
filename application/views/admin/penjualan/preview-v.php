<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <!-- Favicon icon -->
    <link rel="icon" href="<?php echo base_url('assets/adminty/files/') ?>\assets\images\favicon.ico" type="image/x-icon">
    <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/adminty/files/') ?>\bower_components\bootstrap\css\bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/adminty/files/') ?>\assets\icon\themify-icons\themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/adminty/files/') ?>\assets\icon\icofont\css\icofont.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/adminty/files/') ?>\assets\icon\feather\css\feather.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/adminty/files/') ?>\assets\css\style.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/adminty/files/') ?>\assets\css\jquery.mCustomScrollbar.css">
</head>
<body>
    <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <!-- Main-body start -->
            <div class="main-body">
                <div class="page-wrapper">

                    <!-- Page body start -->
                    <div class="page-body">
                        <!-- Container-fluid starts -->
                        <div class="container">
                            <!-- Main content starts -->
                            <div>
                                <!-- Invoice card start -->
                                <div class="card">
                                    <div class="row invoice-contact">
                                        <div class="col-md-8">
                                            <div class="invoice-box row">
                                                <div class="col-sm-12">
                                                    <table class="table table-responsive invoice-table table-borderless">
                                                        <tbody>
                                                            <tr>
                                                                <td><img src="<?php echo base_url('assets/img/lembaga/REVS_YOUR_HEART-SEMAKIN_DI_DEPAN.png') ?>" class="m-b-10" alt="" width="120px"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>CV. CITRA SELARAS </br>DEALER RESMI KENDARAAN RODA 2 - MERK YAMAHA</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Jl. Betoambari No. 74. Telp. (0402) 2825960 Fax. (0402) 2825961 </br>Baubau - Sulawesi Tenggara</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="row invoive-info">
                                            <div class="col-md-4 col-xs-12 invoice-client-info">
                                                <h6>Informasi Pelanggan :</h6>
                                                <h6 class="m-0"><?php echo $detail->nm_p_ktp ?></h6>
                                                <p class="m-0 m-t-10"><?php echo $detail->alamat_1_p ?></p>
                                                <p class="m-0"><?php echo $detail->tlp_p ?></p>
                                                
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <h6>Informasi Pembelian :</h6>
                                                <table class="table table-responsive invoice-table invoice-order table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <th>Tanggal :</th>
                                                            <td><?php echo date('d F Y',strtotime($detail->tgl_jual)); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Status :</th>
                                                            <td>
                                                                <span><?php if ($detail->id_status =='0'): ?>
                                                                <span class="pcoded-badge label label-danger">Belum Dibayar</span>
                                                                <?php else: ?>
                                                                    <span class="pcoded-badge label label-success">Sudah Dibayar</span>
                                                                    <?php endif ?></span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>No Polisi :</th>
                                                            <td>
                                                                <?php echo $detail->no_polisi ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <h6 class="m-b-20">No Nota : <span><?php echo $detail->no_nota_keluar; ?></span></h6>
                                                <h6 class="text-uppercase text-primary">Total :
                                                    <?php if ($detail->id_leasing !=='0'): ?>
                                                        <td><?php echo 'Rp.'.number_format($detail->uang_muka); ?></td>
                                                    <?php else: ?>
                                                        <td><?php echo 'Rp.'.number_format($detproduk->hrg_jual); ?></td>
                                                    <?php endif ?>
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="table-responsive">
                                                    <table class="table  invoice-detail-table">
                                                        <thead>
                                                            <tr class="thead-default">
                                                                <th>No Rangka</th>
                                                                <th>No Mesin</th>
                                                                <th>Produk</th>
                                                                <th>Cc</th>
                                                                <th>Warna</th>
                                                                <th>Tahun</th>
                                                                <?php if ($detail->id_leasing !=='0'): ?>
                                                                    <th>Uang Muka</th>
                                                                <?php else: ?>
                                                                   <th>Harga</th> 
                                                                <?php endif ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><?php echo $detail->no_rangka; ?></td>
                                                                <td><?php echo $detail->no_mesin; ?></td>
                                                                <td><?php echo $detproduk->nm_merk.' '.$detproduk->nm_type; ?></td>
                                                                <td><?php echo $detproduk->cc; ?></td>
                                                                <td><?php echo $detproduk->warna; ?></td>
                                                                <td><?php echo $detproduk->thn_produk; ?></td>
                                                                <?php if ($detail->id_leasing !=='0'): ?>
                                                                    <td><?php echo 'Rp.'.number_format($detail->uang_muka); ?></td>
                                                                <?php else: ?>
                                                                   <td><?php echo 'Rp.'.number_format($detproduk->hrg_jual); ?></td>
                                                                <?php endif ?>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-responsive invoice-table invoice-total">
                                                    <tbody>
                                                        <tr class="text-info">
                                                            <td>
                                                                <hr>
                                                                <h5 class="text-primary">Total :</h5>
                                                            </td>
                                                            <td>
                                                                <hr>
                                                                <?php if ($detail->id_leasing !=='0'): ?>
                                                                    <h5 class="text-primary"><?php echo 'Rp.'.number_format($detail->uang_muka); ?></h5>
                                                                <?php else: ?>
                                                                   <h5 class="text-primary"><?php echo 'Rp.'.number_format($detproduk->hrg_jual); ?></h5>
                                                                <?php endif ?>
                                                                
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h6>Informasi :</h6>
                                                <p>1. Penggantian <b>Oli Garansi</b> Maksimal 1 Bulan atau 1.000 KM dari Tanggal Pembelian</br>2. Pengambilan BPKB Tidak Dapat di Wakilkan, Kecuali Membawa Surat Kuasa dan Bermaterai dari Pemilik Kendaraan</br>3. Surat-Surat Kendaraan dapat di ambil paling lama 1 - 3 Bulan untuk STNK Sedangkan BPKB 4 - 5 Bulan</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Invoice card end -->
                                <div class="row text-center">
                                    <div class="col-sm-12 invoice-btn-group text-center">
                                        <a href="<?php echo base_url('index.php/admin/penjualan/cetaknota/'.$detail->no_nota_keluar) ?>" target="_blank" class="btn btn-primary btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20">Print</a>
                                        <button type="button" class="btn btn-danger waves-effect m-b-10 btn-sm waves-light">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Container ends -->
                    </div>
                    <!-- Page body end -->
                </div>
            </div>
            <!-- Warning Section Starts -->

            
        </div>
    </div>
    <script data-cfasync="false" src="<?php echo base_url('assets/adminty/files/') ?>\cdn-cgi\scripts\5c5dd728\cloudflare-static\email-decode.min.js"></script><script type="text/javascript" src="<?php echo base_url('assets/adminty/files/') ?>\bower_components\jquery\js\jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/adminty/files/') ?>\bower_components\jquery-ui\js\jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/adminty/files/') ?>\bower_components\popper.js\js\popper.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/adminty/files/') ?>\bower_components\bootstrap\js\bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="<?php echo base_url('assets/adminty/files/') ?>\bower_components\jquery-slimscroll\js\jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="<?php echo base_url('assets/adminty/files/') ?>\bower_components\modernizr\js\modernizr.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/adminty/files/') ?>\bower_components\modernizr\js\css-scrollbars.js"></script>

    <!-- i18next.min.js -->
    <script type="text/javascript" src="<?php echo base_url('assets/adminty/files/') ?>\bower_components\i18next\js\i18next.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/adminty/files/') ?>\bower_components\i18next-xhr-backend\js\i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/adminty/files/') ?>\bower_components\i18next-browser-languagedetector\js\i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/adminty/files/') ?>\bower_components\jquery-i18next\js\jquery-i18next.min.js"></script>
    <!-- Custom js -->

    <script src="<?php echo base_url('assets/adminty/files/') ?>\assets\js\pcoded.min.js"></script>
    <script src="<?php echo base_url('assets/adminty/files/') ?>\assets\js\vartical-layout.min.js"></script>
    <script src="<?php echo base_url('assets/adminty/files/') ?>\assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/adminty/files/') ?>\assets\js\script.js"></script>

</body>
</html>