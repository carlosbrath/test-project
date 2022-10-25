<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ApiController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        error_reporting(0);
        $this->load->library('session');
        $this->load->model('defaultModel');
    }
    public function index()
    {
        $email_data = array(
            'email_body' => '<p style="font-size: 12px;color: #555;">Hi, <br> your <b>bookmy.estate</b> Login has been setup. you can now login to your account.</p>
            <p style="font-size: 12px;color: #555;">Using the email and password detail below:</p>',
            'data' => array(
                'subject' => 'Welcome bookmy.estate',
                'email' => 'ahsandanish.rad@gmail.com',
                'password' => 'HJN1234',
            )
        );
        // $this->load->view('email-format', $email_data,);
        $message = $this->load->view('email-format', $email_data, true);


    }
    public function sign_up()
    {
        $password = $this->random_str(8);
        $data = array(

            'fname' => $_POST['fname'],
            'lname' => $_POST['lname'],
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            // 'password' =>  password_hash($password, PASSWORD_BCRYPT),
            'password' =>  password_hash('121956', PASSWORD_BCRYPT),
            'created_at'=> date("Y/m/d"),
        );
        if ($this->defaultModel->Insert_Data('users', $data)) {
            $email_data = array(
                'email_body' => '<p style="font-size: 12px;color: #555;">Hi, <br> your <b>bookmy.estate</b> Login has been setup. you can now login to your account.</p>
                <p style="font-size: 12px;color: #555;">Using the email and password detail below:</p>',
                'data' => array(
                    'subject' => 'Welcome bookmy.estate',
                    'email_to' => $data['email'],
                    'password' => $password,
                )
            );
            $resp['data']=$email_data;
            $message = $this->load->view('email-format', $email_data, true);
            $resp['message']=$message;
            $resp['status']='1';

            // $this->send_email($email_data['data'], $message);
            echo json_encode($resp);
        }
    }
    function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        if ($max < 1) {
            throw new Exception('$keyspace must be at least two characters long');
        }
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }
        return $str;
    }
    public function login()
    {   
        // echo '<pre>';
        // print_r($_POST);
        // exit;
            $data = array(
                'username' => $_POST['username']
            );
            $user = $this->defaultModel->Select_Where_Row('*', $data, 'users');
        //     echo '<pre>';
        // print_r($user);
        // exit;
            if (password_verify($_POST['password'], $user['password'])) {
                $this->session->unset_userdata('userlog');
                $this->session->set_userdata('userlog', $user);
                echo '1';
            } else {
                echo '0';
            }
        
    }
    public function logout()
    {
        session_start();
        $this->session->unset_userdata('userlog');
        header('Location:' . base_url());
    }
    public function send_email($data, $message)
    {
        $con = array(
            'protocol' => 'mail', // 'mail', 'sendmail', or 'smtp'
            'smtp_host' => 'bookmy.estate',
            'smtp_port' => 465,
            'smtp_user' => 'Ahsan@bookmy.estate',
            'smtp_pass' => 'Rad@3251',
            'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
            'mailtype' => 'html', //plaintext 'text' mails or 'html'
            'smtp_timeout' => '40', //in seconds
            'charset' => 'iso-8859-1',
        );
        $this->load->library('email', $con);
        $this->email->set_newline("\r\n");
        $this->email->from($con['smtp_user']); // change it to yours
        $this->email->to($data['email']); // change it to yours
        $this->email->subject($data['subject']);
        $this->email->message($message);

        if ($this->email->send()) {
            echo 'Your Email has successfully been sent.';
        } else {
            show_error($this->email->print_debugger());
        }
    }
    public function crud_operations()
    {
        		// echo json_encode($_POST);exit;
		if ($_POST['crud']['ops'] == 'creat') {
			$data = $this->defaultModel->Insert_Data($_POST['crud']['entity'], $_POST['crud']['data']);
			echo json_encode($data);
		} else if ($_POST['crud']['ops'] == 'update') {
			$data = $this->defaultModel->Update_Data($_POST['crud']['condition'], $_POST['crud']['entity'], $_POST['crud']['data']);
			echo json_encode($data);
		} else if ($_POST['crud']['ops'] == 'delete') {
            $data = $this->defaultModel->Delete_Data($_POST['crud']['condition'], $_POST['crud']['entity']);
			echo json_encode($data);
		} else if ($_POST['crud']['ops'] == 'read-data') {
            $data = $this->defaultModel->Select_Where_Data($_POST['crud']['fields'], array(), $_POST['crud']['entity']);
			echo json_encode($data);
		} else if ($_POST['crud']['ops'] == 'read-row') {
            $data = $this->defaultModel->Select_Where_Row($_POST['crud']['fields'], $_POST['crud']['condition'], $_POST['crud']['entity']);
			echo json_encode($data);
		} 
    }
}
