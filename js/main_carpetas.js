$(document).ready(function () {
	$('#tablaCarpetas tfoot th').each(function () {
		var title = $(this).text();
		$(this).html('<input type="text" style="width: 98px" placeholder="' + title + '" />');
	});

	indica = $.trim($("#gestor").val());
	if (indica == "1") {
		var tablaCarpetas = $("#tablaCarpetas").dataTable({
			"responsive": true,
			"dom": 'Bfrtilp',
			"buttons": [{
					extend: 'excelHtml5',
					text: '<i class="fa fa-file-excel"></i>',
					titleAttr: 'Exportar a excel',
					className: 'btn btn-success'
				},
				{
					extend: 'pdfHtml5',
					text: '<i class="fa fa-file-pdf"></i>',
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
	}
	if (indica == "2") {
		var tablaCarpetas = $("#tablaCarpetas").dataTable({
			"responsive": true,
			"dom": 'Bfrtilp',
			"buttons": [{
					extend: 'excelHtml5',
					text: '<i class="fa fa-file-excel"></i>',
					titleAttr: 'Exportar a excel',
					className: 'btn btn-success'
				},
				{
					extend: 'pdfHtml5',
					text: '<i class="fa fa-file-pdf"></i>',
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
				"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'><i class='icono1 fas fa-pencil-alt'></i> Editar</div></div>"
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
	}
	if (indica == "3") {
		var tablaCarpetas = $("#tablaCarpetas").dataTable({
			"responsive": true,
			"dom": 'Bfrtilp',
			"buttons": [{
					extend: 'excelHtml5',
					text: '<i class="fa fa-file-excel"></i>',
					titleAttr: 'Exportar a excel',
					className: 'btn btn-success'
				},
				{
					extend: 'pdfHtml5',
					text: '<i class="fa fa-file-pdf"></i>',
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
	}

	tablaCarpetas.api().columns().every(function () {
		var that = this;

		$('input', this.footer()).on('keyup change', function () {
			if (that.search() !== this.value) {
				that.search(this.value).draw();
			}
		});
	});

	$('#btnNuevo').click(function () {
		$.ajax({
				url: './lista_cajas.php'
			})
			.done(function (ListaCajas) {
				$('#lista_cajas').html(ListaCajas);
			})
			.fail(function () {
				alert('Hubo un error al cargar las Cajas !');
			});
	});

	$("#btnNuevo").click(function () {
		$("#formCarpetas").trigger("reset");
		$(".modal-header").css("background-color", "#28a745");
		$(".modal-header").css("color", "white");
		$(".modal-title").text("Nueva Carpeta");
		$("#modalCRUD").modal("show");
		id = null;
		opcion = 1; //alta
	});

	var fila; //capturar la fila para editar o borrar el registro

	//botón EDITAR    
	$(document).on("click", ".btnEditar", function () {
		fila = $(this).closest("tr");
		id = parseInt(fila.find('td:eq(0)').text());
		serial = fila.find('td:eq(1)').text();

		$("#id_carpeta").val(id);
		$("#codigo_carpeta").val(serial);
		opcion = 2; //editar
		$(".modal-header").css("background-color", "#007bff");
		$(".modal-header").css("color", "white");
		$(".modal-title").text("Editar Carpeta");
		$("#modalCRUD").modal("show");
		$.ajax({
				url: './lista_cajas.php'
			})
			.done(function (ListaCajas) {
				$('#lista_cajas').html(ListaCajas);
			})
			.fail(function () {
				alert('Hubo un error al cargar las Cajas !');
			});

	});

	//botón BORRAR
	$(document).on("click", ".btnBorrar", function () {
		fila = $(this);
		id = parseInt($(this).closest("tr").find('td:eq(0)').text());
		serial = $(this).closest("tr").find('td:eq(1)').text();
		opcion = 3; //borrar
		var respuesta = confirm("¿Está seguro de eliminar el registro: " + serial + " ?");
		if (respuesta) {
			$.ajax({
				url: "cruds/crud_carpetas.php",
				type: "POST",
				dataType: "json",
				data: {
					opcion: opcion,
					id: id
				},
				success: function () {
					tablaCarpetas.row(fila.parents('tr')).remove().draw();
				}
			});
		}

		function recargar() {
			location.reload();
		}
		setTimeout(recargar, 800);
	});

	$("#formCarpetas").submit(function (e) {
		e.preventDefault();
		id = $.trim($("#id_carpeta").val());
		serial = $.trim($("#codigo_carpeta").val());
		caja = $.trim($("#lista_cajas").val());
		$.ajax({
			url: "cruds/crud_carpetas.php",
			type: "POST",
			dataType: "json",
			data: {
				id: id,
				serial: serial,
				caja: caja,
				opcion: opcion
			},
			success: function (data) {
				console.log(data);
				id = data[0].id;
				serial = data[0].serial;
				caja = data[0].caja;
				if (opcion == 1) {
					tablaCarpetas.row.add([id, serial, caja]).draw();
				} else {
					tablaCarpetas.row(fila).data([id, serial, caja]).draw();
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