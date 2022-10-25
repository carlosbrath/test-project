<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Maincontroller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		error_reporting(0);
		$this->load->helper('url');
		$this->load->helper(array('cookie', 'url'));
		$this->load->library('session');
		$this->load->model('defaultModel');
		$this->load->model('reportingModel');
		$this->header_data['count_overdue']= $this->defaultModel->Count_Data('booking_id', array('customer_id' => $_SESSION['userlog']['id'], 'meeting_status'=>'1', 'date_in <='=>Date('Y/m/d')), 'meeting_table');
		$this->header_data['count_schedule']= $this->defaultModel->Count_Data('booking_id', array('customer_id' => $_SESSION['userlog']['id'], 'meeting_status'=>'1', 'date_in >'=>Date('Y/m/d')), 'meeting_table');
		$this->header_data['meeting_data']= $this->defaultModel->Select_Where_Data('*', array('customer_id' => $_SESSION['userlog']['id'], 'meeting_status'=>'1'), 'meeting_table');
		if(!isset($_SESSION['currency']))
		$_SESSION['currency']=array(
			'country'=>'UNITED KINGDOM',
			'name'=> 'Pound Sterling',
			'code'=>'GBP',
			'symbol'=>'£',
			'rate'=>'1',
		);
	}
	public function _p($data, $exit = false)
	{
		echo '<pre>';
		print_r($data);
		echo '</pre>';
		if ($exit) {
			exit;
		}
	}
	public function index()
	{

		if (empty($_SESSION['userlog']) && !empty($_COOKIE['remember_me_token'])) {
			$id = $_COOKIE['remember_me_token'];
			$user = $this->defaultModel->Select_Where_Row('*', array('id' => $id), 'users');
			$this->session->set_userdata('userlog', $user);
		}
		$this->load->view('webtheam/web-header');
		$this->load->view('webtheam/web-home');
		$this->load->view('webtheam/web-footer');
	}
	public function all_rooms()
	{
		$condition = array(
			'room_categories',
			'rooms_table.room_category=room_categories.id',
			'business_info', 'rooms_table.business_id=business_info.business_id',
			'location_table', 'rooms_table.room_location=location_table.location_id',
		);
		$rooms = $this->reportingModel->Join_Multy_Tables('*', 'rooms_table', array('status' => '1'), $condition);
		$data['data'] = array_reverse($rooms);
		$data['services'] = $this->defaultModel->Select_Data('*', 'room_services');
		$this->load->view('webtheam/web-header');
		$this->load->view('webtheam/web-all-rooms', $data);
		$this->load->view('webtheam/web-footer');
	}
	public function room_details()
	{
		$id = $this->uri->segment('3');
		$condition = array(
			'room_categories',
			'rooms_table.room_category=room_categories.id',
			'business_info', 'rooms_table.business_id=business_info.business_id',
			'location_table', 'rooms_table.room_location=location_table.location_id',
		);
		$data['data'] = $this->reportingModel->Join_Multy_Tables('*', 'rooms_table', array('rooms_table.room_id' => $id), $condition);
		$data['services'] = $this->defaultModel->Select_Data('*', 'room_services');
		$data['galleries'] = $this->defaultModel->Select_Where_Data('*', array('room_id' => $id), 'gallery_table');
		$this->load->view('webtheam/web-header');
		$this->load->view('webtheam/web-room-details', $data);
		$this->load->view('webtheam/web-footer');
	}
	public function web_registrtion($key = 0)
	{
		if ($key == 1) {
			$this->load->view('webtheam/web-header');
			$this->load->view('webtheam/web-owner-registration');
			$this->load->view('webtheam/web-footer');
		} else {
			$this->load->view('webtheam/web-header');
			$this->load->view('webtheam/web-customer-registration');
			$this->load->view('webtheam/web-footer');
		}
	}
	public function web_dashboard()
	{

		$this->load->view('webtheam/web-header');
		$this->load->view('webtheam/web-dashboard');
		$this->load->view('webtheam/web-footer');
	}
	public function about_us()
	{
		$this->load->view('webtheam/web-header');
		$this->load->view('webtheam/web-about-us');
		$this->load->view('webtheam/web-footer');
	}
	public function db_content($content)
	{
		$this->load->view('webtheam/' . $content);
	}
	public function db_content2()
	{
		if ($_SESSION['userlog']['type'] != '3') {
			header('Location:' . base_url() . 'admin');
		}
		$content = $this->uri->segment('2');
		$this->load->view('webtheam/web-header');
		$this->load->view('webtheam/db-sidebars-left');
		$this->load->view('webtheam/' . $content);
		$this->load->view('webtheam/db-sidebars-right', $this->header_data);
		$this->load->view('webtheam/web-footer');
	}
	public function wd_content($content)
	{
		$this->load->view('webtheam/' . $content, $_POST);
	}
	public function web_changePassword($id)
	{
		if ($id == '1') {
			$this->load->view('webtheam/web-header');
			$this->load->view('webtheam/web-confirmEmail');
			$this->load->view('webtheam/web-footer');
		} else {

			$data = array(
				'Key' => $_GET['key'],
				'email' => $_GET['email'],
			);
			$curDate = date("Y-m-d H:i:s");
			$key_data = $this->defaultModel->Select_Where_Row('*', $data, 'password_reset_temp');
			if (isset($key_data)) {
				if ($key_data['expDate'] >= $curDate) {
					$data['linkStatus'] = '1';
					$this->load->view('webtheam/web-header');
					$this->load->view('webtheam/web-changePassword', $data);
					$this->load->view('webtheam/web-footer');
				} else {
					$data['linkStatus'] = '0';
					$data['error'] = '<h2>Link Expired</h2><p>The link is expired. You are trying to use the expired link which 
					as valid only 24 hours (1 days after request).<br /><br /></p>';
					$this->load->view('webtheam/web-header');
					$this->load->view('webtheam/web-changePassword', $data);
					$this->load->view('webtheam/web-footer');
				}
			} else {
				$data['linkStatus'] = '0';
				$data['error'] = '<h2>Invalid Link</h2>
				<p>The link is invalid/expired. Either you did not copy the correct link
				from the email, or you have already used the key in which case it is 
				deactivated.</p>
				<p><a href="https://bookmy.estate/confirmEmail">
				Click here</a> to reset password.</p>';
				$this->load->view('webtheam/web-header');
				$this->load->view('webtheam/web-changePassword', $data);
				$this->load->view('webtheam/web-footer');
			}
		}
	}
}
