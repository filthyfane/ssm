<?php


##### REPORTS: PV predare documente
add_action('wp_ajax_KIK_ACTION_Angajati_noi', 'KIK_ACTION_Angajati_noi_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Angajati_noi', 'KIK_ACTION_Angajati_noi_FUNC');
function KIK_ACTION_Angajati_noi_FUNC() {
	
	global $wpdb;
	
	if(!$_POST['kik_angajati_noi_data_inceput'] || 
	   !$_POST['kik_angajati_noi_data_sfarsit']){
		echo json_encode(array(
			'status' 	=> 'error',
			'form_name'	=> $_POST['form_name']
		));
		wp_die();
    }
	
	$oIntervalStart = DateTime::createFromFormat('d/m/Y', $_POST['kik_angajati_noi_data_inceput']);
	$oIntervalEnd   = DateTime::createFromFormat('d/m/Y', $_POST['kik_angajati_noi_data_sfarsit']);
	$queryData      = getAngajatiNoi($oIntervalStart, $oIntervalEnd);
	$response		= array('status' => 'success', 'table' => '.rap-angajati-noi');
	$counter		= 0;
	
	$response['html'] = "<table border='1' 
			cellspacing='0' 
			cellpadding='0' 
			style='width: 700px;' 
			class='rap-angajati-noi'
			data-start-date = '".$oIntervalStart->format('d/m/Y')."'
			data-end-date = '".$oIntervalEnd->format('d/m/Y')."'>
		<thead>
			<tr align='center'>
				<th width='20'>#</th>
				<th width='270'>Firma</th>
				<th width='220'>Angajat</th>
				<th width='90'>Data</th>
				<th width='100'>Funcția</th>							
			</tr>
		</thead>
		<tbody>";
		
	foreach($queryData as $oEmployee){
		$counter++;
		$oCompany 		  = get_post($oEmployee->post_parent);
		$employeeFullName = get_post_meta($oEmployee->ID, 'numeAngajat', true).' '.get_post_meta($oEmployee->ID, 'prenumeAngajat', true);
		$oDataAngajarii   = DateTime::createFromFormat('Y/m/d', get_post_meta($oEmployee->ID, 'contractAngajatStart', true));
		$functie		  = get_post_meta($oEmployee->ID, 'functieAngajat', true);
		
		$response['html'] .= "<tr>
			<td width='20'>".$counter."</td>
			<td width='270'>".$oCompany->post_title."</td>
			<td width='220'>".$employeeFullName."</td>
			<td width='90'>".$oDataAngajarii->format('d/m/Y')."</td>
			<td width='100'>".$functie."</td>
		</tr>";
	}
	
	$response['html'] .= "</tbody></table>";
	
	
	echo json_encode($response);
	
	wp_die();
}










/**/

?>