<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 12pt;
            line-height: 1.5;
        }

        .page {
            page-break-after: always;
        }

        .page:last-child {
            page-break-after: auto;
        }

        .no-break {
            page-break-inside: avoid;
        }

        .header-img {
            width: 100%;
            max-height: 120px;
            object-fit: contain;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <!-- ========================== PAGE 1 ========================== -->
    <div class="page">
        <!-- Header Image -->
        <img src="file://{{ public_path('images/header.png') }}" class="header-img">

        <!-- En-tête du contrat -->
        <div style="text-align: center; margin-bottom: 30px;">
            <h2 style="text-decoration: underline; margin-bottom: 20px;">
                CONTRAT DE PRÊT À CARACTÈRE SOCIAL
            </h2>

            <p style="font-style: italic;">
                Référence : {{ $contrat->reference }}
            </p>

            <p style="font-style: italic;">
                {{ $contrat->employee->company->name ?? '' }}
            </p>
        </div>

        <!-- Parties contractantes -->
        <div style="margin-bottom: 30px;">
            <p><strong>ENTRE :</strong></p>
            <p style="text-align: justify; text-indent: 20px;">
                <strong>Le Comité de gestion des œuvres social de la Société SOPTE Constantine (S.O.P.T.E)</strong>,
                représenté par Monsieur <strong>Nacer Ben Dibe</strong>, en sa qualité de Président du Comité de
                Participation,
                dûment habilité à cet effet,
            </p>
            <p style="text-align: right;"><strong>D'UNE PART,</strong></p>

            <p style="margin-top: 15px;"><strong>ET :</strong></p>
            <p style="text-align: justify; text-indent: 20px;">
                <strong>M./Mme/Mlle : {{ $contrat->employee->name }} {{ $contrat->employee->lastname }}</strong>,
            </p>
            <p style="text-align: justify; text-indent: 20px;">
                Né(e) le : {{ \Carbon\Carbon::parse($contrat->employee->datenais)->format('d/m/Y') ?? '' }}
                à {{ $contrat->employee->lieux ?? '' }},
            </p>
            @if($contrat->employee->nin)
                <p style="text-align: justify; text-indent: 20px;">NIN : {{ $contrat->employee->nin }}</p>
            @endif
            <p style="text-align: justify; text-indent: 20px;">
                Fonction : {{ $contrat->employee->post ?? '' }} au sein de la société,
            </p>
            <p style="text-align: right;"><strong>D'AUTRE PART,</strong></p>
        </div>

        <!-- Préambule -->
        <div style="margin-bottom: 20px;">
            <p style="text-align: justify;"><strong>IL A ÉTÉ ARRÊTÉ ET CONVENU CE QUI SUIT :</strong></p>
        </div>

        <!-- Article 1 -->
        <div style="margin-bottom: 20px;">
            <h3 style="text-decoration: underline;">Article 1 : Objet du contrat</h3>
            <p style="text-align: justify; text-indent: 20px;">
                Le présent contrat a pour objet de définir les modalités d'octroi et de remboursement
                d'un prêt social accordé à M./Mme/Mlle : {{ $contrat->employee->name }}
                {{ $contrat->employee->lastname }}.
            </p>
        </div>

        <!-- Article 2 -->
        <div style="margin-bottom: 20px;">
            <h3 style="text-decoration: underline;">Article 2 : Montant du prêt</h3>
            <p style="text-align: justify; text-indent: 20px;">
                Un prêt d'un montant de
                <strong>{{ number_format($contrat->amount, 2, ',', ' ') }}</strong>
                DA (en lettres : <strong>{{ $contrat->amount_text }}</strong>) est accordé au bénéficiaire.
            </p>
            <p style="text-align: justify; text-indent: 20px;">
                Le prêt est versé au compte de l'agent bénéficiaire par virement bancaire ou remise de chèque.
            </p>
        </div>

        <!-- Article 3 -->
        <div style="margin-bottom: 20px;">
            <h3 style="text-decoration: underline;">Article 3 : Modalités de remboursement</h3>
            <p style="text-align: justify; text-indent: 20px;">
                3.1 - Le remboursement s'effectuera systématiquement et mensuellement par retenue
                sur le salaire d'un montant de
                <strong>{{ number_format($contrat->amount_retenu, 2, ',', ' ') }}</strong> DA/mois.
            </p>
            <p style="text-align: justify; text-indent: 20px;">
                3.2 - Le remboursement commencera à partir du mois de
                <strong>{{ \Carbon\Carbon::parse($contrat->start_date)->translatedFormat('F') }}</strong>
                de l'année <strong>{{ \Carbon\Carbon::parse($contrat->start_date)->format('Y') }}</strong>.
            </p>
            <p style="text-align: justify; text-indent: 20px;">
                3.3 - En cas de mise en disponibilité ou de congé maladie de longue durée, le remboursement devra
                s'effectuer régulièrement.
            </p>
            <p style="text-align: justify; text-indent: 20px;">
                3.4 - En cas de cessation de fonctions, le bénéficiaire s'engage à rembourser le solde restant dû dans
                un délai d'un (01) mois.
            </p>
        </div>

        <!-- Article 4 -->
        <div style="margin-bottom: 20px;">
            <h3 style="text-decoration: underline;">Article 4 : Litiges</h3>
            <p style="text-align: justify; text-indent: 20px;">
                Tout litige survenant dans le cadre de ce contrat sera d'abord réglé à l'amiable entre les deux parties.
                À défaut d'accord, seul le Tribunal de Constantine sera compétent.
            </p>
        </div>

        <!-- Article 5 -->
        <div style="margin-bottom: 30px;">
            <h3 style="text-decoration: underline;">Article 5 : Acceptation</h3>
            <p style="text-align: justify; text-indent: 20px;">
                Les signataires reconnaissent avoir pris connaissance des termes et les avoir acceptés sans réserve.
            </p>
            <p style="text-align: justify; text-indent: 20px;">
                Fait en deux exemplaires originaux, un pour chaque partie.
            </p>
        </div>

        <!-- Signatures -->
        <table style="width: 100%; margin-top: 50px;" class="no-break">
            <tr>
                <td style="width: 50%; text-align: center;">
                    <p>Fait à : {{ $contrat->employee->company->city ?? 'Constantine' }}</p>
                    <p>Le : {{ now()->format('d/m/Y') }}</p>
                    <div style="margin-top: 50px;">
                        <p><strong>Le bénéficiaire</strong></p>
                        <p>(Lu et approuvé)</p>
                        <div style="border-top: 1px solid black; width: 250px; margin: 20px auto;"></div>
                        <p>Signature précédée de la mention "Lu et approuvé"</p>
                    </div>
                </td>
                <td style="width: 50%; text-align: center;">
                    <div style="margin-top: 50px;">
                        <p><strong>Le Président du Comité de Participation</strong></p>
                        <p>(Lu et approuvé)</p>
                        <div style="border-top: 1px solid black; width: 250px; margin: 20px auto;"></div>
                        <p>Signature</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- ========================== PAGE 2 ========================== -->
    <div class="page">
        <!-- Header Image -->
        <img src="file://{{ public_path('images/header.png') }}" class="header-img">

        <h2 style="text-align: center; text-decoration: underline; margin-bottom: 30px;">
            AUTORISATION DE RETENUE SUR SALAIRE AU TITRE DU PRÊT SOCIAL
        </h2>

        <p>Je soussigné(e) :</p>

        <table style="width: 100%; margin-bottom: 20px;">
            <tr>
                <td style="width: 30%;">Nom et Prénom :</td>
                <td style="border-bottom: 1px solid black;">
                    <strong>{{ $contrat->employee->name }} {{ $contrat->employee->lastname }}</strong>
                </td>
            </tr>
            <tr>
                <td>Matricule :</td>
                <td style="border-bottom: 1px solid black;">{{ $contrat->employee->matricule }}</td>
            </tr>
            <tr>
                <td>Fonction :</td>
                <td style="border-bottom: 1px solid black;">{{ $contrat->employee->post ?? '' }}</td>
            </tr>
        </table>

        <p style="text-align: justify;">
            Autorise par la présente l'Administration de la Société SOPTE Constantine,
            à procéder à une retenue mensuelle sur mon salaire.
        </p>
        <table style="width: 100%; margin-top: 20px;">
            <tr>
                <td>Montant mensuel :</td>
                <td style="border-bottom: 1px solid black;">{{ $contrat->amount_retenu }} DA</td>
            </tr>
            <tr>
                <td>Durée :</td>
                <td style="border-bottom: 1px solid black;">{{ $contrat->duration }} mois</td>
            </tr>
            <tr>
                <td>Début :</td>
                <td style="border-bottom: 1px solid black;">
                    {{ \Carbon\Carbon::parse($contrat->start_date)->format('m/Y') }}
                </td>
            </tr>
        </table>
        <table style="width: 100%; margin-top: 50px;" class="no-break">
            <tr>
                <td style="width: 50%; text-align: center;">
                    <p>Fait à : Constantine</p>
                    <p>Le : {{ now()->format('d/m/Y') }}</p>
                    <div style="margin-top: 50px;">
                        <p><strong>Le bénéficiaire</strong></p>
                        <p><strong>{{ $contrat->employee->name }} {{ $contrat->employee->last_name }}</strong></p>
                        <p>(Lu et approuvé)</p>
                        <div style="border-top: 1px solid black; width: 250px; margin: 20px auto;"></div>
                        <p>Signature précédée de la mention "Lu et approuvé"</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>