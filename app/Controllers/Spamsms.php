<?php

namespace App\Controllers;
use \App\Models\User;
use \App\Models\Tools;

class Spamsms extends BaseController
{
	protected $User;
  protected $Tools;

  public function __construct()
  {
    $this->User = new User;
    $this->Tools = new Tools;
  }

  public function index()
  {
    if(!session()->has('email'))
    {
      session()->setFlashdata('danied', 'Anda belum Login.');
      return redirect()->to(base_url('login'));
    }

    if(session()->get('status') == 'off')
    {
      session()->setFlashdata('danied', 'Akun anda belum diaktivasi!');
      return redirect()->to(base_url());
    }


  	$data = [
  		'title' => 'Spam SMS',
      'user'  => $this->User->where('email', session()->get('email'))->first(),
      'validation' => \Config\Services::validation(),
      'tools' => $this->Tools->findAll()
    ];

    return view('spamsms/index', $data);
  }





  public function logout()
  {
    if(!session()->has('email'))
    {
      session()->setFlashdata('danied', 'Anda belum Login.');
      return redirect()->to(base_url('admin/login'));
    }

    session()->remove('email');
    session()->remove('status');
    session()->setFlashdata('pesan', 'Anda telah logout.');
    return redirect()->to(base_url('login'));
  }


}



  