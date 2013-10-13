<?php

class connectdatabase extends CI_Model
{
	public function insert($values)
	{
	
		$data = array(
				'id' 		=> 0,
				'image'		=>$values['image'],
				'name' 	=> $values['name'],
				'email'		=> $values['email'],
				'password'		=> md5($values['password']),
				'number'=>$values['number'],
				'address'	=> $values['address']
							);

		return $this->db->insert('accounts',$data);
	}
	public function postbook($values)
	{
	
		$data = array(
				'id' 		=> 0,
				'image'		=>$values['image'],
				'title' 	=> $values['title'],
				'author'		=> $values['author'],
				'price'		=> $values['price'],
				'cnum'		=>$values['cnum'],
				'condition'	=> $values['condition'],
				'dateposted'=> date('y-m-j'),
				'owner'		=> $this->session->userdata('id')
							);

		return $this->db->insert('books',$data);
	}

	public function showall()
	{
		$this->db->where('owner !=', $this->session->userdata('id'));
		return $this->db->get('books');
	}
	public function iminterested($values)
	{
		$data = array(
				'interested'=>$values['interested'],
				'num_i' => $values['num_i']
							);
		$this->db->where('id',$values['id']);
		
		return $this->db->update('books',$data);
		
	}
	public function acceptrenter($values)
	{
			$data = array(
				
				'rentedby'		=>$values['rentedby'],
				'payment'		=>$values['payment'],
				'renter'		=>$values['renter'],
				'rentdate'		=>date('y-m-j')
							);
		$this->db->where('id',$values['id']);
		
		return $this->db->update('books',$data);
		
	}
	public function show($id)
	{
		$this->db->where('id',$id);

		return $this->db->get('accounts');
	}
	public function showi($id)
	{	$n=explode("a",$id);
		$this->db->where('id',$n[0]);
		for($b=1;$b<count($n);$b++){
			$this->db->or_where('id', $n[$b]);
		} 
		return $this->db->get('accounts');
	}
	public function showown($id)
	{
		$this->db->where('owner',$id);
		return $this->db->get('books');
	}
	public function showownrent($id)
	{
		$this->db->like('interested',','.$id.',');
		$this->db->or_like('interested',','.$id);
		$this->db->or_like('owner',$id);
		return $this->db->get('books');
	}
	public function showinterested($id)
	{
		$this->db->like('interested',','.$id.',');
		$this->db->or_like('interested',','.$id);
		$this->db->or_like('owner',$id);
		return $this->db->get('books');
	}

	public function showbook($id)
	{
		$this->db->where('id',$id);
		return $this->db->get('books');
	}
	public function getemail($id)
	{
		$this->db->where('email',$id);
		return $this->db->get('accounts');
	}


	public function update($values)
	{
		$bday=date($values['year']."-".$values['month']."-".$values['date']);
		$data = array(
				'id' 		=> $values['id'],
				'username' 	=> $values['username'],
				'password' 	=> md5($values['password']),
				'type'		=> $values['type'],
				'firstname' => $values['firstname'],
				'lastname'  => $values['lastname'],
				'middlename'=> $values['middlename'],
				'birthdate' => $bday,
				'gender'	=> $values['gender'],
				'civilstatus'=>$values['civilstatus'],
				'email'		=> $values['email'],
				'contactnumber'=>$values['contactnumber'],
				'aboutme'	=> $values['aboutme']
							);

		$this->db->where('id',$values['id']);
		$this->db->update('accounts',$data);
	}

	public function delete($id)
	{
		$this->db->where('id',$id);
		$this->db->where('owner',$this->session->userdata('id'));
		$this->db->delete('books');
	}

}



?>