<?php doctype('html5') ?>
<html>
<head>
	<title>Book for Rent</title>
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
    <?php echo form_open_multipart('navigate/postbook','class="form-signin letter" id="form1" name="form1"');?>
        <fieldset>

            <h1 class="center">Post your book for rent</h1>
            <div id="error"></div>
            <div class="fileupload fileupload-new" data-provides="fileupload">
             <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>
                 <div>
                 <span class="btn btn-file"><span class="fileupload-new btn btn-large btn-primary btn-inverse">Select book image</span><span class="fileupload-exists">Change</span><input name="userfile" id="file1" type="file" /></span>
                 <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                     </div>
                </div>
            <div class="control-group">
                <label class="control-label">Title:</label>
                <div class="controls">
                    <input type="text" id="title" name="title" placeholder="Books on Rent: A guide">
                </div>

            </div>
            <div class="control-group">
                <label class="control-label">Author:</label>
                <div class="controls">
                    <input type="text" id="author" name="author" placeholder="Jondoe">
                    
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Rent Price:(in Pesos)</label>
                <div class="controls">
                    <input type="text" id="price" name="price" placeholder="Ex. 100">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Contact Number:</label>
                <div class="controls">
                    <input type="text" id="num"  name="cnum" placeholder="093245466422">
                </div>
            <div class="control-group">
                <label class="control-label">Book Condition:</label>
                <div class="controls">
                    <textarea id="conditions" name="condition" style="width:80%;"  placeholder="Ex. Slightly used, some parts torn,etc..."></textarea>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label"></label>
                <div class="controls center">
                    <a id="presubmit" class="btn btn-success btn-large"  onclick="acceptpost()">Submit</a>
                    <?php echo anchor('navigate/dashboardpage','Cancel','class="btn btn-large btn-primary btn-danger"');?>
                </div>
            </div>

        </fieldset>
    </form>
</div>

   

  

<script type="text/javascript">
            function acceptpost(){
              var title= document.getElementById("title").value;
              var f= document.getElementById("file1").value;

              var author= document.getElementById("author").value;
              var price= document.getElementById("price").value;
              var num= document.getElementById("num").value;
              var con= document.getElementById("conditions").value;
              document.getElementById("error").innerHTML ="";
              
              if(!f){
                    document.getElementById("error").innerHTML = "<div class=\"alert alert-danger\">Please select an image</div>";
              }else if(title.length>25 || title.length<1){
                 document.getElementById("error").innerHTML = "<div class=\"alert alert-danger\">Too long/short title!</div>";
              }else if(author.length>25 || author.length<1){
                document.getElementById("error").innerHTML = "<div class=\"alert alert-danger\">Too long/short author!</div>";
              }else if( !(/^[0-9]+$/.test(price))){
                document.getElementById("error").innerHTML = "<div class=\"alert alert-danger\">Invalid price format</div>";
              }else if(price>20000){
                document.getElementById("error").innerHTML = "<div class=\"alert alert-danger\">You have exceeded the maximum price of 20,000!</div>";
              }else if(price.length<1){
                document.getElementById("error").innerHTML = "<div class=\"alert alert-danger\">Invalid Price</div>";
              }else if(!(/^[0-9]+$/.test(num))){
                document.getElementById("error").innerHTML = "<div class=\"alert alert-danger\">Invalid cellphone number!</div>";
              }else if(num.length>12 || num.length<5){
                document.getElementById("error").innerHTML = "<div class=\"alert alert-danger\">Invalid cellphone number!</div>";
            }else if(con.length>25 || con.length<5){
                document.getElementById("error").innerHTML = "<div class=\"alert alert-danger\">The condition field has a limit of 25 characters and minimum of 5 characters</div>";
              } else{
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