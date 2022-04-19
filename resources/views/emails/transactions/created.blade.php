@component('mail::message')
#Halo, {{ $nama }}
Terima kasih telah berkontribusi di program {{ $program }} <br>
Segera transfer {{ $nominal }} <br>
Ke rekening {{ $rekening }} <br>
Sebelum {{ $expired }}
@endcomponent