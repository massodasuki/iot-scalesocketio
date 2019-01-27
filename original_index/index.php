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
		        <li class="active"><a href="#" data-nav-section="home"><span><strong><font color="white">Analisa Berat</font></strong></span></a></li>
		        <li class="active"><a href="#" data-nav-section="home"><span><strong><font color="white">Analisa Suhu</font></strong></span></a></li>
		        <li class="active"><a href="#" data-nav-section="home"><span><strong><font color="white">Analisa Tekanan Darah</font></strong></span></a></li>
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

		<div class="col-md-12 section-heading text-center">
						
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




			<div class="col-md-12 section-heading text-center">
				<h2 style="font-size:5em;line-height: 0%" hidden="Scale" class="glyphicon glyphicon"><br><i style="font-size:0.3em; ">Scale <span id="bleConnIcon" class="glyphicon glyphicon-ban-circle"></span></i>
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
				<header>
					<img id="bmrIcon" class="img-responsive" img src="img/bmr.png" alt="bmr" style="text-align:center;width:50px;height:50px" data-toggle="tooltip" data-placement="bottom" title="Lalai"> 
					<p><span style="text-align:center;font-size:1em;line-height: 0%" class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title="Seorang wanita purata perlu makan kira-kira 2000 kalori setiap hari untuk berat ideal. Seorang lelaki purata memerlukan 2500 kalori untuk berat ideal. Walau bagaimanapun, ini bergantung kepada banyak faktor. "></span><span></span>Kadar Metabolisme Asas</p><p><span></span><span></span>(Basal Metabolic Rate)</p>
				</header>
				<div class="content">
					<div class="cf-svmc-sparkline">
						<div class="cf-svmc">
							<div class="metric" id='uBMR' style="font-size:4em;" >0 kcal</div>
						</div>
					</div>
				</div>
			</div> <!-- //end cf-item -->

			<div class="col-sm-3 cf-item" >
				<header>
					<img id ="weightIcon" class="img-responsive" img src="img/weight.png" alt="weight" style="text-align:center;width:50px;height:50px" data-toggle="tooltip" data-placement="bottom" title="Lalai"> 
					<p><span style="text-align:center;font-size:1em;" class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title="Dalam fizik, berat dari suatu benda adalah daya yang disebabkan oleh graviti terhadap jisim objek tersebut. Jisim objek(badan) adalah tetap di mana-mana, namun berat sebuah benda akan berubah-ubah mengikut daya tarikan gravitasi di tempat tersebut."></span><span></span>Berat (Weight)
					</p>
				</header>
				<div class="content cf-gauge" id="cf-gauge-1">
					<div class="val-current">
						<div class="metric" id="cf-gauge-1-m">0</div>
					</div>
					<div class="canvas">
						<canvas id="cf-gauge-1-g"></canvas>
					</div>
					<div class="val-min">
						<div class="metric-small">0</div>
					</div>
					<div class="val-max">
						<div class="metric-small">0</div>						
					</div>
				</div>
			</div> <!-- //end cf-item -->
		</div> <!-- //end row -->
	
		<div class="row">
			<div class="col-sm-3 cf-item">
				<header>
					<img id="bmiIcon" class="img-responsive" img src="img/bmi.png" alt="bmi" style="text-align:center;width:50px;height:50px" data-toggle="tooltip" data-placement="right" title="Lalai"> 
					<p><span style="text-align:center;font-size:1em;" class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="BMI adalah satu percubaan untuk mengukur jumlah jisim tisu (otot, lemak, dan tulang) dalam seseorang individu, dan kemudian mengkategorikan mereka sebagai kurang berat badan, berat badan normal, berat badan berlebihan, atau obes berdasarkan nilai itu."></span><span></span> Indeks Jisim Badan (Body Mass Index) 
					</p>
				</header>
				<div class="content cf-gauge" id="cf-gauge-2">
					<div class="val-current">
						<div class="metric" id="cf-gauge-2-m">0</div>
					</div>
					<div class="canvas">
						<canvas id="cf-gauge-2-g"></canvas>
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
							<img id="fatIcon" class="img-responsive" img src="img/bodyfat.png" alt="fatrate" style="text-align:center;width:50px;height:50px" data-toggle="tooltip" data-placement="bottom" title="Lalai" > 
							<p><span style="text-align:center;font-size:1em;" class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" 

							title="Lemak Tubuh adalah peratusan jumlah berat lemak dalam tubuh terhadap berat badan. Kadar lemak dalam tubuh merupakan indikator kesihatan. Kadar lemak yang berlebihan sangat berisiko terhadap berbagai penyakit. Mengurangkan lebihan lemak tubuh dapat mengurangi risiko berbagai penyakit berbahaya, seperti Tekanan Darah Tinggi, Strok, Penyakit Jantung, Kencing Manis dan Kanser.
							"></span><span></span> Kadar Lemak (Fat Rate) 
							</p>
						</header>
						<div class="content cf-svp clearfix" id="svp-1">
							<div class="chart" data-percent="0" data-layout="l-3"></div>
							<div class="metrics">
								<span class="metric">0</span>
								<span class="metric-small">%</span>
							</div>
						</div>
					</div> <!-- //end cf-item -->
			
						<div class="col-sm-3 cf-item">
				<header>
			<img id="viscIcon" class="img-responsive" img src="img/visceralfat.png" alt="viscfat" style="text-align:center;width:50px;height:50px" data-toggle="tooltip" data-placement="bottom" title="Lalai"> 
					<p><span style="text-align:center;font-size:1em;" class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title="Lemak yang mengelilingi internal organ tubuh seperti Hati, Jantung, Perut, dll. Setiap pemambahan Visceral Fat akan menambah risiko penyakit Tekanan Darah Tinggi, Jantung, Diabetes."></span><span></span> Visceral Fat </p>
				</header>
				<div class="content cf-svp clearfix" id="svp-2">
					<div class="chart" data-percent="0" data-layout="l-3"></div>
					<div class="metrics">
						<span class="metric">0</span>
						<span class="metric-small">%</span>
					</div>
				</div>
			</div> <!-- //end cf-item -->
						<div class="col-sm-3 cf-item">
				<header>
				<img id="muscleIcon" class="img-responsive" img src="img/musclesmass.png" alt="musclemass" style="text-align:center;width:50px;height:50px" data-toggle="tooltip" data-placement="bottom" title="Lalai"> 
					<p><span style="text-align:center;font-size:1em;" class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title="Otot memainkan peranan penting sebagai mesin menghasilkan tenaga. Semakin bertambah jisim otot, energi yang dihabiskan semakin bertambah, yang akan membantu anda mengurangi kadar lemak tubuh dan menurunkan berat badan dengan cara yang sihat."></span><span></span> Jisim Otot (Muscle Mass) </p>
				</header>
				<div class="content cf-svp clearfix" id="svp-3">
					<div class="chart" data-percent="0" data-layout="l-3"></div>
					<div class="metrics">
						<span class="metric">0</span>
						<span class="metric-small">%</span>
					</div>
				</div>
			</div> <!-- //end cf-item -->



		</div> <!-- //end row -->
		<div class="row">

			<div class="col-sm-3 cf-item">
				<header>
			<img id="bonemassIcon" class="img-responsive" img src="img/bonemass.png" alt="bone" style="text-align:center;width:50px;height:50px" data-toggle="tooltip" data-placement="right" title="Lalai" > 
					<p><span style="text-align:center;font-size:1em;" class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="right" title="Ujian kepadatan mineral tulang (BMD) adalah cara yang terbaik untuk mengukur kesihatan tulang anda. Ia membandingkan kepadatan tulang anda, atau jisim, untuk itu, orang yang sihat yang sama umur dan jantina. Ia boleh menunjukkan sama ada anda mempunyai osteoporosis iaitu satu penyakit yang membentuk tulang yang lemah dan anda berisiko untuk pecah tulang."></span><span></span> Jisim Tulang (Bone Mass) </p>
				</header>
				<div class="content cf-svp clearfix" id="svp-4">
					<div class="chart" data-percent="0" data-layout="l-3"></div>
					<div class="metrics">
						<span class="metric">0</span>
						<span class="metric-small">%</span>
					</div>
				</div>
			</div> <!-- //end cf-item -->

			<div class="col-sm-3 cf-item">
						<header>
				<img id="bodywaterIcon" class="img-responsive" img src="img/bodywater.png" alt="water" style="text-align:center;width:50px;height:50px" data-toggle="tooltip" data-placement="bottom" title="Lalai">
							

							<p><span style="text-align:center;font-size:1em;" class="glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title="Setiap satu tahun umur, peratusan kandungan air dalam badan jatuh kepada kira-kira 65%. Pada lelaki dewasa, kira-kira 60% daripada tubuh mereka air. Walau bagaimanapun, tisu lemak tidak mempunyai air sebanyak tisu tanpa lemak. Pada wanita dewasa, lemak membentuk badan mereka berbanding lelaki, jadi mereka mempunyai kira-kira 55% daripada tubuh mereka yang diperbuat daripada air."></span><span></span> Kandugan Air (Water Content) </p>
						</header>
						<div class="content cf-svp clearfix" id="svp-5">
							<div class="chart" data-percent="0" data-layout="l-3"></div>
							<div class="metrics">
								<span class="metric">0</span>
								<span class="metric-small">%</span>
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
		<H1 id="tempHeader" style="background-color:#4658DD; margin-top: 40px;text-align:center">Thermometer</H1>
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


			<div class="col-sm-4 col-md-offset-4 cf-item center" >
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
			
			
			
