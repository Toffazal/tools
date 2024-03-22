<?= $this->extend('template'); ?>

<?= $this->section('nav'); ?>
<div class="collapse navbar-collapse ms-5" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?=base_url();?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?=base_url('akun');?>">Akun</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tools
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php foreach($data as $d) { ?>
            <li><a class="dropdown-item" href="<?=base_url($d->slug);?>"><?=$d->nama;?></a></li>
          <?php } ?>
          </ul>
        </li>
        <?php if($user->status == 'admin') { ?>
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

  <?php if(session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
  <?= session()->getFlashdata('pesan'); ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
  <?php endif; ?>

  <?php if(session()->getFlashdata('danied')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <?= session()->getFlashdata('danied'); ?>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
  <?php endif; ?>

<?php if($user->status =='off') { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    Akun kamu belum diaktivasi, <a href="https://api.whatsapp.com/send/?phone=6289613325456&text=Hai min, tolong validasi akun <?=$user->email;?>" target="_blank" style="text-decoration:none;">KLIK DISINI</a> untuk aktivasi akun
  </div>
<?php } ?>

<center>
    <div class="row">
<?php foreach($data as $d) { ?>
<div class="col-lg-3">
<a href="<?=base_url($d->slug);?>">
<div class="chart bg-light mx-2 mb-2 py-2">
  <h3 class="ms-0 me-3 my-3 text-start d-inline-block bold" style="vertical-align: middle;"><?=$d->nama;?></h3>
  <i class="<?=$d->icon;?> fa-3x d-inline-block biru-muda" style="vertical-align: middle;"></i>
</div>
</a>
</div>
<?php } ?>
</div>
</center>

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