<div class="modal fade in" id="modalLogin" tabindex="-1" role="dialog" style="display: none; padding-left: 0px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <!--<h4 class="modal-title">Modal title</h4>-->
            </div>
            <div class="modal-body">
                <div class="auth-screen public-reg clearfix">
                    <h1 class="tenor form-header text-center" style="margin-bottom: 20px;margin-top:20px;">Sign in to your membership account</h1>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3" style="/* border-right: 1px solid #d1d1d1; */">
                            <div class="email-reg">
                                <form id="login-form" style="margin-bottom: 12px;">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="text" id="login-email" class="form" name="login-email" placeholder="Email Address" style="width: 80%;height: 42px;padding: 20px;font-size: 18px;font-family: 'Oswald';">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <input type="password" id="login-password" class="form" name="login-password" placeholder="Password" style="width: 80%;height: 42px;padding: 20px;font-size: 18px;font-family: 'Oswald';">
                                        </div>
                                    </div>
                                    <div class="row" style="">
                                        <div class="col-md-12 text-center">
                                            <input id="login-continue" type="submit" data-dismiss="modal" class="btn btn-primary" value="Sign In" style="width: 80%;height: 40px;font-size: 20px;background-color: #ffbf3b;border: 0;">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 text-center" style="">
                            <div class="hr-line">
                                <div class="hr" style="display: inline-block;vertical-align: middle;width: 30%;border-bottom: solid 1px #ccc;"></div>
                                <div style="display: inline-block;vertical-align: middle; width: 50px;color: #999;font-size: 16px;text-align: center">or</div>
                                <div class="hr" style="display: inline-block;vertical-align: middle;width: 30%;border-bottom: solid 1px #ccc;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 text-center" style="">
                            <div class="fb-reg" style="margin-top: 15px;">
                                <p class="" style="font-size: 18px;font-family: 'Oswald';color: #333;margin-bottom: 27px;">Did you signed up using facebook?<br> Login again!</p>
                                <img src="http://i.stack.imgur.com/Vk9SO.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <p class="" style="text-align: left;margin-left: 20px;font-size: 16px;">
                    You have not signed up yet?
                    <a href="#" data-screen-id="login-secureLogin" id="login-secureLogin" data-dismiss="modal" data-toggle="modal" data-target="#modalRegister"> Become a member</a>
                </p>
                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
