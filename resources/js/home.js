$(document).ready(function () {
    loadQuantityBooks();
    loadDailySearchQuantity();
    loadLoansToBeDelivery();

    $('body').on("click", 'td.open-modal', function () {
        let identifier = $('td.open-modal').data('ide');
        h.profile_modal(identifier);
    });
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
                labels.push(`${item.career} (${item.quantity})`);
                values.push(item.quantity);
            });

            // Creamos la gráfica utilizando Chart.js
            var ctx = document.getElementById('get-quantity-books').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
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
                                    size: 8
                                }
                            }
                        },
                        title: {
                            display: false,
                            text: 'Libros Totales'
                        },
                        datalabels: false
                    }
                }
            });
        }
    });
}

function loadDailySearchQuantity() {
    $.ajax({
        url: '/api/chart/get-daily-search-quantity', // Aquí debes especificar la URL que devuelve los datos
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            // Creamos un array con las etiquetas y otro con los valores
            var labels = [];
            var values = [];
            $.each(data, function (index, item) {

                labels.push(h.dateAgo(item.date));
                values.push(item.count);
            });

            // Creamos la gráfica utilizando Chart.js
            var ctx = document.getElementById('get-daily-search').getContext('2d');
            var daily_search = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Busquedas de libros',
                        data: values,
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false,
                            position: 'top',
                        },
                        title: {
                            display: false,
                            text: 'Busquedas diarias de libros'
                        }
                    }
                }
            });
        }
    });
}

function loadLoansToBeDelivery() {
    h.getPetition('/api/chart/get-loans-to-be-delivery', {}, 'GET').then(res => {
        var tr = "";
        var status
        if (res.lenght > 0)
            $.each(res, function (i, item) {
                if (item.days_since_return == 0) {
                    status = `<span class="badge bg-warning">Hoy</span>`;
                } else {
                    status = `<span class="badge bg-danger">${h.dateAgo(item.return_date)}</span>`;
                }
                tr += ` <tr>
                        <td class="text-xs text-wrap">${item.name} ${item.last_name} (${item.identifier})</td>
                        <td>${status}</td>
                        <td class="text-sm open-modal" data-ide="${item.identifier}" data-bs-toggle="modal" data-bs-target="#modal-delivery-info"><i class="fa-regular fa-eye"></i></td>
                    </tr>`;
            });
        else {
            tr += `<tr>
                        <td colspan="3" class="text-center">No hay libros por entregar</td>
                    </tr>`;
        }
        $('#to-delivery-books tbody').html(tr)
    });
}