<?php

namespace App\Controllers;
use \App\Models\User;
use \App\Models\Gpss;
use \App\Models\historyIp;
use \App\Models\Tools;

class Iptracking extends BaseController
{
	protected $User;
  protected $Gps;
  protected $History;
  protected $Tools;

  public function __construct()
  {
    $this->User = new User;
    $this->Tools = new Tools;
    $this->Gps = new Gpss;
    $this->History = new historyIp;
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
      return redirect()->to(base_url('login'));
    }

    $user = $this->User->where('email', session()->get('email'))->first();

    if($user->status == 'user')
    {
      $history = $this->History->where('uid', $user->id)->limit(3)->find();
    }else{
      $history = $this->History->where('uid', $user->id)->findAll();
    }

    $histori = $this->History->where('uid', $user->id)->findAll();
    $jumlahHistori = count($histori);

    if($user->status == 'user' && $jumlahHistori > 3)
    {
      $b = $jumlahHistori - 3;
      $pesan = "Akun biasa hanya bisa melihat 3 history, Kamu memiliki <b>$b</b> history yang tidak bisa dilihat, silahkan upgrade akun untuk melihat semua history";
    }else{
      $pesan = '';
    }

  	$data = [
  		'title' => 'IP Tracking',
      'user'  => $user,
      'validation' => \Config\Services::validation(),
      'data'  => $this->Gps->where('uid', $user->id)->findAll(),
      'history'  => $history,
      'pesan' => $pesan,
      'tools' => $this->Tools->findAll()
    ];

    return view('ip/index', $data);

    // Tampilan dan judul link-nya terintegerasi dengan tools gps tracking, hanya beda di history
  }




  public function panduan()
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

    
    $data = [
      'title' => 'Panduan menggunakan tools GPS Tracking',
      'tools' => $this->Tools->findAll()
    ];

    return view('ip/panduan', $data);
  }



  public function lokasi($id = false, $judul = false)
  {

    $d = $this->Gps->where(['uid' => $id, 'judul' => $judul])->first();

    $data = [
      'title' => $d->judul,
      'deskripsi' => $d->deskripsi,
      'data' => $this->Gps->where(['uid' => $id, 'judul' => $judul])->first()
    ];

    return view('ip/lokasi', $data);
  }



  public function kirim()
  {

    $id = $_POST['id'];
    $ip = $_POST['ip'];

    $data = $this->Gps->where('id', $id)->first();

    $timezone = time() + (60 * 60 * 7);
    $tanggal = gmdate('d-m-Y', $timezone);

    $this->History->save([
      'uid' => $data->uid,
      'judul' => $data->judul,
      'ip' => $ip,
      'tanggal' => $tanggal
    ]);

  }



  public function hapus($id = false)
  {
    if(!session()->has('email'))
    {
      session()->setFlashdata('danied', 'Anda belum Login.');
      return redirect()->to(base_url('login'));
    }


    if(!$id)
    {
      session()->setFlashdata('danied', 'ACCESS DANIED!');
      return redirect()->to(base_url('iptracking'));
    }

    $data = $this->Gps->where('id', $id)->first();
    if(!$data)
    {
      session()->setFlashdata('danied', 'ACCESS DANIED!');
      return redirect()->to(base_url('iptracking'));
    }

    $user = $this->User->where('id', $data->uid)->first();
    if($user->email != session()->get('email'))
    {
      session()->setFlashdata('danied', 'ACCESS DANIED!');
      return redirect()->to(base_url('iptracking'));
    }

    if($data->icon != 'default.png')
    {
      unlink('public/foto/'.$data->icon);
    }

    $this->Gps->delete($id);

    session()->setFlashdata('pesan', 'Data berhasil dihapus');
    return redirect()->to(base_url('iptracking'));

  }



  public function hapusHistory($id = false)
  {
    if(!session()->has('email'))
    {
      session()->setFlashdata('danied', 'Anda belum Login.');
      return redirect()->to(base_url('login'));
    }

    if(!$id)
    {
      session()->setFlashdata('danied', 'ACCESS DANIED!');
      return redirect()->to(base_url('iptracking'));
    }

    $data = $this->History->where('id', $id)->first();
    if(!$data)
    {
      session()->setFlashdata('danied', 'ACCESS DANIED!');
      return redirect()->to(base_url('iptracking'));
    }

    $user = $this->User->where('id', $data->uid)->first();
    if($user->email != session()->get('email'))
    {
      session()->setFlashdata('danied', 'ACCESS DANIED!');
      return redirect()->to(base_url('iptracking'));
    }

    if($user->status == 'user')
    {
      session()->setFlashdata('danied', 'ACCESS DANIED!');
      return redirect()->to(base_url('iptracking'));
    }

    $this->History->delete($id);

    session()->setFlashdata('pesan', 'Data berhasil dihapus');
    return redirect()->to(base_url('iptracking'));

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
      return redirect()->to(base_url('iptracking'))->withInput();
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
    return redirect()->to(base_url('iptracking'));
  }





}



  