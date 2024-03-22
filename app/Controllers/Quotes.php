<?php

namespace App\Controllers;
use \App\Models\User;
use \App\Models\Tools;

class Quotes extends BaseController
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
  		'title' => 'Quotes Maker Online',
      'user'  => $this->User->where('email', session()->get('email'))->first(),
      'validation' => \Config\Services::validation(),
      'tools' => $this->Tools->findAll()
    ];

    return view('quotes/index', $data);
  }






  public function buatLink()
  {
    if(!session()->has('email'))
    {
      session()->setFlashdata('danied', 'Anda belum Login.');
      return redirect()->to(base_url('login'));
    }

    if(session()->get('status') == 'off')
    {
      session()->setFlashdata('danied', 'Akun anda belum diaktivasi!');
      return redirect()->to(base_url('login'));
    }


    //Validasi input
    if(!$this->validate([

      'judul' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.'
        ]
      ],

      'deskripsi' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.'
        ]
      ],

      'redirect' => [
        'rules' => 'required',
        'errors' => [
          'required' => '{field} harus diisi.'
        ]
      ],

      'icon' => [
        'rules' => 'uploaded[icon]|max_size[icon,500]|is_image[icon]|mime_in[icon,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size' => 'Ukuran gambar terlalu besar',
          'is_image' => 'File harus berupa gambar',
          'uploaded' => 'File harus diupload',
          'mime_in' => 'File harus berupa gambar'
        ]
      ]

    ])) {
      return redirect()->to(base_url('gps'))->withInput();
    }

    $user = $this->User->where('email', session()->get('email'))->first();

    $icon = $this->request->getFile('icon');
    if($icon->getError() ==  4){
      $namaIcon = 'default.png';
    }else{
      $namaIcon = $icon->getRandomName();
      $icon->move('public/foto/', $namaIcon);
    }

    $this->Gps->save([
      'uid' => $user->id,
      'judul' => htmlspecialchars($this->request->getVar('judul')),
      'deskripsi' => htmlspecialchars($this->request->getVar('deskripsi')),
      'redirect' => htmlspecialchars($this->request->getVar('redirect')),
      'icon' => $namaIcon
    ]);

    session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
    return redirect()->to(base_url('gps'));
  }





}



  