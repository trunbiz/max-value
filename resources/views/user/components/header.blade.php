@php
    $name = auth()->user()->name;
    $email = auth()->user()->email;

    $split = explode(' ', $name);
    $first_name = array_shift($split);
    $last_name  = implode(" ", $split);

    $firstChar = substr($first_name, 0, 1);
    $secondChar = substr($last_name, 0, 1);
    $avatar_name = $firstChar.''.$secondChar;
@endphp

<header id="header">
    <div class="header-wrapper m-0 bg-white">
        <div class="header-wrapper__title text-primary">{{isset($title) ? $title : ''}}</div>
        <div class="header-wrapper__toggle">
            <svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3.65225 6.62647L1.62728 4.50027H12.065C12.328 4.50027 12.5412 4.2764 12.5412 4.00027C12.5412 3.72413 12.328 3.50027 12.065 3.50027H1.62728L3.65225 1.37406C3.83821 1.1788 3.83821 0.862213 3.65225 0.666953C3.46628 0.471693 3.16478 0.471693 2.97882 0.666953L0.140936 3.64673C-0.0450256 3.842 -0.0450256 4.1586 0.140936 4.35387L2.97882 7.3336C3.16478 7.52887 3.46628 7.52887 3.65225 7.3336C3.83821 7.13833 3.83821 6.82173 3.65225 6.62647Z" fill="#1D79C4"></path>
            </svg>
        </div>
        <div class="header-wrapper__info">
            <div class="money__info">
                <div class="notificatio__icon">
                    <svg width="26px" height="26px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink">
                        <defs>
                            <clipPath id="clip-money">
                                <rect width="32" height="32"/>
                            </clipPath>
                        </defs>
                        <g id="money" clip-path="url(#clip-money)">
                            <g id="Group_2394" data-name="Group 2394" transform="translate(-260 -260)">
                                <g id="Group_2384" data-name="Group 2384">
                                    <g id="Group_2383" data-name="Group 2383">
                                        <g id="Group_2382" data-name="Group 2382">
                                            <path id="Path_3852" data-name="Path 3852"
                                                  d="M276,271.529c-1.964,0-3.563,2.005-3.563,4.471s1.6,4.471,3.563,4.471,3.562-2.006,3.562-4.471S277.964,271.529,276,271.529Zm0,8.249c-1.582,0-2.869-1.7-2.869-3.778s1.287-3.778,2.869-3.778,2.869,1.7,2.869,3.778S277.582,279.778,276,279.778Z"
                                                  fill="#344952"/>
                                        </g>
                                    </g>
                                </g>
                                <g id="Group_2387" data-name="Group 2387">
                                    <g id="Group_2386" data-name="Group 2386">
                                        <g id="Group_2385" data-name="Group 2385">
                                            <path id="Path_3853" data-name="Path 3853"
                                                  d="M277.227,275.746a1.27,1.27,0,0,0-.407-.251q-.228-.087-.612-.192v-1.289a.7.7,0,0,1,.492.514.386.386,0,0,0,.394.329.376.376,0,0,0,.274-.113.369.369,0,0,0,.113-.268.743.743,0,0,0-.076-.307,1.308,1.308,0,0,0-.215-.325,1.118,1.118,0,0,0-.414-.31,1.948,1.948,0,0,0-.568-.137v-.334c0-.17-.067-.254-.2-.254s-.2.086-.2.26v.328a1.529,1.529,0,0,0-.981.4,1.327,1.327,0,0,0-.165,1.543,1.166,1.166,0,0,0,.452.4,3.829,3.829,0,0,0,.694.256v1.441a.845.845,0,0,1-.333-.171.732.732,0,0,1-.187-.246,3.852,3.852,0,0,1-.146-.389.337.337,0,0,0-.133-.183.415.415,0,0,0-.236-.065.388.388,0,0,0-.289.119.375.375,0,0,0-.117.268,1.066,1.066,0,0,0,.087.411,1.355,1.355,0,0,0,.268.4,1.5,1.5,0,0,0,.452.323,1.956,1.956,0,0,0,.634.171v.836a.389.389,0,0,0,.045.211.172.172,0,0,0,.157.068.152.152,0,0,0,.156-.083.726.726,0,0,0,.036-.267v-.771a1.742,1.742,0,0,0,.765-.233,1.314,1.314,0,0,0,.488-.5,1.383,1.383,0,0,0,.166-.662,1.283,1.283,0,0,0-.1-.519A1.16,1.16,0,0,0,277.227,275.746Zm-1.413-.558a1.262,1.262,0,0,1-.415-.227.578.578,0,0,1,.009-.755,1.071,1.071,0,0,1,.406-.2Zm.877,2.027a.857.857,0,0,1-.483.251v-1.358a1.376,1.376,0,0,1,.488.25.529.529,0,0,1,.165.417A.635.635,0,0,1,276.691,277.215Z"
                                                  fill="#344952"/>
                                        </g>
                                    </g>
                                </g>
                                <g id="Group_2390" data-name="Group 2390">
                                    <g id="Group_2389" data-name="Group 2389">
                                        <g id="Group_2388" data-name="Group 2388">
                                            <path id="Path_3854" data-name="Path 3854"
                                                  d="M290.708,266.375H261.292a1,1,0,0,0-1,1v17.25a1,1,0,0,0,1,1h29.416a1,1,0,0,0,1-1v-17.25A1,1,0,0,0,290.708,266.375Zm-1,17.25H262.292v-15.25h27.416Z"
                                                  fill="#344952"/>
                                        </g>
                                    </g>
                                </g>
                                <g id="Group_2393" data-name="Group 2393">
                                    <g id="Group_2392" data-name="Group 2392">
                                        <g id="Group_2391" data-name="Group 2391">
                                            <path id="Path_3855" data-name="Path 3855"
                                                  d="M263.708,282.587h24.584a.5.5,0,0,0,.5-.5V269.913a.5.5,0,0,0-.5-.5H263.708a.5.5,0,0,0-.5.5v12.174A.5.5,0,0,0,263.708,282.587Zm24.084-4.671a4.2,4.2,0,0,0-3.672,3.671H267.88a4.2,4.2,0,0,0-3.672-3.671v-3.741a4.2,4.2,0,0,0,3.681-3.762H284.12a4.2,4.2,0,0,0,3.672,3.671Zm-23.584,1a3.211,3.211,0,0,1,2.672,2.671h-2.672Zm20.912,2.671a3.211,3.211,0,0,1,2.672-2.671v2.671Zm2.672-8.5a3.211,3.211,0,0,1-2.672-2.671h2.672Zm-20.9-2.671a3.209,3.209,0,0,1-2.681,2.762v-2.762Z"
                                                  fill="#344952"/>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <span class="total__money" style="color: #ff0e1f; font-weight: 700"> $ {{Round(auth()->user()->money, 2)}}</span>
                </div>
            </div>
            <div class="notice__info">
                <div class="notificatio__icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <g>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9961 2.51416C7.56185 2.51416 5.63519 6.5294 5.63519 9.18368C5.63519 11.1675 5.92281 10.5837 4.82471 13.0037C3.48376 16.4523 8.87614 17.8618 11.9961 17.8618C15.1152 17.8618 20.5076 16.4523 19.1676 13.0037C18.0695 10.5837 18.3571 11.1675 18.3571 9.18368C18.3571 6.5294 16.4295 2.51416 11.9961 2.51416Z" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M14.306 20.5122C13.0117 21.9579 10.9927 21.9751 9.68604 20.5122" stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </g>
                        </g>
                    </svg>
                    <span class="header-nav__quantity">{{\App\Models\NotificationCustom::where('user_id', 'LIKE', '%'.auth()->id().'%')->where('viewed', 1)->count()}}</span>
                </div>
                <div class="all_notice">
                    <div class="list__news-title">
                        <h3 class="text-center">What's new in Maxvalue.media</h3>
                    </div>
                    <div class="list__news-item">
                        <div class="row">
                            <div class="col-sm-12 pe-0">
                                @if(\App\Models\NotificationCustom::where('user_id', 'LIKE', '%'.auth()->id().'%')->count() > 0)
                                    @foreach(\App\Models\NotificationCustom::where('user_id', 'LIKE', '%'.auth()->id().'%')->latest()->limit(4)->get() as $itemNotification)
                                        <div class="list__news-item--content {{ (isset($itemNotification) && !empty($itemNotification) && $itemNotification->viewed == 1) ? 'active' : '' }}">
                                            <a href="{{ $itemNotification->link }}">
                                                <span class="new_noty">New</span>
                                                <span class="title__noty">{{$itemNotification->title}}</span>
                                                {{\App\Models\Formatter::getShortDescriptionAttribute($itemNotification->description, 10)}}
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="list__news-item--content text-center">
                                        No Data
                                    </div>

                                @endif
                            </div>
                        </div>
                    </div>
                    @if(\App\Models\NotificationCustom::where('user_id', 'LIKE', '%'.auth()->id().'%')->count() > 0)
                    <div class="see__more text-center">
                        <a class="details-info__btn text-primary" href="{{ route('user.notification_customs.index') }}">See all updates</a>
                    </div>
                    @endif
                </div>
            </div>

            <div class="user__info hidden__event">
                <div class="user__info-box">
                    <div class="user__name">{{ $email }}</div>
                    <div class="user__avatar">{{ $avatar_name }}</div>
                </div>
                <div class="user__setting-box">
                    <div class="user__setting-box--detail e-dropdown bg-white">
                        <div class="user__name">
{{--                            <p>{{ $name }}</p>--}}
                            <span>{{ $email }}</span>
                        </div>
                        <ul class="custom-dropdown">
                            <li class="drop-menu-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings">
                                    <circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                                </svg>
                                <a href="{{ route('user.settings.index') }}">Settings</a>
                                <span class="title__menu"></span>
                            </li>
                            <li class="drop-menu-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-in"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path><polyline points="10 17 15 12 10 7"></polyline><line x1="15" y1="12" x2="3" y2="12"></line></svg>
                                <a href="{{ route('user.logout') }}">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="sidebar__menu bg-white">
        <div class="logo-wrapper" style="min-height: 80px;">
            <a href="{{route('user.dashboard.index')}}">
                <img class="img-fluid for-light"
                     src="{{\App\Models\Helper::logoImagePath()}}"
                     alt="">
                <img class="img-fluid for-dark"
                     src="{{\App\Models\Helper::logoImagePath()}}"
                     alt=""></a>
            </a>
        </div>
        <ul class="sidebar__menu--main">
            <li>
                <a href="{{route('user.dashboard.index')}}" class="sidebar-menu-item text-primary {{ (strpos(route('user.dashboard.index'), $_SERVER['REQUEST_URI'])) ? 'active' : '' }}">
                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.0607 6.06068C9.47487 5.4749 9.47487 4.52515 10.0607 3.93936L12.9393 1.06068C13.5251 0.474892 14.4749 0.474891 15.0607 1.06068L17.9394 3.93936C18.5251 4.52515 18.5251 5.4749 17.9394 6.06068L15.0607 8.93937C14.4749 9.52516 13.5251 9.52516 12.9393 8.93937L10.0607 6.06068Z" fill="#3FAE3B"></path>
                        <path d="M2 1.00003C0.895431 1.00003 0 1.89546 0 3.00003V7.00003C0 8.1046 0.895431 9.00003 2 9.00003H6C7.10457 9.00003 8 8.1046 8 7.00003V3.00003C8 1.89546 7.10457 1.00003 6 1.00003H2Z" fill="#3FAE3B"></path>
                        <path d="M0 13C0 11.8955 0.895431 11 2 11H6C7.10457 11 8 11.8955 8 13V17C8 18.1046 7.10457 19 6 19H2C0.895431 19 0 18.1046 0 17V13Z" fill="#3FAE3B"></path>
                        <path d="M10 13C10 11.8955 10.8954 11 12 11H16C17.1046 11 18 11.8955 18 13V17C18 18.1046 17.1046 19 16 19H12C10.8954 19 10 18.1046 10 17V13Z" fill="#3FAE3B"></path>
                    </svg>
                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.0607 3.93933C9.47487 4.52512 9.47487 5.47487 10.0607 6.06065L12.9393 8.93934C13.5251 9.52513 14.4749 9.52513 15.0607 8.93934L17.9394 6.06065C18.5251 5.47487 18.5251 4.52512 17.9394 3.93933L15.0607 1.06065C14.4749 0.47486 13.5251 0.474861 12.9393 1.06065L10.0607 3.93933ZM14 2.12131L11.1213 4.99999L14 7.87868L16.8787 4.99999L14 2.12131Z" fill="#47687D"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M0 3C0 1.89543 0.895431 0.999999 2 0.999999H6C7.10457 0.999999 8 1.89543 8 3V7C8 8.10457 7.10457 9 6 9H2C0.895431 9 0 8.10457 0 7V3ZM1.5 3C1.5 2.72386 1.72386 2.5 2 2.5H6C6.27614 2.5 6.5 2.72386 6.5 3V7C6.5 7.27614 6.27614 7.5 6 7.5H2C1.72386 7.5 1.5 7.27614 1.5 7V3Z" fill="#47687D"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M2 11C0.895431 11 0 11.8954 0 13V17C0 18.1046 0.895431 19 2 19H6C7.10457 19 8 18.1046 8 17V13C8 11.8954 7.10457 11 6 11H2ZM6.5 13C6.5 12.7239 6.27614 12.5 6 12.5H2C1.72386 12.5 1.5 12.7239 1.5 13V17C1.5 17.2761 1.72386 17.5 2 17.5H6C6.27614 17.5 6.5 17.2761 6.5 17V13Z" fill="#47687D"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M12 11C10.8954 11 10 11.8954 10 13V17C10 18.1046 10.8954 19 12 19H16C17.1046 19 18 18.1046 18 17V13C18 11.8954 17.1046 11 16 11H12ZM16.5 13C16.5 12.7239 16.2761 12.5 16 12.5H12C11.7239 12.5 11.5 12.7239 11.5 13V17C11.5 17.2761 11.7239 17.5 12 17.5H16C16.2761 17.5 16.5 17.2761 16.5 17V13Z" fill="#47687D"></path></svg>
                    <span class="content">Dashboard</span>
                </a>
            </li>
{{--            <li>--}}
{{--                <a href="{{ route('user.reports.index', ['begin' => \Carbon\Carbon::now()->subDays(6)->toDateString(), 'end' => \Carbon\Carbon::now()->toDateString()]) }}" class="sidebar-menu-item text-primary {{ (request()->is('reports')) ? 'active' : '' }}">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-speedometer2" viewBox="0 0 16 16">--}}
{{--                        <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"/>--}}
{{--                        <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z"/>--}}
{{--                    </svg>--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-speedometer2" viewBox="0 0 16 16">--}}
{{--                        <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"/>--}}
{{--                        <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z"/>--}}
{{--                    </svg>--}}
{{--                    <span class="content">Reports</span>--}}
{{--                </a>--}}
{{--            </li>--}}
            <li>
                <a href="{{ route('user.websites.index') }}" class="sidebar-menu-item text-primary {{ (request()->is('websites')) ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-browser-safari" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16Zm.25-14.75v1.5a.25.25 0 0 1-.5 0v-1.5a.25.25 0 0 1 .5 0Zm0 12v1.5a.25.25 0 1 1-.5 0v-1.5a.25.25 0 1 1 .5 0ZM4.5 1.938a.25.25 0 0 1 .342.091l.75 1.3a.25.25 0 0 1-.434.25l-.75-1.3a.25.25 0 0 1 .092-.341Zm6 10.392a.25.25 0 0 1 .341.092l.75 1.299a.25.25 0 1 1-.432.25l-.75-1.3a.25.25 0 0 1 .091-.34ZM2.28 4.408l1.298.75a.25.25 0 0 1-.25.434l-1.299-.75a.25.25 0 0 1 .25-.434Zm10.392 6 1.299.75a.25.25 0 1 1-.25.434l-1.3-.75a.25.25 0 0 1 .25-.434ZM1 8a.25.25 0 0 1 .25-.25h1.5a.25.25 0 0 1 0 .5h-1.5A.25.25 0 0 1 1 8Zm12 0a.25.25 0 0 1 .25-.25h1.5a.25.25 0 1 1 0 .5h-1.5A.25.25 0 0 1 13 8ZM2.03 11.159l1.298-.75a.25.25 0 0 1 .25.432l-1.299.75a.25.25 0 0 1-.25-.432Zm10.392-6 1.299-.75a.25.25 0 1 1 .25.433l-1.3.75a.25.25 0 0 1-.25-.434ZM4.5 14.061a.25.25 0 0 1-.092-.341l.75-1.3a.25.25 0 0 1 .434.25l-.75 1.3a.25.25 0 0 1-.342.091Zm6-10.392a.25.25 0 0 1-.091-.342l.75-1.299a.25.25 0 1 1 .432.25l-.75 1.3a.25.25 0 0 1-.341.09ZM6.494 1.415l.13.483a.25.25 0 1 1-.483.13l-.13-.483a.25.25 0 0 1 .483-.13ZM9.86 13.972l.13.483a.25.25 0 1 1-.483.13l-.13-.483a.25.25 0 0 1 .483-.13ZM3.05 3.05a.25.25 0 0 1 .354 0l.353.354a.25.25 0 0 1-.353.353l-.354-.353a.25.25 0 0 1 0-.354Zm9.193 9.193a.25.25 0 0 1 .353 0l.354.353a.25.25 0 1 1-.354.354l-.353-.354a.25.25 0 0 1 0-.353ZM1.545 6.01l.483.13a.25.25 0 1 1-.13.483l-.483-.13a.25.25 0 1 1 .13-.482Zm12.557 3.365.483.13a.25.25 0 1 1-.13.483l-.483-.13a.25.25 0 1 1 .13-.483Zm-12.863.436a.25.25 0 0 1 .176-.306l.483-.13a.25.25 0 1 1 .13.483l-.483.13a.25.25 0 0 1-.306-.177Zm12.557-3.365a.25.25 0 0 1 .176-.306l.483-.13a.25.25 0 1 1 .13.483l-.483.13a.25.25 0 0 1-.306-.177ZM3.045 12.944a.299.299 0 0 1-.029-.376l3.898-5.592a.25.25 0 0 1 .062-.062l5.602-3.884a.278.278 0 0 1 .392.392L9.086 9.024a.25.25 0 0 1-.062.062l-5.592 3.898a.299.299 0 0 1-.382-.034l-.005-.006Zm3.143 1.817a.25.25 0 0 1-.176-.306l.129-.483a.25.25 0 0 1 .483.13l-.13.483a.25.25 0 0 1-.306.176ZM9.553 2.204a.25.25 0 0 1-.177-.306l.13-.483a.25.25 0 1 1 .483.13l-.13.483a.25.25 0 0 1-.306.176Z"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-browser-safari" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16Zm.25-14.75v1.5a.25.25 0 0 1-.5 0v-1.5a.25.25 0 0 1 .5 0Zm0 12v1.5a.25.25 0 1 1-.5 0v-1.5a.25.25 0 1 1 .5 0ZM4.5 1.938a.25.25 0 0 1 .342.091l.75 1.3a.25.25 0 0 1-.434.25l-.75-1.3a.25.25 0 0 1 .092-.341Zm6 10.392a.25.25 0 0 1 .341.092l.75 1.299a.25.25 0 1 1-.432.25l-.75-1.3a.25.25 0 0 1 .091-.34ZM2.28 4.408l1.298.75a.25.25 0 0 1-.25.434l-1.299-.75a.25.25 0 0 1 .25-.434Zm10.392 6 1.299.75a.25.25 0 1 1-.25.434l-1.3-.75a.25.25 0 0 1 .25-.434ZM1 8a.25.25 0 0 1 .25-.25h1.5a.25.25 0 0 1 0 .5h-1.5A.25.25 0 0 1 1 8Zm12 0a.25.25 0 0 1 .25-.25h1.5a.25.25 0 1 1 0 .5h-1.5A.25.25 0 0 1 13 8ZM2.03 11.159l1.298-.75a.25.25 0 0 1 .25.432l-1.299.75a.25.25 0 0 1-.25-.432Zm10.392-6 1.299-.75a.25.25 0 1 1 .25.433l-1.3.75a.25.25 0 0 1-.25-.434ZM4.5 14.061a.25.25 0 0 1-.092-.341l.75-1.3a.25.25 0 0 1 .434.25l-.75 1.3a.25.25 0 0 1-.342.091Zm6-10.392a.25.25 0 0 1-.091-.342l.75-1.299a.25.25 0 1 1 .432.25l-.75 1.3a.25.25 0 0 1-.341.09ZM6.494 1.415l.13.483a.25.25 0 1 1-.483.13l-.13-.483a.25.25 0 0 1 .483-.13ZM9.86 13.972l.13.483a.25.25 0 1 1-.483.13l-.13-.483a.25.25 0 0 1 .483-.13ZM3.05 3.05a.25.25 0 0 1 .354 0l.353.354a.25.25 0 0 1-.353.353l-.354-.353a.25.25 0 0 1 0-.354Zm9.193 9.193a.25.25 0 0 1 .353 0l.354.353a.25.25 0 1 1-.354.354l-.353-.354a.25.25 0 0 1 0-.353ZM1.545 6.01l.483.13a.25.25 0 1 1-.13.483l-.483-.13a.25.25 0 1 1 .13-.482Zm12.557 3.365.483.13a.25.25 0 1 1-.13.483l-.483-.13a.25.25 0 1 1 .13-.483Zm-12.863.436a.25.25 0 0 1 .176-.306l.483-.13a.25.25 0 1 1 .13.483l-.483.13a.25.25 0 0 1-.306-.177Zm12.557-3.365a.25.25 0 0 1 .176-.306l.483-.13a.25.25 0 1 1 .13.483l-.483.13a.25.25 0 0 1-.306-.177ZM3.045 12.944a.299.299 0 0 1-.029-.376l3.898-5.592a.25.25 0 0 1 .062-.062l5.602-3.884a.278.278 0 0 1 .392.392L9.086 9.024a.25.25 0 0 1-.062.062l-5.592 3.898a.299.299 0 0 1-.382-.034l-.005-.006Zm3.143 1.817a.25.25 0 0 1-.176-.306l.129-.483a.25.25 0 0 1 .483.13l-.13.483a.25.25 0 0 1-.306.176ZM9.553 2.204a.25.25 0 0 1-.177-.306l.13-.483a.25.25 0 1 1 .483.13l-.13.483a.25.25 0 0 1-.306.176Z"/>
                    </svg>
                    <span class="content">Websites and Zones</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.advertises.index') }}" class="sidebar-menu-item text-primary {{ (request()->is('advs')) ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-txt" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-2v-1h2a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.928 15.849v-3.337h1.136v-.662H0v.662h1.134v3.337h.794Zm4.689-3.999h-.894L4.9 13.289h-.035l-.832-1.439h-.932l1.228 1.983-1.24 2.016h.862l.853-1.415h.035l.85 1.415h.907l-1.253-1.992 1.274-2.007Zm1.93.662v3.337h-.794v-3.337H6.619v-.662h3.064v.662H8.546Z"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-txt" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-2v-1h2a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM1.928 15.849v-3.337h1.136v-.662H0v.662h1.134v3.337h.794Zm4.689-3.999h-.894L4.9 13.289h-.035l-.832-1.439h-.932l1.228 1.983-1.24 2.016h.862l.853-1.415h.035l.85 1.415h.907l-1.253-1.992 1.274-2.007Zm1.93.662v3.337h-.794v-3.337H6.619v-.662h3.064v.662H8.546Z"/>
                    </svg>
                    <span class="content">Ads.txt</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.wallet_users.index') }}" class="sidebar-menu-item text-primary {{ (request()->is('wallet')) ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-stack" viewBox="0 0 16 16">
                        <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                        <path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V5zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2H3z"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-stack" viewBox="0 0 16 16">
                        <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                        <path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V5zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2H3z"/>
                    </svg>
                    <span class="content">Wallet</span>
                </a>
            </li>
{{--            <li>--}}
{{--                <a href="{{ route('user.contacts.index') }}" class="sidebar-menu-item text-primary {{ (request()->is('contacts')) ? 'active' : '' }}">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-rolodex" viewBox="0 0 16 16">--}}
{{--                        <path d="M8 9.05a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>--}}
{{--                        <path d="M1 1a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h.5a.5.5 0 0 0 .5-.5.5.5 0 0 1 1 0 .5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5.5.5 0 0 1 1 0 .5.5 0 0 0 .5.5h.5a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H6.707L6 1.293A1 1 0 0 0 5.293 1H1Zm0 1h4.293L6 2.707A1 1 0 0 0 6.707 3H15v10h-.085a1.5 1.5 0 0 0-2.4-.63C11.885 11.223 10.554 10 8 10c-2.555 0-3.886 1.224-4.514 2.37a1.5 1.5 0 0 0-2.4.63H1V2Z"/>--}}
{{--                    </svg>--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-rolodex" viewBox="0 0 16 16">--}}
{{--                        <path d="M8 9.05a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>--}}
{{--                        <path d="M1 1a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h.5a.5.5 0 0 0 .5-.5.5.5 0 0 1 1 0 .5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5.5.5 0 0 1 1 0 .5.5 0 0 0 .5.5h.5a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H6.707L6 1.293A1 1 0 0 0 5.293 1H1Zm0 1h4.293L6 2.707A1 1 0 0 0 6.707 3H15v10h-.085a1.5 1.5 0 0 0-2.4-.63C11.885 11.223 10.554 10 8 10c-2.555 0-3.886 1.224-4.514 2.37a1.5 1.5 0 0 0-2.4.63H1V2Z"/>--}}
{{--                    </svg>--}}
{{--                    <span class="content">Contact</span>--}}
{{--                </a>--}}
{{--            </li>--}}
            <li>
                <a href="{{ route('user.settings.index') }}" class="sidebar-menu-item text-primary {{ (request()->is('settings')) ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sliders" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sliders" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z"/>
                    </svg>
                    <span class="content">Settings</span>
                </a>
            </li>
            <li style="cursor: pointer">
                <a class="sidebar-menu-item text-primary" onclick="event.preventDefault(); document.getElementById('cloneuser-form').submit();">
                    <svg class="svg-icon" style="width: 1em; height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M475 276V141.4c-12.1-56.3-58.2-22-58.2-22L96.6 395.9c-70.4 48.9-4.8 85.7-4.8 85.7l315.4 274.1c63.1 46.5 67.9-24.5 67.9-24.5V606.4C795.3 506 926.3 907.5 926.3 907.5c12.1 22 19.4 0 19.4 0C1069.4 305.4 475 276 475 276z"  /></svg>
                    <svg class="svg-icon" style="width: 1em; height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M475 276V141.4c-12.1-56.3-58.2-22-58.2-22L96.6 395.9c-70.4 48.9-4.8 85.7-4.8 85.7l315.4 274.1c63.1 46.5 67.9-24.5 67.9-24.5V606.4C795.3 506 926.3 907.5 926.3 907.5c12.1 22 19.4 0 19.4 0C1069.4 305.4 475 276 475 276z"  /></svg>
                    <span class="content">Return Admin Panel</span>
                </a>
                <form id="cloneuser-form" action="{{ route('administrator.returnImpersonateAdmin') }}" method="POST">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
        <div class="sidebar__menu--info">
            <div class="sidebvar__menu--main-info">
                <div class="info__support">

                    @php
//                        $name = optional(auth()->user()->manager)->name ?? \App\Models\User::find(1)->name;
//                        $email = optional(auth()->user()->manager)->email ?? \App\Models\User::find(1)->email;

                        $userAssign = auth()->user()->getFirstUserAssign();
                        $name = !empty($userAssign) ? \App\Models\User::find($userAssign->user_id)->name : (optional(auth()->user()->manager)->name ?? \App\Models\User::find(1)->name);
                        $email = !empty($userAssign) ? \App\Models\User::find($userAssign->user_id)->email : (optional(auth()->user()->manager)->email ?? \App\Models\User::find(1)->email);
                        $telegram = !empty($userAssign) ? \App\Models\User::find($userAssign->user_id)->telegram : (optional(auth()->user()->manager)->telegram ?? \App\Models\User::find(1)->telegram);
                        $skype = !empty($userAssign) ? \App\Models\User::find($userAssign->user_id)->skype : (optional(auth()->user()->manager)->skype ?? \App\Models\User::find(1)->skype);
                    @endphp

                    <div class="user__avatar">{{\App\Models\Formatter::getShortCharacter($name, 2)}}</div>
                    <div class="info__support--detail">
                        <span>Account Manager</span>
                        <p>{{$name}}</p>
                    </div>
                </div>
                <div class="social-bar">
                    <a href="mailto:{{$email}}" title="mail">
                        <img src="{{ asset('/assets/user/images/gmail.png') }}" alt="Gmail">
                    </a>
                    @if(!empty($email))
                        <a href="{{$telegram}}" title="Telegram">
                            <img src="{{ asset('/assets/user/images/telegram.png') }}" alt="Telegram">
                        </a>
                    @endif
                    @if(!empty($skype))
                    <a href="{{$skype}}" title="Skype">
                        <img src="{{ asset('/assets/user/images/skype.png') }}" alt="Skype">
                    </a>
                    @endif
                </div>
            </div>
            <div class="sidebvar__menu--main-info copyright">
                <div class="info__support">
                    <div class="info__support--detail">System timezone UTC: {{ $date = date('Y-m-d H:i') }}</div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .social-bar {
            display: flex;
            justify-content: left;
            padding: 10px;
            background-color: transparent;
        }

        .social-bar a {
            display: inline-block;
            margin-left: 20px;
        }

        .social-bar a img {
            width: 20px;
            height: 20px;
        }
    </style>
</header>
