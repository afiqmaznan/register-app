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
    
</head>

<body>
    
  <div class="container">
    <div class="row">
        <div class="page-header">
            <div class="d-flex align-items-center">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('Index') }}">Register Page</a></li>
                    <li class="breadcrumb-item active">Registered User</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card card-signin flex-row my-5">
          
          <div class="card-body">
            <h5 class="card-title text-center">Registered User</h5>
            <div class="table-responsive">
                <table id="table_user" class="table mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>DOB</th>
                            <th>Country</th>
                        </tr>
                    </thead>
                    <tbody id="">
                    @if(count($user) > 0)
                        @foreach($user as $key=>$users)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$users->name ?? ''}}</td>
                            <td>{{$users->email ?? ''}}</td>
                            <td>{{\Carbon\Carbon::parse($users->dob ?? '')->format('d/m/Y')}}</td>                            
                            <td>{{$users->countryforuser->name }}</td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center pt-5">No Records</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>