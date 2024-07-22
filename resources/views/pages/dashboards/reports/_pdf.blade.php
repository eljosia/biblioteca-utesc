<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data->title }}</title>
    <style>
        @page {
            margin: 3.5cm 0cm 2cm 0;
            header: page-header;
            footer: page-footer;
        }

        body {
            font-family: Arial, Helvetica, sans-serif !important;
            font-size: 12px;
            color: #333;
            margin: 0;
            padding: 0;
        }

        #header {
            position: fixed;
            top: -1cm;
            left: 0cm;
            width: 100%;
        }

        #footer {
            position: fixed;
            bottom: -1.2cm;
            left: 0cm;
            right: 0cm;
            width: 100%;
            text-align: center;
            z-index: -1;
        }

        .title {
            margin-top: 0.5cm;
            font-size: 25px;
            text-align: center;
            color: #333;
        }

        .container {
            margin: 1cm;
            margin-bottom: 2cm;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 3.5cm;
        }

        table caption {
            font-size: 1.5em;
            margin: .5em 0 .75em;
            font-weight: bold;
            text-align: center;
        }

        table th,
        table td {
            padding: 0.75em;
            text-align: center;
            font-size: 10px;
        }

        table th {
            background-color: #3BBBA8;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        table thead {
            background-color: #3BBBA8;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .imgheader,
        .imgfooter {
            width: 100%;
            height: auto;
        }

        .date {
            margin-bottom: 10px;
            font-style: italic;
        }
    </style>
</head>

<body>
    <htmlpageheader name="page-header">
        <div id="header" class="text-center">
            <img alt="Logo" src="http://biblioteca-utesc.local//images/header_membrete.png" class="imgheader" />
        </div>
    </htmlpageheader>
    <htmlpagefooter name="page-footer">
        <div id="footer" class="text-center">
            <img src="http://biblioteca-utesc.local//images/footer_membrete.png" alt="" class="imgfooter">
        </div>
    </htmlpagefooter>

    <div class="title">{{ $data->title }}</div>
    <div class="container">
        @if ($data->date)
            <div class="date">{{ $data->date }}</div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    @foreach ($data->thead as $header)
                        <th>{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>

            <tbody>
                @foreach ($data->books as $book)
                    <tr>
                        @if ($data->type == 'general')
                            <td>{{ $book->folio }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->area }}</td>
                            <td>{{ $book->autor }}</td>
                            <td>{{ $book->shelf }}</td>
                        @elseif ($data->type == 'area')
                            <td>{{ $book->folio }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->autor }}</td>
                            <td>{{ $book->shelf }}</td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
