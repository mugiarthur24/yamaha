<div class="p-1 mb-2">
	<b>Tambah Penjualan</b><br/>
	<span class="text-muted">Tambah Penjualan hari ini, <?php echo date('d F Y',strtotime($tgl)); ?></span>
</div>
<div class="row">
	<div class="col">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col">
						<b>Detail Nota / Struk</b>
						<span class="text-muted">Detail Nota, <?php echo $detail->no_nota_keluar; ?></span>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table>
						<tr>
							<td class="py-1">No Nota</td>
							<td class="py-1">:</td>
							<td class="py-1"><?php echo $detail->no_nota_keluar; ?></td>
						</tr>
						<tr>
							<td class="py-1">Tanggal</td>
							<td class="py-1">:</td>
							<td class="py-1"><?php echo date('d F Y',strtotime($detail->tgl_jual)); ?></td>
						</tr>
						<tr>
							<td class="py-1">Sales</td>
							<td class="py-1">:</td>
							<td class="py-1"><?php echo @$this->Admin_m->detail_data('users','id',$detail->id_user)->first_name; ?></td>
						</tr>
						<tr>
							<td class="py-1">Status Pembayaran</td>
							<td class="py-1">:</td>
							<td class="py-1">
								<?php if ($detail->id_status =='0'): ?>
									<span class="pcoded-badge label label-danger">Belum Dibayar</span>
								<?php else: ?>
									<span class="pcoded-badge label label-success">Sudah Dibayar</span>
								<?php endif ?>
							</td>
						</tr>
						<tr>
							<td class="py-1">Status STNK</td>
							<td class="py-1">:</td>
							<td class="py-1">
								<?php if ($detail->id_status_stnk =='0'): ?>
									<span class="pcoded-badge label label-danger">Belum Selesai</span>
								<?php else: ?>
									<span class="pcoded-badge label label-success">Sudah Selesai</span>
								<?php endif ?>
							</td>
						</tr>
					</table>
					<table class="table mt-2" style="font-size: 13px;">
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
							<td>Harga</td>
							<td></td>
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
								<td><?php echo 'Rp.'.number_format($detproduk->hrg_jual); ?></td>
								<td>
									<?php if ($detail->id_status =='0'): ?>
										<a href="<?php echo base_url('index.php/admin/penjualan/delprodukjual/'.$detail->no_nota_keluar) ?>" class="text-danger">Batal</a>
									<?php else: ?>
										<a href="#" class="text-secondary">Batal</a>
									<?php endif ?>
								</td>
							</tr>
						<?php endif ?>
						<tr>
							<td colspan="6"></td>
							<td colspan="2">
								<a href="<?php echo base_url('index.php/admin/penjualan/previewnota/'.$detail->no_nota_keluar) ?>" class="btn btn-info btn-sm w-100" target="_blank">Cetak Nota Pembelian</a>
							</td>
						</tr>
							<?php if ($detail->id_status =='0'): ?>
								<tr>
									<td colspan="6"></td>
									<td colspan="2">
										<?php if ($detail->id_produk =='0'): ?>
											<button type="button" class="btn btn-secondary btn-sm w-100">
											  Pembayaran
											</button>
										<?php else: ?>
											<button type="button" class="btn btn-success btn-sm w-100" data-toggle="modal" data-target="#bayar">
											  Pembayaran
											</button>
										<?php endif ?>
									</td>
								</tr>
							<?php endif ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col">
		<nav>
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<a class="nav-item nav-link active" id="nav-home-tab1" data-toggle="tab" href="#produk" role="tab" aria-controls="nav-home" aria-selected="true">Data Produk <i class="ti ti-briefcase"></i></a>
				<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Pembeli <i class="ti ti-user"></i></a>
				<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#leasing" role="tab" aria-controls="nav-contact" aria-selected="false">Leasing <i class="ti ti-shopping-cart-full"></i></a>
				<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#kelengkapan" role="tab" aria-controls="nav-contact" aria-selected="false">Kelengkapan <i class="ti ti-bookmark-alt"></i></a>
			</div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show active" id="produk" role="tabpanel" aria-labelledby="nav-home-tab">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col">
								<b>Daftar Produk</b>
								<span class="text-muted">Produk siap dijual / Tersedia pada dealer</span>
							</div>
						</div>
					</div>
					<div class="card-body">
						<form action="<?php echo base_url('index.php/admin/penjualan/tambah/'.$detail->no_nota_keluar) ?>" method="post">
							<div class="row">
								<div class="col">
									<select name="id_type" class="form-control">
										<?php if (!empty($post['id_type'])): ?>
											<option value="<?php echo $post['id_type'] ?>"><?php echo $this->Admin_m->detail_data('type','id_type',$post['id_type'])->nm_type ?></option>
											<option value="">Semua Type Produk</option>
										<?php else: ?>
												<option value="">Semua Type Produk</option>
										<?php endif ?>
										<?php foreach ($type as $data): ?>
											<option value="<?php echo $data->id_type ?>"><?php echo $data->nm_type ?></option>
										<?php endforeach ?>
									</select>
								</div>
								<div class="col">
									<input type="text" name="cc" class="form-control" placeholder="CC Produk" style="width: 100%" <?php if (!empty($post['cc']) ): ?>
									value="<?php echo $post['cc'] ?>"
									<?php endif ?>>
								</div>
								<div class="col">
									<input type="text" name="warna" class="form-control" placeholder="Warna Produk" style="width: 100%" <?php if (!empty($post['warna']) ): ?>
									value="<?php echo $post['warna'] ?>"
									<?php endif ?>>
								</div>
								<div class="col">
									<button type="submit" name="submit" value="submit" class="btn btn-success btn-sm w-100">Cari</button>
								</div>
							</div>
						</form>
						<div class="mt-4">Jumlah produk di temukan sebanyak <label class="label label-success"><?php echo $jmldata.' Produk'; ?></label></div>
						<div class="">
							<table class="table mt-2" style="font-size: 13px;">
								<tr>
									<th>No</th>
									<th>No Rangka</th>
									<th>No Mesin</th>
									<th>Type</th>
									<th>Cc</th>
									<th>Warna</th>
									<th>Harga</th>
									<th></th>
								</tr>
								<?php if ($hasil == TRUE): ?>
									<?php $no = 1+$row ?>
									<?php foreach ($hasil as $data): ?>
										<form action="<?php echo base_url('index.php/admin/penjualan/addproduk/'.$detail->no_nota_keluar) ?>" method="post">
											<tr>
												<td><?php echo $no; ?></td>
												<td>
													<input type="hidden" name="id_produk" value="<?php echo $data['id_produk'] ?>">
													<?php echo $data['no_rangka'] ?>
												</td>
												<td><?php echo $data['no_mesin'] ?></td>
												<td><?php echo $data['nm_type']; ?></td>
												<td><?php echo $data['cc']; ?></td>
												<td><?php echo $data['warna']; ?></td>
												<td><?php echo 'Rp.'.number_format($data['hrg_jual']); ?></td>
												<td>
													<?php if ($detail->id_produk !=='0'): ?>
														<div class="btn  btn-secondary btn-sm">Tambah</div>
													<?php else: ?>
														<button type="submit" name="submit" value="submit" class="btn  btn-success btn-sm">Tambah</button>
													<?php endif ?>
												</td>
											</tr>
										</form>
										<?php $no++ ?>
									<?php endforeach ?>
									<?php else: ?>
										<tr><td colspan="8" class="text-center">Tidak ada data ditemukan</td></tr>
									<?php endif ?>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col">
								<b>Identitas Pembeli</b>
								<span class="text-muted">Identitas Lengkap pembeli Pada Nota, <?php echo $detail->no_nota_keluar; ?></span>
							</div>
						</div>
					</div>
					<div class="card-body">
						<form action="<?php echo base_url('index.php/admin/penjualan/updatapembeli/'.$detail->no_nota_keluar) ?>" method="post">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Nama Sesuai KTP (Pembeli)</label>
										<input type="text" class="form-control" name="nm_p_ktp" placeholder="Masukan Nama Pembeli Sesuai KTP" value="<?php echo $detail->nm_p_ktp ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Alamat 1</label>
										<input type="text" class="form-control" name="alamat_1_p" placeholder="Alamat 1" value="<?php echo $detail->alamat_1_p ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>No Polisi</label>
										<input type="text" class="form-control" name="no_polisi" placeholder="Nomor Polisi" value="<?php echo $detail->no_polisi ?>">
									</div>
								</div>
							</div>
							<button type="submit" value="submit" name="submit" class="btn btn-success btn-sm">Simpan Data Pembeli</button>
						</form>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="leasing" role="tabpanel" aria-labelledby="leasing">
				<div class="card mt-4">
					<div class="card-header">
						<div class="row">
							<div class="col">
								<b>Data Leasing</b>
								<span class="text-muted">Kelengkapan data leasing, <?php echo $detail->no_nota_keluar; ?></span>
							</div>
						</div>
					</div>
					<form action="<?php echo base_url('index.php/admin/penjualan/updataleasing/'.$detail->no_nota_keluar) ?>" method="post">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<?php if ($detail->id_leasing =='0'): ?>
											<div class="checkbox-fade fade-in-primary d-">
											    <label>
											        <input type="radio" name="id_leasing" value="0" checked>
											        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
											        <span class="text-inverse">Tidak Menggunakan Leasing / CASH</span></span>
											    </label>
											</div><br/>
										<?php else: ?>
											<div class="checkbox-fade fade-in-primary d-">
											    <label>
											        <input type="radio" name="id_leasing" value="0">
											        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
											        <span class="text-inverse">Tidak Menggunakan Leasing / CASH</span>
											    </label>
											</div><br/>
										<?php endif ?>
										<?php foreach ($leasing as $leas): ?>
											<?php if ($leas->id_leasing == $detail->id_leasing): ?>
												<div class="checkbox-fade fade-in-primary d-">
												    <label>
												        <input type="radio" name="id_leasing" value="<?php echo $leas->id_leasing ?>" checked>
												        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
												        <span class="text-inverse"><?php echo $leas->nm_leasing; ?></span>
												    </label>
												</div><br/>
											<?php else: ?>
												<div class="checkbox-fade fade-in-primary d-">
												    <label>
												        <input type="radio" name="id_leasing" value="<?php echo $leas->id_leasing ?>">
												        <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
												        <span class="text-inverse"><?php echo $leas->nm_leasing; ?></span>
												    </label>
												</div><br/>
											<?php endif ?>
										<?php endforeach ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>STNK</label>
										<input type="text" class="form-control" name="stnk" placeholder="STNK">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Tgl Reg STNK</label>
										<input type="date" class="form-control" name="tgl_reg_stnk" placeholder="Masukan Nama Tanggal Lahir" value="<?php echo date('Y-m-d') ?>" value="<?php echo $detail->tgl_reg_stnk ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Harga STNK</label>
										<input type="text" class="form-control" name="harga_stnk" placeholder="Harga STNK" value="<?php echo $detail->harga_stnk ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Uang Muka</label>
										<input type="text" class="form-control" name="uang_muka" placeholder="Uang Muka" value="<?php echo $detail->uang_muka ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Jangka Bayar</label>
										<input type="text" class="form-control" name="jangka_bayar" value="<?php echo $detail->jangka_bayar ?>" placeholder="Jangka Bayar">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Angsuran</label>
										<input type="text" class="form-control" name="angsuran" placeholder="Angsuran" value="<?php echo $detail->angsuran ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Surveyor</label>
										<input type="text" class="form-control" name="id_surveyor" placeholder="Surveyor" value="<?php echo $detail->id_surveyor ?>">
									</div>
								</div>
							</div>
							<button type="submit" value="submit" name="submit" class="btn btn-success btn-sm">Simpan Data Leasing</button>
						</div>
					</form>
				</div>
			</div>
			<div class="tab-pane fade" id="kelengkapan" role="tabpanel" aria-labelledby="kelengkapan">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col">
								<b>Identitas Tambahan Pembeli</b>
								<span class="text-muted">Identitas Lengkap pembeli Pada Nota, <?php echo $detail->no_nota_keluar; ?></span>
							</div>
						</div>
					</div>
					<div class="card-body">
						<form action="<?php echo base_url('index.php/admin/penjualan/updatapembelilengkap/'.$detail->no_nota_keluar) ?>" method='post'>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Nama di Buku Uang</label>
										<input type="text" class="form-control" name="nm_p_bku_uang" placeholder="Masukan Nama Untuk STNK" value="<?php echo $detail->nm_p_bku_uang ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Jenis Kelamin</label>
										<select name="jk_p" class="form-control">
											<?php if ($detail->jk_p == TRUE): ?>
												<?php if ($detail->jk_p == 'L'): ?>
													<option value="L">-- Laki-Laki --</option>
													<option value="P">Perempuan</option>
												<?php else: ?>
													<option value="P">-- Perempuan --</option>
													<option value="L">Laki-laki</option>
												<?php endif ?>
											<?php else: ?>
												<option value="L">Laki-Laki</option>
												<option value="P">Perempuan</option>
											<?php endif ?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>No KTP Pembeli</label>
										<input type="text" class="form-control" name="no_ktp_p" placeholder="Masukan Nomor KTP Pembeli" value="<?php echo $detail->no_ktp_p ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>No Telepon</label>
										<input type="text" class="form-control" name="tlp_p" placeholder="Masukan Nomor KTP Pembeli" value="<?php echo $detail->tlp_p ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
								<label>Tanggal Lahir Sesuai KTP</label>
								<input type="date" class="form-control" name="tgl_lahir_p" placeholder="Masukan Nama Tanggal Lahir" value="<?php echo date('Y-m-d') ?>" value="<?php echo $detail->tgl_lahir_p ?>">
							</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Pekerjaan</label>
										<input type="text" class="form-control" name="pekerjaan_p" placeholder="Pekerjaan"value="<?php echo $detail->pekerjaan_p ?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Pendidikan</label>
										<input type="text" class="form-control" name="pendidikan_p" placeholder="Pendidikan" value="<?php echo $detail->pendidikan_p ?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Pengeluaran</label>
										<input type="text" class="form-control" name="pengeluaran_p" placeholder="Pengeluaran" value="<?php echo $detail->pengeluaran_p ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Propinsi</label>
										<input type="text" class="form-control" name="propinsi_p" placeholder="Masukan Nama Propinsi Pembeli" value="<?php echo $detail->propinsi_p ?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Kecamatan</label>
										<input type="text" class="form-control" name="kecamatan_p" placeholder="Masukan Nama Kecamatan Pembeli" value="<?php echo $detail->kecamatan_p ?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Kelurahan</label>
										<input type="text" class="form-control" name="kelurahan_p" placeholder="Masukan Nama Kelurahan Pembeli" value="<?php echo $detail->kelurahan_p ?>">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Kode Pos</label>
										<input type="text" class="form-control" name="kode_pos_p" placeholder="Kode Pos" value="<?php echo $detail->kode_pos_p ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Alamat 2</label>
										<input type="text" class="form-control" name="alamat_2_p" placeholder="Alamat 2" value="<?php echo $detail->alamat_2_p ?>">
									</div>
								</div>
							</div>
							<button type="submit" name="submit" value="submit" class="btn btn-success btn-sm">Simpan Kelengkapan tambahan Pembeli</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php if ($detail->id_status =='0' && $detail->id_produk !=='0'): ?>
	<!-- Modal -->
	<div class="modal fade" id="bayar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Pembayaran</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form action="<?php echo base_url('index.php/admin/penjualan/pembayaran/'.$detail->no_nota_keluar) ?>" method="post">
	      	<div class="modal-body">
	      		<?php if ($detail->id_leasing =='0'): ?>
	      			<div class="alert alert-success">
	      				<b>Perhatian</b><br/>
	      				<p>Nota <?php echo $detail->no_nota_keluar; ?> ini melakukan pebayaran secara Tunai / CASH atau tidak melaui pihak Leasing.</p>
	      			</div>
	      			<div class="form-group">
	      				<label>Jumlah Bayar</label>
	      				<div class="form-control"><?php echo 'Rp.'.number_format($detproduk->hrg_jual); ?></div>
	      				<input type="hidden" name="jml_bayar" value="<?php echo $detproduk->hrg_jual ?>">
	      				<small class="form-text text-muted">Tidak dapat di edit</small>
	      			</div>
	      			<div class="form-group">
	      				<label>Jumlah Uang di Beri</label>
	      				<input type="text" class="form-control" name="jml_di_bayar" value="<?php echo $detproduk->hrg_jual; ?>"  placeholder="Masukan Jumlah Uang">
	      				<small class="form-text text-muted">Hanya dapat menggunakan angka tanpa spasi titik dan koma</small>
	      			</div>
	      			<?php else: ?>
	      				<div class="alert alert-info">
	      					<b>Perhatian</b><br/>
	      					<p>Nota <?php echo $detail->no_nota_keluar; ?> Terdaftar menggunakan leasing sebagai media pembayaran, sehingga hanya memasukan jumlah <b>Uang Muka</b> Wajib Bayar yang dapat di isi pada <b>Data leasing</b>, pastikan data sudah sesuai sebelum melakukan pembayaran.</p>
	      				</div>
	      				<div class="form-group">
	      					<label>Jumlah Uang Muka Wajib di bayar</label>
	      					<div class="form-control"><?php echo 'Rp.'.number_format($detail->uang_muka); ?></div>
	      					<input type="hidden" name="jml_bayar" value="<?php echo $detail->uang_muka ?>">
	      					<small class="form-text text-muted">Tidak dapat di edit</small>
	      				</div>
	      				<div class="form-group">
	      					<label>Jumlah Uang di Beri</label>
	      					<input type="text" class="form-control" name="jml_di_bayar" value="<?php echo $detail->uang_muka; ?>"  placeholder="Masukan Jumlah Uang">
	      					<small class="form-text text-muted">Hanya dapat menggunakan angka tanpa spasi titik dan koma</small>
	      				</div>
	      			<?php endif ?>
	      		</div>
	      		<div class="modal-footer">
	      			<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
	      			<button type="submit" name="submit" value="submit" class="btn btn-primary btn-sm">lakukan Pembayaran</button>
	      		</div>
	      	</form>
	      </div>
	  </div>
	</div>
<?php endif ?>
