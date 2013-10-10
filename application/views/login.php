<?php doctype('html5') ?>
<html>
<head>
	<title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <?php echo link_tag('css/bootstrap.css');
    	  echo link_tag('css/bootstrap.min.css');
        echo link_tag('css/login.css');
	?>
</head>
<body>
    <div class="container">
      
        <?php echo form_open('navigate/verify_user','class="letter form-signin"');?>
        <img src="<?php echo base_url();?>img/logo.png" class="img-circle small-size"/>
        <h2 class="form-signin-heading">Books on Rent</h2>
        <input type="text" class="input-block-level" name="email" placeholder="Email address"><br/>
        <input type="password" class="input-block-level" name="password" placeholder="Password"></br>
        <button class="btn btn-large btn-primary" name="submit" type="submit">Sign in</button>
         <?php echo anchor('navigate/registerpage','Register','class="btn btn-large btn-primary"');?>
      </form>

    </div>
    
     <div class="dot-bg anim-delay animated fadeIn">
                    <div class="content-rotator">
                        <div class="inbox">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec
                            aliquam vehicula est, sed fermentum nulla interdum
                            vehicula est, sed fermentum nulla interdum vel.
                        </div>
                        <div class="inbox">
                            Aliquam vehicula est, sed fermentum nulla interdum vel. Integer
                            Lorem ipsum dolor sit amet, consectetur adipiscing!
                        </div>
                        <div class="inbox">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec
                            Aliquam vehicula est, sed fermentum nulla
                            ullamcorper cursus tellus.
                        </div>
                    </div>
      </div>
    
</body>


<script src="<?php echo base_url();?>js/bootstrap.js"></script>
<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>js/jquery.js"></script>
 <script src="<?php echo base_url();?>js/main.js"></script>
</body>
</html>