<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $page_title; ?></title>
        <?php $this->load->view('template/style_view'); ?>
    </head>
    <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
        <!--navbar_view-->
        <?php $this->load->view('template/navbar_view'); ?>
        <!--prep journey-->
        <section id="prep_journey">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <div class="section-title">
                            <h2 class="head-title lg-line">PREP Journey</h2>
                            <hr class="botm-line">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <img src="<?php echo base_url() . 'public/home/img/prep-journey.png'; ?>" class="img-responsive" style="width: 4000px">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--maps-->
    <section id="status_in_kenya" class="content section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4 col-xs-12">
                        <div class="section-title">
                            <h2 class="head-title lg-line">Status in Kenya</h2>
                            <hr class="botm-line">
                        </div>
                </div>
                <div class="col-md-12">
                    <div class="col-sm-6 col-md-4">
                        <div class="">
                          <div class="text-center">
                            <h1 class="large_numbers">1,600,000</h1>
                            <hr>
                            <p>Number of People with HIV (2016)</p>
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="">
                          <div class="caption text-center">
                            <h1 class="large_numbers">62,000</h1>
                            <hr>
                            <p>New Infections (2016)</p>
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="">
                          <div class="caption text-center">
                            <h1 class="large_numbers">23,000</h1>
                            <hr>
                            <p>Prep Clients (2016)</p>
                          </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Facility Distribution by County<span class="label label-warning">Drilldown</span>
                        </div>
                        <div class="panel-body">
                            <div id="facility_count_distribution_chart"></div>
                        </div>
                        <div class="panel-footer">
                            <span class="facility_count_distribution_chart_heading heading"></span>
                        </div>
                    </div>
                </div>
                <div id="container" style="height: 500px ; margin-left: 0" class="col-md-10 col-md-offset-2"></div>
            </div>
        </div>
        <script>
            var api_data;
            $.get("json/kenya.json", function (datam, status) {
                api_data = datam.data;
                var data = Highcharts.geojson(api_data),
                        separators = Highcharts.geojson(api_data, 'mapline'),
                        // Some responsiveness
                        small = $('#container').width() < 400;

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
        </script>
    </section>
    <!--about-->

    <section id="resources" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="section-title">
                        <h2 class="head-title lg-line">Gallery</h2>
                        <hr class="botm-line">
                    </div>
                </div>
          </div>

          <div id="carousel-example-generic" class="col-md-12 carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
              <li data-target="#carousel-example-generic" data-slide-to="1"></li>
              <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
              <div class="item active">
                <img src="https://picsum.photos/g/900/600/?random" class="img-responsive center-block" alt="...">
                <div class="carousel-caption">
                  <h5>First</h5>
                  <p>First caption</p>
                </div>
              </div>
              <div class="item">
                <img src="https://picsum.photos/g/900/600/?random" class="img-responsive center-block" alt="...">
                <div class="carousel-caption">
                  <h5>Second Title</h5>
                  <p>Second Caption</p>
                </div>
              </div>
              <div class="item">
                <img src="https://picsum.photos/g/900/600/?random" class="img-responsive center-block" alt="...">
                <div class="carousel-caption">
                  <h5>Third Title</h5>
                  <p>Third Caption</p>
                </div>
              </div>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
          &nbsp;
          <div class="row">
            <hr>
            <div class="col-md-4">
              <img src="https://picsum.photos/g/900/600/?random" class="img-responsive center-block" alt="..." class="img-thumbnail">
              <h5>Gallery Title</h5>
              <p><a href="#">View</a></p>
            </div>
            <div class="col-md-4">
              <img src="https://picsum.photos/g/900/600/?random" class="img-responsive center-block" alt="..." class="img-thumbnail">
              <h5>Gallery Title</h5>
              <p><a href="#">View</a></p>
            </div>
            <div class="col-md-4">
              <img src="https://picsum.photos/g/900/600/?random" class="img-responsive center-block" alt="..." class="img-thumbnail">
              <h5>Gallery Title</h5>
              <p><a href="#">View</a></p>
            </div>

          </div>
        </div>
    </section>

    <section id="national_policies_guidelines" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="section-title">
                        <h2 class="head-title lg-line">National Policies and Guidelines</h2>
                        <hr class="botm-line">
                    </div>
                </div>
            </div>
            &nbsp;
            <div class="row">
              <div class="col-sm-6 col-md-4">
                  <div class="thumbnail">
                    <img src="https://picsum.photos/g/300/450/" alt="">
                    <div class="caption">
                      <h5>Prep Booklet V2 2018</h5>
                      <p>Description of Prep Booklet V2 of 2018.</p>
                      <p><a href="#">Download <i class="fa fa-download" aria-hidden="true"></i></a></p>
                    </div>
                  </div>
              </div>
        </div>
    </section>

    <section id="publications" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="section-title">
                        <h2 class="head-title lg-line">Publications</h2>
                        <hr class="botm-line">
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="input-group col-xs-12">
                <label for="Year">Year</label>
                <select class="" name="Year">
                  <option value="">2018</option>
                </select>
                <label for="Topic">Topic</label>
                <select class="" name="Topic">
                  <option value="">Partners</option>
                </select>
              </div>
            </div>
            &nbsp;
            <div class="row">
              <div class="col-sm-6 col-md-4">
                  <div class="thumbnail">
                    <img src="https://picsum.photos/g/300/450/" alt="">
                    <div class="caption">
                      <h5>Prep Booklet V2 2018</h5>
                      <p>Description of Prep Booklet V2 of 2018</p>
                      <p><a href="#">Download <i class="fa fa-download" aria-hidden="true"></i></a></p>
                    </div>
                  </div>
              </div>
              <div class="col-sm-6 col-md-4">
                  <div class="thumbnail">
                    <img src="https://picsum.photos/g/300/450/" alt="">
                    <div class="caption">
                      <h5>Prep Booklet V3 2019</h5>
                      <p>Description of Prep Booklet V3 of 2019</p>
                      <p><a href="#">Download <i class="fa fa-download" aria-hidden="true"></i></a></p>
                    </div>
                  </div>
              </div>
            </div>
        </div>
    </section>

    <section id="faq" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="section-title">
                        <h2 class="head-title lg-line">FAQs</h2>
                        <hr class="botm-line">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                  <img src="<?php echo base_url(); ?>public/home/img/prep_faqSheet_cover.png" alt="Prep FAQs" class="img-responsive">
                  <div class="caption">
                    <h5>Prep Booklet 2018 V2 - English </h5>
                    <p>Description of Version 2 Prep Booklet of 2018 in English(GB)</p>
                    <p><a href="#">Download <i class="fa fa-download" aria-hidden="true"></i></a></p>
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-9 col-sm-8 col-xs-12">
                  <div style="visibility: visible;" class="col-sm-9 more-features-box">
                      <div class="more-features-box-text">
                          <div class="more-features-box-text-icon"> <i class="fa fa-angle-right" aria-hidden="true"></i> </div>
                          <div class="more-features-box-text-description">
                              <h3>Question One</h3>
                              <p>Stub Answer One</p>
                          </div>
                      </div>
                      <div class="more-features-box-text">
                          <div class="more-features-box-text-icon"> <i class="fa fa-angle-right" aria-hidden="true"></i> </div>
                          <div class="more-features-box-text-description">
                              <h3>Question Two</h3>
                              <p>Stub Answer Two</p>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </section>
    <!--/ about-->
    <!--contact-->
    <?php $this->load->view('template/contact_view'); ?>
    <!--footer-->
    <?php $this->load->view('template/footer_view');
    ?>
    <!--script_view-->
    <?php $this->load->view('template/script_view'); ?>

    <script>
        var chartURL = 'Home/get_chart'
        var countyURL = 'API/County'
        var filters = {}
        $(document).ready(function () {
            var charts = ['facility_count_distribution_chart']

            //Add filter to chart then load chart
            setChartFilter('')

            //Load Charts
            $.each(charts, function (key, chartName) {
                LoadChart('#' + chartName, chartURL, chartName, {})
            });

            //Filter click Event
            $(".filter_btn").on("click", FilterBtnHandler);

            //Clear click Event
            $(".clear_btn").on("click", ClearBtnHandler);
        });

        function setChartFilter(chartName, filterURL) {
            $.ajax({
                url: filterURL,
                datatype: 'JSON',
                success: function (data) {
                    filterID = '#' + chartName + '_filter'
                    //Create multiselect box
                    CreateSelectBox(filterID, '100%', 10)
                    //Add data to selectbox
                    $(filterID + " option").remove();
                    $.each(data, function (i, v) {
                        $(filterID).append($("<option value='" + v.name + "'>" + v.name.toUpperCase() + "</option>"));
                    });
                    $(filterID).multiselect('rebuild');
                    //$(filterID).data('filter_type', 'drug');
                },
                complete: function () {
                    LoadChart('#' + chartName, chartURL, chartName, {})
                }
            });
        }

        function CreateSelectBox(elementID, width, limit) {
            $(elementID).val('').multiselect({
                enableCaseInsensitiveFiltering: true,
                enableFiltering: true,
                disableIfEmpty: true,
                maxHeight: 300,
                buttonWidth: width,
                nonSelectedText: 'None selected',
                includeSelectAllOption: false,
                selectAll: false,
                onChange: function (option, checked) {
                    //Get selected options.
                    var selectedOptions = $(elementID + ' option:selected');
                    if (selectedOptions.length >= limit) {
                        //Disable all other checkboxes.
                        var nonSelectedOptions = $(elementID + ' option').filter(function () {
                            return !$(this).is(':selected');
                        });
                        nonSelectedOptions.each(function () {
                            var input = $('input[value="' + $(this).val() + '"]');
                            input.prop('disabled', true);
                            input.parent('li').addClass('disabled');
                        });
                    } else {
                        //Enable all checkboxes.
                        $(elementID + ' option').each(function () {
                            var input = $('input[value="' + $(this).val() + '"]');
                            input.prop('disabled', false);
                            input.parent('li').addClass('disabled');
                        });
                    }
                }
            });
        }

        function LoadSpinner(divID) {
            var spinner = new Spinner().spin()
            $(divID).empty('')
            $(divID).height('auto')
            $(divID).append(spinner.el)
        }

        function LoadChart(divID, chartURL, chartName, selectedfilters) {
            //Load Spinner
            LoadSpinner(divID)
            //Load Chart*
            $(divID).load(chartURL, {'name': chartName, 'selectedfilters': selectedfilters}, function () {
                //Pre-select filters for charts
                $.each($(divID + '_filters').data('filters'), function (key, data) {
                    if ($.inArray(key, ['county', 'subcounty']) == -1) {
                        $(divID + "_filter").val(data).multiselect('refresh');
                        //Output filters
                        var filtermsg = '<b><u>' + key.toUpperCase() + ':</u></b><br/>'
                        if ($.isArray(data)) {
                            filtermsg += data.join('<br/>')
                        } else {
                            filtermsg += data
                        }
                        $("." + chartName + "_heading").html(filtermsg)
                    }
                });
            });
        }

        function FilterBtnHandler(e) {
            var filterName = String($(e.target).attr("id")).replace('_btn', '')
            var filterID = "#" + filterName
            var filterType = $(filterID).data('filter_type')
            var chartName = filterName.replace('_filter', '')
            var chartID = "#" + chartName


            if ($(filterID).val() != null) {
                filters[filterType] = $(filterID).val()
            }

            LoadChart(chartID, chartURL, chartName, filters)

            //Hide Modal
            $(filterID + '_modal').modal('hide')
        }

        function ClearBtnHandler(e) {
            var filterName = String($(e.target).attr("id")).replace('_clear_btn', '')
            var filterID = "#" + filterName
            var filterType = $(filterID).data('filter_type')

            //Clear filterType
            filters[filterType] = {}

            //Filter multiple multiselect
            $(filterID).multiselect('deselectAll', false);
            $(filterID).multiselect('updateButtonText');
            $(filterID).multiselect('refresh');

            //Trigger filter event
            $(filterID + '_btn').trigger('click');
        }
    </script>
</body>
</html>
