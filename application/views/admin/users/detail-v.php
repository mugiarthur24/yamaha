<div class="main-body">
    <div class="page-wrapper">
        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <div class="d-inline">
                            <h4>Profil Karyawan</h4>
                            <span>Data diri karyawan dan keperluan lainnya</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </div>
        </div>
        <!-- Page-header end -->
        <div class="page-body">
            <!--profile cover start-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="cover-profile">
                        <div class="profile-bg-img">
                            <img class="profile-bg-img img-fluid" src="<?php echo base_url('assets/adminty/files/') ?>\assets\images\user-profile\bg-img1.jpg" alt="bg-img">
                            <div class="card-block user-info">
                                <div class="col-md-12">
                                    <div class="media-left">
                                        <a href="#" class="profile-image">
                                            <img class="user-img img-radius" src="<?php echo base_url('assets/img/users/'.$detail->profile) ?>" alt="<?php echo $detail->profile ?>" width="108px" height="108px">
                                        </a>
                                    </div>
                                    <div class="media-body row">
                                        <div class="col-lg-12">
                                            <div class="user-title">
                                                <h2><?php echo $detail->first_name; ?></h2>
                                                <span class="text-white"><?php echo $detail->username; ?></span>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="pull-right cover-btn">
                                                <a href="<?php echo base_url('index.php/admin/users/edit/'.$detail->id) ?>" class="btn btn-primary m-r-10 m-b-5"><i class="icofont icofont-plus"></i> Edit Data Karyawan</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--profile cover end-->
            <div class="card">
                <div class="card-header"><b>Data karyawan</b><span>Dara diri lengkap Karyawan</span></div>
                <div class="card-body">
                    <table>
                        <tr>
                            <td>Nama Lengkap</td>   
                            <td>:</td>   
                            <td><?php echo $detail->first_name; ?></td>   
                        </tr>
                        <tr>
                            <td>Kode karyawan</td>   
                            <td>:</td>   
                            <td><?php echo $detail->username; ?></td>   
                        </tr>
                        <tr>
                            <td>Password</td>   
                            <td>:</td>   
                            <td><?php echo $detail->repassword; ?></td>   
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>   
                            <td>:</td>   
                            <td><?php echo $detail->jk; ?></td>   
                        </tr>
                        <tr>
                            <td>nomor HP</td>   
                            <td>:</td>   
                            <td><?php echo $detail->phone; ?></td>   
                        </tr>
                        <tr>
                            <td>Email</td>   
                            <td>:</td>   
                            <td><?php echo $detail->email; ?></td>   
                        </tr>
                        <tr>
                            <td>Lokasi Tugas</td>   
                            <td>:</td>   
                            <td><?php echo $this->Admin_m->detail_data('info_pt','id_info_pt',$detail->id_info_pt)->nama_info_pt; ?></td>   
                        </tr>
                        <tr>
                            <td>Status Keaktifan</td>   
                            <td>:</td>   
                            <td>
                                <?php if ($detail->aktive == '1'): ?>
                                    Aktif
                                <?php else: ?>
                                    Nonaktif
                                <?php endif ?>
                            </td>   
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>