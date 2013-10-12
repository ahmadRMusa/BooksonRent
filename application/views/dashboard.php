<?php doctype('html5') ?>
<html>
<head>
	<title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <?php echo link_tag('css/bootstrap.css');
    	  echo link_tag('css/bootstrap.min.css');
          echo link_tag('css/dashboard.css');
       
	?><script  language="javascript" type="text/javascript" src="<?php echo base_url();?>js/jquery.js"></script>
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
            <li><a href="<?php echo base_url();?>index.php/navigate/forrentpage">For Rent</a></li>
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

         <div class="letter" id="accordion">
           <?php foreach($values->result() as $row)
            {
                echo '<div class="col-md-3"><img class="img-size" src="'.$row->image.'"></img></div>';
                echo '<div class="col-md-4 details">Personal Details:<br/> ';
                echo '<ul><li>Full Name: '.$row->name.'</li>';                    
                echo '<li>Email: '.$row->email.'</li>'; 
                echo '<li>Address: '.$row->address.'</li>';
                echo '<li>Contact Number: '.$row->number.'</li>'; 
                echo '</ul><hr></hr></div>';
                                      
               
            }?>
            <br/>
            <div class="col-md-8 rented form-signin">
              <a class="acordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> My rented books</a>
              <div id="collapseOne" class="panel-collapse collapse in">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
              </div>
            </div>
           
           <div class="col-md-8 forrent form-signin">
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"> My for rent books</a>
                <a class="pull-right" href="postbookpage">Post a book for rent</a>
              <div id="collapseTwo" class="panel-collapse collapse in">

               <?php foreach($value->result() as $row){
                 
                  echo '<div class="col-md-2"><img src="'.base_url().$row->image.'"  class="forrent-img" ></img></div>';
                  echo '<div class="col-md-4 forrent-sep" > <a href="'.base_url().'index.php/navigate/deletebookpage/'.$row->id.'"class="close" aria-hidden="true">&times;</a>Title: '.$row->title.'<br/>Author: '.$row->author.'<br/>Rent Price: '.$row->price;
                  if(strcmp($row->rentedby,"")){
                        if($row->num_i!=0){
                          //echo '<br/>People interested: <a href="'.base_url().'index.php/navigate/interestedpeoplepage/'.$row->interested.'/'.$row->id.'">'.$row->num_i."</a>"; 
                          echo '<br/>People interested:<button class="button'.$row->id.'">'.$row->id.'</button>';
                          
                          interestedAJAX($row->id,$row->interested);
                        }else
                          echo '<br/>People interested: '.$row->num_i;
                    }else
                        echo '<br/>Rented by: '.$row->renter.' on '.$row->rentdate;


                  echo '<br/>Posted on: '.$row->dateposted;
                  echo '</div>';
                  echo '<form name="m'.$row->id.'" action="'.base_url().'index.php/navigate/interestedpeoplepage" method="POST">
                                  <input type="hidden" value="'.$row->id.'" name="post_id" />
                                  <input type="hidden" value="'.$row->interested.'" name="people" />
                                </form>';
                        
            
               }?>

               <?php //$ci =& get_instance();
                 // echo $ci->session->userdata('id');
               ?>
              </div>
            </div>
          


        </div>
       

      </div>

    
 <!---AJAX FOR SEARCHING INTERESTED USbgt5ERS-->
<?php 
function interestedAJAX($id,$interested){
  echo "<script type='text/javascript'>$('.button".$id."').click(function() { $.ajax({url: '".base_url()."index.php/navigate/interestedpeoplepage',type: 'POST',data: { post_id:'".$id."', people:'".$interested."'},success: function (result) { document.m".$id.".submit();} }); });</script>";
}
?>
</script>



<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js"></script>

<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/respond.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/html5shiv.js"></script>

</body>
</html>