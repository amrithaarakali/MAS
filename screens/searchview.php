<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
    <title>jQuery Mobile Tutorial on Codeforest.net</title>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.css" />
    <script src="http://code.jquery.com/jquery-1.4.3.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.js"></script>
	<script>
	

var likeval=0;

	$(document).ready(function(){
   	$("#verify").onclick(function () {
 
         //$("#myDiv").fadeIn("slow");
         likeval++;
		  alert('Button has been clicked');
		 

});

</script>
	
</head>
<body> 
<!-- Home -->
<div data-role="page" id="page1">
    <div data-theme="c" data-role="header">
<input
    type="button"
    name="verify"
    id="verify"
    data-icon="plus" 
    data-iconpos="right" 
    data-theme="a" 
    value="Yay!" />
        <h3>
            Route
        </h3>
    </div>
    <div data-role="content">
    </div>
</div>
</body>
</html>