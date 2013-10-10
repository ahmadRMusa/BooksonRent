<?php doctype('html5') ?>
<html>
<head>
	<title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <?php echo link_tag('css/bootstrap.css');
    	  echo link_tag('css/bootstrap.min.css');
          echo link_tag('css/dashboard.css');
       
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
            <li class="active"><a href="#">Home</a></li>
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


      <div class="center">
         <div class="form-signin letter">
           
                <div class="img-size"><p>testing my pa</p></div>
                 <div class="details">&emsp;Personal Details:<br/> 
                                      &emsp;Name: Jondoe K. Lance<br/> 
                                      &emsp;Email: jkl@booksonrent.com<br/> 
                                      &emsp;Address: Bacayan, Cebu<br/>
                                      &emsp;Contact Number: 00239012<br/>  

                                      <hr></hr>
                </div>
      
        

        </div>


      </div>

    
     

<script  language="javascript" type="text/javascript" src="<?php echo base_url();?>js/jquery.js"></script>

<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js"></script>

<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/respond.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/html5shiv.js"></script>

</body>
</html>