<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	private $rsMember;

	function __construct() {
        parent::__construct();

       	$this->load->model('main_model');
        $this->load->library('form_validation');

        $this->load->helper('security');
		
        if($this->session->userdata('member_logged_in')==""){
			redirect('auth/login');
      	}
		$rsMember = $this->session->userdata('member_logged_in');
	
		$rsMember =  $this->main_model->getMemberDetail($this->session->userdata('member_logged_in')['member_id']);
		$this->data['rsMember'] = $rsMember[0];
		if($rsMember[0]['member_lat']=="" || $rsMember[0]['member_lon']==""){
			if($this->uri->segment(2)!='profile'){
				echo '<script>alert("เนื่องจากท่านยังไม่ได้ระบุพิกัด กรุณาอัพเดทข้อมูลได้ที่หน้าแก้ไขข้อมูล");window.location="'.base_url('dashboard/profile').'";</script>';
				exit();
			}
		}
		
    }

	public function index()
	{
		$this->data['active'] = 'index';
		$this->data['view'] = 'dashboard/index';
		$this->load->view("dashboard/template_main",$this->data);
	}

	public function profile(){
		if($this->input->post()!=null){
			$ar = $this->input->post();
			if($ar['member_type_id']<5){
				$ar['member_dataset'] = 'Fiscal';
			}else if($ar['member_type_id']>=5 && $ar['member_type_id']<7){
				$ar['member_dataset'] = 'Year';
			}

			$this->db->where('member_id', $ar['member_id']);
			$this->db->where('member_code', $ar['member_code']);
			$this->db->update('member', $ar); 

			$rs = $this->main_model->getMemberDetail($ar['member_id']);
			$sess_array = array(
				'member_id'		 	 => $rs[0]['member_id'],
				'member_code'		 => $rs[0]['member_code'],
				'member_name'		 => $rs[0]['member_name'],
				'member_email'  	 => $rs[0]['member_email'],
			);
			$this->session->set_userdata('member_logged_in', $sess_array);

			echo '<script>alert("บันทึกข้อมูลเรียบร้อย");window.location="'.base_url('dashboard/profile').'";</script>';
			exit();
		}

	
		$this->data['rsProvince'] = $this->main_model->getProvinceList();
		$this->data['rsAM'] = $this->main_model->getAM(38);
		$this->data['rsType'] = $this->main_model->getMemberType();
		$this->data['active'] = 'profile';
		$this->data['view'] = 'dashboard/profile';
		$this->load->view("dashboard/template_main",$this->data);
	}

	public function react_view() {
		$this->data['active'] = 'react_view';
		$this->data['view'] = 'dashboard/react_view';
		$this->load->view("dashboard/template_main",$this->data);
	}

	public function changepwd(){
		if($this->input->post()){
			
			$ar = $this->input->post();
			$rs = $this->main_model->updateMemberChangePassword($ar);
			
			echo '<script>alert("บันทึกข้อมูลเรียบร้อย");window.location="'.base_url('dashboard/changepwd').'";</script>';
			exit();
			
		}

		$this->data['active'] = 'changepwd';
		$this->data['view'] = 'dashboard/changepwd';
		$this->load->view("dashboard/template_main",$this->data);
	}

	public function faculty(){
		if($this->input->post()!=null){
			$ar = $this->input->post();
			if($ar['faculty_id']!=null){
				$this->db->where('faculty_code',$ar['faculty_code']);
				$this->db->where('faculty_member_id',$this->data['rsMember']['member_id']);
				$this->db->where('faculty_id', $ar['faculty_id']);
				$this->db->update('member_faculty',array('faculty_name'=> $ar['faculty_name'], 'faculty_status' =>$ar['faculty_status']));	
				redirect('dashboard/faculty/edit/'.$ar['faculty_code']);
			}else{
				$ar['createdate'] = date('Y-m-d H:i:s');
				$ar['faculty_code'] = genKey();
				$ar['faculty_password'] = md5(sha1($ar['faculty_username']));
				$ar['faculty_member_id'] = $this->data['rsMember']['member_id'];
				$this->db->insert('member_faculty',$ar);
				redirect('dashboard/faculty/edit/'.$ar['faculty_code']);
			}
		}else{
			$rs = array();
			$view = 'dashboard/faculty';
			if($this->uri->segment(3)=="del"){
				$this->db->where('faculty_code',$this->uri->segment(4));
				$this->db->where('faculty_member_id',$this->data['rsMember']['member_id']);
				$this->db->update('member_faculty',array('deleted'=>1));	
				redirect('dashboard/faculty');
	    	}else if($this->uri->segment(3)=="edit"){
				$rs = $this->main_model->getFacultyDetail($this->uri->segment(4),$this->data['rsMember']['member_id']); 
				$view = 'dashboard/faculty_form';
			}
			else if($this->uri->segment(3)=="add"){
				$view = 'dashboard/faculty_form';
			}
			
			$this->data['rsList'] = $this->main_model->getFacultyList($this->data['rsMember']['member_id']);
			$this->data['active'] = 'faculty';
			$this->data['view'] = $view;
			$this->data['rs'] = $rs;
			$this->load->view("dashboard/template_main",$this->data);
		}
	}

	function ckYear(){
		if($this->uri->segment(3)!=null){
			$year_value=$this->uri->segment(3);
			$member_permission = (array) @json_decode(@$this->data['rsMember']['member_permission']);
			if(!in_array($year_value, $member_permission)){
				echo '<script>alert("เกิดข้อผิดพลาด ไม่สามารถแก้ไขข้อมูลได้");window.location="'.base_url('dashboard/database').'";</script>';
			}
		}
	}

	public function database(){
		$this->ckYear();
		$this->data['rsYear'] = $this->main_model->get_data_w_array('config_year',array('isshow'=>1, 'deleted'=>0));
		$this->data['active'] = 'database';
		$this->data['view'] = 'dashboard/database';
		$this->data['rsGOVData'] = $this->main_model->getGovYearData($this->data['rsMember']['member_id'], $this->data['rsMember']['member_code']);
		$this->load->view("dashboard/template_main",$this->data);
	}

	public function target(){
		$this->ckYear();
		$this->data['rsYear'] = $this->main_model->get_data_w_array('config_year',array('isshow'=>1, 'deleted'=>0));
		$this->data['active'] = 'target';
		$this->data['view'] = 'dashboard/target';
		$this->data['rsGOVData'] = $this->main_model->getGovYearData($this->data['rsMember']['member_id'], $this->data['rsMember']['member_code']);
		$this->load->view("dashboard/template_main",$this->data);
	}

	public function less(){
		$this->ckYear();
		$this->data['rsYear'] = $this->main_model->get_data_w_array('config_year',array('isshow'=>1, 'deleted'=>0));
		$this->data['active'] = 'less';
		$this->data['view'] = 'dashboard/less';
		$this->data['rsGOVData'] = $this->main_model->getGovYearData($this->data['rsMember']['member_id'], $this->data['rsMember']['member_code']);
		$this->load->view("dashboard/template_main",$this->data);
	}
	
	public function set_target(){
		$year = $this->uri->segment(3);
		$ck = $this->main_model->getCkYear($year);
		if($ck==null){
			redirect('dashboard/target');
		}
		$do = $this->uri->segment(4);
		$rs = array();
		if($this->input->post()!=null){
			$ar = $this->input->post();

			$ar_post['target_year_value'] = $year;
			$ar_post['target_member_id'] = $this->data['rsMember']['member_id'];
			$ar_post['target_key'] = $this->data['rsMember']['member_code'];
			$ar_post['target_data'] = json_encode($ar);

			$rs = $this->main_model->setMemberTarget($ar_post);
			echo '<script>alert("บันทึกข้อมูลเรียบร้อย");window.location="'.base_url('/dashboard/set_target/'.$year).'";</script>';
			exit();

		}else{
			
			$this->data['rsConfigReduce'] = $this->main_model->getConfig('reduce');
			$this->data['rsMemberTarget'] = $this->main_model->getMemberTarget($year, $this->data['rsMember']['member_id'], $this->data['rsMember']['member_code']);
			$this->data['rsGovermentFr'] = $this->main_model->getGovermentFr($year, $this->data['rsMember']['member_id'], $this->data['rsMember']['member_code']);
			$this->data['active'] = 'database';
			$this->data['getSubScope'] = $this->main_model->getCountSubScope();
			$this->data['getFr04'] = $this->main_model->getFr04($year);
			$this->data['rsScopeValue'] = $this->main_model->getSumScopeValue($year, $this->data['rsMember']['member_id'], $this->data['rsMember']['member_code']);
			$this->data['ef'] = $this->main_model->getEF($year);

			$this->data['active'] = 'target';
			$this->data['view'] = 'dashboard/target_set';
			$this->data['rsDepartment'] = $this->main_model->getGovDepartment($year, $this->data['rsMember']['member_id'], $this->data['rsMember']['member_code']);
			$this->load->view("dashboard/template_main",$this->data);
		}
	}

	public function upload_report(){

		$storeFolder = $_SERVER["DOCUMENT_ROOT"]."/uploads/files/";
		if($this->input->post()!=null){
			$ar = $this->input->post();
			if($ar['info_member_id']==$this->data['rsMember']['member_id']){
				$file_type = $_FILES['content_file']['type']; //returns the mimetype
				$tempFile = $_FILES['content_file']['tmp_name'];
				$allowed = array("image/jpeg", "image/gif", "application/pdf");
				
				$tmp	= explode(".",$_FILES['content_file']['name']);
				$tmp	= end($tmp);
				
				$allowed = array("docx", "pdf", "doc");
				if(!in_array($tmp, $allowed)) {
					echo '<script>alert("เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง");window.location="'.base_url('/dashboard/report/'.$ar['info_year_value']).'";</script>';
					exit;
				}
				$tmpName = "report_".$this->data['rsMember']['member_id']."_".date("Ymdhis").".".$tmp;
				$targetFile =  $storeFolder.$tmpName;  //5
				if(move_uploaded_file($tempFile, $targetFile)){
					$ar['info_report'] =  $tmpName;
					$ar['info_member_id'] =  $this->data['rsMember']['member_id'];
					$ar['info_key'] =  $this->data['rsMember']['member_code'];
					
					$this->main_model->uploadsInfoFileGov($ar);
					
					redirect('dashboard/report/'.$ar['info_year_value']);
				} else {
					echo '<script>alert("เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง");window.location="'.base_url('/dashboard/report/'.$ar['info_year_value']).'";</script>';
				}
			}
			
		}
	}

	public function ajax_upload(){
		$storeFolder = $_SERVER["DOCUMENT_ROOT"]."/uploads/files/";
		if($this->input->post()!=null){
			$fileTmpLoc = @$_FILES["file"]["tmp_name"];
			if (!$fileTmpLoc) {
				echo "กรุณาเลือกไฟล์ และกดปุ่มอัพโหลด";
				exit();
			}
			$ar = $this->input->post();

			$file_type = $_FILES['file']['type']; //returns the mimetype
			$tempFile = $_FILES['file']['tmp_name'];
			
			$allowed = array("image/jpeg", "image/gif", "application/pdf");
			if(!in_array($file_type, $allowed)) {
				echo 'Only jpg, gif, and pdf files are allowed.';
				exit();;
			}
			
			$tmp	= explode(".",$_FILES['file']['name']);
			$tmp	= end($tmp);
			$tmpName = "info_".$this->data['rsMember']['member_id']."_".date("Ymdhis").".".$tmp;
			
			$targetFile =  $storeFolder.$tmpName;  //5
			
			if(move_uploaded_file($tempFile, $targetFile)){
				$ar['info_file_'.$ar['p_file']] =  $tmpName;
				$ar['info_member_id'] =  $this->data['rsMember']['member_id'];
				$ar['info_key'] =  $this->data['rsMember']['member_code'];
				unset($ar['p_file']);
			
				$this->main_model->uploadsInfoFileGov($ar);
				
				echo '<a class="btn btn-sm btn-theme" target="_blank" href="'.site_url().'uploads/files/'.$tmpName.'"><i class=\'bx bx-file\' ></i>ไฟล์เอกสาร</a> ';
			} else {
				echo "เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง";
			}
		}
	}

	public function ajax_verify_upload(){
		$storeFolder = $_SERVER["DOCUMENT_ROOT"]."/uploads/files/";
		if($this->input->post()!=null && $this->data['rsMember']['member_id']!=null){
			$fileTmpLoc = @$_FILES["file"]["tmp_name"];
			if (!$fileTmpLoc) {
				echo "กรุณาเลือกไฟล์ และกดปุ่มอัพโหลด";
				exit();
			}
			$ar = $this->input->post();
			$file_type = $_FILES['file']['type']; //returns the mimetype
			$tempFile = $_FILES['file']['tmp_name'];

			$allowed = array("image/jpeg", "image/gif", "application/pdf", "application/vnd.openxmlformats-officedocument.wordprocessingml.document");
			if(!in_array($file_type, $allowed)) {
				echo 'Only jpg, gif, docx and pdf files are allowed.';
				exit();;
			}
			
			$tmp	= explode(".",$_FILES['file']['name']);
			$tmp	= end($tmp);
			$tmpName = "verify_".$this->data['rsMember']['member_id']."_".date("Ymdhis").".".$tmp;
			
			$targetFile =  $storeFolder.$tmpName;  //5
			
			if(move_uploaded_file($tempFile, $targetFile)){
				$ar['verify_file_'.$ar['p_file']] =  $tmpName;
				$ar['verify_member_id'] =  $this->data['rsMember']['member_id'];
				$ar['verify_key'] =  $this->data['rsMember']['member_code'];
				unset($ar['p_file']);
				
				$this->main_model->uploadsVerifyFileGov($ar);
				
				echo '<a class="btn btn-sm btn-theme" target="_blank" href="'.site_url().'uploads/files/'.$tmpName.'">'.$tmpName.'</a> ';
			} else {
				echo "เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง";
			}
		}

	}

	public function info(){
		$year = $this->uri->segment(3);
		$ck = $this->main_model->getCkYear($year);
		if($ck==null){
			redirect('dashboard/database');
		}
		$do = $this->uri->segment(4);
		$rs = array();

		if($this->input->post()!=null){
			// $ar = $this->input->post();
			// $ar['dep_member_id']=$this->data['rsMember']['member_id'];
			// $ar['dep_year_value']=$year;
			// if($ar['dep_id']!=null){
			// 	$this->main_model->updateDepartment($ar);
			// }else{
			// 	$ar['dep_key'] = genKey();
			// 	$this->main_model->insertDepartment($ar);
			// }

			// //echo '<script>alert("บันทึกข้อมูลเรียบร้อย");window.location="'.base_url('/goverment/info/'.$year).'";</script>';
			// echo '<script>window.location="'.base_url('/dashboard/info/'.$year).'";</script>';
			// exit();
		}else{
			// if($do=="del"){
			// 	$rs = $this->main_model->delDepartmentDetail($this->uri->segment(5),$year,$this->data['rsMember']['member_id']);
			// }else if($do=="edit"){
				
			// 	$rs = $this->main_model->getDepartmentDetail($this->uri->segment(5),$year,$this->data['rsMember']['member_id']);
			// 	if($rs==null){
			// 		redirect('/dashboard/info/'.$year);
			// 	}
			// }

			$this->data['rs'] = $rs;
			$this->data['active'] = 'database';
			$this->data['view'] = 'dashboard/database_info';
			$this->data['rsFile'] = $this->main_model->getInfoFile($year, $this->data['rsMember']['member_id'], $this->data['rsMember']['member_code']);
			$this->data['rsDepartment'] = $this->main_model->getGovDepartment($year, $this->data['rsMember']['member_id'], $this->data['rsMember']['member_code']);
			$this->load->view("dashboard/template_main",$this->data);
		}
	}

	public function submit_save(){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		$year = $this->uri->segment(3);
		$ck = $this->main_model->getCkYear($year);
		if($ck==null){
			redirect('dashboard/database');
		}
		
		if($this->input->post()!=null){
			$ar = $this->input->post();

			$ar['submit_dep_id']=$this->uri->segment(4);
			$ar['submit_file'] = array();
			$file1 = @$ar['submit_file_temp'];
			$file2 = @$ar['submit_file2_temp'];
			$file3 = @$ar['submit_file3_temp'];
			
			if(@$_FILES["submit_file"]!=null){
				if($_FILES["submit_file"]['tmp_name']!=null){
					if ($_FILES["submit_file"]["type"]== "image/gif") {
						$ext = "gif";
					}elseif ($_FILES["submit_file"]["type"] == "image/pjpeg" || $_FILES["submit_file"]["type"] == "image/jpeg") {
						$ext = "jpg";
					}elseif ($_FILES["submit_file"]["type"] == "image/x-png"  || $_FILES["submit_file"]["type"] =="image/png") {
						$ext = "png";
					}elseif ($_FILES["submit_file"]["type"] == "application/pdf") {
						$ext = "pdf";
					}elseif ($_FILES["submit_file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
						$ext = "xlsx";
					}elseif ($_FILES["submit_file"]["type"] == "application/x-rar-compressed" || $_FILES["submit_file"]["type"] == "application/octet-stream") {
						$ext = "rar";
					}elseif ($_FILES["submit_file"]["type"] == "application/zip" || $_FILES["submit_file"]["type"] == "application/octet-stream" || $_FILES["submit_file"]["type"] == "application/x-zip-compressed" || $_FILES["submit_file"]["type"] == "multipart/x-zip") {
						$ext = "zip";
					}
					
					if(!empty($ext)) {
						$ints=date('YmdGis');
						$filenames = $this->data['rsMember']['member_id'].'_'.$ar['submit_scope_id'].'_'.$ints."1.".$ext;
						move_uploaded_file($_FILES["submit_file"]["tmp_name"],$_SERVER["DOCUMENT_ROOT"]."/uploads/files/".$filenames); 
						chmod($_SERVER["DOCUMENT_ROOT"]."/uploads/files/".$filenames, 0777);
						$file1 = $filenames;
					}else{
						echo '<script>alert("ไฟล์เอกสารไม่ถูกต้อง");window.location="'.base_url('/dashboard/submit/'.$year.'/'.$this->uri->segment(4).'/'.$this->uri->segment(5)).'";</script>';
						exit();
					}
				}
			}


			if(@$_FILES["submit_file2"]!=null){
				if($_FILES["submit_file2"]['tmp_name']!=null){
					if ($_FILES["submit_file2"]["type"]== "image/gif") {
						$ext = "gif";
					}elseif ($_FILES["submit_file2"]["type"] == "image/pjpeg" || $_FILES["submit_file2"]["type"] == "image/jpeg") {
						$ext = "jpg";
					}elseif ($_FILES["submit_file2"]["type"] == "image/x-png"  || $_FILES["submit_file2"]["type"] =="image/png") {
						$ext = "png";
					}elseif ($_FILES["submit_file2"]["type"] == "application/pdf") {
						$ext = "pdf";
					}
					if(!empty($ext)) {
						$ints=date('YmdGis');
						$filenames = $this->data['rsMember']['member_id'].'_'.$ar['submit_scope_id'].'_'.$ints."2.".$ext;
						move_uploaded_file($_FILES["submit_file2"]["tmp_name"],$_SERVER["DOCUMENT_ROOT"]."/uploads/files/".$filenames); 
						chmod($_SERVER["DOCUMENT_ROOT"]."/uploads/files/".$filenames, 0777);
						$file2 = $filenames;
					}else{
						echo '<script>alert("ไฟล์เอกสารไม่ถูกต้อง");window.location="'.base_url('/dashboard/submit/'.$year.'/'.$this->uri->segment(4).'/'.$this->uri->segment(5)).'";</script>';
						exit();
					}
				}
			}
			if(@$_FILES["submit_file3"]!=null){
				if($_FILES["submit_file3"]['tmp_name']!=null){
					if ($_FILES["submit_file3"]["type"]== "image/gif") {
						$ext = "gif";
					}elseif ($_FILES["submit_file3"]["type"] == "image/pjpeg" || $_FILES["submit_file3"]["type"] == "image/jpeg") {
						$ext = "jpg";
					}elseif ($_FILES["submit_file3"]["type"] == "image/x-png"  || $_FILES["submit_file3"]["type"] =="image/png") {
						$ext = "png";
					}elseif ($_FILES["submit_file3"]["type"] == "application/pdf") {
						$ext = "pdf";
					}
					if(!empty($ext)) {
						$ints=date('YmdGis');
						$filenames = $this->data['rsMember']['member_id'].'_'.$ar['submit_scope_id'].'_'.$ints."3.".$ext;
						move_uploaded_file($_FILES["submit_file3"]["tmp_name"],$_SERVER["DOCUMENT_ROOT"]."/uploads/files/".$filenames); 
						chmod($_SERVER["DOCUMENT_ROOT"]."/uploads/files/".$filenames, 0777);
						$file3 = $filenames;
					}else{
						echo '<script>alert("ไฟล์เอกสารไม่ถูกต้อง");window.location="'.base_url('/dashboard/submit/'.$year.'/'.$this->uri->segment(4).'/'.$this->uri->segment(5)).'";</script>';
						exit();
					}
				}
			}
			$ch_tab = @$ar['submit_tab'];
			unset($ar['submit_tab']);
			
			array_push($ar['submit_file'],array('file1'=>$file1));
			array_push($ar['submit_file'],array('file2'=>$file2));
			array_push($ar['submit_file'],array('file3'=>$file3));
			
			$ar['submit_file']=json_encode($ar['submit_file']);
			$ar['submit_detail']=json_encode($ar['submit_value']);
			$ar['submit_member_id']=$this->data['rsMember']['member_id'];
			unset($ar['submit_value']);
			unset($ar['submit_file_temp']);
			unset($ar['submit_file2_temp']);
			unset($ar['submit_file3_temp']);
		
			if($ar['submit_id']!=null){
				$this->main_model->updateSubmitDepartment($ar);
			}else{
				$this->main_model->insertSubmitDepartment($ar);
			}
	
			echo '<script>window.location="'.base_url('/dashboard/submit/'.$year.'/'.$this->uri->segment(4).'/'.$this->uri->segment(5)).'/?tab='.$ch_tab.'";</script>';
			exit();
		}
	}

	public function submit(){
		$year = $this->uri->segment(3);
		$ck = $this->main_model->getCkYear($year);
		if($ck==null){
			redirect('dashboard/database');
		}

		$rsDep = $this->main_model->getDepartment($year, $this->data['rsMember']['member_id'], $this->data['rsMember']['member_code']);

		if($this->input->post()!=null){
			$ar = $this->input->post();
			$ar['submit_dep_id']=$rsDep[0]->dep_id;

			if(@$_FILES["submit_file"]!=null){
				if($_FILES["submit_file"]['tmp_name']!=null){
					
					if ($_FILES["submit_file"]["type"]== "image/gif") {
						$ext = "gif";
					}elseif ($_FILES["submit_file"]["type"] == "image/pjpeg" || $_FILES["submit_file"]["type"] == "image/jpeg") {
						$ext = "jpg";
					}elseif ($_FILES["submit_file"]["type"] == "image/x-png"  || $_FILES["submit_file"]["type"] =="image/png") {
						$ext = "png";
					}elseif ($_FILES["submit_file"]["type"] == "application/pdf") {
						$ext = "pdf";
					}elseif ($_FILES["submit_file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") {
						$ext = "xlsx";
					}elseif ($_FILES["submit_file"]["type"] == "application/x-rar-compressed" || $_FILES["submit_file"]["type"] == "application/octet-stream") {
						$ext = "rar";
					}elseif ($_FILES["submit_file"]["type"] == "application/zip" || $_FILES["submit_file"]["type"] == "application/octet-stream" || $_FILES["submit_file"]["type"] == "application/x-zip-compressed" || $_FILES["submit_file"]["type"] == "multipart/x-zip") {
						$ext = "zip";
					}elseif ($_FILES["submit_file"]["type"] == "application/msword") {
						$ext = "doc";
					}elseif ($_FILES["submit_file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
						$ext = "docx";
					}
					
					
					if(!empty($ext)) {
						$ints=date('YmdGis');
						$filenames =  $this->data['rsMember']['member_id'].'_'.$ar['submit_scope_id'].'_'.$ints.".".$ext;
						move_uploaded_file($_FILES["submit_file"]["tmp_name"],$_SERVER["DOCUMENT_ROOT"]."/uploads/files/".$filenames); 
						chmod($_SERVER["DOCUMENT_ROOT"]."/uploads/files/".$filenames, 0777);
						$ar['submit_file'] = $filenames;
					}else{
						echo '<script>alert("ไฟล์เอกสารไม่ถูกต้อง");window.location="'.base_url('/dashboard/submit/'.$year.'/'.$this->uri->segment(4).'/'.$this->uri->segment(5)).'";</script>';
						exit();
					}
				}
			}

			$ch_tab = @$ar['submit_tab'];
			unset($ar['submit_tab']);

			$ar['submit_detail']=json_encode($ar['submit_value']);
			$ar['submit_total']=0;
			$ar['submit_member_id']=$this->data['rsMember']['member_id'];

			foreach($ar['submit_value'] as $val){
				$ar['submit_total'] += floatval($val);
			}
			unset($ar['submit_value']);

			if($ar['submit_id']!=null){
				$this->main_model->updateSubmitDepartment($ar);
			}else{
				$this->main_model->insertSubmitDepartment($ar);
			}
			
			echo '<script>window.location="'.base_url('/dashboard/submit/'.$year).'/?tab='.$ch_tab.'";</script>';
			exit();
		}

		if($this->uri->segment(4)=="del"){
			$submit_member_id = $this->data['rsMember']['member_id'];
			$submit_dep_id = $this->uri->segment(5);
			$submit_id = $this->uri->segment(6);
			$submit_scope_id = $this->uri->segment(7);
			$this->main_model->deleteSubmitDepartment($submit_id, $submit_dep_id, $submit_scope_id, $submit_member_id);
			//echo '<script>alert("บันทึกข้อมูลเรียบร้อย");window.location="'.base_url('/goverment/submit/'.$year.'/'.$this->uri->segment(5).'/'.$this->uri->segment(8)).'";</script>';
			echo '<script>window.location="'.base_url('/dashboard/submit/'.$year).'";</script>';
			exit();
		}
		
		if($rsDep==null){
			$ar_gen = array(
				'dep_member_id'	=> $this->data['rsMember']['member_id'],
				'dep_year_value'	=> $year,
				'dep_name'	=> 'ภาพรวม',
				'dep_key'	=> $this->data['rsMember']['member_code'],
				'createdate'	=> date('Y-m-d H:i:s')
			);
			$this->db->insert('member_department',$ar_gen);
			redirect('dashboard/submit/'.$year);
		}
		
		
		$this->data['rsScopeValue'] = $this->main_model->getScopeInSubmitValue($rsDep[0]->dep_id);
		$this->data['rsScope1'] = $this->main_model->getConfigEf(1,$year);
		$this->data['rsScopeGHG'] = $this->main_model->getConfigEf('GHG',$year);
		$this->data['rsScope2'] = $this->main_model->getConfigEf(2,$year);
		$this->data['rsScope3'] = $this->main_model->getConfigEf(3,$year);
		$this->data['rsScope4'] = $this->main_model->getConfigEf(4,$year);

		
		$this->data['active'] = 'database';
		$this->data['view'] = 'dashboard/database_submit';
		$this->data['rsDep'] = $rsDep;
		$this->data['rsDepartment'] = $this->main_model->getGovDepartment($year, $this->data['rsMember']['member_id'], $this->data['rsMember']['member_code']);
		$this->load->view("dashboard/template_main",$this->data);
	}

	public function getWaste(){
		$pv_id = $this->data['rsMember']['member_province_id'];
		if($pv_id!=null){
			$trash_component = $this->main_model->getWastePV($pv_id);
			$this->data['trash_component'] = $trash_component;
			$this->data['sub'] = $this->input->get('sub');

			$this->load->view("dashboard/trash_component",$this->data);
		}
	}


	public function fr(){
		$year = $this->uri->segment(3);
		$ck = $this->main_model->getCkYear($year);
		if($ck==null){
			redirect('dashboard/database');
		}

		if($this->input->post()!=null){
			$ar = $this->input->post();
			$ar_post['fr_year_value'] = $ar['fr_year_value'];
			$ar_post['fr_member_id'] = $this->data['rsMember']['member_id'];
			$ar_post['fr_key'] = $this->data['rsMember']['member_code'];

			if($ar['fr_no']==1){
				if(@$_FILES["org_logo"]!=null){
					if($_FILES["org_logo"]['tmp_name']!=null){
						if ($_FILES["org_logo"]["type"]== "image/gif") {
							$ext = "gif";
						}elseif ($_FILES["org_logo"]["type"] == "image/pjpeg" || $_FILES["org_logo"]["type"] == "image/jpeg") {
							$ext = "jpg";
						}elseif ($_FILES["org_logo"]["type"] == "image/x-png"  || $_FILES["org_logo"]["type"] =="image/png") {
							$ext = "png";
						}
						if(!empty($ext)) {
							$ints=date('YmdGis').'-logo';
							$filenames = $this->data['rsMember']['member_id'].'_fr1_'.$ints.".".$ext;
							move_uploaded_file($_FILES["org_logo"]["tmp_name"],$_SERVER["DOCUMENT_ROOT"]."/uploads/files/".$filenames); 
							chmod($_SERVER["DOCUMENT_ROOT"]."/uploads/files/".$filenames, 0777);
							$ar['org_logo'] = $filenames;
						}else{
							echo '<script>alert("ไฟล์เอกสารไม่ถูกต้อง กรุณาเลือกไฟล์  jpeg, jpg, png เท่านั้น");window.location="'.base_url('/dashboard/fr/'.$year.'/?fr=1').'";</script>';
							exit();
						}
					}else{
						$ar['org_logo'] = $ar['h_org_logo'];
					}
				}
				if(@$_FILES["org_image"]!=null){
					if($_FILES["org_image"]['tmp_name']!=null){
						if ($_FILES["org_image"]["type"]== "image/gif") {
							$ext = "gif";
						}elseif ($_FILES["org_image"]["type"] == "image/pjpeg" || $_FILES["org_image"]["type"] == "image/jpeg") {
							$ext = "jpg";
						}elseif ($_FILES["org_image"]["type"] == "image/x-png"  || $_FILES["org_image"]["type"] =="image/png") {
							$ext = "png";
						}
						if(!empty($ext)) {
							$ints=date('YmdGis').'-image';
							$filenames = $this->data['rsMember']['member_id'].'_fr1_'.$ints.".".$ext;
							move_uploaded_file($_FILES["org_image"]["tmp_name"],$_SERVER["DOCUMENT_ROOT"]."/uploads/files/".$filenames); 
							chmod($_SERVER["DOCUMENT_ROOT"]."/uploads/files/".$filenames, 0777);
							$ar['org_image'] = $filenames;
						}else{
							echo '<script>alert("ไฟล์เอกสารไม่ถูกต้อง กรุณาเลือกไฟล์  jpeg, jpg, png เท่านั้น");window.location="'.base_url('/dashboard/fr/'.$year.'/?fr=1').'";</script>';
							exit();
						}
					}else{
						$ar['org_image'] = $ar['h_org_image'];
						
					}
				}
				
				$ar_post['fr_detail'] = json_encode($ar);
			}else if($ar['fr_no']==2){
				if(@$_FILES["org_blueprint"]!=null){
					if($_FILES["org_blueprint"]['tmp_name']!=null){
						if ($_FILES["org_blueprint"]["type"]== "image/gif") {
							$ext = "gif";
						}elseif ($_FILES["org_blueprint"]["type"] == "image/pjpeg" || $_FILES["org_blueprint"]["type"] == "image/jpeg") {
							$ext = "jpg";
						}elseif ($_FILES["org_blueprint"]["type"] == "image/x-png"  || $_FILES["org_blueprint"]["type"] =="image/png") {
							$ext = "png";
						//}elseif ($_FILES["org_blueprint"]["type"] == "application/pdf") {
						//	$ext = "pdf";
						}
						if(!empty($ext)) {
							$ints=date('YmdGis');
							$filenames = $this->data['rsMember']['member_id'].'_fr2_'.$ints.".".$ext;
							move_uploaded_file($_FILES["org_blueprint"]["tmp_name"],$_SERVER["DOCUMENT_ROOT"]."/uploads/files/".$filenames); 
							chmod($_SERVER["DOCUMENT_ROOT"]."/uploads/files/".$filenames, 0777);
							$ar_post['org_blueprint'] = $filenames;
						}else{
							echo '<script>alert("ไฟล์เอกสารไม่ถูกต้อง กรุณาเลือกไฟล์  jpeg, jpg, png เท่านั้น");window.location="'.base_url('/dashboard/fr/'.$year.'/?fr=2').'";</script>';
							exit();
						}
					}else{
						echo '<script>alert("ยังไม่ได้เลือกไฟล์");window.location="'.base_url('/dashboard/fr/'.$year.'/?fr=2').'";</script>';
						exit();
					}
				}
			}else if($ar['fr_no']==3){
				if(@$_FILES["org_diagram"]!=null){
					if($_FILES["org_diagram"]['tmp_name']!=null){
						if ($_FILES["org_diagram"]["type"]== "image/gif") {
							$ext = "gif";
						}elseif ($_FILES["org_diagram"]["type"] == "image/pjpeg" || $_FILES["org_diagram"]["type"] == "image/jpeg") {
							$ext = "jpg";
						}elseif ($_FILES["org_diagram"]["type"] == "image/x-png"  || $_FILES["org_diagram"]["type"] =="image/png") {
							$ext = "png";
						}
						if(!empty($ext)) {
							$ints=date('YmdGis');
							$filenames = $this->data['rsMember']['member_id'].'_fr3_'.$ints.".".$ext;
							move_uploaded_file($_FILES["org_diagram"]["tmp_name"],$_SERVER["DOCUMENT_ROOT"]."/uploads/files/".$filenames); 
							chmod($_SERVER["DOCUMENT_ROOT"]."/uploads/files/".$filenames, 0777);
							$ar_post['org_diagram'] = $filenames;
						}else{
							echo '<script>alert("ไฟล์เอกสารไม่ถูกต้อง กรุณาเลือกไฟล์  jpeg, jpg, png เท่านั้น");window.location="'.base_url('/dashboard/fr/'.$year.'/?fr=3').'";</script>';
							exit();
						}
					}else{
						echo '<script>alert("ยังไม่ได้เลือกไฟล์");window.location="'.base_url('/dashboard/fr/'.$year.'/?fr=3').'";</script>';
						exit();
					}
				}
			}

			$rs = $this->main_model->setGovermentFr($ar_post);
			echo '<script>alert("บันทึกข้อมูลเรียบร้อย");window.location="'.base_url('/dashboard/fr/'.$year.'/?fr='.$ar['fr_no']).'";</script>';
			exit();
		}

		$this->data['rsGovermentFr'] = $this->main_model->getGovermentFr($year, $this->data['rsMember']['member_id'], $this->data['rsMember']['member_code']);
		$this->data['active'] = 'database';
		$this->data['getSubScope'] = $this->main_model->getCountSubScope();
		$this->data['getFr04'] = $this->main_model->getFr04($year);
		$this->data['rsScopeValue'] = $this->main_model->getSumScopeValue($year, $this->data['rsMember']['member_id'], $this->data['rsMember']['member_code']);
		
		$this->data['view'] = 'dashboard/database_fr';
		$this->data['ef'] = $this->main_model->getEF($year);
		$this->load->view("dashboard/template_main",$this->data);
	}

	public function report(){
		$year = $this->uri->segment(3);
		$ck = $this->main_model->getCkYear($year);
		if($ck==null){
			redirect('dashboard/database');
		}

		$this->data['rsGovermentFr'] = $this->main_model->getGovermentFr($year,$this->data['rsMember']['member_id'], $this->data['rsMember']['member_code']);
		$this->data['rsGovermentInfo'] = $this->main_model->getInfoFile($year,$this->data['rsMember']['member_id'], $this->data['rsMember']['member_code']);
		$this->data['active'] = 'database';
		$this->data['view'] = 'dashboard/database_report';
		$this->load->view("dashboard/template_main",$this->data);
	}

	public function verify(){
		$year = $this->uri->segment(3);
		$ck = $this->main_model->getCkYear($year);
		if($ck==null){
			redirect('dashboard/database');
		}

		$this->data['active'] = 'database';
		$this->data['rsFile'] = $this->main_model->getVerifyFile($year,$this->data['rsMember']['member_id'], $this->data['rsMember']['member_code']);
		$this->data['view'] = 'dashboard/database_verify';
		$this->load->view("dashboard/template_main",$this->data);
	}
}
