@extends('user.layouts.master')

@section('title')
    <title>{{$title}}</title>

    <meta name="keyword" content="{{env('APP_NAME')}}">
    <meta name="promotion" content="{{env('APP_NAME')}}">
    <meta name="Description" content="{{env('APP_NAME')}}">

    <meta property="og:url" content="{{env('APP_URL')}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{env('APP_NAME')}}"/>
    <meta property="og:description" content="{{env('APP_NAME')}}"/>
    <meta property="og:image" content="{{env('APP_URL') . \App\Models\Helper::logoImagePath() }}"/>

@endsection

@section('name')
    <h4 class="page-title">{{$title}}</h4>
@endsection

@section('css')

@endsection

@section('content')

    <main class="home">
        <!-- START Information -->
        <section class="info">
            <div class="container-xl">
                <div class="row">
                    <div class="col-md-3 col-sm-0">
                       @include('user.components.sidebars_user')
                    </div>

                    <div class="col-md-6 col-sm-12">
                        <div class="info-body__card">
                            <div class="info-body__wrapper">
                                <div class="info-body__title">Thông tin tài khoản</div>
                                <form id="profile" autocomplete="off">
                                    <div name="name" value="nat" class="info-body__input">
                                        <div class="form-input__label">Họ tên</div>
                                        <input name="name" class="form-input__input" value="{{ auth()->user()->name }}">
                                    </div>
                                    <div name="email" value="" class="info-body__input">
                                        <div class="form-input__label">Email</div>
                                        <input name="email" class="form-input__input" value="{{ auth()->user()->email }}">
                                    </div>
                                    <div name="telephone" value="0853212490" class="info-body__input">
                                        <div class="form-input__label">Số điện thoại</div>
                                        <input name="telephone" class="form-input__input" value="{{ auth()->user()->phone }}">
                                    </div>
                                    <div name="dob" value="" type="date" class="info-body__input">
                                        <div class="form-input__label">Ngày sinh</div>
                                        <input name="dob" type="date" class="form-input__input" value="{{ \App\Models\Helper::convert_date_to_db(auth()->user()->date_of_birth)  }}">
                                    </div>
                                    <div name="sex" value="" class="info-body__input">
                                        <div class="form-input__label">Giới tính</div>
                                        <label class="form-input__radio">
                                            <input name="sex" type="radio" {{ auth()->user()->gender_id == 1 ? 'checked' : '' }} value="1">Nam</label>
                                        <label class="form-input__radio">
                                            <input name="sex" type="radio" {{ auth()->user()->gender_id == 2 ? 'checked' : '' }} value="2">Nữ</label>
                                        <label class="form-input__radio">
                                            <input name="sex" type="radio" {{ auth()->user()->gender_id == 0 ? 'checked' : '' }} value="O">Khác</label>
                                    </div>

                                    <button class="info-body__btn details-product__btn">Cập nhật</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="info-rights">
                            <div class="info-right__card">
                                <div class="info_right__wrapper">
                                    <div type="title" class="info-body__title">Địa chỉ mặc định</div>
                                    <svg fill="none" viewBox="0 0 24 24" size="24" class="css-9w5ue6" height="24"
                                         width="24" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M14.4798 5.35373C14.968 4.86557 15.7594 4.86557 16.2476 5.35373L16.6919 5.79803C17.1801 6.28618 17.1801 7.07764 16.6919 7.56579L16.1819 8.07582L13.9698 5.86375L14.4798 5.35373ZM12.9092 6.92441L6.23644 13.5971L5.68342 16.3622L8.44851 15.8092L15.1212 9.13648L12.9092 6.92441ZM16.707 9.67199L9.3486 17.0304C9.24389 17.1351 9.11055 17.2065 8.96535 17.2355L4.87444 18.0537C4.62855 18.1029 4.37434 18.0259 4.19703 17.8486C4.01971 17.6713 3.94274 17.4171 3.99192 17.1712L4.8101 13.0803C4.83914 12.9351 4.91051 12.8017 5.01521 12.697L13.4192 4.29307C14.4931 3.21912 16.2343 3.21912 17.3083 4.29307L17.7526 4.73737C18.8265 5.81131 18.8265 7.55251 17.7526 8.62645L16.7174 9.66162C16.7157 9.66336 16.714 9.6651 16.7122 9.66683C16.7105 9.66856 16.7088 9.67028 16.707 9.67199ZM3.15918 20.5908C3.15918 20.1766 3.49497 19.8408 3.90918 19.8408H20.2728C20.687 19.8408 21.0228 20.1766 21.0228 20.5908C21.0228 21.005 20.687 21.3408 20.2728 21.3408H3.90918C3.49497 21.3408 3.15918 21.005 3.15918 20.5908Z"
                                              fill="#82869E"></path>
                                    </svg>
                                </div>

                                <div direction="column" class="info-right__column">
                                    <div class="info-right__column-input" width="100%">
                                        <div type="subtitle" color="textPrimary" class="form-input__label">
                                            Tỉnh/Thành phố</div>
                                        <div class="topic_right_input" height="40">
                                            <input type="text" maxlength="255" readonly="" value="Thành phố Hải Phòng">
                                        </div>
                                    </div>
                                    <div class="info-right__column-input" width="100%">
                                        <div type="subtitle" color="textPrimary" class="form-input__label">
                                            Quận/Huyện</div>
                                        <div class="topic_right_input" height="40">
                                            <input type="text" maxlength="255" readonly="" value="Quận Lê Chân">
                                        </div>
                                    </div>
                                    <div class="info-right__column-input" width="100%">
                                        <div type="subtitle" color="textPrimary" class="form-input__label">
                                            Phường/Xã</div>
                                        <div class="topic_right_input" height="40">
                                            <input type="text" maxlength="255" readonly="" value="Phường Vĩnh Niệm">
                                        </div>
                                    </div>
                                    <div class="info-right__column-input" width="100%">
                                        <div type="subtitle" color="textPrimary" class="form-input__label">
                                            Địa chỉ cụ thể</div>
                                        <div class="topic_right_input" height="40">
                                            <input type="text" maxlength="255" readonly="" value="Cao Minh, Vĩnh Bảo">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- END Information -->
    </main>
    <!-- End Content -->

@endsection

@section('js')

    <script>
        $('#profile').on('submit', function (e) {
            e.preventDefault();
            var $this = $(this);
            callAjax(
                'PUT',
                '{{ route('user.profile.update') }}',
                $this.serialize(),
                (response) => {
                    if( response.status == true ) {
                        swal("Success!", response.message, "success");
                        $('#phoneUser').html(response.phone);
                    } else {
                        swal("Error!", response.message, "error");
                    }
                }
            )
        })
    </script>

@endsection
