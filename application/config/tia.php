<?php
$config['status_pengguna'] = array(
	'1' => 'Admin',
	'2' => 'Masyarakat',
	'3' => 'Kepala Dinas',
	'4' => 'Pegawai Lapangan',
	'5' => 'Pegawai Kantor'
	);

$config['status_perbaikan'] = array(
	'1' => 'Menuggu Approval Kepala Dinas',
	'2' => 'Diterima',
	'3' => 'Ditolak',
	);
$config['status_perbaikan_detail'] = array(
	'1' => 'Belum Terpasang',
	'2' => 'Sudah Terpasang',
	);

$config['status_kerusakan'] = array(
	'1' => 'Kerusakan Baru',
	'2' => 'Pengecekan Tim Lapangan',
	'3' => 'Tidak Ada Kerusakan',
	'4' => 'Ada Kerusakan',
	'5' => 'Dibuat Estimasi Biaya Kerusakan',
	// '6' => 'Estimasi Ditolak',
	'6' => 'Estimasi Telah Di Approve',
	'7' => 'Perbaikan Tim Lapangan',
	'9' => 'Siap Diperbaiki',
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