<?php


include("KontrakView.php");
include("presenter/ProsesPasien.php");

class TampilPasien implements KontrakView
{
	private $prosespasien; //presenter yang dapat berinteraksi langsung dengan view
	private $tpl;

	function __construct()
	{
		//konstruktor
		$this->prosespasien = new ProsesPasien();
	}

	function tampil()
	{
		$this->prosespasien->prosesDataPasien();
		$data = null;

		//semua terkait tampilan adalah tanggung jawab view
		for ($i = 0; $i < $this->prosespasien->getSize(); $i++) {
			$no = $i + 1;
			$data .= "<tr>
			<td>" . $no . "</td>
			<td>" . $this->prosespasien->getNik($i) . "</td>
			<td>" . $this->prosespasien->getNama($i) . "</td>
			<td>" . $this->prosespasien->getTempat($i) . "</td>
			<td>" . $this->prosespasien->getTl($i) . "</td>
			<td>" . $this->prosespasien->getGender($i) . "</td>
			<td>
				<a type='button' data-toggle='modal' data-target='#update-page" . $this->prosespasien->getId($i) . "'' class='btn btn-dark' style='color:#FFFFFF'>Ubah</a>
				<a href='index.php?delete_id=" . $this->prosespasien->getId($i) . "' class='btn btn-danger'>Hapus</a>
			</td>
			</tr>";
			
			$data .= '<div
			class="modal fade"
			id="update-page' . $this->prosespasien->getId($i) .'"
			tabindex="-1"
			role="dialog"
			aria-labelledby="exampleUpdatePage"
			aria-hidden="true"
		  >
			<div class="modal-dialog" role="document">
			  <div class="modal-content" bg-light>
				<div class="modal-header">
				  <h5 class="modal-title" id="exampleUpdatePage" bg-dark>
					Update Data Pasien
				  </h5>
				  <button
					type="button"
					class="close"
					data-dismiss="modal"
					aria-label="Close"
				  >
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>
				<div class="modal-body">
				  
				  <form action="index.php" method="POST" id="form-update ' . $this->prosespasien->getId($i) .'">
					<div class="form-group">
					<input type="hidden" name="id" value="' . $this->prosespasien->getId($i) . '" class="form-control" />
					  <label for="nik">NIK</label>
					  <input
						required
						type="text"
						class="form-control"
						name="nik"
						value="' . $this->prosespasien->getNik($i) . '"
					  />
					</div>
					<div class="form-group">
					  <label for="nama">Nama</label>
					  <input
						required
						type="text"
						class="form-control"
						name="nama"
						value="' . $this->prosespasien->getNama($i) . '"
					  />
					</div>
					<div class="form-group">
					  <label for="tempat">Tempat</label>
					  <input
						required
						type="text"
						class="form-control"
						name="tempat"
						value="' . $this->prosespasien->getTempat($i) . '"
					  />
					</div>
					<div class="form-group">
					  <label for="tl">Tanggal Lahir</label>
					  <input
						required
						type="date"
						class="form-control"
						name="tl"
						value="' . $this->prosespasien->getTl($i) . '"
					  />
					</div>
					<div class="form-group">
					  <label for="gender">Jenis Kelamin</label>
					  <select class="form-control" name="gender">
					  <option' . ($this->prosespasien->getGender($i) == 'Laki-laki' ? ' selected' : '') . '>Laki-laki</option>
					  <option' . ($this->prosespasien->getGender($i) == 'Perempuan' ? ' selected' : '') . '>Perempuan</option>
					  </select>
					</div>
					<div class="form-group">
					  <label for="email">Alamat Email</label>
					  <input
						required
						type="email"
						class="form-control"
						name="email"
						value="' . $this->prosespasien->getEmail($i) . '"
					  />
					</div>
					<div class="form-group">
					  <label for="telepon">Telepon</label>
					  <input
						required
						type="text"
						class="form-control"
						name="telp"
						value="' . $this->prosespasien->getPhone($i) . '"
					  />
					</div>
					<div class="modal-footer">
					  <button type="button" class="btn btn-danger" data-dismiss="modal">
						Close
					  </button>
					  <button
						type="submit"
						name="update_data"
						class="btn btn-primary"
						style="color: #ffffff"
					  >
						Ubah
					  </button>
					</div>
				  </form>
				</div>
			  </div>
			</div>
		  </div>';
		}
		// Membaca template skin.html
		$this->tpl = new Template("templates/skin.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_TABEL", $data);

		// Menampilkan ke layar
		$this->tpl->write();
	}

	function addData($data)
	{
		// mengirimkan data ke model untuk ditambahkan ke database melalui metode di presenter
		$this->prosespasien->create($data);

		// mengatur tampilan setelah data ditambahkan
		header("location:index.php");
	}

	function updateData($data)
	{
		// mengirimkan data perubahan ke model untuk mengganti data yang telah ada di database melalui metode di presenter
		$this->prosespasien->update($data);

		// mengatur tampilan setelah data diubah
		header("location:index.php");
	}

	function deleteData($id)
	{
		// mengirimkan id pasien yang akan dihapus ke model melalui metode di presenter
		$this->prosespasien->delete($id);

		// mengatur tampilan setelah data dihapus
		header("location:index.php");
	}

}
