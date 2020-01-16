<div class="row align-items-end">
    <div class="col-lg-8">
        <div class="page-header-title">
            <div class="d-inline">
            	<?php if (!empty($post['tgl_awal']) && !empty($post['tgl_akhir'])): ?>
            		<h4>Laporan Penjualan Bulanan dari <?php echo date('d F Y',strtotime($post['tgl_awal'])).' Sampai '.date('d F Y',strtotime($post['tgl_akhir'])); ?></h4>
	                <span>Daftar Hasil Penjualan per Bulan dari <?php echo date('d F Y',strtotime($post['tgl_awal'])).' Sampai '.date('d F Y',strtotime($post['tgl_akhir'])); ?></span>
	               <?php else: ?>
	               	<h4>Laporan Penjualan Bulanan dari "Tanggal Belum di tentukan"</h4>
	               	<span>Daftar Hasil Penjualan per Bulan dari "Tanggal Belum di tentukan"</span>
            	<?php endif ?>
            </div>
        </div>
    </div>
    <div class="col-lg-4"></div>
</div>
<div class="row mt-4">
	<div class="col-xl-3 col-md-6">
	    <div class="card bg-c-yellow update-card">
	        <div class="card-block">
	            <div class="row align-items-end">
	                <div class="col-8">
	                    <h4 class="text-white"><?php echo $jmldata; ?> Trx</h4>
	                    <h6 class="text-white m-b-0">Trx Penjualan</h6>
	                </div>
	                <div class="col-4 text-right">
	                    <canvas id="update-chart-1" height="50"></canvas>
	                </div>
	            </div>
	        </div>
	        <div class="card-footer">
	            <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
	        </div>
	    </div>
	</div>
	
	<div class="col-xl-3 col-md-6">
	    <div class="card bg-c-pink update-card">
	        <div class="card-block">
	            <div class="row align-items-end">
	                <div class="col-8">
	                    <h4 class="text-white"><?php echo $stnktunda; ?> Trx</h4>
	                    <h6 class="text-white m-b-0">STNK Blm Selesai</h6>
	                </div>
	                <div class="col-4 text-right">
	                    <canvas id="update-chart-3" height="50"></canvas>
	                </div>
	            </div>
	        </div>
	        <div class="card-footer">
	            <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
	        </div>
	    </div>
	</div>
	<div class="col-xl-3 col-md-6">
	    <div class="card bg-c-lite-green update-card">
	        <div class="card-block">
	            <div class="row align-items-end">
	                <div class="col-8">
	                    <h4 class="text-white"><?php echo $ttlleasing; ?> Trx</h4>
	                    <h6 class="text-white m-b-0">Use Leasing</h6>
	                </div>
	                <div class="col-4 text-right">
	                    <canvas id="update-chart-4" height="50"></canvas>
	                </div>
	            </div>
	        </div>
	        <div class="card-footer">
	            <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
	        </div>
	    </div>
	</div>
	<div class="col-xl-3 col-md-6">
	    <div class="card bg-c-green update-card">
	        <div class="card-block">
	            <div class="row align-items-end">
	                <div class="col-8">
	                    <h4 class="text-white"><?php echo $ttlchash; ?> Trx</h4>
	                    <h6 class="text-white m-b-0">Bayar Chash</h6>
	                </div>
	                <div class="col-4 text-right">
	                    <canvas id="update-chart-2" height="50"></canvas>
	                </div>
	            </div>
	        </div>
	        <div class="card-footer">
	            <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
	        </div>
	    </div>
	</div>
