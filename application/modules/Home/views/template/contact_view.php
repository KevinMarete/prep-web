<section id="contact" class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="ser-title">Contact us</h2>
                <hr class="botm-line">
            </div>
            <div class="col-md-4 col-sm-4">
                <h3>Contact Info</h3>
                <div class="space"></div>
                <p><i class="fa fa-home fa-fw pull-left fa-2x"></i>National AIDs &amp; STI Control Programme<br>  Afya Annex, Kenyatta National Hospital</p>
                <div class="space"></div>
                <p><i class="fa fa-map-marker fa-fw pull-left fa-2x"></i>P.O. Box 19361-00202 Nairobi, Kenya</p>
                <div class="space"></div>
                <p><i class="fa fa-envelope-o fa-fw pull-left fa-2x"></i>ulizanascop@gmail.com</p>
                <div class="space"></div>
                <p><i class="fa fa-phone fa-fw pull-left fa-2x"></i>(+254)726460000</p>
            </div>
            <div class="col-md-8 col-sm-8 marb20">
                <div class="contact-info">
                    <h3 class="cnt-ttl">Having Any Query!</h3>
                    <div class="space"></div>
                    <div>
                      <?php echo $this->session->flashdata('mail_sent'); ?>
                    </div>

                    <!-- Pop up Modal on Email Send -->
                    <div id="emailModal" class="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div id="emailReturnMessage" class="modal-body">

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>

                    <form id="email" action="<?php echo site_url().'home/sendEmailFromHome'; ?>" method="post" role="form" class="contactForm">
                        <div class="form-group">
                            <input type="email" class="form-control br-radius-zero" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                            <div class="validation"></div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control br-radius-zero" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                            <div class="validation"></div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control br-radius-zero" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                            <div class="validation"></div>
                        </div>

                        <div class="form-action">
                            <button type="submit" class="btn btn-form">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
$('#email').submit(function(e){
  e.preventDefault();
  axios({
     method:'post',
     url: '<?php echo site_url().'home/sendEmailFromHome'; ?>',
     data: $('#email').serialize()
  }).then(function(response){
    $('#emailReturnMessage').html('<p>'+response.data.message+'</p>');
    $('#emailModal').modal();
    $('#email').reset();
  })
})
</script>
