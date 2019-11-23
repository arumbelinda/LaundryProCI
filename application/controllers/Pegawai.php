<?php
use Restserver\Libraries\REST_Controller ;
Class Pegawai extends REST_Controller{
    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, OPTIONS, POST, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, ContentLength, Accept-Encoding");
        
    parent::__construct();
        $this->load->model('PegawaiModel');
        $this->load->library('form_validation');
        $this->load->helper(['jwt', 'authorization']); 
        }
    public function index_get()
    {
        // $data = $this->verify_data();
        // if($data)
        // {
            return $this->returnData($this->db->get('pegawai')->result(), false);
        // }
        // else
        // {
        //     $status = parent::HTTP_UNAUTHORIZED;
        //     $response = ['status' => $status, 'msg' => 'Unauthorized Access!'];
        //     return $this->response($response);
        // }
       
    }
    public function index_post($id = null)
    {

        // $data = $this->verify_data();
        // if($data)
        // {
            $validation = $this->form_validation;
            $rule = $this->PegawaiModel->rules();
        
            if($id == null)
            {
            array_push($rule,[
            'field' => 'idPeg',
            'label' => 'idPeg',
            'rules' => 'required|is_unique[pegawai.idPeg]'
            ],
            [
            'field' => 'nama',
            'label' => 'nama',
            'rules' => 'required'
            ],
            [
            'field' => 'ktp',
            'label' => 'ktp',
            'rules' => 'required|is_unique[pegawai.ktp]'
            ],
            [
            'field' => 'alamat',
            'label' => 'alamat',
            'rules' => 'required'
            ],
            [
            'field' => 'noHp',
            'label' => 'noHp',
            'rules' => 'required'
            ],
            [
                'field' => 'posisi',
                'label' => 'posisi',
                'rules' => 'required'
            ],
           
            );
            }
       

            $validation->set_rules($rule);
            if (!$validation->run())
            {
                return $this->returnData($this->form_validation->error_array(), true);
            }
            
            $pegawai = new PegawaiData();
            $pegawai->idPeg = $this->post('idPeg');
            $pegawai->nama = $this->post('nama');
            $pegawai->ktp = $this->post('ktp');
            $pegawai->alamat = $this->post('alamat');
            $pegawai->noHp = $this->post('noHp');
            $pegawai->posisi = $this->post('posisi');
            
            if($id == null)
            {
                $response = $this->PegawaiModel->store($pegawai);
            }
            else{
                $response = $this->PegawaiModel->update($pegawai,$id);
            }
            return $this->returnData($response['msg'], $response['error']);
        }
        
        
        // else
        // {
        //     $status = parent::HTTP_UNAUTHORIZED;
        //     $response = ['status' => $status, 'msg' => 'Unauthorized Access!'];
        //     return $this->response($response);
        // }
    // }    

    public function index_delete($id = null)
    {
        // $data = $this->verify_data();

        if($data)
        {
            if ($id == null)
            {
                return $this->returnData('Parameter Id Tidak Ditemukan', true);
            }
            $response = $this->PegawaiModel->destroy($id);
            return $this->returnData($response['msg'], $response['error']);
        }
        // else
        // {
        //     $status = parent::HTTP_UNAUTHORIZED;
        //     $response = ['status' => $status, 'msg' => 'Unauthorized Access!'];
        //     return $this->response($response);
        // }
       }
       public function returnData($msg, $error)
       {
           $response['error'] = $error;
           $response['message'] = $msg;
           return $this->response($response);
       }
   
    //    public function verify_data()
    //    {
    //        $headers = $this->input->request_headers();
   
    //        if(!empty($headers['Authorization']))
    //        {
    //            $token = $headers['Authorization'];
    //        }
    //        else
    //        {
    //            return false;
    //        }
   
   
    //        try {
    //        // Validate the token
    //        // Successfull validation will return the decoded user data else returns false
    //            $data = AUTHORIZATION::validateToken($token);
    //            $data2 = AUTHORIZATION::validateTimestamp($token);
   
    //            if ($data === false || $data2 === false) {
    //                $status = parent::HTTP_UNAUTHORIZED;
    //                $response = ['status' => $status, 'msg' => 'Unauthorized Access!'];
    //                return false;
    //            } 
    //            else 
    //            {
    //                return $data;
    //            }
    //        }
    //        catch (Exception $e) 
    //        {
    //            // Token is invalid
    //            // Send the unathorized access message
    //            $status = parent::HTTP_UNAUTHORIZED;
    //            $response = ['status' => $status, 'msg' => 'Unauthorized Access! '];
    //            return false;
    //        }
    //    }
   }   
    Class PegawaiData{
        public $idPeg;
        public $nama;
        public $ktp;
        public $alamat;
        public $noHp;
        public $posisi;
       }   