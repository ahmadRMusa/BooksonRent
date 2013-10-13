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
	public function searchpage(){
		$data['value']= $this->session->userdata('id');
		$data['values'] = $this->connectdatabase->search($_POST['userquery']);
		$this->load->view('searchresults',$data);

	}
	public function display(){
		if($this->session->userdata('id')==null)
			redirect('/navigate/');
		$data['values'] = $this->connectdatabase->show($_POST['p']);

		foreach($data['values']->result() as $row)
            {
                echo '<img style="height:120;width:100px;" src="'.base_url().$row->image.'"></img>';
                echo '<br/>Personal Details:<br/> ';
                echo '<ul><li>Full Name: '.$row->name.'</li>';                    
                echo '<li>Email: '.$row->email.'</li>'; 
                echo '<li>Address: '.$row->address.'</li>';
                echo '<li>Contact Number: '.$row->number.'</li>'; 
                echo '</ul>';
             }                         
               
            
	}
	public function updateP(){
		if($this->session->userdata('id')==null)
			redirect('/navigate/');
		$trueA['amt']=$this->connectdatabase->refreshUpdate($_POST['post']);
		foreach($trueA['amt']->result() as $row)
            {	
            	$trueAMT=$row->payment;
            	$truePrice=$row->price;
            }

		$total = $trueAMT+$_POST['payment'];
		if($total<$truePrice||$total=$truePrice){


		$values = array(
					'id'		=>$_POST['post'],
					'payment' 	=> $total
					
			);
		$this->connectdatabase->updatePayments($values);
		$data['values']=$this->connectdatabase->refreshUpdate($_POST['post']);
		foreach($data['values']->result() as $row)
            {
                     echo '<div id="uBlock'.$row->id.'">';
                    echo '<div class="col-md-2"><img src="'.base_url().$row->image.'"  class="forrent-img" ></img></div>';
                    echo '<div class="col-md-4 forrent-sep" > <a href="'.base_url().'index.php/navigate/deletebookpage/'.$row->id.'"class="close" aria-hidden="true">&times;</a>Title: '.$row->title.'<br/>Author: '.$row->author.'<br/>Rent Price: '.$row->price;
                    echo '<br/>Payments: '.$row->payment;    
                    echo '<br/>Rented by: <a data-toggle="modal" href="#myModal'.$row->id.'" id="d'.$row->id.'">'.$row->renter.'</a>';
                    echo '<br/>Progress: '.$this->calculate($row->payment,$row->price).'%';
                        echo '<div class="progress">
                              <div class="progress-bar" role="progressbar" aria-valuenow="'.$this->calculate($row->payment,$row->price).'" aria-valuemin="0" aria-valuemax="100" style="width: '.$this->calculate($row->payment,$row->price).'%;">
                             
                              </div>
                              </div>';
                      echo '<center><a data-toggle="modal" href="#updateModal'.$row->id.'" id="update'.$row->id.'" class="btn btn-warning" style="margin-bottom:10px;margin-top:0px;">Update</a></center>';
                         echo '</div>';
                        
                   
                         echo '</div>';
             }         
          }
            
	}
	public function calculate($now,$total){
  			$zz=$now/$total;
  			$zz=$zz*100;
 			 return number_format($zz, 2, '.', '');
	}

	public function index()
	{
		$this->load->view('login');
	}
	public function registerpage()
	{
		$this->load->view('register');
	}
	public function editpage()
	{	if($this->session->userdata('id')==null)
			redirect('/navigate/');
		$data['values'] = $this->connectdatabase->show($this->session->userdata('id'));
		$this->load->view('edit',$data);
	}
	
	public function postbookpage()
	{	if($this->session->userdata('id')==null)
			redirect('/navigate/');
		$this->load->view('postbook');
	}
	public function deletebookpage()
	{	if($this->session->userdata('id')==null)
			redirect('/navigate/');
		$data['values'] = $this->connectdatabase->showbooktodel($this->uri->segment(3));
		$this->load->view('deletebook',$data);
	}


	public function interestedpeoplepage()
	{	
		if($this->session->userdata('id')==null)
			redirect('/navigate/');
		
		$data['values'] = $this->connectdatabase->showi($_POST['people']);
		$data['post_id']=$_POST['post_id'];
		$data['title']=$_POST['title'];
		$data['price']=$_POST['price'];
		
		$this->load->view('interestedpeople',$data);
	}
	
	public function deletebook()
	{
			if($this->session->userdata('id')==null)
			redirect('/navigate/');
		$this->connectdatabase->delete($this->uri->segment(3));
		redirect('navigate/dashboardpage');
	}
	public function dashboardpage()
	{
		if($this->session->userdata('id')==null)
			redirect('/navigate/');

		$data['rentnot']= $this->connectdatabase->showrenteditems($this->session->userdata('id'));
		$data['rentpaid']= $this->connectdatabase->showrenteditems($this->session->userdata('id'));
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
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('navigate/');
		
	}
	public function acceptrent()
	{
		if($this->session->userdata('id')==null)
			redirect('/navigate/');
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
					'image'		=> 'images/'.$data['file_name']
			);
	
			
			if($this->connectdatabase->insert($values)){
				
				 $this->load->view('login');
			}
			
			
		}
	}

		public function updateprofile(){
		if($this->session->userdata('id')==null)
			redirect('/navigate/');
		
		$config['upload_path'] = './images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['encrypt_name']=true;
		
		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload())
		{
			$values = array(
					'email' 	=> $_POST['email'],
					'password'	=> $_POST['password'],
					'name'		=> $_POST['name'],
					'number'	=> $_POST['number'],
					'address'	=> $_POST['address']
					
			);
		if($this->connectdatabase->updateprof($values)){
				
				 $this->dashboardpage();
			}
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
					'image'		=> 'images/'.$data['file_name']
			);
	
			
			if($this->connectdatabase->updateprof1($values)){
				
				 $this->dashboardpage();
			}
			
			
		}
			

		
	
		

	}
	public function verify_user(){
		
			$data['x']= $this->connectdatabase->getemail($_POST['email']);
			foreach($data['x']->result() as $row){
				$exist=$row->email;
				$ownname=$row->name;
				$pass=$row->password;
				$id=$row->id;
			}
			if(@$exist!=null){
				if(md5($_POST['password'])==$pass){
					
					$this->session->set_userdata(array('id'=>$id,'ownname'=>$ownname));
					
					redirect('/navigate/dashboardpage');
				
				}else{
					
					$d['error']="Invalid password!";
				$this->load->view('login',$d);
					
				}
			}else{
				$d['error']="Invalid username!";
				
				$this->load->view('login',$d);
			}
				
		
	}
	
	public function postbook()
	{
		if($this->session->userdata('id')==null)
			redirect('/navigate/');
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

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */