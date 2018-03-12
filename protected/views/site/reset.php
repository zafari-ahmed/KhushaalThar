<div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <img src="<?php echo Yii::app()->baseUrl?>/assets/images/KTLogo.png" width="100px">
            <form id="resetForm">
              <h1>Reset Password</h1>
              <div>
                <input type="text" name="email_address" id="email" class="form-control" placeholder="Email Address" required="" />
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="" />
                <input type="hidden" name="id" value="<?php echo @$model->id?>"/>
                <input type="hidden" name="type" value="<?php echo @$type?>"/>
              </div>
              <div>
                <input type="password" id="conf_password" name="conf_password" class="form-control" placeholder="Confirm Password" required="" />
              </div>
              <div>
                <a class="btn btn-default" href="#" id="resetBtn">Change Password</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <!-- <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p> -->

                <div class="clearfix"></div>
                <br />

                <div>
                  <!-- <h1>KHUSHAAL THAR</h1> -->
                  <p>©<?php echo date('Y')?> All Rights Reserved. <br/>KHUSHAAL THAR. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

      </div>
    </div>