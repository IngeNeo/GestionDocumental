$(document).ready(function () {
	$('#tablaPrestamos tfoot th').each(function () {
		var title = $(this).text();
		$(this).html('<input type="text" style="width: 98px" placeholder="' + title + '" />');
	});
	var tablaPrestamos = $("#tablaPrestamos").dataTable({
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
			"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-success btnPrestar'><i class='icono1 fas fa-chalkboard-teacher'></i> Prestamo</button></div></div>"
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

	tablaPrestamos.api().columns().every(function () {
		var that = this;

		$('input', this.footer()).on('keyup change', function () {
			if (that.search() !== this.value) {
				that.search(this.value).draw();
			}
		});
	});

	var fila; //capturar la fila para editar o borrar el registro

	//botón PRESTAR    
	$(document).on("click", ".btnPrestar", function () {
		fila = $(this).closest("tr");
		id = parseInt(fila.find('td:eq(0)').text());
		serial = fila.find('td:eq(1)').text();

		$("#id_folio").val(id);
		$("#codigo_folio").val(serial);

		opcion = 1; //Prestar
		$(".modal-header").css("background-color", "#28A745");
		$(".modal-header").css("color", "white");
		$(".modal-title").text("Solicitud Prestamo");
		$("#modalCRUD").modal("show");
		$.ajax({
				url: './lista_tipo_prestamos.php'
			})
			.done(function (ListaTipoPrestamo) {
				$('#lista_tipo_prestamos').html(ListaTipoPrestamo);
			})
			.fail(function () {
				alert('Hubo un error al cargar lo tipos de prestamos !');
			});

		$('#lista_tipo_prestamos').on('change', function () {
			$.ajax({
					url: './lista_prioridad_prestamos.php'
				})
				.done(function (ListaPrioridadPrestamo) {
					$('#lista_prioridad_prestamo').html(ListaPrioridadPrestamo);
				})
				.fail(function () {
					alert('Hubo un error al cargar los tipos de prestamos !');
				});
		});

	});

	$("#formPrestamos").submit(function (e) {
		e.preventDefault();
		id = $.trim($("#id_folio").val());
		fecha_ent = $.trim($("#fecha_entrega").val());
		tipo_prestamo = $.trim($("#lista_tipo_prestamos").val());
		prioridad_prestamo = $.trim($("#lista_prioridad_prestamo").val());
		cliente = $.trim($("#gestor").val());
		id_usuario = $.trim($("#id_usuario").val());
		nombre_usuario = $.trim($("#nombre_gestor").val());
		apellido_usuario = $.trim($("#apellido_gestor").val());
		$.ajax({
			url: "cruds/crud_prestamos_folios.php",
			type: "POST",
			dataType: "json",
			data: {
				id: id,
				fecha_ent: fecha_ent,
				tipo_prestamo: tipo_prestamo,
				prioridad_prestamo: prioridad_prestamo,
				cliente: cliente,
				id_usuario: id_usuario,
				nombre_usuario: nombre_usuario,
				apellido_usuario: apellido_usuario,
				opcion: opcion
			},
		});
		$("#modalCRUD").modal("hide");

		function recargar() {
			location.reload();
		}
		setTimeout(recargar, 800);
	});
});