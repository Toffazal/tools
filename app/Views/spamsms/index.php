<?= $this->extend('spamsms/template'); ?>

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

  <h1 class="text-primary" style="font-size: 45px; font-family: 'Odibee Sans', cursive;" align="center"><i class="far fa-comment biru-muda"></i> SPAM SMS</h1>
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

<script type="text/javascript">

      $(document).ready(function(){
        var  heder = {'host': 'www.matahari.com',
'method': 'POST',
'path': '/rest/V1/thorCustomers',
'scheme': 'https',
'accept': '*/*',
'accept-encoding': 'gzip, deflate, br',
'accept-language': 'id,en;q=0.9,ga;q=0.8',
'content-length': '749',
'content-type': 'application/json',
'cookie: _gcl_au=1.1.1941934830.1649254077; __gtm_referrer=https%3A%2F%2Fwww.google.com%2F; _fbp=fb.1.1649254079264.1091484968; _gid=GA1.2.1129488611.1649254082; _hjFirstSeen=1; _hjIncludedInSessionSample=0; _hjSession_2742003=eyJpZCI6IjI0YjFjNmFmLWQzMDUtNGRjOS05MGRmLWJiNjZjNDhiYjljYyIsImNyZWF0ZWQiOjE2NDkyNTQwODU2NjcsImluU2FtcGxlIjpmYWxzZX0=; _hjAbsoluteSessionInProgress=0; form_key=94rpEXm7AExBmObq; mage-banners-cache-storage=%7B%7D; form_key=94rpEXm7AExBmObq; PHPSESSID=2437d5c99961186ee3d75eb755591c86; mage-cache-storage=%7B%7D; mage-cache-storage-section-invalidation=%7B%7D; mage-cache-sessid=true; recently_viewed_product=%7B%7D; recently_viewed_product_previous=%7B%7D; recently_compared_product=%7B%7D; recently_compared_product_previous=%7B%7D; product_data_storage=%7B%7D; mage-messages=; _hjSessionUser_2742003=eyJpZCI6ImRhNDFkYjkyLTVlZmQtNTIwZS05N2QxLWMwNGEyYTkwZjZjYSIsImNyZWF0ZWQiOjE2NDkyNTQwODMwMDMsImV4aXN0aW5nIjp0cnVlfQ==; _hjIncludedInPageviewSample=1; _ga=GA1.2.1338020016.1649254081; private_content_version=80f2cf992b55667e2b99577d89b1cd58; _ga_GN8DJY2FWJ=GS1.1.1649254077.1.1.1649254149.55; section_data_ids=%7B%22customer%22%3A1649254146%7D',
'origin': 'https://www.matahari.com',
'referer': 'https://www.matahari.com/customer/account/create/',
'sec-ch-ua': '" Not A;Brand";v="99", "Chromium";v="100", "Google Chrome";v="100"',
'sec-ch-ua-mobile': '?0',
'sec-ch-ua-platform': '"Windows"',
'sec-fetch-dest': 'empty',
'sec-fetch-mode': 'cors',
'sec-fetch-site': 'same-origin',
'user-agent': 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.75 Safari/537.36',
'x-newrelic-id': 'Vg4GVFVXDxAGVVlVBgcGVlY=',
'x-requested-with': 'XMLHttpRequest'}

var data = {'emailAddress': 'noobie@mail.com',
           'firstName': 'Noobie',
           'lastName': 'Gans',
           'mobileNumber': '089613325456',
           'mccCardNumber': '',
           'password': 'asecc123',
           'referralCode': '',
           'dateOfBirth': '09-05-1993',
           'gender': 'Male',
           'registrationType': 'N'}

        $.post("https://www.matahari.com/rest/V1/thorCustomers", {headers:heder, json:data});
      });

           
</script>


<?= $this->endSection(); ?>