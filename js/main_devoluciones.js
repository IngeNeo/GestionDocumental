$(document).ready(function () {
	$('#tablaDevoluciones tfoot th').each(function () {
		var title = $(this).text();
		$(this).html('<input type="text" style="width: 98px" placeholder="' + title + '" />');
	});
	var tablaDevoluciones = $("#tablaDevoluciones").dataTable({
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
			"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-danger btnDevolucion'><i class='icono1 fas fa-chalkboard-teacher'></i> Devolución</button></div></div>"
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

	tablaDevoluciones.api().columns().every(function () {
		var that = this;

		$('input', this.footer()).on('keyup change', function () {
			if (that.search() !== this.value) {
				that.search(this.value).draw();
			}
		});
	});

	var fila; //capturar la fila para editar o borrar el registro


	//botón BORRAR
	$(document).on("click", ".btnDevolucion", function () {
		fila = $(this);
		id = parseInt($(this).closest("tr").find('td:eq(0)').text());
		objeto_prestamo = $(this).closest("tr").find('td:eq(1)').text();
		id_objeto = parseInt($(this).closest("tr").find('td:eq(2)').text());
		var respuesta = confirm("¿Está seguro de realizar la devolución de : " + objeto_prestamo + id + id_objeto + " ?");
		if (respuesta) {
			$.ajax({
				url: "cruds/crud_devoluciones.php",
				type: "POST",
				dataType: "json",
				data: {
					id: id,
					id_objeto: id_objeto,
					objeto_prestamo: objeto_prestamo
				},

				success: function () {
					tablaDevoluciones.row(fila.parents('tr')).remove().draw();
				}
			});
		}

		function recargar() {
			location.reload();
		}
		setTimeout(recargar, 800);
	});

});