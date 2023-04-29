<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prestamo Externo: {{ $data->loan->code }}</title>
    <style>
        @page {
            margin-top: 0;
            margin-bottom: 0;
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        .A1 {
            position: relative;
            height: 29.5cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-size: 11px;
        }

        .A1 footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
            /* Centra la imagen horizontalmente */
        }

        body {
            font-family: Arial, Helvetica, sans-serif !important;
            font-size: 12px;
            margin: 0 !important;
        }

        header {
            margin-bottom: 15px;
        }

        #logo {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 1rem;
            margin-top: 1rem;
        }

        #logo img {
            margin-right: 2em;
        }

        #logo .text {
            margin-top: 1rem;
            text-align: center;
            font-size: 1.1rem;
            font-weight: bold;
            color: #000 !important;
        }

        h1 {
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
            color: #5D6975;
            font-size: 1.8em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
        }

        #data .salon {
            width: 50%;
            float: right;
        }

        #data .itm {
            height: 15px;
        }

        #data .itm span {
            width: 22%;
        }

        #data .event {
            width: 50%;
            float: left;
        }

        .info {}

        .text-center {
            text-align: center !important;
        }

        span {
            text-transform: uppercase;
            color: #5D6975;
            /* text-align: right; */
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
            /* font-weight: bold; */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        .striped tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table .service,
        table .desc {
            text-align: center;
        }

        table td {
            padding: 10px;
            text-align: right;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table td.grand {
            border-top: 1px solid #5D6975;
            ;
        }

        #sign {
            margin-top: 50px;
        }

        #sign .client,
        .company {
            width: 40%
        }

        #sign .client,
        .company .text {
            text-align: center;
        }

        .sign-line {
            border-bottom: 1px solid;
            width: 300px;
            margin: auto;
        }

        .text-right {
            text-align: end;
        }

        .text-left {
            text-align: start;
        }

        .line-cut {
            margin: 40px 0;
        }
    </style>
</head>

<body>
    <div class="A1">
        <header class="text-center">
            <img alt="Logo" src="{{ image('header_membrete_2.png') }}" class="logo" />
        </header>
        <main>
            <h1>PRESTAMO EXTERNO</h1>
            <div class="data">
                <div class="event" style="margin-bottom: 15px">
                    <div class="itm"><span>Referencia:</span> {{ $data->loan->code }}
                    </div>
                    <div class="itm"><span>Fecha de Prestamo:</span> @date($data->loan->created_at)</div>
                    <div class="itm"><span>Fecha Límite de entraga:</span>
                        @date($data->loan->return_date)
                    </div>
                </div>

            </div>
            <table>
                <tbody>
                    <tr>
                        <td colspan="3" class="text-center">
                            <h2>Datos de la persona</h2>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"><span>Matrícula / No. Empleado:</span><br>
                            {{($data->people->identifier)}}
                        </td>
                        <td class="text-center"><span>Nombre:</span><br>
                            {{ $data->people->name }} {{ $data->people->last_name }}
                        </td>
                        <td class="text-center"><span>Teléfono</span> <br>
                            {{ $data->people->phone ? $data->people->phone : ' - - - ' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"><span>Carrera:</span><br>
                            {{ $data->people->career }}
                        </td>
                        <td class="text-center">
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-center">
                            <h2>Datos del libro</h2>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center"><span>Num de Adquisición:</span><br>
                            {{ $data->book->folio }}
                        </td>
                        <td class="text-center"><span>Titulo:</span><br>
                            {{ $data->book->title }}
                        </td>
                        <td class="text-center"><span>Autor</span> <br>
                            {{ $data->book->autor }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <div style="font-size: 0.6rem">
                <div class="text-center">
                    <h2>REGLAMENTO DE PRÉSTAMO EXTERNO DE ACERVO BIBLIOGRÁFICO</h2>
                </div>

                <p>La Biblioteca de la Universidad cuenta con acervos bibliográficos y hemerográficos. El uso indebido
                    de
                    los mismos hará acreedor al infractor a las sanciones establecidas en el presente Reglamento y las
                    determinadas en la Legislación Universitaria en materia de protección de los bienes patrimoniales.
                    (Artículo 14)</p>

                <h2>Artículo 17.- Préstamo a domicilio.</h2>

                <p>El préstamo a domicilio facilita al usuario interno a disponer del material documental que está
                    autorizado y puede ser consultado fuera de la biblioteca de la Universidad.</p>

                <ol>
                    <li>El usuario interno podrá obtener un máximo de tres libros durante cinco días naturales; el
                        préstamo
                        podrá prorrogarse una sola vez por el mismo periodo.</li>
                    <li>El registro de préstamo para académicos, investigadores, funcionarios y personal administrativo
                        de
                        la Universidad, tendrán vigencia de un semestre.</li>
                    <li>El usuario se obliga a conservar en buen estado los materiales documentales que le sean
                        prestados y
                        será su responsabilidad en caso de robo, pérdida, extravío o deterioro de estos.</li>
                    <li>Los usuarios que no devuelvan los materiales bibliográficos en la fecha convenida o al
                        devolverlos
                        se encuentren en mal estado, se les aplicarán las sanciones correspondientes.</li>
                </ol>

                <h2>Artículo 21.- Sanciones para usuarios internos.</h2>

                <p>Los usuarios que no cumplan con las disposiciones del presente Reglamento se hacen acreedores a las
                    siguientes sanciones:</p>

                <ol>
                    <li>Multas por material no devuelto.
                        <ul>
                            <li>El usuario se hace acreedor a la suspensión del servicio.</li>
                            <li>Si el tiempo de entrega excede de quince días naturales, el usuario se hace acreedor a
                                una
                                semana de suspensión de los servicios bibliotecarios y si aun así persiste en la falta,
                                se
                                le sancionará suspendiéndole los servicios bibliotecarios.</li>
                        </ul>
                    </li>
                    <li>Por extravío, robo o pérdida. En caso de pérdida del material bibliográfico, el usuario deberá
                        reponerlo de inmediato a la biblioteca de la Universidad, la reposición se hará en un término de
                        quince días hábiles.</li>
                </ol>
            </div>

            <div id="sign">
                <table>
                    <tbody>
                        <tr>
                            <td class="text-center">
                                <div class="text" style="margin-bottom: 2rem;">Enterado (a):</div>
                                <div class="sign-line"></div><br>
                                <div class="text">Firma de {{ $data->people->name }}</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
        <footer>
            <img src="{{ image('footer_membrete.png') }}" alt="">
        </footer>
    </div>
</body>

</html>
