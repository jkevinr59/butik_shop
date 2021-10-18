<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mailer extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper("form");
		$this->load->library("form_validation");
		$this->load->library("session");
		$this->load->helper('url');
		$this->load->Model('Model');
	}

	//Kirim Email
	public function sendemail_backup()
	{
		$email = $this->session->userdata('email');
		//echo "<script>alert('".$email."');</script>";
		
		$config= array(
		  'protocol' => 'smtp',  
			// 'protocol' => 'mail',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			// 'smtp_host' => 'ssl://mail.legendabatik.com',
			// 'smtp_user' => 'verfikasilegendabatik@gmail.com',
			'smtp_user' => 'butikbatiklegend@gmail.com',
			// 'smtp_user' => 'verifikasiemail@legendabatik.com',
			// 'smtp_pass' => 'marcell18-11',
			'smtp_pass' => 'TugasAkhir11',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset'   => 'iso-8859-1'
		);
		$this->load->library('email',$config);
		$this->email->set_newline("\r\n");   
		$subject = 'Legenda Batik Verification Email';
		$message = "We want to Verify your email click on the link down below to verify your email for login into your account<br>".'<a href='.site_url('Mailer/acceptverify').'>Click Here To Verify</a>';

		// Get full html:
		$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			
			<title>' . html_escape($subject) . '</title>
			<style type="text/css">
				body {
					font-family: Arial, Verdana, Helvetica, sans-serif;
					font-size: 16px;
				}
			</style>
		</head>
		<body>
		' . $message . '
		</body>
		</html>';
// 		$this->email->from('verfikasilegendabatik@gmail.com', 'Legenda Batik Verification');
		$this->email->from('verifikasiemail@legendabatik.com', 'Legenda Batik Verification');
		$this->email->to($email);
		$this->email->subject($subject);
		$this->email->message($body);
		 if($this->email->send()){
                echo "<script>alert('Silahkan verify email anda');</script>";
                redirect('/Cont/index');
         }else {
                 echo "<script>alert('".show_error($this->email->print_debugger())."');</script>";
         } 

		//Pengecekan Terkirim (saat mengirim harus menambahkan paramenter false saat memanggil send)
		//echo $this->email->print_debugger();
	}

	//Kirim Email
	public function sendpass()
	{
		$email = $this->session->userdata('email');
		$newpass= $this->session->userdata('new_pass');
		//echo "<script>alert('".$email."');</script>";
		
		$config= array(
		  'protocol' => 'smtp',  
			// 'protocol' => 'mail',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			// 'smtp_host' => 'ssl://mail.legendabatik.com',
			'smtp_user' => 'verfikasilegendabatik@gmail.com',
			// 'smtp_user' => 'verifikasiemail@legendabatik.com',
			'smtp_pass' => 'marcell18-11',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset'   => 'iso-8859-1'
		);
		$this->load->library('email',$config);
		$this->email->set_newline("\r\n");   
		$subject = 'Legenda Batik Password Forgot';
		$message = "Your new Password are<br><h3>".$newpass."</h3>";

		// Get full html:
		$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			
			<title>' . html_escape($subject) . '</title>
			<style type="text/css">
				body {
					font-family: Arial, Verdana, Helvetica, sans-serif;
					font-size: 16px;
				}
			</style>
		</head>
		<body>
		' . $message . '
		</body>
		</html>';
		$this->email->from('verfikasilegendabatik@gmail.com', 'Legenda Batik Verification');
		// $this->email->from('verifikasiemail@legendabatik.com', 'Legenda Batik Verification');
		$this->email->to($email);
		$this->email->subject($subject);
		$this->email->message($body);
		 if($this->email->send()){
                // echo "<script>alert('Silahkan verify email anda');</script>";
                redirect('/Cont/index');
         }else {
         	echo show_error($this->email->print_debugger());
                //  echo "<script>alert('".show_error($this->email->print_debugger())."');</script>";
         } 

		//Pengecekan Terkirim (saat mengirim harus menambahkan paramenter false saat memanggil send)
		//echo $this->email->print_debugger();
	}

	public function acceptverify($email)
	{
		var_dump($email);
		die;
		$this->Model->verifyEmail($email);
		echo "<script>alert('Berhasil verify email: ".$email."');</script>";
		redirect('/Cont/index');
	}
}
?>
