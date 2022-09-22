@extends('layouts.app')

@section('title') - Register @endsection

@section('styles')

    <style>

        .select2 {
            max-width: 100%;
            width: 100% !important;
        }

        fieldset legend {
            font-size: 18px !important;
            font-width: bold !important;
        }

        .btn-group-toggle label {
            margin-bottom: 3px !important;
        }

        .select2-container--default .select2-results__option {
            padding-left: 5px !important;
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid rgba(0,0,0,.125) !important;
        }

    </style>

@endsection

@section('content')
    <div class="col-md-12 mt-2">
        <div class="card mx-2">
            <div class="card-body p-2">

                <form method="POST" action="{{ route('client.test.profile.register.store') }}" id="reg-form" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <h2 class="m-3 text-center">NEW TRUSTWORTHY AI APPLICATIONS AND STANDARDS</h2>
                   <h6 class="font-weight-bold pb-2 text-xl-center">New/Existing Trustworthy AI Toolkit Profile</h6>

                    <div class="row justify-content-center">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <!-- Question 1 -->
                            <div class="form-group">
                                <fieldset class="border p-2">
                                    <legend class="w-auto">New/Existing Trustworthy AI Toolkit Profile:
                                    </legend>
                                    <div class="btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-outline-info {{(old('type') == 'new')? 'active': '' }} options"
                                               data-target="other_field">
                                            <input type="radio" class="check-box" name="type" value="new"
                                                   autocomplete="off" {{(old('type') == 'new')? 'checked': '' }} required>
                                            New
                                        </label>
                                        <label class="btn btn-outline-success options {{(old('type') == 'existing')? 'active': '' }}"
                                               data-target="select_field">
                                            <input type="radio" class="check-box" name="type" value="existing"
                                                   autocomplete="off" {{(old('type') == 'existing')? 'checked': '' }} required>
                                            Existing
                                        </label>
                                    </div>

                                    @if($errors->has('type'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('type') }}
                                        </div>
                                    @endif
                                </fieldset>
                            </div>

                            <!-- Question 2 -->
                            <div class="form-group existing d-none">
                                <fieldset class="border p-2">
                                    <legend class="w-auto">Select Toolkit
                                    </legend>

                                    {!! Form::select('toolkit_id', [''=>'Select'] + $toolkits, old('toolkit_id'), ['class' => $errors->has('toolkit_id') ? 'form-control select2 js-example-placeholder-multiple is-invalid' : 'form-control select2 js-example-placeholder-multiple', 'id'=>'toolkit_id', 'required'=>'required']) !!}


                                @if($errors->has('toolkit_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('toolkit_id') }}
                                        </div>
                                    @endif

                                </fieldset>
                            </div>

                            <!-- Question 3 -->
                            <div class="form-group new d-none">
                                <fieldset class="border p-2">
                                    <legend class="w-auto">New Toolkit Info:
                                    </legend>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-industry fa-fw"></i>
                                            </span>
                                            </div>
                                            <input type="text" name="manufacturer_name" class="form-control{{ $errors->has('manufacturer_name') ? ' is-invalid' : '' }}" placeholder="Manufacturer of Trustworthy AI Toolkit" value="{{ old('manufacturer_name', null) }}">
                                            @if($errors->has('manufacturer_name'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('manufacturer_name') }}
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
                                                    <option value="{{$country}}" code="{{$key}}"> {{$country}}</option>
                                                @endforeach
                                            </select>

                                            @if($errors->has('country'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('country') }}
                                                </div>
                                            @endif
                                            <div class="w-100 d-inline-block"><small class="form-text text-muted d-inline-block">
                                                    Country of Manufacturer
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group date" id="datepicker">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-calendar fa-fw"></i>
                                            </span>
                                            </div>
                                            <input type="date" name="release_date" class="form-control{{ $errors->has('release_date') ? ' is-invalid' : '' }}" placeholder="Date of Release or Manufacture" value="{{ old('release_date', null) }}">
                                            @if($errors->has('release_date'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('release_date') }}
                                                </div>
                                            @endif
                                            <div class="w-100 d-inline-block"><small class="form-text text-muted d-inline-block">
                                                    Date of Release or Manufacture
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-link fa-fw"></i>
                                            </span>
                                            </div>
                                            <input type="text" name="source_url" class="form-control{{ $errors->has('source_url') ? ' is-invalid' : '' }}" placeholder="Web link of Toolkits" value="{{ old('source_url', null) }}">
                                            @if($errors->has('source_url'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('source_url') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-pen-square fa-fw"></i>
                                            </span>
                                            </div>
                                            <textarea name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Brief Description of Toolkits">{{ old('description', null) }}</textarea>
                                            @if($errors->has('description'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('description') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-file fa-fw"></i>
                                            </span>
                                            </div>
                                            <input type="file" name="attachment" class="form-control{{ $errors->has('attachment') ? ' is-invalid' : '' }}" placeholder="Relevant Documentation" value="{{ old('attachment', null) }}">
                                            @if($errors->has('attachment'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('attachment') }}
                                                </div>
                                            @endif

                                            <div class="w-100 d-inline-block"><small class="form-text text-muted d-inline-block">
                                                    Attachment of Relevant Documentation
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <input type="hidden" name="profile_id" value="{{$profile}}">
                            <div class="col-md-6 ml-auto mr-auto"><button class="btn btn-block btn-primary">
                                Continue
                            </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>

        </div>


        @endsection



@section('scripts')

<script type="text/javascript">
                $(document).ready(function() {

                    $(".check-box").change(function() {
                        if(this.checked) {
                            if(this.value == 'existing'){
                                $('.'+this.value).removeClass('d-none')
                                $(".new").addClass('d-none')
                            }else{
                                $('.'+this.value).removeClass('d-none')
                                $(".existing").addClass('d-none')
                            }
                        }
                    });

                    $('.select2').select2()

                    $.get("https://ipinfo.io", function () {
                    }, "jsonp").always(function (resp) {
                        var countryCode = (resp && resp.country) ? resp.country : "";
                        console.log(resp.country);
                        if(countryCode != ""){

                            $('#country option[code= "' + countryCode +'"]').attr("selected", "selected");
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

{!! JsValidator::formRequest('App\Http\Requests\ProfileRegisterRequest', '#reg-form'); !!}


@endsection

