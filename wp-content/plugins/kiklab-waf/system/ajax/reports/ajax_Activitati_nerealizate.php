<?php


##### REPORTS: Instructaje nerealizate
add_action('wp_ajax_KIK_ACTION_Activitati_nerealizate', 'KIK_ACTION_Activitati_nerealizate_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Activitati_nerealizate', 'KIK_ACTION_Activitati_nerealizate_FUNC');
function KIK_ACTION_Activitati_nerealizate_FUNC() {
	
	global $wpdb;
	
	if(!$_POST['kik_act_nerealizate_data_inceput'] ||
	   !$_POST['kik_act_nerealizate_data_sfarsit']){
		echo json_encode(array(
			'status' 	=> 'error',
			'form_name' => $_POST['form_name']
		));
		wp_die();
	}
	
	$oIntervalStart = DateTime::createFromFormat('d/m/Y', $_POST['kik_act_nerealizate_data_inceput']);
	$oIntervalEnd   = DateTime::createFromFormat('d/m/Y', $_POST['kik_act_nerealizate_data_sfarsit']);
	$queryData		= getInstructajeNerealizate($oIntervalStart, $oIntervalEnd);
	$response		= array('status' => 'success', 'table' => '.rap-act-nerealizate');
	$counter		= 0;
	$oInsp			= $_POST['kik_act_nerealizate_inspector'] ? get_userdata($_POST['kik_act_nerealizate_inspector']) : null;
	
	$response['html'] = "<table border='1' 
			cellspacing='0' 
			cellpadding='0' 
			style='width: 700px;' 
			class='rap-act-nerealizate'
			data-start-date = '".$oIntervalStart->format('d/m/Y')."'
			data-end-date = '".$oIntervalEnd->format('d/m/Y')."'>
		<thead>
			<tr align='center'>
				<th width='20'>#</th>
				<th width='300'>Firma</th>
				<th width='90'>Data instructaj</th>
				<th width='250'>Inspector SSM</th>
			</tr>
		</thead>
		<tbody>";

	foreach($queryData as $instr){
		$counter++;
		$oDataInstr = DateTime::createFromFormat('Y/m/d', get_post_meta($instr->ID, 'dataInstructajului', true));
		$oCompany   = get_post($instr->post_parent);
		$coInspId   = get_post_meta($oCompany->ID, 'kik_company_inspector', true);
		$oCoInsp    = get_userdata($coInspId);

		if(!is_null($oInsp) && $oInsp->ID != $coInspId){
			continue;
		}
		
		$response['html'].="<tr>
			<td width='20'>".$counter."</td>
			<td width='300'>".$oCompany->post_title."</td>
			<td width='90'>".$oDataInstr->format('d/m/Y')."</td>
			<td width='250'>".$oCoInsp->first_name.' '.$oCoInsp->last_name."</td>
		</tr>";
	}
	$response['html'] .= "</tbody></table>";
	
	
	echo json_encode($response);
	wp_die();
} ?>