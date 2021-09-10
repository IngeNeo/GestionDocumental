$(document).ready(function () {
	$('#tablaBodegas tfoot th').each(function () {
		var title = $(this).text();
		$(this).html('<input type="text" style="width: 98px" placeholder="' + title + '" />');
	});

	indica = $.trim($("#gestor").val());
	if (indica == "1") {
		var tablaBodegas = $("#tablaBodegas").dataTable({
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
		var tablaBodegas = $("#tablaBodegas").dataTable({
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
		var tablaBodegas = $("#tablaBodegas").dataTable({
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

	tablaBodegas.api().columns().every(function () {
		var that = this;

		$('input', this.footer()).on('keyup change', function () {
			if (that.search() !== this.value) {
				that.search(this.value).draw();
			}
		});
	});

	$('#btnNuevo').click(function () {
		$.ajax({
				url: './lista_departamentos.php'
			})
			.done(function (ListaDeptos) {
				$('#lista_depto').html(ListaDeptos);
			})
			.fail(function () {
				alert('Hubo un error al cargar los Deptos !');
			});
	});

	$('#lista_depto').on('change', function () {
		var depto = $('#lista_depto').val();
		$.ajax({
				type: "POST",
				url: './lista_ciudades.php',
				data: {
					'depto': depto
				}
			})
			.done(function (ListaCiudad) {
				$('#lista_ciudad').html(ListaCiudad);
			})
			.fail(function () {
				alert('Hubo un error al cargar las ciudades !');
			});
	});

	$("#btnNuevo").click(function () {
		$("#formBodegas").trigger("reset");
		$(".modal-header").css("background-color", "#28a745");
		$(".modal-header").css("color", "white");
		$(".modal-title").text("Nueva Bodega");
		$("#modalCRUD").modal("show");
		id = null;
		opcion = 1; //alta
	});

	var fila; //capturar la fila para editar o borrar el registro

	//botón EDITAR    
	$(document).on("click", ".btnEditar", function () {
		fila = $(this).closest("tr");
		id = parseInt(fila.find('td:eq(0)').text());
		nombre = fila.find('td:eq(1)').text();
		direccion = fila.find('td:eq(2)').text();
		telefono = fila.find('td:eq(3)').text();

		$("#id_bodega").val(id);
		$("#nombre_bodega").val(nombre);
		$("#direccion_bodega").val(direccion);
		$("#telefono_bodega").val(telefono);
		opcion = 2; //editar
		$(".modal-header").css("background-color", "#007bff");
		$(".modal-header").css("color", "white");
		$(".modal-title").text("Editar Bodega");
		$("#modalCRUD").modal("show");
		$.ajax({
				url: './lista_departamentos.php'
			})
			.done(function (ListaDeptos) {
				$('#lista_depto').html(ListaDeptos);
			})
			.fail(function () {
				alert('Hubo un error al cargar los Deptos !');
			});

		$('#lista_depto').on('change', function () {
			var depto = $('#lista_depto').val();
			$.ajax({
					type: "POST",
					url: './lista_ciudades.php',
					data: {
						'depto': depto
					}
				})
				.done(function (ListaCiudad) {
					$('#lista_ciudad').html(ListaCiudad);
				})
				.fail(function () {
					alert('Hubo un error al cargar las ciudades !');
				});
		});

	});

	//botón BORRAR
	$(document).on("click", ".btnBorrar", function () {
		fila = $(this);
		id = parseInt($(this).closest("tr").find('td:eq(0)').text());
		nombre = $(this).closest("tr").find('td:eq(1)').text();
		opcion = 3; //borrar
		var respuesta = confirm("¿Está seguro de eliminar el registro: " + nombre + " ?");
		if (respuesta) {
			$.ajax({
				url: "cruds/crud_bodegas.php",
				type: "POST",
				dataType: "json",
				data: {
					opcion: opcion,
					id: id
				},
				success: function () {
					tablaBodegas.row(fila.parents('tr')).remove().draw();
				}
			});
		}

		function recargar() {
			location.reload();
		}
		setTimeout(recargar, 800);
	});

	$("#formBodegas").submit(function (e) {
		e.preventDefault();
		id = $.trim($("#id_bodega").val());
		nombre = $.trim($("#nombre_bodega").val());
		direccion = $.trim($("#direccion_bodega").val());
		telefono = $.trim($("#telefono_bodega").val());
		ciudad = $.trim($("#lista_ciudad").val());
		$.ajax({
			url: "cruds/crud_bodegas.php",
			type: "POST",
			dataType: "json",
			data: {
				id: id,
				nombre: nombre,
				direccion: direccion,
				telefono: telefono,
				ciudad: ciudad,
				opcion: opcion
			},
			success: function (data) {
				console.log(data);
				id = data[0].id;
				nombre = data[0].nombre;
				direccion = data[0].direccion;
				telefono = data[0].telefono;
				ciudad = data[0].ciudad;
				if (opcion == 1) {
					tablaBodegas.row.add([id, nombre, direccion, telefono, ciudad]).draw();
				} else {
					tablaBodegas.row(fila).data([id, nombre, direccion, telefono, ciudad]).draw();
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