<?php 
class Admin_model extends CI_Model{
	public function __contruct()
	{
		parent::__contruct();
	}

	public function checkAdmin($ar)
	{
		$query = $this->db->get_where('admin', array('username' => $ar['username'], 'password' => $ar['password']));
		return $query->result();
	}

	public function updateUser($ar)
	{
		$this->db->where('username', $ar['username']);
		$this->db->update('admin', $ar);

		$query = $this->db->get_where('admin', array('username' => $ar['username']));
		return $query->result();
	}

	public function select_table1_order($table1,$columnOrder,$order){
		$query = $this->db->order_by($columnOrder.' '.$order)->get($table1);
		return $query->result();
	}

	public function select_where_order($table,$columnId,$id,$columnOrder,$order){
		$query = $this->db->order_by($columnOrder.' '.$order)->get_where($table, array( $columnId => $id));  
	 	return $query->result();
	}
	
	public function select_where_s($table,$array){
		$query = $this->db->get_where($table,$array);  
	 	return $query->result();
	}

	public function insert_data($table,$data){
		$this->db->insert($table,$data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}

	public function update_data_2($table,$columnId,$id,$columnId2,$id2,$data){
		$this->db->where($columnId, $id);
		$this->db->where($columnId2, $id2);
		$this->db->update($table, $data); 
	}

	public function select_firstlast($table,$array,$columnOrder,$order){
		$this->db->limit(1);
		$query = $this->db->order_by($columnOrder.' '.$order)->get_where($table,$array);  
	 	return $query->result();
	}

	public function update_data_3($table,$columnId,$id,$columnId2,$id2,$columnId3,$id3,$data){
		$this->db->where($columnId, $id);
		$this->db->where($columnId2, $id2);
		$this->db->where($columnId3, $id3);
		$this->db->update($table, $data); 
	}

	public function getEF($year=null){
		// if($year==null){
		// 	$year = '0000';
		// }
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

	public function getConfigEf($year){
		$query = $this->db->order_by('s_qno ASC')->get_where('scope_group', array('deleted' => 0));
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
					);
					array_push($result[$v->s_id]['subgroup'][$kk+1]['list'],$dataRow);
				}
			}
		}
		return  $result;
	}

	public function getConfigYear(){
		$query = $this->db->order_by('year_value asc')->get_where('config_year', array('deleted' => 0));
		return $query->result();
	}
	public function getConfigYearDetail($year_value){
		// if($year_value==null){
		// 	$query = $this->db->order_by('year_value asc')->get_where('config_year', array('year_value'=>'0000', 'deleted' => 0));
		// }else{
		// 	$query = $this->db->order_by('year_value asc')->get_where('config_year', array('year_value'=>$year_value, 'deleted' => 0));
		// }
		$query = $this->db->order_by('year_value asc')->get_where('config_year', array('year_value'=>$year_value, 'deleted' => 0));
		return $query->result();
	}

	public function updateConfigYear($ar){
		if($ar['active']==1){
			$this->db->where('active',1);
			$this->db->update('config_year',array('active'=>0));
		}
		
		$query = $this->db->get_where('config_year', array('year_value' => $ar['year_value']));
		$rs= $query->result();
		if($rs!=null){
			$this->db->where('year_value',$ar['year_value']);
			$this->db->update('config_year',$ar);	
		}else{
			$this->db->insert('config_year',$ar);
			return $this->db->insert_id();
		}
	}
	public function delConfigYear($year_value){
		$this->db->where('year_value',$year_value);
		$this->db->update('config_year',array('deleted'=>0, 'active'=>0));
	}


	//member
	public function getMemberDetail($member_id){
		$this->db->select("t1.*, t2.PROVINCE_NAME, t3.AMPHUR_NAME, t4.DISTRICT_NAME, t5.type_name");
		$this->db->from('member t1'); 
		$this->db->join('z_province t2', 't1.member_province_id=t2.PROVINCE_ID', 'left');
		$this->db->join('z_amphur t3', 't1.member_amphur_id=t3.AMPHUR_ID', 'left');
		$this->db->join('z_district t4', 't1.member_district_id=t4.DISTRICT_ID', 'left');
		$this->db->join('member_type t5', 't1.member_type_id=t5.type_id', 'left');
		$this->db->where('t1.member_id' , $member_id);
		$query = $this->db->get();
		return  $query->result_array();
	}
	public function getMemberList(){
		$this->db->select("t1.*, t2.PROVINCE_NAME, t3.AMPHUR_NAME, t4.DISTRICT_NAME, t5.type_name");
		$this->db->from('member t1'); 
		$this->db->join('z_province t2', 't1.member_province_id=t2.PROVINCE_ID', 'left');
		$this->db->join('z_amphur t3', 't1.member_amphur_id=t3.AMPHUR_ID', 'left');
		$this->db->join('z_district t4', 't1.member_district_id=t4.DISTRICT_ID', 'left');
		$this->db->join('member_type t5', 't1.member_type_id=t5.type_id', 'left');
		$this->db->order_by('t1.createdate desc');
		$query = $this->db->get();
		return  $query->result_array();
	}
}