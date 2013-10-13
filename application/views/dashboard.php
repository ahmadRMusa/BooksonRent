<?php doctype('html5') ?>
<html>
<head>
	<title>Dashboard</title>
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


      <div class="center">

         <div class="letter" id="accordion">
           <?php foreach($values->result() as $row)
            {
                echo '<div class="col-md-3"><img class="img-size" src="'.base_url().$row->image.'"></img></div>';
                echo '<div class="col-md-4 details">Personal Details:<a href="'.base_url().'index.php/navigate/editpage" class="link">[edit]</a><br/> ';
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
                  <ul id="myTab1" class="nav nav-tabs">
                      <li class=""><a href="#paid" data-toggle="tab">Fully Paid</a></li>
                      <li class="active"><a href="#unpaid" data-toggle="tab">On Going</a></li>
                 </ul>
                   <div id="myTabContent1" class="tab-content">
        <div class="tab-pane fade" id="paid">
          <?php foreach($rentpaid->result() as $row){
                 if($row->payment==$row->price){
                       
                   echo '<div>';
                    echo '<div class="col-md-2"><img src="'.base_url().$row->image.'"  class="forrent-img" ></img></div>';
                    echo '<div class="col-md-4 forrent-sep" >Title: '.$row->title.'<br/>Author: '.$row->author.'<br/>Rent Price: '.$row->price;
                    echo '<br/>Payments: '.$row->payment;  
                    echo '<br/>Owner: '.$row->ownername;   
                    echo '<br/>Contact number: '.$row->cnum;
                    echo '<br/>Progress: '.calculate($row->payment,$row->price).'%';
                        echo '<div class="progress">
                              <div class="progress-bar" role="progressbar" aria-valuenow="'.calculate($row->payment,$row->price).'" aria-valuemin="0" aria-valuemax="100" style="width: '.calculate($row->payment,$row->price).'%;">
                             
                              </div>
                              </div>';
                     
                         echo '</div>';
                         
                   
                         echo '</div>';
                     }   
            
               }?>
        </div>
        <div class="tab-pane fade active in" id="unpaid">
            <?php  foreach($rentnot->result() as $row){

              if($row->price!=$row->payment) {
                    echo '<div>';
                    echo '<div class="col-md-2"><img src="'.base_url().$row->image.'"  class="forrent-img" ></img></div>';
                    echo '<div class="col-md-4 forrent-sep" >Title: '.$row->title.'<br/>Author: '.$row->author.'<br/>Rent Price: '.$row->price;
                    echo '<br/>Payments: '.$row->payment; 
                    echo '<br/>Owner: '.$row->ownername;     
                    echo '<br/>Contact number: '.$row->cnum;
                    echo '<br/>Progress: '.calculate($row->payment,$row->price).'%';
                        echo '<div class="progress">
                              <div class="progress-bar" role="progressbar" aria-valuenow="'.calculate($row->payment,$row->price).'" aria-valuemin="0" aria-valuemax="100" style="width: '.calculate($row->payment,$row->price).'%;">
                             
                              </div>
                              </div>';
                     
                         echo '</div>';
                         
                   
                         echo '</div>';
                         
                    }

                                   
                              
                        
            
               }?>
        </div>
      </div>




              </div>
            </div>
           
           <div class="col-md-8 forrent form-signin">
              <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"> My for rent books</a>
                <a class="pull-right" href="postbookpage">Post a book for rent</a>
              <div id="collapseTwo" class="panel-collapse collapse in">
                 <ul id="myTab" class="nav nav-tabs">
                      <li class=""><a href="#pending" data-toggle="tab">Pending</a></li>
                      <li class="active"><a href="#ongoing" data-toggle="tab">On Rent</a></li>
                 </ul>


       
     
      <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade" id="pending">
          <?php foreach($value->result() as $row){
                 if($row->rentedby==0){
                       
                           echo '<div class="col-md-2"><img src="'.base_url().$row->image.'"  class="forrent-img" ></img></div>';
                           echo '<div class="col-md-4 forrent-sep" > <a href="'.base_url().'index.php/navigate/deletebookpage/'.$row->id.'"class="close" aria-hidden="true">&times;</a>Title: '.$row->title.'<br/>Author: '.$row->author.'<br/>Rent Price: '.$row->price;
                  
                        if($row->num_i!=0){
                          //echo '<br/>People interested: <a href="'.base_url().'index.php/navigate/interestedpeoplepage/'.$row->interested.'/'.$row->id.'">'.$row->num_i."</a>"; 
                          echo '<br/>People interested:<button class="button'.$row->id.'">'.$row->num_i.'</button>';
                          
                          interestedAJAX($row->id,$row->interested);
                        }else
                          echo '<br/>People interested: '.$row->num_i;
                        echo '<br/>Posted on: '.$row->dateposted;
                        echo '</div>';
                        
                  }

                         echo '<form name="m'.$row->id.'" action="'.base_url().'index.php/navigate/interestedpeoplepage" method="POST">
                                  <input type="hidden" value="'.$row->id.'" name="post_id" />
                                  <input type="hidden" value="'.$row->interested.'" name="people" />
                                  <input type="hidden" value="'.$row->price.'" name="price" />
                                  <input type="hidden" value="'.$row->title.'" name="title" />
                                </form>';
                        
            
               }?>
        </div>
        <div class="tab-pane fade active in" id="ongoing">
            <?php  foreach($value1->result() as $row){

              if($row->rentedby!=0) {
                    echo '<div id="uBlock'.$row->id.'">';
                    echo '<div class="col-md-2"><img src="'.base_url().$row->image.'"  class="forrent-img" ></img></div>';
                    echo '<div class="col-md-4 forrent-sep" > <a href="'.base_url().'index.php/navigate/deletebookpage/'.$row->id.'"class="close" aria-hidden="true">&times;</a>Title: '.$row->title.'<br/>Author: '.$row->author.'<br/>Rent Price: '.$row->price;
                    echo '<br/>Payments: '.$row->payment;    
                    echo '<br/>Rented by: <a data-toggle="modal" href="#myModal'.$row->id.'" id="d'.$row->id.'">'.$row->renter.'</a>';
                    echo '<br/>Progress: '.calculate($row->payment,$row->price).'%';
                        echo '<div class="progress">
                              <div class="progress-bar" role="progressbar" aria-valuenow="'.calculate($row->payment,$row->price).'" aria-valuemin="0" aria-valuemax="100" style="width: '.calculate($row->payment,$row->price).'%;">
                             
                              </div>
                              </div>';
                      echo '<center><a data-toggle="modal" href="#updateModal'.$row->id.'" id="update'.$row->id.'" class="btn btn-warning" style="margin-bottom:10px;margin-top:0px;">Update</a></center>';
                         echo '</div>';
                         
                   
                         echo '</div>';
                         updatePayment($row->id,$row->payment,$row->price);
                     addUpdateModal($row->id,$row->payment,$row->title);
                    addModal($row->id);
                    seeDetails($row->rentedby,$row->id);
                    
                    }

                                   
                              
                        
            
               }?>
        </div>

      </div>
    
               <?php //$ci =& get_instance();
                 // echo $ci->session->userdata('id');
               ?>
              </div>
            </div>
          


        </div>
       

      </div>

    
 <!---AJAX FOR SEARCHING INTERESTED USbgt5ERS-->
<?php 
function addModal($id){
echo '<!-- Modal -->
  <div class="modal fade" id="myModal'.$id.'"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-center">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Renter Account Details</h4>
        </div>
        <div class="modal-body ">
        <div id="xm'.$id.'"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->';

 }
function addUpdateModal($id,$p,$t){
echo '<!-- Modal -->
  <div class="modal fade" id="updateModal'.$id.'"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-center">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Update payments:'.$t.'</h4>
        </div>
        <div class="modal-body ">
        <div id="invalidi'.$id.'"></div>
        Input amount: <input id="updatep'.$id.'"></input>
        </div>
        <div class="modal-footer">
          
          <button id="readyUpdate'.$id.'" type="button" class="btn btn-primary" >Update</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->';

 }
function calculate($now,$total){
  $zz=$now/$total;
  $zz=$zz*100;
  return number_format($zz, 2, '.', '');
}
function interestedAJAX($id,$interested){
  echo "<script type='text/javascript'>$('.button".$id."').click(function() { $.ajax({url: '".base_url()."index.php/navigate/interestedpeoplepage',type: 'POST',data: { post_id:'".$id."', people:'".$interested."' },success: function (result) { document.m".$id.".submit();} }); });</script>";
}
function seeDetails($id,$rowid){
  echo '<script type="text/javascript">
         $(document).ready(function() {

            $("#d'.$rowid.'").click(function() {                
              $.ajax({
                   url: \''.base_url().'index.php/navigate/display\',
                   type: \'POST\',
                   data: {p:\''.$id.'\'},
                   success: function(response){
                     $("#xm'.$rowid.'").html(response); 
                        
                   }
              });
          
          
          });
        });
      </script>';
}
function updatePayment($id,$amt,$price){
  echo '<script type="text/javascript">
         $(document).ready(function() {

            $("#readyUpdate'.$id.'").click(function() {                
              var text= document.getElementById("updatep'.$id.'").value;
              if(text>'.$price.'){
                document.getElementById("invalidi'.$id.'").innerHTML = "<div class=\"alert alert-danger\">The payment exceeds the rental price!</div>";
              }else if( /^[0-9]+$/.test(text)){
                $.ajax({
                   url: \''.base_url().'index.php/navigate/updateP\',
                   type: \'POST\',
                   data: {post:\''.$id.'\' , amt:\''.$amt.'\' ,payment:text},
                   success: function(response){
                    document.getElementById("uBlock'.$id.'").innerHTML ="";
                     $("#uBlock'.$id.'").html(response); 
                        $(\'#updateModal'.$id.'\').modal(\'hide\');
                      document.getElementById("updatep'.$id.'").value ="";
                      document.getElementById("invalidi'.$id.'").innerHTML="";
                     
                   }
              });}else{
                 document.getElementById("invalidi'.$id.'").innerHTML = "<div class=\"alert alert-danger\">Invalid input! Please place a number below</div>";
                 
              }
              
          
          
          });
        });
      </script>';
}
?>

<!-- 
 echo '<script type="text/javascript">
          $(document).ready(function() {

            $("#d'.$id.'").click(function() {                
              $.ajax({
                   url: \''.base_url().'index.php/navigate/display\',
                   type: \'POST\',
                   data: {p:\''.$id.'\'},
                   success: function(response){
                     $("#r'.$id.'").html(response); 
                        
                   }
              });
          
          
          });
        });
      </script>';
 -->
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js"></script>

<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/respond.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/html5shiv.js"></script>

</body>
</html>