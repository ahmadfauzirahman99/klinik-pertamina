!function ($) {
    "use strict";

    var Dashboard1 = function () {
        this.$realData = []
    };
    //create line chart
    var $data = [
        { y: '2008', a: 50, b: 0 },
        { y: '2009', a: 75, b: 50 },
        { y: '2010', a: 30, b: 80 },
        { y: '2011', a: 50, b: 50 },
        { y: '2012', a: 75, b: 10 },
        { y: '2013', a: 50, b: 40 },
        { y: '2014', a: 75, b: 50 },
        { y: '2015', a: 100, b: 70 }
    ];
    this.createLineChart('morris-line-example', $data, 'y', ['a', 'b'], ['Series A', 'Series B'], ['0.9'], ['#ffffff'], ['#999999'], ['#10c469', '#188ae2']);
    //creates line chart
    Dashboard1.prototype.createLineChart = function (element, data, xkey, ykeys, labels, opacity, Pfillcolor, Pstockcolor, lineColors) {
        Morris.Line({
            element: element,
            data: data,
            xkey: xkey,
            ykeys: ykeys,
            labels: labels,
            fillOpacity: opacity,
            pointFillColors: Pfillcolor,
            pointStrokeColors: Pstockcolor,
            behaveLikeLine: true,
            gridLineColor: '#eef0f2',
            hideHover: 'auto',
            resize: true, //defaulted to true
            pointSize: 0,
            lineColors: lineColors
        });
    },

        $.Dashboard1 = new Dashboard1, $.Dashboard1.Constructor = Dashboard1

}(window.jQuery),

    //initializing 
    function ($) {
        "use strict";
        $.Dashboard1.init();
    }(window.jQuery);