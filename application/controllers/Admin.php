<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct() {
        parent::__construct();
		$this->load->config('email');
		$this->load->library('email');

       	$this->load->model('admin_model');
        $this->load->library('form_validation');

        $this->load->helper('security');
	
        if($this->session->userdata('admin_logged_in')==""){
			redirect('auth/login');
      	}
		$this->data['admin']=$this->session->userdata('admin_logged_in');
    }

	public function sendMsg($to, $message){
		
		
		$from = 'noreply.3e@gmail.com';
        $subject = 'ข้อมูลบัญชีของท่านได้รับการอนุมัติ | Chiang Mai Low Carbon City';
        
        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            echo true;
        } else {
            echo false;
        }
	}

	function summernote_upload(){
		if ($_FILES['file']['name']) {
			if (!$_FILES['file']['error']) {
				
				$dir = './uploads/images/';
				$oldmask = umask(0);
				if (!is_dir($dir)) {
					mkdir($dir, 0777);
					umask($oldmask);
				}
				$storeFolder = $_SERVER["DOCUMENT_ROOT"]."/uploads/images/";
				
				$name = date('YmdHis').md5(rand(100, 200));
				$ext = explode('.', $_FILES['file']['name']);
				$ext = end($ext);
				$filename = $name . '.' . $ext;
				$destination = $storeFolder . $filename; //change this directory
				$location = $_FILES["file"]["tmp_name"];
				move_uploaded_file($location, $destination);
				echo '/uploads/images/' . $filename;//change this URL
				
			}else{
			  echo  $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
			}
		}
	}
	public function index()
	{
		$this->data['active'] = 'index';
		$this->data['view'] = 'admin/index';
		$this->load->view("admin/template_main",$this->data);
	}

	public function changepwd(){
		if($this->input->post()!=null){
			$ar = array(
		    	'username' => $this->input->post('username'),
		    	'password' => md5(sha1($this->input->post('o_password')))
		    );

			$ck = $this->admin_model->checkAdmin($ar);
			if($ck!=null){
				$ar = array(
					'username' => $this->input->post('username'),
					'password' => md5(sha1($this->input->post('n_password'))),
					'displayname' => $this->input->post('displayname')
				);
				$rs = $this->admin_model->updateUser($ar); 
				$sess_array = array(
					'username' => $this->input->post('username'),
					'display' => $this->input->post('displayname')
				);
				$this->session->set_userdata('admin_logged_in', $sess_array);
				redirect('admin/changepwd/success');
			}else{
				redirect('admin/changepwd/fail');
			}

		}else{
			$this->data['active'] = 'changepwd';
			$this->data['view'] = 'admin/changepwd';
			$this->load->view("admin/template_main",$this->data);
		}
	}

	public function myear(){
		if($this->input->post()!=null){
			$ar = $this->input->post();
			if($this->input->post('year_value')!=null){
				$ck = $this->admin_model->updateConfigYear($ar);
			}
			redirect('admin/myear');
		}else{
			$rs = array();
			$view = 'admin/myear';
			if($this->uri->segment(3)=="del"){
				$rs = $this->admin_model->delConfigYear($this->uri->segment(4)); 
				redirect('admin/myear');
	    	}else if($this->uri->segment(3)=="edit"){
				$rs = $this->admin_model->getConfigYearDetail($this->uri->segment(4)); 
				$view = 'admin/myear_form';
			}else if($this->uri->segment(3)=="add"){
				$view = 'admin/myear_form';
			}
			$this->data['rsList'] = $this->admin_model->getConfigYear();
			$this->data['active'] = 'myear';
			$this->data['view'] = $view;
			$this->data['rs'] = $rs;
			$this->load->view("admin/template_main",$this->data);
		}
	}

	function initEF($year){
		$query = $this->db->get_where('scope_info', array('scope_year'=> $year));
		if(!$query->result_array()){
			$query = $this->db->get_where('scope_info', array('scope_year'=> '0000'));
			$rows =  $query->result_array();
			foreach($rows as $item){
				unset($item['scope_id']);
				unset($item['createdate']);
				$item['scope_year'] = $year;
				$this->db->insert('scope_info',$item);
			}
		}
		
	}

	public function ef(){
		if($this->uri->segment(3)=="edit"){
			$year = $this->uri->segment(4);
			$this->initEF($year);
			
			$this->data['rsCategory'] = $this->admin_model->select_table1_order('scope_info_category','scf_qno','ASC');
			$this->data['rsScope'] = $this->admin_model->select_table1_order('scope_group','s_qno','ASC');
			$this->data['rsScope1'] = $this->admin_model->select_where_order('scope_info_subgroup','scope_group',1,'createdate','ASC');
			$this->data['rsScopeGHG'] = $this->admin_model->select_where_order('scope_info_subgroup','scope_group','GHG','createdate','ASC');
			$this->data['rsScope2'] = $this->admin_model->select_where_order('scope_info_subgroup','scope_group',2,'createdate','ASC');
			$this->data['rsScope3'] = $this->admin_model->select_where_order('scope_info_subgroup','scope_group',3,'createdate','ASC');
			$this->data['rsScope4'] = $this->admin_model->select_where_order('scope_info_subgroup','scope_group',4,'createdate','ASC');
			$this->data['rsConfigEf'] = $this->admin_model->getConfigEf($year);
			$this->data['ef'] = $this->admin_model->getEf($year);
			$this->data['rs'] = $this->admin_model->getConfigYearDetail($year);
			$this->data['rsList'] = $this->admin_model->getConfigYear($year);
			$this->data['active'] = 'ef';
			$this->data['view'] = 'admin/ef';
			$this->load->view("admin/template_main",$this->data);
		}
	}

	public function myear_ef(){
		$ar=$this->input->post();
		$sm=$this->input->get('sm');
		if($sm=='0'){
			if($ar['year_value']!=null){
				$this->admin_model->updateConfigYear($ar);
			}
		}
		if(!empty($ar['ef'])){
			$ar['year_value'] = $this->uri->segment(3)!=null? $this->uri->segment(3): '0000';
			foreach ($ar['ef'] as $scope => $v) {
			
				foreach ($v as $scope_sub_group => $vv) {
					foreach ($vv as $scope_qno => $vvv) {
						if(!empty($vvv[1])){
							$ar_ef = array(
								'scope_group' => $scope, 
								'scope_sub_group' => $scope_sub_group, 
								'scope_name' => $vvv[1], 
								'scope_detail' => json_encode($vvv),
								'scope_year' => $ar['year_value'],
								'scope_qno' => $scope_qno,
							);
							$scope_search = $this->admin_model->select_where_s('scope_info',array('scope_group' => $scope,'scope_sub_group' => $scope_sub_group,'scope_qno'=>$scope_qno,'scope_year'=>$ar['year_value']));
							if(empty($scope_search)){
								$this->admin_model->insert_data('scope_info',$ar_ef);
								echo 'Insert scope: '.$sm.' complate.';
							}else{
								$this->admin_model->update_data_2('scope_info','scope_id',$scope_search[0]->scope_id,'scope_year',$ar['year_value'],$ar_ef);
								echo 'Update scope: '.$sm.' complate.';
							}
						}
					}
				}
			}
		}
	}

	public function myear_ef_set_scope(){
		$ar=$this->input->post();
		if(!empty($ar)){
			$ar['year_value'] = $this->uri->segment(3)!=null? $this->uri->segment(3): '0000';
			$scope_qno_last = $this->admin_model->select_firstlast('scope_info',array('scope_group' => $ar['scope_group'],'scope_sub_group' => $ar['scope_sub_group'],'scope_year'=>$ar['year_value']),'scope_qno','DESC');
			$ar_ef = array(
				'scope_group' => $ar['scope_group'], 
				'scope_sub_group' => $ar['scope_sub_group'], 
				'scope_name' => $ar['source_name'], 
				'scope_detail' => json_encode(array("1"=>$ar['source_name'])),
				'scope_year' => $ar['year_value'],
				'scope_qno' => $scope_qno_last[0]->scope_qno + 1,
			);
			$this->admin_model->insert_data('scope_info',$ar_ef);
			echo 'Insert list complate.';
		}
	}

	public function myear_ef_del_scope(){
		$ar=$this->input->post();
		if(!empty($ar)){
			$this->admin_model->update_data_3('scope_info','scope_group',$ar['scope_group'],'scope_sub_group',$ar['scope_sub_group'],'scope_id',$ar['scope_id'],array('deleted'=>1));
			echo 'deleted list complate.';
			exit();
		}
	}


	public function member(){
		$rs = array();
		if($this->input->post()!=null){
			$ar =$this->input->post();
			$ar['member_permission'] = json_encode($ar['member_permission']);

			$this->db->where('member_id',$ar['member_id']);
			$this->db->where('member_code',$ar['member_code']);
			if($ar['send']==1){
				$this->db->update('member',array('status'=> $ar['status'], 'send'=>$ar['send'], 'member_permission'=>$ar['member_permission']));

				$rs = $this->admin_model->getMemberDetail($ar['member_id']);
				if($rs[0]['member_email']!=null){
					$to = $rs[0]['member_email'];
					$url = base_url('auth/get_email_template/'.$ar['member_code']);
					$data = file_get_contents($url);
					$this->sendMsg($to, $data);
				}
			}else{
				$this->db->update('member',array('status'=> $ar['status'], 'member_permission'=>$ar['member_permission']));
			}
			
			redirect('admin/member/edit/'.$ar['member_id']);
		}else{

			$view = 'admin/member';
			$rs = array();
			
			if($this->uri->segment(3)=="del"){
				$this->db->where('member_id',$this->uri->segment(4));
				$this->db->update('member',array('deleted'=>1));	
				redirect('admin/member');
	    	}else if($this->uri->segment(3)=="edit"){
				$rs = $this->admin_model->getMemberDetail($this->uri->segment(4)); 
				$view = 'admin/member_form';
			}

			$this->data['rsYearConfig'] = $this->admin_model->getConfigYear();
			$this->data['active'] = 'member';
			$this->data['rsList'] = $this->admin_model->getMemberList();
			$this->data['view'] = $view;
			$this->data['rs'] = $rs;
			$this->load->view("admin/template_main",$this->data);

		}
	}

}
