<div class="row">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<b>Edit Merk</b>
				<span class="text-muted">Edit Merk Produk</span>
			</div>
			<div class="card-body">
				<form action="<?php echo base_url('index.php/admin/merk/update/'.$hasil->id_merk) ?>" method="post">
					<div class="form-group">
						<label for="nm_merk">Nama Merk</label>
						<input type="text" class="form-control" name="nm_merk" id="nm_merk" placeholder="Nama merk" value="<?php echo $hasil->nm_merk ?>">
						<small id="nm_merk" class="form-text text-muted">Semua merk karakter (Huruf, Angka dan simbol) Dapat digunakan</small>
					</div>
					<div class="form-group">
						<label for="kode_merk">Kode Merk</label>
						<input type="text" class="form-control" name="kode_merk" id="kode_merk" placeholder="Kode merk" value="<?php echo $hasil->kode_merk ?>">
						<small id="kode_merk" class="form-text text-muted">Hanya dapat menggunakan gabungan angka dan huruf</small>
					</div>
					<div class="form-group">
						<label for="ket_merk">Keterangan Merk</label>
						<textarea class="form-control" name="ket_merk" placeholder="Masukan Keterangan"><?php echo $hasil->ket_merk; ?></textarea>
						<small id="ket_merk" class="form-text text-muted">Deskripsi merk, maksimal 144 karakter.</small>
					</div>
					<button class="btn btn-grd-success btn-sm float-right">Simpan</button>
					
				</form>
			</div>
		</div>
	</div>
</div>