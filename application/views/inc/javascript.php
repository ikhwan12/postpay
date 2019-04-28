
    
    <script src="<?=  base_url('assets/lib/jquery/jquery.js');?>"></script>
    <script src="<?=  base_url('assets/lib/popper.js/popper.js');?>"></script>
    <script src="<?=  base_url('assets/lib/bootstrap/bootstrap.js');?>"></script>
    <script src="<?=  base_url('assets/lib/daterangepicker/moment.min.js');?>"></script>
    <script src="<?=  base_url('assets/lib/daterangepicker/daterangepicker.js');?>"></script>
    <script src="<?=  base_url('assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js');?>"></script>
    <script src="<?=  base_url('assets/lib/jquery-toggles/toggles.min.js');?>"></script>
    <script src="<?=  base_url('assets/lib/d3/d3.js');?>"></script>
    
    <script src="<?=  base_url('assets/lib/raphael/raphael.min.js');?>"></script>
    <script src="<?=  base_url('assets/lib/morris.js/morris.js');?>"></script>
    
    <script src="<?=  base_url('assets/js/ResizeSensor.js');?>"></script>
    
    <script src="<?=  base_url('assets/lib/select2/js/select2.min.js');?>"></script>
    <script src="<?=  base_url('assets/lib/accounting/accounting.min.js');?>"></script>
     <!--wizard.php js-->
    <script src="<?=  base_url('assets/lib/highlightjs/highlight.pack.js');?>"></script>
    <script src="<?=  base_url('assets/lib/parsleyjs/parsley.js');?>"></script>
    <script src="<?=  base_url('assets/lib/datatables/jquery.dataTables.js');?>"></script>
    <script src="<?=  base_url('assets/lib/datatables/dataTables.buttons.min.js');?>"></script>
    <script src="<?=  base_url('assets/lib/datatables/buttons.print.min.js');?>"></script>
    <script src="<?=  base_url('assets/lib/datatables/jszip.min.js');?>"></script>
    <script src="<?=  base_url('assets/lib/datatables/pdfmake.min.js');?>"></script>
    <script src="<?=  base_url('assets/lib/datatables/vfs_fonts.js');?>"></script>
    <script src="<?=  base_url('assets/lib/datatables/buttons.html5.min.js');?>"></script>
    <script src="<?=  base_url('assets/lib/datatables-responsive/dataTables.responsive.js');?>"></script>
    <script type="text/javascript">
         var siteurl = "<?=  site_url();?>"+"/";     
         var baseurl = "<?= base_url();?>";     
    </script>
    <?php
        $jsfile = './assets/js/apps/'.$this->uri->segment(1).'.js';
        if(file_exists($jsfile) == TRUE){
    ?>
        <script src="<?=  base_url('assets/js/apps/'.$this->uri->segment(1).'.js');?>"></script>
    <?php
        }
    ?>
    <script src="<?=  base_url('assets/js/amanda.js');?>"></script>
    <script type="text/javascript">
      var url = window.location.href;    
        $('#mainMenu').find('a').each(function (e){
            if($(this).attr('href') == url ){ 
                $(this).addClass('active');
                $(this).parents('li').find('a').each(function (e){
                   if($(this).attr('class') == 'nav-link with-sub'){
                       $(this).addClass('show-sub');
                   } 
                });
            }   
        });
    </script>
  </body>
</html>