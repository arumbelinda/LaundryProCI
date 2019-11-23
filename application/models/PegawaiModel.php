<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PegawaiModel extends CI_Model
{
    private $table = 'pegawai';
    public $id;
    public $idPeg;
    public $nama;
    public $ktp;
    public $alamat;
    public $noHp;
    public $posisi;
    public $rule = [
    [
    'field' => 'idPeg',
    'label' => 'idPeg',
    'rules' => 'required'
    ],
    ];
public function Rules() 
    {
         return $this->rule; 
    }

public function getAll() 
    { 
        return
        $this->db->get('pegawai')->result();
    }
public function store($request) 
{
    $this->idPeg = $request->idPeg;
    $this->nama = $request->nama;
    $this->ktp = $request->ktp;
    $this->alamat = $request->alamat;
    $this->noHp = $request->noHp;
    $this->posisi = $request->posisi;
    
    if($this->db->insert($this->table, $this))
    {
        return ['msg'=>'Berhasil','error'=>false];
    }
    return ['msg'=>'Gagal','error'=>true];
    }

public function update($request,$id)
{
    $updateData = ['idPeg' => $request->idPeg, 'nama' =>$request->nama, 'ktp' =>$request->ktp,'alamat'=>$request->alamat,'noHp'=>$request->noHp, 'posisi'=>$request->posisi,];
    if($this->db->where('id',$id)->update($this->table, $updateData))
    {
        return ['msg'=>'Berhasil','error'=>false];
    }
    return ['msg'=>'Gagal','error'=>true];
    }
public function destroy($id)
{
    if (empty($this->db->select('*')->where(array('id' => $id))->get($this->table)->row())) return ['msg'=>'Id tidak ditemukan','error'=>true];

    if($this->db->delete($this->table, array('id' => $id)))
    {
         return ['msg'=>'Berhasil','error'=>false];
    }
    return ['msg'=>'Gagal','error'=>true];
    }
}
?>