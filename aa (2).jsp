<%@page import="java.sql.Connection"%>
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
   <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
   <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script> -->
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
.multiselect-container>li>a>label {
  padding: 4px 20px 3px 20px;
}
.button {
  border-radius: 4px;
  background-color: #f4511e;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 14px;
  padding: 5px 7px;
  width: 200px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
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
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script>
<script type="text/javascript">
function  showcompose() {
	document.getElementById('viewmail').style.display="none";
	document.getElementById('compose').style.display="Block";
}
function  showinbox() {
	document.getElementById('sent').style.display="none";
	document.getElementById('inbox').style.display="block";
	
}
function showsent() {
	document.getElementById('inbox').style.display="none";
	document.getElementById('sent').style.display="block";
	
}
</script>
<script type="text/javascript">
$(document).ready(function(){
    $("#sentlink").click(function(){
     document.getElementById('compose').style.display = "none";
  	   document.getElementById('viewmail').style.display = "block"; 
        var value = $(this).val();
        alert(value);
        $.get("viewmail.jsp",{q:value},function(data){
         $("#viewmail").html(data);
        });
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    $("#inboxlink").click(function(){
     document.getElementById('compose').style.display = "none";
  	   document.getElementById('viewmail').style.display = "block"; 
        var value = $(this).val();
        alert(value);
        $.get("viewmail.jsp",{q:value},function(data){
         $("#viewmail").html(data);
        });
    });
});
</script>
</head>
<%@page import="java.sql.*,zetAmp_App.Registration"%>
<%@page import="java.util.*,java.util.Date,java.text.*,java.math.BigDecimal"%>
<%
String uid=request.getParameter("id");
Connection con=null;
Statement stmt1=null;
ResultSet rs1=null;
con=Registration.getConnect();
String email="";
String qry1="select email from zetampdb.employee where eid='"+uid+"'";
stmt1=con.createStatement();
rs1=stmt1.executeQuery(qry1);
 if(rs1.next())
 {
	email=rs1.getString(1); 
 }
%>
<body style="background-color: #ADD8E6">
<div class="cotainer-fluid" style="margin: 10px; ">
<fieldset>
<div class="col-md-12" style="border: 1px solid black; background-color: #0087BD;color: white; ">
<h4 style="text-align: center;"> ZERP MAILBOX</h4>
</div>
</fieldset>
<div class="col-md-2" style="border: 1px solid black; background-color: #abe5fc; height:650px;" id="menu">
<h4 class="a"><img src="profpicrtn.jsp?id=<%=uid%>" height="40px" width="40px" style="border-radius: 15px;"></h4>
<h5 class="a"><%=email %></h5>
<button type="button" class="button" onclick="showcompose()"><span>Compose New Mail</span></button>
<button type="button" class="button" onclick="showinbox()"><span>InBox</span></button>
<button type="button"  class="button" onclick="showsent()"><span>Sent</span></button>
</div>
<div class="col-md-3" style="border: 1px solid black; background-color:#ffc87c; height:650px;" id="mails">
<div class="col-md-12" style="margin: 5px;">
<button type="button" class="btn btn-primary btn-xs">Reply</button>
<button type="button" class="btn btn-primary btn-xs">ReplyAll</button>
<button type="button" class="btn btn-primary btn-xs">Forward</button>
</div>
<b class="col-md-12">------------------------------------------------------------------</b>
<div  class="col-md-12" id="inbox" style="display: none;overflow: auto; border-radius:10px;">

<%
String qry2="select * from zetampdb.mailbox_tab where receiver LIKE '%"+email+"%' OR cc LIKE '%"+email+"%' OR bcc LIKE '%"+email+"%'";
PreparedStatement pstmt=null;
ResultSet rs3=null;
pstmt=con.prepareStatement(qry2);
/* 
pstmt.setString(1,"'%"+email+"%'"); */
rs3=pstmt.executeQuery();
while(rs3.next()){%>

<button type="button" id="inboxlink" value="<%=rs3.getString(1)%>">
	<div>
	<p class="col-md-4" style="text-align: left; font-style: italic;font-weight: bold;"><%=rs3.getString(2)%> </p>
	<p class="col-md-8" style="text-align: right; font-style: italic;"><%=rs3.getString(12)%> </p>
	<p class="col-md-4"><%=rs3.getString(6)%><p>
	</div></button>
<%}
%>
</div>

<div class="col-md-12" id="sent" style="overflow: auto; display: block; border-radius:10px;">

<%
String qry3="select * from zetampdb.mailbox_tab where sender='"+uid+"'";
PreparedStatement pstmt1=null;
ResultSet rs4=null;
pstmt=con.prepareStatement(qry3);
rs4=pstmt.executeQuery();
while(rs4.next()){

%>
<button type="button" id="sentlink" value="<%=rs4.getString(1)%>">
	<div>
	<p class="col-md-4" style="text-align: left; font-style: italic;font-weight: bold;"><%=rs4.getString(2)%> </p>
	<p class="col-md-8" style="text-align: right; font-style: italic;"><%=rs4.getString(12)%> </p>
	<p class="col-md-4"><%=rs4.getString(6)%><p>
	</div></button>

<%}

%>

</div>
</div>
<div class="col-md-7" style="border: 1px solid black; background-color:  #caf7c0; height:650px;" id="compose">
<%
Statement stmt=null;
ResultSet rs=null;
String qry="select eid,email from zetampdb.employee where status='Working'";
stmt=con.createStatement();
rs=stmt.executeQuery(qry);
%>
<h5 align="center"><img alt="" src="imagefile\mail.png" height="80px" width="200px"></h5>
					<form  method="post" action=""  enctype="multipart/form-data" id="frm" name="frm">
						<div class="form-group">
							<div class="cols-sm-10">
							<label for="name" class="cols-sm-2 control-label">To</label>
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<select class="js-example-basic-multiple form-control" name="to" id="to"  multiple="multiple" required="required">
									<%while(rs.next()){ %>
									<option value="<%=rs.getString(2) %>"><%=rs.getString(2) %></option>
									<%} rs.beforeFirst(); %>
									</select>
								</div>
							</div>
							<label for="name" class="cols-sm-2 control-label">CC</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<select class="js-example-basic-multiple form-control" name="cc" id="cc" multiple="multiple">
									<%while(rs.next()){ %>
									<option value="<%=rs.getString(2) %>"><%=rs.getString(2) %></option>
									<%} rs.beforeFirst(); %>
									</select>
								</div>
							</div>
							<label for="name" class="cols-sm-2 control-label">BCC</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<select class="js-example-basic-multiple form-control" name="bcc" id="bcc" multiple="multiple">
									<%while(rs.next()){ %>
									<option value="<%=rs.getString(2) %>"><%=rs.getString(2) %></option>
									<%} %>
									</select>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="cols-sm-2 control-label">Subject</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-building-o fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control" name="sub" id="sub"  placeholder="Subject" required="required"/>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label for="username" class="cols-sm-2 control-label">Message</label>
							<div class="cols-sm-10">
								<div class="input-group">
									<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-comments-o fa-lg" aria-hidden="true"></i></span>
									<textarea rows="5" cols="113" class="form-control" name="msg" id="msg" maxlength="5000" onkeyup="counter(this);" required="required"></textarea>
									
								</div>
								<div id="counter_div" style="color: red;font-weight: bold;;">0/5000</div>
								</div>
					
							</div>
						</div>
						<div class="form-group">
							<label for="confirm" class="cols-sm-2 control-label">Attachments(If Any)</label>
							<div class="cols-sm-10">
								<div class="input-group">
									
									<input id="file-upload" name="f1" type="file" class="col-md-3"/>  
									<input id="file-upload1" name="f2" type="file" class="col-md-3" /> 
								
									<input id="file-upload2" name="f3" type="file" class="col-md-3"/> 
									<input id="file-upload3" name="f4" type="file" class="col-md-3"/>
								</div>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" id="button1" class="btn btn-primary" formaction="mailsenddb.jsp?id=<%=uid%>"><i class="fa fa-sign-in fa-lg" ></i>&nbsp;Submit</button>
							<button type="button" id="button2" class="btn btn-primary" onclick="frm.reset();"><i class="fa fa-close fa-lg" ></i>&nbsp;Cancel</button>
							</div>
						
					</form>
</div>
<div id="viewmail" class="col-md-7" style="border: 1px solid black; background-color:  #caf7c0; height:650px; display: none;" id="compose"></div>

</div>
</body>
</html>