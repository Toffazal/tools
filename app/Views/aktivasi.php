<?= $this->extend('template'); ?>

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
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tools
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php foreach($tools as $d) { ?>
            <li><a class="dropdown-item" href="<?=base_url($d->slug);?>"><?=$d->nama;?></a></li>
          <?php } ?>
          </ul>
        </li>
          <li class="nav-item">
            <a class="nav-link active" href="<?=base_url('aktivasi');?>">Aktivasi</a>
          </li>
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

  <h1 class="text-primary text-center" style="font-family: arial;">USER TERDAFTAR</h1>

  <table class="table table-bordered table-hover search-table">
  <thead style="background: #E6E6FA;">
    <tr>
      <th scope="col" style="text-align: center; vertical-align: middle;">No</th>
      <th scope="col" style="text-align: center; vertical-align: middle;"><i class="fas fa-user text-primary"></i> Nama</th>
      <th scope="col" style="text-align: center; vertical-align: middle;"><i class="fas fa-user-cog text-danger"></i> Status</th>
      <th scope="col" style="text-align: center; vertical-align: middle;"><i class="fas fa-cogs"></i> Pengaturan</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach($data as $d) { ?>
    <tr style="text-transform:capitalize;">
      <td style="text-align: center; vertical-align: middle;"><?= $i++; ?></td>
      <td style="vertical-align: middle;"><?= $d->nama; ?></td>
      <td style="text-align: center; vertical-align: middle;"><?= $d->status; ?></td>
      <td style="text-align: center; vertical-align: middle;">
        <?php if($d->status == 'off'){ ?>
        <a href="<?= base_url('aktivasi/'.$d->id); ?>" title="Aktivasi" class="fas fa-check text-success mx-1" style="text-decoration: none;" onclick="return confirm('Aktivasi akun?');"></a> 
        <?php } ?>

          <?php if($d->status == 'user'){ ?>
        <a href="<?= base_url('upgrade/'.$d->id); ?>" title="Upgrade" class="fas fa-arrow-up text-success mx-1" style="text-decoration: none;" onclick="return confirm('Upgrade akun?');"></a> 
        <?php } ?>

        <?php if($d->status == 'vip'){ ?>
        <a href="<?= base_url('downgrade/'.$d->id); ?>" title="Downgrade" class="fas fa-arrow-down text-success mx-1" style="text-decoration: none;" onclick="return confirm('Downgrade akun?');"></a> 
        <?php } ?>
        <a href="<?= base_url('hapusAkun/'.$d->id); ?>" onclick="return confirm('Lanjutkan menghapus data?');" title="Hapus akun" class="fas fa-trash text-danger mx-1" style="text-decoration: none;"></a>
      </td>
    </tr>
  <?php } ?>
  </tbody>
</table>

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