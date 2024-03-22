<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{

  protected $table = 'user';
  protected $allowedFields = ['nama', 'email', 'password', 'icon', 'status'];


public function getAkun($id = false)
  {
  	if($id == false){
  		return $this->findAll();
  	}

  	return $this->where(['id' => $id])->first();
  }


}