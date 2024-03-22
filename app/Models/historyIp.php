<?php

namespace App\Models;

use CodeIgniter\Model;

class historyIp extends Model
{

  protected $table = 'historyip';
  protected $allowedFields = ['id', 'uid', 'judul', 'ip', 'tanggal'];


}