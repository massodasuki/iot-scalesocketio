<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <title>Vital Weight</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link href="css/blue.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/controlfrog.css" rel="stylesheet" media="screen">   
	<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
  	<link rel="stylesheet" href="tooltips/3.3.7/css/bootstrap.min.css">
  	<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">


  	<script src="tooltips/3.1.1/jquery/jquery.min.js"></script>
  	<script src="tooltips/js/3.3.7/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.9.1.min.js"></script>    
	<script src="js/moment.js"></script>	
	<script src="js/easypiechart.js"></script>
	<script src="js/gauge.js"></script>	
	<script src="js/chart.js"></script>
	<script src="js/jquery.sparklines.js"></script>			
    <script src="js/bootstrap.js"></script>
    <script src="js/controlfrog-plugins.js"></script>

    <style>

    	/* css added-- Masso Dasuki*/

    	.im-centered { margin: auto; max-width: 300px; /* center */
    	} 

		  /* Tooltip */
		  .test + .tooltip > .tooltip-inner {
		      background-color: #73AD21; 
		      color: #FFFFFF; 
		      border: 1px solid green; 
		      padding: 15px;
		      font-size: 20px;
		  }
		  /* Tooltip on top */
		  .test + .tooltip.top > .tooltip-arrow {
		      border-top: 5px solid green;
		  }
		  /* Tooltip on bottom */
		  .test + .tooltip.bottom > .tooltip-arrow {
		      border-bottom: 5px solid blue;
		  }
		  /* Tooltip on left */
		  .test + .tooltip.left > .tooltip-arrow {
		      border-left: 5px solid red;
		  }
		  /* Tooltip on right */
		  .test + .tooltip.right > .tooltip-arrow {
		      border-right: 5px solid black;
		  }

		/*End Prioritize this css -- Masso Dasuki*/

	</style>
    
    <!--[if lt IE 9]>
		<script src="../../js/respond.min.js"></script>
		<script src="../../js/excanvas.min.js"></script>
	<![endif]-->
	<script>var themeColour = 'black';</script>
    <script src="js/controlfrog.js"></script>
</head>


<div class="container" style="width: 100%;">
<!-- <div class="row"> -->
	<nav class="navbar" style="width: 100%">
	<div class="navbar-header">

	<!-- Logo -->

	<a style="background-color:grey" class="navbar-brand"><img src="img/logo_bakatjohor.png" alt="Logo" style="width:80px;height:80px;line-height: 0%"></a> 
	<a style="background-color:red" class="navbar-brand" style="font-size:1.5em;" href="index.html"><span><strong><font color="white">BAKAT JOHOR</font></strong></span></a> 

	<ul class="nav navbar-nav navbar-right">
		        <li class="active"><a href="/" data-nav-section="home"><span><strong><font color="white">Analisa Berat</font></strong></span></a></li>
		         <li class="active"><a href="/suhu.php" data-nav-section="home"><span><strong><font color="white">Analisa Suhu & Tekanan Darah</font></strong></span></a></li>
		    </ul>
	</div>
	
	<div style="background-color:blue" id="navbar" class="navbar-collapse collapse">
		    <ul class="nav navbar-nav navbar-right">
		        <li class="active"><a href="#" data-nav-section="home"><span><strong><font color="white">PROFAIL KECERGASAN</font></strong></span></a></li>
		    </ul>
		</div>
	</nav>
<!-- </div> -->
</div>

