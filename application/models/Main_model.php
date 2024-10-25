<?php 
class Main_model extends CI_Model{
	public function __contruct()
	{
		parent::__contruct();
	}

	public function getYearDefault($type=null){
		$query = $this->db->get_where('config_year', array('active' => 1, 'deleted'=>0));
		$ckyear =  $query->result_array()[0]['year_value'];

		$this->db->select("t1.dep_id, t1.dep_year_value, t1.dep_key, t2.member_id, t2.member_name, t2.member_lat, t2.member_lon, t2.member_type_id, t3.type_name");
		$this->db->from('member_department t1'); 
		$this->db->join('member t2', 't1.dep_member_id=t2.member_id', 'left'); 
		$this->db->join('member_type t3', 't2.member_type_id=t3.type_id', 'left'); 
		$this->db->where('t1.dep_year_value', $ckyear);
		if($type!=null){
			$this->db->where('t3.type_id', $type);
		}
		
		$query = $this->db->get();
		return  $query->result_array();
	}

	public function getTargetData($target_year_value, $target_member_id, $target_key){
		$query = $this->db->get_where('member_target', array('target_member_id' => $target_member_id, 'target_year_value'=>$target_year_value, 'target_key'=>$target_key));
		return  $query->result_array();
	}

	public function getMemberForMarker($year_value, $member_province_id=null){
		$this->db->select("t1.member_id,t1.member_name, t1.member_addr, t1.member_lat, t1.member_lon, t2.PROVINCE_NAME, t3.AMPHUR_NAME, t4.DISTRICT_NAME");
		$this->db->from('member t1'); 
		$this->db->join('z_province t2', 't1.member_province_id=t2.PROVINCE_ID', 'left');
		$this->db->join('z_amphur t3', 't1.member_amphur_id=t3.AMPHUR_ID', 'left');
		$this->db->join('z_district t4', 't1.member_district_id=t4.DISTRICT_ID', 'left');
		if($member_province_id!=null){
			$this->db->where('t1.member_province_id', $member_province_id);
		}
		$this->db->where('t1.deleted', 0);
		$this->db->where('t1.status', 1);
		$query = $this->db->get();
		return  $query->result_array();
	}

	function calScopeTruck2($t1, $t2, $t3, $category_form, $no){
		if($no==1){
			return floatval($t1)*floatval($t2);
		}else{
			if($category_form==5){
				return floatval($t2)*floatval($t3);
			}else if($category_form==6){
				return floatval($t2)*floatval($t3);
			}else if($category_form==7){
				return floatval($t2)*floatval($t3);
			}else if($category_form==8){
				return floatval($t2)*floatval($t3);
			}
		}
	}

	public function getWastePV($trash_province_id){
		$query = $this->db->get_where('component_trash', array('trash_province_id' => $trash_province_id));
		return $query->result();
	}

	public function ckRegisterEmail($member_email){
		if($member_email!="admin@admin.com"){
			//chk member
			$query = $this->db->get_where('member', array('member_email' => $member_email));
			$rs = $query->result();
			if($rs!=null){
				return 1;
			}
		}else{
			return 1;
		}
	}

	public function login($username, $password){
		$query = $this->db->get_where('member', array('member_email' => $username, 'member_password'=>$password,  'deleted'=>0));
		$rs = $query->result();
		if($rs){
			return $rs;
		}else{
			
				$query = $this->db->get_where('admin', array('username' => $username, 'password'=>$password, 'is_admin'=>1));
				$rs = $query->result();
				if($rs){
					return $rs;
				}
			
			
		}
	}

	public function getMemberType(){
		$query = $this->db->order_by('type_no ASC')->get('member_type');
		return $query->result_array();
	}

    public function getProvinceList(){
		$query = $this->db->order_by('PROVINCE_NAME ASC')->get('z_province');
		return $query->result();
	}
	public function getAM($PROVINCE_ID){
		$query = $this->db->order_by('AMPHUR_NAME ASC')->get_where('z_amphur', array('PROVINCE_ID' => $PROVINCE_ID));
		return $query->result();
	}
	public function getDis($AMPHUR_ID){
		$query = $this->db->order_by('DISTRICT_NAME ASC')->get_where('z_district', array('AMPHUR_ID' => $AMPHUR_ID));
		return $query->result();
	}
	public function getProvinceDetail($PROVINCE_ID){
		$query = $this->db->order_by('PROVINCE_NAME ASC')->get_where('z_province', array('PROVINCE_ID'=>$PROVINCE_ID));
		return $query->result();
	}
	public function getAmphurDetail($AMPHUR_ID){
		$query = $this->db->order_by('AMPHUR_NAME ASC')->get_where('z_amphur', array('AMPHUR_ID'=>$AMPHUR_ID));
		return $query->result();
	}

