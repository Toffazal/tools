<?php

namespace App\Controllers;
use \App\Models\User;
use \App\Models\Tools;

class Home extends BaseController
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

  	$data = [
  		'title' => 'Tools Online',
      'user' => $this->User->where('email', session()->get('email'))->first(),
      'data'  => $this->Tools->findAll()
    ];

    return view('index', $data);
  }



  public function daftar()
  {
    if(session()->has('email'))
    {
      return redirect()->to(base_url());
    }


    $data = [
      'validation' => \Config\Services::validation(),
      'title' => 'Halaman Pendaftaran'
    ];

    return view('daftar', $data);
  }



  public function prosesDaftar()
  {
    //Validasi input
    if(!$this->validate([

      'nama' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'nama tidak boleh kosong.',
        ]
      ],

      'email' => [
        'rules' => 'required|valid_email|is_unique[user.email]',
        'errors' => [
          'required' => 'Email tidak boleh kosong.',
          'is_unique' => 'Email telah terdaftar',
          'valid_email' => 'Gunakan email yang benar.'
        ]
      ],

      'password' => [
        'rules' => 'required|min_length[8]',
        'errors' => [
          'required' => 'Password tidak boleh kosong.',
          'min_length' => 'Password minimal 8 karakter'
        ]
      ]

    ])) {
      return redirect()->to(base_url('daftar/'))->withInput();
    }

    $this->User->save([
      'nama' => htmlspecialchars($this->request->getVar('nama')),
      'email' => htmlspecialchars($this->request->getVar('email')),
      'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
      'status' => 'off',
    ]);

    session()->setFlashdata('pesan', 'Akun berhasil di daftar.');
    return redirect()->to(base_url('login'));
  }



  public function login()
  {
    if(session()->has('email'))
    {
      return redirect()->to(base_url());
    }


    $data = [
      'validation' => \Config\Services::validation(),
      'title' => 'Halaman Login'
    ];

    return view('login', $data);
  }



  public function prosesLogin()
  {
    if(session()->has('email'))
    {
      return redirect()->to(base_url());
    }

    //Validasi input
    if(!$this->validate([

      'email' => [
        'rules' => 'required|valid_email',
        'errors' => [
          'required' => 'Email tidak boleh kosong.',
          'valid_email' => 'Gunakan email yang benar.'
        ]
      ],

      'password' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'Password tidak boleh kosong.'
        ]
      ]

    ])) {
      return redirect()->to(base_url('login/'))->withInput();
    }

    $email = $this->request->getVar('email');
    $password = $this->request->getVar('password');

    $user = $this->User->where(['email' => $email])->first();

    //jika user ada
    if($user)
    {
        //cek password
        if(password_verify($password, $user->password))
        {
          session()->set('email', $user->email);
          session()->set('status', $user->status);
          return redirect()->to(base_url());
        }else{
          session()->setFlashdata('danied', 'Password salah.');
          return redirect()->to(base_url('login'));
        }
      }else{
          session()->setFlashdata('danied', 'Email tidak terdaftar.');
          return redirect()->to(base_url('login'));
    }
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



  public function akun()
  {
    if(!session()->has('email'))
    {
      session()->setFlashdata('danied', 'Anda belum Login.');
      return redirect()->to(base_url('admin/login'));
    }

    $data = [
      'title' => 'Edit akun',
      'validation' => \Config\Services::validation(),
      'data' => $this->User->where('email', session()->get('email'))->first(),
      'tools'  => $this->Tools->findAll()
    ];

    return view('akun', $data);
  }


  public function editAkun()
  {
    if(!session()->has('email'))
    {
      session()->setFlashdata('danied', 'Anda belum Login.');
      return redirect()->to(base_url('login'));
    }

    $user = $this->User->where('email', session()->get('email'))->first();

    //Validasi input
    if(!$this->validate([

      'nama' => [
        'rules' => 'required',
        'errors' => [
          'required' => 'nama tidak boleh kosong.',
        ]
      ],

      'email' => [
        'rules' => 'required|is_unique[user.email,id,'.$user->id.']',
        'errors' => [
          'is_unique' => '{field} telah terdaftar.',
          'required' => '{field}  harus diisi.'
        ]
      ]

    ])) {
      return redirect()->to(base_url('akun'))->withInput();
    }

    $pass = $this->request->getVar('password');
    if($pass)
    {
      $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
    }else{
      $password = $user->password;
    }

    $this->User->save([
      'id' => $user->id,
      'nama' => htmlspecialchars($this->request->getVar('nama')),
      'email' => htmlspecialchars($this->request->getVar('email')),
      'password' => $password,
      'status' => $user->status
    ]);

    session()->remove('email');
    session()->remove('status');
    session()->setFlashdata('pesan', 'Data berhasil diubah, Silakan login kembali.');
    return redirect()->to(base_url('login'));
  }




  public function aktivasi($id = false)
  {
    if(session()->get('status') != 'admin')
    {
      session()->setFlashdata('danied', 'ACCESS DANIED!');
      return redirect()->to(base_url());
    }

    if($id)
    {
      $data = $this->User->getAkun($id);
      $this->User->save([
      'id' => $data->id,
      'nama' => $data->nama,
      'email' => $data->email,
      'password' => $data->password,
      'status' => 'user'
      ]);

      session()->setFlashdata('pesan', 'Akun telah diaktivasi.');
      return redirect()->to(base_url('aktivasi'));
    }

    $data = [
      'title' => 'Aktivasi akun',
      'data' => $this->User->findAll(),
      'tools'  => $this->Tools->findAll()
    ];

    return view('aktivasi', $data);
  }




  public function upgrade($id = false)
  {
    if(session()->get('status') != 'admin')
    {
      session()->setFlashdata('danied', 'ACCESS DANIED!');
      return redirect()->to(base_url());
    }

    if(!$id)
    {
      session()->setFlashdata('danied', 'ACCESS DANIED!');
      return redirect()->to(base_url('aktivasi'));
    }

     $data = $this->User->getAkun($id);
      $this->User->save([
      'id' => $data->id,
      'nama' => $data->nama,
      'email' => $data->email,
      'password' => $data->password,
      'status' => 'vip'
      ]);

      session()->setFlashdata('pesan', 'Akun telah diupgrade.');
      return redirect()->to(base_url('aktivasi'));
  }




  public function downgrade($id = false)
  {
    if(session()->get('status') != 'admin')
    {
      session()->setFlashdata('danied', 'ACCESS DANIED!');
      return redirect()->to(base_url());
    }

    if(!$id)
    {
      session()->setFlashdata('danied', 'ACCESS DANIED!');
      return redirect()->to(base_url('aktivasi'));
    }

     $data = $this->User->getAkun($id);
      $this->User->save([
      'id' => $data->id,
      'nama' => $data->nama,
      'email' => $data->email,
      'password' => $data->password,
      'icon' => $data->icon,
      'status' => 'user'
      ]);

      session()->setFlashdata('pesan', 'Akun telah diaktivasi.');
      return redirect()->to(base_url('aktivasi'));
  }




  public function hapusAkun($id = false)
  {
    if(!session()->has('email'))
    {
      session()->setFlashdata('danied', 'Anda belum Login.');
      return redirect()->to(base_url('login'));
    }

    if(!$id)
    {
      session()->setFlashdata('danied', 'ACCESS DANIED!');
      return redirect()->to(base_url('akun'));
    }

    $user = $this->User->where('id', $id)->first();
    if($user->email != session()->get('email'))
    {
      session()->setFlashdata('danied', 'ACCESS DANIED!');
      return redirect()->to(base_url('akun'));
    }

    if($user->status == 'admin')
    {
      session()->setFlashdata('danied', 'ACCESS DANIED!');
      return redirect()->to(base_url('akun'));
    }

    if($user->icon != 'default.png')
    {
      unlink('public/foto/'.$user->icon);
    }

    $this->User->delete($id);

    session()->remove('email');
    session()->remove('status');

    session()->setFlashdata('pesan', 'Akun berhasil dihapus');
    return redirect()->to(base_url('login'));

  }





  public function tambahTools()
  {
    if(session()->get('status') != 'admin')
    {
      session()->setFlashdata('danied', 'ACCESS DANIED!');
      return redirect()->to(base_url());
    }

    $nama = htmlspecialchars($this->request->getVar('nama'));
    $icon = htmlspecialchars($this->request->getVar('icon'));
    $slug = url_title($nama, '', true);

    $this->Tools->save([
      'slug' =>$slug,
      'nama' => $nama, 
      'icon' => $icon
    ]);

    session()->setFlashdata('pesan', 'Tools telah ditambah.');
    return redirect()->to(base_url());
  }



}



  