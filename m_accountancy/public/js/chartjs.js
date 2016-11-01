$( document ).ready(function() {

    $.get( "stats/getClientAmounts", function( data ) {

        var obj = jQuery.parseJSON( data );
        var length = obj.datasets.length;
        var colors1 = borderAndBackColor(length);
        var datas = {
            labels: obj.labels,
            datasets: [
                {
                    label: "Общ брой закупени продукти",
                    backgroundColor: colors1[0],
                    borderColor: colors1[1],
                    borderWidth: 1,
                    data: obj.datasets
                }
            ]
        };
        var amounts = document.getElementById("amounts");
        new Chart(amounts, {
            type: 'bar',
            data: datas,
            options: {
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'брой'
                        }
                    }]
                }
            }
        });
    });
    $.get( "stats/getTotalSums", function( data ) {
        var obj = jQuery.parseJSON( data );
        var length = obj.datasets.length;
        var colors1 = borderAndBackColor(length);
        var datas = {
            labels: obj.labels,
            datasets: [
                {
                    label: "Общ брой закупена стойност",
                    backgroundColor: colors1[0],
                    borderColor: colors1[1],
                    borderWidth: 1,
                    data: obj.datasets
                }
            ]
        };
        var sums = document.getElementById("sums");
        new Chart(sums, {
            type: 'bar',
            data: datas,
            options: {
                scales: {
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'лв.'
                        }
                    }]
                }
            }
        });
    });
});