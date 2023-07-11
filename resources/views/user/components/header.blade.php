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
                    <span class="total__money" style="color: #ff0e1f; font-weight: 700"> $ {{auth()->user()->money}}</span>
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
        <div class="sidebar__menu--logo">
            <a href="{{route('user.dashboard.index')}}">
                <img src="{{\App\Models\Helper::logoImagePath()}}" alt="" class="all_logo" width="80px">
                <img src="{{\App\Models\Helper::logoImagePath()}}" alt="" class="fav_logo" width="80px">
            </a>
        </div>
        <ul class="sidebar__menu--main">
{{--            <li>--}}
{{--                <a href="{{route('user.dashboard.index')}}" class="sidebar-menu-item text-primary {{ (strpos(route('user.dashboard.index'), $_SERVER['REQUEST_URI'])) ? 'active' : '' }}">--}}
{{--                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                        <path d="M10.0607 6.06068C9.47487 5.4749 9.47487 4.52515 10.0607 3.93936L12.9393 1.06068C13.5251 0.474892 14.4749 0.474891 15.0607 1.06068L17.9394 3.93936C18.5251 4.52515 18.5251 5.4749 17.9394 6.06068L15.0607 8.93937C14.4749 9.52516 13.5251 9.52516 12.9393 8.93937L10.0607 6.06068Z" fill="#3FAE3B"></path>--}}
{{--                        <path d="M2 1.00003C0.895431 1.00003 0 1.89546 0 3.00003V7.00003C0 8.1046 0.895431 9.00003 2 9.00003H6C7.10457 9.00003 8 8.1046 8 7.00003V3.00003C8 1.89546 7.10457 1.00003 6 1.00003H2Z" fill="#3FAE3B"></path>--}}
{{--                        <path d="M0 13C0 11.8955 0.895431 11 2 11H6C7.10457 11 8 11.8955 8 13V17C8 18.1046 7.10457 19 6 19H2C0.895431 19 0 18.1046 0 17V13Z" fill="#3FAE3B"></path>--}}
{{--                        <path d="M10 13C10 11.8955 10.8954 11 12 11H16C17.1046 11 18 11.8955 18 13V17C18 18.1046 17.1046 19 16 19H12C10.8954 19 10 18.1046 10 17V13Z" fill="#3FAE3B"></path>--}}
{{--                    </svg>--}}
{{--                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.0607 3.93933C9.47487 4.52512 9.47487 5.47487 10.0607 6.06065L12.9393 8.93934C13.5251 9.52513 14.4749 9.52513 15.0607 8.93934L17.9394 6.06065C18.5251 5.47487 18.5251 4.52512 17.9394 3.93933L15.0607 1.06065C14.4749 0.47486 13.5251 0.474861 12.9393 1.06065L10.0607 3.93933ZM14 2.12131L11.1213 4.99999L14 7.87868L16.8787 4.99999L14 2.12131Z" fill="#47687D"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M0 3C0 1.89543 0.895431 0.999999 2 0.999999H6C7.10457 0.999999 8 1.89543 8 3V7C8 8.10457 7.10457 9 6 9H2C0.895431 9 0 8.10457 0 7V3ZM1.5 3C1.5 2.72386 1.72386 2.5 2 2.5H6C6.27614 2.5 6.5 2.72386 6.5 3V7C6.5 7.27614 6.27614 7.5 6 7.5H2C1.72386 7.5 1.5 7.27614 1.5 7V3Z" fill="#47687D"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M2 11C0.895431 11 0 11.8954 0 13V17C0 18.1046 0.895431 19 2 19H6C7.10457 19 8 18.1046 8 17V13C8 11.8954 7.10457 11 6 11H2ZM6.5 13C6.5 12.7239 6.27614 12.5 6 12.5H2C1.72386 12.5 1.5 12.7239 1.5 13V17C1.5 17.2761 1.72386 17.5 2 17.5H6C6.27614 17.5 6.5 17.2761 6.5 17V13Z" fill="#47687D"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M12 11C10.8954 11 10 11.8954 10 13V17C10 18.1046 10.8954 19 12 19H16C17.1046 19 18 18.1046 18 17V13C18 11.8954 17.1046 11 16 11H12ZM16.5 13C16.5 12.7239 16.2761 12.5 16 12.5H12C11.7239 12.5 11.5 12.7239 11.5 13V17C11.5 17.2761 11.7239 17.5 12 17.5H16C16.2761 17.5 16.5 17.2761 16.5 17V13Z" fill="#47687D"></path></svg>--}}
{{--                    <span class="content">Dashboard</span>--}}
{{--                </a>--}}
{{--            </li>--}}
            <li>
                <a href="{{ route('user.reports.index', ['begin' => \Carbon\Carbon::now()->subDays(6)->toDateString(), 'end' => \Carbon\Carbon::now()->toDateString()]) }}" class="sidebar-menu-item text-primary {{ (request()->is('reports')) ? 'active' : '' }}">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0 2C0 0.89543 0.89543 0 2 0H16C17.1046 0 18 0.89543 18 2V16C18 17.1046 17.1046 18 16 18H2C0.89543 18 0 17.1046 0 16V2ZM9 15C8.5858 15 8.25 14.6642 8.25 14.25V4.75C8.25 4.33579 8.5858 4 9 4C9.4142 4 9.75 4.33579 9.75 4.75V14.25C9.75 14.6642 9.4142 15 9 15ZM3.75 14.25C3.75 14.6642 4.08579 15 4.5 15C4.91422 15 5.25 14.6642 5.25 14.25V7.75C5.25 7.3358 4.91421 7 4.5 7C4.08579 7 3.75 7.3358 3.75 7.75V14.25ZM13.5 15C13.0858 15 12.75 14.6642 12.75 14.25V9.75C12.75 9.3358 13.0858 9 13.5 9C13.9142 9 14.25 9.3358 14.25 9.75V14.25C14.25 14.6642 13.9142 15 13.5 15Z" fill="#3FAE3B"></path></svg>
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 14C8.5858 14 8.25 13.6642 8.25 13.25V4.75C8.25 4.33579 8.5858 4 9 4C9.4142 4 9.75 4.33579 9.75 4.75V13.25C9.75 13.6642 9.4142 14 9 14Z" fill="#47687D"></path><path d="M5 14C4.58579 14 4.25 13.6642 4.25 13.25V7.75C4.25 7.3358 4.58579 7 5 7C5.41421 7 5.75 7.3358 5.75 7.75V13.25C5.75 13.6642 5.41422 14 5 14Z" fill="#47687D"></path><path d="M13 14C12.5858 14 12.25 13.6642 12.25 13.25V9.75C12.25 9.3358 12.5858 9 13 9C13.4142 9 13.75 9.3358 13.75 9.75V13.25C13.75 13.6642 13.4142 14 13 14Z" fill="#47687D"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M0 2C0 0.89543 0.89543 0 2 0H16C17.1046 0 18 0.89543 18 2V16C18 17.1046 17.1046 18 16 18H2C0.89543 18 0 17.1046 0 16V2ZM1.5 2C1.5 1.72386 1.72386 1.5 2 1.5H16C16.2761 1.5 16.5 1.72386 16.5 2V16C16.5 16.2761 16.2761 16.5 16 16.5H2C1.72386 16.5 1.5 16.2761 1.5 16V2Z" fill="#47687D"></path></svg>
                    <span class="content">Reports</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.websites.index') }}" class="sidebar-menu-item text-primary {{ (request()->is('websites')) ? 'active' : '' }}">
                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.7557 17.7337C7.07341 18.5677 8.24154 18.5994 8.604 17.7839L11.1022 12.1629L16.9393 18C17.2322 18.2929 17.7071 18.2929 18 18C18.2929 17.7071 18.2929 17.2323 18 16.9394L12.1629 11.1022L17.7839 8.60402C18.5994 8.24156 18.5677 7.07343 17.7337 6.75572L2.08465 0.794162C1.27774 0.48677 0.486771 1.27774 0.794162 2.08464L6.7557 17.7337Z" fill="#3FAE3B"></path></svg>
                    <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M17.7839 8.60402L12.2114 11.0807L17.9649 16.8341C18.2772 17.1464 18.2772 17.6527 17.9649 17.9649C17.6526 18.2772 17.1463 18.2772 16.8341 17.9649L11.0806 12.2115L8.604 17.7839C8.24154 18.5994 7.07341 18.5677 6.7557 17.7337L0.794162 2.08464C0.486771 1.27774 1.27774 0.486771 2.08465 0.794162L17.7337 6.75572C18.5677 7.07343 18.5994 8.24156 17.7839 8.60402ZM10.0579 10.8194C10.2087 10.48 10.48 10.2087 10.8194 10.0579L16.0666 7.72578L2.59296 2.59297L7.72576 16.0666L10.0579 10.8194Z" fill="#47687D"></path></svg>
                    <span class="content">Websites and Zones</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.advertises.index') }}" class="sidebar-menu-item text-primary {{ (request()->is('advs')) ? 'active' : '' }}">
                    <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M16 5.82843C16 5.298 15.7893 4.78929 15.4142 4.41421L11.5858 0.58579C11.2107 0.21071 10.702 0 10.1716 0H2C0.89543 0 0 0.89543 0 2V18C0 19.1046 0.89543 20 2 20H14C15.1046 20 16 19.1046 16 18V5.82843ZM11.75 8.75C12.1642 8.75 12.5 8.4142 12.5 8C12.5 7.58579 12.1642 7.25 11.75 7.25H4.25C3.83579 7.25 3.5 7.58579 3.5 8C3.5 8.4142 3.83579 8.75 4.25 8.75H11.75ZM4.25 12.75C3.83579 12.75 3.5 12.4142 3.5 12C3.5 11.5858 3.83579 11.25 4.25 11.25H9.75C10.1642 11.25 10.5 11.5858 10.5 12C10.5 12.4142 10.1642 12.75 9.75 12.75H4.25Z" fill="#3FAE3B"></path></svg>
                    <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.001 12C10.001 12.4142 9.66516 12.75 9.25096 12.75H4.75098C4.33676 12.75 4.00098 12.4142 4.00098 12C4.00098 11.5858 4.33676 11.25 4.75098 11.25H9.25096C9.66516 11.25 10.001 11.5858 10.001 12Z" fill="#47687D"></path><path d="M12.001 8.00001C12.001 8.41421 11.6652 8.75001 11.251 8.75001H4.75098C4.33676 8.75001 4.00098 8.41421 4.00098 8.00001C4.00098 7.58581 4.33676 7.25002 4.75098 7.25002H11.251C11.6652 7.25002 12.001 7.58581 12.001 8.00001Z" fill="#47687D"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M15.4152 4.41422C15.7903 4.78929 16.001 5.298 16.001 5.82843V18C16.001 19.1046 15.1056 20 14.001 20H2.00098C0.896407 20 0.000976562 19.1046 0.000976562 18V2C0.000976562 0.89543 0.896407 0 2.00098 0H10.1726C10.703 0 11.2117 0.21071 11.5868 0.58579L15.4152 4.41422ZM14.501 5.82843V18C14.501 18.2762 14.2772 18.5 14.001 18.5H2.00098C1.72483 18.5 1.50098 18.2762 1.50098 18V2C1.50098 1.72386 1.72484 1.5 2.00098 1.5H10.1726C10.3052 1.5 10.4324 1.55268 10.5261 1.64645L14.3546 5.47488C14.4483 5.56865 14.501 5.69583 14.501 5.82843Z" fill="#47687D"></path></svg>
                    <span class="content">Ads.txt</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.wallet_users.index') }}" class="sidebar-menu-item text-primary {{ (request()->is('wallet')) ? 'active' : '' }}">
                    <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M2.75 0C1.23122 0 0 1.23122 0 2.75V16C0 17.1046 0.89543 18 2 18H18C19.1046 18 20 17.1046 20 16V6C20 4.89543 19.1046 4 18 4V2C18 0.89543 17.1046 0 16 0H2.75ZM1.5 2.75C1.5 2.05964 2.05964 1.5 2.75 1.5H16C16.2761 1.5 16.5 1.72386 16.5 2V4H2.75C2.05964 4 1.5 3.44036 1.5 2.75ZM15.75 12.25C16.4404 12.25 17 11.6904 17 11C17 10.3096 16.4404 9.75 15.75 9.75C15.0596 9.75 14.5 10.3096 14.5 11C14.5 11.6904 15.0596 12.25 15.75 12.25Z" fill="#3FAE3B"></path></svg>
                    <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.5 11C16.5 11.6904 15.9404 12.25 15.25 12.25C14.5596 12.25 14 11.6904 14 11C14 10.3096 14.5596 9.75 15.25 9.75C15.9404 9.75 16.5 10.3096 16.5 11Z" fill="#47687D"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M2.75 0C1.23122 0 0 1.23122 0 2.75V16C0 17.1046 0.89543 18 2 18H18C19.1046 18 20 17.1046 20 16V6C20 4.89543 19.1046 4 18 4V2C18 0.89543 17.1046 0 16 0H2.75ZM16.5 2C16.5 1.72386 16.2761 1.5 16 1.5H2.75C2.05964 1.5 1.5 2.05964 1.5 2.75C1.5 3.44036 2.05964 4 2.75 4H16.5V2ZM1.5 5.20015C1.87503 5.39186 2.29989 5.5 2.75 5.5H18C18.2761 5.5 18.5 5.72386 18.5 6V16C18.5 16.2761 18.2761 16.5 18 16.5H2C1.72386 16.5 1.5 16.2761 1.5 16V5.20015Z" fill="#47687D"></path></svg>
                    <span class="content">Wallet</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.contacts.index') }}" class="sidebar-menu-item text-primary {{ (request()->is('contacts')) ? 'active' : '' }}">
{{--                    <svg width="22" height="22" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><rect x="8" y="12" width="48" height="40"></rect><polyline points="56 20 32 36 8 20"></polyline></g></svg>--}}
                    <svg width="22" height="22" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" fill="#41C866" stroke="#fff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><rect x="8" y="12" width="48" height="40"></rect><polyline points="56 20 32 36 8 20"></polyline></g></svg>
                    <svg width="22" height="22" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="#000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><rect x="8" y="12" width="48" height="40"></rect><polyline points="56 20 32 36 8 20"></polyline></g></svg>
                    <span class="content">Contact</span>
                </a>
            </li>
            <li>
                <a href="{{ route('user.settings.index') }}" class="sidebar-menu-item text-primary {{ (request()->is('settings')) ? 'active' : '' }}">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.6274 0C13.1274 0 13.5506 0.3694 13.6182 0.86489L13.988 3.57655C14.6915 3.85999 15.3455 4.24054 15.9334 4.70162L18.4685 3.66524C18.9314 3.47601 19.4629 3.65781 19.713 4.09088L21.3401 6.90912C21.5901 7.34219 21.4818 7.89339 21.0865 8.19965L18.922 9.8765C18.9736 10.2436 19.0002 10.6187 19.0002 11C19.0002 11.3813 18.9736 11.7564 18.922 12.1235L21.0865 13.8004C21.1359 13.8386 21.1808 13.8807 21.2211 13.926C21.5033 14.2426 21.5589 14.7119 21.3401 15.0909L19.713 17.9091C19.4629 18.3422 18.9314 18.524 18.4685 18.3348L15.9334 17.2984C15.3455 17.7595 14.6915 18.14 13.988 18.4234L13.6182 21.1351C13.5506 21.6306 13.1274 22 12.6274 22H9.3731C8.87306 22 8.44987 21.6306 8.3823 21.1351L8.01253 18.4234C7.30896 18.14 6.65495 17.7595 6.0671 17.2984L3.53195 18.3348C3.06906 18.524 2.53756 18.3422 2.28752 17.9091L0.660409 15.0909C0.410379 14.6578 0.518689 14.1066 0.914009 13.8004L3.07852 12.1235C3.02693 11.7564 3.00025 11.3813 3.00025 11C3.00025 10.6187 3.02693 10.2436 3.07852 9.8765L0.914009 8.19965C0.518689 7.89339 0.410379 7.34219 0.660409 6.90912L2.28752 4.09088C2.53755 3.65781 3.06906 3.47601 3.53195 3.66524L6.0671 4.70162C6.65495 4.24055 7.30896 3.85999 8.01253 3.57656L8.3823 0.86489C8.44987 0.3694 8.87306 0 9.3731 0H12.6274ZM14.5002 11C14.5002 12.933 12.9332 14.5 11.0002 14.5C9.0672 14.5 7.50024 12.933 7.50024 11C7.50024 9.067 9.0672 7.5 11.0002 7.5C12.9332 7.5 14.5002 9.067 14.5002 11Z" fill="#3FAE3B"></path></svg>
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M11.0002 15C13.2094 15 15.0002 13.2091 15.0002 11C15.0002 8.79086 13.2094 7 11.0002 7C8.7911 7 7.00024 8.79086 7.00024 11C7.00024 13.2091 8.7911 15 11.0002 15ZM11.0002 13.5C12.3809 13.5 13.5002 12.3807 13.5002 11C13.5002 9.6193 12.3809 8.5 11.0002 8.5C9.61951 8.5 8.50024 9.6193 8.50024 11C8.50024 12.3807 9.61951 13.5 11.0002 13.5Z" fill="#47687D"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M14.1182 0.86489L14.5203 3.81406C14.8475 3.97464 15.1621 4.1569 15.4623 4.35898L18.2185 3.23223C18.6814 3.043 19.2129 3.2248 19.463 3.65787L21.5901 7.34213C21.8401 7.77521 21.7318 8.3264 21.3365 8.63266L18.9821 10.4566C18.9941 10.6362 19.0002 10.8174 19.0002 11C19.0002 11.1826 18.9941 11.3638 18.9821 11.5434L21.3365 13.3673C21.7318 13.6736 21.8401 14.2248 21.5901 14.6579L19.463 18.3421C19.2129 18.7752 18.6814 18.957 18.2185 18.7678L15.4623 17.641C15.1621 17.8431 14.8475 18.0254 14.5203 18.1859L14.1182 21.1351C14.0506 21.6306 13.6274 22 13.1273 22H8.87313C8.37306 22 7.94987 21.6306 7.8823 21.1351L7.48014 18.1859C7.15296 18.0254 6.83835 17.8431 6.53818 17.641L3.78195 18.7678C3.31907 18.957 2.78756 18.7752 2.53752 18.3421L0.410418 14.6579C0.160379 14.2248 0.268689 13.6736 0.664009 13.3673L3.01841 11.5434C3.00636 11.3638 3.00025 11.1826 3.00025 11C3.00025 10.8174 3.00636 10.6362 3.01841 10.4566L0.664009 8.63266C0.268689 8.3264 0.160379 7.77521 0.410409 7.34213L2.53752 3.65787C2.78755 3.2248 3.31906 3.043 3.78195 3.23223L6.53818 4.35898C6.83835 4.1569 7.15296 3.97464 7.48014 3.81406L7.8823 0.86489C7.94987 0.3694 8.37306 0 8.87313 0H13.1273C13.6274 0 14.0506 0.3694 14.1182 0.86489ZM13.1421 4.80854L13.8595 5.16063C14.1251 5.29098 14.3806 5.43902 14.6246 5.60328L15.2888 6.05042L18.3822 4.78584L20.0728 7.71416L17.432 9.76L17.4854 10.557C17.4952 10.7032 17.5002 10.8509 17.5002 11C17.5002 11.1491 17.4952 11.2968 17.4854 11.443L17.432 12.24L20.0728 14.2858L18.3822 17.2142L15.2888 15.9496L14.6246 16.3967C14.3806 16.561 14.1251 16.709 13.8595 16.8394L13.1421 17.1915L12.6909 20.5H9.3096L8.85841 17.1915L8.14101 16.8394C7.87543 16.709 7.61987 16.561 7.37587 16.3967L6.7117 15.9496L3.61834 17.2142L1.92768 14.2858L4.5685 12.24L4.51505 11.443C4.50524 11.2968 4.50024 11.1491 4.50024 11C4.50024 10.8509 4.50524 10.7032 4.51505 10.557L4.5685 9.76L1.92767 7.71416L3.61834 4.78584L6.7117 6.05041L7.37587 5.60328C7.61986 5.43902 7.87543 5.29098 8.14102 5.16063L8.85841 4.80854L9.3096 1.5H12.6909L13.1421 4.80854Z" fill="#47687D"></path></svg>
                    <span class="content">Settings</span>
                </a>
            </li>

            @if (\Illuminate\Support\Facades\Session::get('hasClonedUser') == 1)
            <li style="cursor: pointer">
                <a class="sidebar-menu-item text-primary" onclick="event.preventDefault(); document.getElementById('cloneuser-form').submit();">
                    <svg class="svg-icon" style="width: 1em; height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M475 276V141.4c-12.1-56.3-58.2-22-58.2-22L96.6 395.9c-70.4 48.9-4.8 85.7-4.8 85.7l315.4 274.1c63.1 46.5 67.9-24.5 67.9-24.5V606.4C795.3 506 926.3 907.5 926.3 907.5c12.1 22 19.4 0 19.4 0C1069.4 305.4 475 276 475 276z"  /></svg>
                    <svg class="svg-icon" style="width: 1em; height: 1em;vertical-align: middle;fill: currentColor;overflow: hidden;" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M475 276V141.4c-12.1-56.3-58.2-22-58.2-22L96.6 395.9c-70.4 48.9-4.8 85.7-4.8 85.7l315.4 274.1c63.1 46.5 67.9-24.5 67.9-24.5V606.4C795.3 506 926.3 907.5 926.3 907.5c12.1 22 19.4 0 19.4 0C1069.4 305.4 475 276 475 276z"  /></svg>
                    <span class="content">Return Admin Panel</span>
                </a>
                <form id="cloneuser-form" action="{{ route('administrator.imperrsonate') }}" method="POST">
                    {{ csrf_field() }}
                </form>
            </li>
            @endif
        </ul>
        <div class="sidebar__menu--info">
            <div class="sidebvar__menu--main-info">
                <div class="info__support">

                    @php
                        $name = optional(auth()->user()->manager)->name ?? \App\Models\User::find(1)->name;
                        $email = optional(auth()->user()->manager)->email ?? \App\Models\User::find(1)->email;
                    @endphp

                    <div class="user__avatar">{{\App\Models\Formatter::getShortCharacter($name, 2)}}</div>
                    <div class="info__support--detail">
                        <span>Account Manager</span>
                        <p>{{$name}}</p>
                        <a href="mailto:{{$email}}">
                            <img src="{{ asset('/assets/user/images/gmail.png') }}" alt="" width="15%">
                        </a>
                    </div>
                </div>
            </div>
            <div class="sidebvar__menu--main-info copyright">
                <div class="info__support">
                    <div class="info__support--detail">System timezone UTC: {{ $date = date('Y-m-d H:i') }}</div>
                    <div class="info__support--detail" style="display:none;">Copyright by © <a href="https://hazomedia.com/">Hazo</a></div>
                </div>
            </div>
        </div>
    </div>
</header>
