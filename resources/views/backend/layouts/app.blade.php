<!doctype html>

@if (\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)

    <html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@else

    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@endif



<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="app-url" content="{{ getBaseURL() }}">

    <meta name="file-base-url" content="{{ getFileBaseURL() }}">



    <!-- Required meta tags -->

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- Favicon -->

    <link rel="icon" href="{{ uploaded_asset(get_setting('site_icon')) }}">

    <link rel="apple-touch-icon" href="{{ uploaded_asset(get_setting('site_icon')) }}">

    <title>{{ get_setting('website_name') . ' | ' . get_setting('site_motto') }}</title>



    <!-- google font -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">



    <!-- aiz core css -->

    <link rel="stylesheet" href="{{ static_asset('assets/css/vendors.css') }}">

    @if (\App\Models\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)

        <link rel="stylesheet" href="{{ static_asset('assets/css/bootstrap-rtl.min.css') }}">

    @endif

    <link rel="stylesheet" href="{{ static_asset('assets/css/aiz-core.css?v=') }}{{ rand(1000,9999) }}">



    <style>

        body {

            font-size: 12px;

        }

    </style>

    <script>

        var AIZ = AIZ || {};

        AIZ.local = {

            nothing_selected: '{!! translate('Nothing selected', null, true) !!}',

            nothing_found: '{!! translate('Nothing found', null, true) !!}',

            choose_file: '{{ translate('Choose file') }}',

            file_selected: '{{ translate('File selected') }}',

            files_selected: '{{ translate('Files selected') }}',

            add_more_files: '{{ translate('Add more files') }}',

            adding_more_files: '{{ translate('Adding more files') }}',

            drop_files_here_paste_or: '{{ translate('Drop files here, paste or') }}',

            browse: '{{ translate('Browse') }}',

            upload_complete: '{{ translate('Upload complete') }}',

            upload_paused: '{{ translate('Upload paused') }}',

            resume_upload: '{{ translate('Resume upload') }}',

            pause_upload: '{{ translate('Pause upload') }}',

            retry_upload: '{{ translate('Retry upload') }}',

            cancel_upload: '{{ translate('Cancel upload') }}',

            uploading: '{{ translate('Uploading') }}',

            processing: '{{ translate('Processing') }}',

            complete: '{{ translate('Complete') }}',

            file: '{{ translate('File') }}',

            files: '{{ translate('Files') }}',

        }

    </script>



</head>



<body class="">



    <div class="aiz-main-wrapper">

        @include('backend.inc.admin_sidenav')

        <div class="aiz-content-wrapper">

            @include('backend.inc.admin_nav')

            <div class="aiz-main-content">

                <div class="px-15px px-lg-25px">

                    @yield('content')

                </div>

                <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto">

                    <p class="mb-0">&copy; {{ get_setting('site_name') }} v{{ get_setting('current_version') }}</p>

                </div>

            </div><!-- .aiz-main-content -->

        </div><!-- .aiz-content-wrapper -->

    </div><!-- .aiz-main-wrapper -->



    @yield('modal')


  <?php
      $orderalldata = DB::table('combined_orders')
      ->select(DB::raw('JSON_UNQUOTE(JSON_EXTRACT(shipping_address, "$.country")) AS country'), DB::raw('COUNT(*) AS totalcount'))
      ->whereNotNull('shipping_address->country')
      ->groupBy('country')
      ->get();

    //    $labels = [];
    //    $categories = [];
    // foreach($countryordersall as $countryvalue){
    //      $categories[] = $countryvalue->country;
    //      $series[] = $countryvalue->totalcount;
    //  }

    //  $alllcategories  = json_encode($categories); 
    //  $allseries  = json_encode($series);
  ?>


    <script src="{{ static_asset('assets/js/vendors.js') }}"></script>

    <script src="{{ static_asset('assets/js/aiz-core.js?v=') }}{{ rand(1000,9999) }}"></script>

    <!-- Apex Chats -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.6.9/apexcharts.min.js'></script>
    <script src='https://apexcharts.com/samples/assets/irregular-data-series.js'></script>
    <!-- ./Apex Chats -->

    @yield('script')



    <script type="text/javascript">

        @foreach (session('flash_notification', collect())->toArray() as $message)

            AIZ.plugins.notify('{{ $message['level'] }}', '{{ $message['message'] }}');

        @endforeach



        $('.dropdown-menu a[data-toggle="tab"]').click(function(e) {

            e.stopPropagation()

            $(this).tab('show')

        })



        if ($('#lang-change').length > 0) {

            $('#lang-change .dropdown-menu a').each(function() {

                $(this).on('click', function(e) {

                    e.preventDefault();

                    var $this = $(this);

                    var locale = $this.data('flag');

                    $.post('{{ route('language.change') }}', {

                        _token: '{{ csrf_token() }}',

                        locale: locale

                    }, function(data) {

                        location.reload();

                    });



                });

            });

        }



        function menuSearch() {

            var filter, item;

            filter = $("#menu-search").val().toUpperCase();

            items = $("#main-menu").find("a");

            items = items.filter(function(i, item) {

                if ($(item).find(".aiz-side-nav-text")[0].innerText.toUpperCase().indexOf(filter) > -1 && $(item)

                    .attr('href') !== '#') {

                    return item;

                }

            });



            if (filter !== '') {

                $("#main-menu").addClass('d-none');

                $("#search-menu").html('')

                if (items.length > 0) {

                    for (i = 0; i < items.length; i++) {

                        const text = $(items[i]).find(".aiz-side-nav-text")[0].innerText;

                        const link = $(items[i]).attr('href');

                        $("#search-menu").append(

                            `<li class="aiz-side-nav-item"><a href="${link}" class="aiz-side-nav-link"><i class="las la-ellipsis-h aiz-side-nav-icon"></i><span>${text}</span></a></li`

                            );

                    }

                } else {

                    $("#search-menu").html(

                        `<li class="aiz-side-nav-item"><span	class="text-center text-muted d-block">{{ translate('Nothing Found') }}</span></li>`

                        );

                }

            } else {

                $("#main-menu").removeClass('d-none');

                $("#search-menu").html('')

            }

        }

    </script>


