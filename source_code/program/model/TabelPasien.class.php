<?php

/******************************************
Asisten Pemrogaman 11
 ******************************************/

class TabelPasien extends DB
{
	function getPasien()
	{
		// Query mysql select data pasien
		$query = "SELECT * FROM pasien";
		// Mengeksekusi query
		return $this->execute($query);
	}

	function addDataPasien($data)
	{
		$id = $data['id'];
		$nik = $data['nik'];
		$nama = $data['nama'];
		$tempat = $data['tempat'];
		$ttl = $data['tl'];
		$gender = $data['gender'];
		$email = $data['email'];
		$phone = $data['telp'];

		// Query untuk menambahkan data pasien kedalam db
		$query = "INSERT INTO pasien VALUES ('','$nik', '$nama','$tempat', '$ttl', '$gender', '$email', '$phone')";

		// Eksekusi query
		return $this->execute($query);
	}

	function deleteDataPasien($id)
	{
		// Query untuk menghapus data pasien berdasarkan id yang dipilih
		$query = "DELETE FROM pasien WHERE id = '$id'";

		// Eksekusi query
		return $this->execute($query);
	}

	function updateDataPasien($data)
	{
		$id = $data['id'];
		$nik = $data['nik'];
		$nama = $data['nama'];
		$tempat = $data['tempat'];
		$ttl = $data['tl'];
		$gender = $data['gender'];
		$email = $data['email'];
		$phone = $data['telp'];

		// Query untuk mengubah data pasien dimana diambil dari id data yang dipilih
		$query = "UPDATE pasien SET nik = '$nik', nama = '$nama', tempat = '$tempat', tl = '$ttl', gender = '$gender', email = '$email', telp = '$phone' WHERE id = '$id'";

		// Eksekusi query
		return $this->execute($query);
	}
}