<body class="black">
	<div class="cf-container">

		<div class="col-md-12 text-center">
						
					<div id="scanButtonDix">
					<input class="btn btn-primary btn-md" name="Scan" type="button" id="scanBle" value="START SCAN">
					</div>
					<div id="listOfBlesDiv" class="col-md-7 col-md-offset-3">
					<table class="display" id="tblScannedDev" width="100%">
						<thead>
					 		<tr>
					        	<th>Local Name</th>
					        	<th>Id</th>
					        	<th>Auto Connect</th>
					            <th>Status</th>
					   		</tr>
						</thead>
					  	<tbody id="bleDevList">
					  	</tbody>
					</table>

		</div>




			<div class="col-md-12 text-center">
				<h2 style="font-size:1.2em;line-height: 0%" hidden="Scale" class="glyphicon glyphicon"><br><i style="font-size:0.3em; ">Device <span id="bleConnIcon" class="glyphicon glyphicon-ban-circle"></span></i>
				</h2>

		<div style="text-align:center">
      		<select id="scaleSelect">
      		</select>
      	</div>
					<div class="col-md-7 col-md-offset-3">
						<table id="scaleUsrTbl" class="display">
							<thead>
						 		<tr>
						 			<th>Nama</th>
						        	<th>Jantina</th>
						        	<th>Umur</th>
						            <th>Tinggi</th>
						            <th>Unit</th>	
						            <th></th>					      
						   		</tr>
							</thead>
				  			<tbody>
						    	<tr>
						    		<td>				   
						            	<input type="text" id="sname" name="sname" placeholder="Name">
						            </td>
						        	<td>
						            	<select size="1" id='sgender' name="sgender">
						            		<option  value="male" selected="selected">Lelaki</option>
						                    <option  value="female">Wanita</option>
						                </select>
						            </td>
						            <td>
						            	<input type="number" id="sage" name="sage" placeholder=" years old" >
						            </td>
						            <td>
						            	<input type="number" id="sheight" name="sheight" placeholder="centimeter">
						            </td>
						            <td>
						            	<select size="1" id='sunit' name="sunit">
						                    <option value="kg" selected="selected">Kilogram</option>
						                    <option value="lb">Pound</option>
						                    <option value="st">Stone</option>
						                </select>
						            </td>
						            <td>
						            	<button class="btn btn-primary btn-md" type="button" id="ssetusrbutton" value="hantar">Hantar</button>
						            </td>
						        </tr>
				  			</tbody>
						</table>		
				</div>
		</div>
	</div> <!-- //end container -->

	<div class="container" style="margin-bottom: 50px; line-height: 0%">
		<div class="row">
			<div class="col-xs-12 text-center">
				<h1 id="status" class="btn btn-warning" style="font-size:1.5em;"> Menyambung .. </h1>
			</div>
		</div>
	</div>
	<!-- //end container -->

	<div class="cf-container cf-nav-active">
		<div class="row">
			<div class="col-sm-3 cf-item">
				<header>
					<p><span></span>Profail Pengguna</p>
				</header>
				<div class="content">            
					<table class="table table">
						<thead>
						    <tr>
						    </tr>
						</thead>
						<tbody>
						    <tr>
						        <td><strong>Nama</strong></td>
						        <td ><span id="uName"></span></td>
						    </tr>
						    <tr>
						        <td><strong>Jantina</strong></td>
						        <td><span class="text-capitalize" id="uGender"></span></td>
						    </tr>
						    <tr>
						        <td><strong>Umur</strong></td>
						        <td><span id="uAge"></span></td>
						    </tr>
						    <tr>
						        <td><strong>Tinggi</strong></td>
						        <td><span id="uHeight"></span></td>
						    </tr>
						    <tr>
						        <td><strong>Berat</strong></td>
						        <td><span id="uWeight"></span></td>
						    </tr>
						</tbody>
					</table>
				</div>
			</div> <!-- //end cf-item -->


			<div class="col-sm-3 cf-item">
				<!--
					Display the time and date
					For 12hr clock add class 'cf-td-12' to the 'cf-td' div
				-->
				<header>
					<p><span></span>Masa &amp; Tarikh</p>
				</header>
				<div class="content">
					<div class="cf-td">
					<!-- <div class="cf-td cf-td-12">-->
						<div class="cf-td-time metric">12:00</div>
						<div class="cf-td-dd">
							<p class="cf-td-day metric-small">Monday</p>
							<p class="cf-td-date metric-small">1st October, 2013</p>
						</div>
					</div>
				</div>
			</div> <!-- //end cf-item -->


			<div class="col-sm-3 cf-item">

				<div style="text-align:center">
					<select id="tempSelect">
					</select>
				</div>
				
				<div style="text-align:center">
					<label for "temp">Temperature :</label> 
					<label id="temp" style="margin-left:5px"></label>
					<label style=" margin-right:50px">&#8451</label>
					<label for "tType">Type :</label><label id="tType" style="margin-left:10px ; margin-right:50px"></label>
				</div>	

					<header>
					<img id="celciusIcon" class="img-responsive" img src="img/iconCelcius.png" alt="celcius" style="text-align:center;width:50px;height:50px" data-toggle="tooltip" data-placement="bottom" title="Lalai">

						<p><span style="text-align:center; font-size:1em;" class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title="Suhu Badan"></span><span></span>Temperature :
						</p>
					</header>
					<div class="content cf-gauge" id="cf-gauge-3">
						<div class="val-current">
							<div class="metric" id="cf-gauge-3-m">0</div>
						</div>
						<div class="canvas">
							<canvas id="cf-gauge-3-g"></canvas>
						</div>
						<div class="val-min">
							<div class="metric-small">0</div>
						</div>
						<div class="val-max">
							<div class="metric-small">0</div>						
						</div>
						
					</div>
				
			</div> <!-- //end cf-item -->

			<div class="col-sm-3 cf-item " style="line-height: 900%" >
							<header>
								<p><span></span>Kunci Petunjuk</p>
							</header>
							<div class="panel panel-default" >          
								<table class="table table " style="background-color:grey">
									<thead>
									    <tr>
									    <td><strong><font color="black">Warna Ikon</font></strong></td>
									         <td><strong><font color="black">Huraian</strong></td>
									    </tr>
									</thead>
									<tbody>
									    <tr>
									        <td><strong><font color="yellow">Kuning</font></strong></td>
									         <td><font color="white">Rendah</font></td>
									    </tr>
									    <tr>
									        <td><strong><font color="green">Hijau</font></strong></td>
									        <td><font color="white">Normal</font></td>
									    </tr>
									    <tr>
									        <td><strong><font color="purple">Unggu</font></strong></td>
									        <td><font color="white">Tinggi</font></td>
									    </tr>
									    <tr>
									        <td><strong><font color="red">Merah</font></strong></td>
									        <td><font color="white">Sangat Tinggi</font></td>
									    </tr>
									</tbody>
								</table>
							</div> </div> <!-- //end cf-item -->		


			
		</div> <!-- //end row -->
	


