var transfer_rate = function () {

    return {

        initCharts: function () {
//             var shopid = 0;
//             var timestr = $("#dashboard-report-range span").text();
             var date_range = $("#dashboard-report-range span").html().replace(/\ +/g, "");
             var date_list = date_range.split("-");
             var date_start = date_list[0].replace(/\/+/g, '-');
             var date_end = date_list[1].replace(/\/+/g, '-');

            $.post("getTransferData.php",{ start: date_start, end: date_end }, function (data) {
                if (data == "not") {
                    alert("时间范围超出系统可查询范围");
                    return;
                }
                else {
                	$(document).ready(function() {
				//if (typeof myTable == 'undefined') {
						var myTable = $('#chart_transfer_rate').DataTable( {
							"info": false,
							"searching": false,
							"paging": false,
							"ordering": false,
							"destory": true,
							"data": data, //DTR,VTR,BTR,BDTR,PTR,VATR,NATR,ADTR
							"columns": [
								{ "data": "DTR" },
								{ "data": "VTR" },
								{ "data": "BTR" },
								{ "data": "BDTR" },
								{ "data": "PTR" },
								{ "data": "VATR" },
								{ "data": "NATR" },
								{ "data": "ADTR" }
							]
						} );

						//document.getElementById("chart_transfer_rate").innerHTML=data;
						
// 						$('#chart_food_db tbody').on('click', 'tr', function () {
// 							var name = $('td', this).eq(2).text();
// 							alert( 'You clicked on '+name+'\'s row' );
// 						} );
					} );
                }
            });

        },
        
        initDashboardDaterange: function () {
            var cb = function (start, end, label) {
                App.blockUI(jQuery("#dashboard"));
                setTimeout(function () {
                    App.unblockUI(jQuery("#dashboard"));
                    $.gritter.add({
                        title: '提醒您',
                        text: '分析面板日期更新了.'
                    });
                    App.scrollTo();

                }, 100);
                //console.log(start.toISOString(), end.toISOString(), label);
                $('#dashboard-report-range span').html(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));
		if ($.fn.DataTable.isDataTable('#chart_transfer_rate')) {
			$('#chart_transfer_rate').DataTable().fnDestory();
		}
		transfer_rate.initCharts();
                //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
            }

            var optionSet1 = {
                startDate: moment(),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: moment(),
                //dateLimit: { days: 60 },
                showDropdowns: true,
                showWeekNumbers: false,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    '今天': [moment(), moment()],
                    '昨天': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    '最近7天': [moment().subtract('days', 6), moment()],
                    '最近30天': [moment().subtract('days', 29), moment()],
                    '本月': [moment().startOf('month'), moment().endOf('month')],
                    '上月': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                },
                opens: (App.isRTL() ? 'right' : 'left'),
                buttonClasses: ['btn blue'],
                applyClass: 'btn-small btn-primary',
                cancelClass: 'btn-small',
                format: 'MM/DD/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: '确定',
                    cancelLabel: '取消',
                    fromLabel: '从',
                    toLabel: '到',
                    customRangeLabel: '自定义',
                    daysOfWeek: ['周日', '周一', '周二', '周三', '周四', '周五', '周六'],
                    monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
                    firstDay: 1
                }
            };
            $('#dashboard-report-range span').html(moment().format('YYYY/MM/DD') + ' - ' + moment().format('YYYY/MM/DD'));
            $('#dashboard-report-range').daterangepicker(optionSet1, cb);
            $('#dashboard-report-range').show();

        }



    };

} ();
