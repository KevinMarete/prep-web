<!--chart_container-->
<div id="<?php echo $chart_name; ?>_container"></div>
<input type="hidden" data-filters="<?php echo $selectedfilters; ?>" id="<?php echo $chart_name; ?>_filters"/>

<!--high charts_configuration-->
<script type="text/javascript">
    $(function () {
        var chartDIV = '<?php echo $chart_name . "_container"; ?>'

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
                type: 'column',
                events: {
                    drilldown: function (e) {
                        if (!e.seriesOptions) {

                            var chart = this,
                                    drilldowns = <?php echo $chart_drilldown_data; ?>,
                                    series = drilldowns[e.point.name];

                            // Show the loading label
                            chart.showLoading('loading...');

                            setTimeout(function () {
                                chart.hideLoading();
                                chart.addSeriesAsDrilldown(e.point, series);
                            }, 1000);
                        }

                    }
                }
            },
            colors: ['#008080'],

            title: {
                text: '<?php echo $chart_title; ?>'
            },
            subtitle: {
                text: '<?php echo $chart_source; ?>'
            },
            credits: false,
            xAxis: {
                type: 'category'
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
                    rV += '<span style="color:'+ this.series.color + '"><b>'+ this.series.name +'</b></span>: ' + Highcharts.numberFormat(this.y, 0) + '('+Highcharts.numberFormat((this.y / total_sum) * 100, 1)+' %)<br/>'
                    return rV;
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
                    colorByPoint: true,
                    dataLabels: {
                        enabled: true,
                        rotation: 0,
                    }
                },
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            series: [{
                    name: '<?php echo $chart_yaxis_title; ?>',
                    colorByPoint: true,
                    data: <?php echo $chart_series_data; ?>
                }],
            drilldown: {
                series: <?php echo $chart_drilldown_data; ?>
            },
            exporting: {
                enabled: true
            }
        });

    });
</script>