<div class="row"></div>
		
<!-- New Function 1OKT2017 -->



	<div class="row">




		<h3 id="bpHeader" style="background-color:#4d4d50">Blood Pressure</h3>
		<div style="text-align:center">
			<select id="bpSelect">
			</select>
		</div>

		<div style="text-align:center">
			<label for "pump">Pump Pressure :</label>
			<label id="pump" style="margin-left:5px; margin-right:5px"></label>
			<label style="margin-left:5px; margin-right:50px">mmHg</label>


			<label for "systolic">Systolic :</label> 
			<label id="systolic" style="margin-left:5px; margin-right:5px"></label>
			<label style="margin-left:5px; margin-right:50px">mmHg</label>

			<label for "diastolic">Diastolic :</label> 
			<label id="diastolic" style="margin-left:5px; margin-right:5px"></label>
			<label style="margin-left:5px; margin-right:50px">mmHg</label>

			<label for "pulse">Pulse :</label> 
			<label id="pulse" style="margin-left:5px; margin-right:5px"></label>
			<label style="margin-left:5px;">bpm</label>

		</div>	
			
		<div class="col-sm-3 cf-item" >
					<header>
						<p><span style="text-align:center;font-size:1em;" class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title="Pump Pressure"></span><span></span>Pump Pressure :
						</p>
					</header>
					<div class="content cf-gauge" id="cf-gauge-4">
						<div class="val-current">
							<div class="metric" id="cf-gauge-4-m">0</div>
						</div>
						<div class="canvas">
							<canvas id="cf-gauge-4-g"></canvas>
						</div>
						<div class="val-min">
							<div class="metric-small">0</div>
						</div>
						<div class="val-max">
							<div class="metric-small">0</div>						
						</div>
					</div>
				</div> <!-- //end cf-item -->
			
			
			

			<div class="col-sm-3 cf-item" >
					<header>
						<p><span style="text-align:center;font-size:1em;" class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title="Systolic"></span><span></span>Systolic :
						</p>
					</header>
					<div class="content cf-gauge" id="cf-gauge-5">
						<div class="val-current">
							<div class="metric" id="cf-gauge-5-m">0</div>
						</div>
						<div class="canvas">
							<canvas id="cf-gauge-5-g"></canvas>
						</div>
						<div class="val-min">
							<div class="metric-small">0</div>
						</div>
						<div class="val-max">
							<div class="metric-small">0</div>						
						</div>
					</div>
				</div> <!-- //end cf-item -->
			
			
			
			
			<div class="col-sm-3 cf-item" >
					<header>
						<p><span style="text-align:center;font-size:1em;" class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title="Diastolic"></span><span></span>Diastolic
						</p>
					</header>
					<div class="content cf-gauge" id="cf-gauge-6">
						<div class="val-current">
							<div class="metric" id="cf-gauge-6-m">0</div>
						</div>
						<div class="canvas">
							<canvas id="cf-gauge-6-g"></canvas>
						</div>
						<div class="val-min">
							<div class="metric-small">0</div>
						</div>
						<div class="val-max">
							<div class="metric-small">0</div>						
						</div>
					</div>
				</div> <!-- //end cf-item -->
			

			
			<div class="col-sm-3 cf-item">
					<header>
						<img id="pulseIcon" class="img-responsive" img src="img/pulse.png" alt="bmr" style="text-align:center;width:50px;height:50px" data-toggle="tooltip" data-placement="bottom" title="Lalai"> 
						<p><span style="text-align:center;font-size:1em;line-height: 0%" class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title="Degupan Jantung. "></span><span></span>Pulse</p>
					<div class="content">
						<div class="cf-svmc-sparkline">
							<div class="cf-svmc">
								<div class="metric" id='uPulse' style="font-size:4em;" >0</div>
							</div>
						</div>
					</div>
				</div> <!-- //end cf-item -->
			
			
		</div>
	</div>


