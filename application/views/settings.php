
      <div class="am-pagebody">
        <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Salary Value</h6>
          <p class="mg-b-20 mg-sm-b-30">Set the base salary and salary per post.</p>
          <form action="<?=  site_url('settings/SetSalary');?>" method="post">
          <div class="form-layout">
            <div class="row mg-b-25">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Base Salary: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="number" name="base_salary" value="<?=$base_salary;?>" placeholder="Enter firstname">
                </div>
              </div><!-- col-4 -->
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Salary per Post: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="number" name="salary_per_post" value="<?=$salary_per_post;?>" placeholder="Enter lastname">
                </div>
              </div><!-- col-4 -->
            </div><!-- row -->
            <div class="form-layout-footer">
                <button type="submit" class="btn btn-info mg-r-5">Save</button>
            </div><!-- form-layout-footer -->
          </div><!-- form-layout -->
          </form>
        </div><!-- card -->
          
        <div class="row row-sm mg-t-20">
           <div class="col-xl-6 mg-t-25 mg-xl-t-0">
            <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
             <h6 class="card-body-title">Allowed post type <span class="tx-danger">*</span></h6>
            <p class="mg-b-20 mg-sm-b-30">Choose the post types you would like to be included in counting.</p>
            
            <form action="<?=  site_url('settings/SetAllowedPostType');?>" method="post" data-parsley-validate>
              <div id="cbWrapper1" class="parsley-checkbox">
                 <?php
                  $parsCheck = FALSE;   
                  foreach($allowed_types as $key => $value) {
                      if($parsCheck == FALSE){
                          $parsCheck = TRUE;
                          $prop = 'data-parsley-mincheck="1" data-parsley-class-handler="#cbWrapper1" data-parsley-errors-container="#cbErrorContainer1" required';
                      }else{
                          $prop = '';
                      }
                      if($value){
                  ?>
                  <label class="ckbox">
                      <input type="checkbox" name="allowed_types[]" value="<?=$key;?>" checked="" <?=$prop;?>><span><?= ucwords($key);?></span>
                  </label>
                  <?php
                      }else{
                  ?>
                  <label class="ckbox">
                      <input type="checkbox" name="allowed_types[]" value="<?=$key;?>" <?=$prop;?>><span><?= ucwords($key);?></span>
                  </label>
                  <?php
                      }
                  }
                  ?>  
              </div><!-- form-group -->
              <div id="cbErrorContainer1"></div>
              <div class="mg-t-20">
                <button type="submit" class="btn btn-info pd-x-15">Save</button>
              </div>
            </form>
            </div><!-- card -->
          </div><!-- col-6 --> 
          <div class="col-xl-6 mg-t-25 mg-xl-t-0">
            <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
             <h6 class="card-body-title">Allowed user roles <span class="tx-danger">*</span></h6>
            <p class="mg-b-20 mg-sm-b-30">Choose the user roles whose posts you would like to be included in counting.</p>

            <form action="<?=  site_url('settings/SetAllowedRoles');?>" method="post" data-parsley-validate>
              <div id="cbWrapper2" class="parsley-checkbox">
                 <?php
                  $parsCheck = FALSE;   
                  foreach($allowed_roles as $key => $value) {
                      $label = str_replace('_', ' ', str_replace('wp', '', $key));
                      if($parsCheck == FALSE){
                          $parsCheck = TRUE;
                          $prop = 'data-parsley-mincheck="1" data-parsley-class-handler="#cbWrapper2" data-parsley-errors-container="#cbErrorContainer2" required';
                      }else{
                          $prop = '';
                      }
                      if($value){
                  ?>
                  <label class="ckbox">
                      <input type="checkbox" name="allowed_roles[]" value="<?=$key;?>" checked="" <?=$prop;?>><span><?=  ucwords($label);?></span>
                  </label>
                  <?php
                      }else{
                  ?>
                  <label class="ckbox">
                      <input type="checkbox" name="allowed_roles[]" value="<?=$key;?>" <?=$prop;?>><span><?=  ucwords($label);?></span>
                  </label>
                  <?php
                      }
                  }
                  ?>  
              </div><!-- form-group -->
              <div id="cbErrorContainer2"></div>
              <div class="mg-t-20">
                <button type="submit" class="btn btn-info pd-x-15">Save</button>
              </div>
            </form>
            </div><!-- card -->
          </div><!-- col-6 -->
        </div><!-- row -->

        <div class="row row-sm mg-t-20">
           <div class="col-xl-6 mg-t-25 mg-xl-t-0">
            <div class="card pd-20 pd-sm-40 form-layout form-layout-5">
            <h6 class="card-body-title">Allowed post status <span class="tx-danger">*</span></h6>
            <p class="mg-b-20 mg-sm-b-30">Choose the post status you would like to be included in counting.</p>
            
            <form action="<?=  site_url('settings/SetAllowedPostStatus');?>" data-parsley-validate method="post">
              <div id="cbWrapper3" class="parsley-checkbox">
                <?php
                  $parsCheck = FALSE;   
                  foreach($allowed_post_status as $key => $value) {
                      if($parsCheck == FALSE){
                          $parsCheck = TRUE;
                          $prop = 'data-parsley-mincheck="1" data-parsley-class-handler="#cbWrapper3" data-parsley-errors-container="#cbErrorContainer3" required';
                      }else{
                          $prop = '';
                      }
                      if($value){
                  ?>
                  <label class="ckbox">
                      <input type="checkbox" name="allowed_post_status[]" value="<?=$key;?>" checked="" <?=$prop;?>><span><?=  ucfirst($key);?></span>
                  </label>
                  <?php
                      }else{
                  ?>
                  <label class="ckbox">
                      <input type="checkbox" name="allowed_post_status[]" value="<?=$key;?>" <?=$prop;?>><span><?=  ucfirst($key);?></span>
                  </label>
                  <?php
                      }
                  }
                  ?>  
              </div><!-- form-group -->
              <div id="cbErrorContainer3"></div>
              <div class="mg-t-20">
                <button type="submit" class="btn btn-info pd-x-15">Save</button>
              </div>
            </form>
            </div><!-- card -->
          </div><!-- col-6 --> 
        </div><!-- row -->

      </div><!-- am-pagebody -->
    

