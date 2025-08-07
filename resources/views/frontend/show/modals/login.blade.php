<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display:none;">
    <div class="modal-dialog cascading-modal" role="document">
        <!--Content-->
        <div class="modal-content">

            <!--Modal cascading tabs-->
            <div class="modal-c-tabs">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs tabs-2 light-blue darken-3" role="tablist">
                    <li class="nav-item waves-effect waves-light active">
                        <a class="nav-link" data-toggle="tab" href="#panel17" role="tab" aria-selected="true">
                            <i class="fa fa-user mr-1"></i>    @lang('labels.frontend.auth.login_box_title')</a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link" data-toggle="tab" href="#panel18" role="tab" aria-selected="false">
                            <i class="fa fa-user-plus mr-1"></i> Register</a>
                    </li>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">×</span>
                    </button>
                </ul>

                <!-- Tab panels -->
                <div class="tab-content">
                    <!--Panel 17-->
                    <div class="tab-pane fade in active" id="panel17" role="tabpanel">

                        <!--Body-->
                        {{ html()->form('POST', route('frontend.auth.ajaxlogin.post'))->id('login-post')->open() }}
                        <div class="modal-body mb-1">
                            <div class="md-form form-sm">
                                <i class="fa fa-envelope prefix"></i>
                                {{ html()->email('email')
                                        ->class('form-control required')
                                        ->placeholder(__('validation.attributes.frontend.email'))
                                        ->attribute('maxlength', 191)
                                        ->required() }}
                            </div>

                            <div class="md-form form-sm">
                                <i class="fa fa-lock prefix"></i>
                                {{ html()->password('password')
                                        ->class('form-control required')
                                        ->placeholder(__('validation.attributes.frontend.password'))
                                        ->required() }}
                            </div>
                            <div class="options text-left text-md-right mt-1" style="display: none;">

                                <div class="checkbox">
                                    <label for="remember"><input type="checkbox" name="remember" id="remember" value="1" checked=""> Remember Me</label>
                                </div>
                                <!--                                   <div class="checkbox">
                                                                    {{ html()->label(html()->checkbox('remember', true, 1) . ' ' . __('labels.frontend.auth.remember_me'))->for('remember') }}
                                                                </div>-->
                            </div>
                            <div class="options text-right text-md-right mt-1">
                                <p>Forgot <a href="{{ route('frontend.auth.password.propersix.email') }}" class="brown-text">Password?</a></p>

                            </div>

                            <div class="text-center search-btn mt-4">


                                <span class="btn btn-primary enterer"onclick="form_submit('login-post', 'Login Successful', 'Log in');" >Log in
                                    <i class="fa fa-sign-in ml-1"></i>
                                </span>
                            </div>
                        </div>
                        {{ html()->form()->close() }}
                    </div>
                    <!--/.Panel 7-->

                    <!--Panel 18-->
                    <div class="tab-pane fade" id="panel18" role="tabpanel">

                        <!--Body-->
                        {{ html()->form('POST', route('frontend.auth.ajax_register.post'))->id('register-post')->open() }}

                        <div class="modal-body registration">


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6 p-0">
                                        <div class="md-form form-sm">
                                            <i class="fa fa-user prefix"></i>
                                            {{ html()->text('first_name')
                                        ->class('form-control form-control-sm required')
                                        ->placeholder(__('validation.attributes.frontend.first_name'))
                                        ->attribute('maxlength', 191) }}
                                        </div>
                                    </div>
                                    <div class="col-md-6 p-0">
                                        <div class="md-form form-sm">
                                            <i class="fa fa-user prefix"></i>
                                            {{ html()->text('last_name')
                                        ->class('form-control form-control-sm required')
                                        ->placeholder(__('validation.attributes.frontend.last_name'))
                                        ->attribute('maxlength', 191) }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="md-form form-sm">
                                <i class="fa fa-envelope prefix"></i>
                                {{ html()->email('email')
                                        ->class('form-control form-control-sm required')
                                        ->placeholder(__('validation.attributes.frontend.email'))
                                        ->attribute('maxlength', 191)
                                
                                        ->required() }}
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6 p-0">
                                        <div class="md-form form-sm">
                                            <i class="fa fa-lock prefix"></i>
                                            {{ html()->password('password')
                                         ->class('form-control form-control-sm required')
                                        ->placeholder(__('validation.attributes.frontend.password'))
                                 ->attribute('minlength', 6)
                                        ->required() }}
                                        </div>
                                    </div>
                                    <div class="col-md-6 p-0">
                                        <div class="md-form form-sm">
                                            <i class="fa fa-lock prefix"></i>
                                            {{ html()->password('password_confirmation')
                                       ->class('form-control form-control-sm required')
                                        ->placeholder(__('validation.attributes.frontend.password_confirmation'))
                                 ->attribute('minlength', 6)
                                        ->required() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--                            <div class='row'>
                                                            <div class="col-md-12 md-form form-sm">
                                                                <label class="col-sm-8 p-0 control-label">Display my password in the confirmation email</label>
                                                                <div class="col-sm-4 p-0">
                                                                    <label class="cust-check">
                                                                        <input type="checkbox" name="diplay_name_in_email" checked="checked">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>   -->
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6 p-0">
                                        <div class="md-form form-sm">
                                            <i class="fa fa-calendar prefix"></i>
                                            <input type="date" id="form10" class="form-control form-control-sm required" placeholder="Date of birth" name="dob"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Date of Birth'">
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                            <div class='row'>
                                <div class="col-md-12">
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
                                </div>
                            </div> 
                            <!--                            <div class="md-form form-sm">
                                                            <i class="fa fa-user prefix"></i>
                                                            <input type="text" id="form8" class="form-control form-control-sm" placeholder="Name" name="user_name"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Name'">
                                                        </div>-->

                            <!--                            <div class="md-form form-sm">
                                                            <i class="fa fa-lock prefix"></i>
                                                            <input type="text" id="form9" class="form-control form-control-sm" placeholder="Adjective" name="adjective" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Adjective'">
                                                        </div>-->
                            <!--                            <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="col-md-6 p-0">
                                                                    <div class="md-form form-sm">
                                                                        <i class="fa fa-calendar prefix"></i>
                                                                        <input type="date" id="form10" class="form-control form-control-sm" placeholder="Date of birth" name="dob"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Date of Birth'">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 p-0">
                                                                    <div class="md-form form-sm">
                                                                        <i class="fa fa-road prefix"></i>
                                                                        <input type="text" id="form11" class="form-control form-control-sm" placeholder="Road" name="road" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Road'">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="col-md-6 p-0">
                                                                    <div class="md-form form-sm">
                                                                        <i class="fa fa-map prefix"></i>
                                                                        <input type="text" id="form12" class="form-control form-control-sm" placeholder="City" name="city"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'City'">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 p-0">
                                                                    <div class="md-form form-sm">
                                                                        <i class="fa fa-globe prefix"></i>
                                                                        <select class="form-control required" name="country" required="required">
                                                                            <option value="" selected disabled hidden  >Country</option>
                                                                            <option value="1">Pakistan</option>
                                                                            <option value="2">UK</option>
                                                                            <option value="3">USA</option>
                                                                            <option value="4">UAE</option>
                                                                            <option value="5">Spain</option>
                                                                            <option value="6">Turkey</option>
                                                                            <option value="7">China</option>
                                                                            <option value="8">Iran</option>
                                                                            <option value="9">India</option>                                                            
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                            
                                                        <div class="md-form form-sm">
                                                            <i class="fa fa-phone-square prefix"></i>
                                                            <input type="text" id="form14" class="form-control form-control-sm" placeholder="Phone Number" name="phone" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone Number'">
                                                        </div>
                            
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="col-md-12 p-0">
                                                                    <div class="md-form form-sm">
                                                                        <i class="fa fa-user-secret prefix"></i>
                                                                        <select class="form-control" name="question">
                                                                            <option value="" selected disabled hidden  >Choose a Secret Question</option>
                                                                            <option value="1">Question 1</option>
                                                                            <option value="2">Question 2</option>
                                                                            <option value="3">Question 3</option>
                                                                            <option value="4">Question 4</option>
                                                                            <option value="5">Question 5</option>
                                                                            <option value="6">Question 6</option>
                                                                            <option value="7">Question 7</option>
                                                                            <option value="8">Question 8</option>
                                                                            <option value="9">Question 9</option>                                                            
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 p-0">
                                                                    <div class="md-form form-sm">
                                                                        <i class="fa fa-user-secret prefix"></i>
                                                                        <input type="text" id="form16" class="form-control form-control-sm" placeholder="Secret Answer" name="answer"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Secret Answer'">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class='row'>
                                                            <div class="col-md-12 pb-10 registration">
                                                                <div class="col-sm-1 p-0">
                                                                    <label class="cust-check">
                                                                        <input type="checkbox" class="required" name="agree_terms" value="1" checked="checked">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>
                                                                <label class="col-sm-11 p-0 control-label">By pressing REGISTER I agree to the <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a> and confirm that I am 18 years and older</label>
                                                            </div>
                                                        </div>
                            
                                                        <div class='row'>
                                                            <div class="col-md-12 pb-10 registration">
                                                                <div class="col-sm-1 p-0">
                                                                    <label class="cust-check">
                                                                        <input type="checkbox" name="contacted_by_email" value="1" checked="checked">
                                                                        <span class="checkmark"></span>
                                                                    </label>
                                                                </div>
                                                                <label class="col-sm-11 p-0 control-label">I would like to be contacted with special offers, bonuses and promotions;  and <a href="#">Read More</a></label>
                                                            </div>
                                                        </div>-->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center search-btn mt-4">
                                        <!--                                        <button class="btn btn-primary">Sign up
                                                                                    <i class="fa fa-sign-in ml-1"></i>
                                                                                </button>-->
                                        <span class="btn btn-primary enterer"onclick="form_submit('register-post', 'Register Successful', 'Sign up');" >Sign up
                                            <i class="fa fa-sign-in ml-1"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ html()->form()->close() }}

                    </div>
                    <!--/.Panel 8-->
                </div>

            </div>
        </div>
        <!--/.Content-->
    </div>
</div>