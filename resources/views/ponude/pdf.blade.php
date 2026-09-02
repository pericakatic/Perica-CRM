<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Ponuda - {{ $ponuda->broj_ponude }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 14px; color: #333; }
        .header { margin-bottom: 30px; border-bottom: 2px solid #eee; padding-bottom: 20px; }
        .flex { width: 100%; }
        .col-6 { width: 50%; float: left; }
        .clear { clear: both; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table th { background-color: #f4f4f4; }
        .text-right { text-align: right; }
        .total { font-size: 16px; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>

<div class="header">
    <h2>PONUDA: {{ $ponuda->broj_ponude }}</h2>
    <p>Datum: {{ $ponuda->created_at?->format('d.m.Y.') }}</p>
</div>

<div class="flex">
    <div class="col-6">
        <strong>Izdavatelj:</strong><br>
        Perica CRM d.o.o.<br>
        Sivša 184 Usora<br>
        OIB: 12345678901
    </div>
    <div class="col-6">
        <strong>Naručitelj:</strong><br>
        {{ $ponuda->deal?->tvrtka?->naziv ?? 'Nije navedeno' }}<br>
        {{ $ponuda->deal?->kontakt?->ime }} {{ $ponuda->deal?->kontakt?->prezime }}<br>
        {{ $ponuda->deal?->tvrtka?->email ?? $ponuda->deal?->kontakt?->email }}
    </div>
    <div class="clear"></div>
</div>

<table class="table">
    <thead>
    <tr>
        <th>Opis / Predmet</th>
        <th class="text-right">Iznos</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ $ponuda->deal?->naziv ?? 'Usluga po ponudi' }}</td>
        <td class="text-right">{{ number_format($ponuda->ukupni_iznos, 2, ',', '.') }} EUR</td>
    </tr>
    </tbody>
</table>

<div class="text-right total">
    Ukupno za platiti: {{ number_format($ponuda->ukupni_iznos, 2, ',', '.') }} EUR
</div>

@if($ponuda->napomena)
    <div style="margin-top: 40px;">
        <strong>Napomena:</strong>
        <p>{{ $ponuda->napomena }}</p>
    </div>
@endif

</body>
</html>
