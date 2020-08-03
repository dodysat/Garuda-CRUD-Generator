### Garuda CRUD Generator

Garuda CRUD Generator adalah CRUD Generator Untuk Framework Codeigniter 3, Library Datatables Serverside Untuk Menampilkan Data Dan Template AdminLTE.
CRUD Generator Yang Saya Gunakan Adalah Harviacode Yang Sudah Dimodifikasi Agar Hasil Generate Filenya Sesuai Dengan AdminLTE.

### Cara Install & Setup

1. silahkan clone atau download repository ini
2. silahkan extrack dan rename nama folder menjadi garuda_crud_generator
3. rename `.env.example` menjadi `.env`
4. buat sebuah database baru dengan nama garuda_crud_generator lalu import file garuda_crud_generator.sql
5. pastikan perangkat anda terinstall [composer](https://getcomposer.org)
6. jalankan `composer install` untuk menginstall semua dependensi
7. buka web browser dan masukan http://localhost/garuda_crud_generator/ pada address bar.

### Autentikasi

Untuk melakukan proses login silahkan gunakan akun default berikut :<br>
Email : admin@admin.com<br>
Password : password

## Fitur Fitur :

### 1. Dropdown Dinamis

Fungsi ini digunaan untuk membuat dropdown dinamis dengan data yang berasal dari database, cara penggunaan :<br>
`<?php echo cmb_dinamis(NamaElement,NamaTabel,NamaField,PrimaryKey,DefaultValue);?>`<br>
Contoh : <br>
`<?php echo datalist_dinamis('cmb_kelas','tbl_kelas','nama_kelas','id_kelas',5) ?>`

### 2. Datalist Dinamis

Fungsi ini digunaan untuk membuat datalist dinamis dengan data yang berasal dari database, cara penggunaan :<br>
`<?php echo datalist_dinamis(NamaElement,NamaTabel,NamaField,DefaultValue);?>`<br>
Contoh : <br>
`<?php echo datalist_dinamis('ListUser','tbl_users','nama_lengkap') ?>`

### 3.Select Select Dinamis

Fungsi ini digunaan untuk membuat select2 dinamis dengan data yang berasal dari database, cara penggunaan :<br>
`<?php echo select2_dinamis(NamaElement,NamaTabel,NamaField,PlaceHolder);?>`<br>
Contoh : <br>
`<?php echo select2_dinamis('ListUser','tbl_users','nama_lengkap','Masukan Nama Users') ?>`

### Credit To :

1. [Harviacode ](http://harviacode.com/)
2. [AdminLTE](https://adminlte.io/)
