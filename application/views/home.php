
      <div class="am-pagebody">
        
          <div class="card pd-10 pd-sm-10 mg-b-20 bg-info">
            <div class="row">
              <div class="col-lg-3 mg-t-20 mg-lg-t-0"></div>  
              <div class="col-lg-4 mg-t-20 mg-lg-t-0">
                <select id="authors" class="form-control select2-show-search" data-placeholder="Choose Author">
                  <option label="Choose one"></option>
                  <?php
                  foreach ($authors as $key => $value) {
                  ?>
                  <option value="<?=$key;?>"><?=$value;?></option>
                  <?php
                  }
                  ?>
                </select>
              </div><!-- col-4 -->
              <div class="col-lg-2 mg-t-20 mg-lg-t-0">
                <select id="year" class="form-control select2-show-search" data-placeholder="Choose Years">
                  <option label="Choose one"></option>
                  <?php
                  foreach ($list_year as $year) {
                    $selected = "";
                    if($year->years == date("Y")){
                        $selected = "selected";
                    }
                  ?>
                  <option value="<?=$year->years;?>" <?=$selected;?>><?=$year->years;?></option>
                  <?php
                  }
                  ?>
                </select>
              </div><!-- col-4 -->
              <div class="col-lg-3 mg-t-20 mg-lg-t-0"></div>
            </div><!-- row -->
          </div><!-- card -->
          
        <div class="row row-sm mg-t-15 mg-sm-t-20">
          <div class="col-md-6">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title"><?=  date("Y");?> Author's Monthly Total Posts</h6>
              <p class="mg-b-20 mg-sm-b-30">This is a chart that shows author's monthly total posts in <?=  date("Y");?>.</p>
              <div id="f2" class="ht-200 ht-sm-300"></div>
            </div><!-- card -->
          </div><!-- col-6 -->
          <div class="col-md-6 mg-t-15 mg-sm-t-20 mg-md-t-0">
            <div class="card pd-20 pd-sm-40">
              <h6 class="card-body-title">2017 Author's Daily Total Posts</h6>
              <p class="mg-b-20 mg-sm-b-30">This is a chart that shows author's daily total posts in <?=  date("Y");?>.</p>
              <div id="morrisLine1" class="ht-200 ht-sm-300"></div>
            </div><!-- card -->
          </div><!-- col-6 -->
        </div><!-- row -->

        <div class="row row-sm mg-t-15 mg-sm-t-20">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header bg-transparent pd-20">
                <h6 class="card-title tx-uppercase tx-12 mg-b-0">Authors's Latest Post</h6>
              </div><!-- card-header -->
              <div class="table-responsive">
                <table class="table table-white mg-b-0 tx-12">
                  <tbody>
                    <?php
                    foreach ($latest_post as $row) {
                    ?>  
                    <tr>
                      <td class="pd-l-20 tx-center">
                      <img src="<?=$row['photourl'];?>" class="wd-36 rounded-circle" alt="Image">
                      </td>
                      <td>
                        <a href="" class="tx-inverse tx-14 tx-medium d-block"><?=$row['display_name'];?></a>
                        <span class="tx-11 d-block">E-mail: <?=$row['user_email'];?></span>
                      </td>
                      <td><a href="javascript:void(0);" onclick="GoToPage(<?="'".$row['post_name']."'";?>)"><?=$row['post_title'];?></a></td>
                      <td class="tx-12">
                        <span class="square-8 bg-success mg-r-5 rounded-circle"></span> <?=$row['meta_value'];?>
                      </td>
                      <td><?=$row['post_date'];?></td>
                    </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div><!-- table-responsive -->
              <div class="card-footer tx-12 pd-y-15 bg-transparent bd-t bd-gray-200">
              </div><!-- card-footer -->
            </div><!-- card -->
          </div><!-- col-8 -->
          
        </div><!-- row -->

      </div><!-- am-pagebody -->
    

