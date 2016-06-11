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

DROP TABLE IF EXISTS prasarana;
create table prasarana(
    id int(11) not null auto_increment,
    nama varchar(200),
    lokasi varchar(200),
    longitude varchar(200),
    latitude varchar(200),
    kategori_id_kategori int(11),
    primary key(id),
    constraint prasarana_kategori_fk foreign key (kategori_id_kategori) references kategori(id)
);

DROP TABLE IF EXISTS users;
create table users(
    id int(11) not null auto_increment,
    nama varchar(200),
    email varchar(200),
    password varchar(200),
    token varchar(200),
    primary key(id)
);
