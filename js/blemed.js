var socket = io.connect(serveraddr);


//list of commands:
/* socket.emit('startScan');
** socket.emit('stopScan');
** socket.emit('devconnect',devname,devId);
** socket.emit('devdisconnect',devname,devId);
**
** socket.emit('scaleSetUser',devname,devId,gender,age,height); i.e gender = 'male' @ 'female' age = 18 height = 200 (in cm) 
** socket.emit('scaleSetUnit',devname,devId,unit); i.e. 'kg','lb','st'
**/

//list of events:
/* socket.on('bleReady',function(status){});
** socket.on('scanStarted',function(){});
** socket.on('scanStopped',function(){});
** socket.on('bleDevAdded',function(type,devname,devid,status){});
** socket.on('connected',function(type,devname,devid,status){}); 
** socket.on('disconnected',function(devname,devid,status){});
**
** socket.on(scaleMeasurement',function(devname,devid,dataType,data,dataUnit){});
** socket.on('scaleStatus',function(devname,devid,status){});
** socket.on('scaleReading',function(devname,devid,scaleUserHistory){});
** socket.on('scaleUnitStatus',function(devname,devid,status){});
** socket.on('scaleSetUserInfoStatus',function(devname,devid,status){});
** 
** socket.on('thermoReading',function(devname,devid,reading){});
**
** socket.on('glucose',function(devname,devid,reading,rdunit){});
** socket.on('cholesterol',function(devname,devid,reading,rdunit){});
**/


function gaugeUpdate(gauge, opts){

	if(opts.minVal){
		$('.val-min .metric-small', $('#'+gauge)).html(opts.minVal);		
		cf_rGs[gauge].minValue = opts.minVal;
	}
	if(opts.maxVal){
		cf_rGs[gauge].maxValue = opts.maxVal;
		$('.val-max .metric-small', $('#'+gauge)).html(opts.maxVal);
	}
	if(opts.newVal){
		var value = parseFloat(opts.newVal);
		cf_rGs[gauge].set(value);
	}
}


socket.emit('stopScan');

