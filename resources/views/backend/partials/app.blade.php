<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta name="description" content="Amir IT Soft, Tailors Shop, Tailors-BD, Tailor" />
        <meta name="author" content="Amir Hossain" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title> {{ getInfo('name')}} </title>

        <link rel="stylesheet" href="{{ asset('backend/bootstrap/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
        <link rel="stylesheet" href="{{ asset('backend/fonts/fontawesome-all.min.css')}}">
        <link rel="stylesheet" href="{{ asset('backend/css/style.css')}}">


        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />

        @stack('css')
    </head>

    <body id="page-top">
    <div id="wrapper" style="background-color: black;">
        @include('backend.partials.nav')
        <div class="sidebar navbar optional_side">
        </div>
        <div class="overlay sidebar_toggler">
        </div>
        <div class="d-flex flex-column bg-black rounded-5 p-0 p-lg-4 content-wrapper" id="content-wrapper">
            <div id="content" class="bg-light p-3 pt-4 rounded-5">
                <nav class="navbar navbar-expand mb-4 topbar static-top navbar-light">
                    <div class="container-fluid">
                        <button class="btn btn-link rounded-circle me-3 sidebar_toggler" type="button">
                            <i class="fas fa-bars"></i>
                        </button>                       
                        @include('backend.partials.header_nav')

                    </div>
                </nav>
                <div class="container-fluid content">
                    @yield('content')
                    <p> &copy; 2024 All Rights Reserved. Designed by {{ getInfo('name')}} </p>

                </div>
            </div>

        </div>
        <div class="modal fade" id="common_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>
        <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    
    <script src="{{ asset('backend/js/chart.min.js')}}"></script>
    <script src="{{ asset('backend/js/bs-init.js')}}"></script>
    <script src="{{ asset('backend/js/canvasjs.js')}}"></script>
    <script src="{{ asset('backend/js/theme.js')}}"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.5/daterangepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{ asset('backend/js/ajax.js')}}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var markers = [{
                    coords: [31.230391, 121.473701],
                    name: "Shanghai"
                },
                {
                    coords: [28.704060, 77.102493],
                    name: "Delhi"
                },
                {
                    coords: [6.524379, 3.379206],
                    name: "Lagos"
                },
                {
                    coords: [35.689487, 139.691711],
                    name: "Tokyo"
                },
                {
                    coords: [23.129110, 113.264381],
                    name: "Guangzhou"
                },
                {
                    coords: [40.7127837, -74.0059413],
                    name: "New York"
                },
                {
                    coords: [34.052235, -118.243683],
                    name: "Los Angeles"
                },
                {
                    coords: [41.878113, -87.629799],
                    name: "Chicago"
                },
                {
                    coords: [51.507351, -0.127758],
                    name: "London"
                },
                {
                    coords: [40.416775, -3.703790],
                    name: "Madrid "
                }
            ];
            var map = new jsVectorMap({
                map: "world",
                selector: "#world_map",
                zoomButtons: true,
                markers: markers,
                markerStyle: {
                    initial: {
                        r: 9,
                        stroke: window.theme.white,
                        strokeWidth: 7,
                        stokeOpacity: .4,
                        fill: window.theme.primary
                    },
                    hover: {
                        fill: window.theme.primary,
                        stroke: window.theme.primary
                    }
                },
                regionStyle: {
                    initial: {
                        fill: window.theme["gray-200"]
                    }
                },
                zoomOnScroll: false
            });
            window.addEventListener("resize", () => {
                map.updateSize();
            });
            setTimeout(function() {
                map.updateSize();
            }, 250);
        });
    </script>
    <script>
        window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            exportEnabled: false,
            animationEnabled: true,
            data: [{
                type: "pie",
                startAngle: 25,
                toolTipContent: "<b>{label}</b>: {y}%",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 16,
                indexLabel: "{label} - {y}%",
                dataPoints: [
                    { y: 51.08, label: "Chrome" },
                    { y: 27.34, label: "Internet Explorer" },
                    { y: 10.62, label: "Firefox" },
                    { y: 5.02, label: "Microsoft Edge" },
                    { y: 4.07, label: "Safari" },
                    { y: 1.22, label: "Opera" },
                    { y: 0.44, label: "Others" }
                ]
            }]
        });
        chart.render();
        
        }
        var temp = [];
            var dataSeriesRendered = [true, true];
                var growth = new CanvasJS.Chart("growth",
                {

                legend: {
                    cursor:"pointer",
                horizontalAlign: "left", // "center" , "right"
                verticalAlign: "center",  // "top" , "bottom"
                fontSize: 15,
                    itemclick: function(e){
                    console.log(dataSeriesRendered[e.dataSeriesIndex])
                    
                    if(dataSeriesRendered[e.dataSeriesIndex]) {
                        temp[e.dataSeriesIndex] =         e.chart.options.data[e.dataSeriesIndex].dataPoints;
                        console.log(e.growth.options.data[e.dataSeriesIndex]);
                        console.log(temp[e.dataSeriesIndex]);
                        e.growth.options.data[e.dataSeriesIndex].dataPoints = [];

                    }else {
                        e.growth.options.data[e.dataSeriesIndex].dataPoints = temp[e.dataSeriesIndex];
                    }
                    dataSeriesRendered[e.dataSeriesIndex] = !!!dataSeriesRendered[e.dataSeriesIndex];
                    e.growth.render();
                    }

                },
                data: [
                {
                type: "line",
                showInLegend: true,
                legendText: "Numbers",
                dataPoints: [
                {label: "Jon", y: 100 },
                {label: "Jose", y: 155},
                {label: "Joey", y: 360},
                {label: "Trin", y: 170 },
                {label: "Mike", y: 135 },
                {label: "Hulk", y: 260 },
                {label: "Dan", y: 240},
                {label: "Nate", y: 500 },      
                {label: "Jen", y: 80 }
                ]
                },{
                type: "line",
                showInLegend: true,
                legendText: "Numbers2",
                dataPoints: [
                {label: "Jon", y: 10 },
                {label: "Jose", y: 15},
                {label: "Joey", y: 36},
                {label: "Trin", y: 17 },
                {label: "Mike", y: 13 },
                {label: "Hulk", y: 26 },
                {label: "Dan", y: 24},
                {label: "Nate", y: 50 },      
                {label: "Jen", y: 80 }
                ]
                }
                ]
            });

            growth.render();
        </script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.select2').each(function() {
                  $(this).select2({
                      dropdownParent: $(this).parent()
                  });
                })

                $(document).find('input.date').each(function() {
                  $(this).datepicker({dateFormat: 'yy-mm-dd'});
                })
            });
        </script>
    @stack('js')
</body>


  
</html>
