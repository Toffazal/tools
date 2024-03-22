<?= $this->extend('quotes/template'); ?>

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

  <h1 class="text-primary" style="font-size: 45px; font-family: 'Odibee Sans', cursive;" align="center"><i class="fas fa-quote-left biru-muda"></i> QUOTES MAKER <i class="fas fa-quote-right biru-muda"></i></h1>
 <br>

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

 <div class="box px-3 py-4 mb-5 ms-0">

<form action="" method="post" enctype="multipart/form-data">
  <div class="row">
  <div class="col-lg-6">

  <label for="quotes" class="form-label ms-1 mt-4 text-primary">QUOTES</label>
    <textarea id="quotes" name="quotes" type="text" class="form-control <?= ($validation->hasError('quotes')) ? 'is-invalid' : ''; ?>" style="border-radius: 5px; font-size: 17px;" rows="5" required></textarea>
    <div class="invalid-feedback">
        <?= $validation->getError('quotes'); ?>
    </div>
  </div>

  <div class="col-lg-6">
  <label for="nama" class="form-label ms-1 mt-4 text-primary">NAMA</label>
    <input id="nama" name="nama" type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : ''; ?>" style="border-radius: 30px; font-size: 17px;" required>
    <div class="invalid-feedback">
        <?= $validation->getError('nama'); ?>
    </div>

  <label for="formFile" class="form-label px-2 mt-4 bg-white text-primary" style="border-radius: 10px;">GAMBAR</label>
      <input id="formFile" name="gambar" type="file" class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" style="border-radius: 30px; font-size: 17px;">
    <div class="invalid-feedback">
        <?= $validation->getError('gambar'); ?>
    </div>
  </div>
</div>



<!-- HP -->
<button class="btn bg-muda text-white mx-1 mb-3 mt-4 d-md-none" style="border-radius: 30px; width: 98%;" type="submit" name="submit">Buat Quotes</button>

<!-- Dekstop -->
<button class="btn bg-muda text-white mx-2 mt-4 d-none d-md-inline-block" style="border-radius: 30px; width: 48%;" type="submit" name="submit">Buat Quotes</button>
 </div>
</div>
</form>

 <?php if(isset($_POST['submit'])) { 

  $quotes = $_POST['quotes'];
  $nama = $_POST['nama'];
  
  $ekstensi_diperbolehkan = array('png','jpg');
  $gambar = $_FILES['gambar']['name'];
  $x = explode('.', $gambar);
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['gambar']['tmp_name'];

  if ($gambar)
  {

    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true)
    {
    move_uploaded_file($file_tmp, 'public/quotes/'.$gambar);
    }else{
      $gambar = "";
    }

  }

  ?>
  

<center>           
  <div id="tes" class="mb-0" style="width: 370px; height: 550px; background-image: url('<?= base_url("public/quotes/$gambar"); ?>'); background-size: cover;">
    <div style="background-color:rgba(0, 0, 0, 0.3); width: 100%; height: 100%;">
      <p class="text-white mx-2 fs-5" style="position: relative; top: 220px;"><?= $quotes; ?></p>
      <p class="text-white" style="position: relative; top: 400px; filter: brightness(0.9);">&copy; <?= $nama; ?></p>
    </div>
  </div> 
  <button id="download" type="button" class="btn btn-primary mt-3">Download</button> 
  <div id="previewImg" class="d-none"></div>
</center> 

<?php } ?>

<script type="text/javascript">
  $(document).ready(function () {
    $("#download").on('click', function () {
      html2canvas(document.getElementById("tes")).then(function (canvas) {
      var anchorTag = document.createElement("a");
      document.body.appendChild(anchorTag);
      document.getElementById("previewImg").appendChild(canvas);
      anchorTag.download = "quotes.jpg";
      anchorTag.href = canvas.toDataURL();
      anchorTag.target = '_blank';
      anchorTag.click();
      });
    });
  });
</script>

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