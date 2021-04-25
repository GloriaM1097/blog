$("#estado").change(event => {
	$.get(`/empresa/${event.target.value}/municipio/${event.target.value}`, function(res, estado){
		$("#municipio").empty();
		res.forEach(element => {
			$("#municipio").append(`<option value=${element.idmunicipio}> ${element.nombre_localidad} </option>`);
		});
	});
});