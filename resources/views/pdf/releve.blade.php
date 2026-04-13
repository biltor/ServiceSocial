<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 11pt;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background: #f2f2f2;
        }

        .text-right {
            text-align: left;
        }
        td, th { white-space: nowrap; }
    .header-img {
            width: 100%;
            max-height: 120px;
            object-fit: contain;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
<h2 style="text-align: center;">RELEVÉ BANCAIRE</h2>

<p>Période : du {{ $from }} au {{ $to }}</p>

<p><strong>Solde initial :</strong>
    {{ number_format($soldeInitial, 2, ',', ' ') }} DA
</p>

<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Référence</th>
            <th>Description</th>
            <th>Débit</th>
            <th>Crédit</th>
            <th>Solde</th>
        </tr>
    </thead>

    <tbody>
        <tr>
    <td colspan="5"><strong>Solde initial</strong></td>
    <td>{{ number_format($soldeInitial, 2, ',', ' ') }}</td>
    </tr>
        @foreach($mouvements as $m)
            <tr>
                <td>{{ \Carbon\Carbon::parse($m->date)->format('d/m/Y') }}</td>

                <td>{{ $m->reference }}</td>

                <td style="text-align: left;">
                    {{ $m->description }}
                </td>

                <td class="text-right">
                    {{ $m->type === 'debit' ? number_format($m->amount, 2, ',', ' ') : ''  }}
                </td>

                <td class="text-right">
                    {{ $m->type === 'credit' ? number_format($m->amount, 2, ',', ' '): '' }}
                </td>

                <td class="text-right">
                    {{ number_format($m->balance, 2, ',', ' ') }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>