<!-- End New Function 1OKT2017 -->

	<!-- Print -->
	<div style="text-align:center">
	<button type="button"  class="btn btn-primary btn-md" onclick="addCookies()">PRINT</button>
	</div>
		
		<div class="row" style="line-height: 900%">
			<footer align="center" > Copyright 2017 - Bakat Johor </footer>
		</div>
	</div> <!-- //end container -->

	<script>
	// tooltips js
	$(document).ready(function(){
	    $('[data-toggle="tooltip"]').tooltip();   
	});

	</script>

	<script type="text/javascript" charset="utf8" src="js/jquery.dataTables.min.js"></script>
	<script src="http://<?php echo $_SERVER['SERVER_NAME']; ?>:3001/socket.io/socket.io.js"></script>
	<script>var serveraddr = 'http://<?php echo $_SERVER['SERVER_NAME'] ?>:3001';</script>
	<script type="text/javascript" src="js/blemed.js"></script>






	
<script>

function setCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function addCookies() {  

    //var vUser= "Kalau";
  
    var vNama=document.getElementById("uName").innerHTML;
    var vSex=document.getElementById("uGender").innerHTML;
    var vUmur=document.getElementById("uAge").innerHTML;
    var vTinggi=document.getElementById("uHeight").innerHTML;
    var vBerat=document.getElementById("uWeight").innerHTML;

    var vSuhu=document.getElementById("cf-gauge-3-m").innerHTML;
    var vPump=document.getElementById("cf-gauge-4-m").innerHTML;
    var vSystolic=document.getElementById("cf-gauge-5-m").innerHTML;
    var vDiastolic=document.getElementById("cf-gauge-6-m").innerHTML;
    var vPulse=document.getElementById("uPulse").innerHTML;

    

    //setCookie("cUser",  vUser, 30);


    setCookie("cNama",  vNama, 30);
    setCookie("cSex",  vSex, 30);
    setCookie("cUmur",  vUmur, 30);
    setCookie("cTinggi",  vTinggi, 30);
    setCookie("cBerat",  vBerat, 30);
    setCookie("cSuhu",  vSuhu, 30);
    setCookie("cPump",  vPump, 30);
    setCookie("cSystolic",  vSystolic, 30);
    setCookie("cDiastolic",  vDiastolic, 30);
    setCookie("cPulse",  vPulse, 30);

    window.open("./form-cookies.html", "_blank");

    /*
    alert("Hello " + vNama);

     alert("cNama " +  vNama);
     alert("cSex " +  vSex);
     alert("cUmur " +  vUmur);
     alert("cTinggi " +  vTinggi);
     alert("cBerat " +  vBerat);
     alert("cBMR " +  vBMR);
     alert("cWeight " +  vWeight);
     alert("cBMI " +  vBMI);
     alert("cFat " +  vFat);
     alert("cVisFat " +  vVisFat);
     alert("cMuscle " +  vMuscle);
     alert("cBone " +  vBone);
     alert("cWater " +  vWater);
     alert("cSuhu " +  vSuhu);
     alert("cPump " +  vPump);
     alert("cSystolic " +  vSystolic);
     alert("cDiastolic " +  vDiastolic);
     alert("cPulse " +  vPulse);
	*/
}