    public function insertNewMember($ar){
		$this->db->insert('member',$ar);
		return $this->db->insert_id();
	}

	public function getMemberDetailBycode($member_code){
		$this->db->select("t1.*, t2.PROVINCE_NAME, t3.AMPHUR_ID, t3.AMPHUR_NAME, t4.DISTRICT_NAME");
		$this->db->from('member t1'); 
		$this->db->join('z_province t2', 't1.member_province_id=t2.PROVINCE_ID', 'left');
		$this->db->join('z_amphur t3', 't1.member_amphur_id=t3.AMPHUR_ID', 'left');
		$this->db->join('z_district t4', 't1.member_district_id=t4.DISTRICT_ID', 'left');
		$this->db->where('t1.member_code', $member_code);
		$query = $this->db->get();
		return  $query->result_array();
	}

	public function getMemberDetail($member_id){
		$this->db->select("t1.*, t2.PROVINCE_NAME, t3.AMPHUR_ID, t3.AMPHUR_NAME, t4.DISTRICT_NAME");
		$this->db->from('member t1'); 
		$this->db->join('z_province t2', 't1.member_province_id=t2.PROVINCE_ID', 'left');
		$this->db->join('z_amphur t3', 't1.member_amphur_id=t3.AMPHUR_ID', 'left');
		$this->db->join('z_district t4', 't1.member_district_id=t4.DISTRICT_ID', 'left');
		$this->db->where('t1.member_id', $member_id);
		$query = $this->db->get();
		return  $query->result_array();
	}

	public function updateMemberChangePassword($ar){
		$query = $this->db->get_where('member', array('member_id' => $ar['member_id'], 'member_code' => $ar['member_code'], 'member_password' => md5(sha1($ar['o_password']))));
		$rs = $query->result();
		if($rs!=null){
			$this->db->where('member_id',$ar['member_id']);
			$this->db->where('member_code',$ar['member_code']);
			$this->db->update('member', array('member_password'=> md5(sha1($ar['n_password'])) ));
			return $this->db->affected_rows();
		}
	}


	//faculty
	public function getFacultyList($faculty_member_id){
		$query = $this->db->order_by('faculty_id ASC')->get_where('member_faculty', array('faculty_member_id'=>$faculty_member_id, 'deleted'=>0));
		return $query->result_array();
	}
	public function getFacultyDetail($faculty_code, $faculty_member_id){
		// $query = $this->db->get_where('member_faculty', array('faculty_member_id'=>$faculty_member_id, 'faculty_code'=>$faculty_code));
		// return $query->result_array();

		$this->db->select("*");
		$this->db->from('member_faculty t1'); 
		$this->db->join('member t2', 't1.faculty_member_id=t2.member_id', 'left');
		$this->db->where('t1.faculty_member_id', $faculty_member_id);
		$this->db->where('t1.faculty_code', $faculty_code);
		$query = $this->db->get();
		return  $query->result_array();
	}



	//Gov
	public function ckPermissionGov($member_id){
		$query = $this->db->get_where('member', array('member_id' => $member_id));
		return $query->result();
	}
	public function get_data_w_array($table, $array){
		$query = $this->db->get_where($table, $array);
		return $query->result();
	}

	public function getGovYearData($member_id, $info_key){
		$query = $this->db->get_where('member_info', array('info_member_id' => $member_id, 'info_key'=>$info_key));
		return $query->result();
	}

	public function getCkYear($year_value){
		$query = $this->db->get_where('config_year', array('year_value' => $year_value, 'deleted'=>0));
		return $query->result();
	}
	public function getInfoFile($info_year_value, $info_member_id, $info_key){
		$query = $this->db->get_where('member_info', array('info_year_value' => $info_year_value, 'info_member_id' => $info_member_id, 'info_key' => $info_key));
		return $query->result();
	}

