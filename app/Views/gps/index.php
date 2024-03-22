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

  <h1 class="text-primary" style="font-size: 45px; font-family: 'Odibee Sans', cursive;" align="center"><i class="fas fa-map-marked-alt biru-muda"></i> GPS TRACKING</h1>
 <br>

 <div class="box px-3 py-4 mb-5 ms-0">

<form method="post" action="<?=base_url('gps/buatLink');?>" enctype="multipart/form-data">
  <?= csrf_field(); ?>

  <div class="row">
  <div class="col-lg-6">
  <label for="judul" class="form-label ms-1 text-primary">JUDUL</label>
    <input id="judul" name="judul" type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" style="border-radius: 30px; font-size: 17px;">
    <div class="invalid-feedback">
        <?= $validation->getError('judul'); ?>
    </div>

  <label for="deskripsi" class="form-label ms-1 mt-4 text-primary">DESKRIPSI</label>
    <textarea id="deskripsi" name="deskripsi" type="text" class="form-control <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : ''; ?>" style="border-radius: 5px; font-size: 17px;" rows="3"></textarea>
    <div class="invalid-feedback">
        <?= $validation->getError('deskripsi'); ?>
    </div>
  </div>

  <div class="col-lg-6">
  <label for="redirect" class="form-label ms-1 mt-4 text-primary">REDIRECT TO</label>
    <input id="redirect" name="redirect" type="text" placeholder="gunakan http:// atau https://" class="form-control <?= ($validation->hasError('redirect')) ? 'is-invalid' : ''; ?>" style="border-radius: 30px; font-size: 17px;">
    <div class="invalid-feedback">
        <?= $validation->getError('redirect'); ?>
    </div>

  <label for="formFile" class="form-label px-2 mt-4 bg-white text-primary" style="border-radius: 10px;">ICON<small class="biru-muda"> (max 500kb)</small></label>
      <input id="formFile" name="icon" type="file" class="form-control <?= ($validation->hasError('icon')) ? 'is-invalid' : ''; ?>" style="border-radius: 30px; font-size: 17px;">
    <div class="invalid-feedback">
        <?= $validation->getError('icon'); ?>
    </div>
  </div>

</div>

<!-- HP -->
<button class="btn bg-muda text-white mx-1 mb-3 mt-4 d-md-none" style="border-radius: 30px; width: 98%;" type="submit" onclick="return confirm('Tambah data?');">+Buat Link</button>
<center>
<a class="biru-muda d-md-none" style="text-decoration: none;" href=""><i class="fas fa-book biru-muda"></i> Baca Panduan Pengguna</a>
</center>

<!-- Dekstop -->
<button class="btn bg-muda text-white mx-2 mt-4 d-none d-md-inline-block" style="border-radius: 30px; width: 48%;" type="submit">+Buat Link</button>
<a href="<?=base_url('gps/panduan');?>" class="ms-2 mt-4 me-2 biru-muda d-none d-md-inline-block float-end" style="text-decoration: none;" href=""><i class="fas fa-book biru-muda"></i> Baca Panduan Pengguna</a>

</form>
 </div>



<?php if(session()->getFlashdata('danied')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <?= session()->getFlashdata('danied'); ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
  <?php endif; ?>

  <?php if(session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
  <?= session()->getFlashdata('pesan'); ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
  <?php endif; ?>

<div style="max-height: 70%; overflow: auto;">
 <table class="table table-bordered table-hover search-table">
  <thead style="background: #E6E6FA;">
    <tr>
      <th scope="col" style="text-align: center;">No</th>
      <th scope="col" style="text-align: center;">Judul</th>
      <th scope="col" style="text-align: center;">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php $i=1; foreach($data as $d) { ?>
    <tr style="text-transform:capitalize;">
      <td style="text-align: center; vertical-align: middle;"><?= $i++; ?></td>
      <td style="vertical-align: middle;"><?=$d->judul;?></td>
      <td style="text-align: center; vertical-align: middle;"><a class="btn btn-success me-2" href="<?=base_url('gps/'.'/'.$d->uid.'/'.$d->judul);?>">Link</a><a class="btn btn-danger" onclick="return confirm('Hapus data?');"  href="<?=base_url('gps/hapus/'.$d->id);?>">Hapus</a></td>
    </tr>
  <?php } ?>
  </tbody>
</table>
</div>

<h5 class="text-primary mt-5">HISTORY</h5>
<small class="mt-0 text-danger"><i><?=$pesan;?></i></small>

<div class="w-100 overflow-auto" style="max-height: 70%;">
<table class="table table-bordered table-hover">
  <thead style="background: #E6E6FA;">
    <tr>
      <th scope="col" style="text-align: center;">No</th>
      <th scope="col" style="text-align: center;">Judul</th>
      <th scope="col" style="text-align: center;">Latitude</th>
      <th scope="col" style="text-align: center;">Longitude</th>
      <th scope="col" style="text-align: center;">Tanggal</th>
      <?php if($user->status == 'admin' or $user->status == 'vip') { ?>
      <th scope="col" style="text-align: center;">Action</th>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
  <?php $i=1; foreach($history as $d) { ?>
    <tr style="text-transform:capitalize;">
      <td style="text-align: center; vertical-align: middle;"><?= $i++; ?></td>
      <td style="vertical-align: middle;"><?=$d->judul;?></td>
      <td style="vertical-align: middle;"><?=$d->latitude;?></td>
      <td style="vertical-align: middle;"><?=$d->longitude;?></td>
      <td style="vertical-align: middle;"><?=$d->tanggal;?></td>
      <?php if($user->status == 'admin' or $user->status == 'vip') { ?>
      <td style="text-align: center; vertical-align: middle;"><a class="btn btn-danger" onclick="return confirm('Hapus data?');"  href="<?=base_url('gps/hapusHistory/'.$d->id);?>">Hapus</a></td>
      <?php } ?>
    </tr>
  <?php } ?>
  </tbody>
</table>
</div>

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