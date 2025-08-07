<style>
    .fixed-bottom {
        position: fixed;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1030;
        width: 70%;
        border-radius: 20px;
    }
    .bg-success {
        background-color: #312d2d!important;
    }
    .p-2 {
        padding: 30px!important;
    }
    .text-center {
        text-align: center!important;
        margin-right: 90px;
    }
    .text-light {
        color: #f8f9fa!important;
    }
    .cookies-header{
       padding-bottom: 8px;
    }
</style>
<div class="js-cookie-consent cookie-consent fixed-bottom bg-success p-2 text-light">

    <div class="row">
        <div class="col-md-10">
            <h4 class="cookies-header">Cookie Policy</h4>
              <p>
                  This website uses cookies that are necessary to its functioning and required to achieve the purposes illustrated in the privacy policy. By accepting this or scrolling this page or continuing to browse, you agree to our  <a href="{{url('privacy-policy')}}" style="color: goldenrod;">privacy policy.</a>
        </p>
        </div>
        <div class="col-md-2">
            <button class="js-cookie-consent-agree cookie-consent__agree btn btn-block" style="color:black;background: goldenrod;border-radius: 10px;margin-top: 30px;">
               Accept
            </button>
        </div>
    </div>
</div>
