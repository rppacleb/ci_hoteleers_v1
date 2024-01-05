<!-- Scroll to Top Button-->
<div class="modal fade" id="preference_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="preference_modal_title"></h5>
          
        </div>
        <div class="modal-body" id="preference_modal_body">
          
        
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="password_change_modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="password_change_modal_title"></h5>
          
        </div>
        <div class="modal-body" id="password_change_modal_body">
          
        
        </div>
    </div>
  </div>
</div>


<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="edit_modal_title"></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="edit_modal_body">
          
        
        </div>
       

    </div>
  </div>
</div>






<div class="modal fade" id="LookupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="LookupModalTitle"></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body" id="LookupModalBody">
          
        
        </div>
        <div class="modal-footer" id="LookupModalFooter">
          <button id="btnOk" class="btn btn-outline-info btn-sm" type="button">Ok
          </button>
        </div>

    </div>
  </div>
</div>

<div class="modal fade" id="add_new_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="add_new_modal_title"></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body px-5" id="add_new_modal_body">
          
        
        </div>
        <div class="modal-footer" id="add_new_modal_footer">
          <button id="btn_modal_submit" class="btn btn-sm btn-pill-sm-no-brdr btn-primary" type="button">Save
          </button>

            
        </div>

    </div>
  </div>
</div>

<div class="modal fade" id="registration_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Register</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="reg_form">
            <div class="row">
              <div class="col">
                  <div class="form-group">
                      <label class="col-form-label col-form-label-sm">NAME <b class="text-danger">*</b></label>
                      <input name="name" type="text" class="form-control form-control-sm" maxlength="50">
                  </div><!--./form-group-->
              </div><!--./col-->

              <div class="col">
                  <div class="form-group">
                      <label class="col-form-label col-form-label-sm">USERNAME <b class="text-danger">*</b></label>
                      <input name="username" type="text" class="form-control form-control-sm" maxlength="50">
                  </div><!--./form-group-->
              </div><!--./col-->
            </div><!--./row-->

            <div class="row">
              <div class="col">
                  <div class="form-group">
                      <label class="col-form-label col-form-label-sm">EMAIL ADDRESS <b class="text-danger">*</b></label>
                      <input name="email_add" type="text" class="form-control form-control-sm" maxlength="100">
                  </div><!--./form-group-->
              </div><!--./col-->
            </div><!--./row-->

            <div class="row">
              <div class="col">
                  <div class="form-group">
                      <label class="col-form-label col-form-label-sm">ADDRESS <b class="text-danger">*</b></label>
                      <textarea name="address" class="form-control form-control-sm" maxlength="500"></textarea>
                  </div><!--./form-group-->
              </div><!--./col-->
            </div><!--./row-->

            <div class="row">
              <div class="col">
                  <div class="form-group">
                      <label class="col-form-label col-form-label-sm">PASSWORD <b class="text-danger">*</b></label>
                      <input name="password" type="password" class="form-control form-control-sm" maxlength="50">
                  </div><!--./form-group-->
              </div><!--./col-->
              <div class="col">
                <div class="form-group">
                    <label class="col-form-label col-form-label-sm">CONFIRM PASSWORD <b class="text-danger">*</b></label>
                    <input name="confirm_password" type="password" class="form-control form-control-sm" maxlength="50">
                </div><!--./form-group-->
              </div><!--./col-->
            </div><!--./row-->

          </form><!--./form-->
        </div>
        <div class="modal-footer">
          <button name="btn_register" class="btn btn-outline-info btn-sm" type="button">Register</button>
        </div>

    </div>
  </div>
</div>


<div class="modal fade" id="notification_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            
        </div>

        <div class="modal-footer">
          <div class="row align-items-center justify-content-start">
            <div class="col-auto">
              <small class="footer-title"></small>
            </div>
            <div class="col-auto">
              <button class="d-none btn btn-success btn_accept_dec" aria-status="accept">Accept</button>
              <button class="d-none btn btn-danger btn_accept_dec" aria-status="decline">Decline</button>
              <button class="d-none btn btn-secondary btn_decide" data-dismiss="modal">Decide Later</button>
            </div>
          </div>
          
        </div>

    </div>
  </div>
</div>


<!--CART-->
<div class="modal fade" id="cart_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">CART</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="cart_form">
           

          </form><!--./form-->
        </div>
        <div class="modal-footer">
          <button name="btn_reserve" class="btn btn-outline-info btn-sm" type="button">Reserve</button>
        </div>

    </div>
  </div>
</div>



