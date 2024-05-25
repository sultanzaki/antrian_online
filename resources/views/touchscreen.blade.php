<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Touchscreen Bank BJB</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <style>
    body, html {
      height: 100%;
      margin: 0;
      font-family: 'Inter', sans-serif;

      /* The image used */
      background-image: url("{{ asset('assets/images/bg.jpg') }}");
    
      /* Full height */
      height: 100%; 
    
      /* Center and scale the image nicely */
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }
    </style>
  <body>
    <div class="container my-auto">
        <!-- image logo in center -->
        <div class="row">
            <div class="col-md-12 text-center">
                <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid mt-4" alt="logo" width="200" height="200">
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <p class="text-white mt-4 fw-bold fs-5">Selamat Datang di Bank BJB KCP Kadipaten</p>
            </div>
        </div>

        <div class="row mt-3">
            <form action="{{ url('create-new-antrian/1') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-lg mb-4 rounded-pill fw-bold text-white position-relative" style="width: 100%; height: 150px; background-color: #0C162C; font-size: 70px;">
                    <div class="circle position-absolute top-3 start-5 text-center" style="width: 110px; height: 110px; background-color: white; border-radius: 50%; color: #0C162C; line-height: 100px;">A</div>
                    Teller
                </button>
            </form>
            <form action="{{ url('create-new-antrian/2') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-lg rounded-pill fw-bold text-white position-relative" style="width: 100%; height: 150px; background-color: #0C162C; font-size: 70px;">
                    <div class="circle position-absolute top-3 start-5 text-center" style="width: 110px; height: 110px; background-color: white; border-radius: 50%; color: #0C162C; line-height: 105px;">B</div>
                    Customer Service
                </button>
            </form>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>