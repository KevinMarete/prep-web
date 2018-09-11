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
            </div>
            <div>
                <div class="row">
                  <ul class="nav nav-tabs" id="status_tabs" role="tablist" >
                    <li class="nav-item">
                      <a class="nav-link active" href="#summary" id="summary-tab" data-toggle="tab" role="tab" aria-controls="summary" aria-selected="true" >Summary</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#facilities" id="facilities-tab" data-toggle="tab" role="tab" aria-controls="summary" aria-selected="false" >Facilities</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#partners" id="partners-tab" data-toggle="tab" role="tab" aria-controls="summary" aria-selected="false" >Partners</a>
                    </li>
                  </ul>
                </div>

                <div class="tab-content" id="status_tabsContent">
                <div class="tab-pane fade in active col-md-12" id="summary" role="tabpanel" aria-labelledby="summary-tab" >
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


                <div class="tab-pane fade col-md-12" id="facilities" role="tabpanel" aria-labelledby="facilities">
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
                    <div id="container" style="height: 500px ; margin-left: 0" class="col-md-10 col-md-offset-2"></div>
                </div>



                <div class="tab-pane fade col-md-12" id="partners" role="tabpanel" aria-labelledby="partners">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Partner Facility Numbers<span class="label label-warning">Drilldown</span>
                        </div>
                        <div class="chart-wrapper">
                            <div class="chart-stage">
                                <div id="partner_facility_table"></div>
                            </div>
                            <div class="chart-notes">
                                <span class="partner_facility_table_heading heading"></span>
                            </div>
                        </div>
                    </div>
                    <div id="container" style="height: 500px ; margin-left: 0" class="col-md-10 col-md-offset-2"></div>
                </div>

                </div>
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

    <section id="gallery" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-4 col-xs-12">
                    <div class="section-title">
                        <h2 class="head-title lg-line">Gallery</h2>
                        <hr class="botm-line">
                    </div>
                </div>
          </div>
          <div class="modal fade" id="galleryModal" tabindex="-1" role="dialog" aria-labelledby="galleryModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="galleryModalLabel">Gallery Title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">

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
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
          </div>
          </div>
          </div>

          &nbsp;
          <div class="container">
          <div class="row">
            <hr>
            <div class="col-md-4">
              <img src="https://picsum.photos/g/900/600/?random" class="img-responsive center-block" alt="..." class="img-thumbnail">
              <h5>Gallery Title</h5>
              <p><a href="#" data-toggle="modal" data-target="#galleryModal">View</a></p>
            </div>
            <div class="col-md-4">
              <img src="https://picsum.photos/g/900/600/?random" class="img-responsive center-block" alt="..." class="img-thumbnail">
              <h5>Gallery Title</h5>
              <p><a href="#" data-toggle="modal" data-target="#galleryModal"  >View</a></p>
            </div>
            <div class="col-md-4">
              <img src="https://picsum.photos/g/900/600/?random" class="img-responsive center-block" alt="..." class="img-thumbnail">
              <h5>Gallery Title</h5>
              <p><a href="#" data-toggle="modal" data-target="#galleryModal" >View</a></p>
            </div>

          </div>
        </div>
        </div>
    </section>

    <section id="policies" class="section-padding">
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

    $('#status_tabs a[href="#summary"]').tab('show')

    $('#status_tabs a').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show')
    })

    </script>

</body>
</html>
