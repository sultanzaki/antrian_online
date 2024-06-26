<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesin Antrian Online</title>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/iconly.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.0.0/css/flag-icons.min.css"/>
</head>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('b9e914fd3d4a0e6d36f2', {
      cluster: 'ap1'
    });

    var loketId = {{ Auth::user()->loket_id }};

    var channel = pusher.subscribe('antrian-online');
    channel.bind('nomor-antrian-event', function(data) {
        if (data.layananId == loketId) {
            $('#sisa_antrian').text('Sisa Antrian: ' + data.nomorAntrian);
        }
    });
  </script>

<body>
    <script src="{{ asset('assets/js/initTheme.js') }}"></script>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
    <div class="sidebar-header position-relative">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
                <a href="index.html"><p class="fs-4">Sistem Antrian</p></a>
            </div>
            <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                    role="img" class="iconify iconify--system-uicons" width="20" height="20"
                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                    <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path
                            d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                            opacity=".3"></path>
                        <g transform="translate(-210 -1)">
                            <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                            <circle cx="220.5" cy="11.5" r="4"></circle>
                            <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path>
                        </g>
                    </g>
                </svg>
                <div class="form-check form-switch fs-6">
                    <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                    <label class="form-check-label"></label>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true"
                    role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet"
                    viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                    </path>
                </svg>
            </div>
            <div class="sidebar-toggler  x">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">Menu</li>

            <li
                class="sidebar-item active ">
                <a href="/edit" class='sidebar-link'>
                    <i class="bi bi-pencil-square"></i>
                    <span>Edit</span>
                </a>
                

            </li> 
            
            <li
                class="sidebar-item">
                <a href="/tombol" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Tombol</span>
                </a>
                

            </li>   
            <li
                class="sidebar-item ">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="sidebar-link" style="border: none; background: none; cursor: pointer;">
                        <i class="bi bi-box-arrow-left"></i>
                        <span>Logout</span>
                    </button>
                </form>
                

            </li>      
        </ul>
    </div>
</div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
@if (session('message'))
    <div class="alert alert-success" id="dismiss-alert">
        {{ session('message') }}
    </div>
