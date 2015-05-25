$(document).ready(function() {	
	
	var tidakhadir = [ [1, 8], 
			[2, 9],
            [3, 13],
            [4, 12],
            [5,7],
            [6, 8],
            [7, 12],
            [8, 10],
            [9, 11],
            [10, 9],
            [11, 12],
            [12, 10],
            [13, 11],
            [14, 9],
            [15, 8],
            [16, 12],
            [17, 11],
            [18, 10],
            [19, 9],
            [20, 8]       
            ];

    var ijin = [ [1, 3], 
			[2, 4],
            [3, 7],
            [4, 6],
            [5,5],
            [6, 4],
            [7, 3],
            [8, 4],
            [9, 3],
            [10, 3],
            [11, 3],
            [12, 4],
            [13, 5],
            [14, 3],
            [15, 2],
            [16, 1],
            [17, 3],
            [18, 4],
            [19, 6],
            [20, 2]       
            ];

	var terlambat = [ [1, 3], 
			[2, 5],
            [3, 4],
            [4, 7],
            [5,5],
            [6, 3],
            [7, 2],
            [8, 5],
            [9, 4],
            [10, 5],
            [11, 2],
            [12, 7],
            [13, 8],
            [14, 10],
            [15, 5],
            [16, 7],
            [17, 3],
            [18, 4],
            [19, 7],
            [20, 4]
            ];

var sakit = [ [1, 3], 
			[2, 4],
            [3, 3],
            [4, 4],
            [5,4],
            [6, 3],
            [7, 2],
            [8, 4],
            [9, 5],
            [10, 5],
            [11, 6],
            [12, 3],
            [13, 4],
            [14, 5],
            [15, 6],
            [16, 3],
            [17, 4],
            [18, 2],
            [19, 5],
            [20, 4]
            

];

var tidakadaketerangan = [ [1, 2], 
			[2, 3],
            [3, 1],
            [4, 5],
            [5,1],
            [6, 2],
            [7, 1],
            [8, 2],
            [9, 3],
            [10, 1],
            [11, 2],
            [12, 1],
            [13, 4],
            [14, 1],
            [15, 2],
            [16, 3],
            [17, 2],
            [18, 5],
            [19, 1],
            [20, 1]
            

];
	var plot = $.plotAnimator($("#placeholder"), [
			{  	label: "Tidak Hadir",
				data: tidakhadir, 	
				animator: {steps: 60, duration: 500, start:0}, 	
				lines: {				
					fill: 0.6,
					lineWidth: 0,				
				},
				color:'#cbeeff'
			},{ 
				label: "Ijin",
				data: ijin, 
				animator: {steps: 60, duration: 100, start:0}, 		
				lines: {				
					fill: 0.1,
					lineWidth: 1,				
				},				
				color: '#9e3edb',
				shadowSize:0
			},{ 
				label: "Sakit",
				data: sakit, 
				animator: {steps: 60, duration: 1000, start:0}, 		
				lines: {				
					fill: 0.1,
					lineWidth: 1,				
				},				
				color: '#54d183',
				shadowSize:0
			},{ 
				label: "Tidak ada keterangan",
				data: tidakadaketerangan, 
				animator: {steps: 60, duration: 1000, start:0}, 		
				lines: {				
					fill: 0.1,
					lineWidth: 1,				
				},				
				color: '#ef4c05',
				shadowSize:0
			},
			{	label: "Terlambat",
				data: terlambat, 
				points: { show: false, fill: true, radius:1,fillColor:"#aee0fa",lineWidth:1 },	
				lines: {				
					fill: 0.1,
					lineWidth: 1,				
				},
				color: '#53c3f7',				
				shadowSize:0
			}
		],{	xaxis: {
		tickLength: 0,
		tickDecimals: 0,
		min:2,

				font :{
					lineHeight: 13,
					style: "normal",
					weight: "bold",
					family: "sans-serif",
					variant: "small-caps",
					color: "#6F7B8A"
				}
			},
			yaxis: {
				ticks: 3,
                tickDecimals: 0,
				tickColor: "#f0f0f0",
				font :{
					lineHeight: 13,
					style: "normal",
					weight: "bold",
					family: "sans-serif",
					variant: "small-caps",
					color: "#6F7B8A"
				}
			},
			grid: {
				backgroundColor: { colors: [ "#fff", "#fff" ] },
				borderWidth:1,borderColor:"#f0f0f0",
				margin:0,
				minBorderMargin:0,							
				labelMargin:20,
				hoverable: true,
				clickable: true,
				mouseActiveRadius:6
			},
			legend: { show: true}
		});

	$("#placeholder").bind("plothover", function (event, pos, item) {
				if (item) {
					var x = item.datapoint[0].toFixed(2),
						y = item.datapoint[1].toFixed(2);

					$("#tooltip").html(item.series.label + " (" + x + ") : " + y)
						.css({top: item.pageY+5, left: item.pageX+5})
						.fadeIn(200);
				} else {
					$("#tooltip").hide();
				}
	
		});
	
	$("<div id='tooltip'></div>").css({
			position: "absolute",
			display: "none",
			border: "1px solid #fdd",
			padding: "2px",
			"background-color": "#fee",
			"z-index":"99999",
			opacity: 0.80
	}).appendTo("body");
	
	
	
	

    //KETIDAKHADIRAN PIE CHART
    Morris.Donut({
	  element: 'donut-example',
	  data: [
		{label: "Cuti", value: 12},
		{label: "Sakit", value: 30},
		{label: "Ijin", value: 20},
		{label: "Tidak ada keterangan", value: 13}
	  ],
	  colors:['#60bfb6','#91cdec','#eceff1','#f35958']
	});



});

