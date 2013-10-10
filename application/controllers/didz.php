<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class didz extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('accounts_model');		
	}
	public function index()
	{
		$this->load->view('welcomedidz');
	}
	public function index1()
	{
		$this->load->view('mysched');
	}
	public function cntct()
	{
		$this->load->view('mycontact');
	}
	public function register()
	{
		$this->load->view('register');
	}
	public function showlist()
	{
		if($this->session->userdata('type')==null)
			redirect('/didz/login');
		$data['values'] = $this->accounts_model->showall();
		$this->load->view('accounts_table',$data);
	}
	public function insert()
	{
		
		if(isset($_POST['submit']))
		{
			if($_POST['redirect']!=NULL)
				redirect('/didz/showlist');
			$bday=explode("-",$_POST['date']);
			$values = array(
					'username' 	=> $_POST['uname'],
					'password'	=> $_POST['pass'],
					'type'		=> $_POST['type'],
					'firstname'	=> $_POST['fname'],
					'lastname'	=> $_POST['lname'],
					'middlename'=> $_POST['mname'],
					'month'		=> $bday[1],
					'date'		=> $bday[2],
					'year'		=> $bday[0],
					'gender'	=> $_POST['gender'],
					'civilstatus'=> $_POST['status'],
					'email'		=> $_POST['email'],
					'contactnumber'=> $_POST['cnum'],
					'aboutme'	=> $_POST['am']
					

			);

			$data['check1']=$_POST['date'];
			if($this->accounts_model->insert($values))
			$data['values'] = $this->accounts_model->showall();
		$this->load->view('accounts_table',$data);

		}
		$data['check1']=$_POST['date'];
		$data['values'] = $this->accounts_model->showall();
		$this->load->view('accounts_table',$data);

	}
	public function update($id)
	{	
		if($this->session->userdata('type')=="admin"){
		$data['user'] = $this->accounts_model->show($id);
		$this->load->view('update_info',$data);
		}else{ 
			$data['values'] = $this->accounts_model->showall();
			$data['error'] = "You need to be an admin to edit / delete accounts";
			$this->load->view('accounts_table',$data);
		}
	}

	public function modify()
	{
		if(@$_POST['redirect1']!=NULL)
				redirect('/didz/showlist');
		if(isset($_POST['submit']))
		{	$bday=explode("-",$_POST['date']);
			$values = array(
					'id'		=> $_POST['id'],
					'username' 	=> $_POST['uname'],
					'password'	=> $_POST['pass'],
					'type'		=> $_POST['type'],
					'firstname'	=> $_POST['fname'],
					'lastname'	=> $_POST['lname'],
					'middlename'=> $_POST['mname'],
					'month'		=> $bday[1],
					'date'		=> $bday[2],
					'year'		=> $bday[0],
					'gender'	=> $_POST['gender'],
					'civilstatus'=> $_POST['status'],
					'email'		=> $_POST['email'],
					'contactnumber'=> $_POST['cnum'],
					'aboutme'	=> $_POST['am']
					

			);

			$this->accounts_model->update($values);
			$data['values'] = $this->accounts_model->showall();
		$this->load->view('accounts_table',$data);
		}

	}

	public function delete($id)
	{
		if($this->session->userdata('type')=="admin"){
		$this->accounts_model->delete($id);
		redirect('/didz/showlist');
		}else{
			echo "<script>alert('You do not have the authority to change any data in this table!');</script>";
			$data['values'] = $this->accounts_model->showall();
			$this->load->view('accounts_table',$data);
		}
	}
	public function login()
	{
		$this->load->view('login');
	}
	public function logout()
	{
		$this->session->set_userdata(array('type'=>null));
		$this->load->view('login');
	}



	public function checklogin(){
		if(isset($_POST['submit'])){
			$data['x']= $this->accounts_model->getuname($_POST['uname']);
			foreach($data['x']->result() as $row){
				$exist=$row->username;
				$pass=$row->password;
				$type=$row->type;
			}
			if(@$exist!=null){
				if(md5($_POST['pass'])==$pass){
					
					$this->session->set_userdata(array('type'=>$type));
					redirect('/didz/showlist');
				
				}else{
					
					$d['error']="Invalid password!";
				$this->load->view('login',$d);
				}
			}else{
				$d['error']="Invalid username!";
				$this->load->view('login',$d);
			}
				
		}
	}
	
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */