@extends('user.layouts.master')

@include('user.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

{{--    <div class="container-fluid list-products">--}}
{{--        <div class="row">--}}
{{--            <div class="col-12">--}}

{{--                <div class="card">--}}

{{--                    <div class="card-header">--}}

{{--                        @include('user.'.$prefixView.'.search')--}}

{{--                    </div>--}}

{{--                    <div class="card-body">--}}

{{--                        <div class="table-responsive product-table">--}}
{{--                            <table class="table table-hover ">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>ID</th>--}}
{{--                                    <th>Name</th>--}}
{{--                                    <th>Format</th>--}}
{{--                                    <th>Active</th>--}}
{{--                                    <th>Created at</th>--}}
{{--                                    <th>Action</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @foreach($items as $item)--}}
{{--                                    <tr>--}}
{{--                                        <td>{{$item['id']}}</td>--}}
{{--                                        <td>{{$item['name']}}</td>--}}
{{--                                        <td>{{$item['format']['name']}}</td>--}}
{{--                                        <td>{{$item['is_active'] ? "Yes" : "No"}}</td>--}}

{{--                                        <td>{{$item['created_at']}}</td>--}}
{{--                                        <td>--}}
{{--                                            <a href="{{route('user.reports.index' , ['zone_id'=> $item['id'] ])}}" title="Report">--}}
{{--                                                <i class="fa-solid fa-chart-simple"></i>--}}
{{--                                            </a>--}}

{{--                                            <a href="{{route('user.'.$prefixView.'.edit' , ['id'=> $item['id'] ])}}" title="View">--}}
{{--                                                <i class="fa-regular fa-eye"></i>--}}
{{--                                            </a>--}}

{{--                                            <a href="{{route('user.'.$prefixView.'.delete' , ['id'=> $item['id']])}}"--}}
{{--                                               data-url="{{route('user.'.$prefixView.'.delete' , ['id'=> $item['id']])}}"--}}
{{--                                               class="delete action_delete text-danger"--}}
{{--                                               title="Delete">--}}
{{--                                                <i class="fa-solid fa-x"></i>--}}
{{--                                            </a>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}

{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            @include('user.components.footer_table')--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}

{{--    <style>--}}
{{--        .product-table span, .product-table p {--}}
{{--            color: #fff;--}}
{{--        }--}}
{{--    </style>--}}


<div class="content-main">
{{--    <div class="ads-wrapper__select-site bg-white">--}}
{{--        <p class="mr-2">Select website:</p>--}}
{{--        <div class="select__site">--}}
{{--            <select class="selectSite col-sm-12" id="chooseSite" onchange="chooseSite()">--}}
{{--                <option value="">Select Site</option>--}}
{{--                <option value="1">Alabama</option>--}}
{{--                <option value="2">Wyoming</option>--}}
{{--                <option value="3">Coming</option>--}}
{{--                <option value="4">Hanry Die</option>--}}
{{--                <option value="5">John Doe</option>--}}
{{--            </select>--}}
{{--        </div>--}}
{{--    </div>--}}


    <div class="row">
{{--        <div class="col-md-12 col-xl-12 col-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    <h5>Redirect URL</h5>--}}
{{--                </div>--}}
{{--                <div class="card-body card__ads">--}}
{{--                    <p class="redirect-desc">--}}
{{--                        To ensure that your ads.txt file is always up to date, Pubfuture has developed a dynamically hosted ads.txt solution. This allows publishers to manage ads.txt right from their dashboard, and eliminates the need to frequently upload new files to your domain. To use this file, you must set up a permanent 301 redirect pointing to the custom URL below.--}}
{{--                    </p>--}}
{{--                    <div class="show__content-redirect">--}}
{{--                        <div class="alert-info">--}}
{{--                            <div class="alert-message">--}}
{{--                                Your 301 redirect should point to the following custom URL--}}
{{--                            </div>--}}
{{--                            <div class="alert-desc">--}}
{{--                                <div class="alert-desc__info">--}}
{{--                                    <div class="alert-content">--}}
{{--                                        <div class="alert-message">--}}
{{--                                            Action--}}
{{--                                        </div>--}}
{{--                                        <div class="alert-action" style="display: block;">--}}
{{--                                            <div class="all__action">--}}
{{--                                                <div class="all__action--item">--}}
{{--                                                    <a href="{{route('user.advertises.download_txt')}}">--}}
{{--                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.9442 9.99952L12.7549 13.1888V2.74951C12.7549 2.72362 12.7535 2.69804 12.751 2.67283C12.7126 2.29464 12.3932 1.99951 12.0049 1.99951C11.5906 1.99951 11.2549 2.3353 11.2549 2.74951V13.1888L8.06551 9.99949C7.77262 9.70659 7.29775 9.70659 7.00485 9.99949C6.71196 10.2924 6.71196 10.7673 7.00485 11.0601L11.4745 15.5298C11.6152 15.6705 11.8059 15.7495 12.0049 15.7495C12.2038 15.7495 12.3945 15.6705 12.5352 15.5298L17.0048 11.0602C17.2977 10.7673 17.2977 10.2924 17.0048 9.99952C16.7119 9.70663 16.2371 9.70663 15.9442 9.99952Z" fill="#fff"></path><path d="M3.00488 19.9995C3.00488 19.5852 3.34067 19.2495 3.75488 19.2495H20.2549C20.6691 19.2495 21.0049 19.5852 21.0049 19.9995C21.0049 20.4137 20.6691 20.7495 20.2549 20.7495H3.75488C3.34067 20.7495 3.00488 20.4137 3.00488 19.9995Z" fill="#fff"></path></svg>--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="all__action--item">--}}
{{--                                                    <a href="" target="_blank">--}}
{{--                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.0475 6.38599H16.5579L4.93354 18.0103C4.81179 18.1321 4.74065 18.2853 4.72012 18.4438C4.71595 18.4759 4.71387 18.5083 4.71387 18.5407C4.71387 18.7326 4.78709 18.9246 4.93354 19.071C5.22643 19.3639 5.7013 19.3639 5.9942 19.071L17.6186 7.44664V11.957C17.6186 12.3713 17.9544 12.707 18.3686 12.707C18.7828 12.707 19.1186 12.3713 19.1186 11.957V5.63598C19.1186 5.22177 18.7828 4.88599 18.3686 4.88599H12.0475C11.9698 4.88599 11.8949 4.89779 11.8245 4.9197C11.5192 5.01466 11.2975 5.29944 11.2975 5.63599C11.2975 5.66187 11.2988 5.68746 11.3014 5.71267C11.3398 6.09086 11.6592 6.38599 12.0475 6.38599Z" fill="#fff"></path></svg>--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                <div class="all__action--item">--}}
{{--                                                    <a href="#" onclick="copyAdsText()">--}}
{{--                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M15 2C16.1046 2 17 2.89543 17 4V16C17 17.1046 16.1046 18 15 18H5C3.89543 18 3 17.1046 3 16V4C3 2.89543 3.89543 2 5 2H15ZM15 3.5C15.2761 3.5 15.5 3.72386 15.5 4V16C15.5 16.2761 15.2761 16.5 15 16.5H5C4.72386 16.5 4.5 16.2761 4.5 16V4C4.5 3.72386 4.72386 3.5 5 3.5H15Z" fill="#fff"></path><path d="M7 21C7 20.5858 7.33579 20.25 7.75 20.25H17C18.2426 20.25 19.25 19.2426 19.25 18V6.75C19.25 6.33579 19.5858 6 20 6C20.4142 6 20.75 6.33579 20.75 6.75V18C20.75 20.0711 19.0711 21.75 17 21.75H7.75C7.33579 21.75 7 21.4142 7 21Z" fill="#fff"></path></svg>--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="col-md-12 col-xl-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Ads.txt configuration</h5>
                    <p style="color: red">Update the ads.txt on your sites in order to keep them active and continue monetizing</p>
                </div>
                <div class="card-body card__ads pt-4">
                    <div class="row">
                        <div class="col-md-6 col-12 left__txt">
                            <div class="left__txt--content">
                                <textarea name="" id="myInput" disabled cols="30" rows="10">{{$adsTxt}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 right__txt">
                            <div class="alert-action" style="display: block;">
                                <div class="all__action" style="display: flex; align-items: center; gap: 10px">
                                    <div class="all__action--item">
                                        <a href="{{route('user.advertises.download_txt')}}">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.9442 9.99952L12.7549 13.1888V2.74951C12.7549 2.72362 12.7535 2.69804 12.751 2.67283C12.7126 2.29464 12.3932 1.99951 12.0049 1.99951C11.5906 1.99951 11.2549 2.3353 11.2549 2.74951V13.1888L8.06551 9.99949C7.77262 9.70659 7.29775 9.70659 7.00485 9.99949C6.71196 10.2924 6.71196 10.7673 7.00485 11.0601L11.4745 15.5298C11.6152 15.6705 11.8059 15.7495 12.0049 15.7495C12.2038 15.7495 12.3945 15.6705 12.5352 15.5298L17.0048 11.0602C17.2977 10.7673 17.2977 10.2924 17.0048 9.99952C16.7119 9.70663 16.2371 9.70663 15.9442 9.99952Z" fill="#fff"></path><path d="M3.00488 19.9995C3.00488 19.5852 3.34067 19.2495 3.75488 19.2495H20.2549C20.6691 19.2495 21.0049 19.5852 21.0049 19.9995C21.0049 20.4137 20.6691 20.7495 20.2549 20.7495H3.75488C3.34067 20.7495 3.00488 20.4137 3.00488 19.9995Z" fill="#fff"></path></svg>
                                        </a>
                                    </div>
                                    {{--                                                <div class="all__action--item">--}}
                                    {{--                                                    <a href="" target="_blank">--}}
                                    {{--                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.0475 6.38599H16.5579L4.93354 18.0103C4.81179 18.1321 4.74065 18.2853 4.72012 18.4438C4.71595 18.4759 4.71387 18.5083 4.71387 18.5407C4.71387 18.7326 4.78709 18.9246 4.93354 19.071C5.22643 19.3639 5.7013 19.3639 5.9942 19.071L17.6186 7.44664V11.957C17.6186 12.3713 17.9544 12.707 18.3686 12.707C18.7828 12.707 19.1186 12.3713 19.1186 11.957V5.63598C19.1186 5.22177 18.7828 4.88599 18.3686 4.88599H12.0475C11.9698 4.88599 11.8949 4.89779 11.8245 4.9197C11.5192 5.01466 11.2975 5.29944 11.2975 5.63599C11.2975 5.66187 11.2988 5.68746 11.3014 5.71267C11.3398 6.09086 11.6592 6.38599 12.0475 6.38599Z" fill="#fff"></path></svg>--}}
                                    {{--                                                    </a>--}}
                                    {{--                                                </div>--}}
                                    <div class="all__action--item">
                                        <a href="#" onclick="copyAdsText()">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M15 2C16.1046 2 17 2.89543 17 4V16C17 17.1046 16.1046 18 15 18H5C3.89543 18 3 17.1046 3 16V4C3 2.89543 3.89543 2 5 2H15ZM15 3.5C15.2761 3.5 15.5 3.72386 15.5 4V16C15.5 16.2761 15.2761 16.5 15 16.5H5C4.72386 16.5 4.5 16.2761 4.5 16V4C4.5 3.72386 4.72386 3.5 5 3.5H15Z" fill="#fff"></path><path d="M7 21C7 20.5858 7.33579 20.25 7.75 20.25H17C18.2426 20.25 19.25 19.2426 19.25 18V6.75C19.25 6.33579 19.5858 6 20 6C20.4142 6 20.75 6.33579 20.75 6.75V18C20.75 20.0711 19.0711 21.75 17 21.75H7.75C7.33579 21.75 7 21.4142 7 21Z" fill="#fff"></path></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script>
        function copyAdsText() {
            if (document.selection) {
                var range = document.body.createTextRange()
                range.moveToElementText(document.getElementById("myInput"))
                range.select().createTextRange()
                document.execCommand("copy")
            } else if (window.getSelection) {
                var range = document.createRange()
                range.selectNode(document.getElementById("myInput"))
                window.getSelection().addRange(range)
                document.execCommand("copy")
            }

            swal("Success!", 'Copied', "success");


        }
    </script>
@endsection

