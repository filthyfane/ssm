<?php
/**
 * Template for displaying Author Archive pages
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header();?>

		<div id="container">
			<div id="content" role="main">
			
				<?php
				
				global $wp_query;
				$user = $wp_query->get_queried_object();
				//echo DrawObject($user);
				$kik_user_roles = get_user_meta($user->ID, 'kik_user_roles', true);
				
				$current_user_id = wp_get_current_user()->ID;
				$current_user_roles = get_user_meta($current_user_id, 'kik_user_roles', true);
				if (($current_user_id == $user->ID) || ($current_user_id == 1) || (is_array($current_user_roles) && in_array('Administrator', $current_user_roles))) {
				?>
				<form name="kik_user" action="" method="post">
					
					<input type="hidden" id="ID" name="ID" value="<?php echo $user->ID; ?>" />
					<input type="hidden" id="kik_company_id" name="kik_company_id" value="<?php echo $kik_ID; ?>" />
					<input type="hidden" id="kik_action" name="kik_action" value="edit" />
					
					<div class="kik_company_title">
						<div class="kik_company_title_tag">Utilizator: <?php echo $user->first_name . ' ' . $user->last_name; ?></div>
						<a class="kik_save_btn edit" href="javascript:;"><i class="fa fa-fw fa-save"></i> Salvează utilizatorul</a>
						<div class="kik_save_btn_response"></div>
					</div>
					
					<div class="kik_company_fields_title">Datele contului</div>
					
					<table class="kik_company_fields users table_type_main" data-tab="Datele contului">
						
						<!-- Labels -->
						<tr>
							<th>Camp</th>
							<th>Valoare</th>
						</tr>
						
						<!-- Existing rows -->
						<tr>
							<td colspan="2">
								<table class="table_type_row">
									<!-- Prenume -->
									<tr>
										<td>
											<label for="kik_user_first_name">Prenume:</label>
										</td>
										<td>
											<input type="text" class="size_s" id="kik_user_first_name" name="kik_user_first_name" value="<?php echo $user->first_name; ?>" /> <span></span>
										</td>
									</tr>
									<!-- Nume -->
									<tr>
										<td>
											<label for="kik_user_last_name">Nume:</label>
										</td>
										<td>
											<input type="text" class="size_s" id="kik_user_last_name" name="kik_user_last_name" value="<?php echo $user->last_name; ?>" /> <span></span>
										</td>
									</tr>
									<!-- Email -->
									<tr>
										<td>
											<label for="kik_user_email">Email:</label>
										</td>
										<td>
											<input type="text" class="size_s" id="kik_user_email" name="kik_user_email" value="<?php echo $user->user_email; ?>" /> <span></span>
										</td>
									</tr>
								</table>
							</td>
						<tr>
						<tr>
							<td colspan="2">
								<table class="table_type_row">
									<!-- Utilizator -->
									<tr>
										<td>
											<label for="kik_user_login">Utilizator:</label>
										</td>
										<td>
											<input type="text" class="size_s" id="kik_user_login" name="kik_user_login" value="<?php echo $user->user_login; ?>" disabled style="color:#787878;" />
										</td>
									</tr>
									<!-- Parola -->
									<tr>
										<td>
											<label for="kik_user_pass">Parolă nouă:</label>
										</td>
										<td>
											<input type="password" class="size_s" id="kik_user_pass" name="kik_user_pass" value="" /> <span></span>
										</td>
									</tr>
									<!-- Confirma parola -->
									<tr>
										<td>
											<label for="kik_user_pass_confirm">Confirmă parola nouă</label>
										</td>
										<td>
											<input type="password" class="size_s" id="kik_user_pass_confirm" name="kik_user_pass_confirm" value="" /> <span></span>
										</td>
									</tr>
								</table>
							</td>
						<tr>
						<?php if ($current_user_id == 1 || (is_array($current_user_roles) && in_array('Administrator', $current_user_roles))) { ?>
						<tr>
							<td colspan="2">
								<table class="table_type_row">
									<!-- Roluri -->
									<tr>
										<td>
											<label for="kik_user_roles">Roluri:</label>
										</td>
										<td>
											<select id="kik_user_roles" name="kik_user_roles[]" class="size_s" multiple>
												<?php foreach (get_option('kik_user_roles') as $role) { ?>
													<option value="<?php echo $role; ?>"<?php echo (is_array($kik_user_roles) && in_array($role, $kik_user_roles) ? ' selected' : ''); ?>><?php echo $role; ?></option>
												<?php } ?>
											</select>
										</td>
									</tr>
								</table>
							</td>
						<tr>
						<?php } ?>
						
					</table>
					
					&nbsp;<br />
					
					<?php if (is_array($kik_user_roles) && in_array('Agent de vânzări', $kik_user_roles)) { ?>
					
					<div class="kik_company_fields_title">Firme asociate ca agent de vânzări</div>
					
					<table class="kik_company_fields users table_type_main" data-tab="Firme asociate ca agent de vânzări">
						
						<!-- Labels -->
						<tr>
							<th>Firme disponibile</th>
							<th>Firme asociate</th>
						</tr>
						
						<!-- Existing rows -->
						<tr>
							<td colspan="2">
								<table class="table_type_row">
									<!-- Prenume -->
									<tr>
										<td>
											<select id="kik_user_companies_sales_available" name="kik_user_companies_sales_available[]" multiple>
												<?php
												$args = array(
													'post_type' => 'kik_company',
													'posts_per_page' => -1,
													'orderby' => 'title',
													'order' => 'ASC',
													'meta_query' => array(
														array(
															'key' => 'kik_company_sales_agent',
															'value' => $user->ID,
															'compare' => '!=',
														),
													),
												);
												$companies = get_posts($args);
												foreach ($companies as $company) { ?>
													<?php $meta = get_post_meta($company->ID, 'kik_company_sales_agent', true); ?>
													<option value="<?php echo $company->ID; ?>"<?php echo ($meta ? ' style="color:red;"' : ''); ?>><?php echo $company->post_title . ($meta ? ' (' . get_user_by('id', $meta)->display_name . ')' : ''); ?></option>
												<?php } ?>
											</select>
										</td>
										<td>
											<select id="kik_user_companies_sales_associated" name="kik_user_companies_sales_associated[]" multiple>
												<?php
												$args = array(
													'post_type' => 'kik_company',
													'posts_per_page' => -1,
													'orderby' => 'title',
													'order' => 'ASC',
													'meta_query' => array(
														array(
															'key' => 'kik_company_sales_agent',
															'value' => $user->ID,
															'compare' => '=',
														),
													),
												);
												$companies = get_posts($args);
												foreach ($companies as $company) { ?>
													<option value="<?php echo $company->ID; ?>"><?php echo $company->post_title; ?></option>
												<?php } ?>
											</select>
										</td>
									</tr>
								</table>
							</td>
						<tr>
						<tr>
							<td colspan="2">
								<table class="table_type_row">
									<!-- Utilizator -->
									<tr>
										<td class="align-center">
											<button type="button" id="kik_user_companies_sales_available_add">Asociază <i class="fa fa-arrow-right"></i></button>
										</td>
										<td class="align-center">
											<button type="button" id="kik_user_companies_sales_associated_remove">Elimină <i class="fa fa-arrow-left"></i></button>
										</td>
									</tr>
								</table>
							</td>
						<tr>
						
					</table>
					
					&nbsp;<br />
					
					<?php } ?>
					
					<?php if (is_array($kik_user_roles) && in_array('Inspector SSM', $kik_user_roles)) { ?>
					
					<div class="kik_company_fields_title">Firme asociate ca inspector SSM</div>
					
					<table class="kik_company_fields users table_type_main" data-tab="Firme asociate ca inspector SSM">
						
						<!-- Labels -->
						<tr>
							<th>Firme disponibile</th>
							<th>Firme asociate</th>
						</tr>
						
						<!-- Existing rows -->
						<tr>
							<td colspan="2">
								<table class="table_type_row">
									<!-- Prenume -->
									<tr>
										<td>
											<select id="kik_user_companies_inspector_available" name="kik_user_companies_inspector_available[]" multiple>
												<?php
												$args = array(
													'post_type' => 'kik_company',
													'posts_per_page' => -1,
													'orderby' => 'title',
													'order' => 'ASC',
													'meta_query' => array(
														array(
															'key' => 'kik_company_inspector',
															'value' => $user->ID,
															'compare' => '!=',
														),
													),
												);
												$companies = get_posts($args);
												foreach ($companies as $company) { ?>
													<?php $meta = get_post_meta($company->ID, 'kik_company_inspector', true); ?>
													<option value="<?php echo $company->ID; ?>"<?php echo ($meta ? ' style="color:red;"' : ''); ?>><?php echo $company->post_title . ($meta ? ' (' . get_user_by('id', $meta)->display_name . ')' : ''); ?></option>
												<?php } ?>
											</select>
										</td>
										<td>
											<select id="kik_user_companies_inspector_associated" name="kik_user_companies_inspector_associated[]" multiple>
												<?php
												$args = array(
													'post_type' => 'kik_company',
													'posts_per_page' => -1,
													'orderby' => 'title',
													'order' => 'ASC',
													'meta_query' => array(
														array(
															'key' => 'kik_company_inspector',
															'value' => $user->ID,
															'compare' => '=',
														),
													),
												);
												$companies = get_posts($args);
												foreach ($companies as $company) { ?>
													<option value="<?php echo $company->ID; ?>"><?php echo $company->post_title; ?></option>
												<?php } ?>
											</select>
										</td>
									</tr>
								</table>
							</td>
						<tr>
						<tr>
							<td colspan="2">
								<table class="table_type_row">
									<!-- Utilizator -->
									<tr>
										<td class="align-center">
											<button type="button" id="kik_user_companies_inspector_available_add">Asociază <i class="fa fa-arrow-right"></i></button>
										</td>
										<td class="align-center">
											<button type="button" id="kik_user_companies_inspector_associated_remove">Elimină <i class="fa fa-arrow-left"></i></button>
										</td>
									</tr>
								</table>
							</td>
						<tr>
						
					</table>
					
					&nbsp;<br />
					
					<?php } ?>
					
					<div class="kik_company_fields_footer"></div>
					
					<div class="kik_save_area"><a class="kik_save_btn edit" href="javascript:;"><i class="fa fa-fw fa-save"></i> Salvează utilizatorul</a><div class="kik_save_btn_response"></div></div>
					
				</form>
				
				<?php } ?>
				
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
