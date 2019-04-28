$(function (){
   // Select2 by showing the search
    $('.select2-show-search').select2({
      minimumResultsForSearch: ''
    }); 
    
    var chartData = [];
    for(var i=1;i<13;i++){
        var data = {
            y: moment(i, "M").format("MMMM"),
            a: 0,
        };
        chartData[i-1] = data;
    }
    
    var morrisChrt = new Morris.Bar({
        element: 'f2',
        data: chartData,
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Total Post'],
        barColors: ['#5058AB'],
        gridTextSize: 11,
        hideHover: 'auto',
        resize: true
    });
    
    function ClickEvent(){
        $("#f2 svg rect").click(function (){
            thisDate = $(".morris-hover-row-label").html();
            CreateDailyChart(thisDate);
        });
    }
    
    var authorIDs = [];
    $("#authors").find('option').each(function (){
        if($(this).attr('value') !== 'undefined'){
            authorIDs.push($(this).attr('value'));
        }
    });
    
    $.ajax({
        url: siteurl+'home/GetMonthlyTotalPost',
        data: {ids: authorIDs, year:$("#year").val()},
        type: 'POST',
        dataType: 'JSON',
        success: function (data, textStatus, jqXHR) {
            morrisChrt.setData(data);
            ClickEvent();
            CreateDailyChart(moment().format("MMMM"));
        }
     });
     
     function CreateDailyChart(month){
        var id = $("#authors").val();
        var url = siteurl+'home/GetDailyTotalPostByID';
        if(id == ""){
            id = authorIDs;
            url = siteurl+'home/GetDailyTotalPost';
        }
        $.ajax({
            url: url,
            data: {
                ids: id, 
                month:moment().month(month).format("M"),
                year:$("#year").val()},
            type: 'POST',
            dataType: 'JSON',
            success: function (data, textStatus, jqXHR) {
                $('#morrisLine1').empty();
                new Morris.Line({
                    element: 'morrisLine1',
                    data: data,
                    xkey: 'y',
                    ykeys: ['a'],
                    labels: ['Series A'],
                    lineColors: ['#2D3A50'],
                    lineWidth: 1,
                    parseTime:false,
                    ymax: 'auto',
                    gridTextSize: 11,
                    hideHover: 'auto',
                    smooth: false,
                    resize: true
                });
            }
        });
     }
     
     $('#authors, #year').change(function (){
        $.ajax({
            url: siteurl+'home/GetMonthlyTotalPostByID',
            data: {id: $("#authors").val(), year:$("#year").val()},
            type: 'POST',
            dataType: 'JSON',
            success: function (data, textStatus, jqXHR) {
                morrisChrt.setData(data);
                ClickEvent();
                CreateDailyChart(moment().format("MMMM"));
            }
         });
    });
    
});

function GoToPage(url){
    var webpage = "http://nihaoindo.com/";
    window.open(webpage+url);
}