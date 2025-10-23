<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">MJS</a>
            <a href="#" class="simple-text logo-normal">PT. Maju Jaya Sentosa</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="dashboard">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#laravel-examples" aria-expanded="true">
                    <i class="fab fa-laravel" ></i>
                    <span class="nav-link-text" >{{ __('User Managements') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="laravel-examples">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'roles') class="active " @endif>
                            <a href="{{ route('roles.index') }}">
                                <i class="tim-icons icon-single-02"></i>
                                <p>{{ __('User Roles') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'users') class="active " @endif>
                            <a href="{{ route('users.index') }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('User Profile') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li @if ($pageSlug == 'icons') class="active " @endif>
                <a href="/product-types">
                    <i class="tim-icons icon-atom"></i>
                    <p>Product Type</p>
                </a>
            </li>
            <li @if ($pageSlug == 'maps') class="active " @endif>
                <a href="/products">
                    <i class="tim-icons icon-pin"></i>
                    <p>Product</p>
                </a>
            </li>
            <li @if ($pageSlug == 'receipts') class="active " @endif>
                <a href="{{ route('receipts.index') }}">
                    <i class="tim-icons icon-bell-55"></i>
                    <p>Receipt</p>
                </a>
            </li>
        </ul>
    </div>
</div>
