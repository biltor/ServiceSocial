<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <style>
        body {
            font-family: "DejaVu Sans", "Arial";
            direction: rtl;
            text-align: right;
            font-size: 14pt;
            line-height: 1.8;
        }

        .page {
            page-break-after: always;
        }

        .page:last-child {
            page-break-after: auto;
        }

        .ltr-number {
            direction: ltr;
            unicode-bidi: embed;
            display: inline-block;
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

    <!-- ================= PAGE 1 ================= -->
    <div class="page">
        <img src="file://{{ public_path('images/header.png') }}" class="header-img">

        <!-- Header -->
        <div style="text-align:center; margin-bottom:30px;">
            <h2 style="text-decoration: underline;">عقد قرض ذو طابع اجتماعي</h2>

            <p>المرجع: {{ $contrat->reference }}</p>

            <p>{{ $contrat->employee->unite_id->name ?? '' }}</p>
        </div>

        <!-- Parties -->
        <div style="margin-bottom:30px;">
            <p><strong>بين:</strong></p>

            <p>
                <strong>
                    لجنة التسيير للأعمال الاجتماعية لشركة سوبت قسنطينة (S.O.P.T.E)
                </strong>،
                الممثلة بالسيد <strong>ناصر بن ذيب</strong>،
                بصفته رئيس لجنة المشاركة، مفوض لهذا الغرض،
            </p>

            <p style="text-align:left;"><strong>من جهة،</strong></p>

            <p><strong>و:</strong></p>

            <p>
                <strong>
                    السيد/السيدة/الآنسة:
                    {{ $contrat->employee->name_ar }} {{ $contrat->employee->last_name_ar }}
                </strong>
            </p>

            <p>
                المولود(ة) في:
                {{ $contrat->employee->datenais ?? '' }}
                بـ {{ $contrat->employee->lieux ?? '' }}
            </p>

            @if($contrat->employee->matricule)
                <p>الرقم التسلسلي: {{ $contrat->employee->matricule }}</p>
                <p>الرقم الوطني: {{ $contrat->employee->nin }}</p>
            @endif

            <p>
                الوظيفة:
                {{ $contrat->employee->post ?? '' }}
                بالشركة
            </p>

            <p style="text-align:left;"><strong>من جهة أخرى،</strong></p>
        </div>

        <!-- Préambule -->
        <p><strong>تم الاتفاق على ما يلي:</strong></p>

        <!-- Article 1 -->
        <h3 style="text-decoration: underline;">المادة 1: موضوع العقد</h3>
        <p>
            يهدف هذا العقد إلى تحديد شروط منح وسداد قرض اجتماعي
            للمستفيد {{ $contrat->employee->name }} {{ $contrat->employee->last_name }}.
        </p>

        <!-- Article 2 -->
        <h3 style="text-decoration: underline;">المادة 2: مبلغ القرض</h3>
        <p>
            تم منح قرض بمبلغ
            <strong>
                <span class="ltr-number ">
                    {{ number_format($contrat->amount, 2, ',', ' ') }}
                </span>
            </strong>
            دج
            (بالحروف:
            <strong>
                <span>
                    {{ $contrat->amount_text_ar }}
                </span>
            </strong>)
        </p>

        <p>
            يتم تحويل القرض إلى حساب المستفيد عن طريق التحويل البنكي أو شيك.
        </p>

        <!-- Article 3 -->
        <h3 style="text-decoration: underline;">المادة 3: شروط السداد</h3>

        <p>
            يتم السداد شهريا بمبلغ:
            <strong>
                <span class="ltr-number">
                    {{ number_format($contrat->amount_retenu, 2, ',', ' ') }}
                </span>
            </strong>
            دج
        </p>

        <p>
            يبدأ السداد ابتداء من:
            <strong>
                {{ \Carbon\Carbon::parse($contrat->start_date)->format('m/Y') }}
            </strong>
        </p>
        <p>
            في حالة التوقف عن العمل، يجب تسديد كامل المبلغ المتبقي.
        </p>

        <!-- Article 4 -->
        <h3 style="text-decoration: underline;">المادة 4: المنازعات</h3>
        <p>
            في حالة النزاع، يتم اللجوء إلى المحكمة .
        </p>

        <!-- Article 5 -->
        <h3 style="text-decoration: underline;">المادة 5: القبول</h3>
        <p>
            يقر الطرفان بقبول جميع بنود هذا العقد.
        </p>

        <!-- Signature -->
        <table style="width:100%; margin-top:50px;">
            <tr>
                <td style="text-align:center;">
                    <p>حرر بـ: {{ $contrat->employee->company->city ?? 'Constantine' }}</p>
                    <p>بتاريخ: {{ now()->format('d/m/Y') }}</p>

                    <p>توقيع المستفيد</p>
                </td>

                <td style="text-align:center;">
                    <p>رئيس اللجنة</p>
                </td>
            </tr>
        </table>

    </div>

    <!-- ================= PAGE 2 ================= -->
    <div class="page">
        <img src="file://{{ public_path('images/header.png') }}" class="header-img">

        <h2 style="text-align:center; text-decoration:underline;">
            تفويض الخصم من الراتب
        </h2>

        <p>أنا الموقع أدناه:</p>

        <table style="width:100%;">
            <tr>
                <td>الاسم:</td>
                <td><strong>{{ $contrat->employee->name_ar }} {{ $contrat->employee->last_name_ar }}</strong></td>
            </tr>

            <tr>
                <td>  الرقم التسلسلي:</td>
                <td><strong>{{ $contrat->employee->matricule }}</strong></td>
            </tr>
        </table>
        <p style="text-align: justify; margin-bottom: 15px;">
            أفوض عن طريق هذه الوثيقة إدارة شركة سوبت قسنطينة، بالقيام بخصم شهري من راتبي، بخصوص سداد
            قرض اجتماعي تم منحي إياه من طرف لجنة تسيير الأعمال الاجتماعية.
        </p>

        <p style="margin-bottom: 10px;">
            <strong>شروط هذا الخصم كما يلي:</strong>
        </p>
        <table style="width: 100%; margin-bottom: 20px;">
            <tr>
                <td style="width: 50%;">المبلغ الشهري المقتطع:</td>
                <td style="border-bottom: 1px solid black;">
                    <strong>
                        <span class="ltr-number">
                            {{ number_format($contrat->amount_retenu, 2, ',', ' ') }}
                        </span>
                    </strong>
                    دج
                </td>
            </tr>
            <tr>
                <td>مدة السداد:</td>
                <td style="border-bottom: 1px solid black;">
                    <span class="ltr">{{ $contrat->duration }}</span>
                    شهر
                </td>
            </tr>
            <tr>
                <td>بداية الخصم:</td>
                <td style="border-bottom: 1px solid black;">
                    <span class="ltr">{{ \Carbon\Carbon::parse($contrat->start_date)->format('m/Y') }}</span>
                </td>
            </tr>

        </table>
        <p style="text-align: justify; margin-bottom: 15px;">
            أتعهد بإبلاغ الإدارة في حالة أي تغير في الوضعية ما قد يؤثر على هذا التفويض (إحالة على
            الاستيداع، إجازة مرضية مطولة، استقالة، إلخ).
        </p>

        <p style="text-align: justify; margin-bottom: 30px;">
            أقر بأنني اطلعت على شروط السداد وأقبل دون تحفظ تنفيذ هذا الخصم من الراتب.
        </p>

        <table style="width: 100%; margin-top: 50px;">
            <tr>
                <td style="width: 50%; text-align: center;">

                    <div style="margin-top: 50px;">
                        <p>توقيع الموظف</p>
                        <p>(قراءة وإقرار)</p>
                        <div style="border-top: 1px solid black; width: 250px; margin: 0 auto;"></div>
                    </div>
                </td>
            </tr>
        </table>


    </div>

</body>

</html>