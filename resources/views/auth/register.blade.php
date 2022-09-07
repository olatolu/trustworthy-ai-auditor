@extends('layouts.app')

@section('title') - Register @endsection
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">

            <div class="card mx-4">
                <div class="card-body p-4">

                    <form method="POST" action="{{ route('register') }}" id="reg-form">
                        {{ csrf_field() }}
                        <h1>{{ trans('panel.site_title') }}</h1>
                        <p class="text-muted">{{ trans('global.register') }}</p>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user fa-fw"></i>
                            </span>
                                </div>
                                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ trans('global.user_name') }}" value="{{ old('name', null) }}">
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-envelope fa-fw"></i>
                            </span>
                                </div>
                                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                                @if($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-mobile fa-fw"></i>
                            </span>
                                </div>
                                <input type="tel" name="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" placeholder="{{ trans('global.login_phone') }}" value="{{ old('phone', null) }}">
                                @if($errors->has('phone'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('phone') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-globe fa-fw"></i>
                            </span>
                                </div>
                                <select id="country" name="country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" placeholder="{{ trans('global.login_country') }}">
                                    <option value="" selected disabled>Choose Your {{ trans('global.login_country') }}</option>
                                    @foreach($countries as $key => $country)
                                        <option value="{{$key}}"> {{$country}}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('country'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('country') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-street-view fa-fw"></i>
                            </span>
                                </div>

                                <select id="emptyState" name="state" class="d-none"></select>

                                <select id="state" name="state" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" placeholder="{{ trans('global.login_state') }}">
                                    <option value="" selected disabled>Choose Your {{ trans('global.login_state') }}</option>
                                </select>

                                @if($errors->has('state'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('state') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-building fa-fw"></i>
                            </span>
                                </div>
                                <input type="text" name="company_name" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" placeholder="{{ trans('global.login_company_name') }}" value="{{ old('company_name', null) }}">
                                @if($errors->has('company_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('company_name') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-user-tie fa-fw"></i>
                            </span>
                                </div>
                                <select id="designation" name="designation" class="form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}" placeholder="{{ trans('global.login_designation') }}">
                                    <option value="" selected disabled>Choose Your {{ trans('global.login_designation') }}</option>
                                    @foreach(Config::get('global.designations') as $designation)
                                        @if(old('designation') == $designation)
                                            <option value="{{$designation}}" selected="selected"> {{$designation}}</option>
                                        @else
                                            <option value="{{$designation}}"> {{$designation}}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if($errors->has('designation'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('designation') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-industry fa-fw"></i>
                            </span>
                                </div>
                                <select id="industry" name="industry" class="form-control{{ $errors->has('industry') ? ' is-invalid' : '' }}" placeholder="{{ trans('global.login_industry') }}">
                                    <option value="" selected disabled>Choose Your {{ trans('global.login_industry') }}</option>
                                    @foreach(Config::get('global.industries') as $industry)
                                        @if(old('industry') == $industry)
                                            <option value="{{$industry}}" selected="selected">{{$industry}}</option>
                                        @else
                                            <option value="{{$industry}}">{{$industry}}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @if($errors->has('industry'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('industry') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock fa-fw"></i>
                            </span>
                                </div>
                                <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ trans('global.login_password') }}">
                                @if($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock fa-fw"></i>
                            </span>
                                </div>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="{{ trans('global.login_password_confirmation') }}">
                            </div>
                        </div>

                        <button class="btn btn-block btn-primary">
                            {{ trans('global.register') }}
                        </button>

                        <a class="btn btn-link px-0 fa-pull-right mt-3" href="{{ route('login') }}">
                            Have an account already? Login
                        </a>
                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {

            $('#designation').change(function () {
                var designation = $(this).val();

                if(designation == 'Other'){

                    $('#designation').replaceWith('<input type="text" name="designation" id="" class="form-control" required placeholder="{{ trans("global.login_designation") }}">');
                    $('#designation').focus();
                }


            });

            $('#industry').change(function () {
                var industry = $(this).val();

                if(industry == 'Other'){

                    $('#industry').replaceWith('<input type="text" name="industry" id="" class="form-control" required placeholder="{{ trans("global.login_industry") }}">');
                    $('#industry').focus();
                }


            });


            $.get("https://ipinfo.io", function () {
            }, "jsonp").always(function (resp) {
                var countryCode = (resp && resp.country) ? resp.country : "";
                if(countryCode != ""){

                    $('#country option[value= "' + countryCode +'"]').attr("selected", "selected");
                }
                if (countryCode != "") {
                    $.ajax({
                        type: "GET",
                        url: "{{url('get-state-list')}}?country_id=" + countryCode,
                        success: function (res) {
                            if (res !=0) {
                                $('#emptyState').hide();
                                $("#state").empty();
                                $("#state").show();
                                $("#state").append('<option selected disabled>Choose Your {{ trans("global.login_state") }}</option>');
                                $.each(res, function (key, value) {
                                    $("#state").append('<option value="' + key + '">' + value + '</option>');
                                });

                            } else {
                                $("#state").hide();
                                $('#state').replaceWith('<input type="text" name="other_state" id="emptyState" class="form-control" placeholder="Other {{ trans("global.login_state") }}">');
                            }
                        }
                    });
                } else {
                    $("#state").empty();
                }


            });
        });

        $('#country').change(function () {
            var countryID = $(this).val();

            if (countryID) {
                $.ajax({
                    type: "GET",
                    url: "{{url('get-state-list')}}?country_id=" + countryID,
                    success: function (res) {
                        if (res !=0) {
                            $('#emptyState').hide();
                            $("#state").empty();
                            $("#state").show();
                            $("#state").append('<option selected disabled>Choose Your {{ trans("global.login_state") }}</option>');
                            $.each(res, function (key, value) {
                                $("#state").append('<option value="' + key + '">' + value + '</option>');
                                $("#state").focus();
                            });

                        } else {
                            $("#state").hide();
                            $('#state').replaceWith('<input type="text" name="other_state" id="emptyState" class="form-control" placeholder="Other {{ trans("global.login_state") }}">');
                        }
                    }
                });
            } else {
                $("#state").empty();
            }
        });

    </script>

    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\RegisterRequest', '#reg-form'); !!}


@endsection
