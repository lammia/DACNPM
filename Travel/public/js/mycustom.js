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
		   	data.districts.map(item => {
		   	 	$("#selectDistrict").append(`<option value=${item.idDistrict}>${item.name}</option>`);

		   	});

	   		$("#selectVillage").empty();
		   	data.villages.map(item => {
		   		$("#selectVillage").append(`<option value=${item.idVillage}>${item.name}</option>`);
		   	});

	   	},
	   	type: 'GET'
	});
})

$('#selectDistrict').on("change", function(e){
	let val = $(this).find("option:selected").val();
	$.ajax({
	   	url: '/api/get-villages',
	   	data: {
	      format: 'json',
	      idDistrict: val,
	   	},
	   	success: function(data) {

	   		$("#selectVillage").empty();
		   	data.map(item => {
		   		$("#selectVillage").append(`<option value=${item.idVillage}>${item.name}</option>`);
		   	});

	   	},
	   	type: 'GET'
	});
})

$('#selectPlace').on("change", function(e){
	let val = $(this).find("option:selected").val();
	$.ajax({
	   	url: '/api/get-events',
	   	data: {
	      format: 'json',
	      idPlace: val,
	   	},
	   	success: function(data) {

	   		$("#selectEvent").empty();
		   	data.map(item => {
		   		$("#selectEvent").append(`<option value=${item.idEvent}>${item.nameEvent}</option>`);
		   	});

	   	},
	   	type: 'GET'
	});
})