@push('styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@^2"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-chart-matrix@1.1"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@^1"></script>
<script src="{{ asset('assets/plugins/amcharts/core.min.js') }}"></script>
<script src="{{ asset('assets/plugins/amcharts/maps.min.js') }}"></script>
<script src="{{ asset('assets/plugins/amcharts/geodata/worldLow.min.js') }}"></script>
<script src="{{ asset('assets/plugins/amcharts/themes/animated.min.js') }}"></script>
<script>

    $(document).on('click', '.ecommerce-analytics', function() {
        $(this).addClass('active');
        $('.google-analytics').removeClass('active');
        $('.ecommerce-analytics-content').show();
        $('.google-analytics-content').hide();
    })
    $(document).on('click', '.google-analytics', function() {
        $(this).addClass('active');
        $('.ecommerce-analytics').removeClass('active');
        $('.ecommerce-analytics-content').hide();
        $('.google-analytics-content').show();
    })
    var monthly_sales_label = @json($monthly_sales['monthly_range']);
    var monthly_sales_data = @json($monthly_sales['monthly_sales']);
    var monthly_sales_year = "{{ $monthly_sales['year'] }}";
    var monthly_sales_graph = '';

    var daily_sales_label = @json($daily_sales['daily_sales_range']);
    var daily_sales_data = @json($daily_sales['daily_sales']);
    var d_start_year = "{{ $daily_sales['start_year'] }}";
    var d_end_year = "{{ $daily_sales['end_year'] }}";
    var daily_sales_graph = '';

    var bounce_rate_label = @json($bounce_rate['label']);
    var bounce_rate_data = @json($bounce_rate['data']);
    var bounce_rate_year = "{{ $bounce_rate['year'] }}";
    var bounce_rate_graph = '';

    var geo_map_data = @json($users_country);
    var daily_orders = @json($daily_orders['data']);
    var daily_orders_year = @json($daily_orders['year']);
    var order_by_day_graph = '';
    
    var monthly_sales_route = "{{ route('get.monthly.sales') }}";
    var bounce_rate_route = "{{ route('get.bounce.rate') }}";
    var order_by_day_route = "{{ route('get.order.by.day') }}";
    var users_by_country_route = "{{ route('get.users.by.country') }}";

    $(document).on('change', '.monthly-sales-filter', function() {
        var filter = $(this).val();
        $.ajax({
            type: 'GET',
            data: {
                filter: filter + '-01', //convert year to year-month (2021 = 2021-01)
            },
            url: monthly_sales_route,
            async: false,
            success: function(response) {
                if (response.status) {
                    monthly_sales_graph.destroy();
                    monthly_sales(response.data.monthly_range, response.data.monthly_sales, response.data.year);
                } else {
                    console.log('No data');
                }
            }
        });
    });

    $(document).on('change', '.bounce-rate-filter', function() {
        var filter = $(this).val();
        $.ajax({
            type: 'GET',
            data: {
                filter: filter + '-01', //convert year to year-month (2021 = 2021-01)
            },
            url: bounce_rate_route,
            async: false,
            success: function(response) {
                if (response.status) {
                    average_bounce_rate = parseFloat(response.data.average_bounce_rate).toFixed(2);
                    bounce_rate_graph.destroy();
                    $('.average-bounce-rate').html(average_bounce_rate + '%');
                    bounce_rate(response.data.label, response.data.data, response.data.year);
                } else {
                    console.log('No data');
                }
            }
        });
    });

    $(document).on('change', '.order-by-day-filter', function() {
        var filter = $(this).val();
        $.ajax({
            type: 'GET',
            data: {
                filter: filter + '-01', //convert year to year-month (2021 = 2021-01)
            },
            url: order_by_day_route,
            async: false,
            success: function(response) {
                if (response.status) {
                    daily_orders = response.data;
                    daily_orders_year = response.year;
                    order_by_day_graph.destroy();
                    order_by_day(daily_orders, daily_orders_year);
                } else {
                    console.log('No data');
                }
            }
        });
    });
    
    var daily_route = "{{ route('get.daily.sales') }}";
    $('.daily-start-date').datepicker({
        format: 'yyyy-mm-dd',
    });
    $('.daily-end-date').datepicker({
        format: 'yyyy-mm-dd',
    });
    $(document).on('change', '.daily-end-date', function() {
        var start = $('.daily-start-date').val();
        var end = $(this).val();
        $.ajax({
            type: 'GET',
            data: {
                start: start,
                end: end
            },
            url: daily_route,
            async: false,
            success: function(response) {
                if (response.status) {
                    daily_sales_graph.destroy();
                    daily_sales(response.data.daily_sales_range, response.data.daily_sales, response.data.start_year, response.data.end_year);
                } else {
                    console.log('No data');
                }
            }
        });
    });

    function bounce_rate(bounce_rate_label, bounce_rate_data, bounce_rate_year) {
        bounce_rate_graph = new Chart(document.getElementById("bounce-rate-chart"), {
            type: 'line',
            data: {
                labels: bounce_rate_label,
                datasets: [{
                    label: "Rate(%)",
                    data: bounce_rate_data,
                    fill: true,
                    pointRadius: 3,
                    pointBorderColor: 'rgb(0,0,0)',
                    tension: 0.4,
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            usePointStyle: true,
                        },
                        display: false,
                    },
                    title: {
                        display: true,
                        text: 'Monthly Bounce Rate(%) of Year ' + bounce_rate_year
                    }
                },
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
            }
        });
    }

    const backgroundColor = ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'];
    const borderColor = ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'];

    function generateStackedBarData(sales_data) {
        var array_data = Object.keys(sales_data);
        const data = [];
        array_data.map(function(item, index) {
            data.push({
                label: item,
                data: sales_data[item],
                borderRadius: 5,
                borderWidth: 1,
                backgroundColor: backgroundColor[index],
            });
        });
        return data;
    }

    function generateStackedLineData(sales_data) {
        var array_data = Object.keys(sales_data);
        const data = [];
        array_data.map(function(item, index) {
            data.push({
                label: item,
                data: sales_data[item],
                pointRadius: 3,
                pointBorderColor: borderColor[index],
                tension: 0.4,
                borderColor: borderColor[index],
                backgroundColor: backgroundColor[index],
            });
        });
        return data;
    }

    new Chart(document.getElementById("bar-chart-week-daily"), {
        type: 'bar',
        data: {
                labels: ["Sun", "Mon", "Tues", "Wed", "Thurs", "Fri", "Sat"],
                datasets: generateStackedBarData(@json($this_week_daily_sales)),
        },
        options: {
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Daily Sales of this week'
                }
            },
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
        }
    });
    
    function monthly_sales(monthly_sales_label, monthly_sales_data, monthly_sales_year) {
        monthly_sales_graph = new Chart(document.getElementById("bar-chart-monthly"), {
            type: 'bar',
            data: {
                labels: monthly_sales_label,
                datasets: generateStackedBarData(monthly_sales_data),
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Monthly Sales of Year ' + monthly_sales_year
                    }
                },
                maintainAspectRatio: false,
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        beginAtZero: true,
                        stacked: true
                    }
                },

            }
        });
    }

    function daily_sales(daily_sales_label, daily_sales_data, d_start_year, d_end_year) {
        if (d_start_year == d_end_year) {
            var year = d_start_year;
        } else {
            var year = d_start_year + ' - ' + d_end_year;
        }
        daily_sales_graph = new Chart(document.getElementById("line-chart-last-30-days"), {
            type: 'line',
            data: {
                labels: daily_sales_label,
                datasets: generateStackedLineData(daily_sales_data),
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Daily Sales of Year ' + year
                    }
                },
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },

            }
        });
    }

    new Chart(document.getElementById("doughnut-chart-payment"), {
        type: 'doughnut',
        data: {
            labels: @json(($payment_type != null) ?  $payment_type['payment_type_group'] : []),
            datasets: [{
                label: "Payment Types",
                backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9"],
                data: @json(($payment_type != null) ? $payment_type['data'] : [])
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Payment Method Used'
                }
            },
            maintainAspectRatio: false,
        }
    });

    new Chart(document.getElementById("doughnut-chart-currencies"), {
        type: 'doughnut',
        data: {
            labels: @json($currencies['currency']),
            datasets: [{
                label: "Currencies",
                backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9"],
                data: @json($currencies['data'])
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Currencies Used'
                }
            },
            maintainAspectRatio: false,
        }
    });

    new Chart(document.getElementById("hourly-orders-count-chart"), {
        type: 'bar',
        data: {
            labels: @json($hourly_orders_range),
            datasets: [{
                label: "Orders Count",
                data: @json($hourly_orders_count),
                borderRadius: 5,
                borderWidth: 1,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: 'Hourly Orders Count'
                }
            },
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },

        }
    });

    const colorScale = ['#f2f2f2', '#e6eff7', '#d4e1ed', '#c9def2', '#a5d2e8', '#7bbee6', '#54a4d7', '#3586ca', '#2069b4', '#2c5490'];
    const bordercolorScale = ['#404570', '#4a5082', '#545a92', '#5d64a2', '#6d73ab', '#7d83b5', '#8e92be', '#9ea1c7', '#aeb0d0', '#bec0da'];

    function generateData(daily_orders) {
        const data = [];
        var date = '';
        daily_orders.map(function(item, index) {
            date = moment(item.date);
            data.push({
                x: date.format('YYYY-MM-DD'),
                y: date.format('e'),
                d: date.format('ll'),
                v: item.value
            });
        });
        return data;
    }

    function order_by_day(daily_orders, daily_orders_year) {
        order_by_day_graph = new Chart(document.getElementById("order-by-day-matrix-chart"), {
            type: 'matrix',
            data: {
                datasets: [{
                    label: 'My Matrix',
                    data: generateData(daily_orders), 
                    backgroundColor: function(c) {
                        const value = c.dataset.data[c.dataIndex].v;
                        const alpha = (10 + value) / 60;
                        return colorScale[(value / alpha).toFixed()];
                    },
                    borderColor: function(c) {
                        const value = c.dataset.data[c.dataIndex].v;
                        const alpha = (10 + value) / 60;
                        return bordercolorScale[(value / alpha).toFixed()];
                    },
                    borderWidth: 1,
                    borderSkipped: false,
                    hoverBackgroundColor: '#00b0a0',
                    hoverBorderColor: '#00b0a0',
                    width: 25,
                    height: 25
                }]
            },
            options: {
                aspectRatio: 5,
                plugins: {
                    legend: false,
                    title: {
                        display: true,
                        text: 'Daily Orders of Year ' + daily_orders_year
                    },
                    responsive: true,
                    tooltip: {
                        callbacks: {
                            title() {
                                return '';
                            },
                            label(context) {
                                const v = context.dataset.data[context.dataIndex];
                                return [v.d, 'orders: ' + v.v];
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        type: 'time',
                        position: 'left',
                        offset: true,
                        time: {
                            unit: 'day',
                            parser: 'e',
                            displayFormats: {
                                day: 'ddd'
                            }
                        },
                        reverse: true,
                        ticks: {
                            maxRotation: 0,
                            autoSkip: true,
                            padding: 1,
                            font: {
                                size: 12,
                            }
                        },
                        grid: {
                            display: false,
                            drawBorder: false,
                            tickLength: 0,
                        }
                    },
                    x: {
                        type: 'time',
                        position: 'bottom',
                        offset: true,
                        time: {
                            unit: 'month',
                            round: 'week',
                            displayFormats: {
                                month: 'MMM'
                            }
                        },
                        ticks: {
                            maxRotation: 0,
                            autoSkip: true,
                            font: {
                                size: 12,
                            }
                        },
                        grid: {
                            display: false,
                            drawBorder: false,
                            tickLength: 0,
                        }
                    }
                },
                layout: {
                    padding: {
                        top: 10
                    }
                }
            }
        });
    }
    monthly_sales(monthly_sales_label, monthly_sales_data, monthly_sales_year);
    daily_sales(daily_sales_label, daily_sales_data, d_start_year, d_end_year);
    bounce_rate(bounce_rate_label, bounce_rate_data, bounce_rate_year);
    order_by_day(daily_orders, daily_orders_year);
</script>
<script src="{{ asset('assets/js/google-analytics-map.js') }}"></script>
@endpush