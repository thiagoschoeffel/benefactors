<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Relatório de Contribuições</title>

    <style>
        body {
            font-family: sans-serif;
            color: #333
        }

        table {
            width: 100%;
        }

        table thead,
        table tfoot {
            background-color: #eee;
        }

        table thead tr th,
        table tbody tr td,
        table tfoot tr th {
            text-align: left;
            padding: 8px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <table style="margin-bottom: 20px; border: 1px solid #eee;">
        <tbody>
            <tr>
                <td>
                    <h1 style="margin: 0; font-size: 24px; font-weight: bolder;">Relatório de Contribuições</h1>
                </td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th style="width: 60%">Nome Benfeitor</th>
                <th style="width: 20%">Mês/Ano Referência</th>
                <th style="width: 20%">Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            ?>

            @foreach ($contributions as $contribution)

            <?php
            $total += $contribution->amount;
            ?>

            <tr>
                <td>{{ $contribution->benefactor->name }}</td>
                <td>{{ date('m/Y', strtotime($contribution->year_month_reference)) }}</td>
                <td>R$ {{ number_format($contribution->amount, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2" style="text-align: right;">Total</th>
                <th>R$ {{ number_format($total, 2, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
</body>

</html>
