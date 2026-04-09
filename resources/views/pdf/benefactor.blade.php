<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Ficha de Cadastro</title>

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
    @for ($i = 0; $i < 2; $i++) <table style="margin-bottom: 10px; border: 1px solid #eee;">
        <tbody>
            <tr>
                <td>
                    <h1 style="margin: 0; font-size: 24px; font-weight: bolder;">Ficha de Cadastro</h1>
                </td>
            </tr>
        </tbody>
        </table>

        <table>
            <tbody>
                <tr>
                    <td>
                        Receber:
                        <span style="display: inline-block; width: 20px;"></span>
                        (&nbsp;&nbsp;&nbsp;) E-Mail
                        <span style="display: inline-block; width: 20px;"></span>
                        (&nbsp;&nbsp;&nbsp;) WhatsApp
                        <span style="display: inline-block; width: 20px;"></span>
                        (&nbsp;&nbsp;&nbsp;) Correio
                    </td>
                </tr>
                <tr>
                    <td>
                        Nome:
                        <span style="display: inline-block; width: 597px; border-bottom: 1px solid #333"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Data Nascimento:
                        <span style="display: inline-block; width: 218px; border-bottom: 1px solid #333"></span>
                        Estado Civil:
                        <span style="display: inline-block; width: 245px; border-bottom: 1px solid #333"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Nome Esposa (o):
                        <span style="display: inline-block; width: 535px; border-bottom: 1px solid #333"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Data Nascimento:
                        <span style="display: inline-block; width: 218px; border-bottom: 1px solid #333"></span>
                        Data Casamento:
                        <span style="display: inline-block; width: 219px; border-bottom: 1px solid #333"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Endereço:
                        <span style="display: inline-block; width: 400px; border-bottom: 1px solid #333"></span>
                        Número:
                        <span style="display: inline-block; width: 125px; border-bottom: 1px solid #333"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Bairro:
                        <span style="display: inline-block; width: 359px; border-bottom: 1px solid #333"></span>
                        CEP:
                        <span style="display: inline-block; width: 204px; border-bottom: 1px solid #333"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Cidade:
                        <span style="display: inline-block; width: 380px; border-bottom: 1px solid #333"></span>
                        UF:
                        <span style="display: inline-block; width: 185px; border-bottom: 1px solid #333"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Telefone:
                        <span style="display: inline-block; width: 267px; border-bottom: 1px solid #333"></span>
                        Celular:
                        <span style="display: inline-block; width: 268px; border-bottom: 1px solid #333"></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        E-Mail:
                        <span style="display: inline-block; width: 595px; border-bottom: 1px solid #333"></span>
                    </td>
                </tr>
            </tbody>
        </table>

        @if ($i === 0)
        <span style="display: inline-block; width: 100%; height: 1px; margin: 25px 0; background-color: #eee"></span>
        @endif

        @endfor
</body>

</html>
