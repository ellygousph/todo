<?php

namespace App\Controllers;

use Codeigniter\Controllers;
use App\models\M_model;
use CodeIgniter\Session\Session;


class Home extends BaseController
{
    public function index()
    {
        if (session()->get('level')>0){
        $model= new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman dashboard'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        $data['elly'] = $model->getWhereres('tasks', ['created_by' => $id_user]);
            $where=array(
                'id_setting'=> 1
              );
              $data['setting'] = $model->getWhere('setting',$where);
              $data['currentMenu'] = 'dashboard'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('menu', $data);
        echo view('dashboard', $data);
        echo view('footer');
    }else{
        return redirect()->to('home/login');
 
    } 
    }


    public function login()
    {
        $model= new M_model();
        $where=array(
            'id_setting'=> 1
          );
          $data['setting'] = $model->getWhere('setting',$where);
        echo view('header', $data);
        echo view('login', $data);

} 
public function aksilogin()
{
    $name = $this->request->getPost('nama'); 
    $pw = $this->request->getPost('password');
    $captchaResponse = $this->request->getPost('g-recaptcha-response');
    $backupCaptcha = $this->request->getPost('backup_captcha');
    
    $secretKey = '6LdLhiAqAAAAAPxNXDyusM1UOxZZkC_BLCgfyoQf'; // Ganti dengan secret key Anda yang sebenarnya
    $recaptchaSuccess = false;

    $captchaModel = new M_model();

    // Cek koneksi internet
    if ($this->isInternetAvailable()) {
        // Verifikasi reCAPTCHA
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captchaResponse");
        $responseKeys = json_decode($response, true);
        $recaptchaSuccess = $responseKeys["success"];
    }
    
    if ($recaptchaSuccess) {
        // reCAPTCHA berhasil
        $where = [
            'nama_user' => $name,
            'password' => md5($pw),
        ];

        $model = new M_model();
        $check = $model->getWhere('user', $where);

        if ($check) {
            session()->set('id', $check->id_user);
            session()->set('nama', $check->nama_user);
            session()->set('level', $check->level);
            session()->set('lengkap', $check->nama_lengkap);
           
            return redirect()->to('home');
        } else {
            return redirect()->to('home/login')->with('error', 'Invalid username or password.');
        }
    } else {
        // Validasi CAPTCHA offline
        $storedCaptcha = session()->get('captcha_code'); // Retrieve stored CAPTCHA from session
        
        if ($storedCaptcha !== null) {
            if ($storedCaptcha === $backupCaptcha) {
                // CAPTCHA valid
                $where = [
                    'nama_user' => $name,
                    'password' => md5($pw),
                ];

                $model = new M_model();
                $check = $model->getWhere('user', $where);

                if ($check) {
                    session()->set('id', $check->id_user);
                    session()->set('nama', $check->nama_user);
                    session()->set('level', $check->level);
                    session()->set('lengkap', $check->nama_lengkap);
            

                    return redirect()->to('home');
                } else {
                    return redirect()->to('home/login')->with('error', 'Invalid username or password.');
                }
            } else {
                // CAPTCHA tidak valid
                return redirect()->to('home/login')->with('error', 'Invalid CAPTCHA.');
            }
        } else {
            return redirect()->to('home/login')->with('error', 'CAPTCHA session is not set.');
        }
    }
}




    public function generateCaptcha()
{
    $code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);

    // Store the CAPTCHA code in the session
    session()->set('captcha_code', $code);

    // Generate the image
    $image = imagecreatetruecolor(120, 40);
    $bgColor = imagecolorallocate($image, 255, 255, 255);
    $textColor = imagecolorallocate($image, 0, 0, 0);

    imagefilledrectangle($image, 0, 0, 120, 40, $bgColor);
    imagestring($image, 5, 10, 10, $code, $textColor);

    // Set the content type header - in this case image/png
    header('Content-Type: image/png');

    // Output the image
    imagepng($image);

    // Free up memory
    imagedestroy($image);
}

private function isInternetAvailable()
{
    $connected = @fsockopen("www.google.com", 80);
    if ($connected) {
        fclose($connected);
        return true;
    }
    return false;
}

public function logout()
        {
           session()->destroy();
            return redirect()->to('Home/login');
    

}

//log