<script>
    var ts2 = 1484418600000;
var dates = [];
var spikes = [5, -5, 3, -3, 8, -8];
for (var i = 0; i < 120; i++) {
  ts2 = ts2 + 86400000;
  var innerArr = [ts2, dataSeries[1][i].value];
  dates.push(innerArr);
}

var options = {
  chart: {
    type: "area",
    stacked: false,
    height: 350,
    zoom: {
      type: "x",
      enabled: true
    },
    toolbar: {
      autoSelected: "zoom"
    }
  },
  dataLabels: {
    enabled: false
  },
  series: [
    {
      name: "XYZ MOTORS",
      data: dates
    }
  ],
  markers: {
    size: 0
  },
  title: {
    text: "sales Price Movement",
    align: "left"
  },
  fill: {
    type: "gradient",
    gradient: {
      shadeIntensity: 1,
      inverseColors: false,
      opacityFrom: 0.5,
      opacityTo: 0,
      stops: [0, 90, 100]
    }
  },
  yaxis: {
    min: 20000000,
    max: 250000000,
    labels: {
      formatter: function(val) {
        return (val / 1000000).toFixed(0);
      }
    },
    title: {
      text: "Price"
    }
  },
  xaxis: {
    type: "datetime"
  },

  tooltip: {
    shared: false,
    y: {
      formatter: function(val) {
        return (val / 1000000).toFixed(0);
      }
    }
  }
};

var chart = new ApexCharts(document.querySelector("#salechart"), options);

chart.render();


// Revenue
    var options = {
          series: [{
            name: "Updates",
            data: [45, 52, 38, 24, 33, 26, 21, 20, 6, 8, 15, 10]
          },
          {
            name: "Revenue",
            data: [35, 41, 62, 42, 13, 18, 29, 37, 36, 51, 32, 35]
          },
          {
            name: 'Users',
            data: [87, 57, 74, 99, 75, 38, 62, 47, 82, 56, 45, 47]
          }
        ],
          chart: {
          height: 350,
          type: 'line',
          zoom: {
            enabled: false
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          width: [5, 7, 5],
          curve: 'straight',
          dashArray: [0, 8, 5]
        },
        title: {
          text: '',
          align: 'left'
        },
        legend: {
          tooltipHoverFormatter: function(val, opts) {
            return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + ''
          }
        },
        markers: {
          size: 0,
          hover: {
            sizeOffset: 6
          }
        },
        xaxis: {
          categories: ['01 Jan', '02 Jan', '03 Jan', '04 Jan', '05 Jan', '06 Jan', '07 Jan', '08 Jan', '09 Jan',
            '10 Jan', '11 Jan', '12 Jan'
          ],
        },
        tooltip: {
          y: [
            {
              title: {
                formatter: function (val) {
                  return val + " (mins)"
                }
              }
            },
            {
              title: {
                formatter: function (val) {
                  return val + " per session"
                }
              }
            },
            {
              title: {
                formatter: function (val) {
                  return val;
                }
              }
            }
          ]
        },
        grid: {
          borderColor: '#f1f1f1',
        }
        };

        var chart = new ApexCharts(document.querySelector("#revenue"), options);
        chart.render();



// Order By Location    
var options = {
          series: [{
          data: [
             @foreach($orderalldata as $countryvalue)
                 '{{$countryvalue->totalcount}}',
              @endforeach
          ]
        }],

        //   series: [{
        //   data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380]
        // }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            barHeight: '100%',
            distributed: true,
            horizontal: true,
            dataLabels: {
              position: 'bottom'
            },
          }
        },
        // colors: ['#33b2df', '#546E7A'],

        colors: ['#33b2df', '#546E7A', '#d4526e', '#13d8aa', '#A5978B', '#2b908f', '#f9a3a4', '#90ee7e',
          '#f48024', '#69d2e7', '#546E7A','#33b2df', '#2b908f', '#13d8aa', '#69d2e7', '#90ee7e'
        ],

        dataLabels: {
          enabled: true,
          textAnchor: 'start',
          style: {
            colors: ['#fff']
          },
          formatter: function (val, opt) {
            return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
          },
          offsetX: 0,
          dropShadow: {
            enabled: true
          }
        },
        stroke: {
          width: 1,
          colors: ['#fff']
        },
        xaxis: {
          categories: [
             @foreach($orderalldata as $countryvalue)
                 '{{$countryvalue->country}}',
            @endforeach
         ],
          // categories: ['South Korea', 'Canada', 'United Kingdom', 'Netherlands', 'Italy', 'France', 'Japan',
          //   'United States', 'China', 'India'
          // ],
        },
        yaxis: {
          labels: {
            show: false
          }
        },
        title: {
            text: '',
            align: 'center',
            floating: true
        },
        subtitle: {
            text: '',
            align: 'center',
        },
        tooltip: {
          theme: 'dark',
          x: {
            show: false
          },
          y: {
            title: {
              formatter: function () {
                return ''
              }
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#locationchart"), options);
        chart.render();




</script>


</body>



</html>

