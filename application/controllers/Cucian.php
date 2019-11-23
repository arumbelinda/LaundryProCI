<?php
use Restserver\Libraries\REST_Controller ;
Class Cucian extends REST_Controller{
    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, OPTIONS, POST, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, ContentLength, Accept-Encoding");
        
    parent::__construct();
        $this->load->model('CucianModel');
        $this->load->library('form_validation');
        $this->load->helper(['jwt', 'authorization']); 
        }
    public function index_get()
    {
        // $data = $this->verify_data();
        // if($data)
       
           return $this->returnData($this->db->get('cucian')->result(), false);
      
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
            $rule = $this->CucianModel->rules();
        
            if($id == null)
            {
            array_push($rule,[
            'field' => 'nota',
            'label' => 'nota',
            'rules' => 'required|is_unique[cucian.nota]'
            ],
            [
            'field' => 'nama',
            'label' => 'nama',
            'rules' => 'required'
            ],
            [
            'field' => 'bobot',
            'label' => 'bobot',
            'rules' => 'required'
            ],
            [
            'field' => 'jenis',
            'label' => 'jenis',
            'rules' => 'required'
            ],
            [
            'field' => 'waktu',
            'label' => 'waktu',
            'rules' => 'required'
            ],
           
            );
            }
        

            $validation->set_rules($rule);
            if (!$validation->run())
            {
                return $this->returnData($this->form_validation->error_array(), true);
            }
            
            $cucian = new PegawaiData();
            $cucian->nota = $this->post('nota');
            $cucian->nama = $this->post('nama');
            $cucian->bobot = $this->post('bobot');
            $cucian->jenis = $this->post('jenis');
            $cucian->waktu = $this->post('waktu');
            
            if($id == null)
            {
                $response = $this->CucianModel->store($cucian);
            }
            else{
                $response = $this->CucianModel->update($cucian,$id);
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
            $response = $this->CucianModel->destroy($id);
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
        public $nota;
        public $nama;
        public $bobot;
        public $jenis;
        public $waktu;
       }   