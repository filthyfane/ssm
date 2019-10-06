<?php


##### REPORTS: PV predare documente
add_action('wp_ajax_KIK_ACTION_Debite_neincasate', 'KIK_ACTION_Debite_neincasate_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Debite_neincasate', 'KIK_ACTION_Debite_neincasate_FUNC');
function KIK_ACTION_Debite_neincasate_FUNC() {
	
	global $wpdb;
	
	if(!$_POST['kik_report_debite_neincasate_data_inceput'] ||
	   !$_POST['kik_report_debite_neincasate_data_sfarsit']
	){
		echo json_encode(array(
			'status' => 'error',
			'form_name' => $_POST['form_name']
		));
		wp_die();
	}
	
	$oInspector 	= null;
	$oSalesAgent 	= null;
	$oIntervalStart = DateTime::createFromFormat('d/m/Y', $_POST['kik_report_debite_neincasate_data_inceput']);
	$oIntervalEnd   = DateTime::createFromFormat('d/m/Y', $_POST['kik_report_debite_neincasate_data_sfarsit']);
	
	if($_POST['kik_report_debite_neincasate_inspector']){
		$oInspector = get_userdata($_POST['kik_report_debite_neincasate_inspector']);
	}
	
	if($_POST['kik_report_debite_neincasate_sales_agent']){
		$oSalesAgent = get_userdata($_POST['kik_report_debite_neincasate_sales_agent']);
	}
	
	
	$counter		= 0;
	$response		= array('status'=>'success', 'table' => '.rap-debite-neincasate'); 
	$queryData		= getBillsByDateInterval($oInspector, $oSalesAgent, $oIntervalStart, $oIntervalEnd);
	
	$response['html'] = "<table border='1' 
			cellspacing='0' 
			cellpadding='0' 
			style='width: 700px;' 
			class='rap-debite-neincasate'>
		<thead>
			<tr>
				<th width='20' align='center'>#</th>
				<th width='200' align='center'> Firmă </th>
				<th width='60' align='center'> Data </th>
				<th width='60' align='center'> Nr. </th>
				<th width='60' align='center'> Valoare </th>
				<th width='100' align='center'> Inspector SSM</th>
				<th width='100' align='center'> Agent de vânzări</th>
			</tr>
		</thead>
		<tbody>";
	
	
	if(sizeof($queryData)>0){
		foreach($queryData as $data){
			
			$oInspector	   = get_userdata($data['InspectorId']);
			$oSalesAgent   = get_userdata($data['SalesAgentId']);
			$inspFullName  = $oInspector->last_name .' '. $oInspector->first_name; 
			$salesFullName = $oSalesAgent->last_name .' '. $oSalesAgent->first_name;
			$post		   = get_post($data['PostId']);
			
			$platiPartiale = unserialize(get_post_meta($data['FacturaId'], 'platiPartiale', true));
			$termenPlata   = get_post_meta($data['FacturaId'], 'termenPlata', true);
			$nrFactura	   = get_post_meta($data['FacturaId'], 'nrFactura', true);
			$currDate	   = new DateTime();
			$sumaFacturii  = get_post_meta($data['FacturaId'], 'sumaFactura', true);
			$dataFacturii  = get_post_meta($data['FacturaId'], 'dataFacturii', true);
			$oDataFacturii = DateTime::createFromFormat('Y/m/d', $dataFacturii);
			$dataTermen    = DateTime::createFromFormat('Y/m/d', $dataFacturii)->add(new DateInterval('P'.$termenPlata.'D'));
			$suma 		   = 0;
		
			if($platiPartiale){
				foreach($platiPartiale as $plataPartiala){
					$suma += $plataPartiala['suma'];
				}
			}
			
			if($dataTermen < $currDate && $suma < $sumaFacturii){
				
				$counter++;
				$response['html'].="<tr>
						<td width='20'>".$counter."</td>
						<td width='200'>".$post->post_title."</td>
						<td width='60'>".$oDataFacturii->format('d/m/Y')."</td>
						<td width='60'>".$nrFactura."</td>
						<td width='60'>".$sumaFacturii." lei</td>
						<td width='100'>".$inspFullName."</td>
						<td width='100'>".$salesFullName."</td>
					</tr>";
			}
		}
	}
	$response['html'].="</tbody></table>";
	
	echo json_encode($response);
	wp_die();
	
}
	