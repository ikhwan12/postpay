$(function (){
    var link = window.location.href.split('/');
    var size = link.length;
    var detailTable = $('#datatable1').DataTable({
        responsive: true,
        processing: true,
        ajax: {
              url: siteurl+'post/PostDetail/'+link[size-3]+"/"+link[size-2]+"/"+link[size-1],
              dataSrc: ''
        },
        language: {
          searchPlaceholder: 'Search...',
          sSearch: '',
          bProcessing: "<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span>",
          lengthMenu: '_MENU_ items/page'
        }
    });

});

function GoToPost(link){
    window.open(link);
}