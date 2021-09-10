$(document).ready(function () {
	$('#tablaFolios tfoot th').each(function () {
		var title = $(this).text();
		$(this).html('<input type="text" style="width: 98px" placeholder="' + title + '" />');
	});

	indica = $.trim($("#gestor").val());
	if (indica == "1") {
		var tablaFolios = $("#tablaFolios").dataTable({
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
		var tablaFolios = $("#tablaFolios").dataTable({
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
		var tablaFolios = $("#tablaFolios").dataTable({
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

	tablaFolios.api().columns().every(function () {
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

	$('#lista_cajas').on('change', function () {
		var caja = $('#lista_cajas').val();
		$.ajax({
				type: "POST",
				url: './lista_carpetas.php',
				data: {
					'caja': caja
				}
			})
			.done(function (ListaCarpeta) {
				$('#lista_carpetas').html(ListaCarpeta);
			})
			.fail(function () {
				alert('Hubo un error al cargar las Carpetas !');
			});
	});

	$("#btnNuevo").click(function () {
		$("#formFolios").trigger("reset");
		$(".modal-header").css("background-color", "#28a745");
		$(".modal-header").css("color", "white");
		$(".modal-title").text("Nuevo Folio");
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
		descripcion = fila.find('td:eq(2)').text();

		$("#id_folio").val(id);
		$("#codigo_folio").val(serial);
		$("#desc_folio").val(descripcion);

		opcion = 2; //editar
		$(".modal-header").css("background-color", "#007bff");
		$(".modal-header").css("color", "white");
		$(".modal-title").text("Editar Folio");
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
		$('#lista_cajas').on('change', function () {
			var caja = $('#lista_cajas').val();
			$.ajax({
					type: "POST",
					url: './lista_carpetas.php',
					data: {
						'caja': caja
					}
				})
				.done(function (ListaCarpeta) {
					$('#lista_carpetas').html(ListaCarpeta);
				})
				.fail(function () {
					alert('Hubo un error al cargar las Carpetas !');
				});
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
				url: "cruds/crud_folios.php",
				type: "POST",
				dataType: "json",
				data: {
					opcion: opcion,
					id: id
				},
				success: function () {
					tablaFolios.row(fila.parents('tr')).remove().draw();
				}
			});
		}

		function recargar() {
			location.reload();
		}
		setTimeout(recargar, 800);
	});

	$("#formFolios").submit(function (e) {
		e.preventDefault();
		id = $.trim($("#id_folio").val());
		serial = $.trim($("#codigo_folio").val());
		descripcion = $.trim($("#desc_folio").val());
		carpeta = $.trim($("#lista_carpetas").val());
		$.ajax({
			url: "cruds/crud_folios.php",
			type: "POST",
			dataType: "json",
			data: {
				id: id,
				serial: serial,
				carpeta: carpeta,
				descripcion: descripcion,
				opcion: opcion
			},
			success: function (data) {
				console.log(data);
				id = data[0].id;
				serial = data[0].serial;
				descripcion = data[0].descripcion;
				carpeta = data[0].carpeta;
				if (opcion == 1) {
					tablaFolios.row.add([id, serial, descripcion, carpeta]).draw();
				} else {
					tablaFolios.row(fila).data([id, serial, descripcion, carpeta]).draw();
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