	public function getGovDepartment($dep_year_value, $dep_member_id, $dep_key){
		$query = $this->db->get_where('member_department', array('dep_year_value' => $dep_year_value, 'dep_member_id' => $dep_member_id, 'dep_key' => $dep_key,'deleted'=>0));
		return $query->result();
	}
	public function uploadsInfoFileGov($ar){
		$query = $this->db->get_where('member_info', array('info_year_value' => $ar['info_year_value'], 'info_member_id' => $ar['info_member_id'], 'info_key' => $ar['info_key']));
		$rs= $query->result();
		if($rs!=null){
			$this->db->where('info_year_value',$ar['info_year_value']);
			$this->db->where('info_member_id',$ar['info_member_id']);
			$this->db->where('info_key',$ar['info_key']);
			$this->db->update('member_info',$ar);
		}else{
			$ar['createdate']=date('Y-m-d H:i:s');
			$this->db->insert('member_info',$ar);
			return $this->db->insert_id();
		}
	}

	public function updateDepartment($ar){
		$this->db->where('dep_id',$ar['dep_id']);
		$this->db->where('dep_member_id',$ar['dep_member_id']);
		$this->db->where('dep_year_value',$ar['dep_year_value']);
		$this->db->update('member_department', array('dep_name'=>$ar['dep_name']));
	}
	
	public function insertDepartment($ar){
		$ar['createdate']=date('Y-m-d H:i:s');
		$this->db->insert('member_department',$ar);
		return $this->db->insert_id();
	}

	public function getDepartment($dep_year_value, $dep_member_id , $dep_key){
		$query = $this->db->get_where('member_department', array('dep_year_value' => $dep_year_value, 'dep_member_id' => $dep_member_id, 'dep_key' => $dep_key, 'deleted'=>0));
		return $query->result();
	}

	public function delDepartmentDetail($dep_id, $dep_year_value, $dep_member_id){
		$this->db->where('dep_id',$dep_id);
		$this->db->where('dep_year_value',$dep_year_value);
		$this->db->where('dep_member_id',$dep_member_id);

		$this->db->update('member_department', array('deleted'=>1));
	}

	public function getDepartmentDetail($dep_id, $dep_year_value, $dep_member_id){
		$query = $this->db->get_where('member_department', array('dep_id' => $dep_id, 'dep_year_value' => $dep_year_value, 'dep_member_id' => $dep_member_id, 'deleted'=>0));
		return $query->result();
	}

	public function getDepartmentSubmitDetail($dep_year_value, $dep_id, $dep_key,$dep_member_id){
		$query = $this->db->get_where('member_department', array('dep_year_value'=>$dep_year_value, 'dep_id' => $dep_id, 'dep_key' => $dep_key, 'dep_member_id'=>$dep_member_id));
		return $query->result();
	}

	public function deleteSubmitDepartment($submit_id, $submit_dep_id, $submit_scope_id, $submit_member_id){
		$this->db->where('submit_id',$submit_id);
		$this->db->where('submit_dep_id',$submit_dep_id);
		$this->db->where('submit_scope_id',$submit_scope_id);
		$this->db->where('submit_member_id',$submit_member_id);
		
		$this->db->update('member_submit', array('deleted'=>1));
	}

	public function getConfigEf($scope_group,$year){
		$query = $this->db->order_by('s_qno ASC')->get_where('scope_group', array('s_id'=>$scope_group,'deleted' => 0));
		$result = array();
		foreach ($query->result() as $k => $v) {
			$result[$v->s_id] = array(
				'count' => 0,
				'name' => $v->s_name,
				'subgroup' => array(),
			);
			$query2 = $this->db->get_where('scope_info_subgroup', array('scope_group'=>$v->s_id,'deleted' => 0));
			foreach ($query2->result() as $kk => $vv) {
				$result[$v->s_id]['count']++;
				$result[$v->s_id]['subgroup'][$kk+1] = array(
					'count' => 0,
					'name' => $vv->ss_name,
					'list' => array(),
				);
				$query3 = $this->db->get_where('scope_info', array('scope_group'=>$v->s_id,'scope_sub_group'=>$kk+1,'scope_year'=>$year,'deleted' => 0));
				foreach ($query3->result() as $kkk => $vvv) {
					$result[$v->s_id]['count']++;
					$result[$v->s_id]['subgroup'][$kk+1]['count']++;
					$dataRow = array(
						'scope_id' => $vvv->scope_id,
						'scope_name' => $vvv->scope_name,
						'scope_category' => (json_decode($vvv->scope_detail,true))['category_form'],
						'scope_unit' => (json_decode($vvv->scope_detail,true))[2]
					);
					array_push($result[$v->s_id]['subgroup'][$kk+1]['list'],$dataRow);
				}
			}
		}
		return  $result[$scope_group]['subgroup'];
	}

