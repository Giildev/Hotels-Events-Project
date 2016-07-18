<div class="modal fade in" id="modaledit-profile" tabindex="-1" role="dialog" style="display: none; padding-left: 0px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <!--<h4 class="modal-title">Modal title</h4>-->
            </div>
            <div class="modal-body">
                <div class="auth-screen public-reg clearfix">
                    <h1 class="tenor form-header text-center" style="margin-bottom: 20px;margin-top:20px;">Edit Account</h1>
                    <div class="row">
                      <form class="" action="#" method="post" enctype="multipart/form-data">
                        <div class="col-md-6 col-md-offset-3" style="/* border-right: 1px solid #d1d1d1; */">
                            <div class="email-reg">
                              <input type="hidden" id="id" class="form" name="id" value="<?php echo $_SESSION['user']['id']; ?>">
                              <div class="col-md-12 text-center">
                                  <input type="text" id="email" class="form" name="email" placeholder="Email Address" style="width: 80%;height: 42px;padding: 20px;font-size: 18px;font-family: 'Oswald';">
                              </div>
                              <div class="col-md-12 text-center">
                                  <input type="date" id="birthday" class="form" name="birthday" min="1900-01-01" max="2016-01-01" style="width: 80%;height: 42px;padding: 20px;font-size: 18px;font-family: 'Oswald';">
                              </div>
                              <div class="col-md-12 text-center">
                                <input type="radio" name="gender" value="0" checked> Male<br>
                                <input type="radio" name="gender" value="1"> Female<br>
                              </div>
                              <div class="col-md-12 text-center">
                                <input type="file" name="photo" id="photo">
                              </div>
                              <div class="row" style="">
                                  <div class="col-md-12 text-center">
                                      <input id="edit-continue" type="submit" class="btn btn-primary" data-dismiss="modal" value="Edit" style="width: 80%;height: 40px;font-size: 20px;background-color: #ffbf3b;border: 0;">
                                  </div>
                              </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