</div>
<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col">
				<b>Daftar laporan</b>
				<span class="text-muted">laporan Penjualan</span>
			</div>
		</div>
	</div>
	<div class="card-body">
		<form action="<?php echo base_url('index.php/admin/laporan/bulanan/') ?>" method="post">
			<div class="row">
				<?php if ($users->id_info_pt =='1'): ?>
					<div class="col-md-6">
						<select name="id_info_pt" class="form-control">
							<?php if (!empty($post['id_info_pt'])): ?>
								<option value="<?php echo $post['id_info_pt'] ?>"><?php echo $this->Admin_m->detail_data('info_pt','id_info_pt',$post['id_info_pt'])->nama_info_pt ?></option>
								<option value="">Semua Perusahaan</option>
							<?php else: ?>
								<option value="">Semua Perusahaan</option>
							<?php endif ?>
							<?php foreach ($dtpt as $data): ?>
								<option value="<?php echo $data->id_info_pt ?>"><?php echo $data->nama_info_pt ?></option>
							<?php endforeach ?>
						</select>
						<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
					</div>
				<?php endif ?>
				<div class="col-md-6">
					<input type="text" name="no_nota_keluar" class="form-control" placeholder="No / Kode laporan" style="width: 100%" <?php if (!empty($post['no_nota_keluar']) ): ?>
								value="<?php echo $post['no_nota_keluar'] ?>"
							<?php endif ?>>
					<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5">
					<input type="date" name="tgl_awal" class="form-control" placeholder="No / Kode laporan" style="width: 100%" <?php if (!empty($post['tgl_awal']) ): ?>
								value="<?php echo $post['tgl_awal'] ?>"
								<?php else: ?>
									value="<?php echo date('Y-m-d') ?>"
							<?php endif ?>>
					<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
				</div>
				<div class="col-md-5">
					<input type="date" name="tgl_akhir" class="form-control" placeholder="No / Kode laporan" style="width: 100%" <?php if (!empty($post['tgl_akhir']) ): ?>
								value="<?php echo $post['tgl_akhir'] ?>"
								<?php else: ?>
									value="<?php echo date('Y-m-d') ?>"
							<?php endif ?>>
					<small class="form-text text-muted">Tekan enter untuk melakukan pencarian</small>
				</div>
				<div class="col-md-2">
					<button type="submit" name="submit" value="submit" class="btn btn-success btn-sm w-100">Cari</button>
				</div>
			</div>
		</form>
		<div class="table-responsive">
			<table class="table" style="font-size: 13px;">
				<tr>
					<th>No</th>
					<th>Kode</th>
					<th>Produk</th>
					<th>Nama / KTP</th>
					<th>Dealer</th>
					<th>Leasing</th>
					<th>Stat Nota</th>
					<th>Stat STNK</th>
					<th></th>
				</tr>
				<?php if ($hasil == TRUE): ?>
					<?php $no = 1+$row ?>
					<?php foreach ($hasil as $data): ?>
						<tr>
							<td><?php echo $no; ?></td>
							<td><a href="<?php echo base_url('index.php/admin/penjualan/tambah/'.$data['no_nota_keluar']) ?>"><b><?php echo $data['no_nota_keluar']; ?></b></a><br/><?php echo date('d F Y',strtotime($data['tgl_jual'])); ?></td>
							</td>
							<td>
								<?php if ($data['id_produk'] !=='0' ): ?>
									<?php $getp = $this->Laporan_m->detailproduk($data['id_produk']) ?>
									<a href="<?php echo base_url('index.php/admin/penjualan/tambah/'.$data['id_nota_keluar']) ?>"><b><?php echo $getp->nm_type; ?></b></a><br/>
									<?php echo $data['no_rangka']; ?>
								<?php else: ?>
									<span class="pcoded-badge label label-warning">Belum di setting</span>
								<?php endif ?>
								
							</td>
							<td>
								<?php if ($data['nm_p_ktp'] == TRUE): ?>
									<?php echo '<b>'.$data['nm_p_ktp'].'</b><br/>'.$data['no_ktp_p']; ?>
								<?php else: ?>
									<span class="pcoded-badge label label-warning">Belum di setting</span>
								<?php endif ?>
							</td>
							
							<td>
								<?php if ($data['id_info_pt']!=='0'): ?>
									<?php $getpt = $this->Admin_m->detail_data('info_pt','id_info_pt',$data['id_info_pt']); ?>
									<?php echo substr($getpt->kode_pt,0,35).' ...' ; ?>
								<?php endif ?>
							</td>
							<td>
								<?php if ($data['id_leasing'] == '0'): ?>
									<span class="pcoded-badge label label-success">Cash</span>
								<?php else: ?>
									<b><?php echo $this->Admin_m->detail_data('leasing','id_leasing',$data['id_leasing'])->nm_leasing; ?></b>
								<?php endif ?>
							</td>
							<td>
								<?php if ($data['id_status'] == '1' ): ?>
									<span class="pcoded-badge label label-success">Di Bayar</span>
								<?php else: ?>
									<span class="pcoded-badge label label-danger">Belum Dibayar</span>
								<?php endif ?>
							</td>
							<td>
								<?php if ($data['id_status_stnk'] == '1' ): ?>
									<span class="pcoded-badge label label-success">Selesai</span>
								<?php else: ?>
									<span class="pcoded-badge label label-danger">Belum Selesai</span>
								<?php endif ?>
							</td>
							<td>
								<?php if ($data['id_status'] == '1' ): ?>
									<a href="#" class="text-secondary">Hapus</a>
								<?php else: ?>
									<a href="<?php echo base_url('index.php/admin/penjualan/delnota/'.$data['no_nota_keluar']) ?>" class="text-danger">Hapus</a>
								<?php endif ?>
							</td>
						</tr>
						<?php $no++ ?>
					<?php endforeach ?>
				<?php else: ?>
					<tr>
						<td colspan="10" align="center">Belum ada laporan hari ini.</td>
					</tr>
				<?php endif ?>
			</table>
		</div>
		<div class="row">
			<div class="col">
				<?php echo $pagination; ?>
			</div>
		</div>
	</div>
</div>