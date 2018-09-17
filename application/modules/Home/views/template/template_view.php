<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $page_title; ?></title>
        <?php $this->load->view('template/style_view'); ?>

        <!--Load Script View-->
        <?php $this->load->view('template/script_view'); ?>

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
                      <a class="nav-link" href="#facilities" id="facilities-tab" data-toggle="tab" role="tab" aria-controls="summary" aria-selected="false" >Facilities offering PrEP</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#partners" id="partners-tab" data-toggle="tab" role="tab" aria-controls="summary" aria-selected="false"> PrEP Implementing Partners</a>
                    </li>
                  </ul>
                </div>

                <div class="tab-content" id="status_tabsContent">
                <div class="tab-pane fade in active col-md-12" id="summary" role="tabpanel" aria-labelledby="summary-tab" >
                    <div class="col-sm-6 col-md-4">
                        <div class="">
                          <div class="text-center">
                            <h1 class="large_numbers">1,500,000</h1>
                            <hr>
                            <p>Number of People with HIV (2018)</p>
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
                            <h1 class="large_numbers">19,000</h1>
                            <hr>
                            <p>PrEP Clients (2018)</p>
                          </div>
                        </div>
                    </div>
                </div>


                <div class="tab-pane fade col-md-12" id="facilities" role="tabpanel" aria-labelledby="facilities">
                    <div id="container" style="height: 500px ; margin-left: 0" class="col-md-10 col-md-offset-2"></div>
                </div>



                <div class="tab-pane fade col-md-12" id="partners" role="tabpanel" aria-labelledby="partners">
                    <div id="partner_container" style="height: 500px ; margin-left: 0" class="col-md-10 col-md-offset-2"></div>
                </div>

                </div>
            </div>
        </div>
        <script>
            var api_data;
            $.get("json/kenya.json", function (datam, status) {
                api_data = datam.data;
                console.log(api_data)
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


          &nbsp;
          <div class="container">
          <div class="row">
            <hr>
            <?php foreach ($gallery_dir as $k => $v) {  $gallery_title = stripslashes($k); $gallery_id = str_replace(' ','-',$gallery_title); ?>

              <!--Gallery Thumbnail-->
              <div class="col-md-4">
                <img data-toggle="modal" data-target="#<?php echo $gallery_id ?>Modal" src="<?php echo base_url().'public/home/resources/gallery/'.stripslashes($k).'/'.$v[0] ?>" class="img-responsive img-thumbnail center-block" alt="<?php echo stripslashes($k); ?>">
                <h5><?php echo stripslashes($k); ?></h5>
                <p><a href="#" data-toggle="modal" data-target="#<?php echo $gallery_id ?>Modal">View</a></p>
              </div>

              <!--Gallery Modal-->
              <div class="modal fade" id="<?php echo $gallery_id ?>Modal" tabindex="-1" role="dialog" aria-labelledby="<?php echo $gallery_id ?>ModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="<?php echo $gallery_id ?>Label"><?php echo $gallery_title; ?></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">

                <div id="<?php echo $gallery_id ?>Carousel" class="col-md-12 carousel slide" data-ride="carousel">
                  <!-- Indicators -->
                  <ol class="carousel-indicators">
                    <?php for($i=0;$i<=count($v);$i++){ ?>
                      <li data-target="#<?php echo $gallery_id ?>Carousel" data-slide-to="<?php echo $i ?>" <?php if($i==0){echo 'active';} ?>></li>
                    <?php } ?>
                  </ol>

                  <!-- Wrapper for slides -->
                  <div class="carousel-inner" role="listbox">
                    <?php foreach ($v as $img) {?>
                      <div class="item <?php if($img == $v[0]){echo 'active';} ?>">
                        <img src="<?php echo base_url().'public/home/resources/gallery/'.stripslashes($k).'/'.$img ?>" class="img-responsive center-block" alt="<?php echo $img ?>">
                        <div class="carousel-caption">
                        </div>
                      </div>
                    <?php }?>
                  </div>

                  <!-- Controls -->
                  <a class="left carousel-control" href="#<?php echo $gallery_id ?>Carousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#<?php echo $gallery_id ?>Carousel" role="button" data-slide="next">
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


            <?php } ?>
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

                <?php foreach ($guidelines_dir as $k => $v) {  ?>
                  <div class="col-sm-6 col-md-4">
                  <div class="thumbnail">
                    <img src="<?php echo base_url().'public/home/resources/guidelines/'.$v ?>" alt="">
                    <div class="caption">
                      <h5><?php echo $v ?></h5>
                      <p></p>
                      <p><a href="<?php echo base_url().'public/home/resources/guidelines/'.$v ?>">Download <i class="fa fa-download" aria-hidden="true"></i></a></p>
                    </div>
                  </div>
                  </div>
                <?php }?>

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
              <?php if(!empty($publications_dir)){foreach ($publications_dir as $k => $v) { ?>
                <div class="thumbnail">
                  <img src="<?php echo base_url().'public/home/resources/publications/'.$v ?>" alt="">
                  <div class="caption">
                    <h5><?php echo $v ?></h5>
                    <p></p>
                    <p><a href="<?php echo base_url().'public/home/resources/publications/'.$v ?>">Download <i class="fa fa-download" aria-hidden="true"></i></a></p>
                  </div>
                </div>
            <?php } }?>
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
                    <p><a href="<?php echo base_url().'public/home/resources/faqs/Prep_Booklet_2018_v2_-_English.pdf'; ?>">Download <i class="fa fa-download" aria-hidden="true"></i></a></p>
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


    <script>

    $('#status_tabs a[href="#summary"]').tab('show')

    $('#status_tabs a').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show')
    })

    </script>

</body>
</html>
