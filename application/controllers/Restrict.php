<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Restrict extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library("session");
	}

	public function index(){

		if($this->session->userdata("user_id")){
			$data = array(
				"styles" => array(
				"dataTables.bootstrap4.min.css",
				"datatables.min.css"
			),
			"scripts" => array(
				"sweetalert2.all.min.js",
				"dataTables.bootstrap4.min.js",
				"datatables.min.js",
				"util.js",
				"restrict.js" 
			),
				/* Usuario logado sessao para ver seus dados*/
				"user_id" => $this->session->userdata("user_id")
			);
			$this->template->show("restrict.php", $data);
		}else{
			$data = array(
				"scripts" => array(
					"util.js",
					"login.js"
				)	
			);	
		$this->template->show("login.php", $data);
		//echo password_hash("driver06", PASSWORD_DEFAULT);
		}
	}

	public function logoff(){
		$this->session->sess_destroy();
		header("Location: " . base_url() . "restrict");
	}

	public function ajax_login() {

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$username = $this->input->post("username");
		$password = $this->input->post("password");

		if (empty($username)) {
			$json["status"] = 0;
			$json["error_list"]["#username"] = "Usuário não pode ser vazio!";
		} else {
			$this->load->model("users_model");
			$result = $this->users_model->get_user_data($username);
			if ($result) {
				$user_id = $result->user_id;
				$password_hash = $result->password_hash;
				if (password_verify($password, $password_hash)) {
					$this->session->set_userdata("user_id", $user_id);
				} else {
					$json["status"] = 0;
				}
			} else {
				$json["status"] = 0;
			}
			if ($json["status"] == 0) {
				$json["error_list"]["#btn_login"] = "Usuário e/ou senha incorretos!";
			}
		}

		echo json_encode($json);

	}

	public function ajax_import_image(){

		if(!$this->input->is_ajax_request()){
			exit("Nenhum acesso de script direto permitido!");
		}
		$config["upload_path"] = "./tmp/";
		$config["allowed_types"] = "gif|png|jpg";
		$config["overwrite"] = TRUE;

		$this->load->library("upload", $config);

		$json = array();
		$json["status"] = 1;

		if(!$this->upload->do_upload("image_file")){
			$json["status"] = 0;
			$json["error"] = $this->upload->display_errors("","");
		}else{
			if($this->upload->data()["file_size"] <= 1024){
				$file_name = $this->upload->data()["file_name"];
				$json["img_path"] = base_url() . "tmp/" . $file_name;
			}else{
				$json["status"] = 0;
				$json["error"] = "Arquivo não pode ser maior que 1 MB";
			}
		}
		echo json_encode($json);
	}

	public function ajax_save_course(){

		if(!$this->input->is_ajax_request()){
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$this->load->model("courses_model");

		$data = $this->input->post();

		if(empty($data["course_name"])){
			$json["error_list"]["#course_name"] = "Nome do curso é obrigatório!";
		}else{
			if($this->courses_model->is_duplicated("course_name", $data["course_name"], $data["course_id"])){
				$json["error_list"]["#course_name"] = "Nome de curso já existente!";
				
			}
		}
		$data["course_duration"] = floatval($data["course_duration"]);

		if(empty($data["course_duration"])){
			$json["error_list"]["#course_duration"] = "Nome do curso é obrigatório!";
		}else{
			if(!($data["course_duration"] > 0 && $data["course_duration"] < 100)){
				$json["error_list"]["#course_duration"] = "Duração do curso deve ser maior 0h e menor que 100h";
			}
		}

		if(!empty($json["error_list"])){
			$json["status"] = 0;
		}else{
			if(!empty($data["course_img"])){
				$file_name = basename($data["course_img"]);
				$old_path = getcwd() . "/tmp/" . $file_name;
				$new_path = getcwd() . "/public/img/courses/" . $file_name;
				rename($old_path, $new_path);

				$data["course_img"] = "/public/img/courses/" . $file_name; //setando no banco
			}else{ //caso o campo de img estiver vazio
				unset($data["course_img"]);
			}

			if(empty($data["course_id"])){
				$this->courses_model->insert($data);
			}else{
				$course_id = $data["course_id"];
				unset($data["course_id"]);
				$this->courses_model->update($course_id, $data);
			}
		}
		echo json_encode($json);
	}

	public function ajax_save_member(){

		if(!$this->input->is_ajax_request()){
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$this->load->model("team_model");

		$data = $this->input->post();

		if(empty($data["member_name"])){
			$json["error_list"]["#member_name"] = "Nome do membro é obrigatório!";
		}

		if(!empty($json["error_list"])){
			$json["status"] = 0;
		}else{
			if(!empty($data["member_photo"])){
				$file_name = basename($data["member_photo"]);
				$old_path = getcwd() . "/tmp/" . $file_name;
				$new_path = getcwd() . "/public/img/team/" . $file_name;
				rename($old_path, $new_path);

				$data["member_photo"] = "/public/img/team/" . $file_name; //setando no banco
			}else{
				unset($data["member_photo"]);
			}

			if(empty($data["member_id"])){
				$this->team_model->insert($data);
			}else{
				$member_id = $data["member_id"];
				unset($data["member_id"]);
				$this->team_model->update($member_id, $data);
			}
		}
		echo json_encode($json);
	}

	public function ajax_save_user(){

		if(!$this->input->is_ajax_request()){
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["error_list"] = array();

		$this->load->model("users_model");

		$data = $this->input->post();

		if(empty($data["user_login"])){
			$json["error_list"]["#user_login"] = "Login é obrigatório!";
		}else{
			if($this->users_model->is_duplicated("user_login", $data["user_login"], $data["user_id"])){
				$json["error_list"]["#user_login"] = "Login de usuário já existente!";
			}
		}
		/* NOME DE USUARIO COMPLETO */
		if(empty($data["user_full_name"])){
			$json["error_list"]["#user_full_name"] = "Nome completo do usuário é obrigatório!";
		}

		/* EMAIL DE USUARIO */
		if(empty($data["user_email"])){
			$json["error_list"]["#user_email"] = "E-mail de Usuário é obrigatório!";
		}else{
			if($this->users_model->is_duplicated("user_email", $data["user_email"], $data["user_id"])){
				$json["error_list"]["#user_email"] = "E-mail de usuário já existente!";
			}else{
				if($data["user_email"] != $data["user_email_confirm"]){
					$json["error_list"]["#user_email"] = "";
					$json["error_list"]["#user_email_confirm"] = "E-mails não conferem!";
				}
			}
		}

		/* SENHA DE USUARIO */
		if(empty($data["user_password"])){
			$json["error_list"]["#user_password"] = "Senha de Usuário é obrigatório!";
		}else{
			if($data["user_password"] != $data["user_password_confirm"]){
				$json["error_list"]["#user_password"] = "";
				$json["error_list"]["#user_password_confirm"] = "Senhas não conferem!";
			}
		}

		if(!empty($json["error_list"])){
			$json["status"] = 0;
		}else{

			/* TRANSFORMAR A SENHA EM HASH */
			$data["password_hash"] = password_hash($data["user_password"], PASSWORD_DEFAULT);

			unset($data["user_password"]);
			unset($data["user_password_confirm"]);
			unset($data["user_email_confirm"]);

			if(empty($data["user_id"])){
				$this->users_model->insert($data);
			}else{
				$user_id = $data["user_id"];
				unset($data["user_id"]);
				$this->users_model->update($user_id, $data);
			}
		}
		echo json_encode($json);
	}
	/* Sessao para editar curso no Datatable */
	public function ajax_get_course_data(){

		if(!$this->input->is_ajax_request()){
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["input"] = array();

		$this->load->model("courses_model");

		$course_id = $this->input->post("course_id");
		/* Cada usuario num array */
		$data = $this->courses_model->get_data($course_id)->result_array()[0]; 
		/* Associando o id do usuario na sessao ao usuario na base de dados */
		$json["input"]["course_id"] = $data["course_id"]; 
		$json["input"]["course_name"] = $data["course_name"];
		$json["input"]["course_duration"] = $data["course_duration"];
		$json["input"]["course_description"] = $data["course_description"];
	
		$json["img"]["course_img_path"] = base_url() . $data["course_img"];

		
		echo json_encode($json);
	}

	/* Sessao para editar MEMBER no Datatable  */
	public function ajax_get_member_data(){

		if(!$this->input->is_ajax_request()){
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["input"] = array();

		$this->load->model("team_model");

		$member_id = $this->input->post("member_id");
		/* Cada usuario num array */
		$data = $this->team_model->get_data($member_id)->result_array()[0]; 
		/* Associando o id do usuario na sessao ao usuario na base de dados */
		$json["input"]["member_id"] = $data["member_id"]; 
		$json["input"]["member_name"] = $data["member_name"];
		$json["input"]["member_description"] = $data["member_description"];
	
		$json["img"]["member_photo_path"] = base_url() . $data["member_photo"];

		
		echo json_encode($json);
	}

	/* Sessao Usuario Logado para Visualizar seus DADOS */
	public function ajax_get_user_data(){

		if(!$this->input->is_ajax_request()){
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["input"] = array();

		$this->load->model("users_model");

		$user_id = $this->input->post("user_id");
		/* Cada usuario num array */
		$data = $this->users_model->get_data($user_id)->result_array()[0]; 
		/* Associando o id do usuario na sessao ao usuario na base de dados */
		$json["input"]["user_id"] = $data["user_id"]; 
		$json["input"]["user_login"] = $data["user_login"];
		$json["input"]["user_full_name"] = $data["user_full_name"];
		$json["input"]["user_email"] = $data["user_email"];
		$json["input"]["user_email_confirm"] = $data["user_email"];
		$json["input"]["user_password"] = $data["password_hash"];
		$json["input"]["user_password_confirm"] = $data["password_hash"];

		
		echo json_encode($json);
	}

	/* Sessao Usuario Logado para deletar CURSOS */
	public function ajax_delete_course_data(){

		if(!$this->input->is_ajax_request()){
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;

		$this->load->model("courses_model");
		$course_id = $this->input->post("course_id");
		$this->courses_model->delete($course_id); 
		
		echo json_encode($json);
	}

	/* Sessao Usuario Logado para deletar MEMBRO */
	public function ajax_delete_member_data(){

		if(!$this->input->is_ajax_request()){
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;

		$this->load->model("team_model");
		$member_id = $this->input->post("member_id");
		$this->team_model->delete($member_id); 
		
		echo json_encode($json);
	}

	/* Sessao Usuario Logado para deletar USUARIO */
	public function ajax_delete_user_data(){

		if(!$this->input->is_ajax_request()){
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;

		$this->load->model("users_model");
		$user_id = $this->input->post("user_id");
		$this->users_model->delete($user_id); 
		
		echo json_encode($json);
	}

	public function ajax_list_course(){

		if(!$this->input->is_ajax_request()){
			exit("Nenhum acesso de script direto permitido!");
		}

		$this->load->model("courses_model");
		$courses = $this->courses_model->get_datatable();

		$data = array();
		foreach ($courses as $course) {
			$row = array();
			$row[] = $course->course_name;

			if($course->course_img){
				$row[] = '<img src="'.base_url().$course->course_img.'" style="max-height: 100px; max-width: 100px;">';
			}else{
				$row[] = "";
			}

			$row[] = $course->course_duration;
			$row[] = '<div class="description">'.$course->course_description . '</div>';

			$row[] = '<div class="display: inline-block;">
						<button class="btn btn-primary btn-edit-course" 
							course_id="'.$course->course_id.'">
							<i class="fa fa-edit" aria-hidden="true"></i>
						</button>
						<button class="btn btn-danger btn-del-course" 
							course_id="'.$course->course_id.'">
							<i class="fa fa-times" aria-hidden="true"></i>
						</button>
					</div>';

			$data[] = $row;
		}

		$json = array(

			"draw" => $this->input->post("draw"),
			"recordsTotal" => $this->courses_model->records_total(),
			"recordsFiltered" => $this->courses_model->records_filtered(),
			"data" => $data,
		);
		
		echo json_encode($json);
	}
	public function ajax_list_member(){

		if(!$this->input->is_ajax_request()){
			exit("Nenhum acesso de script direto permitido!");
		}

		$this->load->model("team_model");
		$team = $this->team_model->get_datatable();

		$data = array();
		foreach ($team as $member) {
			$row = array();
			$row[] = $member->member_name;

			if($member->member_photo){
				$row[] = '<img src="'.base_url().$member->member_photo.'" style="max-height: 100px; max-width: 100px;">';
			}else{
				$row[] = "";
			}

			$row[] = '<div class="description">'.$member->member_description . '</div>';

			$row[] = '<div class="display: inline-block;">
						<button class="btn btn-primary btn-edit-member" 
							member_id="'.$member->member_id.'">
							<i class="fa fa-edit" aria-hidden="true"></i>
						</button>
						<button class="btn btn-danger btn-del-member" 
							member_id="'.$member->member_id.'">
							<i class="fa fa-times" aria-hidden="true"></i>
						</button>
					</div>';

			$data[] = $row;
		}

		$json = array(

			"draw" => $this->input->post("draw"),
			"recordsTotal" => $this->team_model->records_total(),
			"recordsFiltered" => $this->team_model->records_filtered(),
			"data" => $data,
		);
		
		echo json_encode($json);
	}

	public function ajax_list_user(){

		if(!$this->input->is_ajax_request()){
			exit("Nenhum acesso de script direto permitido!");
		}

		$this->load->model("users_model");
		$users = $this->users_model->get_datatable(); /* conjunto de usuarios */

		$data = array();
		foreach ($users as $user) {
			$row = array();
			$row[] = $user->user_login;
			$row[] = $user->user_full_name;
			$row[] = $user->user_email;

			$row[] = '<div class="display: inline-block;">
						<button class="btn btn-primary btn-edit-user" 
							user_id="'.$user->user_id.'">
							<i class="fa fa-edit" aria-hidden="true"></i>
						</button>
						<button class="btn btn-danger btn-del-user" 
							user_id="'.$user->user_id.'">
							<i class="fa fa-times" aria-hidden="true"></i>
						</button>
					</div>';

			$data[] = $row;
		}

		$json = array(

			"draw" => $this->input->post("draw"),
			"recordsTotal" => $this->users_model->records_total(),
			"recordsFiltered" => $this->users_model->records_filtered(),
			"data" => $data,
		);
		
		echo json_encode($json);
	}

}