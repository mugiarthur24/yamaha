<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <!-- Favicon icon -->
    <link rel="icon" href="<?php echo base_url('assets/adminty/files/') ?>\assets\images\favicon.ico" type="image/x-icon">
    <!-- Required Fremwork -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style type="text/css">
        .page-break  { display:block; page-break-before:always; }
        @media print {
            * {
                -webkit-print-color-adjust: exact !important; /*Chrome, Safari */
                color-adjust: exact !important;  /*Firefox*/
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body onload="window.print();">
    <table class="">
        <tbody>
            <tr>
                <td><img src="<?php echo base_url('assets/img/lembaga/'.$infopt->logo_pt) ?>" class="m-b-10" alt=""></td>
            </tr>
            <tr>
                <td>CV. CITRA SELARAS </br>DEALER RESMI KENDARAAN RODA 2 - MERK YAMAHA</td>
            </tr>
            <tr>
                <td>Jl. Betoambari No. 74. Telp. (0402) 2825960 Fax. (0402) 2825961 </br>Baubau - Sulawesi Tenggara</td>
            </tr>
        </tbody>
    </table>
    <table>
        <tr>
            <td class="">No Nota</td>
            <td class="">:</td>
            <td class=""><?php echo $detail->no_nota_keluar; ?></td>
        </tr>
        <tr>
            <td class="">Tanggal</td>
            <td class="">:</td>
            <td class=""><?php echo date('d F Y',strtotime($detail->tgl_jual)); ?></td>
        </tr>
        <tr>
            <td class="">Counter Sales</td>
            <td class="">:</td>
            <td class=""><?php echo @$this->Admin_m->detail_data('users','id',$detail->id_user)->first_name; ?></td>
        </tr>
        <tr>
            <td class="">No Polisi</td>
            <td class="">:</td>
            <td class=""><?php echo $detail->no_polisi; ?></td>
        </tr>
        <tr>
            <td class="">Status Pembayaran</td>
            <td class="">:</td>
            <td class="">
                <?php if ($detail->id_status =='0'): ?>
                <span class="pcoded-badge label label-danger">Belum Dibayar</span>
                <?php else: ?>
                <span class="pcoded-badge label label-success">Sudah Dibayar</span>
                <?php endif ?>
            </td>
        </tr>
       
    </table>
    <table class="w-100 mt-2" border="1">
        <tr>
            <td colspan="8" class="text-center"><b>Detail Pemesanan</b></td>
        </tr>
        <tr>
            <td>No Rangka</td>
            <td>No Mesin</td>
            <td>Produk</td>
            <td>Cc</td>
            <td>Warna</td>
            <td>Tahun</td>
            <?php if ($detail->id_leasing !=='0'): ?>
                <td>Uang Muka</td>
            <?php else: ?>
                <td>Harga</td>
            <?php endif ?>
            
        </tr>
        <?php if ($detail->id_produk =='0'): ?>
        <tr>
            <td colspan="8" align="center">Belum ada produk di pilih</td>
        </tr>
        <?php else: ?>
        <?php $detproduk = $this->Penjualan_m->detailproduk($detail->id_produk) ?>
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
        <?php endif ?>
        <tr>
            <td colspan="7">
                <h6>Informasi :</h6>
                <p>1. Penggantian <b>Oli Garansi</b> Maksimal 1 Bulan atau 1.000 KM dari Tanggal Pembelian</br>2. Pengambilan BPKB Tidak Dapat di Wakilkan, Kecuali Membawa Surat Kuasa dan Bermaterai dari Pemilik Kendaraan</br>3. Surat-Surat Kendaraan dapat di ambil paling lama 1 - 3 Bulan untuk STNK Sedangkan BPKB 4 - 5 Bulan</p>
            </td>
        </tr>
  </table>
  <div class="row mt-4">
      <div class="col-md-4"></div>
      <div class="col-md-4"></div>
      <div class="col-md-4">
          <div class="text-center"><?php echo strtoupper($infopt->kode_pt).', '.date('d F Y',strtotime($detail->tgl_jual)); ?></div>
          <br/><br/><br/>
          <div class="text-center">
              <u><b><?php echo @$this->Admin_m->detail_data('users','id',$detail->id_user)->first_name; ?></b></u>
          </div>
          <div class="text-center">
              Counter Sales
          </div>
      </div>
  </div>
<?php if ($detail->id_leasing !=='0'): ?>
    <div class="page-break"></div>
    <table class="">
        <tbody>
            <tr>
                <td><img src="<?php echo base_url('assets/img/lembaga/'.$infopt->logo_pt) ?>" class="m-b-10" alt=""></td>
            </tr>
            <tr>
                <td>CV. CITRA SELARAS </br>DEALER RESMI KENDARAAN RODA 2 - MERK YAMAHA</td>
            </tr>
            <tr>
                <td>Jl. Betoambari No. 74. Telp. (0402) 2825960 Fax. (0402) 2825961 </br>Baubau - Sulawesi Tenggara</td>
            </tr>
        </tbody>
    </table>
    <div class="text-center"><h2><u>SURAT PERNYATAAN PENYERAHAN BPBK</u></h2></div>
    <table class="">
        <tbody>
            <tr>
                <td colspan="3">Yang Bertanda tangan di bawah ini :</td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><?php echo $infoptutama->header_pt; ?></td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>Pimpinan</td>
            </tr>
            <tr>
                <td>Nama Dealer</td>
                <td>:</td>
                <td><?php echo $infoptutama->nama_info_pt; ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?php echo $infoptutama->alamat_pt; ?></td>
            </tr>
            <tr>
                <td>No Telp</td>
                <td>:</td>
                <td><?php echo $infoptutama->kontak_1; ?></td>
            </tr>
            <tr>
                <td colspan="3">Dengan ini Menyatakan Akan menyerahkan BPKB dan Faktur dari :</td>
            </tr>
            <tr>
                <td>Nama Konsumen</td>
                <td>:</td>
                <td><?php echo $detail->nm_p_ktp; ?></td>
            </tr>
            <tr>
                <td>Atas Nama BPKB</td>
                <td>:</td>
                <td><?php echo $detail->nm_stnk; ?></td>
            </tr>
            <tr>
                <td>Merk / Jenis</td>
                <td>:</td>
                <td><?php echo $detproduk->nm_merk.' / '.$detproduk->nm_type; ?></td>
            </tr>
            <tr>
                <td>Warna / Tahun</td>
                <td>:</td>
                <td><?php echo $detproduk->warna.' / '.$detproduk->thn_produk; ?></td>
            </tr>
            <tr>
                <td>No. Rangka</td>
                <td>:</td>
                <td><?php echo $detail->no_rangka; ?></td>
            </tr>
            <tr>
                <td>No. Mesin</td>
                <td>:</td>
                <td><?php echo $detail->no_mesin; ?></td>
            </tr>
            <tr>
                <td colspan="3">
                    <p>BPKB dan Faktur tersebut akan kami serahkan langsung ke <?php echo $leasing->ket_leasing; ?> dalam jangka waktu 3 (bulan)  sejak tanggal pernyataan ini di buat. Surat Pernyataan Penyerahan BPKB ini berlaku sampai kami menyerahkan BPKB dam dibuatkan tanda terima dari <?php echo $leasing->ket_leasing; ?>. </p>
                    <p>Demikian surat pernyataan ini dibuat, terima kasih atas perhatian dan kerjasamanya</p>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="row mt-4">
      <div class="col-md-4"></div>
      <div class="col-md-4"></div>
      <div class="col-md-4">
          <div class="text-center"><?php echo strtoupper($infopt->kode_pt).', '.date('d F Y',strtotime($detail->tgl_jual)).'<br/>Yang Membuat Pernyataan'; ?></div>
          <br/><br/><br/>
          <div class="text-center">
              <u><b><?php echo $infoptutama->header_pt; ?></b></u>
          </div>
          <div class="text-center">
              Counter Sales
          </div>
      </div>
  </div>

<?php endif ?>
</body onload="window.print();">
</html>