$(document).ready(function(){
	//console.log('socket.io server info : '+serveraddr);
	$('scanBle').prop('disabled', true);
	
	socket.on('bleReady',function(status){
		//console.log('bleReady :'+status);
		//status = 'success','failed'

		updateOpts = {'minVal':'0','maxVal':'250','newVal':'0'};
		gaugeUpdate('cf-gauge-1', updateOpts);

		updateOpts = {'minVal':'0','maxVal':'50','newVal':'0'};
		gaugeUpdate('cf-gauge-2', updateOpts);

		updateOpts = {'minVal':'0','maxVal':'45','newVal':'0'};
		gaugeUpdate('cf-gauge-3', updateOpts);

		updateOpts = {'minVal':'0','maxVal':'500','newVal':'0'};
		gaugeUpdate('cf-gauge-4', updateOpts);

		updateOpts = {'minVal':'0','maxVal':'500','newVal':'0'};
		gaugeUpdate('cf-gauge-5', updateOpts);

		updateOpts = {'minVal':'0','maxVal':'500','newVal':'0'};
		gaugeUpdate('cf-gauge-6', updateOpts);


		
		$("#scanBle").val('START SCAN');
		if(status=='success'){
			$("#blestatus").text("BLE Status : Ready");
			$('scanBle').prop('disabled', false);
		}
		else{
			$("#blestatus").text("BLE Status : Error");
			$('scanBle').prop('disabled', true);
		}
	});
	
	socket.on('scanStarted',function(){
		if($("#scanBle").val()=='START SCAN'){
			$("#scanBle").val('STOP SCAN');
			return;
		}
	});
	socket.on('scanStopped',function(){
		if($("#scanBle").val()=='STOP SCAN'){
			//socket.emit('stopScan');
			$("#scanBle").val('START SCAN');
			return;
		}
	});
	
	socket.on('bleDevAdded',function(type,devname,devid,status){
		//console.log('bleDevAdded :type('+type+') devName('+devname+') devid('+devid+') status('+status+')');
		//status = 'added','exist'
		
		var skip = false;
		$('#bleDevList').find('tr').each(function(){
			var $dev = $(this).find('td');
			var lName = $dev.eq(0).text();
			
			if(lName.match(devname)){
				//console.log(lName+' matched '+devname);
				skip = true;
				if($(this).find("input[type=checkbox]").is(":checked")){
					$dev.eq(3).text('Connecting');
					socket.emit('devconnect',devname,devid);
				}
				else{
					$dev.eq(3).text('Found');
				}
				return;
			}
		});
		
		if(!skip){
			var bleName 	= "<tr><td>"+devname+"</td>";
			var bleId 		= "<td style='text-align:center'>"+devid.toUpperCase()+"</td>"
			var bleConnect	= "<td style='text-align:center'><input type='checkbox' name='bledev' onclick='bleConnect(this)'></td>";
			var bleStatus	= "<td style='text-align:center'>Found</td>"
			
			var entry		= bleName+bleId+bleConnect+bleStatus;
			$("#bleDevList").append(entry);
		}
	});
	
	socket.on('connected',function(type,devname,devid,status){
		//console.log('connected :type('+type+') devName('+devname+') devid('+devid+') status('+status+')');
		//status = 'eDiscovery', 'connected','missing' and "noble" specific error

		//SCALE
		if(status=='connected'){
			// Change connection icon
			if($("#bleConnIcon").hasClass("glyphicon-ban-circle")){
				$("#bleConnIcon").removeClass("glyphicon-ban-circle");
				$("#bleConnIcon").toggleClass("glyphicon-flash");
			}

			var age = $('#sage').val();
			var height = $('#sheight').val();

			if(age=='' || height==''){
				$('#status').removeClass().addClass('btn btn-danger').text('Masukkan Maklumat Pengguna');
			}
			else{
				$('#status').removeClass().addClass('btn btn-success').text('Sedia');
				
			}
			
		}
		else{
			// Change connection icon
			if($("#bleConnIcon").hasClass("glyphicon-flash")){
				$("#bleConnIcon").removeClass("glyphicon-flash");
				$("#bleConnIcon").toggleClass("glyphicon-ban-circle");
			}
		}
		
		$('#bleDevList').find('tr').each(function(){
			var $dev = $(this).find('td');
			var lName = $dev.eq(0).text();
			var devId = $dev.eq(1).text();
			
			if(lName.match(devname) && devId.match(new RegExp(devid,'i'))){
				if(status=='connected'){
					$dev.eq(3).text('Connected');
					
					if(type=='scale'){
						if($("#scaleSelect option[value="+devid.toUpperCase()+"]").length > 0){
							return;
						}
						else{
							$('<option>').val(devid.toUpperCase()).text(devid.toUpperCase()).appendTo('#scaleSelect');
						}
					}
					if(type=='thermometer'){
						if($("#tempSelect option[value="+devid.toUpperCase()+"]").length > 0){
							return;
						}
						else{
							$('<option>').val(devid.toUpperCase()).text(devid.toUpperCase()).appendTo('#tempSelect');
						}
						//$('#temp').text('');
						//$('#tType').text('');
					}
					if(type=='glucChol'){
						if($("#gluSelect option[value="+devid.toUpperCase()+"]").length > 0){
							return;
						}
						else{
							$('<option>').val(devid.toUpperCase()).text(devid.toUpperCase()).appendTo('#gluSelect');
						}
					}
					if(type=='bloodPressure'){
						if($("#bpSelect option[value="+devid.toUpperCase()+"]").length > 0){
							return;
						}
						else{
							$('<option>').val(devid.toUpperCase()).text(devid.toUpperCase()).appendTo('#bpSelect');
						}
					}
				}
				else if(status=='missing'){
					$dev.eq(3).text('Scanning');
				}
				else
					$dev.eq(3).text(status);
				return;
			}
		});
	});
	
	socket.on('disconnected',function(devname,devid,status){
		//console.log('disconnected :devName('+devname+') devid('+devid+') status('+status+')');
		//status = 'disconnected', 'timeout','ealready','eempty' and "noble" specific error
		
		$('#bleDevList').find('tr').each(function(){
			var $dev = $(this).find('td');
			var lName = $dev.eq(0).text();
			var devId = $dev.eq(1).text();
			
			
			//console.log(lName+'@'+devname);
			if(lName.match(devname)||devId.match(new RegExp(devid,'i'))){
				 $dev.eq(3).text('Disconnected');
				 
				 if($(this).find("input[type=checkbox]").is(":checked")){
					return;
				 }
				 
				 if(lName.match('F2520')){
				 	$('#scaleSelect option').each(function() {
						if ( ($(this).val()).match(new RegExp(devid,'i')) ) {
							$(this).remove();
							/*
							$('#weight').text('');
							$('#bmi').text('');
							$('#fatrate').text('');
							$('#viscfat').text('');
							$('#muscle').text('');
							$('#bmr').text('');
							$('#bone').text('');
							$('#water').text('');
							$('#datetime').text('');
							$('#timedate').text('');
							*/
						}
					});
				 }
				 if(lName.match('TEMP')){
				 	$('#tempSelect option').each(function() {
						if ( ($(this).val()).match(new RegExp(devid,'i')) ) {
							$(this).remove();
							//$('#temp').text('');
							//$('#tType').text('');
						}
						
					});
				 }
				 if(lName.match('Samico GL')){
				 	$('#gluSelect option').each(function() {
						if ( ($(this).val()).match(new RegExp(devid,'i')) ) {
							$(this).remove();
							//$('#glucose').text('');
							//$('#cholesterol').text('');
						}
						
					});
				 }
				 if(lName.match('Samico BP')){
				 	$('#bpSelect option').each(function() {
						if ( ($(this).val()).match(new RegExp(devid,'i')) ) {
							$(this).remove();
						}
						
					});
				 }
				return;
			}
			console.log('Unknown device :'+lName+'@'+devname+' just got disconnected!');
		});
	});
	
	//Scale utilities
	socket.on('scaleMeasurement',function(devname,devid,dataType,data,dataUnit){
		//console.log('scaleMeasurement :devName('+devname+') devid('+devid+') dataType('+dataType+') data('+data+') dataUnit('+dataUnit+')');
		//dataType = 'weightUnstable','weightStable','endOfUserData','startOfUserData','computingUserData','computingUserDataError','userWeight'
		//			 'userBodyMassIndex','userFatRate','userSubFatRate','userViscFatRate','userMuscleMass','userBasalMetabolicRate','userBoneMass',
		//			 'userWaterContent','userAge','userProteinRate','userBiaUnstable','userBiaStable','userBiaError','userId','userDate','userTime'
		var devId = $('#scaleSelect').find(":selected").text();
		
		if(!devId.match(new RegExp(devid,'i'))){
			if(debug)
				console.log('This data is from '+devid);
			return;
		}
		
		if(debug){
			console.log('scaleMeasurement :devName('+devname+') devid('+devid+') dataType('+dataType+') data('+data+') dataUnit('+dataUnit+')');
		}

		if(dataType=='weightUnstable'){
			
			clearTimeout(measuringTimeOut);
			measuringTimeOut = setTimeout(function(){
				clearReading();
				$('#status').removeClass().addClass('btn btn-success').text('Sedia');
			},5000);

			$('#status').removeClass().addClass('btn btn-default').text('Lakukan Pengiraan..');

			updateOpts = {'newVal':data};
			gaugeUpdate('cf-gauge-1', updateOpts);
			$('#cf-gauge-1-m').text(data+' Kg');

			clearReading();
		}
		else if(dataType=='weightStable'){
			clearTimeout(measuringTimeOut);
			measuringTimeOut = setTimeout(function(){
				clearReading();
				$('#status').removeClass().addClass('btn btn-info').text('Sedia');
			},8000);

			gaugeUpdate('cf-gauge-1', {'newVal':data});
			$('#cf-gauge-1-m').text(data+' Kg');

			if(debug)
				console.log('Measuring your impedance...');
		}
		else if(dataType=='userBiaStable'){
			if(debug)
				console.log('Done, you may step down...');

			clearTimeout(measuringTimeOut);
			$('#status').removeClass().addClass('btn btn-success').text('Sedia');
		}
	});
	
	socket.on('scaleStatus',function(devname,devid,status){
		//status = 'activeMode', 'lowPowerMode','battLow','overload','timeout','unstable','bleConnected','userInfoRequest','measureComplete'
		console.log('scaleStatus :devName('+devname+') devid('+devid+') status('+status+')');
	});
	socket.on('scaleReading',function(devname,devid,scaleUserHistory){
		/*scaleUserHistory = {
		  	'sex':'male'@'female',
			'age':,
			'height':,
			'impedance':,
			'weight':,
			'bmi':,
			'fatRate':,
			'viscFat':,
			'muscle':,
			'bmr':,
			'bone':,
			'water':,
			'date':,
			'time':
		  }
		*/
		//Weight analysis here!//--------------------------------------------

		var stdWeight = '';
		var tinggi = scaleUserHistory.height;
		var jantina =scaleUserHistory.sex;
		if(tinggi!=''){
			if(jantina=='male'){
				stdWeight= (tinggi-100)*0.9;
			}
			else{
				stdWeight= ((tinggi-100)*0.9)-2.5;
			}
		}
		
		console.log('Standard Weight :'+stdWeight);
		//thin range	: scaleUserHistory.weight < (stdWeight - stdWeight*0.1)
		//normal range	: scaleUserHistory.weight > (stdWeight - stdWeight*0.1) && w < (stdWeight + stdWeight*0.1)
		//Overweight	: scaleUserHistory.weight > (stdWeight + stdWeight*0.1) && w < (stdWeight + stdWeight*0.2)
		//Obese			: scaleUserHistory.weight > (stdWeight + stdWeight*0.2)
		
		var w = scaleUserHistory.weight;
		if(w < (stdWeight - stdWeight*0.1)){
			console.log('Thin');
			$("#weightIcon").attr("src","img/weightThin.png"); //change icon img
			$("#weightIcon").attr("data-original-title", "Kurus");
			// thin
		}
		else if(w >= (stdWeight - stdWeight*0.1) && w <= (stdWeight + stdWeight*0.1)){
			console.log('Normal');
			$("#weightIcon").attr("src","img/weightNormal.png"); //change icon img
			$("#weightIcon").attr("data-original-title", "Normal");
			// normal
		}
		else if(w > (stdWeight + stdWeight*0.1) && w <= (stdWeight + stdWeight*0.2)){
			console.log('Overweight');
			$("#weightIcon").attr("src","img/weightOver.png"); //change icon img
			$("#weightIcon").attr("data-original-title", "Berat Berlebihan");
			// overweight
		}
		else if(w > (stdWeight + stdWeight*0.2)){
			console.log('Obese');
			$("#weightIcon").attr("src","img/weightObes.png"); //change icon img
			$("#weightIcon").attr("data-original-title", "Obesity");
			// Obese
		}


		//-------------------------------------------------------------------




		//BMI analysis here!//--------------------------------------------

		
		var anlsBmi = scaleUserHistory.bmi;
		var typeBmi = 0; // use in bmr
		

				
				if( anlsBmi < 18.5){

					$("#bmiIcon").attr("src","img/bmiThin.png"); //change icon img
					$("#bmiIcon").attr("data-original-title", "Kurus");
					
					typeBmi = 1; //low
				}

				else if (  anlsBmi > 18.5   &&  anlsBmi < 24.9){

					$("#bmiIcon").attr("src","img/bmiNormal.png"); //change icon img
					$("#bmiIcon").attr("data-original-title", "Normal");

					typeBmi = 2;  // normal;
				}
				else if (  anlsBmi > 25  && anlsBmi < 29.9){

					$("#bmiIcon").attr("src","img/bmiOver.png"); //change icon img
					$("#bmiIcon").attr("data-original-title", "Berat Badan Berlebihan");
					typeBmi = 3; //high
				}
				else if ( anlsBmi > 30 ) {

					$("#bmiIcon").attr("src","img/bmiObes.png"); //change icon img
					$("#bmiIcon").attr("data-original-title", "Obesity");
					typeBmi = 4;  //obes
				}


		//--------------------------------------------------------------------


		//BMR analysis here!//------ Dependency with bmi -------------------
		// Keep In View
		

		if (typeBmi == 1 ){

			$("#bmrIcon").attr("src","img/bmrThin.png"); //change icon img
			$("#bmrIcon").attr("data-original-title", "Rendah dan Perlu Tambah Jumlah Kalories");
					
		}
		if (typeBmi == 2 ){

			//$("#bmrIcon").removeAttr("data");
			
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




		//--------------------------------------------------------------------

		//Fat analysis here!//--------------------------------------------

		
		var anlsFat = scaleUserHistory.fatRate;
		var jantina = scaleUserHistory.sex;
		var umur    = scaleUserHistory.age;

		if(jantina=='male') {

			if( umur > 19 && umur <= 40 )

				{

						if( anlsFat <= 8 )
						{

							$("#fatIcon").attr("src","img/bodyfatUnder.png"); //change icon img //underfat
							$("#fatIcon").attr("data-original-title", "Rendah");
						}
						else if( anlsFat > 8 && anlsFat <= 19 )
						{

							$("#fatIcon").attr("src","img/bodyfatNormal.png"); //change icon img //healthy
							$("#fatIcon").attr("data-original-title", "Sihat");
							
						}
						else if( anlsFat > 19 && anlsFat <= 25 )
						{

							
							$("#fatIcon").attr("src","img/bodyfatOver.png"); //change icon img //overweight
							$("#fatIcon").attr("data-original-title", "Tinggi");
							
						}

						else if( anlsFat > 25 )
						{

							
							$("#fatIcon").attr("src","img/bodyfatObes.png"); //change icon img //obes
							$("#fatIcon").attr("data-original-title", "Risiko");
						}
				}

			else if( umur > 40 && umur <= 60 )

				{

						if( anlsFat <= 10 )
						{

							$("#fatIcon").attr("src","img/bodyfatUnder.png"); //change icon img //underfat
							$("#fatIcon").attr("data-original-title", "Rendah");
						}
						else if( anlsFat > 10 && anlsFat <= 23 )
						{

							$("#fatIcon").attr("src","img/bodyfatNormal.png"); //change icon img //healthy
							$("#fatIcon").attr("data-original-title", "Sihat");
							
						}
						else if( anlsFat > 23 && anlsFat <= 28 )
						{

							$("#fatIcon").attr("src","img/bodyfatOver.png"); //change icon img //overweight
							$("#fatIcon").attr("data-original-title", "Tinggi");
							
						}

						else if( anlsFat > 28 )
						{

							
							$("#fatIcon").attr("src","img/bodyfatObes.png"); //change icon img //obes
							$("#fatIcon").attr("data-original-title", "Risiko");
						}
				}


				else if( umur > 60 && umur < 80 )

				{

						if( anlsFat <= 14 )
						{

							$("#fatIcon").attr("src","img/bodyfatUnder.png"); //change icon img //underfat
							$("#fatIcon").attr("data-original-title", "Rendah");
						}
						else if( anlsFat > 14 && anlsFat <= 24 )
						{

							$("#fatIcon").attr("src","img/bodyfatNormal.png"); //change icon img //healthy
							$("#fatIcon").attr("data-original-title", "Sihat");
							
						}
						else if( anlsFat > 24 && anlsFat <= 30 )
						{

							$("#fatIcon").attr("src","img/bodyfatOver.png"); //change icon img //overweight
							$("#fatIcon").attr("data-original-title", "Tinggi");
							
						}

						else if( anlsFat > 30 )
						{

							$("#fatIcon").attr("src","img/bodyfatObes.png"); //change icon img
							$("#fatIcon").attr("data-original-title", "Risiko");
								//obes
						}
				}


			}
			//if woman then fat rate is -----
			else {

				if( umur > 19 && umur < 41 )

				{

						if( anlsFat <= 22 )
						{

							$("#fatIcon").attr("src","img/bodyfatUnder.png"); //change icon img //underfat
							$("#fatIcon").attr("data-original-title", "Rendah");
						}
						else if( anlsFat > 22 && anlsFat <= 34 )
						{

							$("#fatIcon").attr("src","img/bodyfatNormal.png"); //change icon img //healthy
							$("#fatIcon").attr("data-original-title", "Sihat");
							
						}
						else if( anlsFat > 34 && anlsFat <= 39 )
						{

							
							$("#fatIcon").attr("src","img/bodyfatOver.png"); //change icon img //overweight
							$("#fatIcon").attr("data-original-title", "Tinggi");
							
						}

						else if( anlsFat > 39 )
						{

							
							$("#fatIcon").attr("src","img/bodyfatObes.png"); //change icon img //obes
							$("#fatIcon").attr("data-original-title", "Risiko");
						}
				}

			else if( umur > 42 && umur < 61 )

				{

						if( anlsFat <= 24 )
						{

							$("#fatIcon").attr("src","img/bodyfatUnder.png"); //change icon img //underfat
							$("#fatIcon").attr("data-original-title", "Rendah");
						}
						else if( anlsFat > 24 && anlsFat <= 35 )
						{

							$("#fatIcon").attr("src","img/bodyfatNormal.png"); //change icon img //healthy
							$("#fatIcon").attr("data-original-title", "Sihat");
							
						}
						else if( anlsFat > 35 && anlsFat <= 40 )
						{

							$("#fatIcon").attr("src","img/bodyfatOver.png"); //change icon img //overweight
							$("#fatIcon").attr("data-original-title", "Tinggi");
							
						}

						else if( anlsFat > 40 )
						{

							
							$("#fatIcon").attr("src","img/bodyfatObes.png"); //change icon img //obes
							$("#fatIcon").attr("data-original-title", "Risiko");
						}
				}


				else if( umur > 60 && umur < 80 )

				{

						if( anlsFat <= 25 )
						{

							$("#fatIcon").attr("src","img/bodyfatUnder.png"); //change icon img //underfat
							$("#fatIcon").attr("data-original-title", "Rendah");
						}
						else if( anlsFat > 25 && anlsFat <= 36 )
						{

							$("#fatIcon").attr("src","img/bodyfatNormal.png"); //change icon img //healthy
							$("#fatIcon").attr("data-original-title", "Sihat");
							
						}
						else if( anlsFat > 36 && anlsFat <= 42 )
						{

							$("#fatIcon").attr("src","img/bodyfatOver.png"); //change icon img //overweight
							$("#fatIcon").attr("data-original-title", "Tinggi");
							
						}

						else if( anlsFat > 42 )
						{

							$("#fatIcon").attr("src","img/bodyfatObes.png"); //change icon img
							$("#fatIcon").attr("data-original-title", "Risiko");
								//obes
						}
				}

			}


		//--------------------------------------------------------------------


		//Visceral fat analysis here!//--------------------------------------------

		
		var anlsVisc = scaleUserHistory.viscFat;
		

				
				if( anlsVisc <= 27){

					$("#viscIcon").attr("src","img/visceralfatThin.png"); //change icon img
					$("#viscIcon").attr("data-original-title", "Rendah");
					//low
				}

				else if (  anlsVisc > 27   &&  anlsVisc <= 53){

					$("#viscIcon").attr("src","img/visceralfatNormal.png"); //change icon img
					$("#viscIcon").attr("data-original-title", "Normal");
					// normal;
				}
				else if (  anlsVisc > 53  && anlsVisc <= 80){

					$("#viscIcon").attr("src","img/visceralfatOver.png"); //change icon img
					$("#viscIcon").attr("data-original-title", "Tinggi");
					//high
				}
				else if ( anlsVisc > 80 ) {

					$("#viscIcon").attr("src","img/visceralfatObes.png"); //change icon img
					$("#viscIcon").attr("data-original-title", "Risiko");

					//obes
				}
				


		//--------------------------------------------------------------------

		//Muscle Mass analysis here!//--------------------------------------------

		
				
		var anlsMuscle = scaleUserHistory.muscle;
		var jantina = scaleUserHistory.sex;
		var umur    = scaleUserHistory.age;

		if(jantina=='male') {

			if( umur > 17 && umur <= 40 )

				{

						if( anlsMuscle <= 33.4 )
						{

							$("#muscleIcon").attr("src","img/musclesmassThin.png"); //change icon img //underfat
							$("#muscleIcon").attr("data-original-title", "Kurang Berotot");
						}
						else if( anlsMuscle > 33.4 && anlsMuscle <= 39.4 )
						{

							$("#muscleIcon").attr("src","img/musclesmassNormal.png"); //change icon img //healthy
							$("#muscleIcon").attr("data-original-title", "Berotot Sederhana");
							
						}
						else if( anlsMuscle > 39.4 && anlsMuscle <= 44.1 )
						{

							
							$("#muscleIcon").attr("src","img/musclesmassOver.png"); //change icon img //overweight
							$("#muscleIcon").attr("data-original-title", "Berotot");
							
						}

						else if( anlsMuscle > 44.1 )
						{

							
							$("#muscleIcon").attr("src","img/musclesmassObes.png"); //change icon img //obes
							$("#muscleIcon").attr("data-original-title", "Sangat Berotot");
						}
				}

			else if( umur > 40 && umur <= 60 )

				{

						if( anlsMuscle <= 33.2 )
						{

							$("#muscleIcon").attr("src","img/musclesmassThin.png"); //change icon img //underfat
							$("#muscleIcon").attr("data-original-title", "Kurang Berotot");

						}
						else if( anlsMuscle > 33.2 && anlsMuscle <= 39.4 )
						{

							$("#muscleIcon").attr("src","img/musclesmassNormal.png"); //change icon img //healthy
							$("#muscleIcon").attr("data-original-title", "Berotot Sederhana");
							
						}
						else if( anlsMuscle > 39.2 && anlsMuscle <= 43.9 )
						{

							$("#muscleIcon").attr("src","img/musclesmassOver.png"); //change icon img //overweight
							$("#muscleIcon").attr("data-original-title", "Berotot");
							
						}

						else if( anlsMuscle > 43.9 )
						{

							
							$("#muscleIcon").attr("src","img/musclesmassObes.png"); //change icon img //obes
							$("#muscleIcon").attr("data-original-title", "Sangat Berotot");
						}
				}


				else if( umur > 60 && umur < 80 )

				{

						if( anlsMuscle <= 33 )
						{

							$("#muscleIcon").attr("src","img/musclesmassUnder.png"); //change icon img //underfat
							$("#muscleIcon").attr("data-original-title", "Kurang Berotot");
						}
						else if( anlsMuscle > 33 && anlsMuscle <= 38.7 )
						{

							$("#muscleIcon").attr("src","img/musclesmassNormal.png"); //change icon img //healthy
							$("#muscleIcon").attr("data-original-title", "Berotot Sederhana");
							
						}
						else if( anlsMuscle > 38.7 && anlsMuscle <= 43.4 )
						{

							$("#muscleIcon").attr("src","img/musclesmassOver.png"); //change icon img //overweight
							$("#muscleIcon").attr("data-original-title", "Berotot");
							
						}

						else if( anlsMuscle > 43.4 )
						{

							$("#muscleIcon").attr("src","img/musclesmassObes.png"); //change icon img
							$("#muscleIcon").attr("data-original-title", "Sangat Berotot");
								//obes
						}
				}


			}
			//if woman then muscles rate is -----
			else {

				if( umur > 17 && umur < 41 )

				{

						if( anlsMuscle <= 24.4 )
						{

							$("#muscleIcon").attr("src","img/musclesmassThin.png"); //change icon img //underfat
							$("#muscleIcon").attr("data-original-title", "Kurang Berotot");
						}
						else if( anlsMuscle > 24.4 && anlsMuscle <= 30.2 )
						{

							$("#muscleIcon").attr("src","img/musclesmassNormal.png"); //change icon img //healthy
							$("#muscleIcon").attr("data-original-title", "Berotot Sederhana");
							
						}
						else if( anlsMuscle > 30.2 && anlsMuscle <= 35.2 )
						{

							
							$("#muscleIcon").attr("src","img/musclesmassOver.png"); //change icon img //overweight
							$("#muscleIcon").attr("data-original-title", "Berotot");
							
						}

						else if( anlsMuscle > 35.3 )
						{
							
							$("#muscleIcon").attr("src","img/musclesmassObes.png"); //change icon img //obes
							$("#muscleIcon").attr("data-original-title", "Sangat Berotot");
						}
				}

			else if( umur > 40 && umur <= 60 )

				{

						if( anlsMuscle <= 24.2 )
						{

							$("#muscleIcon").attr("src","img/musclesmassThin.png"); //change icon img //underfat
							$("#muscleIcon").attr("data-original-title", "Kurang Berotot");
						}
						else if( anlsMuscle > 24.2 && anlsMuscle <= 30.4 )
						{

							$("#muscleIcon").attr("src","img/musclesmassNormal.png"); //change icon img //healthy
							$("#muscleIcon").attr("data-original-title", "Berotot Sederhana");
							
						}
						else if( anlsMuscle > 30.3 && anlsMuscle <= 35.3 )
						{

							$("#muscleIcon").attr("src","img/musclesmassOver.png"); //change icon img //overweight
							$("#muscleIcon").attr("data-original-title", "Berotot");
							
						}

						else if( anlsMuscle > 35.3 )
						{

							
							$("#muscleIcon").attr("src","img/musclesmassObes.png"); //change icon img //obes
							$("#muscleIcon").attr("data-original-title", "Sangat Berotot");
						}
				}


				else if( umur > 60 && umur < 80 )

				{

						if( anlsMuscle <= 24 )
						{

							$("#muscleIcon").attr("src","img/musclesmassThin.png"); //change icon img //underfat
							$("#muscleIcon").attr("data-original-title", "Kurang Berotot");
						}
						else if( anlsMuscle > 24 && anlsMuscle <= 29.8 )
						{

							$("#muscleIcon").attr("src","img/musclesmassNormal.png"); //change icon img //healthy
							$("#muscleIcon").attr("data-original-title", "Berotot Sederhana");
							
						}
						else if( anlsMuscle > 29.8 && anlsMuscle <= 34.8 )
						{

							$("#muscleIcon").attr("src","img/musclesmassOver.png"); //change icon img //overweight
							$("#muscleIcon").attr("data-original-title", "Berotot");
							
						}

						else if( anlsMuscle > 34.8 )
						{

							$("#muscleIcon").attr("src","img/musclesmassObes.png"); //change icon img
							$("#muscleIcon").attr("data-original-title", "Sangat Berotot");
								//obes
						}
				}

			}



		//--------------------------------------------------------------------

		//Bone Mass analysis here!//--------------------------------------------

		
		
		var anlsBone = scaleUserHistory.bone;
		

				
				if( anlsBone <= 5.2 ){

					$("#bonemassIcon").attr("src","img/bonemassThin.png"); //change icon img
					$("#bonemassIcon").attr("data-original-title", "Risiko Osteoporosis");
					//low
				}

				else if (  anlsBone > 5.2   &&  anlsBone < 6 ){

					$("#bonemassIcon").attr("src","img/bonemassNormal.png"); //change icon img
					$("#bonemassIcon").attr("data-original-title", "Normal");
					// normal;
				}
				else if ( anlsBone > 6 ) {

					$("#bonemassIcon").attr("src","img/bonemassObes.png"); //change icon img
					$("#bonemassIcon").attr("data-original-title", "Tinggi");
					//obes
				}


		//--------------------------------------------------------------------

		//Water Content analysis here!//--------------------------------------------

		
		
		var anlsWater = scaleUserHistory.water;
		

				
				if( anlsWater <= 45 ){

					$("#bodywaterIcon").attr("src","img/bodywaterThin.png"); //change icon img
					$("#bodywaterIcon").attr("data-original-title", "Kurang");
					//low
				}

				else if (  anlsWater > 45   &&  anlsWater <= 60 ){

					$("#bodywaterIcon").attr("src","img/bodywaterNormal.png"); //change icon img
					$("#bodywaterIcon").attr("data-original-title", "Normal");
					// normal;
				}
				else if ( anlsWater > 60 ) {

					$("#bodywaterIcon").attr("src","img/bodywaterObes.png"); //change icon img
					$("#bodywaterIcon").attr("data-original-title", "Banyak");
					//obes
				}


		//--------------------------------------------------------------------






		if(debug){
			console.log('scaleReading :devName('+devname+') devid('+devid+') scaleUserHistory('+JSON.stringify(scaleUserHistory)+')');
		}
		var uNAME = $('#sname').val();
		var uAGE = $('#sage').val();

		console.log(uNAME);

		$('#uName').text(uNAME);
		$('#uGender').text(scaleUserHistory.sex);
		$('#uAge').text(uAGE);
		$('#uHeight').text(scaleUserHistory.height);
		$('#uWeight').text(scaleUserHistory.weight);
		$('#uBMR').text(scaleUserHistory.bmr+' kcal');

		gaugeUpdate('cf-gauge-1', {'newVal':scaleUserHistory.weight});
		$('#cf-gauge-1-m').text(scaleUserHistory.weight+ " Kg");

		updateOpts = {'newVal':scaleUserHistory.bmi};
		gaugeUpdate('cf-gauge-2', updateOpts);
		$('#cf-gauge-2-m').text(scaleUserHistory.bmi);

		cf_rSVPs['svp-1'].chart.update(scaleUserHistory.fatRate);
		// Update the data-percent so it redraws on resize properly
		$('#svp-1 .chart').data('percent', scaleUserHistory.fatRate);
		// Update the UI metric
		$('.metric', $('#svp-1')).html(scaleUserHistory.fatRate);

		cf_rSVPs['svp-2'].chart.update(scaleUserHistory.viscFat);
		// Update the data-percent so it redraws on resize properly
		$('#svp-2 .chart').data('percent', scaleUserHistory.viscFat);
		// Update the UI metric
		$('.metric', $('#svp-2')).html(scaleUserHistory.viscFat);

		cf_rSVPs['svp-3'].chart.update(scaleUserHistory.muscle);
		// Update the data-percent so it redraws on resize properly
		$('#svp-3 .chart').data('percent', scaleUserHistory.muscle);
		// Update the UI metric
		$('.metric', $('#svp-3')).html(scaleUserHistory.muscle);

		cf_rSVPs['svp-4'].chart.update(scaleUserHistory.bone);
		// Update the data-percent so it redraws on resize properly
		$('#svp-4 .chart').data('percent', scaleUserHistory.bone);
		// Update the UI metric
		$('.metric', $('#svp-4')).html(scaleUserHistory.bone);

		cf_rSVPs['svp-5'].chart.update(scaleUserHistory.water);
		// Update the data-percent so it redraws on resize properly
		$('#svp-5 .chart').data('percent', scaleUserHistory.water);
		// Update the UI metric
		$('.metric', $('#svp-5')).html(scaleUserHistory.water);
	});



	socket.on('scaleUnitStatus',function(devname,devid,status){
		//status = 'success', 'failed'
		console.log('scaleUnitStatus :devName('+devname+') devid('+devid+') status('+status+')');
		
	});
	socket.on('scaleSetUserInfoStatus',function(devname,devid,status){
		//console.log('scaleSetUserInfoStatus :devName('+devname+') devid('+devid+') status('+status+')');
		//status = 'enull','eIdUsrInfo','eUsrInfo','eId','success','eIdUsr','eUsr','einvalid'
		
		var devId = $('#scaleSelect').find(":selected").text();
		if(!devId.match(new RegExp(devid,'i'))){
			console.log('This data is from '+devid);
			return;
		}
		
		var devUnit = $('#sunit').find(":selected").val();
		socket.emit('scaleSetUnit',devname,devid,devUnit);
	});
	
	socket.on('thermoReading',function(devname,devid,reading){
		/*
			reading={
				'unit':'celcius'@'farenheit'@'undefined',
				'timeStamp': 'true'@'false',
				'type': 'true'@'false'@'undefined',
				'temp':,
				'measure':'armpit'@'body'@'earLobe'@'finger'@'intestinal'@'mouth'@'rectum'@'toe'@'earDrum'@'N/A'
			}
		*/
		//console.log('scaleSetUserInfoStatus :devName('+devname+') devid('+devid+') reading('+JSON.stringify(reading)+')');
		var devId = $('#tempSelect').find(":selected").text();
		if(!devId.match(new RegExp(devid,'i'))){
			console.log('This data is from '+devid);
			return;
		}
		$('#temp').text(parseFloat(reading.temp).toFixed(2));
		if((reading.measure).match(new RegExp('earDrum','i'))){
			$('#tType').text('Ear Drum');
		}

		var uTemp = parseFloat(reading.temp).toFixed(2);		
		gaugeUpdate('cf-gauge-3', {'newVal':uTemp});
		$('#cf-gauge-3-m').text(uTemp);




		//Temperature analysis here!//--------------------------------------------

		var age = $('#sage').val();
		
		if (age <= 12) {


				
				if( uTemp <= 35.79 ){

					$("#celciusIcon").attr("src","img/iconCelciusLow.png"); //change icon img
					$("#celciusIcon").attr("data-original-title", "Hypothermia");
					//low
				}

				else if (  uTemp > 35.80   &&  uTemp <= 38 ){

					$("#celciusIcon").attr("src","img/iconCelciusNormal.png"); //change icon img
					$("#celciusIcon").attr("data-original-title", "Normal");
					// normal;
				}
				else if ( uTemp > 38 ) {

					$("#celciusIcon").attr("src","img/iconCelciusHighFever.png"); //change icon img
					$("#celciusIcon").attr("data-original-title", "Fever/Hyperthermia");
					//obes
				}

		} else
		{

			if( uTemp <= 35 ){

					$("#celciusIcon").attr("src","img/iconCelciusLow.png"); //change icon img
					$("#celciusIcon").attr("data-original-title", "Hypothermia");
					//low
				}

				else if (  uTemp > 36.5   &&  uTemp <= 37.5 ){

					$("#celciusIcon").attr("src","img/iconCelciusNormal.png"); //change icon img
					$("#celciusIcon").attr("data-original-title", "Normal");
					// normal;
				}
				else if (  uTemp > 37.5   &&  uTemp <= 38.3 ){

					$("#celciusIcon").attr("src","img/iconCelciusFever.png"); //change icon img
					$("#celciusIcon").attr("data-original-title", "Fever/Hyperthermia");
					// normal;
				}
				else if ( uTemp > 40 ) {

					$("#celciusIcon").attr("src","img/iconCelciusHighFever.png"); //change icon img
					$("#celciusIcon").attr("data-original-title", "Hyperpyrexia");
					//obes
				}


		}






		//--------------------------------------------------------------------

	});



	socket.on('glucose',function(devname,devid,reading,rdunit){
		//console.log('glucose :devName('+devname+') devid('+devid+') reading('+reading+') unit'+rdunit+')');
		var devId = $('#gluSelect').find(":selected").text();
		if(!devId.match(new RegExp(devid,'i'))){
			console.log('This data is from '+devid);
			return;
		}
		$('#glucose').text(reading+' '+rdunit);
						
	});
	socket.on('cholesterol',function(devname,devid,reading,rdunit){
		//console.log('cholesterol :devName('+devname+') devid('+devid+') reading('+reading+') unit'+rdunit+')');
		var devId = $('#gluSelect').find(":selected").text();
		if(!devId.match(new RegExp(devid,'i'))){
			console.log('This data is from '+devid);
			return;
		}
		$('#cholesterol').text(reading+' '+rdunit);
	});
	socket.on('bpPumpPressure',function(devname,devid,pumpPressure,pUnit){
		//console.log('bpPumpPressure :devName('+devname+') devid('+devid+') reading('+pumpPressure+') unit'+pUnit+')');
		var devId = $('#bpSelect').find(":selected").text();
		if(!devId.match(new RegExp(devid,'i'))){
			console.log('This data is from '+devid);
			return;
		}



		$('#pump').text(pumpPressure);

		gaugeUpdate('cf-gauge-4', {'newVal':pumpPressure});
		$('#cf-gauge-4-m').text(pumpPressure);

	});
	socket.on('bpReading',function(devname,devid,reading){
		//console.log('bpPumpPressure :devName('+devname+') devid('+devid+') reading('+JSON.stringify(reading)+')');
		var devId = $('#bpSelect').find(":selected").text();
		if(!devId.match(new RegExp(devid,'i'))){
			console.log('This data is from '+devid);
			return;
		}


		$('#pump').text('');
		$('#systolic').text(reading.systolic);
		$('#diastolic').text(reading.diastolic);
		$('#pulse').text(reading.pulse);

		//add 5 Oktober by masso

	
		gaugeUpdate('cf-gauge-5', {'newVal':reading.systolic});
		$('#cf-gauge-5-m').text(reading.systolic);

		gaugeUpdate('cf-gauge-6', {'newVal':reading.diastolic});
		$('#cf-gauge-6-m').text(reading.diastolic);
		
		$('#uPulse').text(reading.pulse+' beat');



	});
	
	$("#scanBle").click(function(){
		if($("#scanBle").val()=='START SCAN'){
			socket.emit('startScan');
			$("#scanBle").val('STOP SCAN');
			return;
		}
		if($("#scanBle").val()=='STOP SCAN'){
			socket.emit('stopScan');
			$("#scanBle").val('START SCAN');
			return;
		}
	});
	
	$('#ssetusrbutton').click(function(e) {
        var gender = $('#sgender').find(":selected").val();
		var age = $('#sage').val();
		var height = $('#sheight').val();
		
		var devId = $('#scaleSelect').find(":selected").text();
		if(devId==undefined || age=='' || height==''){
			console.log('Error! @ User info : '+gender+' '+age+' '+height);
			alert('Fill in all the information!');
		}
		else{
			console.log(devId+' @ User info : '+gender+' '+age+' '+height);
			socket.emit('scaleSetUser','F2520   ',devId,gender,age,height);
		}
    });
	
});

var bleConnect = function (obj){
	var devname = $(obj).closest('tr').children('td').eq(0).text();
	var devid	= $(obj).closest('tr').children('td').eq(1).text();
	
	console.log('Checkbox : '+devname+' '+devid);
	if ($(obj).is(':checked')) {
		$(obj).closest('tr').children('td').eq(3).text('Connecting');
		socket.emit('devconnect',devname,devid);
	}
	else{
		$(obj).closest('tr').children('td').eq(3).text('Disconnecting');
		socket.emit('devdisconnect',devname,devid);
	}
	
}