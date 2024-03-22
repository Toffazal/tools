<?php

namespace App\Models;

use CodeIgniter\Model;

class Tools extends Model
{

  protected $table = 'tools';
  protected $allowedFields = ['slug', 'nama', 'icon'];


}