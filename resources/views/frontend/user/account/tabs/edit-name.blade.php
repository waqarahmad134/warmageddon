<div class='row'>
    {{ html()->modelForm($logged_in_user, 'PATCH', route('frontend.user.profile.update'))->class('none')->attribute('enctype', 'multipart/form-data')->open() }}


    <input type="hidden" name="avatar_type" value="gravatar" {{ $logged_in_user->avatar_type == 'gravatar' ? 'checked' : '' }} />



    <div class="col-md-12 pb-10">
        <label class="col-sm-4 p-0 control-label">First Name</label>
        <div class="col-sm-8 p-0">

            {{ html()->text('first_name')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.first_name'))
                    ->attribute('maxlength', 191)
                    ->required()
                    ->autofocus() }}
        </div>
    </div> 
    <div class="col-md-12 pb-10">
        <label class="col-sm-4 p-0 control-label">Last Name</label>
        <div class="col-sm-8 p-0">
            {{ html()->text('last_name')
                    ->class('form-control')
                    ->placeholder(__('validation.attributes.frontend.last_name'))
                    ->attribute('maxlength', 191)
                    ->required() }}
        </div>
    </div> 
    <div class="col-md-12 pb-10">
        <label class="col-sm-4 p-0 control-label">Email</label>
        <div class="col-sm-8 p-0">

            {{ html()->email('email')
                        ->class('form-control')
                        ->placeholder(__('validation.attributes.frontend.email'))
                        ->attribute('maxlength', 191)
                        ->required() }}
        </div>
    </div> 

    <div class="col-md-12 pb-10">
        <label class="col-sm-4 p-0 control-label">Date of Birth</label>
        <div class="col-sm-8 p-0">
            
            <input type="date" id="form10" class="form-control form-control-sm required" value="{{ $logged_in_user->dob }}" placeholder="Date of birth" name="dob"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Date of Birth'">
        </div>
    </div>



<!--    <div class="col-md-12 pb-10">
        <label class="col-sm-4 p-0 control-label">Gender</label>
        <div class="col-sm-4 p-0">
            <div class="input-group">
                <label class="gender-button">Male
                    <input type="radio" name="gender" value="male" checked="checked">
                    <span class="dot-checkmark"></span>
                </label>

            </div>
        </div>
        <div class="col-sm-4 p-0">
            <div class="input-group">
                <label class="gender-button">Female
                    <input type="radio" name="gender" value="female" >
                    <span class="dot-checkmark"></span>
                </label>
            </div>
        </div>
    </div>-->





    <div class="form-group col-md-12">
        <div class="search-btn text-right">
            <button type="submit" class="btn btn-primary">Update</button> 
        </div> 
    </div>
    {{ html()->closeModelForm() }}
</div>
@push('after-scripts')
<script>
    $(function () {
        var avatar_location = $("#avatar_location");

        if ($('input[name=avatar_type]:checked').val() === 'storage') {
            avatar_location.show();
        } else {
            avatar_location.hide();
        }

        $('input[name=avatar_type]').change(function () {
            if ($(this).val() === 'storage') {
                avatar_location.show();
            } else {
                avatar_location.hide();
            }
        });
    });
</script>
@endpush
