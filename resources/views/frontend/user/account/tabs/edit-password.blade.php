<div class='row'>
    {{ html()->form('PATCH', route('frontend.auth.password.update'))->id('update-password')->open() }}

    <div class="col-md-12 pb-10">
        <label class="col-sm-4 p-0 control-label">Old Password</label>
        <div class="col-sm-8 p-0">
            {{ html()->password('old_password')
                    ->class('form-control required')
                    ->placeholder(__('validation.attributes.frontend.old_password'))
            ->value('')
                    ->autofocus()
                    ->required() }}
        </div>
    </div> 
    <div class="col-md-12 pb-10">
        <label class="col-sm-4 p-0 control-label">New Password</label>
        <div class="col-sm-8 p-0">
            {{ html()->password('password')
                    ->class('form-control required')
                    ->placeholder(__('validation.attributes.frontend.password'))
                    ->required() }}
        </div>
    </div> 
    <div class="col-md-12 pb-10">
        <label class="col-sm-4 p-0 control-label">Confirm Password</label>
        <div class="col-sm-8 p-0">
            {{ html()->password('password_confirmation')
                    ->class('form-control required')
                    ->placeholder(__('validation.attributes.frontend.password_confirmation'))
                    ->required() }}
        </div>
    </div>

    <div class="form-group col-md-12">
        <div class="search-btn text-right">
<!--            <span class="btn btn-primary enterer"onclick="form_submit('update-password', 'Login Successful', 'Update');" >Update

            </span>-->
      
            <button  type="submit" class="btn btn-primary">Update</button> 
        </div> 
    </div>
    {{ html()->form()->close() }}
</div>