	public function getScopeInSubmitValue($submit_dep_id){
		$query = $this->db->get_where('member_submit', array('submit_dep_id' => $submit_dep_id, 'deleted' => 0));
		return $query->result();
	}

	public function insertSubmitDepartment($ar){
		$ar['createdate']=date('Y-m-d H:i:s');
		$this->db->insert('member_submit',$ar);
		return $this->db->insert_id();
	}
	
	public function updateSubmitDepartment($ar){
		$this->db->where('submit_id',$ar['submit_id']);
		$this->db->where('submit_dep_id',$ar['submit_dep_id']);
		$this->db->where('submit_scope_id',$ar['submit_scope_id']);
		$this->db->where('submit_member_id',$ar['submit_member_id']);
		$this->db->update('member_submit', $ar);
	}
	
	public function getEF($year){
		$query = $this->db->order_by('s_qno ASC')->get_where('scope_group', array('deleted' => 0));
		$result = array();
		foreach ($query->result() as $k => $v) {
			$result[$v->s_id] = array();
			$query2 = $this->db->get_where('scope_info_subgroup', array('scope_group'=>$v->s_id,'deleted' => 0));
			foreach ($query2->result() as $kk => $vv) {
				$result[$v->s_id][$kk+1] = array();
				$query3 = $this->db->get_where('scope_info', array('scope_group'=>$v->s_id,'scope_sub_group'=>$kk+1,'scope_year'=>$year,'deleted' => 0));
				foreach ($query3->result() as $kkk => $vvv) {
					$result[$v->s_id][$kk+1][$kkk+1] = json_decode($vvv->scope_detail,true);
				}
			}
		}
		return $result;
	}

	
	public function getSumScopeValue($dep_year_value, $dep_member_id, $dep_key){
		$count = array();
		$rs = array();
		$query = $this->db->get_where('member_department', array('dep_year_value' => $dep_year_value, 'dep_member_id'=>$dep_member_id, 'dep_key'=>$dep_key, 'deleted' => 0));
		foreach($query->result_array() as $row){
			$subRs = array();
			$subQuery = $this->db->get_where('member_submit', array('submit_dep_id' => $row['dep_id'], 'submit_member_id'=>$dep_member_id, 'deleted' => 0));
			foreach($subQuery->result_array() as $subRow){
				$scopeQuery = $this->db->get_where('scope_info', array('scope_id' => $subRow['submit_scope_id'], 'deleted' => 0));
				$category_form = json_decode(($scopeQuery->result())[0]->scope_detail,true)['category_form'];
				if($category_form == 1 || $category_form >= 10){ //ผลรวม + การรั่วไหล
					if($subRow['submit_total']!=0){
						if(!empty($rs[$subRow['submit_scope_id']])){
							$rs[$subRow['submit_scope_id']]['submit_total'] += floatval($subRow['submit_total']);
						}else{
							$subRs = array(
								'scope_id' => ($scopeQuery->result())[0]->scope_id,
								'scope_name' => ($scopeQuery->result())[0]->scope_name,
								'scope_category' => $category_form,
								'submit_total' => floatval($subRow['submit_total']),
							);
							$rs[$subRow['submit_scope_id']] = $subRs;
							@$count[($scopeQuery->result())[0]->scope_group][($scopeQuery->result())[0]->scope_sub_group] += 1;
						}
					}
				}else if($category_form == 2){ //กระบวนการบำบัดน้ำเสีย
					//cal
					if(!empty($subRow['submit_detail'])){
						$submit_detail = json_decode($subRow['submit_detail'],true);
						$total = 0;
						for($i=1;$i<=12;$i++){
							$total += floatval($submit_detail['value_mass_'.$i]) * floatval($submit_detail['bod_'.$i]);
						}
						$submit_total = calculateEF(getMCF_65($submit_detail["val_type"]),$total/1000);
						
						$detail = array(
							'scope_name' => getTTtype($submit_detail['val_type']),
							'submit_type' => $submit_detail['val_type'],
							//'submit_detail' => $subRow['submit_detail'],
							'submit_total' => $submit_total
						);
					}

					if(!empty($rs[$subRow['submit_scope_id']])){
						foreach($rs[$subRow['submit_scope_id']]['scope_detail'] as $k=>$loop){
							if($loop['submit_type']==$detail['submit_type']){
								$rs[$subRow['submit_scope_id']]['scope_detail'][$k]['submit_total']+=rmComma($submit_total);
							}else{
								$ck_ = 0;
								foreach($rs[$subRow['submit_scope_id']]['scope_detail'] as $c_loop){
									if($c_loop['submit_type']==$detail['submit_type']){
										$ck_ = 1;
									}
								}
								if($ck_==0){
									array_push($rs[$subRow['submit_scope_id']]['scope_detail'],$detail);
									@$count[($scopeQuery->result())[0]->scope_group][($scopeQuery->result())[0]->scope_sub_group] += 1;
								}
								
								
							}
						}
						
					}else{
						$subRs = array(
							'scope_id' => ($scopeQuery->result())[0]->scope_id,
							'scope_name' => ($scopeQuery->result())[0]->scope_name,
							'scope_category' => $category_form,
							'scope_detail' => array(),
						);
						$rs[$subRow['submit_scope_id']] = $subRs;
						array_push($rs[$subRow['submit_scope_id']]['scope_detail'],$detail);
						@$count[($scopeQuery->result())[0]->scope_group][($scopeQuery->result())[0]->scope_sub_group] += 1;
						
					}
					
				}else if($category_form == 3){ //การปล่อยก๊าซมีเทนในระบบ Septic tanks
					//cal
					$submit_total = 0;
					if(!empty($subRow['submit_detail'])){
						$submit_detail = json_decode($subRow['submit_detail'],true);
						$total = 0;
						for($i=1;$i<=12;$i++){
							$total += 1*1*(floatval($submit_detail["value_pop_".$i])*18.3*0.001*1*floatval($submit_detail["value_day_".$i]))*(0.6*0.5);
						}
						$submit_total = $total;
					}

					if(!empty($rs[$subRow['submit_scope_id']])){
						$rs[$subRow['submit_scope_id']]['submit_total'] += $submit_total;
					}else{
						$subRs = array(
							'scope_id' => ($scopeQuery->result())[0]->scope_id,
							'scope_name' => ($scopeQuery->result())[0]->scope_name,
							'scope_category' => $category_form,
							'submit_total' => $submit_total,
						);
						$rs[$subRow['submit_scope_id']] = $subRs;
						@$count[($scopeQuery->result())[0]->scope_group][($scopeQuery->result())[0]->scope_sub_group] += 1;
					}
				}else if($category_form == 4){ //การกำจัดของเสีย/ขยะมูลฝอย
					//cal
					if(!empty($subRow['submit_detail'])){
						$total_type = array();
						$submit_detail = json_decode($subRow['submit_detail'],true);
						$doc = 0;
						for($i=1;$i<=12;$i++){
							$doc += @($submit_detail["value_proportion_".$i]*$submit_detail["value_doc_".$i])/100;
						}
						$doc = $doc/100;
						$mcf = getMCFTrash($submit_detail["val_type"]);
						if (array_key_exists($submit_detail["val_type"],$total_type)){
							if($submit_detail["val_type"]<4){
								$submit_total += rmComma(calculateTrash($doc,$mcf,@$submit_detail["trash_year"],@$submit_detail["trash_value"]));
							}else if(@$submit_detail["val_type"]==4){
								$submit_total += rmComma(calculateTrash4(@$submit_detail["trash_year"],@$submit_detail["trash_value"]));
							}else if(@$submit_detail["val_type"]==5){
								$submit_total += rmComma(calculateTrash5(@$submit_detail["trash_year"],@$submit_detail["trash_value"]));
							}else if(@$submit_detail["val_type"]==6){
								$submit_total[0] += rmComma(calculateTrash6(@$submit_detail["trash_year"],@$submit_detail["trash_value"]));
								$submit_total[1] += rmComma(calculateTrash8(@$submit_detail["trash_year"],@$submit_detail["trash_value"]));
							}else if(@$submit_detail["val_type"]==7){
								$submit_total += rmComma(calculateTrash7(@$submit_detail["trash_year"],@$submit_detail["trash_value"]));
							}else if(@$submit_detail["val_type"]==8){
								$submit_total += rmComma(calculateTrash($doc,$mcf,@$submit_detail["trash_year"],@$submit_detail["trash_value"]));
							}else if(@$submit_detail["val_type"]==9){
								$submit_total += rmComma(calculateTrash4(@$submit_detail["trash_year"],@$submit_detail["trash_value"]));
							}else if(@$submit_detail["val_type"]==10){
								$submit_total += rmComma(calculateTrash7(@$submit_detail["trash_year"],@$submit_detail["trash_value"]));
							}
						}else{
							if($submit_detail["val_type"]<4){
								$submit_total = rmComma(calculateTrash($doc,$mcf,@$submit_detail["trash_year"],@$submit_detail["trash_value"]));
								$submit_unit = 'kgCH<sub>4</sub>';
							}else if(@$submit_detail["val_type"]==4){
								$submit_total = rmComma(calculateTrash4(@$submit_detail["trash_year"],@$submit_detail["trash_value"]));
								$submit_unit = 'kgCO<sub>2</sub>';
							}else if(@$submit_detail["val_type"]==5){
								$submit_total = rmComma(calculateTrash5(@$submit_detail["trash_year"],@$submit_detail["trash_value"]));
								$submit_unit = 'kgCO<sub>2</sub>';
							}else if(@$submit_detail["val_type"]==6){
								$submit_total = rmComma(calculateTrash6(@$submit_detail["trash_year"],@$submit_detail["trash_value"])) + (rmComma(calculateTrash8(@$submit_detail["trash_year"],@$submit_detail["trash_value"]))*25);
								$submit_unit = 'kgCO<sub>2</sub>';
							}else if(@$submit_detail["val_type"]==7){
								$submit_total = rmComma(calculateTrash7(@$submit_detail["trash_year"],@$submit_detail["trash_value"])) ;
								$submit_unit = 'kgCO<sub>2</sub>';
							}else if(@$submit_detail["val_type"]==8){
								$submit_total = (rmComma(calculateTrash($doc,$mcf,@$submit_detail["trash_year"],@$submit_detail["trash_value"]))*44)/14;
								$submit_unit = 'kgCO<sub>2</sub>';
							}else if(@$submit_detail["val_type"]==9){
								$submit_total = rmComma(calculateTrash4(@$submit_detail["trash_year"],@$submit_detail["trash_value"]));
								$submit_unit = 'kgCO<sub>2</sub>';
							}else if(@$submit_detail["val_type"]==10){
								$submit_total = (rmComma(calculateTrash7(@$submit_detail["trash_year"],@$submit_detail["trash_value"]))*44)/14;
								$submit_unit = 'kgCO<sub>2</sub>';
							}
						}
						
						$detail = array(
							'scope_name' => getTrashType2565($submit_detail['val_type']),
							'submit_type' => $submit_detail['val_type'],
							'submit_detail' => $subRow['submit_detail'],
							'submit_total' => $submit_total,
							'submit_unit' => $submit_unit,
						);
					}

					if(!empty($rs[$subRow['submit_scope_id']])){
						array_push($rs[$subRow['submit_scope_id']]['scope_detail'],$detail);
					}else{
						$subRs = array(
							'scope_id' => ($scopeQuery->result())[0]->scope_id,
							'scope_name' => ($scopeQuery->result())[0]->scope_name,
							'scope_category' => $category_form,
							'scope_detail' => array(),
						);
						$rs[$subRow['submit_scope_id']] = $subRs;
						array_push($rs[$subRow['submit_scope_id']]['scope_detail'],$detail);
					}
					@$count[($scopeQuery->result())[0]->scope_group][($scopeQuery->result())[0]->scope_sub_group] += 1;
				}else if($category_form >= 5 && $category_form <= 8){ //การจ้างเหมารับช่วงของการขนส่งขยะ/มูลฝอย
					//cal
					$submit_total = 0;
					$submit_total2 = 0;
					if(!empty($subRow['submit_detail'])){
						$submit_detail = json_decode($subRow['submit_detail'],true);
						$total = 0;
						$total2 = 0;
						for($i=1;$i<=12;$i++){
							$total += $this->calScopeTruck2($submit_detail["value_1_".$i], $submit_detail["value_2_".$i], $submit_detail["value_3_".$i], $category_form, 1);
							$total2 += $this->calScopeTruck2($submit_detail["value_1_".$i], $submit_detail["value_2_".$i], $submit_detail["value_3_".$i], $category_form, 2);
						}
						$submit_total = $total;
						$submit_total2 = $total2;
					}

					if(!empty($rs[$subRow['submit_scope_id']])){
						$rs[$subRow['submit_scope_id']]['submit_total'] += $submit_total;
						$rs[$subRow['submit_scope_id']+1]['submit_total'] += $submit_total2;
					}else{
						$subRs = array(
							'scope_id' => ($scopeQuery->result())[0]->scope_id,
							'scope_name' => ($scopeQuery->result())[0]->scope_name,
							'scope_category' => $category_form,
							'submit_total' => $submit_total,
						);
						$rs[$subRow['submit_scope_id']] = $subRs;
						$scopeQuery2 = $this->db->get_where('scope_info', array('scope_id' => $subRow['submit_scope_id']+1, 'deleted' => 0));
						$category_form2 = json_decode(($scopeQuery2->result())[0]->scope_detail,true)['category_form'];
						$subRs2 = array(
							'scope_id' => ($scopeQuery2->result())[0]->scope_id,
							'scope_name' => ($scopeQuery2->result())[0]->scope_name,
							'scope_category' => $category_form,
							'submit_total' => $submit_total,
							'submit_total2' => $submit_total2,
						);
						$rs[$subRow['submit_scope_id']+1] = $subRs2;
						@$count[($scopeQuery->result())[0]->scope_group][($scopeQuery->result())[0]->scope_sub_group] += 2;
					}
				}else if($category_form == 9){ //ข้อมูลต้นไม้
				}else{
					if(!empty($rs[$subRow['submit_scope_id']])){
						array_push($rs[$subRow['submit_scope_id']]['scope_detail'],$subRow['submit_detail']);
					}else{
						$subRs = array(
							'scope_id' => ($scopeQuery->result())[0]->scope_id,
							'scope_name' => ($scopeQuery->result())[0]->scope_name,
							'scope_category' => $category_form,
							'scope_detail' => array(),
						);
						$rs[$subRow['submit_scope_id']] = $subRs;
						array_push($rs[$subRow['submit_scope_id']]['scope_detail'],$subRow['submit_detail']);
					}
					@$count[($scopeQuery->result())[0]->scope_group][($scopeQuery->result())[0]->scope_sub_group] += 1;
				}
			}
		}
		$rs['count'] = $count;
		return $rs;
	
	} 
	public function getCountSubScope(){
		$rs = array();
		$query = $this->db->query("SELECT scope_group,COUNT(*) as counts FROM scope_info_subgroup GROUP BY scope_group ORDER BY ss_id ASC");
		foreach($query->result_array() as $row){
			$rs[$row['scope_group']] = array(
				'scope_group' => $row['scope_group'],
				'counts' => $row['counts'],
			);
		}
		return $rs;
	}

