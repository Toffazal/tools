<?php

namespace App\Models;

use CodeIgniter\Model;

class historyGps extends Model
{

  protected $table = 'historygps';
  protected $allowedFields = ['id', 'uid', 'judul', 'latitude', 'longitude', 'tanggal'];


}