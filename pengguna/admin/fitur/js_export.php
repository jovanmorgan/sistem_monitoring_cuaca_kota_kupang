 <!-- Tautan ke file jQuery -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <!-- Tautan ke file JavaScript DataTables -->
 <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>
 <!-- Tautan ke file JavaScript untuk ekspor -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
 <script>
$(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'pdfHtml5',
                text: 'PDF A3',
                customize: function(doc) {
                    doc.pageSize = 'A3';
                    doc.content[1].table.headerRows = 1;
                    doc.content[1].table.body[0].forEach(function(col) {
                        col.fillColor = '#cccccc';
                    });
                }
            },
            {
                extend: 'pdfHtml5',
                text: 'PDF A4',
                customize: function(doc) {
                    doc.pageSize = 'A4';
                    doc.content[1].table.headerRows = 1;
                    doc.content[1].table.body[0].forEach(function(col) {
                        col.fillColor = '#cccccc';
                    });
                }
            },
            'copy', 'csv', 'excel', 'print'
        ]
    });
});
 </script>