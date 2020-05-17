/**
 * Widget Conversion Javascript.
 * 
 */
( function($) {
	$(document).ready(function(){

	    $("select.currency").change(function(){
	    	var euroValue = $("#euroValue").val();
	        var currValue = $(this).children("option:selected").val();
	        $("#currValue").val(currValue * euroValue);
	    });
	    
	    
	    $('footer').on('click', '#convert', function() {
	    	var euroValue = $("#euroValue").val();
	        var currValue = $("#currValue").val();
	        if(validatenumber(euroValue)){
	        	$("#currValue").val(currValue * euroValue);
	        } else {
	        	alert("Please enter a valid number");
	        }
	    })
	      
		$("select.currency").change();
	});
} )( jQuery );



function validatenumber(number) {
    var re = /^[-+]?[0-9]+\.[0-9]+$/;
    var re2 = /^[0-9]*$/;
    number = number.toString();
    var found = number.match(re) || number.match(re2);
    return found;
}