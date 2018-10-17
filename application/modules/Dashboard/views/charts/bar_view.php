<!--chart_container-->
<div id="<?php echo $chart_name; ?>_container"></div>
<input type="hidden" data-filters="<?php echo $selectedfilters; ?>" id="<?php echo $chart_name; ?>_filters"/>

<!--highcharts_configuration-->
<script type="text/javascript">
    $(function () {
        var chartDIV = '<?php echo $chart_name."_container"; ?>'

        Highcharts.setOptions({
            global: {
                useUTC: false,
                
            },
            lang: {
              decimalPoint: '.',
              thousandsSep: ','
            }
        });

        Highcharts.chart(chartDIV, {
            chart: {
                type: 'bar'
            },
            colors: ['#008080', '#aaaebc', '#5cb85c', '#434348', '#5bc0de', '#f7a35c', '#8085e9', '#ff4d4d', '#bdb76b', '#FF1493', '#CD5C5C', '#0000CD'],
            title: {
                text: '<?php echo $chart_title; ?>'
            },
            subtitle: {
                text: '<?php echo $chart_source; ?>'
            },
            credits: false,
            xAxis: {
                categories: <?php echo $chart_categories; ?>,
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: '<?php echo $chart_yaxis_title; ?>'
                }
            },
            tooltip: {
                formatter: function () {
                    var total_sum = 0;
                    $.each(this.series.data, function(i, v){
                        total_sum += v.y;
                    });
                    var rV = '<b>' + this.key + '</b><br/>'
                    rV += '<span style="color:'+ this.series.color + '"><b>Total</b></span>: ' + Highcharts.numberFormat(this.y, 0) + '('+Highcharts.numberFormat((this.y / total_sum) * 100, 1)+' %)<br/>'
                    return rV;
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.1,
                    borderWidth: 0,
                    colorByPoint: true,
                    dataLabels: {
                        enabled: true,
                        //format: '{point.name}: {point.percentage:.1f}%',
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'black'
                    }
                },
            },
            series: [{
                showInLegend: false, 
                colorByPoint: true,
                data: <?php echo $chart_series_data; ?>
            }],
        });

    });
</script>        