<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
        }

        .header {
            width: 100%;
            margin-bottom: 20px;
        }

        .title {
            text-align: center;
            font-weight: bold;
            font-size: 18px;
            margin: 20px 0;
        }

        .section {
            margin-bottom: 10px;
        }

        .line {
            border-bottom: 1px solid #000;
            display: inline-block;
            min-width: 300px;
        }

        .checkbox-group {
            margin-left: 20px;
        }

        .signature {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }

        .signature div {
            width: 22%;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="header">
    <strong>Unité :</strong> {{ $data->unite ?? '....................' }}
    <span style="float:right;">Le {{ date('d/m/Y') }}</span>
</div>

<div class="title">DEMANDE DE PAIEMENT</div>

<div class="section">
    <strong>Service demandeur :</strong>
    <span class="line">{{ $data->service ?? '' }}</span>
</div>

<div class="section">
    <strong>Bénéficiaire :</strong>
    <span class="line">{{ $data->beneficiaire ?? '' }}</span>
</div>

<div class="section">
    <strong>Mode de paiement :</strong>

    <div class="checkbox-group">
        ☐ Par caisse<br>
        ☐ Par chèque d’entreprise<br>
        ☐ Par chèque de banque<br>
        ☐ Par virement :
        Compte N° {{ $data->compte ?? '' }}<br>
        Banque {{ $data->banque ?? '' }}<br>
        Agence {{ $data->agence ?? '' }}
    </div>
</div>

<div class="section">
    <strong>Montant en chiffre :</strong><br>
    {{ $data->montant_chiffre ?? '' }}
</div>

<div class="section">
    <strong>Montant en lettres :</strong><br>
    {{ $data->montant_lettre ?? '' }}
</div>

<div class="section">
    <strong>Motif de la dépense :</strong><br>
    {{ $data->motif ?? '' }}
</div>

<div class="signature">
    <div>Service demandeur</div>
    <div>Trésorier</div>
    <div>Chef département</div>
    <div>PDG</div>
</div>

</body>
</html>