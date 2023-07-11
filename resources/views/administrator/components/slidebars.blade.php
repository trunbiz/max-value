<nav class="sidebar-main">
    <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
    <div id="sidebar-menu">
        <ul class="sidebar-links" id="simple-bar">
            <li class="back-btn"><a href="index.html"><img class="img-fluid" alt=""></a>
                <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                                                      aria-hidden="true"> </i></div>
            </li>

            <li class="sidebar-list">
                <label class="badge badge-light-danger">Latest </label>
                <a
                    class="sidebar-link sidebar-title link-nav" href="/administrator/dashboard">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                    <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                </a>
            </li>

            @can('users-list')
                <li class="sidebar-list">
                    <a
                        class="sidebar-link sidebar-title link-nav" href="/administrator/publishers">
                        <i class="fas fa-thin fa-users"></i>
                        <span>Publishers</span>
                        <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                    </a>
                </li>
            @endcan

{{--            @can('ads-list')--}}
{{--                <li class="sidebar-list">--}}
{{--                    <a--}}
{{--                        class="sidebar-link sidebar-title link-nav" href="/administrator/ads">--}}
{{--                        <i class="fa-solid fa-fire"></i>--}}
{{--                        <span>Campaign</span>--}}
{{--                        <div class="according-menu"><i class="fa fa-angle-right"></i></div>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            @endcan--}}

            @can('websites-list')
                <li class="sidebar-list">
                    <a
                        class="sidebar-link sidebar-title link-nav" href="/administrator/websites">
                        <i class="fa-solid fa-globe"></i>
                        <span>Website</span>
                        <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                    </a>
                </li>
            @endcan

            @can('advertises-list')
                <li class="sidebar-list">
                    <a
                        class="sidebar-link sidebar-title link-nav" href="/administrator/zones">
                        <i class="fa-solid fa-rectangle-ad"></i>
                        <span>Zones</span>
                        <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                    </a>
                </li>
            @endcan

            @can('reports-list')
                <li class="sidebar-list">
                    <a
                        class="sidebar-link sidebar-title link-nav" href="/administrator/reports">
                        <i class="fa-solid fa-chart-line"></i>
                        <span>Reports</span>
                        <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                    </a>
                </li>
            @endcan

            @can('partners-list')
                <li class="sidebar-list">
                    <a
                        class="sidebar-link sidebar-title link-nav" href="/administrator/partner">
                        <i class="fas fa-thin fa-users"></i>
                        <span>Partner</span>
                        <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                    </a>
                </li>
            @endcan

            @can('withdraw_users-list')
                <li class="sidebar-list">
                    <label
                        class="badge badge-light-danger">{{\App\Models\WithdrawUser::where('withdraw_status_id', 1)->count()}} </label>
                    <a
                        class="sidebar-link sidebar-title link-nav" href="/administrator/wallet/?withdraw_status_id=1">
                        <i class="fa-solid fa-dollar-sign"></i>
                        <span>Wallet</span>
                        <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                    </a>
                </li>
            @endcan

            @can('contacts-list')
                <li class="sidebar-list">
                    @if(\App\Models\Contact::where('status', 1)->count() > 0)
                        <label class="badge badge-light-danger" id="updateMes">{{\App\Models\Contact::where('status', 1)->count()}}</label>
                    @endif
                    <a
                        class="sidebar-link sidebar-title link-nav" href="/administrator/contacts">
                        <i class="fa-solid fa-envelope"></i>
                        <span>Messages</span>
                        <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                    </a>
                </li>
            @endcan

            <li class="sidebar-list">
                <a class="sidebar-link sidebar-title" href="javascript:void(0)" data-bs-original-title="" title="">
                    <i class="fas fa-thin fa-bell"></i>
                    <span class="">Email and Notification</span>
                </a>
                <ul class="sidebar-submenu" style="display: none;">

                    @can('job_emails-list')
                        <li class="sidebar-list">
                            <a
                                class="sidebar-link sidebar-title link-nav"
                                href="/administrator/job-emails">
                                <i class="fas fa-thin fa-envelope"></i>
                                <span>Send mail</span>
                                <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                            </a>
                        </li>
                    @endcan

                    @can('job_emails-list')
                        <li class="sidebar-list">
                            <a
                                class="sidebar-link sidebar-title link-nav"
                                href="/administrator/notification-customs">
                                <i class="fas fa-thin fa-envelope"></i>
                                <span>Send notify</span>
                                <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                            </a>
                        </li>
                    @endcan

                </ul>
            </li>


            <li class="sidebar-list">
                <a class="sidebar-link sidebar-title" href="javascript:void(0)" data-bs-original-title="" title="">
                    <i class="fas fa-solid fa-ruler-combined"></i>
                    <span class="">Decentralization</span>
                    <div class="according-menu"><i class="fas fa fa-angle-right"></i></div>
                </a>
                <ul class="sidebar-submenu" style="display: none;">
                    @can('employees-list')
                        <li>
                            <a
                                class="sidebar-link sidebar-title link-nav"
                                href="/administrator/employees">
                                <i class="fas fa-sharp fa-solid fa-person"></i>
                                <span>Staff</span>
                                <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                            </a>
                        </li>
                    @endcan

                    @can('roles-list')
                        <li>
                            <a
                                class="sidebar-link sidebar-title link-nav" href="/administrator/roles">
                                <i class="fas fa-regular fa-pen-ruler"></i>
                                <span>Role</span>
                                <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                            </a>
                        </li>
                    @endcan

                </ul>
            </li>

            <li class="sidebar-list">
                <a class="sidebar-link sidebar-title" href="javascript:void(0)" data-bs-original-title="" title="">
                    <i class="fas fa-solid fa-file-pen"></i>
                    <span class="">Content</span>
                    <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                </a>
                <ul class="sidebar-submenu" style="display: none;">

                    @can('logos-list')
                        <li>
                            <a
                                class="sidebar-link sidebar-title link-nav" href="/administrator/logos">
                                <i class="fas fa-brands fa-pied-piper"></i>
                                <span>Logo</span>
                                <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                            </a>
                        </li>
                    @endcan

                </ul>
            </li>

            <li class="sidebar-list">
                <a class="sidebar-link sidebar-title" href="javascript:void(0)" data-bs-original-title="" title="">
                    <i class="fa-solid fa-gear"></i>
                    <span class="">Setting</span>
                </a>
                <ul class="sidebar-submenu" style="display: none;">

                    <li class="sidebar-list">
                        <a
                            class="sidebar-link sidebar-title link-nav" href="/administrator/password">
                            <span>Password</span>
                        </a>
                    </li>

                    @can('settings-list')

                        <li class="sidebar-list">
                            <a
                                class="sidebar-link sidebar-title link-nav" href="/administrator/percent">
                                <span>Percent Ads</span>
                            </a>
                        </li>

{{--                        <li class="sidebar-list">--}}
{{--                            <a--}}
{{--                                class="sidebar-link sidebar-title link-nav" href="/administrator/ads_txt">--}}
{{--                                <span>Ads.txt</span>--}}
{{--                            </a>--}}
{{--                        </li>--}}

                        <li class="sidebar-list">
                            <a
                                class="sidebar-link sidebar-title link-nav" href="/administrator/api">
                                <span>API</span>
                            </a>
                        </li>

                    @endcan


                    <li class="sidebar-list">
                        <a
                            class="sidebar-link sidebar-title link-nav" href="{{route('administrator.logout')}}">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Logout</span>
                        </a>
                    </li>

                </ul>
            </li>

            @can('history_datas-list')
                <li class="sidebar-list">
                    <a
                        class="sidebar-link sidebar-title link-nav"
                        href="/administrator/history-datas">
                        <i class="fas fa-solid fa-database"></i>
                        <span>History data</span>
                        <div class="according-menu"><i class="fa fa-angle-right"></i></div>
                    </a>
                </li>
            @endcan

        </ul>
    </div>
    <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
</nav>
