<!--chart_container-->
<div id="<?php echo $chart_name; ?>_container"></div>
<input type="hidden" data-filters="<?php echo $selectedfilters; ?>" id="<?php echo $chart_name; ?>_filters"/>

<!--highcharts_configuration-->
<script type="text/javascript">
    $(function () {
        var chartDIV = '<?php echo $chart_name . "_container"; ?>'
        var chart;

        // chart start
        $(document).ready(function () {
            Highcharts.setOptions({
                global: {
                    useUTC: false,

                },
                lang: {
                    decimalPoint: '.',
                    thousandsSep: ','
                },
            });

            chart = new Highcharts.Chart({
                chart: {
                    renderTo: chartDIV,
                    type: 'column'
                },
                colors: ['#008080', '#aaaebc', '#5cb85c', '#434348', '#5bc0de', '#f7a35c', '#8085e9', '#ff4d4d', '#bdb76b', '#FF1493', '#CD5C5C', '#0000CD'],
                title: {
                    text: '<?php echo $chart_title; ?>'
                },
                subtitle: {
                    text: '<?php echo $chart_source; ?>'
                },
                xAxis: {
                    categories: <?php echo $chart_categories; ?>
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: '<?php echo $chart_yaxis_title; ?>'
                    }
                },
                stackLabels: {
                    enabled: false,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                },
                tooltip: {
                    headerFormat: '<b>{point.x}</b><br/>',
                    pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
                    footerFormat: 'Total: <b>{point.total:,.0f}</b>',
                    shared: true
                },
                legend: {
                    align: 'right',
                    x: -30,
                    verticalAlign: 'top',
                    y: 25,
                    floating: true,
                    backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                    borderColor: '#CCC',
                    borderWidth: 1,
                    shadow: false
                },
                plotOptions: {
                    column: {
                        stacking: 'percent',
                        dataLabels: {
                            enabled: false,
                            color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                        }
                    }
                },
                credits: false,
                exporting: {
                    enabled: true
                },
                series: <?php echo $chart_series_data; ?>
            });
        });

    });
</script>