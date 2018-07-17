<html>
<body onload="state_view()">
<script src="api/jquery.js"></script>
<script
src="https://maps.googleapis.com/maps/api/js?key= AIzaSyBRQENDfvKwn-S5ZO2Ulb2v_3nmEty0Tf8">
</script>
<script>
function view_map(lat,lon)
{
	document.getElementById("googleMap").style.visibility="visible";
var mapOpt = {
   center:new google.maps.LatLng(lat,lon),
  zoom:14,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  /*
HYBRID		Displays a photographic map + roads and city names
ROADMAP		Displays a normal, default 2D map
SATELLITE	Displays a photographic map
TERRAIN		Displays a map with mountains, rivers, etc.
*/
  };
var map=new google.maps.Map(document.getElementById("googleMap"),mapOpt);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
<script>
function state_view()
{

	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("dist").innerHTML=this.responseText ;
			}
            }
	xmlhttp.open("GET", "view.php", true);
    xmlhttp.send();
	document.getElementById('dist').focus();
}
function dist_view(val)
{

	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("taluk").innerHTML=this.responseText ;
				}
            }
	xmlhttp.open("GET", "view2.php?dist="+val, true);
    xmlhttp.send();
}
function taluk_view(val)
{

	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("village").innerHTML=this.responseText ;
			}
            }
	xmlhttp.open("GET", "view3.php?taluk="+val, true);
    xmlhttp.send();
}
function village_view(val)
{

	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("pin").innerHTML=this.responseText ;
			}
            }
	xmlhttp.open("GET", "view4.php?village="+val, true);
    xmlhttp.send();
	landmark(val);
}
function landmark(val)
{

	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var latlong=this.responseText.split("\t");
			document.getElementById("lat").innerHTML="Latitude :"+latlong[0];
			document.getElementById("lon").innerHTML="Longitude :"+latlong[1];
			document.getElementById("landmark").style.visibility='visible';
			view_map(latlong[0],latlong[1]);
			}
            }
	xmlhttp.open("GET", "view5.php?village="+val, true);
    xmlhttp.send();
}
function search()
{

	var xmlhttp=new XMLHttpRequest();
	
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var line=this.responseText.split("\t\t\t\t");
			var text="";
			for(var i=0;i<line.length-1;i++)
			{
				var str=line[i].split("\t\t");
				str1=str[0]+" , "+str[1]+" , "+str[2]+" , "+str[3];
				str2="<input type='button' value='view' onclick=\"set('"+str1+"')\" />";
				text+="<label>"+str2+str1+"</label><br />";
			}
			//alert(text);
			document.getElementById("res").style.display="contents";
			document.getElementById("search_res").innerHTML=text;
			}
            }
			var village=document.getElementById("vil").value;
			var dist=document.getElementById("dist").value;
	xmlhttp.open("GET", "search.php?dist="+dist+"&village="+village, true);
    xmlhttp.send();
}
function set(v)
{
	var val=v.split(" , ");	
	taluk_view(val[1]);
	setTimeout(function(){ document.getElementById("village").value=val[2]; $('#village').trigger( "change" ); }, 2000);
	document.getElementById("taluk").value=val[1];
	document.getElementById("pin").innerHTML=val[3];
}
</script>
<style>
table td,th{padding:5px 15px 5px 15px;}
table,td,th{border:solid 1px silver;}
select{border:none;text-align:center;}
</style>
<table>
	<tr>
		<th>Select District</th>
		<th>Select taluk</th>
		<th>Select village</th>
		<th>Pincode is</th>	
		<th>Search village in current District</th>	
	</tr>
	<tr>
		<td>
			<select id='dist' onchange="dist_view(this.value);document.getElementById('taluk').focus();" onmouseup="dist_view(this.value);">
			</select>
		</td>
		<td>
			<select id='taluk' onchange="taluk_view(this.value);" onmouseup="taluk_view(this.value);">
			<option>select</option>
			</select>
		</td>
		<td>
			<select id='village' onchange="village_view(this.value);" onmouseup="village_view(this.value)">
			<option>select</option>
			</select>
		</td>
		<td><b id="pin"></b></td>
		<td>
			<input type="text" id="vil" value="" placeholder="Village" />
			<input type="button" value="search" onclick="search()" />
		</td>
	</tr>
	<tr id="landmark" style="visibility:hidden;">
		<td colspan='2' id="lat"></td>
		<td colspan='3' id="lon"></td>
	</tr>
	<tr id="res" style="display:none">
		<td colspan='5' id="search_res"></td>
	</tr>
	<tr>	
		<td colspan='5'><div id="googleMap" style="height:500px;width:100%;border:solid silver 2px;visibility:hidden;"></div></td>
	</tr>
</table>
</body>
</html>