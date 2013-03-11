
		var likeval=0;
		var unlikeval=0;

			$(document).ready(function(){
		    $('#yea').click(function() {
			likeval++;
			$('#yea').button(
			$.ajax({    

    type : "POST",
    cache: false,  
    url : "vote.php",

    data:{
        likeval:likeval
		//unlikeval:unlikeval
    },
    success: function() {   
    },
    error : function() {//en cas de problème de requete AJAX
        alert("Sorry, The requested property could not be found.");//affichage d'un mesage d'erreur
    }
});
			
		    alert(likeval);
			$('[type="button"]').button('disable'); 
		});
 $('#nay').click(function() {
			unlikeval++;
		    alert(unlikeval);
			$.ajax({    

    type : "POST",
    cache: false, 

    url : "vote.php",
    data:{
        unlikeval:unlikeval
		//likeval:likeval
    },
    success: function() {   
    },
    error : function() {//en cas de problème de requete AJAX
        alert("Sorry, The requested property could not be found.");//affichage d'un mesage d'erreur
    }
});
		});
				 

		});

