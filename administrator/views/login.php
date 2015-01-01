<?php
$userObj->userAuthentication();
if($_POST['submit']=="Login")
{
     $logincheck=$userObj->checkAdmin();
}
?>
<!-- container_login -->
<div class="box" style="width: 400px; min-height: 300px; margin-top: 40px; margin-left: auto; margin-right: auto;">
    <div class="heading">
      <h1><img src="allfiles/lock.png" alt=""> Please enter your login details.</h1>
    </div>
    <div class="content" style="min-height: 150px; overflow: hidden;">
         <form action="index.php?option=com_login" method="post" id="frmLoginAdmin" class="middle_form">
        <table style="width: 100%;">
          <tbody><tr>
            <td style="text-align: center;" rowspan="4"><img src="allfiles/login.png" alt="Please enter your login details."></td>
          </tr>
          <tr>
            <td>Username:<br>
			<input type="text" name="chrUserName" id="chrUserName" value="" class="text_large" />
              <br>
              <br>
              Password:<br>
              <input type="password" name="chrPassword" id="chrPassword" value="" class="text_large" />
              <br>
              <!--<a href="http://localhost/opencart/upload/admin/index.php?route=common/forgotten">Forgotten Password</a>--></td>
          </tr>
          <tr>
            <td height="5"></td>
          </tr>
          <tr>
            <td ><input type="hidden" name="submit" value="Login"  /><input value="" type="submit" class="button button_login"></td>
          </tr>
        </tbody></table>
        </form>
    </div>
  </div>
	<!-- container_login -->