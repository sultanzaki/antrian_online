<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TV Bank BJB</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.0.0/css/flag-icons.min.css"/>
  </head>
  <style>
    body, html {
      height: 100%;
      margin: 0;
      font-family: 'Inter', sans-serif;

      /* The image used */
      background-image: url({{ asset('assets/images/bg.jpg') }});
    
      /* Full height */
      height: 100%; 
    
      /* Center and scale the image nicely */
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }
    .custom-table {
        border-collapse: collapse;
        width: 100%;
        color : #fff;
    }
    .custom-table thead th {
        border-top: 3px solid #fff;
        border-bottom: 3px solid #fff;
        color: #fff;
    }
    .custom-table tbody tr:last-child td {
        border-bottom: 3px solid #fff;
    }
    .custom-table td, .custom-table th {
        border-left: none;
        border-right: none;
        padding: 0.3rem; /* Reduced padding */
    }
    .custom-table-2 {
        border-collapse: collapse;
        width: 100%;
        color : #fff;
    }
    .custom-table-2 th, .custom-table-2 td {
        border: 3px solid white;
        padding: 0.3rem;
    }
    .custom-table-2 thead th {
        color: white;
    }
    marquee {
        margin: 0!important;
    }
    footer {
        margin: 0!important;
    }
    </style>
  <body>
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('b9e914fd3d4a0e6d36f2', {
        cluster: 'ap1'
        });

        var channel = pusher.subscribe('antrian-online');
        channel.bind('tv-event', function(data) {
            try {
                if (data.nomorAntrianTerakhirLayanan && data.nomorAntrianTerakhir) {
                    $('#namaLoketTerakhirLayanan_1').text(data.nomorAntrianTerakhirLayanan[1]?.loket?.nama_loket || '-');
                    $('#namaLoketTerakhirLayanan_2').text(data.nomorAntrianTerakhirLayanan[2]?.loket?.nama_loket || '-');
                    $('#nomorAntrianTerakhirLayanan_1').text(data.nomorAntrianTerakhirLayanan[1]?.nomor_antrian?.nomor_antrian || '-');
                    $('#nomorAntrianTerakhirLayanan_2').text(data.nomorAntrianTerakhirLayanan[2]?.nomor_antrian?.nomor_antrian || '-');
                    $('#teller_1').text(data.nomorAntrianTerakhir[1]?.nomor_antrian?.nomor_antrian || '-');
                    $('#teller_2').text(data.nomorAntrianTerakhir[2]?.nomor_antrian?.nomor_antrian || '-');
                    $('#teller_3').text(data.nomorAntrianTerakhir[3]?.nomor_antrian?.nomor_antrian || '-');
                    $('#cs_1').text(data.nomorAntrianTerakhir[4]?.nomor_antrian?.nomor_antrian || '-');
                    $('#cs_2').text(data.nomorAntrianTerakhir[5]?.nomor_antrian?.nomor_antrian || '-');
                } else {
                    console.error('Invalid data received');
                }
            } catch (error) {
                console.error('Error updating elements:', error);
            }
        });
        channel.bind('valas-event', function(data) {
            var tbody = $('#valas1');
            tbody.empty(); // Clear the current rows

            $.each(data.valas1, function(index, valas) {
                var row = $('<tr></tr>');

                var cell1 = $('<td></td>');
                cell1.html(`<span class="fi fi-${valas.kode}"></span> ${valas.nama}`);
                row.append(cell1);

                var cell2 = $('<td></td>');
                cell2.text(valas.harga_jual);
                row.append(cell2);

                var cell3 = $('<td></td>');
                cell3.text(valas.harga_beli);
                row.append(cell3);

                tbody.append(row);
            });

            var tbody_2 = $('#valas2');
            tbody_2.empty(); // Clear the current rows

            $.each(data.valas2, function(index, valas) {
                var row = $('<tr></tr>');

                var cell1 = $('<td></td>');
                cell1.html(`<span class="fi fi-${valas.kode}"></span> ${valas.nama}`);
                row.append(cell1);

                var cell2 = $('<td></td>');
                cell2.text(valas.harga_jual);
                row.append(cell2);

                var cell3 = $('<td></td>');
                cell3.text(valas.harga_beli);
                row.append(cell3);

                tbody_2.append(row);
            });
        });
        channel.bind('counter-rate-event', function(data) {
            var tbody = $('#counter-rate');
            tbody.empty(); // Clear the current rows

            $.each(data.counterRate, function(index, counter) {
                var tenors = ['1_bulan', '3_bulan', '6_bulan', '12_bulan', '24_bulan'];

                $.each(tenors, function(index, tenor) {
                    var row = $('<tr></tr>');

                    var cell1 = $('<td></td>');
                    cell1.text(counter.mata_uang);
                    row.append(cell1);

                    var cell2 = $('<td></td>');
                    cell2.text(index === 0 ? '1 Bulan' : index === 1 ? '3 Bulan' : index === 2 ? '6 Bulan' : index === 3 ? '12 Bulan' : '24 Bulan');
                    row.append(cell2);

                    var cell3 = $('<td></td>');
                    cell3.text(counter['tenor_' + tenor] + '%');
                    row.append(cell3);

                    tbody.append(row);
                });
            });
        });
        channel.bind('video-event', function(data) {
            var videoSource = $('#video-source');
            var videoPlayer = $('video')[0]; // Get the video player

            // Check if the video path is not empty
            if (data.video) {
                // Update the source of the video
                videoSource.attr('src', '/assets/video/' + data.video.judul);

                // Load the new video
                videoPlayer.load();

                // Check if the video can be played
                videoPlayer.oncanplaythrough = function() {
                    // Play the new video
                    videoPlayer.play();
                };

                // Handle video errors
                videoPlayer.onerror = function() {
                    console.error('Error playing the video');
                };
            } else {
                console.error('No video path provided');
            }
        });
    </script>
    <div class="container-fluid">
        <!-- navbar with logo -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="logo" width="142" height="80" class="d-inline-block align-text-top">
                </a>
                <div class="ms-auto">
                    <span class="fw-bold text-white fs-6">BJB KCP Kadipaten</span>
                    <br>
                    <span class="fw-bold text-white fs-6" id="realtime-date"></span>
                    <br>
                    <span class="fw-bold text-white fs-6" id="realtime-time"></span>
                </div>
            </div>
        </nav>
        <hr class="text-white border-4" style="margin-top: 0; margin-bottom: 10px; background-color: #fff!important;">

        <div class="row">
            <div class="col-md-6">
                <!-- video -->
                <div class="row">
                    <video width="100%" height="80%" autoplay loop muted>
                        <source id="video-source" src="{{ asset('assets/video/' . $video->judul) }}">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div class="row" style="margin-left: 1px; margin-right: 1px;">
                    <table class="table-sm text-center custom-table-2 mt-4" style="width: 100%;">
                        <colgroup>
                           <col span="1" style="width: 50%;">
                           <col span="1" style="width: 50%;">
                        </colgroup>
                        <thead>
                            <tr>
                                <th scope="col" id="namaLoketTerakhirLayanan_1">{{ $nomorAntrianTerakhirLayanan[1]->loket->nama_loket ?? '-' }}</th>
                                <th scope="col" id="namaLoketTerakhirLayanan_2">{{ $nomorAntrianTerakhirLayanan[2]->loket->nama_loket ?? '-' }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="nomorAntrianTerakhirLayanan_1">{{ $nomorAntrianTerakhirLayanan[1]->nomor_antrian->nomor_antrian ?? '-' }}</td>
                                <td id="nomorAntrianTerakhirLayanan_2">{{ $nomorAntrianTerakhirLayanan[2]->nomor_antrian->nomor_antrian ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row" style="margin-left: 1px; margin-right: 1px;">
                    <table class="table-sm text-center custom-table-2 mt-4">
                        <thead>
                            <tr>
                                <th scope="col">Teller 1</th>
                                <th scope="col">Teller 2</th>
                                <th scope="col">Teller 3</th>
                                <th scope="col">Customer Service 1</th>
                                <th scope="col">Customer Service 2</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td id="teller_1">{{ $nomorAntrianTerakhir[1]->nomorAntrian->nomor_antrian ?? '-' }}</td>
                            <td id="teller_2">{{ $nomorAntrianTerakhir[2]->nomorAntrian->nomor_antrian ?? '-' }}</td>
                            <td id="teller_3">{{ $nomorAntrianTerakhir[3]->nomorAntrian->nomor_antrian ?? '-' }}</td>
                            <td id="cs_1">{{ $nomorAntrianTerakhir[4]->nomorAntrian->nomor_antrian ?? '-' }}</td>
                            <td id="cs_2">{{ $nomorAntrianTerakhir[5]->nomorAntrian->nomor_antrian ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <p class="text-white fw-bold fs-5 mb-1">Valas</p>
                </div>
                <div class="row">
                    <div class="col-md-6" id="table-container">
                        <table class="table-sm custom-table">
                            <thead>
                                <tr>
                                    <th scope="col">Mata Uang</th>
                                    <th scope="col">Jual</th>
                                    <th scope="col">Beli</th>
                                </tr>
                            </thead>
                            <tbody id="valas1">
                                @foreach ($valas1 as $valas)
                                    <tr>
                                        <td><span class="fi fi-{{ $valas->kode }}"></span> {{ $valas->nama }}</td>
                                        <td>{{ number_format($valas->harga_jual, 2) }}</td>
                                        <td>{{ number_format($valas->harga_beli, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table-sm custom-table">
                            <thead>
                                <tr>
                                    <th scope="col">Mata Uang</th>
                                    <th scope="col">Jual</th>
                                    <th scope="col">Beli</th>
                                </tr>
                            </thead>
                            <tbody id="valas2">
                                @foreach ($valas2 as $valas)
                                    <tr>
                                        <td><span class="fi fi-{{ $valas->kode }}"></span> {{ $valas->nama }}</td>
                                        <td>{{ number_format($valas->harga_jual, 2) }}</td>
                                        <td>{{ number_format($valas->harga_beli, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-3">
                        <p class="text-white fw-bold fs-5 mb-1">Counter Rate</p>
                        <table class="table-sm custom-table">
                            <thead>
                                <tr>
                                    <th scope="col">Mata Uang</th>
                                    <th scope="col">Tenor</th>
                                    <th scope="col">Suku Bunga</th>
                                </tr>
                            </thead>
                            <tbody id="counter-rate">
                                @foreach($counterRate as $counter)
                                    <tr>
                                        <td>{{ $counter->mata_uang }}</td>
                                        <td>1 Bulan</td>
                                        <td>{{ $counter->tenor_1_bulan }}%</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $counter->mata_uang }}</td>
                                        <td>3 Bulan</td>
                                        <td>{{ $counter->tenor_3_bulan }}%</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $counter->mata_uang }}</td>
                                        <td>6 Bulan</td>
                                        <td>{{ $counter->tenor_6_bulan }}%</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $counter->mata_uang }}</td>
                                        <td>12 Bulan</td>
                                        <td>{{ $counter->tenor_12_bulan }}%</td>
                                    </tr>
                                    <tr>
                                        <td>{{ $counter->mata_uang }}</td>
                                        <td>24 Bulan</td>
                                        <td>{{ $counter->tenor_24_bulan }}%</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6 mt-3">
                        <p class="text-white fw-bold fs-5 mb-1">LPS</p>
                        <table class="table-sm custom-table">
                            <thead>
                                <tr>
                                    <th scope="col">Mata Uang</th>
                                    <th scope="col">Jual</th>
                                    <th scope="col">Beli</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>USD</td>
                                    <td>14.000</td>
                                    <td>13.900</td>
                                </tr>
                                <tr>
                                    <td>SGD</td>
                                    <td>10.000</td>
                                    <td>9.900</td>
                                </tr>
                                <tr>
                                    <td>EUR</td>
                                    <td>16.000</td>
                                    <td>15.900</td>
                                </tr>
                                <tr>
                                    <td>JPY</td>
                                    <td>130</td>
                                    <td>120</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> 
        <footer class="fixed-bottom">
            <marquee class="p-2 mb-0 mt-4 fs-4 text-white" style="font-weight: 700;">Selamat Datang di BJB KCP Kadipaten</marquee>
        </footer> 
    </div>
    <script>
        function updateDateTime() {
            var now = new Date();
            var optionsDate = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            var optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit' };
            document.getElementById('realtime-date').textContent = now.toLocaleDateString('id-ID', optionsDate);
            document.getElementById('realtime-time').textContent = now.toLocaleTimeString('id-ID', optionsTime);
        }
        setInterval(updateDateTime, 1000);
        updateDateTime();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>