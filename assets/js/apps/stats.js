$(function (){
    var start = moment().startOf('month');
    var end   = moment().endOf('month');

    function cb(start, end) {
        $('[name="range"]').val(start.format('YYYY-MM-DD') + ';' + end.format('YYYY-MM-DD'))
        $('#daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    $('#daterange').daterangepicker({
            startDate: start,
            endDate: end,
            opens:"right",
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
    }, cb);

    cb(start, end);

	var date = $('[name="range"]').val().split(";");
	

	//CHART
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
        labels: ['Total Views'],
        barColors: ['#5058AB'],
        gridTextSize: 11,
        hideHover: 'auto',
        resize: true
    });


	function GetMonthlyTotalPost(){
		var date = $('[name="range"]').val().split(";");
        $.ajax({
            url: siteurl+'stats/GetViewStat',
            data: {
				start_date:date[0],
				end_date:date[1]
			},
            type: 'POST',
            dataType: 'JSON',
            success: function (data, textStatus, jqXHR) {
                morrisChrt.setData(data);
            }
        });
	}
	
	GetMonthlyTotalPost();

	//TABLE
    var payTable = $('#datatable1').DataTable({
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'print',
                text: 'Print',
                autoPrint: false,
                footer: true,
                title: 'Nihao Indonesia View Stats ',
                messageTop: function(){
					var date = $('[name="range"]').val().split(";");
					return "From "+moment(date[0]).format('MMMM D, YYYY')+" until "+moment(date[1]).format('MMMM D, YYYY')
				}
            },
            'excelHtml5',
            'pdfHtml5'
        ],
        responsive: false,
        processing: true,
        ajax: {
              url: siteurl+'stats/GetTableData/'+date[0]+"/"+date[1],
              dataSrc: ''
        },
        "columnDefs": [
            { 
                "className": "dt-body-right", "targets": [2] 
            }
        ],
        language: {
          searchPlaceholder: 'Search...',
          sSearch: '',
          bProcessing: "<span class='glyphicon glyphicon-refresh glyphicon-refresh-animate'></span>",
          lengthMenu: '_MENU_ items/page'
        },
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
           
            for(var i=2;i<=2;i++){
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

    $('#searchBtn').click(function (e){
        var date = $('[name="range"]').val().split(";");
		payTable.ajax.url( siteurl+'stats/GetTableData/'+date[0]+"/"+date[1]).load();
		GetMonthlyTotalPost();
    });

    $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity }); 
});

