<a class="sidebar-brand" href="{{Auth::user()->hasRole('Affiliate')?url('/affiliate/dashboard'):url('/dash-panel')}}">
    <img src="{{ asset('backend/proper-six.png') }}" alt="" style=" width: 100%;">
</a>

<ul class="sidebar-nav">
    <li class="sidebar-header">
        Main
    </li>
    @can('Affiliate')
        <li class="sidebar-item">
            <a href="#cms" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
                <i class="align-middle" data-feather="grid"></i>
                <span class="align-middle">
                Affiliate
            </span>
            </a>

            <ul id="cms" class="sidebar-dropdown list-unstyled collapse">
                <li class="sidebar-item" ><a class="sidebar-link" href="{{ route('Affiliate.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Dashboard</a></li>
                <li class="sidebar-item" ><a class="sidebar-link" href="{{ url('affiliate/users') }}"><i class="align-middle" data-feather="corner-down-right"></i>Affiliate Users</a></li>
                {{-- <li class="sidebar-item" ><a class="sidebar-link" href="{{ route('admin_spin') }}"><i class="align-middle" data-feather="corner-down-right"></i>Add Spin</a></li> --}}
            </ul>
            <ul id="cms" class="sidebar-dropdown list-unstyled collapse">
                <li class="sidebar-item" ><a class="sidebar-link" href="{{ url('affiliate/withdraws') }}"><i class="align-middle" data-feather="corner-down-right"></i>Withdrawals</a></li>
                {{-- <li class="sidebar-item" ><a class="sidebar-link" href="{{ route('admin_spin') }}"><i class="align-middle" data-feather="corner-down-right"></i>Add Spin</a></li> --}}
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="#multi_media" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
                <i class="align-middle" data-feather="grid"></i>
                <span class="align-middle">
                Multi Media
            </span>
            </a>
            <ul id="multi_media" class="sidebar-dropdown list-unstyled collapse">
                <li class="sidebar-item" ><a class="sidebar-link" href="{{ route('affiliate.show-media') }}"><i class="align-middle" data-feather="corner-down-right"></i>Affiliate Media</a></li>
                {{-- <li class="sidebar-item" ><a class="sidebar-link" href="{{ route('admin_spin') }}"><i class="align-middle" data-feather="corner-down-right"></i>Add Spin</a></li> --}}
            </ul>
        </li>
        @endcan
    @can('Admin panel')
        <li class="sidebar-item">
            <a href="#cms" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
                <i class="align-middle" data-feather="grid"></i>
                <span class="align-middle">
                CMS
            </span>
            </a>
            <ul id="cms" class="sidebar-dropdown list-unstyled collapse">
                <li class="sidebar-item" ><a class="sidebar-link" href="{{ route('siteSetting') }}"><i class="align-middle" data-feather="corner-down-right"></i>Site Content</a></li>
                {{-- <li class="sidebar-item" ><a class="sidebar-link" href="{{ route('admin_spin') }}"><i class="align-middle" data-feather="corner-down-right"></i>Add Spin</a></li> --}}
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="#affiliate-requests" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
                <i class="align-middle" data-feather="grid"></i>
                <span class="align-middle">
                Affiliate
            </span>
            </a>
            <ul id="affiliate-requests" class="sidebar-dropdown list-unstyled collapse">
                <li class="sidebar-item" ><a class="sidebar-link" href="{{ route('AffiliateRequests') }}"><i class="align-middle" data-feather="corner-down-right"></i>Affiliate Requests</a></li>
                {{-- <li class="sidebar-item" ><a class="sidebar-link" href="{{ route('admin_spin') }}"><i class="align-middle" data-feather="corner-down-right"></i>Add Spin</a></li> --}}
            </ul>
            <ul id="affiliate-requests" class="sidebar-dropdown list-unstyled collapse">
                <li class="sidebar-item" ><a class="sidebar-link" href="{{ route('affiliate.media') }}"><i class="align-middle" data-feather="corner-down-right"></i>Affiliate Media</a></li>
                {{-- <li class="sidebar-item" ><a class="sidebar-link" href="{{ route('admin_spin') }}"><i class="align-middle" data-feather="corner-down-right"></i>Add Spin</a></li> --}}
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="#tickets" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
                <i class="align-middle" data-feather="grid"></i>
                <span class="align-middle">
                Tickets
            </span>
            </a>
            <ul id="tickets" class="sidebar-dropdown list-unstyled collapse">
                <li class="sidebar-item" ><a class="sidebar-link" href="{{ route('Admin.Tickets') }}"><i class="align-middle" data-feather="corner-down-right"></i>All Tickets</a></li>
                {{-- <li class="sidebar-item" ><a class="sidebar-link" href="{{ route('admin_spin') }}"><i class="align-middle" data-feather="corner-down-right"></i>Add Spin</a></li> --}}
            </ul>
        </li>
        <li class="sidebar-item">
            <a href="#help" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
                <i class="align-middle" data-feather="grid"></i>
                <span class="align-middle">
                 FAQ
            </span>
            </a>
            <ul id="help" class="sidebar-dropdown list-unstyled collapse">
                <li class="sidebar-item" ><a class="sidebar-link" href="{{ route('Admin.FaqCategories') }}"><i class="align-middle" data-feather="corner-down-right"></i>FAQ Categories</a></li>
                <li class="sidebar-item" ><a class="sidebar-link" href="{{ route('Admin.FAQS') }}"><i class="align-middle" data-feather="corner-down-right"></i>FAQS</a></li>
                <li class="sidebar-item" ><a class="sidebar-link" href="{{ route('Admin.AddHelp') }}"><i class="align-middle" data-feather="corner-down-right"></i>Add New FAQ</a></li>
                {{-- <li class="sidebar-item" ><a class="sidebar-link" href="{{ route('admin_spin') }}"><i class="align-middle" data-feather="corner-down-right"></i>Add Spin</a></li> --}}
            </ul>
        </li>
   {{-- <li class="sidebar-item">
        <a href="#admin_panel" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
            <i class="align-middle" data-feather="grid"></i>
            <span class="align-middle">
                Admin Panel
            </span>
        </a>
        <ul id="admin_panel" class="sidebar-dropdown list-unstyled collapse">
--}}{{--

            <li class="sidebar-item" ><a class="sidebar-link" href="{{ route('admin_token') }}"><i class="align-middle" data-feather="corner-down-right"></i>Token</a></li>
--}}{{--

            --}}{{-- <li class="sidebar-item" ><a class="sidebar-link" href="{{ route('admin_spin') }}"><i class="align-middle" data-feather="corner-down-right"></i>Add Spin</a></li> --}}{{--
            <li class="sidebar-item" ><a class="sidebar-link" href="{{ route('currencyConversaton') }}"><i class="align-middle" data-feather="corner-down-right"></i>Play6 Token Currency</a></li>
            --}}{{-- <li class="sidebar-item" ><a class="sidebar-link" href="{{ route('system_settings') }}"><i class="align-middle" data-feather="corner-down-right"></i>System Settings</a></li> --}}{{--
        </ul>
    </li>--}}
    @endcan


    @can('Customer Information')
    <li class="sidebar-item">
        <a href="#customer_info" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
            <i class="align-middle" data-feather="grid"></i>
            <span class="align-middle">
                Customer Information
            </span>
        </a>
        <ul id="customer_info" class="sidebar-dropdown list-unstyled collapse">
            <li class="sidebar-item"><a class="sidebar-link" href="{{route('OnlinecustomerInfo')}}"><i class="align-middle" data-feather="corner-down-right"></i>Customers Online</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="{{route('customer_info')}}"><i class="align-middle" data-feather="corner-down-right"></i>Customer List</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="{{route('user.customer_search')}}"><i class="align-middle" data-feather="corner-down-right"></i>Customer Search</a></li>
        </ul>
    </li>
    @endcan
    @can('Bonus And Code')
    <li class="sidebar-item">
        <a href="#Bonus" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
            <i class="align-middle" data-feather="grid"></i>
            <span class="align-middle">
                Bonuses And Codes
            </span>
        </a>
        <ul id="Bonus" class="sidebar-dropdown list-unstyled collapse">
            <li class="sidebar-item"><a class="sidebar-link" href="{{route('add-bonus')}}"><i class="align-middle" data-feather="corner-down-right"></i>Bonus-Add</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('list-bonuses') }}"><i class="align-middle" data-feather="corner-down-right"></i>Bonus-List</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('BonusList') }}"><i class="align-middle" data-feather="corner-down-right"></i>ProperSix Bonus-List</a></li>
        </ul>
    </li>
    @endcan
    @can('VIP and Loyalty')
    <li class="sidebar-item">
        <a href="#Loyality" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
            <i class="align-middle" data-feather="grid"></i>
            <span class="align-middle">
                VIP and Loyalty
            </span>
        </a>
        <ul id="Loyality" class="sidebar-dropdown list-unstyled collapse">
            <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.general_setting')}}"><i class="align-middle" data-feather="corner-down-right"></i>General Settings</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.loyality_add')}}"><i class="align-middle" data-feather="corner-down-right"></i>Add Loyalty Tier</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="{{route('admin.loyality_list')}}"><i class="align-middle" data-feather="corner-down-right"></i>Loyalty</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('admin.add_shop') }}"><i class="align-middle" data-feather="corner-down-right"></i>VIP Shop–Add</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('admin.shop_list') }}"><i class="align-middle" data-feather="corner-down-right"></i>VIP Shop–List</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('admin.purchase_items') }}"><i class="align-middle" data-feather="corner-down-right"></i>VIP Purchased-Items</a></li>
        </ul>
    </li>
    @endcan
    @can('Missions')
    <li class="sidebar-item">
        <a href="#Misson" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
            <i class="align-middle" data-feather="grid"></i>
            <span class="align-middle">
               Missions
            </span>
        </a>
        <ul id="Misson" class="sidebar-dropdown list-unstyled collapse">
            {{-- <li class="sidebar-item" ><a class="sidebar-link" href="{{ route('admin.mission_type_list') }}"><i class="align-middle" data-feather="corner-down-right"></i>Mission T&C</a></li> --}}
            <li class="sidebar-item" ><a class="sidebar-link" href="{{ route('admin.add_mission') }}"><i class="align-middle" data-feather="corner-down-right"></i>Add Mission</a></li>
            <li class="sidebar-item" ><a class="sidebar-link" href="{{ route('admin.mission_list') }}"><i class="align-middle" data-feather="corner-down-right"></i>Mission Lists</a></li>
            <li class="sidebar-item" ><a class="sidebar-link" href="{{ route('admin.usermission') }}"><i class="align-middle" data-feather="corner-down-right"></i>User Mission Lists</a></li>
        </ul>
    </li>
    @endcan
  {{--   <li class="sidebar-item">
        <a href="#affiliates_panel" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
            <i class="align-middle" data-feather="grid"></i>
            <span class="align-middle">
                Affiliates Panel
            </span>
        </a>
        <ul id="affiliates_panel" class="sidebar-dropdown list-unstyled collapse">
            <li class="sidebar-item {{ (Request::is('dashboard/affiliate-settings/*') || Request::is('dashboard/affiliate-settings')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('affiliate-settings.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Affiliate Settings</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/completed-payments/*') || Request::is('dashboard/completed-payments')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('completed-payments.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Completed Payments</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/list-affiliates/*') || Request::is('dashboard/list-affiliates')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('list-affiliates.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>List Affiliates</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/send-payments/*') || Request::is('dashboard/send-payments')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('send-payments.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Send Payments</a></li>
        </ul>
    </li> --}}

 {{--    <li class="sidebar-item">
        <a href="#bonuses_and_codes" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
            <i class="align-middle" data-feather="grid"></i>
            <span class="align-middle">
                Bonuses And Codes
            </span>
        </a>
        <ul id="bonuses_and_codes" class="sidebar-dropdown list-unstyled collapse">
            <li class="sidebar-item" ><a class="sidebar-link" href="{{ route('RegistrationBonus') }}"><i class="align-middle" data-feather="corner-down-right"></i>Registration Bonus</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/activated-bonuses/*') || Request::is('dashboard/activated-bonuses')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('activated-bonuses.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Activated Bonuses</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/add-bonuses/*') || Request::is('dashboard/add-bonuses')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('add-bonuses.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Deposit Bonus Code-Add</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/list-bonuses/*') || Request::is('dashboard/list-bonuses')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('list-bonuses.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Deposit Bonus Codes-List</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/add-free-chips/*') || Request::is('dashboard/add-free-chips')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('add-free-chips.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Free Chips Add</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/add-rewards/*') || Request::is('dashboard/add-rewards')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('add-rewards.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Reward Code - Add</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/list-rewards/*') || Request::is('dashboard/list-rewards')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('list-rewards.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Reward Codes - List</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/add-shops/*') || Request::is('dashboard/add-shops')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('add-shops.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>VIP Shop Add</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/list-shops/*') || Request::is('dashboard/list-shops')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('list-shops.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>VIP Shop List</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/purchases-shops/*') || Request::is('dashboard/purchases-shops')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('purchases-shops.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>VIP Shop Purchases</a></li>
        </ul>
    </li> --}}
    @can('Casino Settings')
    <li class="sidebar-item">
        <a href="#casino_settings" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
            <i class="align-middle" data-feather="grid"></i>
            <span class="align-middle">
                Casino Settings
            </span>
        </a>
        <ul id="casino_settings" class="sidebar-dropdown list-unstyled collapse">
          {{--  <li class="sidebar-item {{ (Request::is('dashboard/admin-language/*') || Request::is('dashboard/admin-language')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('admin-language.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Admin Language</a></li>--}}
            {{-- <li class="sidebar-item {{ (Request::is('dashboard/casino-payout/*') || Request::is('dashboard/casino-payout')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('casino-payout.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Casino Payout Variables</a></li> --}}
            {{-- <li class="sidebar-item <!-- {{ (Request::is('dashboard/environment-settings/*') || Request::is('dashboard/environment-settings')) ? 'active':'' }} -->"><a class="sidebar-link" href="{{ route('environment-settings.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Environment Settings</a></li> --}}
            {{--<li class="sidebar-item"><a class="sidebar-link" href="{{ route('notify_Transaction_settings') }}"><i class="align-middle" data-feather="corner-down-right"></i>Notify Big Transaction</a></li>--}}
            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('general-settings.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>General Settings</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('affiliate-api-settings.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Affiliate API Settings</a></li>
            {{-- <li class="sidebar-item {{ (Request::is('dashboard/responsible-gaming/*') || Request::is('dashboard/responsible-gaming')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('responsible-gaming.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Responsible Gaming</a></li> --}}
            {{-- <li class="sidebar-item {{ (Request::is('dashboard/staff-access/*') || Request::is('dashboard/staff-access')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('staff-access.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Staff Access Levels</a></li> --}}
            {{-- <li class="sidebar-item {{ (Request::is('dashboard/system-limits/*') || Request::is('dashboard/system-limits')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('system-limits.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>System Limits</a></li> --}}
        </ul>
    </li>
        <li class="sidebar-item">
            <a href="#language_settings" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
                <i class="align-middle" data-feather="grid"></i>
                <span class="align-middle">
                Language Settings
            </span>
            </a>
            <ul id="language_settings" class="sidebar-dropdown list-unstyled collapse">
                <li class="sidebar-item"><a class="sidebar-link" href="{{ route('language-settings.keys') }}"><i class="align-middle" data-feather="corner-down-right"></i>Language Keys</a></li>
                <li class="sidebar-item"><a class="sidebar-link" href="{{ route('language-settings.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Language</a></li>
            </ul>
        </li>
    @endcan

    {{-- <li class="sidebar-item">
        <a href="#content_management" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
            <i class="align-middle" data-feather="grid"></i>
            <span class="align-middle">
                Content Management
            </span>
        </a>
        <ul id="content_management" class="sidebar-dropdown list-unstyled collapse">
            <li class="sidebar-item {{ (Request::is('dashboard/content-page-add/*') || Request::is('dashboard/content-page-add')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('content-page-add.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Content PageAdd</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/content-page-list/*') || Request::is('dashboard/content-page-list')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('content-page-list.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Content Pages List</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/email-templates-add/*') || Request::is('dashboard/email-templates-add')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('email-templates-add.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Email Templates Add</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/email-templates-list/*') || Request::is('dashboard/email-templates-list')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('email-templates-list.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Email Templates List</a></li>
           <li class="sidebar-item {{ (Request::is('dashboard/layout-section/*') || Request::is('dashboard/layout-section')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('layout-section.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Layout Sections</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/link-manager/*') || Request::is('dashboard/link-manager')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('link-manager.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Web 2.0 Link Manager</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/template-map/*') || Request::is('dashboard/template-map')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('template-map.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Web Template Map</a></li>
        </ul>
    </li> --}}
    @can('Finances')
    <li class="sidebar-item">
        <a href="#finances" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
            <i class="align-middle" data-feather="grid"></i>
            <span class="align-middle">
                Finances
            </span>
        </a>
        <ul id="finances" class="sidebar-dropdown list-unstyled collapse">
            {{-- <li class="sidebar-item {{ (Request::is('dashboard/credit-transfers/*') || Request::is('dashboard/credit-transfers')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('credit-transfers.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Credit Transfers</a></li> --}}
            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('deposits.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Deposits</a></li>
            {{-- <li class="sidebar-item {{ (Request::is('dashboard/financial-events/*') || Request::is('dashboard/financial-events')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('financial-events.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Financial Events</a></li> --}}
            {{-- <li class="sidebar-item {{ (Request::is('dashboard/my-earnings/*') || Request::is('dashboard/my-earnings')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('my-earnings.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>My Earnings</a></li> --}}
            {{-- <li class="sidebar-item {{ (Request::is('dashboard/payment-methods/*') || Request::is('dashboard/payment-methods')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('payment-methods.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Payment Methods</a></li> --}}
            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('withdrawals.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Withdrawals</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('withdrawals.affiliate') }}"><i class="align-middle" data-feather="corner-down-right"></i>Affiliate Withdrawals</a></li>
        </ul>
    </li>
    @endcan
    @can('Games Management')
    <li class="sidebar-item">
        <a href="#games_management" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
            <i class="align-middle" data-feather="grid"></i>
            <span class="align-middle">
                Games Management
            </span>
        </a>
        <ul id="games_management" class="sidebar-dropdown list-unstyled collapse">
            {{--<li class="sidebar-item {{ (Request::is('dashboard/achievement-list/*') || Request::is('dashboard/achievement-list')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('achievement-list.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Achievements List</a></li>--}}
            <li class="sidebar-item {{ (Request::is('dashboard/add-games/*') || Request::is('dashboard/add-games')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('add-games.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>All Games</a></li>
            @php
                $games = App\AddGame::orderBy('id', 'desc')->get();
            @endphp
            @foreach($games as $itme)
            <li class="sidebar-item {{ (Request::is('dashboard/games-name/'.$itme->game_file)) ? 'active':'' }}"><a class="sidebar-link" href="{{route('single_game',$itme->game_file) }}"><i class="align-middle" data-feather="corner-down-right"></i>{{ $itme->game_title }}</a></li>
            @endforeach
        </ul>
    </li>
        <li class="sidebar-item">
            <a href="#reports" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
                <i class="align-middle" data-feather="grid"></i>
                <span class="align-middle">
                    Reports
                </span>
            </a>
            <ul id="reports" class="sidebar-dropdown list-unstyled collapse">
                <li class="sidebar-item {{ (Request::is('dashboard/taxed-game-plays/*') || Request::is('dashboard/taxed-game-plays')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('deposit-report') }}"><i class="align-middle" data-feather="corner-down-right"></i>Deposit Report</a></li>
            </ul>
        </li>
    {{-- <li class="sidebar-item"> --}}
            {{-- <a href="#softswiss_games" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
                <i class="align-middle" data-feather="grid"></i>
                <span class="align-middle">
                Softswiss Games
            </span>
            </a> --}}
            {{-- <ul id="softswiss_games" class="sidebar-dropdown list-unstyled collapse"> --}}
                {{--<li class="sidebar-item {{ (Request::is('dashboard/achievement-list/*') || Request::is('dashboard/achievement-list')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('achievement-list.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Achievements List</a></li>--}}
                {{-- <li class="sidebar-item {{ (Request::is('dashboard/softswiss-categories/*') || Request::is('dashboard/softswiss-categories')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('softswissCategories') }}"><i class="align-middle" data-feather="corner-down-right"></i>All Categories</a></li> --}}
                {{-- <li class="sidebar-item {{ (Request::is('dashboard/softswiss-games/*') || Request::is('dashboard/softswiss-games')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('softswissGames') }}"><i class="align-middle" data-feather="corner-down-right"></i>All Games</a></li> --}}
            {{-- </ul> --}}
        {{-- </li> --}}
    @endcan

      {{-- <li class="sidebar-item">
        <a href="#lottery_rng" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
                <i class="align-middle" data-feather="grid"></i>
                <span class="align-middle">
                    Lottery Rng
                </span>
            </a>
            <ul id="lottery_rng" class="sidebar-dropdown list-unstyled collapse">
                <li class="sidebar-item {{ (Request::is('dashboard/earnings/*') || Request::is('dashboard/earnings')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('earnings.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Earnings</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/generate-lottery-ticket/*') || Request::is('dashboard/generate-lottery-ticket')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('generate-lottery-ticket.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Generate Lottery Ticket</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/list-lottery-tickets/*') || Request::is('dashboard/list-lottery-tickets')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('list-lottery-tickets.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>List Lottery tickets</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/prizes-grant-prize/*') || Request::is('dashboard/prizes-grant-prize')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('prizes-grant-prize.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Prizes - Grant Prize</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/list-prizes/*') || Request::is('dashboard/list-prizes')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('list-prizes.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Prizes - List All Prizes</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/prize-settings/*') || Request::is('dashboard/prize-settings')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('prize-settings.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Settings</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/view-results/*') || Request::is('dashboard/view-results')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('view-results.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>View Results</a></li>
            </ul>
        </li>

        <li class="sidebar-item">
            <a href="#maintenance" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
                <i class="align-middle" data-feather="grid"></i>
                <span class="align-middle">
                    Maintenance
                </span>
            </a>
            <ul id="maintenance" class="sidebar-dropdown list-unstyled collapse">
                <li class="sidebar-item {{ (Request::is('dashboard/backup-databases/*') || Request::is('dashboard/backup-databases')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('backup-databases.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Backup Database</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/build-images/*') || Request::is('dashboard/build-images')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('build-images.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Build images</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/clear-financial-records/*') || Request::is('dashboard/clear-financial-records')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('clear-financial-records.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Clear Financial Records</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/clear-gameplay-records/*') || Request::is('dashboard/clear-gameplay-records')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('clear-gameplay-records.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Clear Gameplays Records</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/clear-logins/*') || Request::is('dashboard/clear-logins')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('clear-logins.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Clear Login History Logs</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/clear-staff-logs/*') || Request::is('dashboard/clear-staff-logs')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('clear-staff-logs.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Clear All Staff Logs</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/clear-blacklist-ips/*') || Request::is('dashboard/clear-blacklist-ips')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('clear-blacklist-ips.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Clear Blacklist and IP</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/clear-multiplayers/*') || Request::is('dashboard/clear-multiplayers')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('clear-multiplayers.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Clear Multiplayer Entries</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/clear-tournaments/*') || Request::is('dashboard/clear-tournaments')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('clear-tournaments.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Clear Tournament</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/clear-messages/*') || Request::is('dashboard/clear-messages')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('clear-messages.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Clear All Messages</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/file-integrity-lists/*') || Request::is('dashboard/file-integrity-lists')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('file-integrity-lists.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>File Integrity List</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/reset-all-banks/*') || Request::is('dashboard/reset-all-banks')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('reset-all-banks.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Reset all Banks</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/reset-all-jackpots/*') || Request::is('dashboard/reset-all-jackpots')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('reset-all-jackpots.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Reset all Jackpots</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/reset-casinos/*') || Request::is('dashboard/reset-casinos')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('reset-casinos.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Reset casino</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/services-health-monitor/*') || Request::is('dashboard/services-health-monitor')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('services-health-monitor.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Server Health and Monitor</a></li>
            </ul>
        </li>

        <li class="sidebar-item">
            <a href="#multi_slot_tournaments" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
                <i class="align-middle" data-feather="grid"></i>
                <span class="align-middle">
                    Multi-Slot Tournaments
                </span>
            </a>
            <ul id="multi_slot_tournaments" class="sidebar-dropdown list-unstyled collapse">
                <li class="sidebar-item {{ (Request::is('dashboard/create-tournaments/*') || Request::is('dashboard/create-tournaments')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('create-tournaments.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Create Tournament</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/free-mass-tickets/*') || Request::is('dashboard/free-mass-tickets')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('free-mass-tickets.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Give Free Mass tickets</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/free-tickets/*') || Request::is('dashboard/free-tickets')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('free-tickets.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Give Free Ticket</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/list-tournaments/*') || Request::is('dashboard/list-tournaments')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('list-tournaments.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>List Tournaments</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/settings/*') || Request::is('dashboard/settings')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('settings.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Settings</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/tournament-gameplays/*') || Request::is('dashboard/tournament-gameplays')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('tournament-gameplays.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Tournament Gameplays</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/view-all-tickets/*') || Request::is('dashboard/view-all-tickets')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('view-all-tickets.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>View All tickets</a></li>
            </ul>
        </li>


        <li class="sidebar-item">
            <a href="#multiplayer_bingo_live" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
                <i class="align-middle" data-feather="grid"></i>
                <span class="align-middle">
                    Multiplayer Bingo Live
                </span>
            </a>
            <ul id="multiplayer_bingo_live" class="sidebar-dropdown list-unstyled collapse">
                <li class="sidebar-item {{ (Request::is('dashboard/bingo-settings/*') || Request::is('dashboard/bingo-settings')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('bingo-settings.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Settings</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/view-bingo-tickets/*') || Request::is('dashboard/view-bingo-tickets')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('view-bingo-tickets.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>View All tickets</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/view-bingo-results/*') || Request::is('dashboard/view-bingo-results')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('view-bingo-results.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>View Results</a></li>
            </ul>
        </li>

        <li class="sidebar-item">
            <a href="#multiplayer_card" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
                <i class="align-middle" data-feather="grid"></i>
                <span class="align-middle">
                    Multiplayer Card
                </span>
            </a>
            <ul id="multiplayer_card" class="sidebar-dropdown list-unstyled collapse">
                <li class="sidebar-item {{ (Request::is('dashboard/card-settings/*') || Request::is('dashboard/card-settings')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('card-settings.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Settings</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/view-bets/*') || Request::is('dashboard/view-bets')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('view-bets.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>View Bets</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/card-view-results/*') || Request::is('dashboard/card-view-results')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('card-view-results.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>View Results</a></li>
            </ul>
        </li>


        <li class="sidebar-item">
            <a href="#multiplayer_races" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
                <i class="align-middle" data-feather="grid"></i>
                <span class="align-middle">
                    Multiplayer Races
                </span>
            </a>
            <ul id="multiplayer_races" class="sidebar-dropdown list-unstyled collapse">
                <li class="sidebar-item {{ (Request::is('dashboard/races-settings/*') || Request::is('dashboard/races-settings')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('races-settings.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Settings</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/races-view-bets/*') || Request::is('dashboard/races-view-bets')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('races-view-bets.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>View Bets</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/races-view-results/*') || Request::is('dashboard/races-view-results')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('races-view-results.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>View Results</a></li>
            </ul>
        </li>

        <li class="sidebar-item">
            <a href="#multiplayer_roulette" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
                <i class="align-middle" data-feather="grid"></i>
                <span class="align-middle">
                    Multiplayer Roulette
                </span>
            </a>
            <ul id="multiplayer_roulette" class="sidebar-dropdown list-unstyled collapse">
                <li class="sidebar-item {{ (Request::is('dashboard/roulette-settings/*') || Request::is('dashboard/roulette-settings')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('roulette-settings.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Settings</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/roulette-view-bets/*') || Request::is('dashboard/roulette-view-bets')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('roulette-view-bets.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>View Bets</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/roulette-view-results/*') || Request::is('dashboard/roulette-view-results')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('roulette-view-results.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>View Results</a></li>
            </ul>
        </li>

        <li class="sidebar-item">
            <a href="#multiplayer_sicbo" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
                <i class="align-middle" data-feather="grid"></i>
                <span class="align-middle">
                    Multiplayer Sicbo
                </span>
            </a>
            <ul id="multiplayer_sicbo" class="sidebar-dropdown list-unstyled collapse">
                <li class="sidebar-item {{ (Request::is('dashboard/sicbo-settings/*') || Request::is('dashboard/sicbo-settings')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('sicbo-settings.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Settings</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/sicbo-view-bets/*') || Request::is('dashboard/sicbo-view-bets')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('sicbo-view-bets.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>View Bets</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/sicbo-view-results/*') || Request::is('dashboard/sicbo-view-results')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('sicbo-view-results.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>View Results</a></li>
            </ul>
        </li>

        <li class="sidebar-item">
            <a href="#reports" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
                <i class="align-middle" data-feather="grid"></i>
                <span class="align-middle">
                    Reports
                </span>
            </a>
            <ul id="reports" class="sidebar-dropdown list-unstyled collapse">
                <li class="sidebar-item {{ (Request::is('dashboard/balance-adjustment/*') || Request::is('dashboard/balance-adjustment')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('balance-adjustment.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Account Balance</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/change-notification/*') || Request::is('dashboard/change-notification')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('change-notification.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Change Notification</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/dormant-account/*') || Request::is('dashboard/dormant-account')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('dormant-account.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Dormant Account</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/performance-payout/*') || Request::is('dashboard/performance-payout')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('performance-payout.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Performance Payout</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/performance-report/*') || Request::is('dashboard/performance-report')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('performance-report.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Performance Report</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/revenue-report/*') || Request::is('dashboard/revenue-report')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('revenue-report.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Revenue Report</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/account-exclusions-report/*') || Request::is('dashboard/account-exclusions-report')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('account-exclusions-report.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Account Exclusions</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/account-lock/*') || Request::is('dashboard/account-lock')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('account-lock.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Account Lock</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/player-deactivations/*') || Request::is('dashboard/player-deactivations')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('player-deactivations.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Player Deactivations</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/player-sessions/*') || Request::is('dashboard/player-sessions')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('player-sessions.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Player Session</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/jackpot-config/*') || Request::is('dashboard/jackpot-config')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('jackpot-config.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Jackpot Config</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/jackpot-wons/*') || Request::is('dashboard/jackpot-wons')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('jackpot-wons.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Jackpot Won</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/account-summary/*') || Request::is('dashboard/account-summary')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('account-summary.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Account Summary</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/significant-event/*') || Request::is('dashboard/significant-event')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('significant-event.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Significant Event</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/event-reports/*') || Request::is('dashboard/event-reports')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('event-reports.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Event Sum.Report</a></li>
                <li class="sidebar-item {{ (Request::is('dashboard/taxed-game-plays/*') || Request::is('dashboard/taxed-game-plays')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('taxed-game-plays.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Taxed gameplays</a></li>
            </ul>
        </li>
     --}}
     @can('Security')

    <li class="sidebar-item">
        <a href="#security" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
            <i class="align-middle" data-feather="grid"></i>
            <span class="align-middle">
                Security
            </span>
        </a>
        <ul id="security" class="sidebar-dropdown list-unstyled collapse">
            {{-- <li class="sidebar-item"><a class="sidebar-link" href="{{ route('blacklist-add.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>BlackList - Add</a></li> --}}
            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('black-list.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Blacklist - List</a></li>
            {{-- <li class="sidebar-item"><a class="sidebar-link" href="{{ route('ban-ip.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>IP - Ban IP</a></li> --}}
            {{-- <li class="sidebar-item"><a class="sidebar-link" href="{{ route('banedip-list.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>IP - List banned IP</a></li> --}}
            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('AccountDetectors.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Accounts - Detector</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="{{ url('dash-panel/detect-ips') }}"><i class="align-middle" data-feather="corner-down-right"></i>IP's - Detector</a></li>
        </ul>
    </li>
    @endcan
    @can('Admin panel')
{{--    <li class="sidebar-item">--}}
{{--        <a href="#subscription" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">--}}
{{--            <i class="align-middle" data-feather="grid"></i>--}}
{{--            <span class="align-middle">--}}
{{--                Subscriptions--}}
{{--            </span>--}}
{{--        </a>--}}
{{--        <ul id="subscription" class="sidebar-dropdown list-unstyled collapse">--}}
{{--            <li class="sidebar-item"><a class="sidebar-link" href="{{ url('dash-panel/subscribers') }}"><i class="align-middle" data-feather="corner-down-right"></i>Subscribers - List</a></li>--}}
{{--            <li class="sidebar-item"><a class="sidebar-link" href="{{ url('dash-panel/statistic-report') }}"><i class="align-middle" data-feather="corner-down-right"></i>Today's - Statistics</a></li>--}}
{{--        </ul>--}}
{{--    </li>--}}
        <li class="sidebar-item">
            <a href="#backups" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
                <i class="align-middle" data-feather="grid"></i>
                <span class="align-middle">
                Backups
            </span>
            </a>
            <ul id="backups" class="sidebar-dropdown list-unstyled collapse">
                <li class="sidebar-item"><a class="sidebar-link" href="{{ url('dash-panel/backup-list') }}"><i class="align-middle" data-feather="corner-down-right"></i>DB - Backup List</a></li>
            </ul>
        </li>
    @endcan
{{--
    <li class="sidebar-item">
        <a href="#sports_book" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
            <i class="align-middle" data-feather="grid"></i>
            <span class="align-middle">
                Sports Book
            </span>
        </a>
        <ul id="sports_book" class="sidebar-dropdown list-unstyled collapse">
            <li class="sidebar-item {{ (Request::is('dashboard/configure-feed/*') || Request::is('dashboard/configure-feed')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('configure-feed.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Configure Feed</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/configure-leagues/*') || Request::is('dashboard/configure-leagues')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('configure-leagues.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Configure Leagues</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/maintenance/*') || Request::is('dashboard/maintenance')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('maintenance.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Maintenance</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/reevaluate-tickets/*') || Request::is('dashboard/reevaluate-tickets')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('reevaluate-tickets.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Re-evaluate tickets</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/sports-settings/*') || Request::is('dashboard/sports-settings')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('sports-settings.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Settings</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/sports-view-events/*') || Request::is('dashboard/sports-view-events')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('sports-view-events.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>View Events</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/sports-view-tickets/*') || Request::is('dashboard/sports-view-tickets')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('sports-view-tickets.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>View tickets</a></li>
        </ul>
    </li> --}}
    @can('Staff Management')
{{--    <li class="sidebar-item">--}}
{{--        <a href="#staff_management" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">--}}
{{--            <i class="align-middle" data-feather="grid"></i>--}}
{{--            <span class="align-middle">--}}
{{--                Staff Management--}}
{{--            </span>--}}
{{--        </a>--}}
{{--        <ul id="staff_management" class="sidebar-dropdown list-unstyled collapse">--}}
{{--            <li class="sidebar-item {{ (Request::is('dashboard/create-agent/*') || Request::is('dashboard/create-agent')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('create-agent.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Create Agent</a></li>--}}
{{--            <li class="sidebar-item {{ (Request::is('dashboard/create-agent/*') || Request::is('dashboard/create-agent')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('create-agent.list') }}"><i class="align-middle" data-feather="corner-down-right"></i>Agent list</a></li>--}}
{{--            <li class="sidebar-item {{ (Request::is('dashboard/create-agent/*') || Request::is('dashboard/create-agent')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('create-agent.logs') }}"><i class="align-middle" data-feather="corner-down-right"></i>Agent logs</a></li>--}}
{{--            <li class="sidebar-item {{ (Request::is('dashboard/create-operator/*') || Request::is('dashboard/create-operator')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('create-operator.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Create Operator</a></li>--}}
{{--            <li class="sidebar-item {{ (Request::is('dashboard/create-agent/*') || Request::is('dashboard/create-agent')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('create-operator.list') }}"><i class="align-middle" data-feather="corner-down-right"></i>Operator list</a></li>--}}
{{--            <li class="sidebar-item {{ (Request::is('dashboard/create-agent/*') || Request::is('dashboard/create-agent')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('create-operator.logs') }}"><i class="align-middle" data-feather="corner-down-right"></i>Operator logs</a></li>--}}
{{--            --}}{{-- <li class="sidebar-item {{ (Request::is('dashboard/list-agents/*') || Request::is('dashboard/list-agents')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('list-agents.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>List Agents</a></li> --}}
{{--            --}}{{-- <li class="sidebar-item {{ (Request::is('dashboard/list-operator/*') || Request::is('dashboard/list-operator')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('list-operator.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>List Operators</a></li> --}}
{{--            --}}{{-- <li class="sidebar-item {{ (Request::is('dashboard/login-history-staff/*') || Request::is('dashboard/login-history-staff')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('login-history-staff.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Login History - Staff</a></li> --}}
{{--            --}}{{-- <li class="sidebar-item {{ (Request::is('dashboard/search-staff/*') || Request::is('dashboard/search-staff')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('search-staff.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Search Staff</a></li> --}}
{{--            --}}{{-- <li class="sidebar-item {{ (Request::is('dashboard/transfer-funds-to-agents/*') || Request::is('dashboard/transfer-funds-to-agents')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('transfer-funds-to-agents.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Transfer Funds to Agent</a></li> --}}
{{--        </ul>--}}
{{--    </li>--}}
    @endcan
    {{-- <li class="sidebar-item">
        <a href="#statistics" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
            <i class="align-middle" data-feather="grid"></i>
            <span class="align-middle">
                Statistics
            </span>
        </a>
        <ul id="statistics" class="sidebar-dropdown list-unstyled collapse">
            <li class="sidebar-item {{ (Request::is('dashboard/casino-activity/*') || Request::is('dashboard/casino-activity')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('casino-activity.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Casino Activity</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/game-volatility/*') || Request::is('dashboard/game-volatility')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('game-volatility.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Chart - Game Volatility</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/overall-activity/*') || Request::is('dashboard/overall-activity')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('overall-activity.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Chart - Overall Activity</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/chart-profit/*') || Request::is('dashboard/chart-profit')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('chart-profit.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Chart - Profit</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/deposits-withdrawals/*') || Request::is('dashboard/deposits-withdrawals')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('deposits-withdrawals.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Deposits/Withdrawals</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/signup-conversions/*') || Request::is('dashboard/signup-conversions')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('signup-conversions.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Signups Conversions</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/statistics-dashboard/*') || Request::is('dashboard/statistics-dashboard')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('statistics-dashboard.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Dashboard</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/conversion-rates/*') || Request::is('dashboard/conversion-rates')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('conversion-rates.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Games Conversion Rates</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/disabled-users/*') || Request::is('dashboard/disabled-users')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('disabled-users.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>GeoMap - Disabled Users</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/gameplay-statistics/*') || Request::is('dashboard/gameplay-statistics')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('gameplay-statistics.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>User gameplays statistics</a></li>
        </ul>
    </li> --}}
    @role('Super Admin')
    <li class="sidebar-item">
        <a href="#role_management" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
            <i class="align-middle" data-feather="grid"></i>
            <span class="align-middle">
                Role And Permissions
            </span>
        </a>
        <ul id="role_management" class="sidebar-dropdown list-unstyled collapse">
            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('roles.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Roles</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('permissions.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Permissions</a></li>
        </ul>
    </li>
    @endrole
    @can('User Management')
    <li class="sidebar-item">
        <a href="#user_management" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
            <i class="align-middle" data-feather="grid"></i>
            <span class="align-middle">
                User Management
            </span>
        </a>
        <ul id="user_management" class="sidebar-dropdown list-unstyled collapse">
            <li class="sidebar-item"><a class="sidebar-link" href="{{route('users.index')}}"><i class="align-middle" data-feather="corner-down-right"></i>Admin User</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('create-users.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Create User</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/list-users/*') || Request::is('dashboard/list-users')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('list-users.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Users List</a></li>
            <li class="sidebar-item"><a class="sidebar-link" href="{{ route('admin.list_documents') }}"><i class="align-middle" data-feather="corner-down-right"></i>Users Document</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/loggedin-users/*') || Request::is('dashboard/loggedin-users')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('loggedin-users.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Logged-In Users</a></li>
            {{-- <li class="sidebar-item {{ (Request::is('dashboard/loggedin-history-users/*') || Request::is('dashboard/loggedin-history-users')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('loggedin-history-users.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Login History - Users</a></li> --}}
            {{-- <li class="sidebar-item {{ (Request::is('dashboard/list-messages/*') || Request::is('dashboard/list-messages')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('list-messages.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>List all messages</a></li> --}}
            {{-- <li class="sidebar-item {{ (Request::is('dashboard/send-messages/*') || Request::is('dashboard/send-messages')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('send-messages.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Send msg to user</a></li> --}}
            {{-- <li class="sidebar-item {{ (Request::is('dashboard/multi-account/*') || Request::is('dashboard/multi-account')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('multi-account.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Multi Account Detector</a></li> --}}
            {{-- <li class="sidebar-item {{ (Request::is('dashboard/multiip-detector/*') || Request::is('dashboard/multiip-detector')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('multiip-detector.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Multi Login IP Detector</a></li> --}}
        </ul>
    </li>
    @endcan
    {{-- <li class="sidebar-item">
        <a href="#other" data-toggle="collapse" class="font-weight-bold sidebar-link collapsed">
            <i class="align-middle" data-feather="grid"></i>
            <span class="align-middle">
                Other
            </span>
        </a>
        <ul id="other" class="sidebar-dropdown list-unstyled collapse">
            <li class="sidebar-item {{ (Request::is('dashboard/list-support-tickets/*') || Request::is('dashboard/list-support-tickets')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('list-support-tickets.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>List all support tickets</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/list-misc-logs/*') || Request::is('dashboard/list-misc-logs')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('list-misc-logs.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>List misc logs</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/send-newsletter/*') || Request::is('dashboard/send-newsletter')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('send-newsletter.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Newsletter</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/system-event-add/*') || Request::is('dashboard/system-event-add')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('system-event-add.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>System events - Add</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/system-event-list/*') || Request::is('dashboard/system-event-list')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('system-event-list.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>System events - List</a></li>
            <li class="sidebar-item {{ (Request::is('dashboard/upload-site-map/*') || Request::is('dashboard/upload-site-map')) ? 'active':'' }}"><a class="sidebar-link" href="{{ route('upload-site-map.index') }}"><i class="align-middle" data-feather="corner-down-right"></i>Upload Sitemap</a></li>
        </ul>
    </li> --}}


    <li class="sidebar-item">
        <a class="sidebar-link" href="#"
           onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
            <i class="align-middle" data-feather="log-out"></i>
            Logout
        </a>
        <form id="logout-form-sidebar" action="#" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
</ul>