public function log() 
{
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_model();

        // Menambahkan log aktivitas ketika user mengakses halaman log
        $id_user = session()->get('id');
        $activity = 'Mengakses halaman log aktivitas';
        $this->addLog($id_user, $activity);
        
        // Ambil data pencarian dari input GET
        $id_user_search = $this->request->getGet('id_user');
        $nama_user_search = $this->request->getGet('nama_user');
        $activity_search = $this->request->getGet('activity');
        $timestamp_search = $this->request->getGet('timestamp');

        // Mengambil data log aktivitas dengan filter
        $data['logs'] = $model->searchActivityLogs($id_user_search, $nama_user_search, $activity_search, $timestamp_search);
        
        // Menambahkan data pencarian ke array data
        $data['id_user'] = $id_user_search;
        $data['nama_user'] = $nama_user_search;
        $data['activity'] = $activity_search;
        $data['timestamp'] = $timestamp_search;

        // Ambil setting seperti biasa
        $where = array('id_setting' => 1);
        $data['setting'] = $model->getWhere('setting', $where);

        $data['currentMenu'] = 'log';
        echo view('header', $data);
        echo view('menu', $data);
        echo view('log', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/error');
    }
}


    public function addLog($id_user, $activity)
{
    $model = new M_model(); // Gunakan model M_kedaikopi
    $id_user = session()->get('id');
    $data = [
        'id_user' => $id_user,
        'activity' => $activity,
        'timestamp' => date('Y-m-d H:i:s'),
    ];
    $model->tambah('activity_log', $data); // Pastikan 'activity_log' adalah nama tabel yang benar
}


//setting

public function setting()
{
    // Memeriksa level akses user
    if (session()->get('level') == 0||session()->get('level') == 1 ) {
      
        $model = new M_model();
        
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman setting'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
       

    
        $id = 1; // id_toko yang diinginkan

        // Menyusun kondisi untuk query
        $where = array('id_setting' => $id);

        // Mengambil data dari tabel 'toko' berdasarkan kondisi
        $data['user'] = $model->getWhere('setting', $where);
 
        // Memuat view
        $where=array(
          'id_setting'=> 1
        );
        $data['setting'] = $model->getWhere('setting',$where);
        $data['currentMenu'] = 'setting'; 
        echo view('header', $data);
        echo view('menu', $data);
        echo view('setting', $data);
        echo view('footer', $data);
    } else {
        return redirect()->to('home/error');
    } 
}

public function aksisetting()
{
    $model = new M_model();
    $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengubah data setting'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
      
    
       
    $nama = $this->request->getPost('nama');
    $id = $this->request->getPost('id');
    $uploadedFile = $this->request->getFile('foto');

    $where = array('id_setting' => $id);

    $isi = array(
        'nama_setting' => $nama,
        'updated_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
        'updated_by' => $id_user // ID user yang login
    );

    // Cek apakah ada file yang diupload
    if ($uploadedFile && $uploadedFile->isValid() && !$uploadedFile->hasMoved()) {
        $foto = $uploadedFile->getName();
        $model->upload($uploadedFile); // Mengupload file baru
        $isi['logo'] = $foto; // Menambahkan nama file baru ke array data
    }

    $model->edit('setting', $isi, $where);

    return redirect()->to('home/setting/'.$id);
}


//profile

