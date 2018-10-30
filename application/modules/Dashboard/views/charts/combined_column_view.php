<!--chart_container-->
<div id="<?php echo $chart_name; ?>_container"></div>
<input type="hidden" data-filters="<?php echo $selectedfilters; ?>" id="<?php echo $chart_name; ?>_filters"/>

<!--highcharts_configuration-->
<script type="text/javascript">
    $(function () {
        var chartDIV = '<?php echo $chart_name."_container"; ?>';

        Highcharts.setOptions({
            colors: ['#5cb85c', '#434348']
        });

        Highcharts.chart(chartDIV, {
            legend: {
                enabled: true,
                reversed: false
            },

            chart: {
                type: 'column'
            },
            
            title: {
                text: '<?php echo $chart_title; ?>'
            },
            subtitle: {
                text: '<?php echo $chart_source; ?>'
            },

            xAxis: {
                categories: <?php echo $chart_categories; ?>,
                crosshair: true
            },

            yAxis: {
                allowDecimals: false,
                min: 0,
                tickInterval: 1000,
                title: {
                    text: '<?php echo $chart_yaxis_title; ?>',
                }
            },

            tooltip: {
                headerFormat: '<b>{point.x}</b><br/>',
                pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b><br/>',
                shared: true
            },

            plotOptions: {
                column: {
                    dataLabels: {
                        color: 'black'
                    }
                }
            },

            credits: {
                enabled: false
            },

            series: <?php echo $chart_series_data; ?>,
        });
    })
</script>
