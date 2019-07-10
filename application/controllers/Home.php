<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->model("courses_model"); //carregar o model para setar os dados no front

		$courses = $this->courses_model->show_course();

		$data = array(
			"courses" => $courses
		);

		$this->template->show('home.php', $data);
	}
}
