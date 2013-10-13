<?php doctype('html5') ?>
<html>
<head>
	<title>Search...</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <?php echo link_tag('css/bootstrap.css');
    	  echo link_tag('css/bootstrap.min.css');
          echo link_tag('css/forrent.css');
       function check($z,$y){
          $i=explode("a",$z);
          $notpresent=true;
          
          for($inc = 0;$inc<count($i);$inc++){
              if($i[$inc] ==$y){
                $notpresent=false;
                break; 
              }
                
              
          }
          return $notpresent;
          
       }
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
            <li  class="active" ><a href="<?php echo base_url();?>index.php/navigate/dashboardpage">Home</a></li>
            
            <li><a href="<?php echo base_url();?>index.php/navigate/forrentpage">For Rent</a></li>
          </ul>
          <form class="navbar-form navbar-right" action="<?php echo base_url();?>index.php/navigate/searchpage" method="POST">
            <div class="form-group">
              <input type="text" placeholder="Search for a book" class="form-control" name="userquery"/>
            </div>
            <button class="btn btn-success">Search</button>
             <a href="<?php echo base_url();?>index.php/navigate/logout" class="btn btn-danger">Logout</a>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
    <div class="center" style="margin-top:50px;"><h1>Search Results</h1></div>

  <div class="dummy">
 <?php $isnull=true;
    foreach($values->result() as $row){
                 $isnull=false;
                  echo '<div class="col-md-2"><img src="'.base_url().$row->image.'"  class="forrent-img" ></div>';
                  echo '<div class="col-md-4 forrent-sep" > Title: '.$row->title.'<br/>Author: '.$row->author.'<br/>Owner\'s Name: '.$row->ownername.'<br/>Rent Price: '.$row->price.'<br/>Contact number: '.$row->cnum;
                    if(strcmp($row->rentedby,""))
                        echo '<br/>People interested: '.$row->num_i; 
                    else
                        echo '<br/>Rented by: '.$row->renter.' on '.$row->rentdate;

                  echo '<br/>Posted on: '.$row->dateposted;
                  echo '<br/>Book Condition: '.$row->condition;
                  if(check($row->interested ,$value))
                    echo '<a href="'.base_url().'index.php/navigate/iminterested/'.$row->id.'"class="btn btn-large btn-primary pull-right " >Im interested</a>';
                  else
                    echo '<span class="pull-right checkbox glyphicon glyphicon-check"> Im interested</span>';
                  echo '</div>';
                        
            
               }
               if($isnull){
                echo "<center>No results found...</center>";
             }?>
             </div>

    
     

<script  language="javascript" type="text/javascript" src="<?php echo base_url();?>js/jquery.js"></script>

<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js"></script>

<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/respond.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/html5shiv.js"></script>

</body>
</html>