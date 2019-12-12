<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-3.2.1.min.js') ?>"></script>
<div class="card">
	<div class="card-header">
		<b>Buat Perusahaan Baru</b>
		<span class="text-muted">Form pengisian informasi dasar perusahaan baru</span>
	</div>
	<div class="card-body">
		<form action="<?php echo base_url('index.php/admin/setting/create') ?>" method="post" enctype="multipart/form-data">
			<div class="media">
				<img id="preview" class="align-self-center mr-3 rounded-circle border border-info" src="<?php echo base_url('assets/img/lembaga/default.png') ?>" width="50px" alt="lgo dasar perusahan">
				<div class="media-body">
					<h5 class="mt-0">Logo Perusahaan</h5>
					<div class="custom-file">
						<input type="file" name="logopt" id="uploadBtn" lang="es">
					</div>
				</div>
			</div><hr/>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<label for="nama_info_pt">Nama Perusahaan</label>
						<input type="text" class="form-control" name="nama_info_pt" id="nama_info_pt" aria-describedby="nama_info_pt" placeholder="Nama Perusahaan" >
						<small id="nama_menu" class="form-text text-muted">Semua jenis karakter (Huruf, Angka dan simbol) Dapat digunakan</small>
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label for="kode_pt">Daerah Perusahaan</label>
						<input type="text" class="form-control" name="kode_pt" id="kode_pt" aria-describedby="kode_pt" placeholder="Daerah Perusahaan" >
						<small id="kode_pt" class="form-text text-muted">Semua jenis karakter (Huruf, Angka dan simbol) Dapat digunakan</small>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="slogan">Slogan Perusahaan</label>
				<input type="text" class="form-control" name="slogan" id="slogan" aria-describedby="slogan" placeholder="Slogan Perusahaan" >
				<small id="slogan" class="form-text text-muted">Penulisan slogan maksimal 144 karakter</small>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<label for="kontak_1">Kontak 1</label>
						<input type="text" class="form-control" name="kontak_1" id="kontak_1" aria-describedby="kontak_1" placeholder="Nomor yang dapat dihubungi" >
						<small id="kontak_1" class="form-text text-muted">hanya boleh menggunakan angka</small>
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label for="kontak_2">Kontak 2</label>
						<input type="text" class="form-control" name="kontak_2" id="kontak_2" aria-describedby="kontak_2" placeholder="Nomor yang dapat dihubungi" >
						<small id="kontak_2" class="form-text text-muted">hanya boleh menggunakan angka</small>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="form-group">
						<label for="kontak_3">Kontak 3</label>
						<input type="text" class="form-control" name="kontak_3" id="kontak_3" aria-describedby="kontak_3" placeholder="Nomor yang dapat dihubungi" >
						<small id="kontak_3" class="form-text text-muted">hanya boleh menggunakan angka</small>
					</div>
				</div>
				<div class="col">
					<div class="form-group">
						<label for="kontak_4">Kontak 4</label>
						<input type="text" class="form-control" name="kontak_4" id="kontak_4" aria-describedby="kontak_4" placeholder="Nomor yang dapat dihubungi" >
						<small id="kontak_4" class="form-text text-muted">hanya boleh menggunakan angka</small>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="alamat_pt">Alamat Perusahaan</label>
				<textarea name="alamat_pt" class="form-control"></textarea>
				<small id="alamat_pt" class="form-text text-muted">Semua jenis karakter (Huruf, Angka dan simbol) Dapat digunakan</small>
			</div><hr/>
			<button type="submit" name="submit" value="submit" class="btn btn-success">Simpan</button>
		</form>
	</div>
</div>
<script type="text/javascript">
	document.getElementById("uploadBtn").onchange = function () {
		document.getElementById("uploadFile").value = this.value;
	};
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#preview').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#uploadBtn").change(function(){
		readURL(this);
	});
</script>