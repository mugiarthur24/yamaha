<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<b>Edit Type</b>
				<span class="text-muted">Edit Type Produk</span>
			</div>
			<div class="card-body">
				<form action="<?php echo base_url('index.php/admin/type/update/'.$hasil->id_type) ?>" method="post">
					<div class="form-group">
						<label for="nm_type">Nama Type</label>
						<input type="text" class="form-control" name="nm_type" id="nm_type" placeholder="Nama type" value="<?php echo $hasil->nm_type ?>">
						<small id="nm_type" class="form-text text-muted">Semua type karakter (Huruf, Angka dan simbol) Dapat digunakan</small>
					</div>
					<div class="form-group">
						<label for="kode_type">Kode Type</label>
						<input type="text" class="form-control" name="kode_type" id="kode_type" placeholder="Kode type" value="<?php echo $hasil->kode_type ?>">
						<small id="kode_type" class="form-text text-muted">Hanya dapat menggunakan gabungan angka dan huruf</small>
					</div>
					<div class="form-group">
						<label for="nm_type">Jenis</label>
						<select class="form-control" name="id_jenis">
							<option value="<?php echo $hasil->id_jenis ?>">--<?php echo $this->Admin_m->detail_data('jenis','id_jenis',$hasil->id_jenis)->nm_jenis; ?>--</option>
							<?php foreach ($jenis as $jns): ?>
								<option value="<?php echo $jns->id_jenis ?>"><?php echo $jns->nm_jenis ?></option>
							<?php endforeach ?>
						</select>
						<small id="nm_type" class="form-text text-muted">Semua type karakter (Huruf, Angka dan simbol) Dapat digunakan</small>
					</div>
					<div class="form-group">
						<label for="nm_type">Merk</label>
						<select class="form-control" name="id_merk">
							<option value="<?php echo $hasil->id_merk ?>">--<?php echo $this->Admin_m->detail_data('merk','id_merk',$hasil->id_merk)->nm_merk; ?>--</option>
							<?php foreach ($merk as $mrk): ?>
								<option value="<?php echo $mrk->id_merk ?>"><?php echo $mrk->nm_merk ?></option>
							<?php endforeach ?>
						</select>
						<small id="nm_type" class="form-text text-muted">Semua type karakter (Huruf, Angka dan simbol) Dapat digunakan</small>
					</div>
					<div class="form-group">
						<label for="ket_type">Keterangan Type</label>
						<textarea class="form-control" name="ket_type" placeholder="Masukan Keterangan"><?php echo $hasil->ket_type; ?></textarea>
						<small id="ket_type" class="form-text text-muted">Deskripsi type, maksimal 144 karakter.</small>
					</div>
					<button class="btn btn-grd-success btn-sm float-right">Simpan</button>
					
				</form>
			</div>
		</div>
	</div>
</div>