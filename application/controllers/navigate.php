<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class navigate extends CI_Controller {

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
		$this->load->model('connectdatabase');	
			
	}
	public function index()
	{
		$this->load->view('login');
	}
	public function registerpage()
	{
		$this->load->view('register');
	}
	
	public function postbookpage()
	{
		$this->load->view('postbook');
	}
	public function deletebookpage()
	{
		$data['values'] = $this->connectdatabase->showbook($this->uri->segment(3));
		$this->load->view('deletebook',$data);
	}


	public function interestedpeoplepage()
	{
		$data['values'] = $this->connectdatabase->showi($_POST['people']);
		$data['post_id']=$_POST['post_id'];
		
		$this->load->view('interestedpeople',$data);
	}
	
	public function deletebook()
	{
		$this->connectdatabase->delete($this->uri->segment(3));
		redirect('navigate/dashboardpage');
	}
	public function dashboardpage()
	{
		if($this->session->userdata('id')==null)
			redirect('/navigate/');
		$data['values'] = $this->connectdatabase->show($this->session->userdata('id'));
		$data['value']= $this->connectdatabase->showown($this->session->userdata('id'));
		$data['value1']= $this->connectdatabase->showown($this->session->userdata('id'));
		$data['val']= $this->connectdatabase->showownrent($this->session->userdata('id'));
		$this->load->view('dashboard',$data);
		
	}
	public function forrentpage()
	{
		if($this->session->userdata('id')==null)
			redirect('/navigate/');
		$data['values'] = $this->connectdatabase->showall();
		$data['value']= $this->session->userdata('id');
		$this->load->view('forrent',$data);
		
	}
	public function acceptrent()
	{
		//$data['values'] = $this->connectdatabase->showall();
		//$data['value']= $this->session->userdata('id');
		//$this->load->view('forrent',$data);
		echo "it worked";
		echo $_POST['initialp']." ".$_POST['renter']." ".$_POST['booknum'];
		$values = array(
					'id'		=>$_POST['booknum'],
					'payment' 	=> $_POST['initialp'],
					'rentedby'	=> $_POST['renter'],
					'renter'		=> $_POST['rentername'],
			);
		$this->connectdatabase->acceptrenter($values);
		redirect('navigate/dashboardpage');
	}
	public function iminterested()
	{
		if($this->session->userdata('id')==null)
			redirect('/navigate/');
		$data['v']= $this->connectdatabase->showbook($this->uri->segment(3));
		
		foreach($data['v']->result() as $row){
			if($row->interested==0)
				$i = $this->session->userdata('id');
			else
			$i=$this->session->userdata('id').'a'.$row->interested;
			$d=$row->num_i+1;
		}
		echo $i;		
		$values = array(
					'id' 	=> $this->uri->segment(3),
					'interested'=> $i,
					'num_i'		=> $d
			);
			
		$this->connectdatabase->iminterested($values);
		redirect('navigate/forrentpage');
		
	}
	public function register()
	{
		
		if(isset($_POST['submit']))
		{
	
		$config['upload_path'] = './images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['encrypt_name']=true;
		
		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			echo $error['error'];
		}
		else
		{

			$data =  $this->upload->data();
			$values = array(
					'email' 	=> $_POST['email'],
					'password'	=> $_POST['password'],
					'name'		=> $_POST['name'],
					'number'	=> $_POST['number'],
					'address'	=> $_POST['address'],
					'image'		=> base_url().'images/'.$data['file_name']
			);
	
			
			if($this->connectdatabase->insert($values)){
				
				 $this->load->view('login');
			}
			
			
		}
			

		
	}
		

	}
	public function verify_user(){
		
			$data['x']= $this->connectdatabase->getemail($_POST['email']);
			foreach($data['x']->result() as $row){
				$exist=$row->email;
				$pass=$row->password;
				$id=$row->id;
			}
			if(@$exist!=null){
				if(md5($_POST['password'])==$pass){
					
					$this->session->set_userdata(array('id'=>$id));
					redirect('/navigate/dashboardpage');
				
				}else{
					
					$d['error']="Invalid password!";
				//$this->load->view('login',$d);
					echo "password!";
				}
			}else{
				$d['error']="Invalid username!";
				echo "uname!";
				//$this->load->view('login',$d);
			}
				
		
	}
	
	public function postbook()
	{
		if(isset($_POST['submit']))
		{
	
		$config['upload_path'] = './images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['encrypt_name']=true;
		
		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			echo $error['error'];
		}
		else
		{

			$data =  $this->upload->data();
			$values = array(
					'title' 	=> $_POST['title'],
					'author'	=> $_POST['author'],
					'price'		=> $_POST['price'],
					'condition'	=> $_POST['condition'],
					'cnum'		=> $_POST['cnum'],
					'image'		=> 'images/'.$data['file_name']
			);
	
			
			if($this->connectdatabase->postbook($values)){
				
				 redirect('/navigate/dashboardpage');
			}
			
			
			}
			
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */