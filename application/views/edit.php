<?php doctype('html5') ?>
<html>
<head>
	<title>Edit Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <?php echo link_tag('css/bootstrap.css');
    	  echo link_tag('css/bootstrap.min.css');
          echo link_tag('css/jasny-bootstrap.css');
          echo link_tag('css/jasny-bootstrap.min.css');
        echo link_tag('css/register.css');
	?>
</head>
<body>
  <div class="container">
    <?php echo form_open_multipart('navigate/updateprofile','class="form-signin letter" name="form1" id="form1"');?>
    
        <fieldset>
            <h1 class="center">Edit your Data</h1>
            <div id="error"></div>
             <div class="fileupload fileupload-new" data-provides="fileupload">
  <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>
  <div>
    <span class="btn btn-file"><span class="fileupload-new btn btn-large btn-primary btn-inverse">Select image</span><span class="fileupload-exists">Change</span><input name="userfile" id="file1" type="file" /></span>
    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
  </div>
</div>
        <?php foreach($values->result() as $row){
         echo   '<div class="control-group">
                <label class="control-label">Email:</label>
                <div class="controls">
                    <input type="text" id="email" name="email" value="'.$row->email.'">
                </div>

            </div>
            <div class="control-group">
                <label class="control-label">Password:</label>
                <div class="controls">
                    <input type="password" id="pass" name="password" placeholder="1234Abcd">
                    <input type="password" id="pass1" name="password1" placeholder="Confirm Password">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Full Name</label>
                <div class="controls">
                    <input type="text" id="name" name="name" placeholder="Jondoe K. Luther" value="'.$row->name.'">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Contact Number:</label>
                <div class="controls">
                    <input type="text" id="num" name="number" placeholder="093245466422" value="'.$row->number.'">
                </div>
            <div class="control-group">
                <label class="control-label">Address:</label>
                <div class="controls">
                    <input type="text" id="adds" name="address" placeholder="Cebu,City Philippines" value="'.$row->address.'">
                </div>
            </div>
            <div class="control-group">';}?>
                <label class="control-label"></label>
                <div class="controls center">
                    <a class="btn btn-success btn-large" onclick="acceptpost1()">Submit</a>
                    <?php echo anchor('navigate/dashboardpage','Cancel','class="btn btn-large btn-primary btn-danger"');?>
                </div>
            </div>
           
        </fieldset>
    </form>
</div>

    
<script type="text/javascript">
            function acceptpost1(){

              var email= document.getElementById("email").value;
              var f= document.getElementById("file1").value;

              var p= document.getElementById("pass").value;
              var p1= document.getElementById("pass1").value;
              var fname= document.getElementById("name").value;
              var num= document.getElementById("num").value;
              var add= document.getElementById("adds").value;
              document.getElementById("error").innerHTML ="";
              if(p.length<1){
                document.getElementById("error").innerHTML = "<div class=\"alert alert-danger\">Please input a new password</div>";
              }else if(p!=p1){
                 document.getElementById("error").innerHTML = "<div class=\"alert alert-danger\">Password doesnt match</div>";
              }else if(email.length<1){
                document.getElementById("error").innerHTML = "<div class=\"alert alert-danger\">Email required</div>";
              }else if(fname.length<1){
                document.getElementById("error").innerHTML = "<div class=\"alert alert-danger\">Name required</div>";
              }else if(add.length<1){
                document.getElementById("error").innerHTML = "<div class=\"alert alert-danger\">Address required</div>";
              }else if(!(/^[0-9]+$/.test(num))){
                document.getElementById("error").innerHTML = "<div class=\"alert alert-danger\">Invalid cellphone number!</div>";
              }else if(num.length>12 || num.length<5){
                document.getElementById("error").innerHTML = "<div class=\"alert alert-danger\">Invalid cellphone number!</div>";
            }else{
                  document.form1.submit();
              }
                
            }

</script>



<script src="<?php echo base_url();?>js/jquery.js"></script>
 <script src="<?php echo base_url();?>js/main.js"></script>
 <script src="<?php echo base_url();?>js/jasny-bootstrap.js"></script>
 <script src="<?php echo base_url();?>js/jasny-bootstrap.min.js"></script>
 
</body>
</html>