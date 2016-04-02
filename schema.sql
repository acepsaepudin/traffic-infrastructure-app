DROP TABLE IF EXISTS kategori;
create table kategori(
    id int(11) not null auto_increment,
    nama_kategori varchar(200),
    karyawan_id_karyawan int(11),
    primary key(id));

DROP TABLE IF EXISTS karyawan;
create table karyawan(
    id int(11) not null auto_increment,
    nama varchar(200),
    alamat varchar(200),
    notlpn varchar(200),
    jenis_kelamin int(1),
    email varchar(200),
    jabatan varchar(200),
    primary key(id)
);
