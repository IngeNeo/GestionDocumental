$(document).ready(function () {
	$('#tablaEstantes tfoot th').each(function () {
		var title = $(this).text();
		$(this).html('<input type="text" style="width: 98px" placeholder="'+ title +'" />');
	});
	var	tablaEstantes = $("#tablaEstantes").dataTable({
		"responsive": true,
		"dom": 'Bfrtilp',
		"buttons": [{
				extend: 'excelHtml5',
				text: '<i class="fa fa-file-excel-o"></i>',
				titleAttr: 'Exportar a excel',
				className: 'btn btn-success'
			},
			{
				extend: 'pdfHtml5',
				text: '<i class="fa fa-file-pdf-o"></i>',
				titleAttr: 'Exportar a Pdf',
				className: 'btn btn-danger'
			},
			{
				extend: 'csvHtml5',
				text: '<i class="fa fa-file-alt"></i>',
				titleAttr: 'Exportar a CSV',
				className: 'btn btn-info'
			}
		],
		"columnDefs": [{
			"targets": -1,
			"data": null,
			"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'><i class='icono1 fas fa-pencil-alt'></i> Editar</button><button class='btn btn-danger btnBorrar'><i class='icono1 fas fa-minus-circle'></i> Borrar</button></div></div>"
		}],

		//Para cambiar el lenguaje a español
		"language": {
			"lengthMenu": "Mostrar _MENU_ registros",
			"zeroRecords": "No se encontraron resultados",
			"info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"infoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sSearch": "Buscar:",
			"oPaginate": {
				"sFirst": "Primero",
				"sLast": "Último",
				"sNext": "Siguiente",
				"sPrevious": "Anterior"
			},
			"sProcessing": "Procesando...",
		}
	});

	tablaEstantes.api().columns().every(function () {
		var that = this;

		$('input', this.footer()).on('keyup change', function () {
			if (that.search() !== this.value) {
				that.search(this.value).draw();
			}
		});
	});

	$('#btnNuevo').click(function () {
		$.ajax({
				url: './lista_bodegas.php'
			})
			.done(function (ListaBodegas) {
				$('#lista_bodegas').html(ListaBodegas);
			})
			.fail(function () {
				alert('Hubo un error al cargar las Bodegas !');
			});
	});

	$("#btnNuevo").click(function () {
		$("#formEstantes").trigger("reset");
		$(".modal-header").css("background-color", "#28a745");
		$(".modal-header").css("color", "white");
		$(".modal-title").text("Nuevo Estante");
		$("#modalCRUD").modal("show");
		id = null;
		opcion = 1; //alta
	});

	var fila; //capturar la fila para editar o borrar el registro

	//botón EDITAR    
	$(document).on("click", ".btnEditar", function () {
		fila = $(this).closest("tr");
		id = parseInt(fila.find('td:eq(0)').text());
		cara = fila.find('td:eq(1)').text();
		modulo = fila.find('td:eq(2)').text();	
		piso = fila.find('td:eq(3)').text();	
		entrepano = fila.find('td:eq(4)').text();	
		
		$("#id_estante").val(id);
		$("#cara").val(cara);
		$("#modulo").val(modulo);
		$("#piso").val(piso);
		$("#entrepano").val(entrepano);

		opcion = 2; //editar
		$(".modal-header").css("background-color", "#007bff");
		$(".modal-header").css("color", "white");
		$(".modal-title").text("Editar Estante");
		$("#modalCRUD").modal("show");
		$.ajax({
			url: './lista_bodegas.php'
		})
		.done(function (ListaBodegas) {
			$('#lista_bodegas').html(ListaBodegas);
		})
		.fail(function () {
			alert('Hubo un error al cargar las bodegas  !');
		});

	});

	//botón BORRAR
	$(document).on("click", ".btnBorrar", function () {
		fila = $(this);
		id = parseInt($(this).closest("tr").find('td:eq(0)').text());
		opcion = 3; //borrar
		var respuesta = confirm("¿Está seguro de eliminar el registro: " + id + " ?");
		if (respuesta) {
			$.ajax({
				url: "cruds/crud_estantes.php",
				type: "POST",
				dataType: "json",
				data: {
					opcion: opcion,
					id: id
				},
				success: function () {
					tablaEstantes.row(fila.parents('tr')).remove().draw();
				}
			});
		}

		function recargar() {
			location.reload();
		}
		setTimeout(recargar, 800);
	});

	$("#formEstantes").submit(function (e) {
		e.preventDefault();
		id = $.trim($("#id_estante").val());
		cara = $.trim($("#cara").val());
		modulo = $.trim($("#modulo").val());
		piso = $.trim($("#piso").val());
		entrepano = $.trim($("#entrepano").val());
		bodega = $.trim($("#lista_bodegas").val());
		$.ajax({
			url: "cruds/crud_estantes.php",
			type: "POST",
			dataType: "json",
			data: {
				id: id,
				cara: cara,
				modulo: modulo,
				piso: piso,
				entrepano: entrepano,
				bodega: bodega,
				opcion: opcion
			},
			success: function (data) {
				console.log(data);
				id = data[0].id;
				cara = data[0].cara;
				modulo = data[0].modulo;
				piso = data[0].piso;
				entrepano = data[0].entrepano;
				bodega = data[0].bodega;
				if (opcion == 1) {
					tablaEstantes.row.add([id, cara, modulo, piso, estrepano, bodega]).draw();
				} else {
					tablaEstantes.row(fila).data([id, cara, modulo, piso, estrepano, bodega]).draw();
				}
			}
		});
		$("#modalCRUD").modal("hide");

		function recargar() {
			location.reload();
		}
		setTimeout(recargar, 800);
	});

});