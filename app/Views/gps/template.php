<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <meta name="description" content="ManTools - GPS Tracking">
    <meta name="keyword" content="tools online, muhammad toffazal, Muhammad Toffazal, gps tracking, cara melacak orang lain, tools online gratis, melacak lokasi dengan link">
    <meta name="author" content="Muhammad Toffazal">

    <!-- Icon -->
    <link rel="shortcut icon" href="<?=base_url('public/icon.png');?>">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=base_url('public/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?=base_url('public/css/bootstrap.min.css');?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Tokyo+Zoo&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Odibee+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kelly+Slab&display=swap" rel="stylesheet">

    <!-- Fonts Awesome -->
    <link href="<?=base_url('public/font-awesome/css/all.css');?>" rel="stylesheet">

    <!-- Wow JS -->
    <link href="https://dl.dropbox.com/s/dy890pni7k045na/animate.css?dl=0" rel="stylesheet" type="text/css">

    <title><?=$title;?></title>
  </head>

  <style>
    .kotak
    {
      border-top:5px solid #B0C4DE !important; 
      border-bottom:5px solid #B0C4DE !important;
      margin-top:10px;
      padding:0px;
      text-align:center;
    }

    .judul
    {
      font-family: 'Kelly Slab', cursive;
      font-weight: bold;
      font-size: 30px;
      letter-spacing: 2px;
    }

    .biru-muda
    {
      color: #4682B4;
    }


    .biru-tua
    {
      color: #00008B;
    }

    .bg-muda
    {
      background: #4682B4;
    }

    .bg-tua
    {
      background: #00008B;
    }

    .box
    {
      width: 100%;
      border: 1px solid lightgray;
      box-shadow: 3px 3px 10px lightgray;
      border-radius: 5px;
    }
    
  </style>

  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
        <button style="color: #00008B;" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon text-primary"></span>
        </button>
    <a style="color: #00008B;" class="navbar-brand judul mx-0" href="<?=base_url();?>">ManTools <img src="<?=base_url('public/logo.png');?>" width="50px" height="50px" style="vertical-align: bottom;"></a>

    <img class="d-sm-none mx-0" src="<?=base_url('public/icon.png');?>" style="width:48px; height:48px; border-radius:100%;">

      <?= $this->renderSection('nav'); ?>
    
    <img class="d-none d-md-block mx-0" src="<?=base_url('public/icon.png');?>" style="width:48px; height:48px; border-radius:100%;">
  </div>
</nav>

    <?= $this->renderSection('content'); ?>

<br><br>
    <div class="py-3" style="background:#4682B4;">
       <p class="m-0 text-white" align="center">&copy; 2022, ManTools <br> All Rights Reserved.</p> 
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="<?=base_url('public/js/bootstrap.bundle.min.js');?>"></script>
    <script type="text/javascript" src="<?=base_url('public/js/jquery.js');?>"></script>

    <script type="text/javascript" src="<?=base_url('public/search/search.js');?>"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('table.search-table').tableSearch({
          searchPlaceHolder:'Search...'
        });
      });
    </script>

    <!-- WOW JS -->
    <script src="https://dl.dropbox.com/s/kqyr5w7ia2q7fkb/wow.js?dl=0" type="text/javascript"></script>
<script>new WOW().init();</script>

  </body>
</html>