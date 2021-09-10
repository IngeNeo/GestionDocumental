$(document).ready(function () {
	$('#tablaClientes tfoot th').each(function () {
		var title = $(this).text();
		$(this).html('<input type="text" style="width: 98px" placeholder="' + title + '" />');
	});

	indica = $.trim($("#gestor").val());
	if (indica == "1") {
		var tablaClientes = $("#tablaClientes").dataTable({
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
		var tablaClientes = $("#tablaClientes").dataTable({
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
		var tablaClientes = $("#tablaClientes").dataTable({
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

	tablaClientes.api().columns().every(function () {
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
		$("#formClientes").trigger("reset");
		$(".modal-header").css("background-color", "#28a745");
		$(".modal-header").css("color", "white");
		$(".modal-title").text("Nuevo Cliente");
		$("#modalCRUD").modal("show");
		id = null;
		opcion = 1; //alta
	});

	var fila; //capturar la fila para editar o borrar el registro

	//botón EDITAR    
	$(document).on("click", ".btnEditar", function () {
		fila = $(this).closest("tr");
		id = parseInt(fila.find('td:eq(0)').text());
		nit = fila.find('td:eq(1)').text();
		razon = fila.find('td:eq(2)').text();
		direccion = fila.find('td:eq(3)').text();
		telefono = fila.find('td:eq(4)').text();
		email = fila.find('td:eq(5)').text();

		$("#id_cliente").val(id);
		$("#nit_cliente").val(nit);
		$("#razon_social_cliente").val(razon);
		$("#direccion_cliente").val(direccion);
		$("#telefono_cliente").val(telefono);
		$("#email_cliente").val(email);
		opcion = 2; //editar
		$(".modal-header").css("background-color", "#007bff");
		$(".modal-header").css("color", "white");
		$(".modal-title").text("Editar Cliente");
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
		razon = $(this).closest("tr").find('td:eq(2)').text();
		opcion = 3; //borrar
		var respuesta = confirm("¿Está seguro de eliminar el registro: " + razon + " ?");
		if (respuesta) {
			$.ajax({
				url: "cruds/crud_clientes.php",
				type: "POST",
				dataType: "json",
				data: {
					opcion: opcion,
					id: id
				},
				success: function () {
					tablaClientes.row(fila.parents('tr')).remove().draw();
				}
			});
		}

		function recargar() {
			location.reload();
		}
		setTimeout(recargar, 800);
	});

	$("#formClientes").submit(function (e) {
		e.preventDefault();
		id = $.trim($("#id_cliente").val());
		nit = $.trim($("#nit_cliente").val());
		razon = $.trim($("#razon_social_cliente").val());
		direccion = $.trim($("#direccion_cliente").val());
		telefono = $.trim($("#telefono_cliente").val());
		email = $.trim($("#email_cliente").val());
		ciudad = $.trim($("#lista_ciudad").val());
		$.ajax({
			url: "cruds/crud_clientes.php",
			type: "POST",
			dataType: "json",
			data: {
				id: id,
				nit: nit,
				razon: razon,
				direccion: direccion,
				telefono: telefono,
				email: email,
				ciudad: ciudad,
				opcion: opcion
			},
			success: function (data) {
				console.log(data);
				id = data[0].id;
				nit = data[0].nit;
				razon = data[0].razon;
				direccion = data[0].direccion;
				telefono = data[0].telefono;
				email = data[0].email;
				ciudad = data[0].ciudad;
				if (opcion == 1) {
					tablaClientes.row.add([id, nit, razon, direccion, telefono, email, ciudad]).draw();
				} else {
					tablaClientes.row(fila).data([id, nit, razon, direccion, telefono, email, ciudad]).draw();
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