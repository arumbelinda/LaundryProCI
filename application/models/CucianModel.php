<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CucianModel extends CI_Model
{
    private $table = 'cucian';
    public $id;
    public $nota;
    public $nama;
    public $bobot;
    public $jenis;
    public $waktu;
    public $rule = [
    [
    'field' => 'nota',
    'label' => 'nota',
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
        $this->db->get('cucian')->result();
    }
public function store($request) 
{
    $this->nota = $request->nota;
    $this->nama = $request->nama;
    $this->bobot = $request->bobot;
    $this->jenis = $request->jenis;
    $this->waktu = $request->waktu;
    
    if($this->db->insert($this->table, $this))
    {
        return ['msg'=>'Berhasil','error'=>false];
    }
    return ['msg'=>'Gagal','error'=>true];
    }

public function update($request,$id)
{
    $updateData = ['nota' => $request->nota, 'nama' =>$request->nama, 'bobot' =>$request->bobot, 'jenis'=>$request->jenis, 'waktu'=>$request->waktu,];
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