	public function getFr04($year){
		$query = $this->db->order_by('s_qno ASC')->get_where('scope_group', array('deleted' => 0));
		$result = array();
		foreach ($query->result() as $k => $v) {
			$result[$v->s_id] = array(
				'count' => 0,
				'name' => ($v->s_id!='GHG')?$v->s_name:'GHG โดยตรงที่ทำการรายงานแยก',
				'subgroup' => array(),
			);
			$query2 = $this->db->get_where('scope_info_subgroup', array('scope_group'=>$v->s_id,'deleted' => 0));
			foreach ($query2->result() as $kk => $vv) {
				$result[$v->s_id]['count']++;
				$result[$v->s_id]['subgroup'][$kk+1] = array(
					'count' => 0,
					'name' => $vv->ss_name,
					'list' => array(),
				);
				$query3 = $this->db->get_where('scope_info', array('scope_group'=>$v->s_id,'scope_sub_group'=>$kk+1,'scope_year'=>$year,'deleted' => 0));
				foreach ($query3->result() as $kkk => $vvv) {
					$result[$v->s_id]['count']++;
					$result[$v->s_id]['subgroup'][$kk+1]['count']++;
					$dataRow = array(
						'scope_id' => $vvv->scope_id,
						'scope_qno' => $vvv->scope_qno,
						'scope_name' => $vvv->scope_name,
						'scope_category' => (json_decode($vvv->scope_detail,true))['category_form'],
						'scope_unit' => (json_decode($vvv->scope_detail,true))[2]
					);
					array_push($result[$v->s_id]['subgroup'][$kk+1]['list'],$dataRow);
				}
			}
		}
		return  $result;
	}

