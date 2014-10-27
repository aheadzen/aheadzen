<?php 
/*
Template Name: Ask Oracle App
*/
?>
<!DOCTYPE html>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
var d = new Date();
var jsondt = d.toJSON();
var ajaxurl = "http://www.ask-oracle.com/charts/api.php?dt="+jsondt;
jQuery.get( ajaxurl, function( data ) {
	jQuery( ".result" ).html( data );
	alert( "Load was performed." );
});


/*
$(document).ready(function(){
  $("button").click(function(){
	
	$("#div1").load("http://www.ask-oracle.com/charts/api.php?dt=2014-03-01T15%3A00%3A00%2B02%3A00",function(responseTxt,statusTxt,xhr){
      if(statusTxt=="success")
        alert("External content loaded successfully!");
      if(statusTxt=="error")
        alert("Error: "+xhr.status+": "+xhr.statusText);
    });
  });
});
*/
</script>
</head>
<body>
<h2>Result will display here</h2>
<div class="result"></div>

</body>
</html>
