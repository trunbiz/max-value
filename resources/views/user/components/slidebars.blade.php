<nav class="sidebar-main">
    <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
    <div id="sidebar-menu">
        <ul class="sidebar-links" id="simple-bar">
            <li class="back-btn"><a href="index.html"><img class="img-fluid" alt=""></a>
                <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                                                      aria-hidden="true"> </i></div>
            </li>

            <li class="sidebar-list">
                <label class="badge badge-light-danger">Latest</label>
                <a
                    class="sidebar-link sidebar-title link-nav" href="/dashboard">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                    <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                </a>
            </li>

            <li class="sidebar-list">
                <a
                    class="sidebar-link sidebar-title link-nav" href="/websites">
                    <i class="fa-solid fa-globe"></i>
                    <span>Websites</span>
                    <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                </a>
            </li>


            <li class="sidebar-list">
                <a
                    class="sidebar-link sidebar-title link-nav" href="/advs">
                    <i class="fa-solid fa-rectangle-ad"></i>
                    <span>Zones</span>
                    <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                </a>
            </li>

            <li class="sidebar-list">
                <a
                    class="sidebar-link sidebar-title link-nav" href="/reports{{'begin' . \Carbon\Carbon::now()->toDateString(). '&end' . \Carbon\Carbon::now()->toDateString()}}">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Reports</span>
                    <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                </a>
            </li>

            <li class="sidebar-list">
                <a class="sidebar-link sidebar-title" href="javascript:void(0)" data-bs-original-title="" title="">
                    <i class="fa-solid fa-dollar-sign"></i>
                    <span class="">Finance</span>
                </a>
                <ul class="sidebar-submenu" style="display: none;">

                    <li class="sidebar-list">
                        <a
                            class="sidebar-link sidebar-title link-nav" href="/wallet">
                            <i class="fa-solid fa-wallet"></i>
                            <span>Wallet</span>
                            <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a
                            class="sidebar-link sidebar-title link-nav" href="/payment">
                            <i class="fa-solid fa-money-bill"></i>
                            <span>Payment</span>
                            <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a
                            class="sidebar-link sidebar-title link-nav" href="/transections">
                            <i class="fa-solid fa-money-bill"></i>
                            <span>Transections</span>
                            <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="sidebar-list">
                <label class="badge badge-light-danger">{{\App\Models\NotificationCustom::count()}}</label>
                <a
                    class="sidebar-link sidebar-title link-nav" href="/notification">
                    <i class="fa-regular fa-bell"></i>
                    <span>Notification</span>
                    <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                </a>
            </li>

            <li class="sidebar-list">
                <a
                    class="sidebar-link sidebar-title link-nav" href="/contacts">
                    <i class="fa-regular fa-envelope"></i>
                    <span>Contact</span>
                    <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                </a>
            </li>

            <li class="sidebar-list">
                <a class="sidebar-link sidebar-title" href="javascript:void(0)" data-bs-original-title="" title="">
                    <i class="fa-solid fa-gear"></i>
                    <span class="">Setting</span>
                </a>
                <ul class="sidebar-submenu" style="display: none;">

                    <li class="sidebar-list">
                        <a
                            class="sidebar-link sidebar-title link-nav" href="/password">
                            <i class="fa-solid fa-key"></i>
                            <span>Password</span>
                        </a>
                    </li>

                    <li class="sidebar-list">
                        <a
                            class="sidebar-link sidebar-title link-nav" href="{{route('user.logout')}}">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Logout</span>
                        </a>
                    </li>

                </ul>
            </li>



        </ul>
    </div>
    <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
</nav>
