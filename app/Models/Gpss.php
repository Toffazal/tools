<?php

namespace App\Models;

use CodeIgniter\Model;

class Gpss extends Model
{

  protected $table = 'gps';
  protected $allowedFields = ['id', 'uid', 'judul', 'deskripsi', 'redirect', 'icon'];


}