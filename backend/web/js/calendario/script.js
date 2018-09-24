$(document).ready(function(){
	$('#dataInicio').focus(function(){
		$(this).calendario({ 
			target:'#dataInicio',
			closeClick:true
		});
	});
	
	$('#dataTermino').focus(function(){
		$(this).calendario({ 
			target:'#dataTermino',
			closeClick:true
		});
	});
});