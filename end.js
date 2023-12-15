$(function(){
	"use strict";

	$("[placeholder]").focus( function(){
		$(this).attr('data-text',$(this).attr("placeholder"));
		$(this).attr('placeholder',"");


		}).blur(function(){
		$(this).attr('placeholder',$(this).attr("data-text"));

		});


		$('input').each(function() {
if ($(this).attr('required') =='required'){///===
	$(this).after('<span class="asterisk"> *</span>');
}
});
var passfield = $('.password');
$('.show-pas').hover(function(){ 
 passfield.attr('type','text');

}, function(){ 
 passfield.attr('type','password');
});

console.log("h");
	
$(".confirm").click( function(){
return confirm('are you sure baby?');
});

});



