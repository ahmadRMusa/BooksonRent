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
    <div class="header"><h1>People interested in <?php echo $title;?>:</h1></div>
    <hr></hr>
  <div class="container">
    <div class="row">
      <?php $x=$post_id;?>
 <?php foreach($values->result() as $row){
                 
                  echo '<div class="col-lg-4 colorize"><center><img src="'.base_url().$row->image.'"  class="forrent-img" ></img></center>';
                  echo '<br/><p> Name: '.$row->name.'<br/>Address: '.$row->address.'<br/>Contact number: '.$row->number.'<br/>Email: '.$row->email.'<br/>';
                  echo '<a  data-toggle="modal" href="#myModal'.$row->id.'" class="center btn btn-warning"> Accept as renter </a><br/></p></div>';
                  
                  //echo '<div class="col-md-11"></div> ';
                  acceptAJAX($row->id,$price);
                 addModal($row->id,$x,$row->name);
                
               }?>
             </div>
             </div>
           













 <!--ajax for net view-->   
 <?php 
 function addModal($id,$postnum,$rname){
echo '<!-- Modal -->
  <div class="modal fade" id="myModal'.$id.'"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-center">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Accepting '.$rname.' as renter...</h4>
        </div>
        <div class="modal-body">
        <div id="error'.$id.'"></div>
        <p></p>
        <form name="n'.$id.'" action="'.base_url().'index.php/navigate/acceptrent" method="POST">
                                  Initial payment: <input id="in'.$id.'" type="input" name="initialp" />
                                  <input type="hidden" value="'.$id.'" name="renter" />
                                   <input type="hidden" value="'.$rname.'" name="rentername" />
                                  <input type="hidden" value="'.$postnum.'" name="booknum" />
                                </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" onclick="acceptRenter'.$id.'()" class="btn btn-primary">Accept</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->';

 }
function acceptAJAX($id,$price){
  //echo "<script type='text/javascript'>$('.button".$id."').click(function() { $.ajax({url: '".base_url()."index.php/navigate/interestedpeoplepage',type: 'POST',data: { post_id:'".$id."'},success: function (result) { document.m".$id.".submit();} }); });</script>";
  echo '<script type="text/javascript">
            function acceptRenter'.$id.'(){
              var text= document.getElementById("in'.$id.'").value;
              if(text>'.$price.'){
                 document.getElementById("error'.$id.'").innerHTML = "<div class=\"alert alert-danger\">Payment exceeds rental amount!</div>";
              }else if( /^[0-9]+$/.test(text)){
                document.n'.$id.'.submit();
              }else{
                 document.getElementById("error'.$id.'").innerHTML = "<div class=\"alert alert-danger\">Invalid input! Please place a number below</div>";
              }
                
            }</script>';
}
?>    

<script  language="javascript" type="text/javascript" src="<?php echo base_url();?>js/jquery.js"></script>

<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/bootstrap.min.js"></script>

<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/respond.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/html5shiv.js"></script>

</body>
</html>