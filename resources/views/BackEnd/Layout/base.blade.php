<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('Front/assets/img/logo.png') }}">
    <link href="{{ asset('BackEnd/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- jvectormap -->
    <link href="{{ asset('BackEnd/plugins/jvectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet">
    <link href="{{ asset('BackEnd/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet">
    <!-- App css -->
    <link href="{{ asset('BackEnd/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('BackEnd/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('BackEnd/assets/css/metisMenu.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('BackEnd//plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('BackEnd/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    @stack('css')
    <style>
        body {
            font-family: "Roboto Slab", serif;
            font-optical-sizing: auto;
            font-weight: normal;
            font-style: normal;
            font-size: 12px;
        }
    </style>
</head>

<body class="col-md-11 mx-auto" style=" ">
    @include('BackEnd.Layout.aside')
    <div class="page-wrapper">
        @include('BackEnd.Layout.top_bar')
        @if (Session::has('success'))
            <p class="alert alert-info bg-success text-white">{{ Session::get('success') }}</p>
        @endif
        @if (Session::has('error'))
            <p class="alert alert-info bg-danger text-white">{{ Session::get('error') }}</p>
        @endif
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('BackEnd/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/js/metismenu.min.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/js/waves.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/js/moment.js') }}"></script>
    <script src="{{ asset('BackEnd/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('BackEnd/plugins/apex-charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('BackEnd/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('BackEnd/plugins/jvectormap/jquery-jvectormap-us-aea-en.js') }}"></script>
    <script src="{{ asset('BackEnd/assets/pages/jquery.analytics_dashboard.init.js') }}"></script>
    <script src="{{ asset('Backend/plugins/dropify/js/dropify.min.js') }}"></script>
    <script src="{{ asset('Backend/assets/pages/jquery.form-upload.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('BackEnd/assets/js/app.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script>
    $(document).ready( function () {
   var oTable = $('#table').dataTable({
                "fixedHeader": true,
                "colReorder": true,
                "responsive": true,
                "sPaginationType": "full_numbers",
                "bLengthChange": true,
                "aLengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, , "All"]],
                "iDisplayLength": 5,
                "aaSorting": [1, 'asc'],
                "dom": 'Blfrtip',
                "bProcessing": false,
                buttons: [
                    'copy', 'excel', 'pdf', 'print', 'csv',
                    {
                        text: 'JSON',
                        action: function (e, dt, button, config) {
                            var data = dt.buttons.exportData();

                            $.fn.dataTable.fileSave(
                                new Blob([JSON.stringify(data)]),
                                'Export.json'
                            );
                        }
                    }
                ],
            });
   $(document).contextmenu({
                delegate: ".dataTable td",
                menu: [
                    { title: "Filter", cmd: "filter", uiIcon: "ui-icon-volume-off ui-icon-filter" },
                    { title: "Remove filter", cmd: "nofilter", uiIcon: "ui-icon-volume-off ui-icon-filter" },
                    { title: "Cut", cmd: "Cut", uiIcon: "ui-icon-volume-off ui-icon-filter" },
                    { title: "Pest", cmd: "Pest", uiIcon: "ui-icon-volume-off ui-icon-filter" },
                    { title: "Exclude", cmd: "Exclude", uiIcon: "ui-icon-volume-off ui-icon-filter" }
                ],
                select: function (event, ui) {
                    var coltext = ui.target.text().trim();
                    var colvindex = ui.target.parent().children().index(ui.target);
                    var colindex = $('table thead tr th:eq(' + colvindex + ')').data('column-index');
                    switch (ui.cmd) {
                        case "filter":
                            oTable.fnFilter(coltext.trim(), colindex, true);
                            break;
                        case "nofilter":
                            oTable.fnFilter('');
                            break;
                        case "Cut":

                            alert('Column index 0 is ' +
                                (employeeTable.column(0).visible() === true ? 'visible' : 'not visible')
                            );
                            break;
                        case "Exclude":
                            //
                            oTable.fnSetColumnVis(columnIndex, false);

                            break;
                    }
                },
                beforeOpen: function (event, ui) {
                    var $menu = ui.menu,
                        $target = ui.target,
                        extraData = ui.extraData;
                    ui.menu.zIndex(9999);
                }
            });
} );

</script>
    @stack('js')
</body>

</html>
