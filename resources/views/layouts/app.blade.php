<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
       
        <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet"  crossorigin="anonymous">
        <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css" rel="stylesheet"  crossorigin="anonymous">
        <link href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css" rel="stylesheet"  crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="http://srt.pmmsapp.com/assets/js/jquery-2.1.4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"  crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"  crossorigin="anonymous"></script>
       

        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">


jQuery(function($) {
    //console.log("this is fquerye rf");
            //initiate dataTables plugin
            var myTable = 
				$('#dynamic-table').DataTable( {
				bAutoWidth: false,
					"aaSorting": [],
					"bProcessing": true,
					"bProcessing": true,
					"sAutoWidth": false,
					"bDestroy":true,
					"sPaginationType": "bootstrap", // full_numbers
					"iDisplayStart ": 10,
					"iDisplayLength": 10,
					"bPaginate": false, 
					"bPaginate": false, 
						    "bPaginate": false, //hide pagination
						    "bFilter": false, //hide Search bar
						    "bInfo": false, // hide showing entries
				} );
            
            $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
            
            new $.fn.dataTable.Buttons( myTable, {
                buttons: [
                // {
                //     "extend": "colvis",
                //     "text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
                //     "className": "btn btn-white btn-primary btn-bold",
                //     columns: ':not(:first):not(:last)'
                // },
                {
                    "extend": "copy",
                    "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
                    "className": "btn btn-white btn-primary btn-bold"
                },
                {
                    "extend": "csv",
                    "text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
                    "className": "btn btn-white btn-primary btn-bold"
                },
                {
                    "extend": "excel",
                    "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
                    "className": "btn btn-white btn-primary btn-bold"
                },
                {
                    "extend": "pdf",
                    "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
                    "className": "btn btn-white btn-primary btn-bold"
                },
                {
                    "extend": "print",
                    "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
                    "className": "btn btn-white btn-primary btn-bold",
                    title: 'Day Book',
                    autoPrint: false,
                    // message: 'This print was produced using the Print button for DataTables'
                }		  
                ]
            });
            myTable.buttons().container().appendTo( $('.tableTools-container') );
            
            //style the message box
            var defaultCopyAction = myTable.button(1).action();
            myTable.button(1).action(function (e, dt, button, config) {
                defaultCopyAction(e, dt, button, config);
                $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
            });
            
            
            var defaultColvisAction = myTable.button(0).action();
            myTable.button(0).action(function (e, dt, button, config) {
                
                defaultColvisAction(e, dt, button, config);
                
                
                if($('.dt-button-collection > .dropdown-menu').length == 0) {
                    $('.dt-button-collection')
                    .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
                    .find('a').attr('href', '#').wrap("<li />")
                }
                $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
            });

            //console.log("above day book submit");
            
        })
    </script>
    </body>
</html>