	public function getGovermentFr($fr_year_value, $fr_member_id, $fr_key){
		$query = $this->db->get_where('member_fr', array('fr_year_value' => $fr_year_value, 'fr_member_id' => $fr_member_id, 'fr_key' => $fr_key));
		return  $query->result();
	}

	

	public function setGovermentFr($ar){
		$query = $this->db->get_where('member_fr', array('fr_year_value' => $ar['fr_year_value'], 'fr_member_id' => $ar['fr_member_id'], 'fr_key' => $ar['fr_key']));
		$rs= $query->result();
		if($rs!=null){
			$this->db->where('fr_year_value',$ar['fr_year_value']);
			$this->db->where('fr_member_id',$ar['fr_member_id']);
			$this->db->where('fr_key',$ar['fr_key']);
			$this->db->update('member_fr',$ar);
		
		}else{
			$ar['createdate']=date('Y-m-d H:i:s');
			$ar['org_createdate']=date('Y-m-d H:i:s');
			$this->db->insert('member_fr', $ar);
			return $this->db->insert_id();
			
		}
	}

	public function getMemberTarget($target_year_value, $target_member_id, $target_key){
		$query = $this->db->get_where('member_target', array('target_year_value' => $target_year_value, 'target_member_id' => $target_member_id, 'target_key' => $target_key));
		return  $query->result();
	}

