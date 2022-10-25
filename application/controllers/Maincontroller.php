<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Maincontroller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		error_reporting(0);
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('defaultModel');
	}
	public function index()
	{
		$data['data'] = $this->defaultModel->Select_Data('*', 'vehical_table');
		$this->load->view('webview/header');
		$this->load->view('webview/dashboard', $data);
		$this->load->view('webview/footer');
	}
	public function signup_view()
	{
		$this->load->view('webview/header');
		$this->load->view('webview/signup');
		$this->load->view('webview/footer');
	}
	public function login_view()
	{
		$this->load->view('webview/header');
		$this->load->view('webview/login');
		$this->load->view('webview/footer');
	}
	public function vehical_form()
	{
		$this->load->view('webview/header');
		$this->load->view('webview/vehical-form');
		$this->load->view('webview/footer');
	}
	public function category_form()
	{
		print_r($_SESSION);exit;
		$this->load->view('webview/header');
		$this->load->view('webview/category-form');
		$this->load->view('webview/footer');
	}
	public function category_view()
	{
		$data['data'] = $this->defaultModel->Select_Data('*', 'category_table');
		$this->load->view('webview/header');
		$this->load->view('webview/category-view', $data);
		$this->load->view('webview/footer');
	}
	public function update()
	{
		$content = $this->uri->segment('2');
		$data['id'] = $this->uri->segment('3');
			$this->load->view('webview/header');
			$this->load->view('webview/'.$content.'-form', $data);
			$this->load->view('webview/footer');
	}
}
