$('#selectProvince').on("change", function(e){
	let val = $(this).find("option:selected").val();
	$.ajax({
	   	url: '/api/get-districts',
	   	data: {
	      format: 'json',
	      idProvince: val,
	   	},
	   	success: function(data) {
	   		$("#selectDistrict").empty();
		   	data.map(item => {
		   		$("#selectDistrict").append(`<option value=${item.idDistrict}>${item.name}</option>`);
		   	});
	   	},
	   	type: 'GET'
	});
})