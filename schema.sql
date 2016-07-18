DROP TABLE IF EXISTS kategori;
create table kategori(
    id int(11) not null auto_increment,
    nama_kategori varchar(200),
    id_pengguna int(11),
    primary key(id));

DROP TABLE IF EXISTS pengguna;
create table pengguna(
    id int(11) not null auto_increment,
    nama varchar(200),
    alamat varchar(200),
    notlpn varchar(200),
    jenis_kelamin int(1),
    email varchar(200),
    password varchar(200),
    status varchar(200),
    token varchar(200),
    primary key(id)
);

DROP TABLE IF EXISTS prasarana;
create table prasarana(
    id int(11) not null auto_increment,
    nama varchar(200),
    lokasi varchar(200),
    longitude varchar(200),
    latitude varchar(200),
    kategori_id_kategori int(11),
    id_pengguna int(11),
    primary key(id)
);

DROP TABLE IF EXISTS kerusakan;
create table kerusakan(
    id int(11) not null auto_increment,
    tanggal datetime,
    deskripsi varchar(200),
    foto varchar(200),
    status int(1),
    id_pengguna int(11),
    id_prasarana int(11),
    primary key(id)
);

DROP TABLE IF EXISTS detail_kerusakan;
create table detail_kerusakan(
    id int(11) not null auto_increment,
    deskripsi varchar(200),
    id_kerusakan int(11),
    primary key(id)
); 

DROP TABLE IF EXISTS perbaikan;
create table perbaikan(
    id int(11) not null auto_increment,
    nama_barang varchar(200),
    harga varchar(200),
    status varchar(200),
    id_kerusakan int(11),
    primary key(id)
);

DROP TABLE IF EXISTS detail_perbaikan;
create table detail_perbaikan(
    id int(11) not null auto_increment,
    tanggal datetime,
    status varchar(200),
    feedback varchar(200),
    id_pengguna int(11),
    id_perbaikan int(11),
    primary key(id)
);

