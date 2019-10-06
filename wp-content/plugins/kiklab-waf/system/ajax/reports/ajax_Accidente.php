<?php


##### REPORTS: Raport accidente
add_action('wp_ajax_KIK_ACTION_Accidente', 'KIK_ACTION_Accidente_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Accidente', 'KIK_ACTION_Accidente_FUNC');
function KIK_ACTION_Accidente_FUNC() {
	
	global $wpdb;
	
	if(!$_POST['kik_report_accidente_data_inceput'] ||
	   !$_POST['kik_report_accidente_data_sfarsit']){
		echo json_encode(array(
			'status' => 'error',
			'form_name' => $_POST['form_name']
		));
		wp_die();
	}

	$oIntervalStart = DateTime::createFromFormat('d/m/Y', $_POST['kik_report_accidente_data_inceput']);
	$oIntervalEnd   = DateTime::createFromFormat('d/m/Y', $_POST['kik_report_accidente_data_sfarsit']);
	$queryData      = getAccidentsByInterval($oIntervalStart, $oIntervalEnd);
	$response		= array('status'=>'success', 'table' => '.rap-accidente'); 
	$counter        = 0;
	
	$response['html'] = "<table border='1'
			cellspacing='0'
			cellpadding='0' 
			style='width: 700px;'
			class='rap-accidente'
			data-start-date = '".$oIntervalStart->format('d/m/Y')."'
			data-end-date = '".$oIntervalEnd->format('d/m/Y')."'>
		<thead>
			<tr align='center'>
				<th width='20' align='center'>#</th>
				<th width='170' align='center'> Firmă </th>
				<th width='90' align='center'> Data cercetării </th>
				<th width='90' align='center'> Data producerii</th>
				<th width='100' align='center'> Angajat</th>
				<th width='180' align='center'> Descriere</th>
			</tr>
		</thead>
		<tbody>";
	
	foreach($queryData as $accident){
		$companyPost   = get_post($accident->post_parent);
		$angajatPost   = get_post(get_post_meta($accident->ID, 'accidentAngajat', true));
		$dataAccident  = get_post_meta($accident->ID, 'dataAccidentului', true);
		$dataCercetare = get_post_meta($accident->ID, 'dataCercetarii', true);
		$inspectorID   = get_post_meta($companyPost->ID, 'kik_company_inspector', true);
		$inspFullName  = '';
		$angFullName   = '';
		$counter++;
		
		if($inspectorID){
			$oInspector = get_userdata($inspectorID);
			$inspFullName = $oInspector->last_name.' '.$oInspector->first_name;
		}
		
		if($angajatPost){
			$angFullName = get_post_meta($angajatPost->ID, 'numeAngajat', true).' '.get_post_meta($angajatPost->ID, 'prenumeAngajat', true);
		}
		
		if($dataAccident){
			$oDataAccident = DateTime::CreateFromFormat('Y/m/d', $dataAccident);
			$dataAccident  = $oDataAccident->format('d/m/Y');
		}
		
		if($dataCercetare){
			$oDataCercetare = DateTime::CreateFromFormat('Y/m/d', $dataCercetare);
			$dataCercetare  = $oDataCercetare->format('d/m/Y');
		}
		
		$response['html'] .= "<tr>
			<td width='20'>".$counter."</td>
			<td width='170'>".$companyPost->post_title."</td>
			<td width='90'>".$dataCercetare."</td>
			<td width='90'>".$dataAccident."</td>
			<td width='100'>".$angFullName."</td>
			<td width='180'>".get_post_meta($accident->ID, 'accidentDescriere', true)."</td>
		</tr>";
		
	}
		
	$response['html'].="</tbody></table>";
	
	echo json_encode($response);
		
	wp_die();
}










/**/

?>