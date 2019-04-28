
      <div class="am-pagebody">
        <?php
            if($isAdded == FALSE){
        ?>  
        <div class="card pd-20 pd-sm-40 mg-t-50">
          <div class="alert alert-warning pd-y-20" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="d-sm-flex align-items-center justify-content-start">
              <i class="icon ion-alert-circled alert-icon tx-52 tx-warning mg-r-20"></i>
              <div class="mg-t-20 mg-sm-t-0">
                <h5 class="mg-b-2 tx-warning">Warning! You haven't set up the additional tables.</h5>
                <p class="mg-b-0 tx-gray">Please fill and submit the form, to set up the additional tables.</p>
              </div>
            </div><!-- d-flex -->
          </div><!-- alert -->
          
          <h6 class="card-body-title">Post Payment Parameter</h6>
          <p class="mg-b-20 mg-sm-b-30">Base salary and salary per post must not leave empty.</p>

          <form action="<?=  site_url('wizard/CreateAdditionalTable');?>" method="post" data-parsley-validate>
            <div class="wd-300">
              <div class="d-md-flex mg-b-30">
                <div class="form-group mg-b-0">
                  <label>Base Salary: <span class="tx-danger">*</span></label>
                  <input type="number" name="base-salary" class="form-control wd-200 wd-sm-250" placeholder="Enter base salary" required>
                </div><!-- form-group -->
                <div class="form-group mg-b-0 mg-md-l-20 mg-t-20 mg-md-t-0">
                  <label>Salary per Post: <span class="tx-danger">*</span></label>
                  <input type="number" name="salary-per-post" class="form-control wd-200 wd-sm-250" placeholder="Enter salary per post" required>
                </div><!-- form-group -->
              </div><!-- d-flex -->
              <button type="submit" class="btn btn-info">Submit</button>
            </div>
          </form>
          
        </div><!-- card -->
        <?php
            }else{
        ?>
        <div class="card pd-20 pd-sm-40 mg-t-50">
          <div class="alert alert-success pd-y-20" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="d-sm-flex align-items-center justify-content-start">
              <i class="icon ion-ios-checkmark alert-icon tx-52 mg-r-20 tx-success"></i>
              <div class="mg-t-20 mg-sm-t-0">
                <h5 class="mg-b-2 tx-success">Well done!</h5>
                <p class="mg-b-0 tx-gray">You've successfully set up the additional table.</p>
              </div>
            </div><!-- d-flex -->
          </div><!-- alert -->
        </div><!-- card -->
        <?php
            }
        ?>

      </div><!-- am-pagebody -->
    

