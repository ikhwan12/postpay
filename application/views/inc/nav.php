
    <div class="am-sideleft">
      <ul class="nav am-sideleft-tab">
        <li class="nav-item">
          <a href="#mainMenu" class="nav-link active"><i class="icon ion-ios-home-outline tx-24"></i></a>
        </li>
        <li class="nav-item">
          <a href="#mainMenu" class="nav-link"></a>
        </li>
        <li class="nav-item">
          <a href="#mainMenu" class="nav-link"></a>
        </li>
        <li class="nav-item">
          <a href="#mainMenu" class="nav-link"></a>
        </li>
      </ul>

      <div class="tab-content">
        <div id="mainMenu" class="tab-pane active">
          <ul class="nav am-sideleft-menu">
            <li class="nav-item">
                <a href="<?=  site_url('home');?>" class="nav-link">
                <i class="icon ion-ios-home-outline"></i>
                <span>Dashboard</span>
              </a>
            </li><!-- nav-item -->
            <li class="nav-item">
              <a href="" class="nav-link with-sub">
                <i class="icon ion-ios-list-outline"></i>
                <span>Report</span>
              </a>
              <ul class="nav-sub">
                <li class="nav-item"><a href="<?=  site_url('payment');?>" class="nav-link">Post Payment</a></li>
              </ul>
            </li><!-- nav-item -->
            <li class="nav-item">
              <a href="<?=  site_url('settings');?>" class="nav-link">
                <i class="icon ion-ios-gear-outline"></i>
                <span>Settings</span>
              </a>
            </li><!-- nav-item -->
          </ul>
        </div><!-- #mainMenu -->
      </div><!-- tab-content -->
    </div><!-- am-sideleft -->
    
     <div class="am-mainpanel">
      <div class="am-pagetitle">
        <h5 class="am-title"><?=$page_title;?></h5>
        
      </div><!-- am-pagetitle -->
