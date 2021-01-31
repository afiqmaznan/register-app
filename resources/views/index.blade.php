<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <style>
        :root {
        --input-padding-x: 1.5rem;
        --input-padding-y: .75rem;
        }

        body {
        }

        .card-signin {
        border: 0;
        border-radius: 1rem;
        box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
        overflow: hidden;
        }

        .card-signin .card-title {
        margin-bottom: 2rem;
        font-weight: 300;
        font-size: 1.5rem;
        }

        .card-signin .card-img-left {
        width: 45%;
        /* Link to your background image using in the property below! */
        background: scroll center url('https://source.unsplash.com/WEQbe2jBg40/414x512');
        background-size: cover;
        }

        .card-signin .card-body {
        padding: 2rem;
        }

        #registerform {
        width: 100%;
        }

        #registerform .btn {
        font-size: 80%;
        border-radius: 5rem;
        letter-spacing: .1rem;
        font-weight: bold;
        padding: 1rem;
        transition: all 0.2s;
        }

        .form-label-group {
        position: relative;
        margin-bottom: 1rem;
        }

        .form-label-group input {
        height: auto;
        border-radius: 2rem;
        }

        .form-label-group>input,
        .form-label-group>label {
        padding: var(--input-padding-y) var(--input-padding-x);
        }

        .form-label-group>label {
        position: absolute;
        top: 0;
        left: 0;
        display: block;
        width: 100%;
        margin-bottom: 0;
        /* Override default `<label>` margin */
        line-height: 1.5;
        color: #495057;
        border: 1px solid transparent;
        border-radius: .25rem;
        transition: all .1s ease-in-out;
        }

        .form-label-group input::-webkit-input-placeholder {
        color: transparent;
        }

        .form-label-group input:-ms-input-placeholder {
        color: transparent;
        }

        .form-label-group input::-ms-input-placeholder {
        color: transparent;
        }

        .form-label-group input::-moz-placeholder {
        color: transparent;
        }

        .form-label-group input::placeholder {
        color: transparent;
        }

        .form-label-group input:not(:placeholder-shown) {
        padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
        padding-bottom: calc(var(--input-padding-y) / 3);
        }

        .form-label-group input:not(:placeholder-shown)~label {
        padding-top: calc(var(--input-padding-y) / 3);
        padding-bottom: calc(var(--input-padding-y) / 3);
        font-size: 12px;
        color: #777;
        }

        .btn-google {
        color: white;
        background-color: #ea4335;
        }

        .btn-facebook {
        color: white;
        background-color: #3b5998;
        }

        .text-red {
          color:red;
        }



    </style>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
    
    <script type="text/javascript">
      $(document).ready(function () {

        $('.date').datepicker({
            dateFormat: "dd/mm/yy",
            changeMonth: true,
            changeYear: true,
          });         
		
          $('.select2').select2({
            minimumInputLength: 1,
            ajax: {
              url: '{{ route("GetCountry") }}',
              dataType: 'json',
            },
          });

          $('#modal-button').on('click', function(){
            $('#modalconfirmation').modal('show');
          });

          $('#registerform').on('submit', function(event){
            event.preventDefault();
            $.ajax({
              url:'{{Route("StoreUser")}}',
              type:'post',
              data:$(this).serialize(),
              dataType:'json',
              success:function(data) {
                console.log(data);
                $("*[id$='_error']").hide();
                $('#modalconfirmation').modal('hide');
                $('#success-modalconfirmation').modal('show');
                setTimeout('window.location.href = "/getuser"', 3500);
              },
              error: function (jqXHR, textStatus, errorThrown) {
                $('#modalconfirmation').modal('hide');
                $("*[id$='_error']").hide();
                if( jqXHR.status === 422 ) {
                  console.log(jqXHR.status === 422);
                  var errors = $.parseJSON(jqXHR.responseText).errors;

                  $.each(errors, function (key, val) {
                    $('#' + key + '_error').html(val).show();
                  });
                }
                console.log(jqXHR);
              }
            });
          });

          
      });

      
    </script>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card card-signin flex-row my-5">
          <div class="card-img-left d-none d-md-flex">
            <!-- Background image for card set in CSS! -->
            <div class="align-self-center ml-4">
                <img src="{{ asset('image/1.png') }}">

            </div>
          </div>
          <div class="card-body">
            <h5 class="card-title text-center">Register</h5>
            <form id="registerform" autocomplete="off" novalidate>
              @csrf
              <div class="col-md-12 mb-3">
                <label class="form-control-label">Name :</label>
                <input type="text" name="name" class="form-control" autofocus>
                <span id="name_error" class="text-red"></span>
              </div>

              <div class="col-md-12 mb-3">
                <label class="form-control-label">Email :</label>
                <input type="email" name="email" class="form-control">
                <span id="email_error" class="text-red"></span>
              </div>

              <div class="col-md-12 mb-3">
                <label class="form-control-label">Password :</label>
                <input type="password" name="password" class="form-control">
                <span id="password_error" class="text-red"></span>
              </div>

              <div class="col-md-12 mb-3">
                <label class="form-control-label">Date of Birth :</label>
                <input type="text" name="dob" class="form-control date">
                <span id="dob_error" class="text-red"></span>
              </div>

              <div class="col-md-12 mb-3">
                <label class="form-control-label">Country :</label>
                <select name="country" class="form-control select2" style="width: 100%"></select>
                <span id="country_error" class="text-red"></span>
              </div>

              
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="button" id="modal-button">Register</button>
              <!-- <a class="d-block text-center mt-2 small" href="#">Sign In</a> -->
              <hr class="my-4">
              <!-- <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign up with Google</button>
              <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign up with Facebook</button> -->
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Confirmation -->
  <div class="modal fade" id="modalconfirmation">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="widget-body">
                        <b>Are you sure to proceed with the registration?</b><br><br>      
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Back</button>
                        <button type="submit" class="finish btn btn-gradient-04" form="registerform">Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  class="modal fade" id="success-modalconfirmation">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="sa-icon sa-success animate" style="display: block;">
                        <span class="sa-line sa-tip animateSuccessTip"></span>
                        <span class="sa-line sa-long animateSuccessLong"></span>
                        <div class="sa-placeholder"></div>
                        <div class="sa-fix"></div>
                    </div>
                    <div class="section-title mt-5 mb-2">
                        <h2 class="text-gradient-02">Thank You!</h2>
                    </div>
                    <p class="mb-5"><b>Your registration is complete. You will be directed to list of registered users.</b></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Confirmation -->


</body>
</html>