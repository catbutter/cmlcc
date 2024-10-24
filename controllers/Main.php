<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Main extends CI_Controller {

	function __construct() {
        parent::__construct();
       	$this->load->model('main_model');
        $this->load->library('form_validation');
        $this->load->helper('security');
	
    }


	public function index()
	{
		$this->data['active'] = 'index';
		$this->data['rsYear'] = $this->main_model->get_data_w_array('config_year',array('isshow'=>1, 'deleted'=>0));
		$this->data['rsProvince'] = $this->main_model->getProvinceList();
		$this->data['view'] = 'main/index';
		$this->load->view("main/template_main",$this->data);
	}
	function getHotel(){
		$url = "https://cm.lcc.3e.world/uploads/getHotel.json";
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'Cookie: ci_session=rad2p5npoqqlousbuv7pndi1edkvpart'
		),
		));

		$response = curl_exec($curl);
		
		curl_close($curl);
		return (array)json_decode($response);

	}

	function getTGO(){
		$url = "https://cm.lcc.3e.world/uploads/tgo.json";
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'Cookie: ci_session=rad2p5npoqqlousbuv7pndi1edkvpart'
		),
		));

		$response = curl_exec($curl);
		
		curl_close($curl);
		return (array)json_decode($response);

	}
	public function getMarker(){
		$type = $this->input->get('type');
		$ar_color = array(1=>'#1E90FF','#32CD32','#FF6347','#8A2BE2','#20B2AA', '#FF1493', '#FF4500');
		$rs = $this->main_model->getYearDefault($type);
		$data = array();
		foreach($rs as $item){
			$star_count = 0;
			//GHG
			$rsScopeValue = $this->main_model->getSumScopeValue($item['dep_year_value'], $item['member_id'], $item['dep_key']);
			$total = $this->getTotalValue($rsScopeValue, $item['dep_year_value']);
			$s1_3 = @rmComma(number_format($total['scope1'] + $total['scope2'] + $total['scope3'],2));
			if($item['member_type_id']==7) $color = $ar_color[1];
			if($item['member_type_id']==6) $color = $ar_color[2];
			if($item['member_type_id']==5) $color = $ar_color[3];
			if($item['member_type_id']==4) $color = $ar_color[4];
			if($item['member_type_id']==3) $color = $ar_color[5];
			if($item['member_type_id']==2) $color = $ar_color[6];
			if($item['member_type_id']==1) $color = $ar_color[7];
			if($rsScopeValue!=null){$star_count++;}

			$rsTargetData = $this->main_model->getTargetData($item['dep_year_value'], $item['member_id'], $item['dep_key']);
			$target_data = array();
			if($rsTargetData!=null){
				$star_count++;
				$target_data = (array)json_decode($rsTargetData[0]['target_data']);
			}

			$dataGoverment = array(
				'member_name' 	  	=> $item['member_name'],
				'member_group_id' 	=> $item['member_type_id'],
				'member_group' 	  	=> $item['type_name'],
				'member_lat' 	  	=> $item['member_lat'],
				'member_lon' 	  	=> $item['member_lon'],
				'member_star' 	  	=> $star_count,
				'GHG_scope1' 		=> @floatval($total['scope1'])!=null ? floatval($total['scope1']):0,
				'GHG_scope2' 		=> @floatval($total['scope2'])!=null ? floatval($total['scope2']):0,
				'GHG_scope3' 		=> @floatval($total['scope3'])!=null ? floatval($total['scope3']):0,
				'GHGtotal' 			=> @floatval($s1_3),
				'color' 			=> $color,
				'target' 			=> $target_data,
			);
			//array_push($data,$dataGoverment);
		}
		if (in_array($type, [null, 5])) {
			$rsTGO = $this->getHotel();
			foreach($rsTGO as $item){
				$item = (array)$item;
				$item['member_group_id']=5;
				$item['color']='#8A2BE2';
				array_push($data, (array)$item);
			}
		}

		if (in_array($type, [null, 1])) {
			$rsTGO = $this->getTGO();
			foreach($rsTGO as $item){
				$item = (array)$item;
				$item['member_group_id']=1;
				$item['color']= '#1E90FF';
				array_push($data, (array)$item);
			}
			
		}
		
		usort($data, function($a, $b) {
			return $b['GHGtotal'] - $a['GHGtotal'];
		});
		
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	function getTotalValue($rsScopeValue, $y){
		$data = array();
		$data['scope1'] = 0;
		$data['scope2'] = 0;
		$data['scope3'] = 0;
		$getFr04 = $this->main_model->getFr04($y);
		$ef = $this->main_model->getEF($y);

		foreach($getFr04 as $keyItem => $item){
			if($item['name']=="ขอบเขตที่ 1"){
				foreach($item['subgroup'] as $keySubItem => $subItem){
					foreach($subItem['list'] as $keyList => $list){
						if( !empty($rsScopeValue[$list['scope_id']]['scope_id']) && ($list['scope_id'] == $rsScopeValue[$list['scope_id']]['scope_id']) ){
							$ef_scope = $ef[$keyItem][$keySubItem][$list['scope_qno']]; 
							$category_scope = $rsScopeValue[$list['scope_id']]['scope_category'];
							if(!empty($rsScopeValue[$list['scope_id']]['submit_total'])){
								if($category_scope==10){
									$data['scope1'] += ($rsScopeValue[$list['scope_id']]['submit_total']*$this->CalkgCO2e(@$ef_scope[3], @$ef_scope[4], @$ef_scope[5], @$ef_scope[6], @$ef_scope[7],@$ef_scope[8],@$ef_scope[9],@$ef_scope[10],@$ef_scope[11],@$ef_scope['gwp1'],@$ef_scope['gwp2'],@$ef_scope['gwp3'],@$ef_scope['gwp4'],@$ef_scope['gwp5']))/1000;
								}else if(($category_scope>=5&&$category_scope<=8)||$category_scope==11||$category_scope==12){
									$data['scope1'] += ($rsScopeValue[$list['scope_id']]['submit_total']*$ef_scope[14])/1000;
								}else if(($category_scope>=5&&$category_scope<=8)){
									$data['scope1'] += ($rsScopeValue[$list['scope_id']]['submit_total']*$ef_scope[14])/1000;
								}else if($category_scope==13){
									$data['scope1'] += ($rsScopeValue[$list['scope_id']]['submit_total']*((floatval($ef_scope[3])*floatval($ef_scope['gwp1']))+(floatval($ef_scope[12])*floatval($ef_scope[13]))))/1000;
								}else{
									$data['scope1'] += @($rsScopeValue[$list['scope_id']]['submit_total']*$this->CalkgCO2e(@$ef_scope[3], @$ef_scope[4], @$ef_scope[5], @$ef_scope[6], @$ef_scope[7],@$ef_scope[8],@$ef_scope[9],@$ef_scope[10],@$ef_scope[11],@$ef_scope['gwp1'],@$ef_scope['gwp2'],@$ef_scope['gwp3'],@$ef_scope['gwp4'],@$ef_scope['gwp5']))/1000;
								}
							}else if(!empty($rsScopeValue[$list['scope_id']]['scope_detail'])){
								foreach($rsScopeValue[$list['scope_id']]['scope_detail'] as $keyDetail => $detail){
									if($category_scope==2){
										$data['scope1'] +=$detail['submit_total']*$this->CalkgCO2e(@$ef_scope[3], @$ef_scope[4], @$ef_scope[5], @$ef_scope[6], @$ef_scope[7],@$ef_scope[8],@$ef_scope[9],@$ef_scope[10],@$ef_scope[11],@$ef_scope['gwp1'],@$ef_scope['gwp2'],@$ef_scope['gwp3'],@$ef_scope['gwp4'],@$ef_scope['gwp5'])/1000;
									}else if($category_scope==4){
										if($detail['submit_type']==6||$detail['submit_type']==7){
											$data['scope1'] += $detail['submit_total']*$this->CalkgCO2e(@$this->getTrashSuffix($detail['submit_type'],3), @$this->getTrashSuffix($detail['submit_type'],4), @$this->getTrashSuffix($detail['submit_type'],5), @$this->getTrashSuffix($detail['submit_type'],6), @$this->getTrashSuffix($detail['submit_type'],7), @$this->getTrashSuffix($detail['submit_type'],8),@$this->getTrashSuffix($detail['submit_type'],9),@$this->getTrashSuffix($detail['submit_type'],10), @$this->getTrashSuffix($detail['submit_type'],11), @$ef_scope['gwp1'], @$ef_scope['gwp2'], @$ef_scope['gwp3'], @$ef_scope['gwp4'], @$ef_scope['gwp5']);
										}else{
											$data['scope1'] += $detail['submit_total']*$this->CalkgCO2e(@$this->getTrashSuffix($detail['submit_type'],3), @$this->getTrashSuffix($detail['submit_type'],4), @$this->getTrashSuffix($detail['submit_type'],5), @$this->getTrashSuffix($detail['submit_type'],6), @$this->getTrashSuffix($detail['submit_type'],7), @$this->getTrashSuffix($detail['submit_type'],8),@$this->getTrashSuffix($detail['submit_type'],9),@$this->getTrashSuffix($detail['submit_type'],10), @$this->getTrashSuffix($detail['submit_type'],11), @$ef_scope['gwp1'], @$ef_scope['gwp2'], @$ef_scope['gwp3'], @$ef_scope['gwp4'], @$ef_scope['gwp5'])/1000;
										}
									}
								}
							}
						}
					}
				}
			}
			if($item['name']=="ขอบเขตที่ 2"){
				foreach($item['subgroup'] as $keySubItem => $subItem){
					foreach($subItem['list'] as $keyList => $list){
						if( !empty($rsScopeValue[$list['scope_id']]['scope_id']) && ($list['scope_id'] == $rsScopeValue[$list['scope_id']]['scope_id']) ){
							$ef_scope = $ef[$keyItem][$keySubItem][$list['scope_qno']]; 
							$category_scope = $rsScopeValue[$list['scope_id']]['scope_category'];
							if(!empty($rsScopeValue[$list['scope_id']]['submit_total'])){
								if($category_scope==10){
									$data['scope2'] += ($rsScopeValue[$list['scope_id']]['submit_total']*$this->CalkgCO2e(@$ef_scope[3], @$ef_scope[4], @$ef_scope[5], @$ef_scope[6], @$ef_scope[7],@$ef_scope[8],@$ef_scope[9],@$ef_scope[10],@$ef_scope[11],@$ef_scope['gwp1'],@$ef_scope['gwp2'],@$ef_scope['gwp3'],@$ef_scope['gwp4'],@$ef_scope['gwp5']))/1000;
								}else if(($category_scope>=5&&$category_scope<=8)||$category_scope==11||$category_scope==12){
									$data['scope2'] += ($rsScopeValue[$list['scope_id']]['submit_total']*$ef_scope[14])/1000;
								}else if(($category_scope>=5&&$category_scope<=8)){
									$data['scope2'] += ($rsScopeValue[$list['scope_id']]['submit_total']*$ef_scope[14])/1000;
								}else if($category_scope==13){
									$data['scope2'] += ($rsScopeValue[$list['scope_id']]['submit_total']*((floatval($ef_scope[3])*floatval($ef_scope['gwp1']))+(floatval($ef_scope[12])*floatval($ef_scope[13]))))/1000;
								}else{
									$data['scope2'] += ($rsScopeValue[$list['scope_id']]['submit_total']*$this->CalkgCO2e(@$ef_scope[3], @$ef_scope[4], @$ef_scope[5], @$ef_scope[6], @$ef_scope[7],@$ef_scope[8],@$ef_scope[9],@$ef_scope[10],@$ef_scope[11],@$ef_scope['gwp1'],@$ef_scope['gwp2'],@$ef_scope['gwp3'],@$ef_scope['gwp4'],@$ef_scope['gwp5']))/1000;
								}
							}else if(!empty($rsScopeValue[$list['scope_id']]['scope_detail'])){
								foreach($rsScopeValue[$list['scope_id']]['scope_detail'] as $keyDetail => $detail){
									if($category_scope==2){
										$data['scope2'] +=$detail['submit_total']*$this->CalkgCO2e(@$ef_scope[3], @$ef_scope[4], @$ef_scope[5], @$ef_scope[6], @$ef_scope[7],@$ef_scope[8],@$ef_scope[9],@$ef_scope[10],@$ef_scope[11],@$ef_scope['gwp1'],@$ef_scope['gwp2'],@$ef_scope['gwp3'],@$ef_scope['gwp4'],@$ef_scope['gwp5'])/1000;
									}else if($category_scope==4){
										if($detail['submit_type']==6||$detail['submit_type']==7){
											$data['scope2'] += $detail['submit_total']*$this->CalkgCO2e(@$this->getTrashSuffix($detail['submit_type'],3), @$this->getTrashSuffix($detail['submit_type'],4), @$this->getTrashSuffix($detail['submit_type'],5), @$this->getTrashSuffix($detail['submit_type'],6), @$this->getTrashSuffix($detail['submit_type'],7), @$this->getTrashSuffix($detail['submit_type'],8),@$this->getTrashSuffix($detail['submit_type'],9),@$this->getTrashSuffix($detail['submit_type'],10), @$this->getTrashSuffix($detail['submit_type'],11), @$ef_scope['gwp1'], @$ef_scope['gwp2'], @$ef_scope['gwp3'], @$ef_scope['gwp4'], @$ef_scope['gwp5']);
										}else{
											$data['scope2'] += $detail['submit_total']*$this->CalkgCO2e(@$this->getTrashSuffix($detail['submit_type'],3), @$this->getTrashSuffix($detail['submit_type'],4), @$this->getTrashSuffix($detail['submit_type'],5), @$this->getTrashSuffix($detail['submit_type'],6), @$this->getTrashSuffix($detail['submit_type'],7), @$this->getTrashSuffix($detail['submit_type'],8),@$this->getTrashSuffix($detail['submit_type'],9),@$this->getTrashSuffix($detail['submit_type'],10), @$this->getTrashSuffix($detail['submit_type'],11), @$ef_scope['gwp1'], @$ef_scope['gwp2'], @$ef_scope['gwp3'], @$ef_scope['gwp4'], @$ef_scope['gwp5'])/1000;
										}
									}
								}
							}
						}
					}
				}
			}
			if($item['name']=="ขอบเขตที่ 3"){
				foreach($item['subgroup'] as $keySubItem => $subItem){
					foreach($subItem['list'] as $keyList => $list){
						if( !empty($rsScopeValue[$list['scope_id']]['scope_id']) && ($list['scope_id'] == $rsScopeValue[$list['scope_id']]['scope_id']) ){
							$ef_scope = $ef[$keyItem][$keySubItem][$list['scope_qno']]; 
							$category_scope = $rsScopeValue[$list['scope_id']]['scope_category'];
							if(!empty($rsScopeValue[$list['scope_id']]['submit_total'])){
								if($category_scope==10){
									$data['scope3'] += ($rsScopeValue[$list['scope_id']]['submit_total']*$this->CalkgCO2e(@$ef_scope[3], @$ef_scope[4], @$ef_scope[5], @$ef_scope[6], @$ef_scope[7],@$ef_scope[8],@$ef_scope[9],@$ef_scope[10],@$ef_scope[11],@$ef_scope['gwp1'],@$ef_scope['gwp2'],@$ef_scope['gwp3'],@$ef_scope['gwp4'],@$ef_scope['gwp5']))/1000;
								}else if(($category_scope>=5&&$category_scope<=8)||$category_scope==11||$category_scope==12){
									$data['scope3'] += ($rsScopeValue[$list['scope_id']]['submit_total']*$ef_scope[14])/1000;
								}else if(($category_scope>=5&&$category_scope<=8)){
									$data['scope3'] += ($rsScopeValue[$list['scope_id']]['submit_total']*$ef_scope[14])/1000;
								}else if($category_scope==13){
									$data['scope3'] += ($rsScopeValue[$list['scope_id']]['submit_total']*((floatval($ef_scope[3])*floatval($ef_scope['gwp1']))+(floatval($ef_scope[12])*floatval($ef_scope[13]))))/1000;
								}else{
									$data['scope3'] += ($rsScopeValue[$list['scope_id']]['submit_total']*$this->CalkgCO2e(@$ef_scope[3], @$ef_scope[4], @$ef_scope[5], @$ef_scope[6], @$ef_scope[7],@$ef_scope[8],@$ef_scope[9],@$ef_scope[10],@$ef_scope[11],@$ef_scope['gwp1'],@$ef_scope['gwp2'],@$ef_scope['gwp3'],@$ef_scope['gwp4'],@$ef_scope['gwp5']))/1000;
								}
							}else if(!empty($rsScopeValue[$list['scope_id']]['scope_detail'])){
								foreach($rsScopeValue[$list['scope_id']]['scope_detail'] as $keyDetail => $detail){
									if($category_scope==2){
										$data['scope3'] +=$detail['submit_total']*$this->CalkgCO2e(@$ef_scope[3], @$ef_scope[4], @$ef_scope[5], @$ef_scope[6], @$ef_scope[7],@$ef_scope[8],@$ef_scope[9],@$ef_scope[10],@$ef_scope[11],@$ef_scope['gwp1'],@$ef_scope['gwp2'],@$ef_scope['gwp3'],@$ef_scope['gwp4'],@$ef_scope['gwp5'])/1000;
									}else if($category_scope==4){
										if($detail['submit_type']==6||$detail['submit_type']==7){
											$data['scope3'] += $detail['submit_total']*$this->CalkgCO2e(@$this->getTrashSuffix($detail['submit_type'],3), @$this->getTrashSuffix($detail['submit_type'],4), @$this->getTrashSuffix($detail['submit_type'],5), @$this->getTrashSuffix($detail['submit_type'],6), @$this->getTrashSuffix($detail['submit_type'],7), @$this->getTrashSuffix($detail['submit_type'],8),@$this->getTrashSuffix($detail['submit_type'],9),@$this->getTrashSuffix($detail['submit_type'],10), @$this->getTrashSuffix($detail['submit_type'],11), @$ef_scope['gwp1'], @$ef_scope['gwp2'], @$ef_scope['gwp3'], @$ef_scope['gwp4'], @$ef_scope['gwp5']);
										}else{
											$data['scope3'] += $detail['submit_total']*$this->CalkgCO2e(@$this->getTrashSuffix($detail['submit_type'],3), @$this->getTrashSuffix($detail['submit_type'],4), @$this->getTrashSuffix($detail['submit_type'],5), @$this->getTrashSuffix($detail['submit_type'],6), @$this->getTrashSuffix($detail['submit_type'],7), @$this->getTrashSuffix($detail['submit_type'],8),@$this->getTrashSuffix($detail['submit_type'],9),@$this->getTrashSuffix($detail['submit_type'],10), @$this->getTrashSuffix($detail['submit_type'],11), @$ef_scope['gwp1'], @$ef_scope['gwp2'], @$ef_scope['gwp3'], @$ef_scope['gwp4'], @$ef_scope['gwp5'])/1000;
										}
									}
								}
							}
						}
					}
				}
			}
		}	
		return $data;
	}

	function CalkgCO2e($e, $f, $g, $h, $i, $j, $k, $l, $m, $gwp_CO2, $gwp_CH4, $gwp_N2O, $gwp_SF6, $gwp_NF3){
		$e		= $e!=null ? $e : 0;
		$f		= $f!=null ? $f : 0;
		$g		= $g!=null ? $g : 0;
		$h		= $h!=null ? $h : 0;
		$i		= $i!=null ? $i : 0;
		$j		= $j!=null ? $j : 0;
		$k		= $k!=null ? $k : 0;
		$l		= $l!=null ? $l : 0;
		$m		= $m!=null ? $m : 0;
		$AP8	= $gwp_CO2;
		$AP9	= $gwp_CH4;
		$AP10	= $gwp_N2O;
		$AP11	= $gwp_SF6;
		$AP12	= $gwp_NF3;

		return @(rmComma($e)*$AP8)+(rmComma($f)*$AP9)+(rmComma($g)*$AP10)+(rmComma($h)*$AP11)+(rmComma($i)*$AP12)+(rmComma($j)*rmComma($l))+(rmComma($k)*rmComma($m));
		// return $e;
	}

	function getTrashSuffix($val_type, $type){
		$ar = array(
			4 => array(
				3 =>1, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0
			),
			5 => array(
				3 =>1, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0
			),
			2 => array(
				3 =>0, 4=>1, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0
			),
			1 => array(
				3 =>0, 4=>1, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0
			),
			3 => array(
				3 =>0, 4=>1, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0
			),
			6 => array(
				3 =>1, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0
			),
			7 => array(
				3 =>1, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0
			),
			8 => array(
				3 =>1, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0
			),
			9 => array(
				3 =>1, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0
			),
			10 => array(
				3 =>1, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0, 10=>0, 11=>0
			),
		);
		return $ar[$val_type][$type];
	}
}
