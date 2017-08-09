$('#button').click(function(){
	var name=$('#name').val();
	
	$.ajax({
		url:'del.php',
		data: 'name='+name,
		success:function(data){
			$('#content').html(data);
		}
	});
	
});