public function profile($id)
{
    if (session()->get('level') == 0||session()->get('level') == 1||session()->get('level') == 2) {
        $model = new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman profile'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        
        $where= array('user.id_user'=>$id);
        $where=array('id_user'=>session()->get('id'));
        
        $data['user']=$model->getWhere('user',$where);
        $where=array(
            'id_setting'=> 1
          );
          $data['setting'] = $model->getWhere('setting',$where);

        echo view('header',$data);
        echo view ('menu',$data);
        echo view('profile',$data);
        echo view ('footer');
        }else{
        return redirect()->to('home/error');
        }
        
}
public function aksieprofile() 
{
    $model = new M_model();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Mengubah data profile'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);

    $a = $this->request->getPost('usn');
    $b = $this->request->getPost('nama');
    $id = $this->request->getPost('id');

    // Cek apakah username sudah digunakan oleh user lain
    $existingUser = $model->getWhere('user', ['nama_user' => $a, 'id_user !=' => $id]);
    
    if ($existingUser) {
        session()->setFlashdata('error', 'Username sudah digunakan, silakan pilih yang lain.');
        return redirect()->to('home/profile/' . $id);
    }

    // Ambil data user lama
    $userLama = $model->getUserById($id);

    // Jika tidak ada perubahan, langsung kembali tanpa update
    if ($userLama->nama_user == $a && $userLama->nama_lengkap == $b) {
        session()->setFlashdata('success', 'Tidak ada perubahan yang disimpan.');
        return redirect()->to('home/profile/' . $id);
    }

    // Backup data lama sebelum update
    $backupWhere = ['id_user' => $id];
    $existingBackup = $model->getWhere('backup_user', $backupWhere);

    if ($existingBackup) {
        $model->hapus('backup_user', $backupWhere); // Hapus backup lama
    }

    $backupData = (array) $userLama; // Konversi objek ke array
    $model->tambah('backup_user', $backupData); // Simpan backup

    // Lakukan update
    $isi = [
        'nama_user' => $a,
        'nama_lengkap' => $b,
        'updated_at' => date('Y-m-d H:i:s'),
        'updated_by' => $id_user
    ];

    $where = ['id_user' => $id];
    $model->edit('user', $isi, $where);

    session()->setFlashdata('success', 'Profil berhasil diperbarui.');
    return redirect()->to('home/profile/' . $id);
}


public function aksi_changepass() {
    $model = new M_model();
    $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'mengubah password profile'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
       
    $oldPassword = $this->request->getPost('old');
    $newPassword = $this->request->getPost('new');
   

    // Dapatkan password lama dari database
    $currentPassword = $model->getPassword($id_user);

    // Verifikasi apakah password lama cocok
    if (md5($oldPassword) !== $currentPassword) {
        // Set pesan error jika password lama salah
        session()->setFlashdata('error', 'Password lama tidak valid.');
        return redirect()->back()->withInput();
    }
 
    // Update password baru
    $data = [
        'password' => md5($newPassword),
        'updated_by' => $id_user,
        'updated_at' => date('Y-m-d H:i:s')
    ];
    $where = ['id_user' => $id_user];
    
    $model->edit('user', $data, $where);
    
    // Set pesan sukses
    session()->setFlashdata('success', 'Password berhasil diperbarui.');
    return redirect()->to('home/profile/'.$id_user);
}

//user

public function user()
{
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);

        $data['elly'] = $model->tampil('user', 'id_user');
        $data['backup_users'] = []; // Inisialisasi array untuk backup user

        foreach ($data['elly'] as $user) {
            $data['backup_users'][$user->id_user] = $model->getBackupUser($user->id_user);
        }


        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'user'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('menu', $data);
        echo view('user', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/error');
    }
}

public function tambah_user()
{
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses form tambah user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);

        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'user'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('tambah_user', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/error');
    }
}

public function edit_user($id)
{
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses form edit user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        $where= array('id_user'=>$id);
        $data['elly']=$model->getwhere('user',$where);

        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'user'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('edit_user', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/error');
    }
}


