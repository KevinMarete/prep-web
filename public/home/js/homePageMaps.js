

            var api_data;
            $.get("json/kenya.json", function (datam, status) {
                api_data = datam.data;
                console.log(api_data)
                var data = Highcharts.geojson(api_data),
                        separators = Highcharts.geojson(api_data, 'mapline'),
                        // Some responsiveness
                        small = $('#container, #partner_container, #incidences_container').width() < 400;

                // Set drilldown pointers
                $.each(data, function (i) {
                    this.drilldown = this.properties['code'];
                    this.value = i; // Non-random bogus data
                });

                // Instantiate the map
                Highcharts.mapChart('container', {
                    chart: {
                        events: {

                            drilldown: function (e) {
                                if (!e.seriesOptions) {
                                    var county_name = e.point.name.replace(' ', '_').toLowerCase();
                                    var chart = this,
                                            mapKey = 'json/counties/' + county_name + '.json',
                                            // Handle error, the timeout is cleared on success
                                            fail = setTimeout(function () {
                                                if (mapKey.data) {
                                                    chart.showLoading('<i class="icon-frown"></i> Failed loading ' + e.point.name);
                                                    fail = setTimeout(function () {
                                                        chart.hideLoading();
                                                    }, 1000);
                                                }
                                            }, 3000);

                                    // Show the spinner
                                    chart.showLoading('<i class="icon-spinner icon-spin icon-3x"></i>'); // Font Awesome spinner



                                    $.get('json/counties/' + county_name + '.json', function (datam, status) {
                                        data = Highcharts.geojson(datam.data);
                                        // Set a non-random bogus value
                                        $.each(data, function (i) {
                                            this.value = i;
                                        });

                                        // Hide loading and add series
                                        chart.hideLoading();
                                        clearTimeout(fail);
                                        chart.addSeriesAsDrilldown(e.point, {
                                            name: e.point.name,
                                            data: data,
                                            dataLabels: {
                                                enabled: true,
                                                format: '{point.name}'
                                            }
                                        });
                                    });
                                }
                                this.setTitle(null, {text: e.point.name});
                            },
                            drillup: function () {
                                this.setTitle(null, {text: ''});
                            }
                        }
                    },
                    title: {
                        text: 'COUNTY AND SUB COUNTY'
                    },
                    tooltip:{
                      formatter:function(){
                        return '<b>'+this.key+'</b><br/> Facilities:'+this.point.properties.facility_count
                      }
                    },
                    subtitle: {
                        text: '',
                        floating: true,
                        align: 'right',
                        y: 50,
                        style: {fontSize: '16px'
                        }
                    },
                    legend: small ? {} : {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle'
                    },
                    colorAxis: {
                        min: 0,
                        minColor: '#E6E7E8',
                        maxColor: '#781006'
                    },
                    mapNavigation: {
                        enabled: true,
                        buttonOptions: {
                            verticalAlign: 'bottom'
                        }
                    },
                    plotOptions: {
                        map: {
                            states: {
                                hover: {
                                    color: '#ee6e6e'
                                }
                            }
                        },
                        series: {
                  cursor: 'pointer',
                  point: {
                      events: {
                          click: function () {
                            axios.get('<?php echo base_url()."home/get_facilities_drilldown/" ?>'+this.name).then(function (response) {
                              console.log(response);
                            })
                            .catch(function (error) {
                              console.log(error);
                            });

                          }
                      }
                  }
              }
                    },
                    series: [{
                            data: data,
                            name: 'KENYA',
                            dataLabels: {
                                enabled: true,
                                format: '{point.properties.postal-code}'
                            }
                        }, {
                            type: 'mapline',
                            data: separators,
                            color: 'silver',
                            enableMouseTracking: false,
                            animation: {
                                duration: 500
                            }
                        }],
                    drilldown: {
                        activeDataLabelStyle: {
                            color: '#FFFFFF',
                            textDecoration: 'none',
                            textOutline: '1px #000000'
                        },
                        drillUpButton: {
                            relativeTo: 'spacingBox',
                            position: {
                                x: 0,
                                y: 60
                            }
                        }
                    }
                });

                // Instantiate the map
                Highcharts.mapChart('partner_container', {
                    chart: {
                        events: {

                            drilldown: function (e) {
                                if (!e.seriesOptions) {
                                    var county_name = e.point.name.replace(' ', '_').toLowerCase();
                                    var chart = this,
                                            mapKey = 'json/counties/' + county_name + '.json',
                                            // Handle error, the timeout is cleared on success
                                            fail = setTimeout(function () {
                                                if (mapKey.data) {
                                                    chart.showLoading('<i class="icon-frown"></i> Failed loading ' + e.point.name);
                                                    fail = setTimeout(function () {
                                                        chart.hideLoading();
                                                    }, 1000);
                                                }
                                            }, 3000);

                                    // Show the spinner
                                    chart.showLoading('<i class="icon-spinner icon-spin icon-3x"></i>'); // Font Awesome spinner



                                    $.get('json/counties/' + county_name + '.json', function (datam, status) {
                                        data = Highcharts.geojson(datam.data);
                                        // Set a non-random bogus value
                                        $.each(data, function (i) {
                                            this.value = i;
                                        });

                                        // Hide loading and add series
                                        chart.hideLoading();
                                        clearTimeout(fail);
                                        chart.addSeriesAsDrilldown(e.point, {
                                            name: e.point.name,
                                            data: data,
                                            dataLabels: {
                                                enabled: true,
                                                format: '{point.name}'
                                            }
                                        });
                                    });
                                }
                                this.setTitle(null, {text: e.point.name});
                            },
                            drillup: function () {
                                this.setTitle(null, {text: ''});
                            }
                        }
                    },
                    title: {
                        text: 'COUNTY AND SUB COUNTY'
                    },
                    tooltip:{
                      formatter:function(){
                        return '<b>'+this.key+'</b><br/> Facilities:'+this.point.properties.facility_count
                      }
                    },
                    subtitle: {
                        text: '',
                        floating: true,
                        align: 'right',
                        y: 50,
                        style: {fontSize: '16px'
                        }
                    },
                    legend: small ? {} : {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle'
                    },
                    colorAxis: {
                        min: 0,
                        minColor: '#E6E7E8',
                        maxColor: '#781006'
                    },
                    mapNavigation: {
                        enabled: true,
                        buttonOptions: {
                            verticalAlign: 'bottom'
                        }
                    },
                    plotOptions: {
                        map: {
                            states: {
                                hover: {
                                    color: '#ee6e6e'
                                }
                            }
                        },
                        series: {
                  cursor: 'pointer',
                  point: {
                      events: {
                          click: function () {
                            axios.get('<?php echo base_url()."home/get_facilities_drilldown/" ?>'+this.name).then(function (response) {
                              console.log(response.data);
                            })
                            .catch(function (error) {
                              console.log(error);
                            });

                          }
                      }
                  }
              }
                    },
                    series: [{
                            data: data,
                            name: 'KENYA',
                            dataLabels: {
                                enabled: true,
                                format: '{point.properties.postal-code}'
                            }
                        }, {
                            type: 'mapline',
                            data: separators,
                            color: 'silver',
                            enableMouseTracking: false,
                            animation: {
                                duration: 500
                            }
                        }],
                    drilldown: {
                        activeDataLabelStyle: {
                            color: '#FFFFFF',
                            textDecoration: 'none',
                            textOutline: '1px #000000'
                        },
                        drillUpButton: {
                            relativeTo: 'spacingBox',
                            position: {
                                x: 0,
                                y: 60
                            }
                        }
                    }
                });

                // Instantiate the map
                Highcharts.mapChart('incidences_container', {
                    chart: {
                        events: {

                            drilldown: function (e) {
                                if (!e.seriesOptions) {
                                    var county_name = e.point.name.replace(' ', '_').toLowerCase();
                                    var chart = this,
                                            mapKey = 'json/counties/' + county_name + '.json',
                                            // Handle error, the timeout is cleared on success
                                            fail = setTimeout(function () {
                                                if (mapKey.data) {
                                                    chart.showLoading('<i class="icon-frown"></i> Failed loading ' + e.point.name);
                                                    fail = setTimeout(function () {
                                                        chart.hideLoading();
                                                    }, 1000);
                                                }
                                            }, 3000);

                                    // Show the spinner
                                    chart.showLoading('<i class="icon-spinner icon-spin icon-3x"></i>'); // Font Awesome spinner



                                    $.get('json/counties/' + county_name + '.json', function (datam, status) {
                                        data = Highcharts.geojson(datam.data);
                                        // Set a non-random bogus value
                                        $.each(data, function (i) {
                                            this.value = i;
                                        });

                                        // Hide loading and add series
                                        chart.hideLoading();
                                        clearTimeout(fail);
                                        chart.addSeriesAsDrilldown(e.point, {
                                            name: e.point.name,
                                            data: data,
                                            dataLabels: {
                                                enabled: true,
                                                format: '{point.name}'
                                            }
                                        });
                                    });
                                }
                                this.setTitle(null, {text: e.point.name});
                            },
                            drillup: function () {
                                this.setTitle(null, {text: ''});
                            }
                        }
                    },
                    title: {
                        text: 'COUNTY AND SUB COUNTY'
                    },
                    subtitle: {
                        text: '',
                        floating: true,
                        align: 'right',
                        y: 50,
                        style: {fontSize: '16px'
                        }
                    },
                    legend: small ? {} : {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle'
                    },
                    colorAxis: {
                        min: 0,
                        minColor: '#E6E7E8',
                        maxColor: '#781006'
                    },
                    mapNavigation: {
                        enabled: true,
                        buttonOptions: {
                            verticalAlign: 'bottom'
                        }
                    },
                    plotOptions: {
                        map: {
                            states: {
                                hover: {
                                    color: '#ee6e6e'
                                }
                            }
                        },
                        series: {
                  cursor: 'pointer',
                  point: {
                      events: {
                          click: function () {

                          }
                      }
                  }
              }
                    },
                    series: [{
                            data: data,
                            name: 'KENYA',
                            dataLabels: {
                                enabled: true,
                                format: '{point.properties.postal-code}'
                            }
                        }, {
                            type: 'mapline',
                            data: separators,
                            color: 'silver',
                            enableMouseTracking: false,
                            animation: {
                                duration: 500
                            }
                        }],
                    drilldown: {
                        activeDataLabelStyle: {
                            color: '#FFFFFF',
                            textDecoration: 'none',
                            textOutline: '1px #000000'
                        },
                        drillUpButton: {
                            relativeTo: 'spacingBox',
                            position: {
                                x: 0,
                                y: 60
                            }
                        }
                    }
                });
            });
