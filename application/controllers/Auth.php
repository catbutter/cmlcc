<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	private $reCAPTCHA  = '6LctcV8UAAAAAA45Os7XyYMljeRpCgbb6J_Ag7oX';
	
	function __construct() {
        parent::__construct();

       	$this->load->model('main_model');
        $this->load->library('form_validation');

        $this->load->helper('security');
		
    }

	public function checkFacultyUsername(){

		if(trim($this->input->get('faculty_username'))){
			$rs = $this->main_model->ckRegisterEmail($this->input->get('faculty_username'));
			if($rs){
				echo "false";
			}else{
				echo "true";
			}
		}
	}

	
	public function checkEmail(){
		if(trim($this->input->get('member_email'))){
			$rs = $this->main_model->ckRegisterEmail($this->input->get('member_email'));
			if($rs){
				echo "false";
			}else{
				echo "true";
			}
		}
	}

	public function getAm(){
		if($this->input->get('id')!=null){
			$rs=$this->main_model->getAM($this->input->get('id'));
			if($rs!=null){
				$data = '<option value=""> เลือกอำเภอ </option>';
				foreach($rs as $item){
					$data .='<option value="'.$item->AMPHUR_ID.'">'.$item->AMPHUR_NAME.'</option>';
				}
			}
			echo $data;
		}
	}
	public function getDis(){
		if($this->input->get('id')!=null){
			$rs=$this->main_model->getDIS($this->input->get('id'));
			if($rs!=null){
				$data = '<option value=""> เลือกตำบล </option>';
				foreach($rs as $item){
					$data .='<option value="'.$item->DISTRICT_ID.'">'.$item->DISTRICT_NAME.'</option>';
				}
			}
			echo $data;
		}
	}

	public function index()
	{
		redirect('auth/login');
	}

	public function login(){
		$this->session->unset_userdata('faculty_logged_in');
		$this->session->unset_userdata('member_logged_in');
		$this->session->unset_userdata('admin_logged_in');

		//echo md5(sha1('admin3E'));
		$this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean|callback_check_database');
		
		if($this->form_validation->run() == FALSE){
			$data = array( 
				"view" 				=> 'auth/login',
			);
			$this->load->view("main/template_main",$data);
		}else{			
			if($this->session->userdata('admin_logged_in')){
				redirect('admin');
			}
			if($this->session->userdata('member_logged_in')){
				redirect('dashboard');
			}
			if($this->session->userdata('faculty_logged_in')){
				redirect('database');
			}
		}
	}

	public function get_email_template(){
		$member_code = $this->uri->segment(3);
		$rsMember = $this->main_model->getMemberDetailBycode($member_code);

		$ar = array(
			'rsMember'   => $rsMember
		);
		$this->load->view('email_template', $ar);
	}
	public function check_database($password){
		$username = $this->input->post('username');
		$password = md5(sha1($password));
	
		if($this->input->post('g-recaptcha-response')!=null){
			$url = "https://www.google.com/recaptcha/api/siteverify?secret=".$this->reCAPTCHA."&response=".$this->input->post('g-recaptcha-response')."&remoteip=".$_SERVER['REMOTE_ADDR'] ;
			$response=json_decode(file_get_contents($url), true);
			if($response['success']){
				$result = $this->main_model->login($username, $password);
	
				if($result)
				{
					if(@$result[0]->member_id){
						//MEMBER
						if($result[0]->status==1){
							$sess_array = array(
								'member_id'		 	 => $result[0]->member_id,
								'member_code'		 => $result[0]->member_code,
								'member_name'		 => $result[0]->member_name,
								'member_email'  	 => $result[0]->member_email,
							);
							$this->session->set_userdata('member_logged_in', $sess_array);
							return TRUE;
						}else{
							$message='<div class="alert alert-warning"><strong>ขออภัย !</strong> ยังไม่สามารถใช้งานได้ เนื่องจากบัญชีอยู่ระหว่างอนุมัติ</div>';
							$this->form_validation->set_message('check_database', $message);
							return false;
						}
					}else if($result[0]->username){
						//ADMIN
						$sess_array = array(
							'username'		 => $result[0]->username,
							'displayname'  	 => $result[0]->displayname,
						);
						$this->session->set_userdata('admin_logged_in', $sess_array);
						return TRUE;
					}
				}else{
					$message='<div class="alert alert-danger"><strong>คำเตือน !</strong> ชื่อผู้ใช้และรหัสผ่านไม่ถูกต้อง</div>';
					$this->form_validation->set_message('check_database', $message);
					return false;
				}
			}
		}else{
			$message='<div class="alert alert-danger"><strong>คำเตือน !</strong> กรุณาเช็คถูกเครื่องหมาย</div>';
			$this->form_validation->set_message('check_database', $message);
			return false;
		}
	}
	
	public function logout() {
		$this->session->unset_userdata('faculty_logged_in');
		$this->session->unset_userdata('member_logged_in');
		$this->session->unset_userdata('admin_logged_in');
		redirect(site_url());
		exit();
    }

	public function forgot(){

		$data = array( 
			"view" 				=> 'auth/forgetpwd',
		);
		$this->load->view("auth/template_main",$data);
	}

	public function register(){
		if($this->input->post()!=null){
			$ar = $this->input->post();
			
			
			if($this->input->post('g-recaptcha-response')!=null){
				$url = "https://www.google.com/recaptcha/api/siteverify?secret=".$this->reCAPTCHA."&response=".$this->input->post('g-recaptcha-response')."&remoteip=".$_SERVER['REMOTE_ADDR'] ;
				$response=json_decode(file_get_contents($url), true);
				if($response['success'] == false){
					$this->session->set_userdata('noti_action', array('dialog_view' => 'dialog_spam'));
					echo '<script>alert("เกิดข้อผิดพลาดกรุณาลองใหม่อีกครั้ง");window.location="'.base_url('auth/register').'";</script>';
					exit();
				}else{
					
					//$ar['member_service'] = json_encode($ar['member_service']);
					
					$ar['createdate'] = date('Y-m-d H:i:s');
					$ar['member_password'] = md5(sha1($ar['member_password']));
					$ar['member_code'] = genKey(10);
			
					
					unset($ar['g-recaptcha-response']);
					unset($ar['member_password_c']);
				

					$rs=$this->main_model->insertNewMember($ar);
					if($rs){
						$this->session->set_userdata('noti_action', array('dialog_view' => 'dialog_success'));
						echo '<script>alert("สมัครสมาชิกเรียบร้อย");window.location="'.base_url('auth/login').'";</script>';
						exit();
					}else{
						$this->session->set_userdata('noti_action', array('dialog_view' => 'dialog_spam'));
						echo '<script>alert("เกิดข้อผิดพลาดกรุณาลองใหม่อีกครั้ง อัพไฟล์ jpg|png เท่านั้น");window.location="'.base_url('auth/register').'";</script>';
						exit();
					}

				}
			}else{
				$this->session->set_userdata('noti_action', array('dialog_view' => 'dialog_spam'));
				echo '<script>alert("เกิดข้อผิดพลาดกรุณาลองใหม่อีกครั้ง");window.location="'.base_url('auth/register').'";</script>';
				exit();
			}
		}else{
			$data = array( 
				"rsType"			=> $this->main_model->getMemberType(),
				"rsProvince" 		=> $this->main_model->getProvinceList(),
				"view" 				=> 'auth/register',
			);
			$this->load->view("main/template_main",$data);
		}
	}
}
