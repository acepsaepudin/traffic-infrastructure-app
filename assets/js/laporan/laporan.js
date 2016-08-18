$(function () {
    var xyz = getrusak();
    // console.log(xyz);
    var tegeel = xyz.tgl;
    tegeel = Object.keys(tegeel).map(function(key) {return tegeel[key]});
    var ee = xyz.datarusak;
    ee = Object.keys(ee).map(function(key){return ee[key]});
    // console.log(ee);
    var new_a = [];
    for(var x in ee){
        // console.log(ee[x]);
        // new_a.push(ee[x].nama);
        // new_a.push(ee[x].data);
        new_a.push({name : ee[x].nama, data: Object.keys(ee[x].data).map(function(key) {return ee[x].data[key]})});
    }
    console.log(new_a);
    $('#container').highcharts({
        title: {
            text: 'Data Kerusakan Dalam 1 Bulan',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: tegeel
        },
        yAxis: {
            title: {
                text: 'Total'
            },
            allowDecimals: false,
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ''
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: new_a
        // series: [{
        //     name: 'Tokyo',
        //     data: [1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0]
        // }]
    });
});



function getrusak() {
    var xyz;
    $.ajax({
        url: "http://tia.local/laporan/get_kerusakan",
        dataType: 'json',
        async: false,
        success: function(data) {
            xyz = data;
        }
    });
    return xyz;
}