<?php
use Carbon\Carbon;
use App\Http\Controllers\AESCipher;
$aes = new AESCipher;
?>
<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4"
    id="sidenav-main" data-color="danger">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="home'"
            target="_blank">
            <img src="./img/favicon.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-3 font-weight-bold">
            @if (empty(session('storename')))
                Super Admin
            @else
                {{ session('storename') }}                
            @endif
            </span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(),'dashboard') == true ? 'active' : '' }}" href="dashboard">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-tv text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">DASHBOARD</span>
                </a>
            </li>
            <li class="nav-item mt-3 d-flex align-items-center">
                <h4 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Accounts</h4>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(),'profile') == true ? 'active' : '' }}" href="profile">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">PROFILE</span>
                </a>
            </li>
            @if (session('role') == 1)
            <li class="nav-item mt-3 d-flex align-items-center">
                <h4 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">SUPER ADMIN</h4>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'user-management') == true ? 'active' : '' }}" href="user-management">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-users text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">USER MANAGEMENT</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'storebranch') == true ? 'active' : '' }}" href="storebranch">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-store text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">STORE BRANCH</span>
                </a>
            </li>
            @endif
            @if (session('role') != 1)
            <li class="nav-item mt-3">
                <h4 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">ADD ITEM TYPE</h4>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'itemcatergory') == true ? 'active' : '' }}" href="itemcatergory">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-shopping-cart text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">ITEM TYPE</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h4 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">ITEM CATEGORY</h4>
            </li>
            @foreach ($itemtype as $item)
                <li class="nav-item">
                    <form action="items" method="GET">
                        <input type="hidden" value="{{ $aes->encrypt($item->id) }}" name="itemtype">
                        <input type="hidden" value="{{ $item->itemtypename }}" name="itemname">
                        <button type="submit" class="nav-link border-0 bg-white w-100">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-box-2 text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">{{ $item->itemtypename }}</span>
                        </button>
                    </form>
                </li>
            @endforeach
            @endif
        </ul>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.nav-link').click(function() {
            $('.nav-link').removeClass('active');
            $(this).addClass('active');
            });
        });
    </script>
</aside>