public function undo_edit_user($id)
{
    if (session()->get('level') == 0 || session()->get('level') == 1) {

        $model = new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses form undo edit user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
       
        $where = array('id_user' => $id);
        $data['elly'] = $model->getwhere('user', $where);

        // Pastikan data yang didapat adalah array atau objek yang dapat diiterasi
        if (!empty($data['elly'])) {
            // Inisialisasi array untuk backup jurusan
            $data['backup_user'] = [];

            // Mendapatkan data backup untuk setiap jurusan jika data 'elly' adalah array
            if (is_array($data['elly'])) {
                foreach ($data['elly'] as $user) {
                    $data['backup_user'][$user->id_user] = $model->getBackupUser($user->id_user);
                }
            } else {
                // Jika hanya satu data, tetap memprosesnya
                $data['backup_user'][$data['elly']->id_user] = $model->getBackupUser($data['elly']->id_user);
            }
        } else {
            $data['backup_user'] = []; // Jika data kosong, set backup_jurusan menjadi array kosong
        }


        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'user'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
       
        echo view('undo_edit_user', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/error');
    }
}


public function aksi_tambah_user()
    {
        $model = new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Menambah user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
       
      
        $a = $this->request->getPost('usn');
        $b = $this->request->getPost('level');
        $c = md5($this->request->getPost('password'));
        $i = $this->request->getPost('nama');
        
    
        
        $isi = array(
            'nama_user' => $a,
            'level' => $b,
            'password' => $c,
            'nama_lengkap' => $i,
            'created_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
            'created_by' => $id_user // ID user yang login
            

        );
        $model ->tambah('user', $isi);
        
        return redirect()->to('home/user');
    }

    public function aksi_edit_user()
{
    $model = new M_model();
    $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengubah data user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        // Mengambil data log aktivitas dari model
       
    $a = $this->request->getPost('usn');
    $b = $this->request->getPost('level');
    $i = $this->request->getPost('nama');
    $id = $this->request->getPost('id');
   


    $backupWhere = ['id_user' => $id];
    $existingBackup = $model->getWhere('backup_user', $backupWhere);

    if ($existingBackup) {
        // Hapus data lama di user_backup jika ada
        $model->hapus('backup_user', $backupWhere);
    }

    // Ambil data user lama berdasarkan id_user
    $userLama = $model->getUserById($id);

    // Simpan data user lama ke tabel user_backup
    $backupData = (array) $userLama;  // Ubah objek menjadi array
    $model->tambah('backup_user', $backupData);

    $isi = array(
        'nama_user' => $a,
        'level' => $b,
        'nama_lengkap' => $i,
        'updated_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
        'updated_by' => $id_user // ID user yang login
    );

    $where = array('id_user' => $id);
    $model->edit('user', $isi, $where);

    return redirect()->to('home/user');
}

public function aksi_reset($id)
{
    $model = new M_model();
    $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mereset password user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
       
      
    $where = array('id_user' => $id);
    
    $isi = array(
        'password' => md5('12345'),
        'updated_at' => date('Y-m-d H:i:s'),
        'updated_by' => $id_user
    );
    $model->edit('user', $isi, $where);

    return redirect()->to('home/user');
}

public function hapususer($id){
    $model = new M_model();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Menghapus data user'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
    
    $data = [
        'isdelete' => 1,
        'deleted_by' => $id_user,
        'deleted_at' => date('Y-m-d H:i:s') // Format datetime untuk deleted_at
    ];
      
    $model->edit('user', $data, ['id_user' => $id]);

    // Hapus data dari tabel backup_kelas
$where = array('id_user' => $id);
$model->hapus('backup_user', $where);
    return redirect()->to('home/user');
}

public function restore_user()
    {   
        if (session()->get('level') == 0 || session()->get('level') == 1) {
    	$model= new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman restore user'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        
        $data['elly'] = $model->tampil('user', 'id_user');

        $where=array(
            'id_setting'=> 1
          );
          $data['setting'] = $model->getWhere('setting',$where);
          $data['currentMenu'] = 'restore_user'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view ('menu',$data);
        echo view('restore_user',$data);
        echo view ('footer');
         }else{
        return redirect()->to('home/error');
 
    } 
    }

    public function aksi_restore_user($id) {
        $model = new M_model();
         $id_user = session()->get('id'); // Ambil ID user dari session
            $activity = 'Merestore user'; // Deskripsi aktivitas
            $this->addLog($id_user, $activity);
        
        // Data yang akan diupdate untuk mengembalikan produk
        $data = [
            'isdelete' => 0,
            'deleted_by' => null,
            'deleted_at' => null
        ];
    
        // Update data produk dengan kondisi id_produk sesuai
        $model->edit('user', $data, ['id_user' => $id]);
    
        return redirect()->to('home/restore_user');
    }

    public function aksi_unedit_user()
{
    $model = new M_model();
    $id = $this->request->getPost('id'); // Ambil ID dari POST data
    
    if (!$id) {
        return redirect()->to('home/user')->with('error', 'ID user tidak ditemukan.');
    }
    
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Undo edit data user'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
    
    // Ambil data dari tabel user_backup berdasarkan id_user
    $backupData = $model->getWhere('backup_user', ['id_user' => $id]);

    if ($backupData) {
        // Konversi data backup menjadi array
        $restoreData = (array) $backupData;

        // Hapus id_user dari array karena id_user tidak perlu di-update
        unset($restoreData['id_user']);

        // Update data di tabel user dengan data dari user_backup
        $model->edit('user', $restoreData, ['id_user' => $id]);

        // Hapus data dari tabel user_backup setelah di-restore
        $model->hapus('backup_user', ['id_user' => $id]);
    }

    return redirect()->to('home/user');
}

// register

public function register()
{
    $model= new M_model();
    $where=array(
        'id_setting'=> 1
      );
      $data['setting'] = $model->getWhere('setting',$where);
    echo view('header', $data);
    echo view('register', $data);

} 

public function aksi_register()
{
    $model = new M_model();
    $a = $this->request->getPost('usn');
    $b = $this->request->getPost('nama');
    $c = md5($this->request->getPost('password'));

    // Cek apakah nama_user sudah terdaftar
    $userExist = $model->where('nama_user', $a)->first(); // Cek berdasarkan nama_user
    if ($userExist) {
        // Jika nama_user sudah ada, kirimkan pesan kesalahan
        session()->setFlashdata('error', 'Nama pengguna sudah digunakan, coba nama lain.');
        return redirect()->to('home/register'); // Ganti dengan URL untuk halaman registrasi
    }

    $isi = array(
        'nama_user' => $a,
        'nama_lengkap' => $b,
        'password' => $c,
        'level' => '2',
        'created_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
        'created_by' => '2' // ID user yang login
    );

    $model->tambah('user', $isi);

    return redirect()->to('home/login');
}


//todo list

public function todo_list()
{
    if (session()->get('level') == 0||session()->get('level') == 1||session()->get('level') == 2) {

        $model = new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman to do list'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        $data['elly'] = $model->getWhereres('tasks', ['created_by' => $id_user]);

        $data['backup_task'] = []; // Inisialisasi array untuk backup user

        foreach ($data['elly'] as $task) {
            $data['backup_task'][$task->id_task] = $model->getBackuptask($task->id_task);
        }
        
        $where = ['id_setting' => 1];
        $data['setting'] = $model->getWhere('setting', $where);
        $data['currentMenu'] = 'todo'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view('menu', $data);
        echo view('todo_list', $data);
        echo view('footer');
    } else {
        return redirect()->to('home/error');
    }
}
public function aksi_tambah_list()
{
    $model = new M_model();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Menambah data to do list'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
    
    $a = $this->request->getPost('task');
    $b = $this->request->getPost('prio');
    $c = $this->request->getPost('tgl');
    $i = $this->request->getPost('nama');
    
    $isi = array(
        'task' => $a,
        'priority' => $b,
        'due_date' => $c,
        'status' => 0,
        'created_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
        'created_by' => $id_user // ID user yang login
    );
    $model ->tambah('tasks', $isi);
    
    return redirect()->to('home/todo_list');
}

public function mark_done($id_task)
{
    // Ambil ID user dari session untuk mencatat siapa yang mengubah status
    $id_user = session()->get('id'); 
    
    // Deskripsi aktivitas
    $activity = 'Menandai task selesai'; 
    
    // Menambahkan log aktivitas
    $this->addLog($id_user, $activity);
    
    // Mengupdate status task menjadi selesai (1)
    $model = new M_model();
    $isi = array(
        'status' => 1,
        'updated_at' => date('Y-m-d H:i:s'), // Waktu saat task selesai
        'updated_by' => $id_user // ID user yang login
    );

    $where = array('id_task' => $id_task);
    $model->edit('tasks', $isi, $where);  // Update status task pada tabel task

    // Redirect ke halaman yang sama setelah update
    return redirect()->to('home/todo_list');
}

public function undo_task($id_task)
{
    // Ambil ID user dari session untuk mencatat siapa yang mengubah status
    $id_user = session()->get('id'); 
    
    // Deskripsi aktivitas
    $activity = 'Membatalkan status task'; 
    
    // Menambahkan log aktivitas
    $this->addLog($id_user, $activity);
    
    // Mengupdate status task menjadi belum selesai (0)
    $model = new M_model();
    $isi = array(
        'status' => 0,
        'updated_at' => date('Y-m-d H:i:s'), // Waktu saat task dibatalkan
        'updated_by' => $id_user // ID user yang login
    );

    $where = array('id_task' => $id_task);
    $model->edit('tasks', $isi, $where);  // Update status task pada tabel task

    // Redirect ke halaman yang sama setelah update
    return redirect()->to('home/todo_list');
}


public function hapustask($id){
    $model = new M_model();
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Menghapus data to do list'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
    
    $data = [
        'isdelete' => 1,
        'deleted_by' => $id_user,
        'deleted_at' => date('Y-m-d H:i:s') // Format datetime untuk deleted_at
    ];
      
    $model->edit('tasks', $data, ['id_task' => $id]);

    // Hapus data dari tabel backup_kelas
$where = array('id_task' => $id);
$model->hapus('backup_task', $where);
    return redirect()->to('home/todo_list');
}
public function restore_todo_list()
    {   
        if (session()->get('level') == 0 || session()->get('level') == 1) {
    	$model= new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengakses halaman restore to do list'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);
        
        
        $data['elly'] = $model->getWhereres('tasks', ['created_by' => $id_user]);

        $where=array(
            'id_setting'=> 1
          );
          $data['setting'] = $model->getWhere('setting',$where);
          $data['currentMenu'] = 'restore_todo'; // Sesuaikan dengan menu yang aktif
        echo view('header', $data);
        echo view ('menu',$data);
        echo view('restore_todo_list',$data);
        echo view ('footer');
         }else{
        return redirect()->to('home/error');
 
    } 
    }

    public function aksi_restore_task($id) {
        $model = new M_model();
         $id_user = session()->get('id'); // Ambil ID user dari session
            $activity = 'Merestore to do list'; // Deskripsi aktivitas
            $this->addLog($id_user, $activity);
        
        // Data yang akan diupdate untuk mengembalikan produk
        $data = [
            'isdelete' => 0,
            'deleted_by' => null,
            'deleted_at' => null
        ];
    
        // Update data produk dengan kondisi id_produk sesuai
        $model->edit('tasks', $data, ['id_task' => $id]);
    
        return redirect()->to('home/restore_todo_list');
    }

    public function aksi_edit_task()
    {
        $model = new M_model();
        $id_user = session()->get('id'); // Ambil ID user dari session
        $activity = 'Mengubah data to do list'; // Deskripsi aktivitas
        $this->addLog($id_user, $activity);

            $a = $this->request->getPost('task');
            $b = $this->request->getPost('prio');
            $c = $this->request->getPost('tgl');
            $i = $this->request->getPost('nama');
            $id = $this->request->getPost('id');
    
        $backupWhere = ['id_task' => $id];
        $existingBackup = $model->getWhere('backup_task', $backupWhere);
    
        if ($existingBackup) {
            // Hapus data lama di user_backup jika ada
            $model->hapus('backup_task', $backupWhere);
        }
    
        // Ambil data user lama berdasarkan id_user
        $userLama = $model->gettaskById($id);
    
        // Simpan data user lama ke tabel user_backup
        $backupData = (array) $userLama;  // Ubah objek menjadi array
        $model->tambah('backup_task', $backupData);
    
        $isi = array(
            'task' => $a,
            'priority' => $b,
            'due_date' => $c,
            'updated_at' => date('Y-m-d H:i:s'), // Waktu saat produk dibuat
            'updated_by' => $id_user // ID user yang login
        );
    
        $where = array('id_task' => $id);
        $model->edit('tasks', $isi, $where);
    
        return redirect()->to('home/todo_list');
    }

    public function aksi_unedit_task()
{
    $model = new M_model();
    $id = $this->request->getPost('id'); // Ambil ID dari POST data
    
    if (!$id) {
        return redirect()->to('home/todo_list')->with('error', 'ID task tidak ditemukan.');
    }
    
    $id_user = session()->get('id'); // Ambil ID user dari session
    $activity = 'Undo edit data to do list'; // Deskripsi aktivitas
    $this->addLog($id_user, $activity);
    
    // Ambil data dari tabel user_backup berdasarkan id_user
    $backupData = $model->getWhere('backup_task', ['id_task' => $id]);

    if ($backupData) {
        // Konversi data backup menjadi array
        $restoreData = (array) $backupData;

        // Hapus id_user dari array karena id_user tidak perlu di-update
        unset($restoreData['id_task']);

        // Update data di tabel user dengan data dari user_backup
        $model->edit('tasks', $restoreData, ['id_task' => $id]);

        // Hapus data dari tabel user_backup setelah di-restore
        $model->hapus('backup_task', ['id_task' => $id]);
    }

    return redirect()->to('home/todo_list');
}
}