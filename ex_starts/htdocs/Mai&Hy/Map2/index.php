<!DOCTYPE html>
<html>
<head>
<title>Google Map</title>
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC36_7UgebMpuDqgO6MLlv4uZE7HODNZQU&sensor=false"></script>
<script type="text/javascript">

//initialize map
$(document).ready(function() {

	var mapCenter = new google.maps.LatLng(39.9566127,-75.1899441); 
	var map;
	
	map_initialize();
	
	
	function map_initialize()
	{
			var googleMapOptions = 
			{ 
				center: mapCenter, // map center
				zoom: 15, 
				maxZoom: 20,
				minZoom: 10,
				zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL 
			},
				scaleControl: true, 
				mapTypeId: google.maps.MapTypeId.ROADMAP 
			};
		
		   	map = new google.maps.Map(document.getElementById("google_map"), googleMapOptions);			
			

			$.get("controller.php", function (data) {
				$(data).find("marker").each(function () {
					  var name 		= $(this).attr('name');
					  var address 	= '<p>'+ $(this).attr('address') +'</p>';
					  var type 		= $(this).attr('type');
					  var point 	= new google.maps.LatLng(parseFloat($(this).attr('lat')),parseFloat($(this).attr('lng')));
					  create_marker(point, name, address, false, false, false, "http://localhost/Map2/icon/pin_blue.png");
				});
			});	
			
			//Add new  marker
			google.maps.event.addListener(map, 'click', function(event) {
				//Edit form to be displayed with new marker
				var EditForm = '<p><div class="marker-edit">'+
				'<form action="ajax-save.php" method="POST" name="SaveMarker" id="SaveMarker">'+
				'<label for="pName"><span>Place Name :</span><input type="text" name="pName" class="save-name" placeholder="Enter Title" maxlength="40" /></label>'+
				'<label for="pDesc"><span>Description :</span><textarea name="pDesc" class="save-desc" placeholder="Enter Address" maxlength="150"></textarea></label>'+
				'<label for="pType"><span>Type :</span> <select name="pType" class="save-type"><option value="restaurant">Restaurant</option><option value="bar">Bar</option>'+
				'<option value="house">House</option><option value="school">School</option><option value="parking">Parking Lot</option></select></label>'+
				'</form>'+
				'</div></p><button name="save-marker" class="save-marker">Save Marker Details</button>';

				
				create_marker(event.latLng, 'New Marker', EditForm, true, true, true, "http://localhost/Map2/icon/pin_green.png");
			});
										
	}
	

	function create_marker(MapPos, MapTitle, MapDesc,  InfoOpenDefault, DragAble, Removable, iconPath)
	{	  	  		  
		
		//new marker
		var marker = new google.maps.Marker({
			position: MapPos,
			map: map,
			draggable:DragAble,
			animation: google.maps.Animation.DROP,
			title:"Hello World!",
			icon: iconPath
		});
		
		//Content structure of info Window for the Markers
		var contentString = $('<div class="marker-info-win">'+
		'<div class="marker-inner-win"><span class="info-content">'+
		'<h1 class="marker-heading">'+MapTitle+'</h1>'+
		MapDesc+ 
		'</span><button name="remove-marker" class="remove-marker" title="Remove Marker">Remove Marker</button>'+
		'</div></div>');	

		
		//Create an infoWindow
		var infowindow = new google.maps.InfoWindow();
		//set the content of infoWindow
		infowindow.setContent(contentString[0]);

		//Find remove button in infoWindow
		var removeBtn 	= contentString.find('button.remove-marker')[0];
		var saveBtn 	= contentString.find('button.save-marker')[0];

		//add click listner to remove marker button
		google.maps.event.addDomListener(removeBtn, "click", function(event) {
			remove_marker(marker);
		});
		
		if(typeof saveBtn !== 'undefined') //continue only when save button is present
		{
			//add click listner to save marker button
			google.maps.event.addDomListener(saveBtn, "click", function(event) {
				var mReplace = contentString.find('span.info-content'); //html to be replaced after success
				var mName = contentString.find('input.save-name')[0].value; //name input field value
				var mDesc  = contentString.find('textarea.save-desc')[0].value; //description input field value
				var mType = contentString.find('select.save-type')[0].value; //type of marker
				
				if(mName =='' || mDesc =='')
				{
					alert("Please enter Name and Description!");
				}else{
					save_marker(marker, mName, mDesc, mType, mReplace); //call save marker function
				}
			});
		}
		
		//add click listner to save marker button		 
		google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map,marker); // click on marker opens info window 
	    });
		  
		if(InfoOpenDefault) //whether info window should be open by default
		{
		  infowindow.open(map,marker);
		}
	}
	
	//remove marker
	function remove_marker(Marker)
	{
		
	//if markers are draggable, delete on the map only
		if(Marker.getDraggable()) 
		{
			Marker.setMap(null); 
		}
	//if markers are not draggable, delete from the database too.	
		else
		{
			
			var mLatLang = Marker.getPosition().toUrlValue();
			var myData = {del : 'true', latlang : mLatLang}; 
			$.ajax({
			  type: "POST",
			  url: "controller.php",
			  data: myData,
			  success:function(data){
					Marker.setMap(null); 
					alert(data);
				},
				error:function (xhr, ajaxOptions, thrownError){
					alert(thrownError); 
				}
			});
		}

	}
	
	//save marker
	function save_marker(Marker, mName, mAddress, mType, replaceWin)
	{
	
		var mLatLang = Marker.getPosition().toUrlValue();
		var myData = {name : mName, address : mAddress, latlang : mLatLang, type : mType }; 
		console.log(replaceWin);		
		$.ajax({
		  type: "POST",
		  url: "controller.php",
		  data: myData,
		  success:function(data){
				replaceWin.html(data); 
				Marker.setDraggable(false); 
				Marker.setIcon('http://localhost/Map2/icon/pin_blue.png'); 
            },
            error:function (xhr, ajaxOptions, thrownError){
                alert(thrownError); 
            }
		});
	}

});
</script>

<style type="text/css">
h1.heading{padding:0px;margin: 0px 0px 10px 0px;text-align:center;font: 18px Georgia, "Times New Roman", Times, serif;}
body {
    background-image: url("background/map3.jpg");
    background-color: #cccccc;
}
/* width and height of google map */
#google_map {width: 90%; height: 800px;margin-top:20px;margin-left:auto;margin-right:auto;}

/* Marker Edit form */
.marker-edit label{display:block;margin-bottom: 5px;}
.marker-edit label span {width: 120px;float: left;}
.marker-edit label input, .marker-edit label select{height: 24px;}
.marker-edit label textarea{height: 60px;}
.marker-edit label input, .marker-edit label select, .marker-edit label textarea {width: 60%;margin:0px;padding-left: 5px;border: 1px solid #DDD;border-radius: 3px;}

/* Marker Info Window */
h1.marker-heading{color: #585858;margin: 0px;padding: 0px;font: 18px "Trebuchet MS", Arial;border-bottom: 1px dotted #D8D8D8;}
div.marker-info-win {max-width: 300px;margin-right: -20px;}
div.marker-info-win p{padding: 0px;margin: 10px 0px 10px 0;}
div.marker-inner-win{padding: 5px;}
button.save-marker, button.remove-marker{border: none;background: rgba(0, 0, 0, 0);color: #00F;padding: 0px;text-decoration: underline;margin-right: 10px;cursor: pointer;
}
</style>
</head>
<body>             
<h1 class="heading">Google Map</h1>
<div align="center">Click on the Map for New Marker</div>
<div id="google_map"></div>
</body>
</html>