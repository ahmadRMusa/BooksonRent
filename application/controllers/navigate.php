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
	public function dashboardpage()
	{
		$this->load->view('dashboard');
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
			}
			if(@$exist!=null){
				if(md5($_POST['password'])==$pass){
					
					$this->session->set_userdata(array('email'=>$exist));
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
	public function uploadpic()
	{ echo "hello nisud ko";
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);
		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/x-png")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& ($_FILES["file"]["size"] < 20000)
		&& in_array($extension, $allowedExts))
		  {
		  if ($_FILES["file"]["error"] > 0)
		    {
		    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
		    }
		  else
		    {
		    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
		    echo "Type: " . $_FILES["file"]["type"] . "<br>";
		    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
		    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

		    if (file_exists("upload/" . $_FILES["file"]["name"]))
		      {
		      echo $_FILES["file"]["name"] . " already exists. ";
		      }
		    else
		      {
		      move_uploaded_file($_FILES["file"]["tmp_name"],
		      "upload/" . $_FILES["file"]["name"]);
		      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
		      }
		    }
		  }
		else
		  {
		  echo "Invalid file";
		  }
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */