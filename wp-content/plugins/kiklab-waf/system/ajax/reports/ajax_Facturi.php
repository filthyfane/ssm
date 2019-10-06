<?php


##### REPORTS: PV predare documente
add_action('wp_ajax_KIK_ACTION_Facturi', 'KIK_ACTION_Facturi_FUNC');
add_action('wp_ajax_nopriv_KIK_ACTION_Facturi', 'KIK_ACTION_Facturi_FUNC');
function KIK_ACTION_Facturi_FUNC() {
	
	global $wpdb;
	if(!$_POST['kik_report_facturi_data_inceput'] ||
	   !$_POST['kik_report_facturi_data_sfarsit']){
		
		echo json_encode(array(
			'status' => 'error',
			'form_name' => $_POST['form_name']
		));
		wp_die();
    }
	
	$oIntervalStart = DateTime::createFromFormat('d/m/Y', $_POST['kik_report_facturi_data_inceput']);
	$oIntervalEnd   = DateTime::createFromFormat('d/m/Y', $_POST['kik_report_facturi_data_sfarsit']);
	$counter = 0;
	$response = array('status'=>'success', 'table' => '.rap-facturi');
	
	$response['html'] = "<table border='1' 
			cellspacing='0' 
			cellpadding='0' 
			style='width: 700px;' 
			class='rap-facturi'
			data-start-date = '".$oIntervalStart->format('d/m/Y')."'
			data-end-date = '".$oIntervalEnd->format('d/m/Y')."'>
			<thead>
				<tr align='center'>
					<th width='20' align='center'>#</th>
					<th width='300' align='center'> Firmă </th>
					<th width='130' align='center'> Perioada de facturare </th>
					<th width='150' align='center'> Data de emitere a facturii</th>
				</tr>
			</thead>
			<tbody>";
	
	if($_POST['kik_report_facturi_data_inceput']){
			
		$posts = getAllCompanies();
	
		foreach ($posts as $post) { 
			
			$oContractStartDate = DateTime::createFromFormat('Y/m/d', get_post_meta($post->ID, 'kik_company_contract_date', true));
			$oIntervalFacturare = wp_get_object_terms($post->ID, 'kik_perioada_de_facturare')[0];
			$interval = getFrequencyInterval($oIntervalFacturare->name);
			
			if(!is_object($oContractStartDate)) {
				continue;
			};
			
			$oContractStartDate = $oContractStartDate->add(new DateInterval($interval));
			
			while($oContractStartDate <= $oIntervalEnd){
				if($oContractStartDate >= $oIntervalStart && $oContractStartDate <= $oIntervalEnd){
					$counter++;
					$response['html'].= "<tr>
						<td>" . $counter . "</td>
						<td>" . $post->post_title . "</td>
						<td>" . wp_get_post_terms($post->ID, 'kik_perioada_de_facturare')[0]->name . "</td>
						<td>". $oContractStartDate->format('d-m-Y')."</td>
					</tr>";
				}
				$oContractStartDate = $oContractStartDate->add(new DateInterval($interval));
			}
		}
	} 
	$response['html'].="</tbody></table>";
	
	echo json_encode($response);
	wp_die();
}










/**/

?>