@endif
            
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit</h3>
                <p class="text-subtitle text-muted">Edit Video, Valas, Counter rate, dan LPS</p>
            </div>
        </div>
    </div>

    <!-- Basic Horizontal form layout section start -->
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Valas</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Table with no outer spacing -->
                            <form class="form form-horizontal" action="{{ route('store-valas') }}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="first-name-horizontal">Kode</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="first-name-horizontal" class="form-control" name="kode"
                                                placeholder="Kode (2 Digit)">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email-horizontal">Nama</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="email-horizontal" class="form-control" name="nama"
                                                placeholder="Nama (3 Digit)">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="contact-info-horizontal">Beli</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="contact-info-horizontal" class="form-control" name="beli"
                                                placeholder="Harga Beli">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="password-horizontal">Jual</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="password-horizontal" class="form-control" name="jual"
                                                placeholder="Harga Jual">
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive mt-0">
                            <table class="table mb-4 table-lg">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Jual</th>
                                        <th>Beli</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($valas as $v)
                                    <tr>
                                        <td><span class="fi fi-{{ $v->kode }}"></span></td>
                                        <td>{{ $v->nama }}</td>
                                        <td>{{ $v->harga_jual }}</td>
                                        <td>{{ $v->harga_beli }}</td>
                                        <td>{{ $v->status == 1 ? 'Ditampilkan' : 'Tidak Ditampilkan' }}</td>
                                        <td>
                                            <button class="btn btn-primary">Edit</button>
                                            <button class="btn btn-danger">Hapus</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Counter Rate</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Table with no outer spacing -->
                            <form class="form form-horizontal" action="{{ route('store-counter-rate') }}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="first-name-horizontal">Kode</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="first-name-horizontal" class="form-control" name="kode"
                                                placeholder="Kode (2 Digit)">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="first-name-horizontal">Mata Uang</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="first-name-horizontal" class="form-control" name="mata_uang"
                                                placeholder="Mata Uang (3 Digit)">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email-horizontal">Suku bunga 1 bulan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="email-horizontal" class="form-control" name="tenor_1_bulan"
                                                placeholder="Tenor (Bulan)">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="contact-info-horizontal">Suku bunga 3 bulan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="contact-info-horizontal" class="form-control" name="tenor_3_bulan"
                                                placeholder="Tenor (Bulan)">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="password-horizontal">Suku bunga 6 bulan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="password-horizontal" class="form-control" name="tenor_6_bulan"
                                                placeholder="Tenor (Bulan)">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="password-horizontal">Suku bunga 12 bulan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="password-horizontal" class="form-control" name="tenor_12_bulan"
                                                placeholder="Tenor (Bulan)">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="password-horizontal">Suku bunga 24 bulan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="password-horizontal" class="form-control" name="tenor_24_bulan"
                                                placeholder="Tenor (Bulan)">
                                        </div>
                                        
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive mt-0">
                            <table class="table mb-4 table-lg">
                                <thead>
                                    <tr>
                                        <th>Mata Uang</th>
                                        <th>Tenor</th>
                                        <th>Suku Bunga</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($counterRate as $counter)
                                    <tr>
                                        <td>{{ $counter->mata_uang }}</td>
                                        <td>1 Bulan</td>
                                        <td>{{ $counter->tenor_1_bulan }}%</td>
                                        <td>
                                            <button class="btn btn-primary">Edit</button>
                                            <button class="btn btn-danger">Hapus</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ $counter->mata_uang }}</td>
                                        <td>3 Bulan</td>
                                        <td>{{ $counter->tenor_3_bulan }}%</td>
                                        <td>
                                            <button class="btn btn-primary">Edit</button>
                                            <button class="btn btn-danger">Hapus</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ $counter->mata_uang }}</td>
                                        <td>6 Bulan</td>
                                        <td>{{ $counter->tenor_6_bulan }}%</td>
                                        <td>
                                            <button class="btn btn-primary">Edit</button>
                                            <button class="btn btn-danger">Hapus</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ $counter->mata_uang }}</td>
                                        <td>12 Bulan</td>
                                        <td>{{ $counter->tenor_12_bulan }}%</td>
                                        <td>
                                            <button class="btn btn-primary">Edit</button>
                                            <button class="btn btn-danger">Hapus</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ $counter->mata_uang }}</td>
                                        <td>24 Bulan</td>
                                        <td>{{ $counter->tenor_24_bulan }}%</td>
                                        <td>
                                            <button class="btn btn-primary">Edit</button>
                                            <button class="btn btn-danger">Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic Horizontal form layout section end -->

        <!-- Basic Horizontal form layout section start -->
        <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Video
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Table with no outer spacing -->
                            <form class="form form-horizontal" action="{{ route('store-video') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="email-horizontal">Video</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="file" name="video_file" accept="video/*">
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Counter Rate</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Table with no outer spacing -->
                            <form class="form form-horizontal" action="{{ route('store-counter-rate') }}" method="POST">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="first-name-horizontal">Kode</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="first-name-horizontal" class="form-control" name="kode"
                                                placeholder="Kode (2 Digit)">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="first-name-horizontal">Mata Uang</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="first-name-horizontal" class="form-control" name="mata_uang"
                                                placeholder="Mata Uang (3 Digit)">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email-horizontal">Suku bunga 1 bulan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="email-horizontal" class="form-control" name="tenor_1_bulan"
                                                placeholder="Tenor (Bulan)">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="contact-info-horizontal">Suku bunga 3 bulan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="contact-info-horizontal" class="form-control" name="tenor_3_bulan"
                                                placeholder="Tenor (Bulan)">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="password-horizontal">Suku bunga 6 bulan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="password-horizontal" class="form-control" name="tenor_6_bulan"
                                                placeholder="Tenor (Bulan)">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="password-horizontal">Suku bunga 12 bulan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="password-horizontal" class="form-control" name="tenor_12_bulan"
                                                placeholder="Tenor (Bulan)">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="password-horizontal">Suku bunga 24 bulan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="password-horizontal" class="form-control" name="tenor_24_bulan"
                                                placeholder="Tenor (Bulan)">
                                        </div>
                                        
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset"
                                                class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive mt-0">
                            <table class="table mb-4 table-lg">
                                <thead>
                                    <tr>
                                        <th>Mata Uang</th>
                                        <th>Tenor</th>
                                        <th>Suku Bunga</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($counterRate as $counter)
                                    <tr>
                                        <td>{{ $counter->mata_uang }}</td>
                                        <td>1 Bulan</td>
                                        <td>{{ $counter->tenor_1_bulan }}%</td>
                                        <td>
                                            <button class="btn btn-primary">Edit</button>
                                            <button class="btn btn-danger">Hapus</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ $counter->mata_uang }}</td>
                                        <td>3 Bulan</td>
                                        <td>{{ $counter->tenor_3_bulan }}%</td>
                                        <td>
                                            <button class="btn btn-primary">Edit</button>
                                            <button class="btn btn-danger">Hapus</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ $counter->mata_uang }}</td>
                                        <td>6 Bulan</td>
                                        <td>{{ $counter->tenor_6_bulan }}%</td>
                                        <td>
                                            <button class="btn btn-primary">Edit</button>
                                            <button class="btn btn-danger">Hapus</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ $counter->mata_uang }}</td>
                                        <td>12 Bulan</td>
                                        <td>{{ $counter->tenor_12_bulan }}%</td>
                                        <td>
                                            <button class="btn btn-primary">Edit</button>
                                            <button class="btn btn-danger">Hapus</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>{{ $counter->mata_uang }}</td>
                                        <td>24 Bulan</td>
                                        <td>{{ $counter->tenor_24_bulan }}%</td>
                                        <td>
                                            <button class="btn btn-primary">Edit</button>
                                            <button class="btn btn-danger">Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



</div>

        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#nextForm, #repeatForm, #doneForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
            
                        $('#dismiss-alert').remove();
                        $('.page-heading').prepend('<div class="alert alert-success" id="dismiss-alert">' + response.message + '</div>');
        
                        $('#nomor_antrian').text('Nomor Antrian: ' + response.nomor_antrian.nomor_antrian);
                        $('#sisa_antrian').text('Sisa Antrian: ' + response.sisa_antrian);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // show alert bootstrap with message
                        $('#dismiss-alert').remove();
                        $('.page-heading').prepend('<div class="alert alert-danger" id="dismiss-alert">' + jqXHR.responseJSON.message + '</div>');
                    }
                });
            });
        });
    </script>
    <script src="{{ asset('assets/js/dark.js') }}"></script>
    <script src="{{ asset('assets/js/perfect-scrollbar.min.js') }}"></script>
    
    
    <script src="{{ asset('assets/js/app.js') }}"></script>
    
</body>

</html>