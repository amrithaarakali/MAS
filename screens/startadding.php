<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
    <title>jQuery Mobile Tutorial on Codeforest.net</title>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.css" />
    <script src="http://code.jquery.com/jquery-1.4.3.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.0a1/jquery.mobile-1.0a1.min.js"></script>

	<script>
	
	
	$(document).ready(function(){
   	$("#aa").mouseenter(function () {
 
         //$("#myDiv").fadeIn("slow");
         $("#aa").css("color","white");

});
var likeval=0;

	$(document).ready(function(){
   	$("#ab").onclick(function () {
 
         //$("#myDiv").fadeIn("slow");
         likeval++;
		 

});
var Input = $('input[name=dest]');
    var default_value = Input.val();

    Input.focus(function() {
        if(Input.val() == default_value) Input.val("");
    }).blur(function(){
        if(Input.val().length == 0) Input.val(default_value);
    });
	
	
});
</script>
</head>
<body> 
<!-- Home -->
<div data-role="page" id="page1">
    <div data-role="content">
        <div data-role="fieldcontain">
            <fieldset data-role="controlgroup">
                <label for="dest">
                </label>
                <input name="dest"  placeholder="" value="Enter the destination"
                type="text" onclick="this.value=''" >
				<input name="source"  placeholder="" value="Enter the start locaion"
                type="text" onfocus="this.value=''">
            </fieldset>
        </div>
		
        <a  id="ab" data-role="button" rel="external" href="routing.php">
            Start
        </a>
		
        <a data-role="button" rel="external" href="homepage.html">
            Cancel
        </a>
    </div>
</div>

</body>
</html>