</script>

	<script>
	function printFunction() {
    
    addCookies();

	}
	</script>
	<!-- For Testing -->


	<!-- For Testing Hardcode -->
	<button type="hide" onclick="myFunction()"></button>

	<script>
	function myFunction() {

		document.getElementById("uName").innerHTML = "Masso";
		document.getElementById("uBMR").innerHTML = 40 + " kcal";
		document.getElementById("svp-1").getElementsByClassName("metric")[0].innerHTML ="Test";
		document.getElementById("svp-2").getElementsByClassName("metric")[0].innerHTML ="Test";
		document.getElementById("cf-gauge-1-m").innerHTML ="Test";

		//document.getElementById("cf-gauge-1-m").getElementsByClassName("metric")[0].innerHTML  ="Test" ;
		//document.getElementById("cf-gauge-2-m").getElementsByClassName("metric")[0].innerHTML ="Test";
		//document.getElementById("svp-3").getElementsByClassName("metric")[0].innerHTML ="Test";
		//document.getElementById("svp-4").getElementsByClassName("metric")[0].innerHTML ="Test";
		//document.getElementById("svp-5").getElementsByClassName("metric")[0].innerHTML ="Test";

    /*
		var typeBmi = 3;

			if (typeBmi == 1 ){

			$("#bmrIcon").attr("src","img/bmrThin.png"); //change icon img
			$("#bmrIcon").attr("data-original-title", "Rendah dan Perlu Tambah Jumlah Kalories");
					
		}
		if (typeBmi == 2 ){

			
			$("#bmrIcon").attr("src","img/bmrNormal.png"); //change icon img
			$("#bmrIcon").attr("data-original-title", "Normal dan Perlu Kekalkan Jumlah Kalories");
					
		}
		if (typeBmi == 3 ){

			$("#bmrIcon").attr("src","img/bmrOver.png"); //change icon img
			$("#bmrIcon").attr("data-original-title", "Tinggi dan Perlu Kurangkan Jumlah Kalories");
					
		}
		if (typeBmi == 4 ){

			$("#bmrIcon").attr("src","img/bmrObes.png"); //change icon img
			$("#bmrIcon").attr("data-original-title", "Sangat Tinggi dan Perlu Kurangkan Jumlah Kalories");
					
		}
		*/

	}
	</script>
	<!-- For Testing -->
	


</body>
</html>