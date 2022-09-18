@extends('layouts.app')

@section('title') - Register @endsection

@section('styles')

    <style>
        fieldset legend {
            font-size: 18px !important;
            font-width: bold !important;
        }

        .btn-group-toggle label {
            margin-bottom: 3px !important;
        }

    </style>

@endsection
@section('content')
    <div class="col-md-12 mt-2">
        <div class="card mx-2">
            <div class="card-body p-2">

                <form method="POST" action="{{ route('client.profile.store',$id) }}" id="reg-form">
                    {{ csrf_field() }}

                    <h2 class="m-3 text-center">{{$title}}</h2>
                    @if($id != 0)<h6 class="font-weight-bold pb-2">PROFILE - GENERIC INFORMATION OF TRUSTWORTHY AI AND STANDARDS</h6>@endif

                    <div class="row justify-content-center">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <!-- Question 1 -->
                            <div class="form-group">
                                <fieldset class="border p-2">
                                    <legend class="w-auto">1. Role(s) of Respondent in Trustworthy AI Application:
                                    </legend>
                                    <input type="hidden" name="q1_name"
                                           value="Role(s) of Respondent in Trustworthy AI Application">

                                    <div class="btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-outline-info {{(old('q1') == 'Designer/Developer')? 'active': '' }} options"
                                               data-target="q1_other">
                                            <input type="radio" name="q1" value="Designer/Developer"
                                                   autocomplete="off" {{(old('q1') == 'Designer/Developer')? 'checked': '' }} required>
                                            Designer/Developer
                                        </label>
                                        <label class="btn btn-outline-success options {{(old('q1') == 'Supplier/Vendor')? 'active': '' }}"
                                               data-target="q1_other">
                                            <input type="radio" name="q1" value="Supplier/Vendor"
                                                   autocomplete="off" {{(old('q1') == 'Supplier/Vendor')? 'checked': '' }} required>
                                            Supplier/Vendor
                                        </label>
                                        <label class="btn btn-outline-primary options {{(old('q1') == 'Buyer')? 'active': '' }}"
                                               data-target="q1_other">
                                            <input type="radio" name="q1" value="Buyer"
                                                   autocomplete="off" {{(old('q1') == 'Buyer')? 'checked': '' }} required> Buyer
                                        </label>
                                        <label class="btn btn-outline-success options {{(old('q1') == 'End User/Public')? 'active': '' }}"
                                               data-target="q1_other">
                                            <input type="radio" name="q1" value="End User/Public"
                                                   autocomplete="off" {{(old('q1') == 'End User/Public')? 'checked': '' }} required>
                                            End
                                            User/Public
                                        </label>
                                        <label class="btn btn-outline-warning options {{(old('q1') == 'Others')? 'active': '' }} other"
                                               data-target="q1_other">
                                            <input type="radio" name="q1" value="Others"
                                                   autocomplete="off" {{(old('q1') == 'Others')? 'checked': '' }}>
                                            Others
                                        </label>
                                    </div>

                                    @if($errors->has('q1_other'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('q1_other') }}
                                        </div>
                                    @endif

                                    <div class="input-group mt-2 {{(old('q1_other'))?'':'d-none'}}" id="q1_other">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-pen-square fa-fw"></i>
                                        </span>
                                        </div>
                                        <input type="text" name="q1_other"
                                               class="form-control{{ $errors->has('q1_other') ? ' is-invalid' : '' }}"
                                               placeholder="Others. State ..."
                                               value="{{ old('q1_other', null) }}">
                                        @if($errors->has('q1_other'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('q1_other') }}
                                            </div>
                                        @endif
                                    </div>
                                </fieldset>
                            </div>

                            <!-- Question 2 -->
                            <div class="form-group">
                                <fieldset class="border p-2">
                                    <legend class="w-auto">2. Industry or Sector of Organization:
                                    </legend>
                                    <input type="hidden" name="q2_name"
                                           value="Industry or Sector of Organization">

                                    <div class="btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-outline-info {{(old('q2') == 'Academia')? 'active': '' }} options"
                                               data-target="q2_other">
                                            <input type="radio" name="q2" value="Academia"
                                                   autocomplete="off" {{(old('q2') == 'Academia')? 'checked': '' }}>
                                            Academia
                                        </label>
                                        <label class="btn btn-outline-success options {{(old('q2') == 'Government')? 'active': '' }}"
                                               data-target="q2_other">
                                            <input type="radio" name="q2" value="Government"
                                                   autocomplete="off" {{(old('q2') == 'Government')? 'checked': '' }}>
                                            Government
                                        </label>
                                        <label class="btn btn-outline-primary options {{(old('q2') == 'For-Profit')? 'active': '' }}"
                                               data-target="q2_other">
                                            <input type="radio" name="q2" value="For-Profit"
                                                   autocomplete="off" {{(old('q2') == 'For-Profit')? 'checked': '' }}>
                                            For-Profit
                                        </label>
                                        <label class="btn btn-outline-success options {{(old('q2') == 'Non-Profit')? 'active': '' }}"
                                               data-target="q2_other">
                                            <input type="radio" name="q2" value="Non-Profit"
                                                   autocomplete="off" {{(old('q2') == 'Non-Profit')? 'checked': '' }}>
                                            Non-Profit
                                        </label>
                                        <label class="btn btn-outline-warning options other {{(old('q2') == 'Others')? 'active': '' }}"
                                               data-target="q2_other">
                                            <input type="radio" name="q2" value="Others"
                                                   autocomplete="off" {{(old('q2') == 'Others')? 'checked': '' }}>
                                            Others
                                        </label>
                                    </div>

                                    @if($errors->has('q2'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('q2') }}
                                        </div>
                                    @endif

                                    <div class="input-group mt-2 {{(old('q2_other'))?'':'d-none'}}" id="q2_other">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-pen-square fa-fw"></i>
                                        </span>
                                        </div>
                                        <input type="text" name="q2_other"
                                               class="form-control{{ $errors->has('q2_other') ? ' is-invalid' : '' }}"
                                               placeholder="Others. State ..."
                                               value="{{ old('q2_other', null) }}">
                                        @if($errors->has('q2_other'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('q2_other') }}
                                            </div>
                                        @endif
                                    </div>
                                </fieldset>
                            </div>

                            <!-- Question 3 -->
                            <div class="form-group">
                                <fieldset class="border p-2">
                                    <legend class="w-auto">3. Size of Organization for of AI Applications:
                                    </legend>
                                    <input type="hidden" name="q3_name"
                                           value="Size of Organization for of AI Applications">

                                    <div class="btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-outline-info {{(old('q3') == '1 - 250')? 'active': '' }} options"
                                               data-target="q3_other">
                                            <input type="radio" name="q3" value="1 - 250"
                                                   autocomplete="off" {{(old('q3') == '1 - 250')? 'checked': '' }}>
                                            1 - 250
                                        </label>
                                        <label class="btn btn-outline-success options {{(old('q3') == '251 - 1000')? 'active': '' }}"
                                               data-target="q3_other">
                                            <input type="radio" name="q3" value="251 - 1000"
                                                   autocomplete="off" {{(old('q3') == '251 - 1000')? 'checked': '' }}>
                                            251 - 1000
                                        </label>

                                        <label class="btn btn-outline-warning options other {{(old('q3') == 'Others')? 'active': '' }}"
                                               data-target="q3_other">
                                            <input type="radio" name="q3" value="Others"
                                                   autocomplete="off" {{(old('q3') == 'Others')? 'checked': '' }}>
                                            Others
                                        </label>
                                    </div>

                                    @if($errors->has('q3'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('q3') }}
                                        </div>
                                    @endif

                                    <div class="input-group mt-2 {{(old('q3_other'))?'':'d-none'}}" id="q3_other">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-pen-square fa-fw"></i>
                                        </span>
                                        </div>
                                        <input type="text" name="q3_other"
                                               class="form-control{{ $errors->has('q3_other') ? ' is-invalid' : '' }}"
                                               placeholder="Others. State ..."
                                               value="{{ old('q3_other', null) }}">
                                        @if($errors->has('q3_other'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('q3_other') }}
                                            </div>
                                        @endif
                                    </div>
                                </fieldset>
                            </div>

                            <!-- Question 4 -->
                            <div class="form-group">
                                <fieldset class="border p-2">
                                    <legend class="w-auto">4. Annual Revenue of Organization:
                                    </legend>
                                    <input type="hidden" name="q4_name"
                                           value="Annual Revenue of Organization">

                                    <div class="btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-outline-info {{(old('q4') == 'Under $100k')? 'active': '' }} options"
                                               data-target="q4_other">
                                            <input type="radio" name="q4" value="Under $100k"
                                                   autocomplete="off" {{(old('q4') == 'Under $100k')? 'checked': '' }}>
                                            Under $100k
                                        </label>
                                        <label class="btn btn-outline-dark options {{(old('q4') == '$100k – $500k')? 'active': '' }}"
                                               data-target="q4_other">
                                            <input type="radio" name="q4" value="$100k – $500k"
                                                   autocomplete="off" {{(old('q4') == '$100k – $500k')? 'checked': '' }}>
                                            $100k – $500k
                                        </label>

                                        <label class="btn btn-outline-success options {{(old('q4') == '$500k – $2M')? 'active': '' }}"
                                               data-target="q4_other">
                                            <input type="radio" name="q4" value="$500k – $2M"
                                                   autocomplete="off" {{(old('q4') == '$500k – $2M')? 'checked': '' }}>
                                            $500k – $2M
                                        </label>

                                        <label class="btn btn-outline-primary options {{(old('q4') == '$2M - $100M')? 'active': '' }}"
                                               data-target="q4_other">
                                            <input type="radio" name="q4" value="$2M - $100M"
                                                   autocomplete="off" {{(old('q4') == '$2M - $100M')? 'checked': '' }}>
                                            $2M - $100M
                                        </label>

                                        <label class="btn btn-outline-danger options {{(old('q4') == '$100M – $1B')? 'active': '' }}"
                                               data-target="q4_other">
                                            <input type="radio" name="q4" value="$100M – $1B"
                                                   autocomplete="off" {{(old('q4') == '$100M – $1B')? 'checked': '' }}>
                                            $100M – $1B
                                        </label>

                                        <label class="btn btn-outline-warning options other {{(old('q4') == 'Others')? 'active': '' }}"
                                               data-target="q4_other">
                                            <input type="radio" name="q4" value="Others"
                                                   autocomplete="off" {{(old('q4') == 'Others')? 'checked': '' }}>
                                            Others
                                        </label>
                                    </div>

                                    @if($errors->has('q4_other'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('q4_other') }}
                                        </div>
                                    @endif

                                    <div class="input-group mt-2 {{(old('q4_other'))?'':'d-none'}}" id="q4_other">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-pen-square fa-fw"></i>
                                        </span>
                                        </div>
                                        <input type="text" name="q4_other"
                                               class="form-control{{ $errors->has('q4_other') ? ' is-invalid' : '' }}"
                                               placeholder="Others. State ..."
                                               value="{{ old('q4_other', null) }}">
                                        @if($errors->has('q4_other'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('q4_other') }}
                                            </div>
                                        @endif
                                    </div>
                                </fieldset>
                            </div>

                            <!-- Question 5 -->
                            <div class="form-group">
                                <fieldset class="border p-2">
                                    <legend class="w-auto">5. Location(s) (or Continent(s)) of Organization:
                                    </legend>
                                    <input type="hidden" name="q5_name"
                                           value="Location(s) (or Continent(s)) of Organization">

                                    <div class="btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-outline-info {{(old('q5') == 'UK')? 'active': '' }} options"
                                               data-target="q5_other">
                                            <input type="radio" name="q5" value="UK"
                                                   autocomplete="off" {{(old('q5') == 'UK')? 'checked': '' }}>
                                            UK
                                        </label>
                                        <label class="btn btn-outline-dark options {{(old('q5') == 'Europe')? 'active': '' }}"
                                               data-target="q5_other">
                                            <input type="radio" name="q5" value="Europe"
                                                   autocomplete="off" {{(old('q5') == 'Europe')? 'checked': '' }}>
                                            Europe
                                        </label>

                                        <label class="btn btn-outline-success options {{(old('q5') == 'US')? 'active': '' }}"
                                               data-target="q5_other">
                                            <input type="radio" name="q5" value="US"
                                                   autocomplete="off" {{(old('q5') == 'US')? 'checked': '' }}> US
                                        </label>

                                        <label class="btn btn-outline-danger options {{(old('q5') == 'Asia')? 'active': '' }}"
                                               data-target="q5_other">
                                            <input type="radio" name="q5" value="Asia"
                                                   autocomplete="off" {{(old('q5') == 'Asia')? 'checked': '' }}> Asia
                                        </label>

                                        <label class="btn btn-outline-dark options {{(old('q5') == 'Middle East')? 'active': '' }}"
                                               data-target="q5_other">
                                            <input type="radio" name="q5" value="Middle East"
                                                   autocomplete="off" {{(old('q5') == 'Middle East')? 'checked': '' }}>
                                            Middle East
                                        </label>

                                        <label class="btn btn-outline-info options {{(old('q5') == 'Global')? 'active': '' }}"
                                               data-target="q5_other">
                                            <input type="radio" name="q5" value="Global"
                                                   autocomplete="off" {{(old('q5') == 'Global')? 'checked': '' }}>
                                            Global
                                        </label>

                                        <label class="btn btn-outline-warning options other {{(old('q5') == 'Others')? 'active': '' }}"
                                               data-target="q5_other">
                                            <input type="radio" name="q5" value="Others"
                                                   autocomplete="off" {{(old('q5') == 'Others')? 'checked': '' }}>
                                            Others
                                        </label>
                                    </div>

                                    @if($errors->has('q5_other'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('q5_other') }}
                                        </div>
                                    @endif

                                    <div class="input-group mt-2 {{(old('q5_other'))?'':'d-none'}}" id="q5_other">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-pen-square fa-fw"></i>
                                        </span>
                                        </div>
                                        <input type="text" name="q5_other"
                                               class="form-control{{ $errors->has('q5_other') ? ' is-invalid' : '' }}"
                                               placeholder="Others. State ..."
                                               value="{{ old('q5_other', null) }}">
                                        @if($errors->has('q5_other'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('q5_other') }}
                                            </div>
                                        @endif
                                    </div>
                                </fieldset>
                            </div>

                            <!-- Question 6 -->
                            <div class="form-group">
                                <fieldset class="border p-2">
                                    <legend class="w-auto">6. Purpose of Trustworthy AI Applications:
                                    </legend>
                                    <input type="hidden" name="q6_name"
                                           value="Purpose of Trustworthy AI Applications">

                                    <div class="btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-outline-info {{(old('q6') == 'AI for Operations/Support')? 'active': '' }} options"
                                               data-target="q6_other">
                                            <input type="radio" name="q6" value="AI for Operations/Support"
                                                   autocomplete="off" {{(old('q6') == 'AI for Operations/Support')? 'checked': '' }}>
                                            AI for Operations/Support
                                        </label>
                                        <label class="btn btn-outline-success options {{(old('q6') == 'AI for Audit/Compliance')? 'active': '' }}"
                                               data-target="q6_other">
                                            <input type="radio" name="q6" value="AI for Audit/Compliance"
                                                   autocomplete="off" {{(old('q6') == 'AI for Audit/Compliance')? 'checked': '' }}>
                                            AI for Audit/Compliance
                                        </label>

                                        <label class="btn btn-outline-warning options other {{(old('q6') == 'Others')? 'active': '' }}"
                                               data-target="q6_other">
                                            <input type="radio" name="q6" value="Others"
                                                   autocomplete="off" {{(old('q6') == 'Others')? 'checked': '' }}>
                                            Others
                                        </label>
                                    </div>

                                    @if($errors->has('q6_other'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('q6_other') }}
                                        </div>
                                    @endif

                                    <div class="input-group mt-2 {{(old('q6_other'))?'':'d-none'}}" id="q6_other">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-pen-square fa-fw"></i>
                                        </span>
                                        </div>
                                        <input type="text" name="q6_other"
                                               class="form-control{{ $errors->has('q6_other') ? ' is-invalid' : '' }}"
                                               placeholder="Others. State ..."
                                               value="{{ old('q6_other', null) }}">
                                        @if($errors->has('q6_other'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('q6_other') }}
                                            </div>
                                        @endif
                                    </div>
                                </fieldset>
                            </div>

                            <!-- Question 7 -->
                            <div class="form-group">
                                <fieldset class="border p-2">
                                    <legend class="w-auto">7. Type of Cost of Trustworthy AI Application:
                                    </legend>
                                    <input type="hidden" name="q7_name"
                                           value="Type of Cost of Trustworthy AI Application:">

                                    <div class="btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-outline-info {{(old('q7') == 'Free')? 'active': '' }} options"
                                               data-target="q7_other">
                                            <input type="radio" name="q7" value="Free"
                                                   autocomplete="off" {{(old('q7') == 'Free')? 'checked': '' }}>
                                            Free
                                        </label>
                                        <label class="btn btn-outline-success options {{(old('q7') == 'Cost')? 'active': '' }}"
                                               data-target="q7_other">
                                            <input type="radio" name="q7" value="Cost"
                                                   autocomplete="off" {{(old('q7') == 'Cost')? 'checked': '' }}>
                                            Cost
                                        </label>

                                        <label class="btn btn-outline-warning options other {{(old('q7') == 'Others')? 'active': '' }}"
                                               data-target="q7_other">
                                            <input type="radio" name="q7" value="Others"
                                                   autocomplete="off" {{(old('q7') == 'Others')? 'checked': '' }}>
                                            Others
                                        </label>
                                    </div>

                                    @if($errors->has('q7'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('q7') }}
                                        </div>
                                    @endif

                                    <div class="input-group mt-2 {{(old('q7_other'))?'':'d-none'}}" id="q7_other">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-pen-square fa-fw"></i>
                                        </span>
                                        </div>
                                        <input type="text" name="q7_other"
                                               class="form-control{{ $errors->has('q7_other') ? ' is-invalid' : '' }}"
                                               placeholder="Others. State ..."
                                               value="{{ old('q7_other', null) }}">
                                        @if($errors->has('q7_other'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('q7_other') }}
                                            </div>
                                        @endif
                                    </div>
                                </fieldset>
                            </div>

                            <!-- Question 8 -->
                            <div class="form-group">
                                <fieldset class="border p-2">
                                    <legend class="w-auto">8. Score Your Priority for the Adoption for Trustworthy AI:
                                    </legend>
                                    <input type="hidden" name="q8_name"
                                           value="Score Your Priority for the Adoption for Trustworthy AI">

                                    <div class="btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-outline-info {{(old('q8') == 'Market Growth')? 'active': '' }} options"
                                               data-target="q8_other">
                                            <input type="radio" name="q8" value="Market Growth"
                                                   autocomplete="off" {{(old('q8') == 'Market Growth')? 'checked': '' }}>
                                            Market Growth
                                        </label>
                                        <label class="btn btn-outline-success options {{(old('q8') == 'Financial Growth')? 'active': '' }}"
                                               data-target="q8_other">
                                            <input type="radio" name="q8" value="Financial Growth"
                                                   autocomplete="off" {{(old('q8') == 'Financial Growth')? 'checked': '' }}>
                                            Financial Growth
                                        </label>

                                        <label class="btn btn-outline-dark options {{(old('q8') == 'Reputation/Brand')? 'active': '' }}"
                                               data-target="q8_other">
                                            <input type="radio" name="q8" value="Reputation/Brand"
                                                   autocomplete="off" {{(old('q8') == 'Reputation/Brand')? 'checked': '' }}>
                                            Reputation/Brand
                                        </label>

                                        <label class="btn btn-outline-success options {{(old('q8') == 'Compliance/Risk')? 'active': '' }}"
                                               data-target="q8_other">
                                            <input type="radio" name="q8" value="Compliance/Risk"
                                                   autocomplete="off" {{(old('q8') == 'Compliance/Risk')? 'checked': '' }}>
                                            Compliance/Risk
                                        </label>

                                        <label class="btn btn-outline-dark options {{(old('q8') == 'Social Good')? 'active': '' }}"
                                               data-target="q8_other">
                                            <input type="radio" name="q8" value="Social Good"
                                                   autocomplete="off" {{(old('q8') == 'Social Good')? 'checked': '' }}>
                                            Social Good
                                        </label>

                                        <label class="btn btn-outline-warning options other {{(old('q8') == 'Others')? 'active': '' }}"
                                               data-target="q8_other">
                                            <input type="radio" name="q8" value="Others"
                                                   autocomplete="off" {{(old('q8') == 'Others')? 'checked': '' }}>
                                            Others
                                        </label>
                                    </div>

                                    @if($errors->has('q8_other'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('q8_other') }}
                                        </div>
                                    @endif

                                    <div class="input-group mt-2 {{(old('q8_other'))?'':'d-none'}}" id="q8_other">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-pen-square fa-fw"></i>
                                    </span>
                                        </div>
                                        <input type="text" name="q8_other"
                                               class="form-control{{ $errors->has('q8_other') ? ' is-invalid' : '' }}"
                                               placeholder="Others. State ..."
                                               value="{{ old('q8_other', null) }}">
                                        @if($errors->has('q8_other'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('q8_other') }}
                                            </div>
                                        @endif
                                    </div>
                                </fieldset>
                            </div>


                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">

                        <!-- Question 9 -->
                        <div class="form-group">
                            <fieldset class="border p-2">
                                <legend class="w-auto">9. Organizational Department (Function) for Trustworthy AI Use:
                                </legend>
                                <input type="hidden" name="q9_name"
                                       value="Organizational Department (Function) for Trustworthy AI Use">

                                <div class="btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-outline-info {{(old('q9') == 'Strategy')? 'active': '' }} options"
                                           data-target="q9_other">
                                        <input type="radio" name="q9" value="Strategy"
                                               autocomplete="off" {{(old('q9') == 'Strategy')? 'checked': '' }}>
                                        Strategy
                                    </label>
                                    <label class="btn btn-outline-success options {{(old('q9') == 'Sales')? 'active': '' }}"
                                           data-target="q9_other">
                                        <input type="radio" name="q9" value="Sales"
                                               autocomplete="off" {{(old('q9') == 'Sales')? 'checked': '' }}>
                                        Sales
                                    </label>

                                    <label class="btn btn-outline-dark options {{(old('q9') == 'Marketing')? 'active': '' }}"
                                           data-target="q9_other">
                                        <input type="radio" name="q9" value="Marketing"
                                               autocomplete="off" {{(old('q9') == 'Marketing')? 'checked': '' }}>
                                        Marketing
                                    </label>

                                    <label class="btn btn-outline-success options {{(old('q9') == 'Admin')? 'active': '' }}"
                                           data-target="q9_other">
                                        <input type="radio" name="q9" value="Admin"
                                               autocomplete="off" {{(old('q9') == 'Admin')? 'checked': '' }}>
                                        Admin
                                    </label>

                                    <label class="btn btn-outline-dark options {{(old('q9') == 'HR')? 'active': '' }}"
                                           data-target="q9_other">
                                        <input type="radio" name="q9" value="HR"
                                               autocomplete="off" {{(old('q9') == 'HR')? 'checked': '' }}>
                                        HR
                                    </label>

                                    <label class="btn btn-outline-dark options {{(old('q9') == 'IT')? 'active': '' }}"
                                           data-target="q9_other">
                                        <input type="radio" name="q9" value="IT"
                                               autocomplete="off" {{(old('q9') == 'IT')? 'checked': '' }}>
                                        IT
                                    </label>

                                    <label class="btn btn-outline-dark options {{(old('q9') == 'Supply/Distribution')? 'active': '' }}"
                                           data-target="q9_other">
                                        <input type="radio" name="q9" value="Supply/Distribution"
                                               autocomplete="off" {{(old('q9') == 'Supply/Distribution')? 'checked': '' }}>
                                        HR
                                    </label>

                                    <label class="btn btn-outline-warning options other {{(old('q9') == 'Others')? 'active': '' }}"
                                           data-target="q9_other">
                                        <input type="radio" name="q9" value="Others"
                                               autocomplete="off" {{(old('q9') == 'Others')? 'checked': '' }}>
                                        Others
                                    </label>
                                </div>

                                @if($errors->has('q9_other'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('q9_other') }}
                                    </div>
                                @endif

                                <div class="input-group mt-2 {{(old('q9_other'))?'':'d-none'}}" id="q9_other">
                                    <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-pen-square fa-fw"></i>
                                </span>
                                    </div>
                                    <input type="text" name="q9_other"
                                           class="form-control{{ $errors->has('q9_other') ? ' is-invalid' : '' }}"
                                           placeholder="Others. State ..."
                                           value="{{ old('q9_other', null) }}">
                                    @if($errors->has('q9_other'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('q9_other') }}
                                        </div>
                                    @endif
                                </div>
                            </fieldset>
                        </div>

                        <!-- Question 10 -->
                        <div class="form-group">
                            <fieldset class="border p-2">
                                <legend class="w-auto">10. Stage of Trustworthy AI Applications’ Lifecycle:
                                </legend>
                                <input type="hidden" name="q10_name"
                                       value="Stage of Trustworthy AI Applications’ Lifecycle">

                                <div class="btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-outline-info {{(old('q10') == 'Feasibility and Planning')? 'active': '' }} options"
                                           data-target="q10_other">
                                        <input type="radio" name="q10" value="Feasibility and Planning"
                                               autocomplete="off" {{(old('q10') == 'Feasibility and Planning')? 'checked': '' }}>
                                        Feasibility and Planning
                                    </label>
                                    <label class="btn btn-outline-success options {{(old('q10') == 'Analysis and Design')? 'active': '' }}"
                                           data-target="q10_other">
                                        <input type="radio" name="q10" value="Analysis and Design"
                                               autocomplete="off" {{(old('q10') == 'Analysis and Design')? 'checked': '' }}>
                                        Analysis and Design
                                    </label>

                                    <label class="btn btn-outline-dark options {{(old('q10') == 'Development')? 'active': '' }}"
                                           data-target="q10_other" title="Data Preparation and Exploration, and/or Model Building and Evaluation">
                                        <input type="radio" name="q10" value="Development"
                                               autocomplete="off" {{(old('q10') == "Development")? 'checked': '' }}>Development
                                    </label>

                                    <label class="btn btn-outline-dark options {{(old('q10') == 'Operational and Monitoring')? 'active': '' }}"
                                           data-target="q10_other">
                                        <input type="radio" name="q10" value="Operational and Monitoring"
                                               autocomplete="off" {{(old('q10') == "Operational and Monitoring")? 'checked': '' }}>Operational and Monitoring
                                    </label>

                                    <label class="btn btn-outline-warning options other {{(old('q10') == 'Others')? 'active': '' }}"
                                           data-target="q10_other">
                                        <input type="radio" name="q10" value="Others"
                                               autocomplete="off" {{(old('q10') == 'Others')? 'checked': '' }}>
                                        Others
                                    </label>

                                    <div class="w-100 d-inline-block"><small class="form-text text-muted d-inline-block">
                                            <span class="font-weight-bold">Development :</span> Data Preparation and Exploration, and/or Model Building and Evaluation                                    </small>
                                    </div>
                                </div>

                                @if($errors->has('q10_other'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('q10_other') }}
                                    </div>
                                @endif

                                <div class="input-group mt-2 {{(old('q10_other'))?'':'d-none'}}" id="q10_other">
                                    <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-pen-square fa-fw"></i>
                            </span>
                                    </div>
                                    <input type="text" name="q10_other"
                                           class="form-control{{ $errors->has('q10_other') ? ' is-invalid' : '' }}"
                                           placeholder="Others. State ..."
                                           value="{{ old('q10_other', null) }}">
                                    @if($errors->has('q10_other'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('q10_other') }}
                                        </div>
                                    @endif
                                </div>
                            </fieldset>
                        </div>

                        <!-- Question 11 -->
                        <div class="form-group">
                            <fieldset class="border p-2">
                                <legend class="w-auto">11. Risk Level of AI Applications:
                                </legend>
                                <input type="hidden" name="q11_name"
                                       value="Risk Level of AI Applications">

                                <div class="btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-outline-info {{(old('q11') == 'Level 4 (Unacceptable)')? 'active': '' }} options"
                                           data-target="q11_other">
                                        <input type="radio" name="q11" value="Level 4 (Unacceptable)"
                                               autocomplete="off" {{(old('q11') == 'Level 4 (Unacceptable)')? 'checked': '' }}>
                                        Level 4 (Unacceptable)
                                    </label>
                                    <label class="btn btn-outline-success options {{(old('q11') == 'Level 3 (High Risk)')? 'active': '' }}"
                                           data-target="q11_other">
                                        <input type="radio" name="q11" value="Level 3 (High Risk)"
                                               autocomplete="off" {{(old('q11') == "Level 3 (High Risk)")? 'checked': '' }}>
                                        Level 3 (High Risk)
                                    </label>

                                    <label class="btn btn-outline-dark options {{(old('q11') == 'Level 2(Limited Risk)')? 'active': '' }}"
                                           data-target="q11_other" title="">
                                        <input type="radio" name="q11" value="Level 2(Limited Risk)"
                                               autocomplete="off" {{(old('q11') == "Level 2(Limited Risk)")? 'checked': '' }}>Level 2(Limited Risk)
                                    </label>

                                    <label class="btn btn-outline-dark options {{(old('q11') == 'Level 1 (Minimal Risk (No Risk))')? 'active': '' }}"
                                           data-target="q11_other" title="">
                                        <input type="radio" name="q11" value="Level 1 (Minimal Risk (No Risk))"
                                               autocomplete="off" {{(old('q11') == "Level 1 (Minimal Risk (No Risk))")? 'checked': '' }}>Level 1 (Minimal Risk (No Risk))
                                    </label>

                                    <label class="btn btn-outline-warning options other {{(old('q11') == 'Others')? 'active': '' }}"
                                           data-target="q11_other">
                                        <input type="radio" name="q11" value="Others"
                                               autocomplete="off" {{(old('q11') == 'Others')? 'checked': '' }}>
                                        Others
                                    </label>

                                    <div class="w-100 d-inline-block"><small class="form-text text-muted d-inline-block">
                                            <span class="font-weight-bold">Level 4 (Unacceptable):</span> AI applications that have clear threats to safety, livelihood, and rights of people e.g fully autonomous or armed robots</small>
                                    </div>

                                    <div class="w-100 d-inline-block"><small class="form-text text-muted d-inline-block">
                                            <span class="font-weight-bold">Level 3 (High Risk):</span> AI applications that are used to determine or take decision on human rights, access to social life, amenities, security, safety etc. e.g. social scoring systems</small>
                                    </div>

                                    <div class="w-100 d-inline-block"><small class="form-text text-muted d-inline-block">
                                            <span class="font-weight-bold">Level 2(Limited Risk):</span> AI applications that are transparent in dealing with humans and having human in the loop of decision taking e.g. chatbots</small>
                                    </div>

                                    <div class="w-100 d-inline-block"><small class="form-text text-muted d-inline-block">
                                            <span class="font-weight-bold">Level 1 (Minimal Risk (No Risk)):</span> AI applications that enhance and support humans in carrying out tasks e.g. video games, spam filters etc,     </small>
                                    </div>
                                </div>

                                @if($errors->has('q11_other'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('q11_other') }}
                                    </div>
                                @endif

                                <div class="input-group mt-2 {{(old('q11_other'))?'':'d-none'}}" id="q11_other">
                                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-pen-square fa-fw"></i>
                        </span>
                                    </div>
                                    <input type="text" name="q11_other"
                                           class="form-control{{ $errors->has('q11_other') ? ' is-invalid' : '' }}"
                                           placeholder="Others. State ..."
                                           value="{{ old('q11_other', null) }}">
                                    @if($errors->has('q11_other'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('q11_other') }}
                                        </div>
                                    @endif
                                </div>
                            </fieldset>
                        </div>

                        <!-- Question 12 -->
                        <div class="form-group">
                            <fieldset class="border p-2">
                                <legend class="w-auto">12. Major Barrier(s) to the Adoption for Trustworthy AI:
                                </legend>
                                <input type="hidden" name="q12_name"
                                       value="Major Barrier(s) to the Adoption for Trustworthy AI:">

                                <div class="btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-outline-info {{(old('q12') == 'Lack of Knowledge/Skillset')? 'active': '' }} options"
                                           data-target="q12_other">
                                        <input type="radio" name="q12" value="Lack of Knowledge/Skillset"
                                               autocomplete="off" {{(old('q12') == 'Lack of Knowledge/Skillset')? 'checked': '' }}>
                                        Lack of Knowledge/Skillset
                                    </label>
                                    <label class="btn btn-outline-success options {{(old('q12') == 'Finance/Cost')? 'active': '' }}"
                                           data-target="q12_other">
                                        <input type="radio" name="q12" value="Finance/Cost"
                                               autocomplete="off" {{(old('q12') == 'Finance/Cost')? 'checked': '' }}>
                                        Analysis and Design
                                    </label>

                                    <label class="btn btn-outline-success options {{(old('q12') == 'Lack of Personnel')? 'active': '' }}"
                                           data-target="q12_other">
                                        <input type="radio" name="q12" value="Lack of Personnel"
                                               autocomplete="off" {{(old('q12') == 'Lack of Personnel')? 'checked': '' }}>
                                        Lack of Personnel
                                    </label>

                                    <label class="btn btn-outline-success options {{(old('q12') == 'Difficult Regulation')? 'active': '' }}"
                                           data-target="q12_other">
                                        <input type="radio" name="q12" value="Difficult Regulation"
                                               autocomplete="off" {{(old('q12') == 'Difficult Regulation')? 'checked': '' }}>
                                        Difficult Regulation
                                    </label>

                                    <label class="btn btn-outline-warning options other {{(old('q12') == 'Others')? 'active': '' }}"
                                           data-target="q12_other">
                                        <input type="radio" name="q12" value="Others"
                                               autocomplete="off" {{(old('q12') == 'Others')? 'checked': '' }}>
                                        Others
                                    </label>
                                </div>

                                @if($errors->has('q12_other'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('q12_other') }}
                                    </div>
                                @endif

                                <div class="input-group mt-2 {{(old('q12_other'))?'':'d-none'}}" id="q12_other">
                                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-pen-square fa-fw"></i>
                        </span>
                                    </div>
                                    <input type="text" name="q10_other"
                                           class="form-control{{ $errors->has('q12_other') ? ' is-invalid' : '' }}"
                                           placeholder="Others. State ..."
                                           value="{{ old('q12_other', null) }}">
                                    @if($errors->has('q12_other'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('q12_other') }}
                                        </div>
                                    @endif
                                </div>
                            </fieldset>
                        </div>

                        </div>

                        <div class="col-md-12">
                            <input type="hidden" name="assessment" value="{{$id}}">
                            <button class="btn btn-block btn-primary">
                                {{($id == 0) ? 'Submit':'Continue'}}
                            </button>
                        </div>
                    </div>
                </form>

            </div>

        </div>


        @endsection

        @section('scripts')

            <script type="text/javascript">
                $(document).ready(function () {

                    $(".options").click(function () {
                        var target = $(this).data('target');
                        if ($(this).hasClass('other')) {
                            $('#' + target).removeClass('d-none');
                        } else {
                            $('#' + target).addClass('d-none');
                        }
                    });

                    $('#designation').change(function () {
                        var designation = $(this).val();

                        if (designation == 'Other') {

                            $('#designation').replaceWith('<input type="text" name="designation" id="" class="form-control" required placeholder="{{ trans("global.login_designation") }}">');
                            $('#designation').focus();
                        }


                    });

                    $('#industry').change(function () {
                        var industry = $(this).val();

                        if (industry == 'Other') {

                            $('#industry').replaceWith('<input type="text" name="industry" id="" class="form-control" required placeholder="{{ trans("global.login_industry") }}">');
                            $('#industry').focus();
                        }


                    });


                    $.get("https://ipinfo.io", function () {
                    }, "jsonp").always(function (resp) {
                        var countryCode = (resp && resp.country) ? resp.country : "";
                        if (countryCode != "") {

                            $('#country option[value= "' + countryCode + '"]').attr("selected", "selected");
                        }
                        if (countryCode != "") {
                            $.ajax({
                                type: "GET",
                                url: "{{url('get-state-list')}}?country_id=" + countryCode,
                                success: function (res) {
                                    if (res != 0) {
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
                                if (res != 0) {
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

    {!! JsValidator::formRequest('App\Http\Requests\ProfileStoreRequest', '#reg-form'); !!}

{{--            1,2,5,6,7,8,9,12--}}
@endsection

