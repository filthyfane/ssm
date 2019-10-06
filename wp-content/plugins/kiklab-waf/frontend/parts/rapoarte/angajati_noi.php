<div class="row">
	<div class="col-sm-12">
		<h3 class="tab-title no-margin-top reports-title"><i>Angajați noi</i></h3>
	</div>
</div>	

<form name="kik_report_angajati_noi" action="" method="post">
	<table class="table table-hover">
		<thead class="thead-dark">
			<tr>
				<th class="col-md-2"></th>
				<th class="col-md-10"></th>
			</tr>
		</thead>
		<tbody>
			<!-- DATA DE INCEPUT ANGAJATI NOI -->
			<tr>
				<td><label for="kik_report_angajati_noi_data_inceput">Data de început:</label></td>
				<td>
					<div class="col-md-12">
						<input 	type="text" 
								class="form-control angajati-noi-data-inceput" 
								id="kik_report_angajati_noi_data_inceput" 
								placeholder="Data început" 
								name="kik_report_angajati_noi_data_inceput"/>
					</div>
				</td>
			</tr>
			<!-- DATA DE SFÂRȘIT ANGAJATI NOI -->
			<tr>
				<td><label for="kik_report_angajati_noi_data_sfarsit">Data de sfârșit:</label></td>
				<td>
					<div class="col-md-12">
						<input 	type="text" 
								class="form-control angajati-noi-data-sfarsit" 
								id="kik_report_angajati_noi_data_sfarsit" 
								placeholder="Data sfârșit" 
								name="kik_report_angajati_noi_data_sfarsit"/>
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
		<div class="report_sheet" data-report-type="Angajați-noi" data-file-name="Raport_angajati_noi">
			<table cellspacing='0' cellpadding='0' style='width: 700px;'>
				<tr>
					<td colspan='3' height='50'></td>
				</tr>
				<tr align='center'>
					<td colspan="3" width='700'>
						<b>FIRME CARE AU ANGAJAȚI NOI ÎN PERIOADA</b>
					</td>
				</tr>
				<tr>
					<td colspan="3" align="center">
						<b>
							<span class="report_field title-angajati-noi-data-inceput">&emsp;&emsp;</span>-
							<span class="report_field title-angajati-noi-data-sfarsit">&emsp;&emsp;</span>
						</b>
					</td>
				</tr>
				<tr>
					<td colspan="3" height="30"></td>
				</tr>					
			</table>
		
			<!-- DATA TABLE -->
			<table border="1" cellspacing='0' cellpadding='0' style='width: 700px;' class='rap-angajati-noi'>
				<!-- TABLE HEAD -->
				<thead>
					<tr align="center">
						<th width='20'>#</th>
						<th width='270'>Firma</th>
						<th width='220'>Angajat</th>
						<th width='90'>Data</th>
						<th width='100'>Funcția</th>							
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</form>
