import { jsPDF } from "jspdf";
import 'jspdf-autotable';

$(document).ready(function () {


    new AirDatepicker('#datefilter', {
        locale: localeEs,
        range: true,
        multipleDatesSeparator: ' - '
    })

    $('#report-type').on('change', function (e) {
        e.preventDefault();
        var v = $(this).val();
        if (v == "general") {
            $('#btngen').data('url')
            $('#by-area').addClass('d-none')
            $('#area').val("");
            $('#by-shelf').addClass('d-none').val("");
            $('#shelf').val("");
            $('#by-dates').addClass('d-none').val("");
            $('#fechar').val("");
        } else if (v == "area") {
            $('#by-area').removeClass('d-none');
        }
    });

    $('#report-filtre').on('submit', function (e) {
        e.preventDefault();
        var url
        var formData = {
            type: $('select[name="type"]').val(),
            area_id: $('select[name="area_id"]').val(),
            fechas: $('input[name="datefilter"]').val(),
            key: $('meta[name="data-key"]').attr('content'),

        };

        // Remover parámetros vacíos
        Object.keys(formData).forEach(function (key) {
            if (!formData[key]) {
                delete formData[key];
            }
        });
        url = $(this).attr('action') + '?' + $.param(formData);
        genReport(url)
    })
})

async function genReport(url) {
    let header
    let footer
    const headColor = [59, 187, 168];
    let areas = [];
    let totalA = [];
    let tbody

    //GENERAMOS LA CABECERA Y FOOTER EN BASE64
    toDataURL('/images/header_membrete.png', function (img) { header = img });
    toDataURL('/images/footer_membrete.png', function (img) { footer = img });


    fetch(url)
        .then(response => response.json())
        .then(data => {
            //CREAMOS EL THEAD DE LAS CARRERAS
            data.allcareers.forEach((e) => {
                areas.push([e.area]);
                totalA.push([e.total]);
            });

            //Cargamos el contenido
            if (data.type == "general") {
                tbody = data.books.map(item => [item.folio, item.title, item.area, item.autor, item.shelf]);
            } else if (data.type == "area") {
                tbody = data.books.map(item => [item.folio, item.title, item.autor, item.shelf]);
            }
            // Crear un nuevo documento jsPDF
            const doc = new jsPDF();

            // Agregar el título del reporte
            doc.setFontSize(20);
            doc.text(
                doc.internal.pageSize.getWidth() / 2,
                40,
                data.title,
                "center"
            );

            doc.setFontSize(10);
            doc.text(5, 50, "Fecha: " + data.date);
            // CARRERAS Y SU TOTAL
            if (data.type == "general") {
                doc.autoTable({
                    head: [areas],
                    body: [totalA],
                    startY: 55,
                    styles: {
                        fontSize: 7,
                        halign: "center",
                        valign: "center",
                        tableLineWidth: 1,
                    },
                    headStyles: { fillColor: headColor },
                    margin: {
                        left: 5,
                        right: 5,
                    },
                });
            }
            //REPORTE
            doc.autoTable({
                showHead: "everyPage",
                didDrawPage: function (data) {
                    //Header
                    doc.addImage(header, "PNG", 0, 0, 0, 0);

                    //footer
                    var pageSize = doc.internal.pageSize;
                    var pageHeight = pageSize.height
                        ? pageSize.height
                        : pageSize.getHeight();
                    doc.addImage(footer, "PNG", 10, pageHeight - 20);
                },
                head: [data.thead],
                headStyles: { fillColor: headColor },
                columnStyle: {
                    0: { columnWidth: 215 },
                },
                tableWidth: "auto",
                body: tbody,
                styles: {
                    fontSize: 7,
                },
                startY: (data.type == "general") ? 75 : 55,
                margin: {
                    top: 30,
                    left: 5,
                    right: 5,
                    bottom: 15,
                },
            });
            // doc.save(`reporte.pdf`);
            // Generar un blob con el contenido del PDF
            var blob = doc.output('blob');

            // Crear una URL del blob generado
            var url = URL.createObjectURL(blob);

            // Abrir una nueva pestaña del navegador con el PDF
            window.open(url);
        });

}

async function toDataURL(src, callback) {
    // Crea un objeto XMLHttpRequest
    const xhr = new XMLHttpRequest();

    // Configura la solicitud
    xhr.open('GET', src, true);
    xhr.responseType = 'blob';

    // Cuando se carga la imagen, conviértela a Base64
    xhr.onload = function () {
        const reader = new FileReader();
        reader.onloadend = function () {
            callback(reader.result);
        }
        reader.readAsDataURL(xhr.response);
    };

    // Envía la solicitud
    xhr.send();
}