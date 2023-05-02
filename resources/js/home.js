$(document).ready(function () {
    loadQuantityBooks();
});

function loadQuantityBooks() {
    $.ajax({
        url: '/api/chart/get-quantity-books', // Aquí debes especificar la URL que devuelve los datos
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            // Creamos un array con las etiquetas y otro con los valores
            var labels = [];
            var values = [];
            $.each(data, function (index, item) {
                labels.push(item.career);
                values.push(item.quantity);
            });

            // Creamos la gráfica utilizando Chart.js
            var ctx = document.getElementById('get-quantity-books').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: values,
                        backgroundColor: [
                            '#ff6384',
                            '#36a2eb',
                            '#ffce56',
                            '#cc65fe',
                            '#4bc0c0',
                            '#9966ff',
                            '#ff9933',
                            '#ff5c5c',
                            '#6699cc',
                            '#99cc99'
                        ]
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: true,
                            position: 'right',
                            align: 'center',
                            labels: {
                                font: {
                                    size: 10
                                }
                            }
                        },
                        title: {
                            display: true,
                            text: 'Libros Totales'
                        }
                    }
                }
            });
        }
    });
}