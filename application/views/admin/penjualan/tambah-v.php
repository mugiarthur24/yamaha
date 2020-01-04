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
							<td>No Nota</td>
							<td>:</td>
							<td><?php echo $detail->no_nota_keluar; ?></td>
						</tr>
						<tr>
							<td>Tanggal</td>
							<td>:</td>
							<td><?php echo date('d F Y',strtotime($detail->tgl_jual)); ?></td>
						</tr>
						<tr>
							<td>Sales</td>
							<td>:</td>
							<td><?php echo @$this->Admin_m->detail_data('users','id',$detail->id_user)->first_name; ?></td>
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
								<td><a href="<?php echo base_url('index.php/admin/penjualan/delprodukjual/'.$detail->no_nota_keluar) ?>" class="text-danger">Batal</a></td>
							</tr>
						<?php endif ?>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
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
						<div class="col-md-12">
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
							<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
						</div>
							<div class="col-md-12">
								<input type="text" name="cc" class="form-control" placeholder="CC Produk" style="width: 100%" <?php if (!empty($post['cc']) ): ?>
								value="<?php echo $post['cc'] ?>"
								<?php endif ?>>
								<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
							</div>
							<div class="col-md-12">
								<input type="text" name="warna" class="form-control" placeholder="Warna Produk" style="width: 100%" <?php if (!empty($post['warna']) ): ?>
								value="<?php echo $post['warna'] ?>"
								<?php endif ?>>
								<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
							</div>
							<div class="col-md-12">
								<button type="submit" name="submit" value="submit" class="btn btn-success btn-sm">Cari</button>
							</div>
						</div>
					</form>
					<div class="mt-4">Jumlah produk di temukan sebanyak <label class="label label-success"><?php echo $jmldata.' Produk'; ?></label></div>
					<div class="table-responsive">
						<table class="table mt-2" style="font-size: 13px;">
							<tr>
								<th>No</th>
								<th>No Rangka / Mesin</th>
								<th>Type</th>
								<th>Harga</th>
								<th></th>
							</tr>
							<?php if ($hasil == TRUE): ?>
								<?php $no = 1+$row ?>
								<?php foreach ($hasil as $data): ?>
									<?php if ($data['id_produk'] == $detail->id_produk): ?>
										<tr class="table-info">
											<td><?php echo $no; ?></td>
											<td>
												<input type="hidden" name="id_produk" value="<?php echo $data['id_produk'] ?>">
												<?php echo 'R : '.$data['no_rangka']; ?><br/>
												<?php echo 'M : '.$data['no_mesin']; ?>
											</td>
											<td>
												<?php echo $data['nm_type']; ?><br/>
												<?php echo $data['cc'].' / '.$data['warna']; ?>
											</td>
											<td><?php echo 'Rp.'.number_format($data['hrg_jual']); ?></td>
											<td>
												<div class="btn  btn-secondary btn-sm">Tambah</div>
											</td>
										</tr>
									<?php else: ?>
										<form action="<?php echo base_url('index.php/admin/penjualan/addproduk/'.$detail->no_nota_keluar) ?>" method="post">
											<tr>
												<td><?php echo $no; ?></td>
												<td>
													<input type="hidden" name="id_produk" value="<?php echo $data['id_produk'] ?>">
													<?php echo 'R : '.$data['no_rangka']; ?><br/>
													<?php echo 'M : '.$data['no_mesin']; ?>
												</td>
												<td>
													<?php echo $data['nm_type']; ?><br/>
													<?php echo $data['cc'].' / '.$data['warna']; ?>
												</td>
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
									<?php endif ?>
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
		<div class="col-md-6">
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
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Nama Sesuai KTP (Pembeli)</label>
								<input type="text" class="form-control" name="nm_p_ktp" placeholder="Masukan Nama Pembeli Sesuai KTP">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Alamat 1</label>
								<input type="text" class="form-control" name="alamat_1_p" placeholder="Alamat 1">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card mt-4">
				<div class="card-header">
					<div class="row">
						<div class="col">
							<b>Data Leasing</b>
							<span class="text-muted">Kelengkapan data leasing, <?php echo $detail->no_nota_keluar; ?></span>
						</div>
					</div>
				</div>
				<div class="card-body">
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
								<input type="date" class="form-control" name="tgl_reg_stnk" placeholder="Masukan Nama Tanggal Lahir" value="<?php echo date('Y-m-d') ?>">
							</div>
						</div>
						
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Harga STNK</label>
								<input type="text" class="form-control" name="uang_muka" placeholder="Harga STNK">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Uang Muka</label>
								<input type="text" class="form-control" name="kelurahan_p" placeholder="Uang Muka">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Jangka Bayar</label>
								<input type="text" class="form-control" name="jangka_bayar" placeholder="Jangka Bayar">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Angsuran</label>
								<input type="text" class="form-control" name="angsuran" placeholder="Angsuran">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Surveyor</label>
								<input type="text" class="form-control" name="id_surveyor" placeholder="Surveyor">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
			<div class="col">
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
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Nama di Buku Uang</label>
									<input type="text" class="form-control" name="nm_p_bku_uang" placeholder="Masukan Nama Untuk STNK">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>No KTP Pembeli</label>
									<input type="text" class="form-control" name="no_ktp" placeholder="Masukan Nomor KTP Pembeli">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>No Telepon</label>
									<input type="text" class="form-control" name="tlp_p" placeholder="Masukan Nomor KTP Pembeli">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="form-group">
									<label>Jenis Kelamin</label>
									<select name="jk_p" class="form-control">
										<option value="L">Laki-Laki</option>
										<option value="P">Perempuan</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Tanggal Lahir Sesuai KTP</label>
							<input type="date" class="form-control" name="tgl_lahir_p" placeholder="Masukan Nama Tanggal Lahir" value="<?php echo date('Y-m-d') ?>">
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Pekerjaan</label>
									<input type="text" class="form-control" name="pekerjaan_p" placeholder="Pekerjaan">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Pendidikan</label>
									<input type="text" class="form-control" name="pendidikan_p" placeholder="Pendidikan">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Pengeluaran</label>
									<input type="text" class="form-control" name="pengeluaran_p" placeholder="Pengeluaran">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Propinsi</label>
									<input type="text" class="form-control" name="propinsi_p" placeholder="Masukan Nama Propinsi Pembeli">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Kecamatan</label>
									<input type="text" class="form-control" name="kecamatan_p" placeholder="Masukan Nama Kecamatan Pembeli">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Kelurahan</label>
									<input type="text" class="form-control" name="kelurahan_p" placeholder="Masukan Nama Kelurahan Pembeli">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Kode Pos</label>
									<input type="text" class="form-control" name="kode_pos_p" placeholder="Kode Pos">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Alamat 2</label>
									<input type="text" class="form-control" name="alamat_2_p" placeholder="Alamat 2">
								</div>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>