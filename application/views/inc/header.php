
    <div class="am-header">
      <div class="am-header-left">
        <a id="naviconLeft" href="" class="am-navicon d-none d-lg-flex"><i class="icon ion-navicon-round"></i></a>
        <a id="naviconLeftMobile" href="" class="am-navicon d-lg-none"><i class="icon ion-navicon-round"></i></a>
        <a href="<?=  site_url('home');?>" class="am-logo">Post Payment</a>
      </div><!-- am-header-left -->

      <div class="am-header-right">
        <div class="dropdown dropdown-profile">
          <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
            <img src="<?=$this->session->userdata('pict');?>" class="wd-32 rounded-circle" alt="">
            <span class="logged-name"><span class="hidden-xs-down"><?=$this->session->userdata('name');?></span> <i class="fa fa-angle-down mg-l-3"></i></span>
          </a>
          <div class="dropdown-menu wd-200">
            <ul class="list-unstyled user-profile-nav">
              <li><a href="<?=  site_url('login/Logout');?>"><i class="icon ion-power"></i> Sign Out</a></li>
            </ul>
          </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
      </div><!-- am-header-right -->
    </div><!-- am-header -->
