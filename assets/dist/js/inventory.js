$(document).ready(function () {

	// ------------------------------------------------------------------------------------------
	// start
	// ------------------------------------------------------------------------------------------
	var root = window.location.origin + '/aydin-tasci/';

	$('#faktor').change(function(){
		var id=$(this).val();
		var html = '';
		$.ajax({
			url : root+"PertanyaanController/get_subfaktor/"+id,
			method : "POST",
			data : {id: id},
			async : false,
			dataType : 'json',
			success: function(data){
				console.log(data);
				if (data.length == null){
					html += '<option selected disabled>- Pilih Subfaktor -</option>';
				} else {
					var i;
					for(i=0; i<data.length; i++){
						html += '<option value='+data[i].subfaktor_id+'>'+data[i].subfaktor_nama+'</option>';
					}
				}

			}, error: function (data) {
			}
		});
		$('#subfaktor').html(html);
	});
});
