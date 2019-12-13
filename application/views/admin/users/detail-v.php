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
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <b>Data karyawan</b><span>Dara diri lengkap Karyawan</span>
                        </div>
                        <div class="col-md-6">
                            <?php if ($detail->active =='1'): ?>
                                <button type="button" class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#nonatif">
                                  Nonaktifkan Pegawai
                                </button>
                            <?php else: ?>
                                <button type="button" class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#nonatif">
                                  Aktifkan Pegawai
                                </button>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
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
                                <?php if ($detail->active == '1'): ?>
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
<!-- Modal -->
<div class="modal fade" id="nonatif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Aktif dan Nonaktifkan Karyawan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php if ($detail->active =="1"): ?>
            <form action="<?php echo base_url('index.php/admin/users/nonaktifasiakun/'.$detail->id) ?>" method="post">
                <div class="modal-body">
                <div class="alert alert-danger">
                    <b>Saat Ini Status Karyawan Sedang Aktif!</b>
                    <p>Bila anda meNonaktifkan akun ini, maka pengguna akun tersebut akan kehilangan segala akses dari Aplikasi ini, Yakin Menonaktifkan Akun ini?</p>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" name="submit" value="submit" class="btn btn-danger">Ya</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak !</button>
              </div>
            </form>
        <?php else: ?>
            <form action="<?php echo base_url('index.php/admin/users/aktifasiakun/'.$detail->id) ?>" method="post">
                <div class="modal-body">
                <div class="alert alert-success">
                    <b>Saat Ini Status Karyawan Sedang Nonaktif!</b>
                    <p>Akses akun ini sedang di nonaktifkan, singga pengguna akun tidak dapat menggunakan semua fitur yang terdapat pada Alikasi ini, Aktifkan Kembali Akun ini?</p>
                </div>
              </div>
              <div class="modal-footer">
                <button  class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <button type="submit" name="submit" value="submit" class="btn btn-success">Ya</button>
              </div>
            </form>
      <?php endif ?>
    </div>
  </div>
</div>