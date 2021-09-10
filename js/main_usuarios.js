$(document).ready(function () {
	$('#tablaPersonas tfoot th').each(function () {
		var title = $(this).text();
		$(this).html('<input type="text" style="width: 98px" placeholder="' + title + '" />');
	});

	indica = $.trim($("#gestor").val());
	if (indica == "1") {
		var tablaPersonas = $("#tablaPersonas").dataTable({
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
		var tablaPersonas = $("#tablaPersonas").dataTable({
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
		var tablaPersonas = $("#tablaPersonas").dataTable({
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

	tablaPersonas.api().columns().every(function () {
		var that = this;

		$('input', this.footer()).on('keyup change', function () {
			if (that.search() !== this.value) {
				that.search(this.value).draw();
			}
		});
	});

	$('#btnNuevo').click(function () {
		$.ajax({
				url: './lista_tipo_usuario.php'
			})
			.done(function (ListaTipoUsuario) {
				$('#tipo_usuario').html(ListaTipoUsuario);
			})
			.fail(function () {
				alert('Hubo un error al cargar los tipos !');
			});
	});

	$('#btnNuevo').click(function () {
		$.ajax({
				url: './lista_clientes.php'
			})
			.done(function (ListaClientes) {
				$('#nombre_cliente').html(ListaClientes);
			})
			.fail(function () {
				alert('Hubo un error al cargar los clientes !');
			});
	});

	$("#btnNuevo").click(function () {
		$("#formPersonas").trigger("reset");
		$(".modal-header").css("background-color", "#28a745");
		$(".modal-header").css("color", "white");
		$(".modal-title").text("Nuevo Usuario");
		$("#modalCRUD").modal("show");
		id = null;
		opcion = 1; //alta
	});

	var fila; //capturar la fila para editar o borrar el registro

	//botón EDITAR    
	$(document).on("click", ".btnEditar", function () {
		fila = $(this).closest("tr");
		id = parseInt(fila.find('td:eq(0)').text());
		cedula = fila.find('td:eq(1)').text();
		nombres = fila.find('td:eq(2)').text();
		apellidos = fila.find('td:eq(3)').text();
		telefono = fila.find('td:eq(4)').text();
		email = fila.find('td:eq(5)').text();

		$("#id_usuario").val(id);
		$("#cedula_usuario").val(cedula);
		$("#nombre_usuario").val(nombres);
		$("#apellido_usuario").val(apellidos);
		$("#telefono_usuario").val(telefono);
		$("#email_usuario").val(email);
		opcion = 2; //editar
		$(".modal-header").css("background-color", "#007bff");
		$(".modal-header").css("color", "white");
		$(".modal-title").text("Editar Usuario");
		$("#modalCRUD").modal("show");
		$.ajax({
				url: './lista_tipo_usuario.php'
			})
			.done(function (ListaTipoUsuario) {
				$('#tipo_usuario').html(ListaTipoUsuario);
			})
			.fail(function () {
				alert('Hubo un error al cargar los tipos !');
			});
		$.ajax({
				url: './lista_clientes.php'
			})
			.done(function (ListaClientes) {
				$('#nombre_cliente').html(ListaClientes);
			})
			.fail(function () {
				alert('Hubo un error al cargar los clientes !');
			});

	});

	//botón BORRAR
	$(document).on("click", ".btnBorrar", function () {
		fila = $(this);
		id = parseInt($(this).closest("tr").find('td:eq(0)').text());
		opcion = 3; //borrar
		var respuesta = confirm("¿Está seguro de eliminar el registro: " + id + "?");
		if (respuesta) {
			$.ajax({
				url: "cruds/crud_usuarios.php",
				type: "POST",
				dataType: "json",
				data: {
					opcion: opcion,
					id: id
				},
				success: function () {
					tablaPersonas.row(fila.parents('tr')).remove().draw();
				}
			});
		}

		function recargar() {
			location.reload();
		}
		setTimeout(recargar, 800);
	});

	$("#formPersonas").submit(function (e) {
		e.preventDefault();
		id = $.trim($("#id_usuario").val());
		cedula = $.trim($("#cedula_usuario").val());
		nombres = $.trim($("#nombre_usuario").val());
		apellidos = $.trim($("#apellido_usuario").val());
		telefono = $.trim($("#telefono_usuario").val());
		email = $.trim($("#email_usuario").val());
		tipo = $.trim($("#tipo_usuario").val());
		cliente = $.trim($("#nombre_cliente").val());
		$.ajax({
			url: "cruds/crud_usuarios.php",
			type: "POST",
			dataType: "json",
			data: {
				id: id,
				cedula: cedula,
				nombres: nombres,
				apellidos: apellidos,
				telefono: telefono,
				email: email,
				tipo: tipo,
				cliente: cliente,
				opcion: opcion
			},
			success: function (data) {
				console.log(data);
				id = data[0].id;
				cedula = data[0].cedula;
				nombres = data[0].nombres;
				apellidos = data[0].apellidos;
				telefono = data[0].telefono;
				email = data[0].email;
				tipo = data[0].tipo;
				cliente = data[0].cliente;
				if (opcion == 1) {
					tablaPersonas.row.add([id, cedula, nombres, apellidos, telefono, email, tipo, cliente]).draw();
				} else {
					tablaPersonas.row(fila).data([id, cedula, nombres, apellidos, telefono, email, tipo, cliente]).draw();
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