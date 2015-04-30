// Connected to visual.php
$(document).foundation();

$(function () {
	var pct1 = $('#percentages0').val();
	var res1 = pct1.split(":");

	var pct2 = $('#percentages1').val();
	var res2 = pct1.split(":");

	var pct3 = $('#percentages2').val();
	var res3 = pct1.split(":");

	var pct4 = $('#percentages3').val();
	var res4 = pct1.split(":");


	var startPos = 'Own'
	var endPos = 'Own'

	if(res1[6] > 50) {
		res1[6] = 50-(res1[6]%50);
		startPos = "Opponent's";
	} else if(res1[6] == 50) {
		startPos = 'the';
	}

	if(res1[7] > 50) {
		res1[7] = 50-(res1[7]%50);
		endPos = "Opponent's";
	} else if(res1[7] == 50) {
		endPos == 'the';
	}

	var subtext = '';
	if(res1[6] == res1[7]) {
		subText = 'Plays at ' +startPos +' ' +res1[6];
	}
	else {
		subText = 'Plays between ' +startPos +' ' +res1[6] +' and ' +endPos +' ' +res1[7] 
	}

// Make monochrome colors and set them as default for all pies
Highcharts.getOptions().plotOptions.pie.colors = (function () {
	var colors = [],
        base = Highcharts.getOptions().colors[0],
        i;

        for (i = 0; i < 10; i += 1) {
        // Start out with a darkened base color (negative brighten), and end
        // up with a much brighter color
        	colors.push(Highcharts.Color(base).brighten((i - 3) / 7).get());
        }
        return colors;
}());

// --- Here --- //
/*
    $('#container').highcharts({
	chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Field Break Down'
        },
        subtitle: {
            text: subText
	},
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: [
                ['Pass',   parseFloat(res1[0])],
                ['Rush',   parseFloat(res1[1])],
		{
			name: 'Other',
			y: parseFloat(res1[3]),
			sliced: true,
			select: true
		},
                ['FG',     parseFloat(res1[2])]
            ]
        }]
    });*/
// -- End --- //



    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Field Break Down'
        },
        subtitle: {
            text: subText
	},
        xAxis: {
            categories: [
                'Pass',
                'Rush',
                'FG Taken',
                'Other',
                'FG Made',
                'TD Scored'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Occurence (%)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}%</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Breakdown',
	    data: [parseFloat(res1[0]),parseFloat(res1[1]),parseFloat(res1[2]),parseFloat(res1[3]),parseFloat(res1[5]),parseFloat(res1[4])]
	}]
    });
});

