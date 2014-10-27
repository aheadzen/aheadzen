<?php 
/*
Template Name: Ask Oracle App
*/
?>
<!DOCTYPE html>
<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type='text/javascript' src='http://www.ask-oracle.com/charts/api.php?dt=2014-03-01T15%3A00%3A00%2B02%3A00'></script>
<script>
jQuery("button").click(function(){
  jQuery("#div1").load("http://www.ask-oracle.com/charts/api.php?dt=2014-03-01T15%3A00%3A00%2B02%3A00");
}); 
/*
jQuery(document).ready(function(){
  jQuery("button").click(function(){
    jQuery.get("http://www.ask-oracle.com/charts/api.php?dt=2014-03-01T15%3A00%3A00%2B02%3A00",function(data,status){
      alert("Data: " + data + "\nStatus: " + status);
    });
  });
});


var d = new Date();
var n = d.toJSON();
*/
</script>
</head>
<body>

<button>Send an HTTP GET request to a page and get the result back</button>

</body>
</html>