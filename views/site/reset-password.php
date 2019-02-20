<?php $this->title = "lanoyo.com"?>
<div id="wrapper" style="background: #fff;padding: 70px">
    <div class="container" style="width: 30%">
        <h2 class="negative-margin forgot-info">Reset your password</h2>
        <form name="frmChange" method="post" action="javascript:void(0);" id="change-password-form" onSubmit="return validatePassword()">
            <input type="hidden" name="token" id="token" value="<?=$token?>">
            <input name="new_password" id="new_password" type="password" class="input-full main-input" placeholder="New password" />
            <input name="confirm_password" id="confirm_password" type="password" class="input-full main-input" placeholder="Confirm password" />
            <div align="left" id="change_password_status"></div>
            <button href="my-profile.html" class="button-primary button-shadow button-full">
                <span>Reset password</span>
                <div class="button-triangle"></div>
                <div class="button-triangle2"></div>
                <div class="button-icon"><i class="fa fa-user"></i></div>
            </button>
        </form>
    </div>
</div>