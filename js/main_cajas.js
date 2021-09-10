$(document).ready(function () {
	$('#tablaCajas tfoot th').each(function () {
		var title = $(this).text();
		$(this).html('<input type="text" style="width: 98px" placeholder="' + title + '" />');
	});

	indica = $.trim($("#gestor").val());
	if (indica == "1") {
		var tablaCajas = $("#tablaCajas").dataTable({
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
		var tablaCajas = $("#tablaCajas").dataTable({
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
		var tablaCajas = $("#tablaCajas").dataTable({
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

	tablaCajas.api().columns().every(function () {
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
			.done(function (ListaBodega) {
				$('#lista_bodegas').html(ListaBodega);
			})
			.fail(function () {
				alert('Hubo un error al cargar las Bodegas !');
			});
	});

	$('#lista_bodegas').on('change', function () {
		var bodega = $('#lista_bodegas').val();
		$.ajax({
				type: "POST",
				url: './lista_estantes.php',
				data: {
					'bodega': bodega
				}
			})
			.done(function (ListaEstante) {
				$('#lista_estantes').html(ListaEstante);
			})
			.fail(function () {
				alert('Hubo un error al cargar los Estantes !');
			});
	});

	$('#lista_estantes').on('change', function () {
		var estante = $('#lista_estantes').val();
		$.ajax({
				type: "POST",
				url: './lista_caras.php',
				data: {
					'estante': estante
				}
			})
			.done(function (ListaCara) {
				$('#lista_caras').html(ListaCara);
			})
			.fail(function () {
				alert('Hubo un error al cargar las Caras !');
			});
	});

	$('#lista_caras').on('change', function () {
		var cara = $('#lista_caras').val();
		$.ajax({
				type: "POST",
				url: './lista_modulos.php',
				data: {
					'cara': cara
				}
			})
			.done(function (ListaModulo) {
				$('#lista_modulos').html(ListaModulo);
			})
			.fail(function () {
				alert('Hubo un error al cargar los Modulos !');
			});
	});

	$('#lista_modulos').on('change', function () {
		var modulo = $('#lista_modulos').val();
		$.ajax({
				type: "POST",
				url: './lista_pisos.php',
				data: {
					'modulo': modulo
				}
			})
			.done(function (ListaPiso) {
				$('#lista_pisos').html(ListaPiso);
			})
			.fail(function () {
				alert('Hubo un error al cargar los Pisos !');
			});
	});

	$('#lista_pisos').on('change', function () {
		var piso = $('#lista_pisos').val();
		$.ajax({
				type: "POST",
				url: './lista_entrepanos.php',
				data: {
					'piso': piso
				}
			})
			.done(function (ListaEntrepano) {
				$('#lista_entrepanos').html(ListaEntrepano);
			})
			.fail(function () {
				alert('Hubo un error al cargar los Entrepaños !');
			});
	});

	$('#lista_entrepanos').on('change', function () {
		var entrepano = $('#lista_entrepanos').val();
		$.ajax({
				type: "POST",
				url: './lista_ubicaciones.php',
				data: {
					'entrepano': entrepano
				}
			})
			.done(function (ListaUbicacion) {
				$('#lista_ubicaciones').html(ListaUbicacion);
			})
			.fail(function () {
				alert('Hubo un error al cargar las Ubicaciones !');
			});
	});

	$('#lista_ubicaciones').on('change', function () {
		$.ajax({
				url: './lista_tipos_cajas.php',
			})
			.done(function (ListaTipoCaja) {
				$('#lista_tipo_cajas').html(ListaTipoCaja);
			})
			.fail(function () {
				alert('Hubo un error al cargar los tipos de Cajas !');
			});
	});

	$('#lista_tipo_cajas').on('change', function () {
		$.ajax({
				url: './lista_clientes.php',
			})
			.done(function (ListaClientes) {
				$('#lista_clientes').html(ListaClientes);
			})
			.fail(function () {
				alert('Hubo un error al cargar los Clientes !');
			});
	});



	$("#btnNuevo").click(function () {
		$("#formCajas").trigger("reset");
		$(".modal-header").css("background-color", "#28a745");
		$(".modal-header").css("color", "white");
		$(".modal-title").text("Nueva Caja");
		$("#modalCRUD").modal("show");
		id = null;
		opcion = 1; //alta
	});

	var fila; //capturar la fila para editar o borrar el registro

	//botón EDITAR    
	$(document).on("click", ".btnEditar", function () {
		fila = $(this).closest("tr");
		id = parseInt(fila.find('td:eq(0)').text());
		descripcion = fila.find('td:eq(2)').text();

		$("#id_caja").val(id);
		$("#descripcion_caja").val(descripcion);

		opcion = 2; //editar
		$(".modal-header").css("background-color", "#007bff");
		$(".modal-header").css("color", "white");
		$(".modal-title").text("Editar Caja");
		$("#modalCRUD").modal("show");
		$.ajax({
				url: './lista_bodegas.php'
			})
			.done(function (ListaBodega) {
				$('#lista_bodegas').html(ListaBodega);
			})
			.fail(function () {
				alert('Hubo un error al cargar las Bodegas !');
			});

		$('#lista_bodegas').on('change', function () {
			var bodega = $('#lista_bodegas').val();
			$.ajax({
					type: "POST",
					url: './lista_estantes.php',
					data: {
						'bodega': bodega
					}
				})
				.done(function (ListaEstante) {
					$('#lista_estantes').html(ListaEstante);
				})
				.fail(function () {
					alert('Hubo un error al cargar los Estantes !');
				});
		});

		$('#lista_estantes').on('change', function () {
			var estante = $('#lista_estantes').val();
			$.ajax({
					type: "POST",
					url: './lista_caras.php',
					data: {
						'estante': estante
					}
				})
				.done(function (ListaCara) {
					$('#lista_caras').html(ListaCara);
				})
				.fail(function () {
					alert('Hubo un error al cargar las Caras !');
				});
		});

		$('#lista_caras').on('change', function () {
			var cara = $('#lista_caras').val();
			$.ajax({
					type: "POST",
					url: './lista_modulos.php',
					data: {
						'cara': cara
					}
				})
				.done(function (ListaModulo) {
					$('#lista_modulos').html(ListaModulo);
				})
				.fail(function () {
					alert('Hubo un error al cargar los Modulos !');
				});
		});

		$('#lista_modulos').on('change', function () {
			var modulo = $('#lista_modulos').val();
			$.ajax({
					type: "POST",
					url: './lista_pisos.php',
					data: {
						'modulo': modulo
					}
				})
				.done(function (ListaPiso) {
					$('#lista_pisos').html(ListaPiso);
				})
				.fail(function () {
					alert('Hubo un error al cargar los Pisos !');
				});
		});

		$('#lista_pisos').on('change', function () {
			var piso = $('#lista_pisos').val();
			$.ajax({
					type: "POST",
					url: './lista_entrepanos.php',
					data: {
						'piso': piso
					}
				})
				.done(function (ListaEntrepano) {
					$('#lista_entrepanos').html(ListaEntrepano);
				})
				.fail(function () {
					alert('Hubo un error al cargar los Entrepaños !');
				});
		});

		$('#lista_entrepanos').on('change', function () {
			var entrepano = $('#lista_entrepanos').val();
			$.ajax({
					type: "POST",
					url: './lista_ubicaciones.php',
					data: {
						'entrepano': entrepano
					}
				})
				.done(function (ListaUbicacion) {
					$('#lista_ubicaciones').html(ListaUbicacion);
				})
				.fail(function () {
					alert('Hubo un error al cargar las Ubicaciones !');
				});
		});

		$('#lista_ubicaciones').on('change', function () {
			$.ajax({
					url: './lista_tipos_cajas.php'
				})
				.done(function (ListaTipoCaja) {
					$('#lista_tipo_cajas').html(ListaTipoCaja);
				})
				.fail(function () {
					alert('Hubo un error al cargar los tipos de Cajas !');
				});
		});

		$('#lista_tipo_cajas').on('change', function () {
			$.ajax({
					url: './lista_clientes.php',
				})
				.done(function (ListaClientes) {
					$('#lista_clientes').html(ListaClientes);
				})
				.fail(function () {
					alert('Hubo un error al cargar los Clientes !');
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
				url: "cruds/crud_cajas.php",
				type: "POST",
				dataType: "json",
				data: {
					opcion: opcion,
					id: id
				},
				success: function () {
					tablaCajas.row(fila.parents('tr')).remove().draw();
				}
			});
		}

		function recargar() {
			location.reload();
		}
		setTimeout(recargar, 800);
	});

	$("#formCajas").submit(function (e) {
		e.preventDefault();
		id = $.trim($("#id_caja").val());
		descripcion = $.trim($("#descripcion_caja").val());
		bodega = $.trim($("#lista_bodegas").val());
		estante = $.trim($("#lista_estantes").val());
		cara = $.trim($("#lista_caras").val());
		modulo = $.trim($("#lista_modulos").val());
		piso = $.trim($("#lista_pisos").val());
		entrepano = $.trim($("#lista_entrepanos").val());
		ubicacion = $.trim($("#lista_ubicaciones").val());
		tipo = $.trim($("#lista_tipo_cajas").val());
		cliente = $.trim($("#lista_clientes").val());
		$.ajax({
			url: "cruds/crud_cajas.php",
			type: "POST",
			dataType: "json",
			data: {
				id: id,
				descripcion: descripcion,
				bodega: bodega,
				estante: estante,
				cara: cara,
				modulo: modulo,
				piso: piso,
				entrepano: entrepano,
				ubicacion: ubicacion,
				tipo: tipo,
				cliente: cliente,
				opcion: opcion

			},
			success: function (data) {
				console.log(data);
				id = data[0].id;
				descripcion = data[0].descripcion;
				bodega = data[0].bodega;
				estante = data[0].estante;
				cara = data[0].cara;
				modulo = data[0].modulo;
				piso = data[0].piso;
				entrepano = data[0].entrepano;
				ubicacion = data[0].ubicacion;
				tipo = data[0].tipo;
				cliente = data[0].cliente;
				if (opcion == 1) {
					tablaCajas.row.add([id, descripcion, bodega, estante, cara, modulo, piso, entrepano, ubicacion, tipo, cliente]).draw();
				} else {
					tablaCajas.row(fila).data([id, descripcion, bodega, estante, cara, modulo, piso, entrepano, ubicacion, tipo, cliente]).draw();
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