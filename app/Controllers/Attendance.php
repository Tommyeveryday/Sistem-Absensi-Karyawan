<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Employee;
use App\Models\Attendance as Att_Model;
class Attendance extends BaseController
{ 
    protected $request;
    protected $session;
    protected $emp_model;
    protected $att_model;
    protected $data;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = session();
        $this->emp_model = new Employee;
        $this->att_model = new Att_Model;
        $this->data = ['session' => $this->session,'request'=>$this->request];
    }
    public function index()
    {
        $this->data['page_title']="Attendace";
        return view('pages/attendance', $this->data);

    }
    public function add()
    {
        if($this->request->getMethod() == 'post'){
            extract($this->request->getPost());
            $employee = $this->emp_model->where('company_code',$company_code)->first();
            if(isset($employee['id'])){
                $idata['employee_id'] = $employee['id'];
                if(isset($time_in)){
                    $idata['log_type'] = 1;
                    $lt ="Time In";
                }else{
                    $idata['log_type'] = 2;
                    $lt ="Time Out";
                }
                $check = $this->att_model->where('employee_id',$idata['employee_id'])->where('log_type',$idata['log_type'])->where('date(`created_at`)',date('Y-m-d'))->countAllResults();
                if($check > 0){
                    $this->session->setFlashdata('error', "You have already a {$lt} Record Today.");
                }else{
                    $save = $this->att_model->save($idata);
                    if($save){
                        $this->session->setFlashdata('success', "You have sucessfully added your {$lt} Record Today.");
                        return redirect()->to('Attendance');
                    }else{
                        $this->session->setFlashdata('error', "An error occured.");
                    }
                }
            }
        }
        $this->data['page_title']="Attendace";
        return view('pages/attendance', $this->data);
    }
}
