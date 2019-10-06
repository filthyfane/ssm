	<div style="height:20px;"></div>

<!--<div class="alert alert-success">
  <strong>TODO</strong> TABEL ATENTIONARI
</div>-->
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<table class="table table-bordered table-hover" id="kik_warnings" style="width: 100%">
				<thead class="thead-dark">
					<tr>
						<th>Firmă</th>
						<th>Tip atenționare</th>
						<th>Data programării</th>
						<th>Nr. zile întârziere</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>
		
					<?php //$kik_notifications = get_option('kik_notifications') ? CountObjectDeepestChildren(get_option('kik_notifications')['by_id']) : 0; ?>
					<!--<div class="kik_company_fields_title">Atenționări (<?php //echo $kik_notifications; ?>)</div>
							
							<table class="kik_company_fields table_type_main" data-tab="Atentionari">
								
								<!-- Labels -->
								<!--<tr>
									<th>&nbsp;</th>
									<th>&nbsp;</th>
								</tr>
								
								<?php //if ($kik_notifications = get_option('kik_notifications')) { //echo DrawObject($kik_notifications['by_type']); ?>
								
								<!-- instructaj_coming_up -->
								<?php
								/* if ($instructaj_coming_up = $kik_notifications['by_type']['instructaj_coming_up']) {
									echo '<tr><td colspan="2">&nbsp;<br /><b>Urmează ședința de instructaj: (' . count($instructaj_coming_up) . ' firme)</b><br />&nbsp;</td></tr>';
									foreach ($instructaj_coming_up as $id => $years) {
										if ($years) foreach ($years as $year => $dates) {
											if ($dates) foreach ($dates as $month => $day) {
												$u_day = unserialize($day);
								 */?>
								<!--<tr>
									<td colspan="2">
										<table class="table_type_row">
											
											<!-- Alerta -->
											<!--<tr>
												<td>
													<a href="<?php //echo get_permalink($id); ?>"><?php //echo get_post($id)->post_title; ?></a>
												</td>
												<td>
													<label><?php //echo $year . '-' . sprintf("%02d", $month) . '-' . sprintf("%02d", $u_day['day']); ?></label>
												</td>
											</tr>
											
										</table>
									</td>
								</tr>
								<?php
										/* 	}
										}
									}
								} */
								?>
								
								<!-- echipamente_exp_coming -->
								<?php
								/* if ($echipamente_exp_coming = $kik_notifications['by_type']['echipamente_exp_coming']) {
									echo '<tr><td colspan="2">&nbsp;<br /><b>Urmează să expire echipamentele: (' . count($echipamente_exp_coming) . ' firme)</b><br />&nbsp;</td></tr>';
									foreach ($echipamente_exp_coming as $id => $echipamente) {
										if ($echipamente) foreach ($echipamente as $i => $echipament) {
											$u_echipament = unserialize($echipament);
								 */?>
								<!--<tr>
									<td colspan="2">
										<table class="table_type_row">
											
											<!-- Alerta -->
											<!--<tr>
												<td>
													<a href="<?php //echo get_permalink($id); ?>"><?php echo get_post($id)->post_title; ?></a>
												</td>
												<td>
													<label><?php //echo get_term($u_echipament['id'], 'kik_echipamente')->name . ', ' . $u_echipament['buc'] . ' buc., expiră ' . $u_echipament['exp']; ?></label>
												</td>
											</tr>
											
										</table>
									</td>
								</tr>
								<?php
									/* 	}
									}
								} */
								?>
								
								<!-- echipamente_iscir_coming -->
								<?php
								/* if ($echipamente_iscir_coming = $kik_notifications['by_type']['echipamente_iscir_coming']) {
									echo '<tr><td colspan="2">&nbsp;<br /><b>Urmează să expire autorizațiile ISCIR: (' . count($echipamente_iscir_coming) . ' firme)</b><br />&nbsp;</td></tr>';
									foreach ($echipamente_iscir_coming as $id => $echipamente) {
										if ($echipamente) foreach ($echipamente as $i => $echipament) {
											$u_echipament = unserialize($echipament);
								 */?>
								<!--<tr>
									<td colspan="2">
										<table class="table_type_row">
											
											<!-- Alerta -->
											<!--<tr>
												<td>
													<a href="<?php //echo get_permalink($id); ?>"><?php echo get_post($id)->post_title; ?></a>
												</td>
												<td>
													<label><?php //echo get_term($u_echipament['id'], 'kik_echipamente')->name . ', ' . $u_echipament['buc'] . ' buc., expiră ' . $u_echipament['exp']; ?></label>
												</td>
											</tr>
											
										</table>
									</td>
								</tr>
								<?php
									/* 	}
									}
								} */
								?>
								
								<!-- cssm_coming_up -->
								<?php
								/* if ($cssm_coming_up = $kik_notifications['by_type']['cssm_coming_up']) {
									echo '<tr><td colspan="2">&nbsp;<br /><b>Urmează ședința CSSM: (' . count($cssm_coming_up) . ' firme)</b><br />&nbsp;</td></tr>';
									foreach ($cssm_coming_up as $id => $sedinte) {
										if ($sedinte) foreach ($sedinte as $i => $data) {
											$u_data = unserialize($data);*/
								?>
								<!--<tr>
									<td colspan="2">
										<table class="table_type_row">
											
											<!-- Alerta -->
											<!--<tr>
												<td>
													<a href="<?php //echo get_permalink($id); ?>"><?php echo get_post($id)->post_title; ?></a>
												</td>
												<td>
													<label><?php //echo $u_data['data']; ?></label>
												</td>
											</tr>
											
										</table>
									</td>
								</tr>
								<?php
								/* 		}
									}
								} */
								?>
								
								<!-- cssm_over -->
								<?php
								/* if ($cssm_over = $kik_notifications['by_type']['cssm_over']) {
									echo '<tr><td colspan="2">&nbsp;<br /><b>S-a efectuat ședința CSSM: (' . count($cssm_over) . ' firme)</b><br />&nbsp;</td></tr>';
									foreach ($cssm_over as $id => $sedinte) {
										if ($sedinte) foreach ($sedinte as $i => $data) {
											$u_data = unserialize($data);*/
								?>
								<!--<tr>
									<td colspan="2">
										<table class="table_type_row">
											
											<!-- Alerta -->
											<!--<tr>
												<td>
													<a href="<?php //echo get_permalink($id); ?>"><?php echo get_post($id)->post_title; ?></a>
												</td>
												<td>
													<label><?php //echo $u_data['data']; ?></label>
												</td>
											</tr>
											
										</table>
									</td>
								</tr>
								<?php
									/* 	}
									}
								}
							} */ ?>
								
							</table>-->