	public function setMemberTarget($ar){
		$query = $this->db->get_where('member_target', array('target_year_value' => $ar['target_year_value'], 'target_member_id' => $ar['target_member_id'], 'target_key' => $ar['target_key']));
		$rs= $query->result();
		if($rs!=null){
			$this->db->where('target_year_value',$ar['target_year_value']);
			$this->db->where('target_member_id',$ar['target_member_id']);
			$this->db->where('target_key',$ar['target_key']);
			$this->db->update('member_target',$ar);
		
		}else{
			$ar['createdate']=date('Y-m-d H:i:s');
			$this->db->insert('member_target', $ar);
			return $this->db->insert_id();
			
		}
	}

	public function getConfig($config_type){
		$query = $this->db->get_where('config' , array('config_type'=>$config_type));
		return $query->result();
	}

	public function getVerifyFile($verify_year_value, $verify_member_id, $verify_key){
		$query = $this->db->get_where('member_verify', array('verify_year_value' => $verify_year_value, 'verify_member_id' => $verify_member_id, 'verify_key'=>$verify_key));
		return $query->result();
	}

	public function uploadsVerifyFileGov($ar){
		$query = $this->db->get_where('member_verify', array('verify_year_value' => $ar['verify_year_value'], 'verify_member_id' => $ar['verify_member_id'], 'verify_key' => $ar['verify_key']));
		$rs= $query->result();
		if($rs!=null){
			$this->db->where('verify_year_value',$ar['verify_year_value']);
			$this->db->where('verify_member_id',$ar['verify_member_id']);
			$this->db->where('verify_key',$ar['verify_key']);
			$this->db->update('member_verify',$ar);
		}else{
			$ar['createdate']=date('Y-m-d H:i:s');
			$this->db->insert('member_verify',$ar);
			return $this->db->insert_id();
		}
	}

	//faculty
	public function getFacultyDetail2($faculty_id, $faculty_code){

		$this->db->select("*");
		$this->db->from('member_faculty t1'); 
		$this->db->join('member t2', 't1.faculty_member_id=t2.member_id', 'left');
		$this->db->where('t1.faculty_id', $faculty_id);
		$this->db->where('t1.faculty_code', $faculty_code);
		$query = $this->db->get();
		return  $query->result_array();
	}

	public function updateFacultyChangePassword($ar){
		$query = $this->db->get_where('member_faculty', array('faculty_id' => $ar['faculty_id'], 'faculty_code' => $ar['faculty_code'], 'faculty_password' => md5(sha1($ar['o_password']))));
		$rs = $query->result();
		if($rs!=null){
			$this->db->where('faculty_id',$ar['faculty_id']);
			$this->db->where('faculty_code',$ar['faculty_code']);
			if(!$rs[0]->logindate){
				$this->db->update('member_faculty', array('faculty_password'=> md5(sha1($ar['n_password'])), 'logindate'=>date('Y-m-d H:i:s') ));
			}else{
				$this->db->update('member_faculty', array('faculty_password'=> md5(sha1($ar['n_password'])) ));
			}
		
			return $this->db->affected_rows();
		}
	}
}
