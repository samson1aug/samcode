<?php
   //change 'valid_username' and 'valid_password' to your desired "correct" username and password
   session_start(); 
   if (!$_SESSION['LDAP']['login'])
   {
       $_SESSION['logged_in'] = true;
       header('Location: login.php');
   }
   
   else{
   	$cpname=$_SESSION['user'];
   //	echo $cpname;
   include 'db/config.php';
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Automation Status</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   		
</head>
<body>
  
<div class="container-fluid">
<center><h2>Automation Status</h2></center>
	<div class="row">
   	 <div id='div4' class='col-lg-4'>
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Calculate Test Count</h3></div>
            <div class="panel-body">
	  			 <form id='tab23_form' method='POST'>
               		<div class="form-group col-sm-6">
                    	<label for="date1">Start Date</label>
                    	<input type='text' class="form-control" placeholder='Start Date' name='date1' id='date1'/>
                	</div>
                	<div class="form-group col-sm-6">
                    	<label for="date2">End Date</label>
                    	<input type='text' class="form-control" placeholder='End Date' name='date2'id='date2'/>
                	</div> 
                	<div class="form-group col-sm-6">
                    	<label for="date2">Version</label>
      
                    	 <select class="form-control" name='version_n' id='version_n'>
                    	 <option value="ANY">NOT SELECTED</option>
						  <option value="ALL">ALL</option>
						  <option value="9.0">9.0</option>
						  <option value="9.5">9.5</option>
						  <option value="9.6">9.6</option>
						  <option value="9.7">9.7</option>
						  <option value="9.8">9.8</option>
						  <option value="9.9">9.9</option>
						  <option value="9.10">9.10</option>
						  <option value="9.12">9.12</option>
						  <option value="9.12">10.0</option>						  						  						 
					</select>
                	</div>    
               		<div class="form-group col-sm-6 ">
               			<br/><br/>
                    	<input type='radio'  name='TC_type_n' value="Automation" checked/>&nbsp;Automation&nbsp; 
                    	<input type='radio'  name='TC_type_n' value="Stabilization"/>&nbsp;Stabilization
                
                	</div>   
                	      
					<div class="col-sm-12" >
						 <button class="btn  btn-info btn-sm"  type="button" onclick="tc(this)"><span class="glyphicon glyphicon-search" aria-hidden="true" ></span>&nbsp;Get Test Count</button>
					</div>
					<div class="col-sm-12">		
                			<h5><span id="results" style="color: green"></span></h5>
					</div>
                <div class="form-group col-sm-12" id='result'>
                   <label id="result"></label>
               
                </div> 
            	</form>
            </div>    
        </div>    
      </div>
    <div class='col-lg-8'>
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Enter New Details</h3></div>
            <div class="panel-body">
            <form id='Automation_form' method='POST'>	 
            	<input type="hidden" value="<?php echo $cpname?>" name="cpname" id='cpname' /> 
               <!-- <div class="form-group col-sm-6">
                    <label for="date_n">Date</label>
                    <input type='text' class="form-control" placeholder='Date' name='date_n'/>
                </div>	-->
                 <div class="form-group col-sm-6">
                    <label for="cntn_n">Test Count *</label>
                    <input type='text' class="form-control"  placeholder='Test Count' name='tc_n' id='tcn' required/>
                </div>
                <div class="form-group col-sm-6">
                    <label for="st_n">Status</label>
                   <!--  <input type='text'class="form-control" placeholder='Status' name='st_n'/> -->
                    <select class="form-control" name='st_n' id='stn'>
						  <option value="In Progress">In Progress</option>
						  <option value="COMPLETED">COMPLETED</option>
					</select>
                </div>
                 <div class="form-group col-sm-6 ">
                    <label for="date_n">Date * </label>
                    <input type='text' class="form-control"  name='date_n' id='dateE'  required/>
                
                </div>
               
               			
       
                	
                 <div class="form-group col-sm-6">
                    <label for="cntn_n">Comment * </label>
                    <input type='text' class="form-control" placeholder='Comment' name='cntn_n' id='cntn' required/>
                </div>
               <div class="form-group col-sm-6">
                    <label for="path_r">SPRO Path *</label><br/>
                    <input type='checkbox'  name='path_r' id='path_r90' value="9.0"> 9.0&nbsp; </input>
                    <input type='checkbox'  name='path_r' id='path_r95' value="9.5"> 9.5&nbsp; </input>
                    <input type='checkbox'  name='path_r' id='path_r96' value="9.6"> 9.6&nbsp; </input>
                    <input type='checkbox'   name='path_r' id='path_r97' value="9.7"> 9.7&nbsp; </input>
                    <input type='checkbox'  name='path_r' id='path_r98' value="9.8"> 9.8&nbsp; </input>
                    <input type='checkbox'  name='path_r' id='path_r99' value="9.9"> 9.9&nbsp; </input>
                    <input type='checkbox'  name='path_r' id='path_r91' value="9.10"> 9.10&nbsp; </input>
                    <input type='checkbox'  name='path_r' id='path_r92' value="9.12"> 9.12&nbsp; </input>
                    <input type='checkbox'  name='path_r' id='path_r10' value="10.0"> 10.0&nbsp; </input>
                    <input type='checkbox'  name='path_r' id='path_rALL' value="ALL"> ALL </input>
                </div>
                <div class="form-group col-sm-6 ">
                    <input type='radio'  name='type_n' id='typen1' value="Automation" />&nbsp;&nbsp;Automation&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                    <input type='radio'  name='type_n' id='typen2' value="Stabilization" checked/>&nbsp;&nbsp;Stabilization
                
                </div>
                
                <div class="form-group col-sm-6 Automation_Active">
                    <label for="itrac_n">Itrac Id</label>
                    <input type='text' class="form-control"  placeholder='XXX-0000' name='itrac_n' id='itrac_n' required/>
                </div>
                <div class="form-group col-sm-12 text-center">
                
                   <button type="button" class="btn btn-info btn-sm" value='Save' name='save' id='btnsave'><span class="glyphicon glyphicon-ok" aria-hidden="true" ></span> Save</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                   <button type="reset" class="btn btn-info btn-sm" value='Save' name='save' id='btn2'><span class="glyphicon glyphicon-refresh" aria-hidden="true" ></span> Clear</button>
                </div>    
            </form>  
            </div>        
	</div>
    </div>
    </div>
   <div class="row">
   <div id='Showdiv' class='col-lg-12'>
    <button type="button" class="btn btn-info btn-md" value='ShowAll' name='ShowAll' id='ShowAll'><span class="glyphicon glyphicon-expand" aria-hidden="true" ></span> Show All</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <br/><br/>
   </div>
   </div>
   <div class="row">
  
    <div id='div1' class='col-lg-12'>

    </div>	
     
    </div>    
     </div>
<script>
$( function() {
    $( "#dateE" ).datepicker({dateFormat:"yy-mm-dd"});
    $( "#date1" ).datepicker({dateFormat:"yy-mm-dd"});
    $( "#date2" ).datepicker({dateFormat:"yy-mm-dd"});
} );
	$(document).ready(function(){
		
		$.post("pop_Automation.php",function(data,status)
		{
			$('#div1').html(data);
		});
		
              
	});

	$('#ShowAll').click(function(){
		$("#div1").load('Display_Automation.php');

	});


	
	$('.Automation_Active').hide();
	$('#typen1').click(function(){
	
		$('.Automation_Active').show();
	});
	$('#typen2').click(function(){
		$('.Automation_Active').hide();
	
	
	});
	$('#typen').click(function(){
		if($('input[name=type_n]:checked').val()=="Stabilization")
		{
			
			$('.Automation_Active').hide();
		}
		
		});
	$('#btn2').click(function(){
		$('.Automation_Active').hide();
	});
	$('#btnsave').click(function()
			{
		 var x = document.forms["Automation_form"]["cntn_n"].value;
		 var y=document.forms["Automation_form"]["tc_n"].value;
		 var z=document.forms["Automation_form"]["itrac_n"].value;
		 var i=document.forms["Automation_form"]["type_n"].value;
		 var p=document.forms["Automation_form"]["date_n"].value; 
		 if (p== "") {
		        alert("Please fill in the required field");
		        return false;
		    }
		    if (y== "") {
		        alert("Please fill in the required field");
		        return false;
		    }
		   
		    if(x=="")
			    {
			    	alert("Please provide valid comments");
			    	return false;  
			    }
			    
		    	   
				var _cp=$("#cpname").val();
				var _CNTNT=$("#cntn").val();
				//var _PATHR=$("#path_r").val();
				var _PATHR="";
				if(document.getElementById('path_r90').checked) {
	                var _PATHR=_PATHR+$("#path_r90").val()+"  ";
	            }
				if(document.getElementById('path_r95').checked) {
	                var _PATHR=_PATHR+$("#path_r95").val()+"  ";
	            }
				if(document.getElementById('path_r96').checked) {
	                var _PATHR=_PATHR+$("#path_r96").val()+"  ";
	            }
				if(document.getElementById('path_r97').checked) {
	                var _PATHR=_PATHR+$("#path_r97").val()+"  ";
	            }
				if(document.getElementById('path_r98').checked) {
	                var _PATHR=_PATHR+$("#path_r98").val()+"  ";
	            }
				if(document.getElementById('path_r99').checked) {
	                var _PATHR=_PATHR+$("#path_r99").val()+"  ";
	            }
				if(document.getElementById('path_r91').checked) {
	                var _PATHR=_PATHR+$("#path_r91").val()+"  ";
	            }
				if(document.getElementById('path_r92').checked) {
	                var _PATHR=_PATHR+$("#path_r92").val()+"  ";
	            }
				if(document.getElementById('path_r10').checked) {
	                var _PATHR=_PATHR+$("#path_r10").val()+"  ";
	            }
				          
				
				if(document.getElementById('path_rALL').checked) {
	                var _PATHR=_PATHR+$("#path_rALL").val()+"  ";
	            }
				if (_PATHR=="")
				{
					alert("Please select one SPRO line");
					return false;
				}
					
				var _TCN=$("#tcn").val();
				var _STN=$("#stn").val();
				var _DATEN=$("#dateE").val();
				var _TYPEN=$('input[name=type_n]:checked').val();
				if(_TYPEN=="Automation");
				{
					var _ITRAC=$("#itrac_n").val();
					if(_ITRAC=="")
					{
						_ITRAC="N/A";
					}
				}
				if(_TYPEN=="Stabilization")
				{
					var _ITRAC='N/A';
				}
				
			    $.ajax({
			        url: 'insert_ASdetails.php',
			        type:'POST',
			        datatype : "application/json",
			        data:
			        {CP: _cp, CNTNT: _CNTNT, PATHR: _PATHR, TCN: _TCN, STN: _STN, TYPEN: _TYPEN, ITRAC: _ITRAC, DATEN: _DATEN},
			        success: function(msg)
			        {
			            alert(msg);
			            $('#div1').load('pop_Automation.php');
			            $('#btn2').click();
			        },
			        error: function(msg)
			        {
				        alert(msg);
			        }            
			    });
			});
	function edit(n)
	{
            //alert();
            var eid=n.getAttribute("id");
            var _eid=eid.substring(1);
            //alert("Edit"+_eid);
            //make the row editable
            //$("#seqno"+_eid).prop("disabled",false);
            $("#dte"+_eid).prop("disabled",true);
            $("#cp"+_eid).prop("disabled",true);
            $("#contnt"+_eid).prop("disabled",false);
            $("#spra"+_eid).prop("disabled",false);
            $("#tstcnt"+_eid).prop("disabled",false);
            var _sts=$("#sts"+_eid).val();
            if(_sts=='In Progress')
            {
                $("#sts"+_eid).prop("disabled",false);
            }
            else
                if(_sts=='COMPLETED')
                {
                	 $("#sts"+_eid).prop("disabled",true);
                }
                    
            $("#tpe"+_eid).prop("disabled",true);
            $("#e"+_eid).prop("disabled",true);
            $("#itracid"+_eid).prop("disabled",true);
            $("#e"+_eid).hide();
            $("#spra"+_eid).hide();
            $("#u"+_eid).css("display","block");
            $("#spra90"+_eid).show();
            $("#Path90"+_eid).show();
            $("#spra95"+_eid).show();
            $("#Path95"+_eid).show();
            $("#spra96"+_eid).show();
            $("#Path96"+_eid).show();
            $("#spra97"+_eid).show();
            $("#Path97"+_eid).show();
            $("#spra98"+_eid).show();
            $("#Path98"+_eid).show();
            $("#spra99"+_eid).show();
            $("#Path99"+_eid).show();
            $("#spra91"+_eid).show();
            $("#Path91"+_eid).show();
            $("#spra92"+_eid).show();
            $("#Path92"+_eid).show();
            $("#spra10"+_eid).show();
            $("#Path10"+_eid).show();
            $("#spraALL"+_eid).show();
            $("#PathALL"+_eid).show();
            
	}
  	function update(n)
	{
            //alert("Update");
             var uid=n.getAttribute("id");
            var _uid=uid.substring(1);
            var _sq=$("#seqno"+_uid).val();
            var _cp=$("#cp"+_uid).val();
            var _dt=$("#dte"+_uid).val();
            var _cnt=$("#contnt"+_uid).val();
           // var _spra=$("#spra"+_uid).val();
            var _tc=$("#tstcnt"+_uid).val();
            var _typ=$("#tpe"+_uid).val();
            var _st=$("#sts"+_uid).val();
            var _itrac=$("#itracid"+_uid).val();
            var _spra="";
            var _pathid="spra90"+_uid;
            if(document.getElementById(_pathid).checked) {
                var _spra=_spra+$("#spra90"+_uid).val()+"  ";
            }
            var _pathid="spra95"+_uid;
            if(document.getElementById(_pathid).checked) {
                var _spra=_spra+$("#spra95"+_uid).val()+"  ";
            }
            var _pathid="spra96"+_uid;
            if(document.getElementById(_pathid).checked) {
                var _spra=_spra+$("#spra96"+_uid).val()+"  ";
            }
            var _pathid="spra97"+_uid;
            if(document.getElementById(_pathid).checked) {
                var _spra=_spra+$("#spra97"+_uid).val()+"  ";
            }
            var _pathid="spra98"+_uid;
            if(document.getElementById(_pathid).checked) {
                var _spra=_spra+$("#spra98"+_uid).val()+"  ";
            }
            var _pathid="spra99"+_uid;
            if(document.getElementById(_pathid).checked) {
                var _spra=_spra+$("#spra99"+_uid).val()+"  ";
            }
            var _pathid="spra91"+_uid;
            if(document.getElementById(_pathid).checked) {
                var _spra=_spra+$("#spra91"+_uid).val()+" ";
            }
            var _pathid="spra92"+_uid;
            if(document.getElementById(_pathid).checked) {
                var _spra=_spra+$("#spra92"+_uid).val()+" ";
            }
            var _pathid="spra10"+_uid;
            if(document.getElementById(_pathid).checked) {
                var _spra=_spra+$("#spra10"+_uid).val()+" ";
            }
            var _pathid="spraALL"+_uid;
            if(document.getElementById(_pathid).checked) {
                var _spra=$("#spraALL"+_uid).val()+" ";
            }

			if(_spra=="")
			{
				var _spra=$("#spra"+_uid).val();
			}
            document.cookie='Id'+"=" + uid.substring(1);
             document.cookie='CP'+"=" + _cp;
            document.cookie='Sq'+"=" + _sq;
            document.cookie='Dt'+"=" + _dt;
            document.cookie='Tp'+"=" + _typ;
            document.cookie='Cnt'+"=" + _cnt;
            document.cookie='Spra'+"=" + _spra;
            document.cookie='Tc'+"=" + _tc;
            document.cookie='St'+"=" + _st;
            document.cookie='Itrac'+"=" + _itrac;
            //alert("Update"+_sq);
//             $.post("update_Automation.php",{Id: _uid, CP: _cp, Sq:_sq, Dt:_dt,Tp:_typ, Cnt:_cnt, Spra:_spra,Tc:_tc,St:_st },function(resp_data){
//                 alert(resp_data);
//                 location.reload();
//                 window.location.href='./index.php#Automation';
//             });
            $("#div1").load('update_Automation.php');
            
            
            
	}
  	function tc(n)
	{
           //alert("tc");
  		var startDate = $('#date1').val().replace('-','/');
  		var endDate = $('#date2').val().replace('-','/');

  		if(startDate > endDate){
  		  	alert("Start date is greater than end date");
  		}
  		else
  		{
			var _dt1=$("#date1").val();
			var _dt2=$("#date2").val();
			var _tctype=$('input[name=TC_type_n]:checked').val();
			var _VN=$("#version_n").val();
			
			//alert(_dt1+"&&"+_dt2);
			
			$.post("testcount.php",{D1: _dt1, D2:_dt2, TCTP: _tctype, VN: _VN },function(resp_data){
				//alert("The test cases automated from "+_dt1+" to "+_dt2+" is "+resp_data);
			     //   alert(resp_data);
			    
                $("#result").text(resp_data).css({"color": "#1aa3ff","font-weight": "bold"});
           });
  		}
            
	}
  </script>
  
</body>
</html>
<?php } ?>