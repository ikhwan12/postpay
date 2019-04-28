$(function (){
    var link = window.location.href.split('/');
    var size = link.length;
    var detailTable = $('#datatable1').DataTable({
        responsive: false,
        processing: true,
        ajax: {
              url: siteurl+'postviewsdetail/GetPostViewsData/'+link[size-3]+"/"+link[size-2]+"/"+link[size-1],
              dataSrc: ''
        },
        language: {
          searchPlaceholder: 'Search...',
          sSearch: '',
          bProcessing: "<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span>",
          lengthMenu: '_MENU_ items/page'
		},
		"columnDefs": [
            { 
                "className": "dt-body-right", "targets": [1] 
            }
		],
		"footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
           
            for(var i=1;i<=1;i++){
                // Total over all pages
                var prec = 0;
                total = api.column( i ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                // Total over this page
                pageTotal = api.column( i, { page: 'current'} ).data().reduce( function (a, b){return intVal(a) + intVal(b);}, 0 );
                 // Update footer
                if(i==4){prec = 0;} 
                $( api.column( i ).footer() ).html( accounting.formatMoney(total, "", prec, ",", ".") );
            }
        }
	});
	
	//CHART
	var chartData = [];
    for(var i=1;i<13;i++){
        var data = {
            y: moment(i, "M").format("MMMM"),
            a: 0,
        };
        chartData[i-1] = data;
    }
    
    var morrisChrt = new Morris.Line({
        element: 'f2',
        data: chartData,
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Views'],
		lineColors: ['#2D3A50'],
		lineWidth: 1,
		parseTime:false,
		ymax: 'auto',
		gridTextSize: 11,
		hideHover: 'auto',
		smooth: false,
		resize: true
    });


	function GetMonthlyTotalPost(){
        $.ajax({
            url: siteurl+'postviewsdetail/GetViewStat',
            data: {
				id:link[size-3],
				start_date:link[size-2],
				end_date:link[size-1]
			},
            type: 'POST',
            dataType: 'JSON',
            success: function (data, textStatus, jqXHR) {
                morrisChrt.setData(data);
            }
        });
	}
	
	GetMonthlyTotalPost();

});

function GoToPost(link){
    window.open(link);
}
