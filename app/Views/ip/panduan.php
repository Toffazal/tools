
<?= $this->extend('gps/template'); ?>

<?= $this->section('nav'); ?>
<div class="collapse navbar-collapse ms-5" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?=base_url();?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?=base_url('akun');?>">Akun</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tools
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php foreach($tools as $d) { ?>
            <li><a class="dropdown-item" href="<?=base_url($d->slug);?>"><?=$d->nama;?></a></li>
          <?php } ?>
          </ul>
        </li>
        <?php if(session()->get('status') == 'admin') { ?>
          <li class="nav-item">
            <a class="nav-link" href="<?=base_url('aktivasi');?>">Aktivasi</a>
          </li>
        <?php } ?>
        <?php if(session()->get('status') == 'admin') { ?>
          <li class="nav-item">
            <button type="button" class="nav-link btn" data-bs-toggle="modal" data-bs-target="#tambahTools">
              +Tools
            </button>
          </li>
        <?php } ?>
        <?php if(session()->has('email')) { ?>
          <li class="nav-item">
            <a class="nav-link text-danger" href="<?=base_url('logout');?>">Logout</a>
          </li>
        <?php } ?>
      </ul>
    </div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<br>

<div class="container-fluid">

  <h1 class="text-primary" style="font-size: 45px; font-family: 'Odibee Sans', cursive;" align="center"><i class="fas fa-book biru-muda"></i> PANDUAN GPS TRACKING</h1>
  <br>

  <img src="<?= base_url('public/foto/contoh.png'); ?>" class="mb-5" style="max-width: 100%; cursor: pointer;" onclick='document.location.href = "<?=base_url('public/foto/contoh.png');?>"'>

  <li class="mb-2">(judul) adalah teks yang akan ditampilkan dibagian judul linknya nanti</li>
  <li class="mb-2">(Deskripsi) adalah teks yang akan menjelaskan website kita ke target, buat semenarik mungkin untuk memancing target meng-klik target kita</li>
  <li class="mb-2">(Icon) adalah gambar preview yang akan dilihat target saat meng-klik link, gunakan gambar yang sesuai judul dan yang menarik</li>
  <li class="mb-2">(Redirect) adalah, saat korban meng-klik link gps kitamaka korban akan doiarahkan kemana, Misal : jika diisi https://google.com maka saat korban meng-klik link yang kita kirim, maka otomatis korban akan diarahkan ke google</li>

<br>

  <p class="mb-2">Cara Penggunaan :</p>
  <li class="mb-2">Buat link yang akan kalian bagikan ke user (isi form yang tersedia)</li>
  <li class="mb-2">Setelah link dibuat, klik & tahan tombol "link" yang ada di kolom action, lalu "copy link address/Salin URL"</li>
  <li class="mb-2">Setelah disalin, ada baiknya jika linknya kita persingkat dulu di <a href="https://bit.ly" target="_blank" style="text-decoration: none;">Bit.Ly</a> agar target tidak curiga</li>
  <li class="mb-2">Bagikan link yang telah dipersingkat ke target</li>
  <li class="mb-2">Saat target sudah mengklik link yang kita bagikan, browser target akan meminta izin untuk mengakses lokasi, jika target meng-klik "izinkan" maka lokasi taget akan terkirim dan bisa dilihat di tabel HISTORY, tapi jika target meng-klik "tolak" maka lokasi target tidak akan dikirim :(</li>
  <li class="mb-2">Jadi tergantung kitanya lagi bagaimana cara memanipulasi target agar mengizinkan akses lokasi diperangkatnya dengan embel-embel tertentu. </li>

  <br>

  <p>Cara Melihat lokasi di google maps</p>
  <li class="mb-2">Silakan anda buka <a href="https://maps.google.com" target="_blank" style="text-decoration: none;">maps.google.com</a></li>
  <img src="<?= base_url('public/foto/lat-long.png'); ?>" class="mb-2" style="max-width: 100%; cursor: pointer;" onclick='document.location.href = "<?=base_url('public/foto/lat-long.png');?>"'>
  <li class="mb-2">Silakan anda salin "latitude" dan "longitude" yang ada di tabel history</li>
  <img src="<?= base_url('public/foto/maps.png'); ?>" class="mb-2" style="max-width: 100%; cursor: pointer;" onclick='document.location.href = "<?=base_url('public/foto/maps.png');?>"'>
  <li class="mb-2">Masukkan Latitude dan Longitude nya kolom percarian, (latitude)[spasi](Longitude)</li>
  <li class="mb-2">[ENTER] maka akan tampil lokasi akurat dari korban.</li>

  <br>

  <p>Informasi User</p>
  <li class="mb-2">Untuk User biasa, hanya bisa menyimpan 3 history, untuk history selanjutnya masih tetap tersimpan tapi tidak bisa dilihat sebelum upgrade akun ke VIP</li>
  <li class="mb-2">Untuk User biasa, history tidak bisa dihapus jadi jika sudah penuh (3 history) maka tidak bisa ditambah lagi</li>
  <li class="mb-2">Untuk User VIP, history bebas tanpa batas dan bisa dihapus apabila sudah tidak dipakai</li>


</div>


<!-- Modal -->
<div class="modal fade" id="tambahTools" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Tools</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form method="POST" action="<?= base_url('home/tambahTools'); ?>">
      <div class="modal-body">

            <label>Nama Tools</label>
            <input name="nama" type="text" class="form-control" required>

            <br>

            <label>Fontawesome</label>
            <input name="icon" type="text" class="form-control" required>
   
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-primary" id="simpanKonfimasi">Tambah</button>
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>


<?= $this->endSection(); ?>