	
<div class="row">
	<div class="col-sm-12">
		<h3 class="tab-title no-margin-top reports-title"><i>Activități nerealizate</i></h3>
	</div>
</div>

<form name="kik_report_activitati_nerealizate" action="" method="post">
	<table class="table table-hover">
		<thead class="thead-dark">
			<tr>
				<th class="col-md-2"></th>
				<th class="col-md-10"></th>
			</tr>
		</thead>
		<tbody>
			<!-- DATA DE INCEPUT ACTIVITĂȚI NEREALZIATE -->
			<tr>
				<td><label for="kik_act_nerealizate_data_inceput">Data de început:</label></td>
				<td>
					<div class="col-md-12">
						<input 	type="text" 
									class="form-control act-nerealizate-data-inceput" 
									id="kik_act_nerealizate_data_inceput" 
									placeholder="Data început" 
									name="kik_act_nerealizate_data_inceput"/>
					</div>
				</td>
			</tr>
			<!-- DATA DE SFÂRȘIT ACTIVITĂȚI NEREALZIATE -->
			<tr>
				<td><label for="kik_act_nerealizate_data_sfarsit">Data de sfârșit:</label></td>
				<td>
					<div class="col-md-12">
						<input 	type="text" 
									class="form-control act-nerealizate-data-sfarsit" 
									id="kik_act_nerealizate_data_sfarsit" 
									placeholder="Data sfârșit" 
									name="kik_act_nerealizate_data_sfarsit"/>
					</div>
				</td>
			</tr>	
			<!-- INSPECTOR SSM -->
			<tr>
				<td>
					<label for="kik_act_nerealizate_inspector">Inspector SSM:</label>
				</td>
				<td>
					<div class="col-md-12"><?php 
						echo KIK_DROPDOWN_USERS(
							'kik_act_nerealizate_inspector', 
							'kik_act_nerealizate_inspector', 
							'kik_ssm', '', true);?>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
	
	<div class="kik_save_area">
			<a class="btn btn-primary populate-report" href="javascript:;">
				<i class="fa fa-fw fa-save"></i> Generează
			</a>
			<a class="btn btn-primary save-pdf-report" style="float:right;" href="javascript:;">
				<i class="fa fa-fw fa-print"></i> Printează
			</a>
	</div>
	
	<!-- ======================================== -->
	<!-- ======== PAGE PREVIEW ================== -->
	<!-- ======================================== -->
	<div class="report_container">
			<div class="report_sheet" data-report-type="Activități-nerealizate" data-file-name="Raport_act_nerealizate">
				<table cellspacing='0' cellpadding='0' style='width: 700px;'>
					<tr>
						<td colspan='3' height='50'></td>
					</tr>
					<tr align='center'>
						<td colspan="3" width='700'>
							<b>ACTIVITĂȚI NEREALZIATE ÎN PERIOADA</b>
						</td>
					</tr>
					<tr>
						<td colspan="3" align="center">
							<b>
								<span class="report_field activitati-nerealizate-data-inceput">&emsp;&emsp;</span>-
								<span class="report_field activitati-nerealizate-data-sfarsit">&emsp;&emsp;</span>
							</b>
						</td>
					</tr>
					<tr>
						<td colspan="3" height="30"></td>
					</tr>					
				</table>
			
				<!-- DATA TABLE -->
				<table border="1" cellspacing='0' cellpadding='0' style='width: 700px;' class='rap-act-nerealizate'>
					<!-- TABLE HEAD -->
					<thead>
						<tr align="center">
							<th width='20'>#</th>
							<th width='300'>Firma</th>
							<th width='90'>Data instructaj</th>
							<th width='250'>Inspector SSM</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	
</form>