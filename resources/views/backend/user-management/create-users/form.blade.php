<!-- Start username -->
<div class="form-group row">
    <label for="username" class="col-md-3 col-form-label text-md-right">*Username : </label>

    <div class="col-md-8">
        <input id="username" type="text" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" placeholder="E.G :John" required>
        @if ($errors->has('username'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
        @endif
    </div>
</div>
<!-- End username -->

<!-- Start password -->
<div class="form-group row">
    <label for="password" class="col-md-3 col-form-label text-md-right">*Password : </label>

    <div class="col-md-8">
        <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="E.G : ********" value="{{ old('password') }}" required>
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
        @endif
    </div>
</div>
<!-- End password -->

<!-- Start email -->
<div class="form-group row">
    <label for="email" class="col-md-3 col-form-label text-md-right">*Email : </label>

    <div class="col-md-8">
        <input id="email" type="email"  pattern="^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
        @endif
    </div>
</div>
<!-- End email -->

<!-- Start first_name -->
<div class="form-group row">
    <label for="first_name" class="col-md-3 col-form-label text-md-right">*First Name : </label>

    <div class="col-md-8">
        <input id="first_name" type="text" class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required>
        @if ($errors->has('first_name'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
        @endif
    </div>
</div>
<!-- End first_name -->

<!-- Start last_name -->
<div class="form-group row">
    <label for="last_name" class="col-md-3 col-form-label text-md-right">*Last Name : </label>

    <div class="col-md-8">
        <input id="last_name" type="text" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required>
        @if ($errors->has('last_name'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
        @endif
    </div>
</div>
<!-- End last_name -->

<!-- Start address -->
<div class="form-group row">
    <label for="address" class="col-md-3 col-form-label text-md-right">Address : </label>

    <div class="col-md-8">
        <input id="address" type="text" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}">
        @if ($errors->has('address'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
        @endif
    </div>
</div>
<!-- End address -->

<!-- Start date_of_birth -->
<div class="form-group row">
    <label for="date_of_birth" class="col-md-3 col-form-label text-md-right">Date Of Birth : </label>

    <div class="col-md-8">
        <input id="date_of_birth" type="text" class="form-control datepicker {{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" name="date_of_birth" value="{{ old('date_of_birth') }}">
        @if ($errors->has('date_of_birth'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date_of_birth') }}</strong>
                                    </span>
        @endif
    </div>
</div>
<!-- End date_of_birth -->

<!-- Start country -->
<div class="form-group row">
    <label for="country" class="col-md-3 col-form-label text-md-right">Country : </label>
    <div class="col-md-8">
        <select id="country" type="text" class="form-control select2 {{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" data-toggle="select2">
            <option value="">Select Countries</option>
            @php
                $countries = DB::table('countries')->orderBy('name', 'asc')->get();
            @endphp
            @foreach($countries as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
        </select>
        @if ($errors->has('country'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
        @endif
    </div>
</div>
<!-- End country -->

<!-- Start city -->
<div class="form-group row">
    <label for="city" class="col-md-3 col-form-label text-md-right">City : </label>
    <div class="col-md-8">
        <select id="city1" type="text" class="form-control select2 {{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" data-toggle="select2">
            <option value="">Select City</option>
        </select>
        @if ($errors->has('city'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
        @endif
    </div>
</div>
<!-- End city -->

<!-- Start phone_number -->
<div class="form-group row">
    <label for="phone_number" class="col-md-3 col-form-label text-md-right">Phone Number : </label>

    <div class="col-md-8">
        <input id="phone_number" type="text" class="form-control {{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}">
        @if ($errors->has('phone_number'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
        @endif
    </div>
</div>
<!-- End phone_number -->

<!-- Start balance -->
{{-- <div class="form-group row">
    <label for="balance" class="col-md-3 col-form-label text-md-right">Balance : </label>

    <div class="col-md-8">
        <div class="input-group">
            <input id="balance" type="text" class="form-control {{ $errors->has('balance') ? ' is-invalid' : '' }}" name="balance" value="{{ old('balance') }}">
            <span class="input-group-append">
                <button class="btn btn-secondary" type="button">$</button>
            </span>
        </div>
        @if ($errors->has('balance'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('balance') }}</strong>
            </span>
        @endif
    </div>
</div> --}}
<!-- End balance -->

<!-- Start secret_question -->
<div class="form-group row">
    <label for="secret_question" class="col-md-3 col-form-label text-md-right">Secret Question : </label>
    <div class="col-md-8">
        <select id="secret_question" type="text" class="form-control {{ $errors->has('secret_question') ? ' is-invalid' : '' }}" name="secret_question">
            <option>What's my mother's hidden name?</option>
            <option>What's my favourite hobby?</option>
            <option>What's my favourite sport club?</option>
            <option>What's the name of my favourite book?</option>
            <option>Who was my childhood hero?</option>
            <option>What's the name of my pet?</option>
            <option>What's my nickname?</option>
            <option>What was the make of my first car?</option>
            <option>What's my secret code?</option>
        </select>
        @if ($errors->has('secret_question'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('secret_question') }}</strong>
                                    </span>
        @endif
    </div>
</div>
<!-- End secret_question -->

<!-- Start secret_answer -->

<div class="form-group row">
    <label for="secret_answer" class="col-md-3 col-form-label text-md-right">*Secret Answer : </label>

    <div class="col-md-8">
        <input type="hidden" name="aff_status" id="aff_status" value="0">
        <input id="secret_answer" type="text" class="form-control {{ $errors->has('secret_answer') ? ' is-invalid' : '' }}" name="secret_answer" value="{{ old('secret_answer') }}">
        @if ($errors->has('secret_answer'))
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('secret_answer') }}</strong>
                                    </span>
        @endif
    </div>
</div>
<!-- End secret_answer -->

<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="control-label">{{ 'Name' }}</label>
    <input class="form-control" name="name" type="text" id="name" value="{{ isset($createuser->name) ? $createuser->name : ''}}" >
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <select name="status" class="form-control" id="status" >
    @foreach (json_decode('required', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($createuser->status) && $createuser->status == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
