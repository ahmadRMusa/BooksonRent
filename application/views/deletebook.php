<?php doctype('html5') ?>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <?php echo link_tag('css/bootstrap.css');
          echo link_tag('css/bootstrap.min.css');
        echo link_tag('css/deletebook.css');
    ?>
</head>
<body>
    <div class="container">
        <h1>Are you sure you want to delete this post?</h1>
        <?php echo form_open('navigate/deletebook','class="letter form-signin"');
            foreach($values->result() as $row){
           echo '<img src="'.$row->image.'" class="small-size"/>';
           echo '<h2 class="form-signin-heading">'.$row->title.'</h2>';
           echo 'Author: '.$row->author.'<br/>';
           echo 'Date Posted: '.$row->dateposted.'<br/>';
           echo 'Rent Price: '.$row->price.'<br/><br/>';
               
           echo anchor('navigate/deletebook/'.$row->id,'Delete','class="btn btn-large btn-danger"')."&emsp;";
           echo anchor('navigate/dashboardpage','Cancel','class="btn btn-large btn-primary"');
           echo '</form>';
          }
      ?>
    </div>
    
</body>


<script src="<?php echo base_url();?>js/bootstrap.js"></script>
<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>js/jquery.js"></script>
 <script src="<?php echo base_url();?>js/main.js"></script>
</body>
</html>