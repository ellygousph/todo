<?php

namespace App\Models;
use CodeIgniter\Model;

Class M_model extends Model
{

  protected $table = 'user'; // Nama tabel yang sesuai dengan database Anda
  protected $primaryKey = 'id'; // Tentukan primary key jika perlu
  protected $allowedFields = ['nama_user', 'email', 'password', 'level', 'created_at', 'created_by']; // Tentukan field yang diizinkan
  
  public function tampil($tabel,$id){
    return $this->db->table($tabel)
                    ->orderby ($id,'desc') 
                    ->get()
                    ->getResult();
  } 
  public function join($tabel, $tabel2, $on, $id){
    return $this->db->table($tabel)
                    ->join($tabel2,$on,'left')
                    ->orderby ($id,'desc') 
                    ->get()
                    ->getResult();
                    
  }




public function searchActivityLogs($id_user = null, $nama_user = null, $activity = null, $timestamp = null)
{
    $builder = $this->db->table('activity_log')
                        ->join('user', 'user.id_user = activity_log.id_user');

    if ($id_user) {
        $builder->like('activity_log.id_user', $id_user);
    }
    if ($nama_user) {
        $builder->like('user.nama_user', $nama_user);
    }
    if ($activity) {
        $builder->like('activity_log.activity', $activity);
    }
    if ($timestamp) {
        $builder->like('activity_log.timestamp', $timestamp);
    }

    $builder->orderBy('activity_log.timestamp', 'DESC');

    return $builder->get()->getResult();
}

  
 
// Di dalam M_projek2.php
public function getBackupUser($id_user)
{
    return $this->db->table('backup_user')->where('id_user', $id_user)->get()->getRow();
}
public function getBackuptask($id_task)
{
    return $this->db->table('backup_task')->where('id_task', $id_task)->get()->getRow();
}

  public function joinkondisi($tabel, $tabel2, $on, $id, $where = [])
{
    $builder = $this->db->table($tabel)
                        ->join($tabel2, $on, 'left')
                        ->orderby($id, 'desc');

    // Jika ada kondisi where, tambahkan ke query
    if (!empty($where)) {
        $builder->where($where);
    }

    return $builder->get()->getResult();
}
public function joinkondisi3($tabel, $tabel2, $tabel3, $on,$on2, $id, $where = [])
{
    $builder = $this->db->table($tabel)
                        ->join($tabel2, $on, 'left')
                        ->join($tabel3, $on2, 'left')
                        ->orderby($id, 'desc');

    // Jika ada kondisi where, tambahkan ke query
    if (!empty($where)) {
        $builder->where($where);
    }

    return $builder->get()->getResult();
}

  public function joinWhereresult($tabel, $tabel2, $on, $where){
    return $this->db->table($tabel)
            ->join($tabel2, $on, 'left')
            ->where($where)
            ->get()
            ->getResult(); // Mengembalikan array objek
}
 


  public function getUserById2($id_user) {
    $this->db->where('id_user', $id_user);
    $query = $this->db->get('user'); // Sesuaikan dengan nama tabel
    return $query->row();
}
   public function joinempat($tabel, $tabel2, $tabel3, $tabel4, $on, $on2, $on3, $id){
     return $this->db->table($tabel)
                    ->join($tabel2, $on,'left')
                    ->join($tabel3, $on2,'left')
                    ->join($tabel4, $on3,'left')
                    ->orderby($id,'desc')
                    ->get()
                    ->getResult();
}

public function jointiga($tabel, $tabel2, $tabel3, $on, $on2, $id){
     return $this->db->table($tabel)
                    ->join($tabel2, $on,'left')
                    ->join($tabel3, $on2,'left')
                    ->orderby($id,'desc')
                    ->get()
                    ->getResult();
}  
    public function joinWhere($tabel, $tabel2, $on, $where){
    return $this->db->table($tabel)
            ->join($tabel2,$on,'left')
            ->getWhere($where)
            ->getRow();
  }
  public function joinWherebaru($tabel, $tabel2, $on, $where) {
    return $this->db->table($tabel)
            ->join($tabel2, $on, 'left')
            ->where($where)
            ->get()
            ->getResult(); // Mengambil banyak hasil
}
  public function getWhere($tabel,$where){
    return $this->db->table($tabel)
             ->getWhere($where)
             ->getRow();
             
}


public function getWhereres($tabel, $where, $orderBy = 'id_task', $orderType = 'DESC')
{
    $query = $this->db->table($tabel)
                      ->where($where)
                      ->orderBy($orderBy, $orderType)
                      ->get();

    if ($query && $query->getNumRows() > 0) {
        return $query->getResult(); // Mengembalikan hasil jika ada
    }
    return []; // Kembalikan array kosong jika query gagal atau tidak ada hasil
}

// public function getWhereres($tabel, $where)
// {
//     $query = $this->db->table($tabel)->getWhere($where);
//     // Cek jika hasil query tidak false atau tidak null
//     if ($query && $query->getNumRows() > 0) {
//         return $query->getResult();  // Mengembalikan hasil jika ada
//     }
//     return [];  // Kembalikan array kosong jika query gagal atau tidak ada hasil
// }



  public function upload($photo){
    
        $imageName = $photo->getName();
        $photo->move(ROOTPATH .'public/images', $imageName);
    }  

public function joinn($tabel, $tabel2, $tabel3,$tabel4, $on, $on2,$on3, $id, $where){
 return $this->db->table($tabel)
 ->join($tabel2, $on,'left')
 ->join($tabel3, $on2,'left')
 ->join($tabel4, $on3,'left')
 ->orderby($id,'desc')
 ->getWhere($where)
 ->getResult();
 
}
public function jointigawhere($tabel, $tabel2, $tabel3, $on, $on2, $id, $where){
     return $this->db->table($tabel)
                    ->join($tabel2, $on,'left')
                    ->join($tabel3, $on2,'left')
                    ->orderby($id,'desc')
                    ->getWhere($where)
                    ->getResult();
}
public function joinempatwhere($tabel, $tabel2, $tabel3, $tabel4, $on, $on2, $on3, $id, $where){
  return $this->db->table($tabel)
                 ->join($tabel2, $on,'left')
                 ->join($tabel3, $on2,'left')
                 ->join($tabel4, $on3,'left')
                 ->orderby($id,'desc')
                 ->getWhere($where)
                 ->getResult();
}
public function joinduawhere($tabel, $tabel2, $on, $id, $where){
     return $this->db->table($tabel)
                    ->join($tabel2, $on,'left')
                    ->orderby($id,'desc')
                    ->getWhere($where)
                    ->getResult();
}


public function getPassword($userId)
{
  return $this->db->table('user')
                        ->select('password')
                        ->where('id_user', $userId)
                        ->get()
                        ->getRow()
                        ->password;

}

 
  public function tambah($tabel, $isi){
    return $this->db->table($tabel)
                    ->insert($isi);
  }
  public function edit($tabel, $isi, $where){
    return $this->db->table($tabel)
                    ->update($isi,$where);
  }
  
  public function hapus($tabel, $where){
    return $this->db->table($tabel)
                    ->delete($where);
                    
  }


public function getActivityLogs()
{
    return $this->db->table('activity_log')
                    ->join('user', 'activity_log.id_user = user.id_user', 'left')
                    ->select('activity_log.*, user.nama_user')
                    ->orderBy('activity_log.timestamp', 'DESC')
                    ->get()
                    ->getResult();
}


public function getUserById($id)
{
    return $this->db->table('user')->where('id_user', $id)->get()->getRow();
}

public function gettaskById($id)
{
    return $this->db->table('tasks')->where('id_task', $id)->get()->getRow();
}


}