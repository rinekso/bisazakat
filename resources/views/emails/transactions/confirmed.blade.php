@component('mail::message')
#Halo, {{ $nama }}
Terima kasih telah berkontribusi di program {{ $program }} <br>
Transaksi dengan data berikut: <br>
Id transaksi: {{ $transaction->transaction_uuid }}
@component('mail::table')
|               |                                                        |
| ------------- |:--------------------------:|
| Nama Donatur  | {{ $nama }}                |
| Jumlah        | {{ $transaction->rupiah }} |
| Program       | {{ $program }}             |
@endcomponent
Telah kami proses,
Terima kasih
@endcomponent