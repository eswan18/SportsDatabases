// Connected to visual.php
$(document).foundation();

$(function () {
	var pct1 = $('#percentages0').val();
	var res1 = pct1.split(":");

	var pct2 = $('#percentages1').val();
	var res2 = pct2.split(":");

	var pct3 = $('#percentages2').val();
	var res3 = pct3.split(":");

	var pct4 = $('#percentages3').val();
	var res4 = pct4.split(":");


	var startPos = 'Own'
	var endPos = 'Own'

	var subText = '';
	if(res1[6] == res1[7]) {
		if(res1[6] > 50) {
			res1[6] = 50-(res1[6]%50);
			startPos = "Opponent's";
		} else if(res1[6] == 50) {
			startPos = 'the';
		}	
		subText = 'Plays at ' +startPos +' ' +res1[6];
	} else {
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
		subText = 'Plays between ' +startPos +' ' +res1[6] +' and ' +endPos +' ' +res1[7] 
	}

// -- Column Graph -- //
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Field Statistics By Down'
        },
        subtitle: {
            text: subText
	},
        xAxis: {
            categories: [
                'Pass',
                'Rush',
                'FG Attempted',
                'Other',
                'FG Made',
                'TD Scored'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
	    max: 100,
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
            name: 'First Down',
	    data: [parseFloat(res1[0]),parseFloat(res1[1]),parseFloat(res1[2]),parseFloat(res1[3]),parseFloat(res1[5]),parseFloat(res1[4])]
	  },{
	    name: 'Second Down',
	    data: [parseFloat(res2[0]),parseFloat(res2[1]),parseFloat(res2[2]),parseFloat(res2[3]),parseFloat(res2[5]),parseFloat(res2[4])]
	  },{
	    name: 'Third Down',
	    data: [parseFloat(res3[0]),parseFloat(res3[1]),parseFloat(res3[2]),parseFloat(res3[3]),parseFloat(res3[5]),parseFloat(res3[4])]
	  },{
	    name: 'Fourth Down',
	    data: [parseFloat(res4[0]),parseFloat(res4[1]),parseFloat(res4[2]),parseFloat(res4[3]),parseFloat(res4[5]),parseFloat(res4[4])]
	}]
    });

// -- Donut Graph -- //
var colors = Highcharts.getOptions().colors,
        categories = ['Pass', 'Rush', 'Field Goal', 'Other'],
        data = [{
            y: Math.round((parseFloat(res1[0]) + parseFloat(res2[0]) + parseFloat(res3[0]) + parseFloat(res4[0]))/4*100)/100,
            color: colors[0],
            drilldown: {
                name: 'Pass Downs',
                categories: ['First', 'Second', 'Third', 'Fourth'],
                data: [Math.round(parseFloat(res1[0])/4*100)/100, Math.round(parseFloat(res2[0])/4*100)/100, Math.round(parseFloat(res3[0])/4*100)/100, Math.round(parseFloat(res4[0])/4*100)/100],
                color: colors[0]
            }
        }, {
            y: Math.round((parseFloat(res1[1]) + parseFloat(res2[1]) + parseFloat(res3[1]) + parseFloat(res4[1]))/4*100)/100,
            color: colors[1],
            drilldown: {
                name: 'Rush Downs',
                categories: ['First', 'Second', 'Third', 'Fourth'],
                data: [Math.round(parseFloat(res1[1])/4*100)/100, Math.round(parseFloat(res2[1])/4*100)/100, Math.round(parseFloat(res3[1])/4*100)/100, Math.round(parseFloat(res4[1])/4*100)/100],
                color: colors[1]
            }
        }, {
            y: Math.round((parseFloat(res1[2]) + parseFloat(res2[2]) + parseFloat(res3[2]) + parseFloat(res4[2]))/4*100)/100,
            color: colors[2],
            drilldown: {
                name: 'Field Goal Downs',
                categories: ['First', 'Second', 'Third', 'Fourth'],
                data: [Math.round(parseFloat(res1[2])/4*100)/100, Math.round(parseFloat(res2[2])/4*100)/100, Math.round(parseFloat(res3[2])/4*100)/100, Math.round(parseFloat(res4[2])/4*100)/100],
                color: colors[2]
            }
        }, {
            y: Math.round((parseFloat(res1[3]) + parseFloat(res2[3]) + parseFloat(res3[3]) + parseFloat(res4[3]))/4*100)/100,
            color: colors[3],
            drilldown: {
                name: 'Other Downs',
                categories: ['First', 'Second', 'Third', 'Fourth'],
                data: [Math.round(parseFloat(res1[3])/4*100)/100, Math.round(parseFloat(res2[3])/4*100)/100, Math.round(parseFloat(res3[3])/4*100)/100, Math.round(parseFloat(res4[3])/4*100)/100],
                color: colors[3]
            }
        }],
        browserData = [],
        versionsData = [],
        i,
        j,
        dataLen = data.length,
        drillDataLen,
        brightness;


    for (i = 0; i < dataLen; i += 1) {

        browserData.push({
            name: categories[i],
            y: data[i].y,
            color: data[i].color
        });

        drillDataLen = data[i].drilldown.data.length;
        for (j = 0; j < drillDataLen; j += 1) {
            brightness = 0.2 - (j / drillDataLen) / 5;
            versionsData.push({
                name: data[i].drilldown.categories[j],
                y: data[i].drilldown.data[j],
                color: Highcharts.Color(data[i].color).brighten(brightness).get()
            });
        }
    }

    $('#container1').highcharts({
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Play Type by Down'
        },
        yAxis: {
            title: {
                text: subText
            }
        },
        plotOptions: {
            pie: {
                shadow: false,
                center: ['50%', '50%']
            }
        },
        tooltip: {
            valueSuffix: '%'
        },
        series: [{
            name: 'Play Types',
            data: browserData,
            size: '60%',
            dataLabels: {
                formatter: function () {
                    return this.y > 5 ? this.point.name : null;
                },
                color: 'white',
                distance: -30
            }
        }, {
            name: 'Down',
            data: versionsData,
            size: '80%',
            innerSize: '60%',
            dataLabels: {
                formatter: function () {
                    return this.y > 1 ? '<b>' + this.point.name + ':</b> ' + this.y + '%'  : null;
                }
            }
        }]
    });
});

