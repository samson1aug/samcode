# samcode
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<!DOCTYPE html >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<title>Insert title here</title>
<style type="text/css">
h4.a {
    font-family: "Bradley Hand ITC", Times, serif;
    font-size: large;
    font-weight: bolder;
}
h5.a {
    font-family: "Bradley Hand ITC", Times, serif;
    font-size: large;
    font-weight: bolder;
}
/* input[type="file"] {
    display: none;
} */
.custom-file-upload {
    border: 1px solid blue;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
}
</style>
<script type="text/javascript">
function printValue(sliderID, textbox) {
	 var x = document.getElementById(textbox);
	 var y = document.getElementById(sliderID);
	 x.value = y.value;
}

window.onload = function() { 
	printValue('rangeSlider', 'rangeValue');
}

function counter(msg){
    document.getElementById('counter_div').innerHTML = msg.value.length+'/5000';
}
</script>
<script type="text/javascript">
//Invoke HTML5 custom constraints validation to enforce MIME-type as defined in file inputs' `accept` attribute.
void function enhanceFileInputTypeValidityCheck(){
  var inputPrototype      = document.createElement( 'input' ).constructor.prototype;
  // Keep a local reference to out-of-the-box functionality we're about to enhance
  var nativeCheckValidity = inputPrototype.checkValidity;
  // I don't know why, but custom validation only appears to work 
  // if I bind to both these events - even neither triggers it...
  // http://stackoverflow.com/questions/21003342/how-do-i-invoke-custom-constraint-validation-as-part-of-the-native-validation-ev
  var events              = [ 'change', 'input' ];

  // Pre-validation check, to see if an input is eligible for file type validation.
  function shouldValidate( element ){
    return ( element instanceof HTMLInputElement && 
             element.type === 'file'             &&  
             element.accept                      && 
             element.files                       && 
             element.files.length
    );
  }

  // Our custom validation function
  function validateFileInputType( input ){
    // Convert MIME-type patterns as described in the `accept` attribute
    // into a valid expression to test actual MIME-type against
    var MIMEtype = new RegExp( input.accept.replace( '*', '[^\\/,]+' ) );

    // Ensure each of the input's files' types conform to the above
    return Array.prototype.every.call( input.files, function passesAcceptedFormat( file ){
      return MIMEtype.test( file.type );
    } );
  }
  
  // Perform `checkValidity` on each input
  function validateInputs(){
    Array.prototype.forEach.call( document.querySelectorAll( 'input, select' ), function callValidation( input ){
      input.checkValidity();
    } );
  }

  // Enhance native `checkValidity` behaviour
  inputPrototype.checkValidity = function enhancedCheckValidity(){
    if( shouldValidate( this ) ){
      if( !validateFileInputType( this ) ){
        // Replace the argument below with whatever you want
        this.setCustomValidity( 'Please only submit files of type ' + this.accept );
        
        return false;
      }
    }

    // Hand back to native functionality
    return nativeCheckValidity.apply( this );
  }

  // Bind it up!
  events.forEach( function bindValidation( event ){
    document.documentElement.addEventListener( event, validateInputs );
  } );
}();
</script>
</head>
<body style="background-color: #ADD8E6">
<div class="cotainer-fluid" style="margin: 10px; ">
<fieldset>
<div class="col-md-12" style="border: 1px solid black; background-color: #0087BD;color: white; ">
<h4 style="text-align: center;"> ZERP MAILBOX</h4>
</div>
</fieldset>
<div class="col-md-2" style="border: 1px solid black; background-color: #abe5fc; height:650px;" id="menu">
<h4 class="a">WELCOME</h4>
<h5 class="a">rini@zetamp.com</h5>
<h5><a >Compose New Mail</a></h5>
<h5><a >Inbox</a></h5>
<h5><a >Sent</a></h5>
</div>
<div class="col-md-3" style="border: 1px solid black; background-color:#ffc87c; height:650px;" id="mails">
<div class="col-md-12" style="margin: 5px;">
<button type="button" class="btn btn-primary btn-xs">Reply</button>
<button type="button" class="btn btn-primary btn-xs">Reply</button>
<button type="button" class="btn btn-primary btn-xs">Forward</button>
</div>
<b class="col-md-12">-------------------------------------------------------------------</b>
</div>
<div class="col-md-7" style="border: 1px solid black; background-color:  #caf7c0; height:650px;" id="view">

					<h5 align="center"><img alt="" src="imagefile\mail.png" height="80px" width="200px"></h5>
					<form class="" method="post" action="ida">
						
						<div class="form-group">
							<label for="name" class="cols-sm-2 control-label">To</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="name" id="name"  placeholder="Enter your Name"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Subject</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-building-o fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="dept" id="dept"  placeholder="Enter your Department"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="username" class="cols-sm-2 control-label">Message</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-comments-o fa-lg" aria-hidden="true"></i></span>
									<textarea rows="5" cols="113" class="form-control" name="desc" id="desc" maxlength="5000" onkeyup="counter(this);"></textarea>
									
								</div>
								<div id="counter_div" style="color: red;font-weight: bold;;">0/5000</div>
								</div>
					
							</div>
						</div>
						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">Attachments(If Any)</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<!-- <label for="file-upload" class="custom-file-upload">
   										 <i class="fa fa-cloud-upload"></i> Add Image
									</label> -->
									<input id="file-upload" type="file" accept="image/*" />  &nbsp;&nbsp;
									<!-- <label for="file-upload1" class="custom-file-upload">
   										 <i class="fa fa-cloud-upload"></i> Add Image
									</label> -->
									<input id="file-upload1" type="file" accept="image/*" /> &nbsp;&nbsp;
									<!-- <label for="file-upload2" class="custom-file-upload">
   										 <i class="fa fa-cloud-upload"></i> Add File
									</label> -->
									<input id="file-upload2" type="file"/> &nbsp;&nbsp;
									<!-- <label for="file-upload3" class="custom-file-upload">
   										 <i class="fa fa-cloud-upload"></i> Add File
									</label> -->
									<input id="file-upload3" type="file"/>
								</div>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" id="button1" class="btn btn-primary"><i class="fa fa-sign-in fa-lg" ></i>&nbsp;Submit</button>
							<button type="submit" id="button1" class="btn btn-primary"><i class="fa fa-close fa-lg" ></i>&nbsp;Cancel</button>
							</div>
						
					</form>
				

</div>
</body>
</html>
