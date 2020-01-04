<div class="p-1 mb-2">
	<b>Tambah Penjualan</b><br/>
	<span class="text-muted">Tambah Penjualan hari ini, <?php echo date('d F Y',strtotime($tgl)); ?></span>
</div>
<div class="row">
	<div class="col-md-7">
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
					<table class="table mt-4" style="font-size: 13px;">
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
								<?php endif ?>
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
											<button type="submit" name="submit" value="submit" class="btn  btn-success btn-sm">Tambah</button>
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
		<div class="col-md-5">
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
							<td colspan="5" class="text-center"><b>Detail Pemesanan</b></td>
						</tr>
						<tr>
							<td>Produk</td>
							<td>Harga</td>
							<td></td>
						</tr>
						<?php if ($detail->id_produk =='0'): ?>
							<tr>
								<td colspan="5" align="center">Belum ada produk di pilih</td>
							</tr>
						<?php else: ?>
							<?php $detproduk = $this->Penjualan_m->detailproduk($detail->id_produk) ?>
							<tr>
								<td>
									<?php echo $detproduk->nm_merk.' '.$detproduk->nm_type.'<br/>'.$detproduk->cc.' '.$detproduk->warna.' Thn '.$detproduk->thn_produk; ?>
								</td>
								<td><?php echo 'Rp.'.number_format($detproduk->hrg_jual); ?></td>
								<td><a href="#" class="text-danger">Batal</a></td>
							</tr>
						<?php endif ?>
					</table>
				</div>
			</div>
		</div>
	</div>