</div>


<div class="row">




	<H1 id="bpHeader" style="background-color:#4658DD">Blood Pressure</H1>
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
    var vBMR=document.getElementById("uBMR").innerHTML;
    var vWeight=document.getElementById("cf-gauge-1-m").innerHTML;
    var vBMI=document.getElementById("cf-gauge-2-m").innerHTML;
    var vFat=document.getElementById("svp-1").getElementsByClassName("metric")[0].innerHTML;
    var vVisFat=document.getElementById("svp-2").getElementsByClassName("metric")[0].innerHTML;
    var vMuscle=document.getElementById("svp-3").getElementsByClassName("metric")[0].innerHTML;
    var vBone=document.getElementById("svp-4").getElementsByClassName("metric")[0].innerHTML;
    var vWater=document.getElementById("svp-5").getElementsByClassName("metric")[0].innerHTML;
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
    setCookie("cBMR",  vBMR, 30);
    setCookie("cWeight",  vWeight, 30);
    setCookie("cBMI",  vBMI, 30);
    setCookie("cFat",  vFat, 30);
    setCookie("cVisFat",  vVisFat, 30);
    setCookie("cMuscle",  vMuscle, 30);
    setCookie("cBone",  vBone, 30);
    setCookie("cWater",  vWater, 30);
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