<div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <img src="<?php echo Yii::app()->baseUrl?>/assets/images/KTLogo.png" width="100px">
            <form id="loginForm">
              <h1>Welcome To Khushaal Thar</h1>
              <div>
                <input type="text" name="email" id="email" class="form-control" placeholder="Email Address" required="" />
              </div>
              <div>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default" href="#" id="loginBtn">Log in</a>
                <a class="reset_pass to_register" href="#signup">Lost your password?</a>
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

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <img src="<?php echo Yii::app()->baseUrl?>/assets/images/KTLogo.png" width="100px">
            <form id="forgotForm" >
              <h1>Forgot Password</h1>
              <div>
                <input type="text" class="form-control" placeholder="Email Address" name="email" id="email_reset" required="" />
              </div>
              <!-- <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div> -->
              <div>
                <a class="btn btn-default"  href="javascript:void(0)" id="forgotBtn">Forgot password</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <p>©<?php echo date('Y')?> All Rights Reserved. <br/>KHUSHAAL THAR. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>