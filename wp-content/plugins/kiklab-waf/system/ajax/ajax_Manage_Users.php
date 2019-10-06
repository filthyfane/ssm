<?php

	add_action('wp_ajax_KIK_ACTION_Manage_Users', 'KIK_ACTION_Manage_Users');
	add_action('wp_ajax_nopriv_KIK_ACTION_Manage_Users', 'KIK_ACTION_Manage_Users');

	function KIK_ACTION_Manage_Users(){
		global $wpdb;
		$response = [];
		
		if($_POST['userId'] == 0){
			
			// CREATE USER
			$pass   = wp_generate_password(12, false);
			$userId = wp_create_user($_POST['userLogin'], $pass, $_POST['userMail']);
			
			if(is_wp_error($userId)){
				returnError($userId->get_error_message());
			} else {
				$userdata = [
					'ID' => $userId,
					'first_name' => $_POST['userFirstName'],
					'last_name' => $_POST['userLastName'],
					'role' => $roles
				];
				$userId = wp_update_user($userdata);
				
				$oUser = new WP_User($userId);
				$oUser->set_role('');
				foreach($_POST['roles'] as $role){
					$oUser->add_role($role);
				}
				
				if(is_wp_error($userId)){
					returnError($userId->get_error_message());
				}
			}
			
			wp_mail($_POST['userMail'], 'Welcome!', 'Your Password: ' . $pass);
			$response = ['success' => true];
		} else {
			
			// UPDATE USER
			
			$userId = $_POST['userId'];
			$roles = [];
			foreach($_POST['roles'] as $role){
				$roles[] = $role;
			}
			
			$userdata = [
				'ID' => $userId,
				'first_name' => $_POST['userFirstName'],
				'last_name' => $_POST['userLastName'],
				'user_mail' => $_POST['userMail'],
				'role' => $roles
			];
			$userId = wp_update_user($userdata);
			
			$oUser = new WP_User($userId);
			$oUser->set_role('');
			foreach($_POST['roles'] as $role){
				$oUser->add_role($role);
			}

			if(is_wp_error($userId)){
				$response = [
					'success' => false,
					'errMsg'  => $userId->get_error_message()
				];
				echo json_encode($response);
				die();
			}
			
			if(isset($_POST['password']) && $_POST['password']){
				passwordValidator($_POST['password'], $_POST['confirmPassword']);
				wp_set_password($_POST['password'], $oUser->ID);
				wp_mail($oUser->user_email, 'Update user', 'Noua parolă este ' . $_POST['password']);
			}
			$response = ['success' => true];
		}
		
		echo json_encode($response);
		die();
	}
	
	function passwordValidator($pass, $confirmPass){	
		if($pass !== $confirmPass){
			returnError('Câmpurile Parolă și Confirmă parola nu sunt identice');
		} elseif(strlen($pass) < 8){
			returnError('Parola setată trebuie să aibă minimum 8 caractere și trebuie să conțină litere, cifre și caractere speciale');
		} elseif(!preg_match("/[a-zA-Z]/", $pass)){
			returnError('Parola setată trebuie să conțină litere');
		} elseif(!preg_match("/\d/",$pass)){
			returnError('Parola setată trebuie să conțină cel puțin o cifră');
		} elseif(!preg_match("/[^a-zA-Z\d]/")){
			returnError('Parola setată nu conține caractere speciale');
		}
	}
?>