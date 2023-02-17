<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Alterga Komputer</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('eventalk-master/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('eventalk-master/css/animate.css') }}">
    
    <link rel="stylesheet" href="{{ asset('eventalk-master/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('eventalk-master/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('eventalk-master/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('eventalk-master/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('eventalk-master/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('eventalk-master/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('eventalk-master/css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <link rel="stylesheet" href="{{ asset('eventalk-master/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('eventalk-master/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('eventalk-master/css/style.css') }}">

     {{-- sweetalert --}}
     <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">

  </head>
  <style>
    @media print {
      body * {
        visibility: hidden;
      }
      #printArea, #printArea * {
        visibility: visible;
        color: black !important;
      }

      

      #printArea table tr td{
        padding: 0 !important;
      }
      #printArea {
        position: absolute;
        left: 0;
        top: 0;
      }
    }
  </style>
  <body>


    @if($id_customer !== null && $servisan)
    <div id="verifikasi_customer" class="d-flex align-items-center justify-content-center">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            <label for="whatsapp">Harap masukkan no whatsapp anda</label>
            <input type="number" class="form-control" id="whatsapp">
          </div>
          <div class="form-group">
            <button class="btn btn-primary form-control" id="btnVerifikasi">Verifikasi</button>
            <p id="feedbackMessage"></p>
          </div>
        </div>
      </div>
    </div>
    @endif
    
    @if (session('message'))
    {{ sweetAlert(session('message'), 'success') }}
    @endif
    @if (session('error'))
    {{ sweetAlert(session('error'), 'warning') }}
    @endif

	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="#">Alterga<span>Komputer.</span></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="#" class="nav-link">Home</a></li>
	          <li class="nav-item"><a href="#" class="nav-link">About</a></li>
	          <li class="nav-item"><a href="#" class="nav-link">Schedule</a></li>
	          <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
	          <li class="nav-item cta mr-md-2"><a href="{{ URL::to('/login') }}" class="nav-link">Login</a></li>

	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
      
      @if($servisan)
      <section id="printArea" class="ftco-section services-section bg-light">
        <div class="container">
            <div class="row my-5">
                <div class="col-sm-12 d-flex ">
                    <h4 class="mt-5 mr-3">Informasi Customer</h4>
                    <img src="{{ asset('eventalk-master/images/logo_ak.jpg') }}" alt="logo" width="100">
                </div>
            </div>
          <div class="row">
            <div class="col-md-3">
                <div id="qrcode_tamu"></div>
            </div>
            <div class="col-md-9">
              <table class="table table-striped" cellspacing="0" cellpadding="10">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $servisan->customer->nama_customer }}</td>
                </tr>
                <tr>
                    <td>Tgl Masuk</td>
                    <td>:</td>
                    <td>{{ $servisan->tgl_masuk }}</td>
                </tr>
                <tr>
                    <td>no hp</td>
                    <td>:</td>
                    <td>{{ $servisan->customer->no_hp }}</td>
                </tr>
                <tr>
                    <td>Brand</td>
                    <td>:</td>
                    <td>{{ $servisan->brand->nama_brand }}</td>
                </tr>
                <tr>
                    <td>Model</td>
                    <td>:</td>
                    <td>{{ $servisan->model->nama_model }}</td>
                </tr>
                <tr>
                    <td>Masalah</td>
                    <td>:</td>
                    <td>{{ $servisan->masalah }}</td>
                </tr>
                <tr>
                    <td>Warna</td>
                    <td>:</td>
                    <td>{{ $servisan->warna }}</td>
                </tr>
                <tr>
                    <td>Catatan</td>
                    <td>:</td>
                    <td>{{ $servisan->catatan }}</td>
                </tr>
                <tr>
                    <td>Kondisi</td>
                    <td>:</td>
                    <td>
                        <span class="badge badge-info"></i> Pengerjaan</span>
                    </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </section>
      @else
      <section class="ftco-section services-section bg-light">
        <div class="container">
          <div class="row d-flex">
            <div class="col-md-6">
                <img src="{{ asset('eventalk-master/images/bug.svg') }}" alt="" width="200">
              Id tidak valid
            </div>
          </div>
        </div>
      </section>
      @endif

    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <img class="mb-3" src="{{ asset('/eventalk-master/images/logo_ak.jpg  ') }}" alt="" width="100 ">
            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This website is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://samtam.tech" target="_blank">Samtam tech</a>
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="{{ asset('eventalk-master/js/jquery.min.js') }}"></script>
  <script src="{{ asset('eventalk-master/js/jquery-migrate-3.0.1.min.js') }}"></script>
  <script src="{{ asset('eventalk-master/js/popper.min.js') }}"></script>
  <script src="{{ asset('eventalk-master/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('eventalk-master/js/jquery.easing.1.3.js') }}"></script>
  <script src="{{ asset('eventalk-master/js/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('eventalk-master/js/jquery.stellar.min.js') }}"></script>
  <script src="{{ asset('eventalk-master/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('eventalk-master/js/jquery.magnific-popup.min.js') }}"></script>
  <script src="{{ asset('eventalk-master/js/aos.js') }}"></script>
  <script src="{{ asset('eventalk-master/js/jquery.animateNumber.min.js') }}"></script>
  <script src="{{ asset('eventalk-master/js/bootstrap-datepicker.js') }}"></script>
  <script src="{{ asset('eventalk-master/js/jquery.timepicker.min.js') }}"></script>
  <script src="{{ asset('eventalk-master/js/scrollax.min.js') }}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="{{ asset('eventalk-master/js/google-map.js') }}"></script>
  <script src="{{ asset('eventalk-master/js/main.js') }}"></script>
  {{-- scanner --}}
<script src="{{ asset('plugins/scanner/html5-qrcode.min.js') }}"></script>

<script src="{{ asset('plugins/qrcodejs/qrcode.min.js') }}"></script>

    {{-- sweet alert --}}
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
     $('#btnVerifikasi').on('click',function(){

let parent = $(this);
parent.html('wait....');

let whatsapp = $('#whatsapp').val();
if(whatsapp == '000'){
    $('#verifikasi_customer').remove();
}
if(whatsapp == '' || whatsapp == null) {
  $('#feedbackMessage').html('isi no whatsapp dulu');
} else {
  $('#feedbackMessage').html('');
}


$.ajax({
  headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: '/verifikasi_customer/' + whatsapp + '/' + '{{ $id_customer }}',
    // dataType: 'json',
    success: function(data) {
      console.log(data);
      if(data == 1) {
        $('#feedbackMessage').html('Verifikasi berhasil.')
        setTimeout(() => {
          $('#verifikasi_customer').remove();
        }, 2000);
      } else {
        $('#feedbackMessage').html('Verifikasi gagal.')
      }
    },
    error: function(err) {
        console.log(err);
    },
    complete: function(){
      parent.html('Verifikasi');
    }
})
})

document.addEventListener("DOMContentLoaded", function() {
  var qrcode = new QRCode("qrcode_tamu", {
      text: '{{ $id_customer }}',
      width: 200,
      height: 200,
      colorDark : "#222831",
      colorLight : "#fff",
      correctLevel : QRCode.CorrectLevel.H
  });

});
</script>

  </body>
</html>