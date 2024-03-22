<?= $this->extend('template'); ?>

<?= $this->section('content'); ?>

<div class="container-fluid px-4">
<br><br>

<h1 class="text-primary" style="font-size: 45px; font-family: 'Odibee Sans', cursive;" align="center"><i class="fas fa-user-plus"></i> Daftar Akun</h1>

<form method="post" action="<?=base_url('home/prosesDaftar');?>">
  <?= csrf_field(); ?>

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

  <label for="nama" class="form-label mt-2 ms-1">Nama</label>
    <input id="nama" name="nama" type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" style="border-radius: 30px; font-size: 17px;">
    <div class="invalid-feedback">
        <?= $validation->getError('nama'); ?>
    </div>

    <label for="email" class="form-label mt-4 ms-1">Alamat email</label>
    <input id="email" name="email" type="text" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" style="border-radius: 30px; font-size: 17px;">
    <div class="invalid-feedback">
        <?= $validation->getError('email'); ?>
    </div>

  <label for="email" class="form-label ms-1 mt-4">Password</label>
    <input id="password" name="password" type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" style="border-radius: 30px; font-size: 17px;">
    <div class="invalid-feedback">
        <?= $validation->getError('password'); ?>
    </div>

  <a class="nav-link" href="<?=base_url('login');?>">Sudah punya akun</a>
          
  <button style="border-radius: 30px;" name="simpan" type="submit" class="btn bg-primary text-white d-block mt-4 w-100">Daftar</button>
  <br><br><br>
</form>


</div>

<?= $this->endSection(); ?>