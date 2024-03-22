<?= $this->extend('template'); ?>

<?= $this->section('nav'); ?>
<div class="collapse navbar-collapse ms-5" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?=base_url();?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?=base_url('akun');?>">Akun</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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

  <h1 class="text-primary" style="font-size: 45px; font-family: 'Odibee Sans', cursive;" align="center">Edit Akun</h1>

<br>

 <?php if(session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
  <?= session()->getFlashdata('pesan'); ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
  <?php endif; ?>

  <form method="post" action="<?=base_url('home/editAkun');?>" enctype="multipart/form-data">
  <?= csrf_field(); ?>

<?php if($data->status == 'user') { ?>
  <a href="https://api.whatsapp.com/send/?phone=6289613325456&text=Hai min, saya ingin upgrade akun <?=$data->email;?>" target="_blank" class="btn btn-success" style="text-decoration:none;">UPGRADE AKUN! 20rb Selamanya</a>
<?php } ?>

<?php if($data->status == 'off') { ?>
  <a href="https://api.whatsapp.com/send/?phone=6289613325456&text=Hai min, tolong validasi akun <?=$data->email;?>" target="_blank" class="btn btn-success" style="text-decoration:none;">AKTIVASI AKUN!</a>
<?php } ?>

<?php if($data->status == 'vip') { ?>
  <p class="btn btn-primary" style="text-decoration:none;">AKUN PREMIUM!</p>
<?php } ?>

  <br>

  <label for="nama" class="form-label mt-4 text-primary">NAMA</label>
    <input id="nama" name="nama" type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" value="<?=$data->nama;?>" style="border-radius: 30px; font-size: 17px;">
    <div class="invalid-feedback">
        <?= $validation->getError('nama'); ?>
    </div>

    <label for="email" class="form-label mt-4 text-primary">ALAMAT EMAIL</label>
    <input id="email" name="email" type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" value="<?=$data->email;?>" style="border-radius: 30px; font-size: 17px;">
    <div class="invalid-feedback">
        <?= $validation->getError('email'); ?>
    </div>

  <label for="password" class="form-label text-primary mt-4">PASSWORD</label>
    <input id="password" name="password" type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" placeholder="(Password baru)" style="border-radius: 30px; font-size: 17px;">
    <div class="invalid-feedback">
        <?= $validation->getError('password'); ?>
    </div>

          
  <button style="border-radius: 30px;" name="simpan" type="submit" class="btn btn-primary text-white w-100 mt-4" onclick="return confirm('Lanjutkan?');">Simpan</button>
  <?php if($data->status != 'admin') { ?>
  <a href="<?=base_url('home/hapusAkun/'.$data->id);?>" style="border-radius: 30px;" class="btn btn-danger w-100 mt-4" onclick="return confirm('Yakin ingin menghapus akun?');">Hapus Akun</a>
  <?php } ?>
  <br><br><br>
</form>


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