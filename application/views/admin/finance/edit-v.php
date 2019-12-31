<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<b>Edit Finance</b>
				<span class="text-muted">Edit Data Finance</span>
			</div>
			<div class="card-body">
				<form action="<?php echo base_url('index.php/admin/leasing/update/'.$hasil->id_leasing) ?>" method="post">
					<div class="form-group">
						<label for="kode_leasing">Kode Finance</label>
						<input type="text" class="form-control" name="kode_leasing" id="kode_leasing" placeholder="Kode Leasing" value="<?php echo $hasil->kode_leasing ?>">
						<small id="kode_leasing" class="form-text text-muted">Hanya dapat menggunakan gabungan angka dan huruf</small>
					</div>
					<div class="form-group">
						<label for="nm_leasing">Nama Finance</label>
						<input type="text" class="form-control" name="nm_leasing" id="nm_leasing" placeholder="Nama Finance" value="<?php echo $hasil->nm_leasing ?>">
						<small id="nm_leasing" class="form-text text-muted">Semua jenis karakter (Huruf, Angka dan simbol) Dapat digunakan</small>
					</div>
					<div class="form-group">
						<label for="area">Area</label>
						<input type="text" class="form-control" name="area" id="area" placeholder="Area" value="<?php echo $hasil->area ?>">
						<small id="area" class="form-text text-muted">Hanya dapat menggunakan gabungan angka dan huruf</small>
					</div>
					<div class="form-group">
						<label for="ket_leasing">Keterangan</label>
						<textarea class="form-control" name="ket_leasing" placeholder="Masukan Keterangan"><?php echo $hasil->ket_leasing; ?></textarea>
						<small id="ket_leasing" class="form-text text-muted">Deskripsi , maksimal 144 karakter.</small>
					</div>
					<button class="btn btn-grd-success btn-sm float-right">Simpan</button>
					
				</form>
			</div>
		</div>
	</div>
</div>