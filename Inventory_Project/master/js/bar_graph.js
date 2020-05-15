/**
 * Created by Jomari Garcia on 11/05/2020.
 */

google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawStuff);

function drawStuff()
{
    var data = new google.visualization.arrayToDataTable([
        ['Opening Move', 'Percentage'],
        ["King's pawn (e4)", 44],
        ["Queen's pawn (d4)", 31],
        ["Knight to King 3 (Nf3)", 12],
        ["Queen's bishop pawn (c4)", 10],
        ['Other', 3]
    ]);

    var options = {
        title: 'Chess opening moves',
        width: 900,
        legend: { position: 'none' },
        chart: { title: 'Products',
            subtitle: 'popularity by percentage' },
        bars: 'horizontal', // Required for Material Bar Charts.
        axes: {
            x: {
                0: { side: 'top', label: 'Percentage'} // Top x-axis.
            }
        },
        bar: { groupWidth: "90%" }
    };

    var chart = new google.charts.Bar(document.getElementById('top_x_div'));
    chart.draw(data, options);
}
