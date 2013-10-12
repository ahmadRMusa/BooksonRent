<?php doctype('html5') ?>
<html>
<head>
  <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <?php echo link_tag('css/bootstrap.css');
        echo link_tag('css/bootstrap.min.css');
          echo link_tag('css/interested.css');
     
  ?>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top ">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Books on Rent</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo base_url();?>index.php/navigate/dashboardpage">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="#contact">For Rent</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <div class="form-group">
              <input type="text" placeholder="Search for a book" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Search</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
    <div class="center"><h1>Books for Rent</h1></div>

  <div class="dummy">
 <?php foreach($values->result() as $row){
                 
                  echo '<div class="col-md-2"><img src="'.$row->image.'"  class="forrent-img" ></img></div>';
                  echo '<div class="col-md-3 forrent-sep" > Name: '.$row->name.'<br/>Address: '.$row->address.'<br/>Contact number: '.$row->number.'<br/>Email: '.$row->email.'<br/><br/><br/>';
                  echo '<a href="'.base_url().'index.php/navigate/acceptrent/'.$row->id.'a'.$this->uri->segment(3).'" class="center btn btn-warning"> Accept as renter </a></div>';
                  //echo '<div class="col-md-11"></div> ';
            
               }?>
             </div>

    
     

<script  language="javascript" type="text/javascript" src="<?php echo base_url();?>js/jquery.js"></script>

<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js"></script>

<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/respond.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/html5shiv.js"></script>

</body>
</html>