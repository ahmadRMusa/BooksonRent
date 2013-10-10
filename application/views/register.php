<?php doctype('html5') ?>
<html>
<head>
	<title>Login</title>
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
    <?php echo form_open_multipart('navigate/register','class="form-signin letter"');?>
        <fieldset>
            <h1 class="center">Registration Form</h1>
             <div class="fileupload fileupload-new" data-provides="fileupload">
  <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>
  <div>
    <span class="btn btn-file"><span class="fileupload-new btn btn-large btn-primary btn-inverse">Select image</span><span class="fileupload-exists">Change</span><input name="userfile" id="file1" type="file" /></span>
    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
  </div>
</div>
        
            <div class="control-group">
                <label class="control-label">Email:</label>
                <div class="controls">
                    <input type="text" id="username" name="email" placeholder="jondoe@booksonrent.com">
                </div>

            </div>
            <div class="control-group">
                <label class="control-label">Password:</label>
                <div class="controls">
                    <input type="password" id="password" name="password" placeholder="1234Abcd">
                    <input type="password" id="password" name="password1" placeholder="Confirm Password">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Full Name</label>
                <div class="controls">
                    <input type="text" id="email" name="name" placeholder="Jondoe K. Luther">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Contact Number:</label>
                <div class="controls">
                    <input type="text" id="password" name="number" placeholder="093245466422">
                </div>
            <div class="control-group">
                <label class="control-label">Address:</label>
                <div class="controls">
                    <input type="text" id="password" name="address" placeholder="Cebu,City Philippines">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"></label>
                <div class="controls center">
                    <button type="submit" class="btn btn-success btn-large" name="submit">Submit</button>
                    <?php echo anchor('navigate/','Cancel','class="btn btn-large btn-primary btn-danger"');?>
                </div>
            </div>

        </fieldset>
    </form>
</div>

    
</body>



<script src="<?php echo base_url();?>js/jquery.js"></script>
 <script src="<?php echo base_url();?>js/main.js"></script>
 <script src="<?php echo base_url();?>js/jasny-bootstrap.js"></script>
 <script src="<?php echo base_url();?>js/jasny-bootstrap.min.js"></script>
 
</body>
</html>