<?php

namespace App\Controllers;
use App\Models\Auth;
use App\Models\Employee;
use App\Models\Attendance;
class Main extends BaseController
{   
    protected $request;
    protected $session;
    protected $auth_model;
    protected $emp_model;
    protected $att_model;
    protected $data;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = \Config\Services::session();
        $this->auth_model = new Auth;
        $this->emp_model = new Employee;
        $this->att_model = new Attendance;
        $this->data = ['session' => $this->session,'request'=>$this->request];
    }

    public function index()
    {
        $this->data['page_title']="Home";
        return view('pages/home', $this->data);
    }

    public function users(){
        $this->data['page_title']="Users";
        $this->data['page'] =  !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $this->data['perPage'] =  10;
        $this->data['total'] =  $this->auth_model->where("id != '{$this->session->login_id}'")->countAllResults();
        $this->data['users'] = $this->auth_model->where("id != '{$this->session->login_id}'")->paginate($this->data['perPage']);
        $this->data['total_res'] = is_array($this->data['users'])? count($this->data['users']) : 0;
        $this->data['pager'] = $this->auth_model->pager;
        return view('pages/users/list', $this->data);
    }
    public function user_add(){
        if($this->request->getMethod() == 'post'){
            extract($this->request->getPost());
            if($password !== $cpassword){
                $this->session->setFlashdata('error',"Password does not match.");
            }else{
                $udata= [];
                $udata['name'] = $name;
                $udata['email'] = $email;
                if(!empty($password))
                $udata['password'] = password_hash($password, PASSWORD_DEFAULT);
                $checkMail = $this->auth_model->where('email',$email)->countAllResults();
                if($checkMail > 0){
                    $this->session->setFlashdata('error',"User Email Already Taken.");
                }else{
                    $save = $this->auth_model->save($udata);
                    if($save){
                        $this->session->setFlashdata('main_success',"User Details has been updated successfully.");
                        return redirect()->to('Main/users');
                    }else{
                        $this->session->setFlashdata('error',"User Details has failed to update.");
                    }
                }
            }
        }

        $this->data['page_title']="Add User";
        return view('pages/users/add', $this->data);
    }
    public function user_edit($id=''){
        if(empty($id))
        return redirect()->to('Main/users');
        if($this->request->getMethod() == 'post'){
            extract($this->request->getPost());
            if($password !== $cpassword){
                $this->session->setFlashdata('error',"Password does not match.");
            }else{
                $udata= [];
                $udata['name'] = $name;
                $udata['email'] = $email;
                if(!empty($password))
                $udata['password'] = password_hash($password, PASSWORD_DEFAULT);
                $checkMail = $this->auth_model->where('email',$email)->where('id!=',$id)->countAllResults();
                if($checkMail > 0){
                    $this->session->setFlashdata('error',"User Email Already Taken.");
                }else{
                    $update = $this->auth_model->where('id',$id)->set($udata)->update();
                    if($update){
                        $this->session->setFlashdata('success',"User Details has been updated successfully.");
                        return redirect()->to('Main/user_edit/'.$id);
                    }else{
                        $this->session->setFlashdata('error',"User Details has failed to update.");
                    }
                }
            }
        }

        $this->data['page_title']="Edit User";
        $this->data['user'] = $this->auth_model->where("id ='{$id}'")->first();
        return view('pages/users/edit', $this->data);
    }
    
    public function user_delete($id=''){
        if(empty($id)){
                $this->session->setFlashdata('main_error',"user Deletion failed due to unknown ID.");
                return redirect()->to('Main/users');
        }
        $delete = $this->auth_model->where('id', $id)->delete();
        if($delete){
            $this->session->setFlashdata('main_success',"User has been deleted successfully.");
        }else{
            $this->session->setFlashdata('main_error',"user Deletion failed due to unknown ID.");
        }
        return redirect()->to('Main/users');
    }

    public function employees(){
        $this->data['page_title']="Employees";
        $this->data['page'] =  !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $this->data['perPage'] =  10;
        $this->data['total'] =  $this->emp_model->countAllResults();
        $this->data['employees'] = $this->emp_model->select("*, CONCAT(last_name, ', ', first_name, COALESCE(CONCAT(' ', middle_name), '')) as `name`")->paginate($this->data['perPage']);
        $this->data['total_res'] = is_array($this->data['employees'])? count($this->data['employees']) : 0;
        $this->data['pager'] = $this->emp_model->pager;
        return view('pages/employees/list', $this->data);
    }
    public function employee_add(){
        if($this->request->getMethod() == 'post'){
            extract($this->request->getPost());
            $udata= [];
            $udata['company_code'] = $company_code;
            $udata['first_name'] = $first_name;
            $udata['middle_name'] = $middle_name;
            $udata['last_name'] = $last_name;
            $udata['department'] = $department;
            $udata['position'] = $position;
            $checkCompanyCode = $this->emp_model->where('company_code',$company_code)->countAllResults();
            if($checkCompanyCode){
                $this->session->setFlashdata('error',"Employee Code Already Taken.");
            }else{
                $save = $this->emp_model->save($udata);
                if($save){
                    $this->session->setFlashdata('main_success',"Employee Details has been updated successfully.");
                    return redirect()->to('Main/employees/');
                }else{
                    $this->session->setFlashdata('error',"Employee Details has failed to update.");
                }
            }
        }

        $this->data['page_title']="Add New Employee";
        return view('pages/employees/add', $this->data);
    }
    public function employee_edit($id=''){
        if(empty($id))
        return redirect()->to('Main/employees');
        if($this->request->getMethod() == 'post'){
            extract($this->request->getPost());
            $udata= [];
            $udata['company_code'] = $company_code;
            $udata['first_name'] = $first_name;
            $udata['middle_name'] = $middle_name;
            $udata['last_name'] = $last_name;
            $udata['department'] = $department;
            $udata['position'] = $position;
            $checkCode = $this->emp_model->where('company_code',$company_code)->where("id!= '{$id}'")->countAllResults();
            if($checkCode){
                $this->session->setFlashdata('error',"Employee Code Already Taken.");
            }else{
                $update = $this->emp_model->where('id',$id)->set($udata)->update();
                if($update){
                    $this->session->setFlashdata('success',"Employee Details has been updated successfully.");
                    return redirect()->to('Main/employee_edit/'.$id);
                }else{
                    $this->session->setFlashdata('error',"Employee Details has failed to update.");
                }
            }
        }

        $this->data['page_title']="Edit Employee";
        $this->data['employee'] = $this->emp_model->where("id ='{$id}'")->first();
        return view('pages/employees/edit', $this->data);
    }
    
    public function employee_delete($id=''){
        if(empty($id)){
                $this->session->setFlashdata('main_error',"Employee Deletion failed due to unknown ID.");
                return redirect()->to('Main/employees');
        }
        $delete = $this->emp_model->where('id', $id)->delete();
        if($delete){
            $this->session->setFlashdata('main_success',"Employee has been deleted successfully.");
        }else{
            $this->session->setFlashdata('main_error',"Employee Deletion failed due to unknown ID.");
        }
        return redirect()->to('Main/employees');
    }
    public function attendances(){
        $this->data['page_title']="Attendances";
        $this->data['page'] =  !empty($this->request->getVar('page')) ? $this->request->getVar('page') : 1;
        $this->data['perPage'] =  10;
        $this->data['total'] =  $this->att_model->countAllResults();
        $this->data['attendances'] = $this->att_model
                                    ->select("`attendance`.*, `employees`.company_code, CONCAT(`employees`.last_name, ', ', `employees`.first_name, COALESCE(CONCAT(' ', `employees`.middle_name), '')) as `name`")
                                    ->join('employees','`attendance.employee_id = employees.id`','inner')
                                    ->paginate($this->data['perPage']);
        $this->data['total_res'] = is_array($this->data['attendances'])? count($this->data['attendances']) : 0;
        $this->data['pager'] = $this->att_model->pager;
        return view('pages/attendances/list', $this->data);
    }
    public function attendance_delete($id=''){
        if(empty($id)){
                $this->session->setFlashdata('main_error',"Attendance Deletion failed due to unknown ID.");
                return redirect()->to('Main/attendances');
        }
        $delete = $this->att_model->where('id', $id)->delete();
        if($delete){
            $this->session->setFlashdata('main_success',"Attendance has been deleted successfully.");
        }else{
            $this->session->setFlashdata('main_error',"Attendance Deletion failed due to unknown ID.");
        }
        return redirect()->to('Main/attendances');
    }
}
