$( document ).ready(function() {

    $.get( "stats/clientsProducts", function( obj1 ) {

        var obj = $.parseJSON( obj1 );
        var datasets = [];
        var b = 0;
        $.each(obj.datasets, function(k, v) {
            var color= getRandomColor(0.6);
            var pointBorderColor= getRandomColor(0.5);
            datasets[b] = {
                label: k,
                backgroundColor: color,
                borderColor:color,
                pointBackgroundColor: "rgba(179,181,198,1)",
                pointBorderColor: pointBorderColor,
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(119,181,198,1)",
                pointRadius: 4,
                hitRadius: 11,
                data: v
            };
            b++;
        });
        var data = {
            labels: obj.labels,
            datasets: datasets
        };

        var ctx = document.getElementById("clientsProducts");
        new Chart(ctx, {
            type: "radar",
            data: data,
            options: {
                scale: {
                    reverse: false,
                    ticks: {
                        beginAtZero: true
                    }
                },
                hitRadius: 2
            }
        });
        //fix the color and the add new item element new id and add all and delete product functionality
        //clients deleted orders and not deleted ones
        //to search
        //sort by client orders

    });

    $.get( "stats/productSales", function( obj1 ) {

        var obj = $.parseJSON( obj1 );
        console.log(obj);
        var datasets = [];
        var b = 0;
        var pointBorderColor= getRandomColor(0.5);
        var length = obj.datasets.length;
        var colors1 = borderAndBackColor(length);
        datasets[b] = {
            label: "Продадено количество продукти",
            backgroundColor: colors1[0],
            borderColor: colors1[1],
            borderWidth: 1,
            pointBackgroundColor: "rgba(179,181,198,1)",
            pointBorderColor: pointBorderColor,
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(119,181,198,1)",
            pointRadius: 4,
            hitRadius: 11,
            data: obj.datasets
        };

        var data = {
            labels: obj.labels,
            datasets: datasets
        };

        var ctx = document.getElementById("productSales");
        new Chart(ctx, {
            type: "bar",
            data: data,
            options: {
                scale: {
                    reverse: false,
                    ticks: {
                        beginAtZero: true
                    }
                },
                hitRadius: 2
            }
        });
        //fix the color and the add new item element new id and add all and delete product functionality
        //clients deleted orders and not deleted ones
        //to search
        //sort by client orders

    });
});