<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte General</title>
    <style>
        @page {
            margin: 5cm 0cm 2cm 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif !important;
            font-size: 12px;
        }

        #header {
            position: fixed;
            top: -5cm;
            left: 0cm;
        }

        #footer {
            position: fixed;
            bottom: -2cm;
            left: 0cm;
            right: 0cm;
            margin: auto;
            z-index: -1;
        }

        .title {
            margin-top: 0.5cm;
            font-size: 25px;
            font-weight: bold;
        }

        .text-center {
            text-align: center !important;
        }

        .container {
            margin-left: 1cm;
            margin-right: 1cm;
        }

        table {
            border: 1px solid #ccc;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            width: 100%;
            table-layout: fixed;
        }

        table caption {
            font-size: 1.5em;
            margin: .5em 0 .75em;
        }

        table tr {
            border: 1px solid #ddd;
            padding: .35em;
        }

        table th,
        table td {
            padding: .625em;
            text-align: center;
            font-size: 8px;
        }

        table th {
            font-size: .85em;
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        table thead {
            background-color: #3BBBA8;
        }
    </style>
</head>

<body>
    <div id="header" class="text-center">
        <img alt="Logo" src="{{ image('header_membrete.png') }}" class="imgheader" />
        <div class="title">Reporte General de libros</div>
    </div>
    <div id="footer" class="text-center">
        <img src="{{ image('footer_membrete.png') }}" alt="">
    </div>

    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Folio</th>
                    <th scope="col">Isbn</th>
                    <th scope="col" colspan="3">Titulo</th>
                    <th scope="col">Autor</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->books as $n => $book)
                    <tr>
                        <td>{{ $book->folio }}</td>
                        <td>{{ $book->isbn }}</td>
                        <td colspan="3">{{ $book->title }}</td>
                        <td>{{ $book->autor }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
