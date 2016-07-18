<?php
$config['status_pengguna'] = array(
	'1' => 'Admin',
	'2' => 'Masyarakat',
	'3' => 'Kepala Dinas',
	'4' => 'Pegawai Lapangan',
	'5' => 'Pegawai Kantor'
	);
$config['status_kerusakan'] = array(
	'1' => 'Kerusakan Baru',
	'2' => 'Pengecekan Tim Lapangan',
	'3' => 'Tidak Ada Kerusakan',
	'4' => 'Ada Kerusakang',
	'5' => 'Estimasi Biaya Kerusakan',
	'6' => 'Estimasi Telah Di Approve',
	'7' => 'Perbaikan Tim Lapangan',
	'8' => 'Sudah Diperbaiki'
	);
/*- kerusakan baru -> petugas kantor
- pengecekan tim lapangan -> data kerusakan muncul di petugas lapangan
->> - tidak terjadi kerusakan -> data muncul di petugas kantor
--> ada kerusakan -> data muncul di petugas kantor
-> telah dibuat estimas -> data muncul di direktur
->estimasi di approve -> data muncul di petugas kantor
-> estimasi approved dan lakukan perbaikan -> muncul di petugas lapangan
-> sudah diperbaiki -> data muncul di petugas kantor & kepala dinas
*/