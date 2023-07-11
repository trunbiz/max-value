@extends('administrator.layouts.master')

@include('administrator.employees.header')

@section('css')

@endsection

@section('content')

    <div class="container-fluid list-products">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-end">
                            <div class="col-md-3">
{{--                                <label>Ngày tạo</label>--}}
{{--                                <span>--}}
{{--                                        <input type="text" id="config-demo" class="form-control">--}}
{{--                                    </span>--}}
                            </div>

                            <div class="col-md-9 text-end">
                                <button class="btn btn-primary float-end m-2" data-bs-toggle="modal"
                                        data-bs-target="#modal_add_user" data-bs-whatever="@mdo">Thêm mới
                                </button>
{{--                                <button onclick="exportExcel()" class="btn btn-success float-end m-2">Export--}}
{{--                                </button>--}}
                            </div>
                        </div>

                    </div>

                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <table class="display table-users" id="basic-1" data-order='[[ 0, "desc" ]]'>
                                <thead>
                                <tr>
                                    <th>Mã NV</th>
                                    <th>Vai trò</th>
                                    <th>Tên NV</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                    <th>Ngày sinh</th>
                                    <th>Giới tính</th>
                                    <th>Ngày sử dụng</th>
                                    <th style="min-width: 200px;">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($items as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{optional($item->role)->name}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{\App\Models\Formatter::getOnlyDate($item->date_of_birth)}}</td>
                                        <td>{{ optional($item->gender)->name}}</td>
                                        <td>{{\App\Models\Formatter::getDateTime($item->created_at)}}</td>
                                        <td>
                                            <a class="btn btn-outline-secondary btn-sm edit"
                                               data-id="{{$item->id}}">Sửa</a>

                                            <a href="{{route('administrator.employees.delete' , ['id'=> $item->id])}}"
                                               data-url="{{route('administrator.employees.delete' , ['id'=> $item->id])}}"
                                               class="btn btn-danger btn-sm delete">
                                                Xóa
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_add_user" tabindex="-1" aria-labelledby="modal_add_user" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tạo {{$title}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="col-form-label">Tên<span class="text-danger">*</span></label>
                            <input id="input_name" class="form-control" type="text"/>
                        </div>
                        <div class="col-md-3">
                            <label class="col-form-label">SĐT<span class="text-danger">*</span></label>
                            <input id="input_phone" class="form-control" type="text"/>
                        </div>
                        <div class="col-md-3">
                            <label class="col-form-label">Mật khẩu<span class="text-danger">*</span></label>
                            <input id="input_password" class="form-control" type="text"/>
                        </div>
                        <div class="col-md-3">
                            <label class="col-form-label">Email<span class="text-danger">*</span></label>
                            <input id="input_email" class="form-control" type="text"/>
                        </div>
                        <div class="col-md-3 form-group mt-3">
                            <label>Ngày sinh</label>
                            <input id="input_date_of_birth" type="date" name="date_of_birth" class="form-control">
                        </div>

                        <div class="col-md-6 form-group mt-3">
                            <label>Vai trò</label>
                            <select id="select_role_id" class="form-select" aria-label="Default select example">
                                @foreach($roles as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label class="me-3">Giới tính</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="input_gender" checked>
                                <label class="form-check-label" for="input_gender">Nam</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2">
                                <label class="form-check-label" for="inlineRadio2">Nữ</label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-end">
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary" onclick="confirmAddUser()">Xác nhận</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_edit_user" tabindex="-1" aria-labelledby="modal_edit_user" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sửa {{$title}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="col-form-label">Tên<span class="text-danger">*</span></label>
                            <input id="input_name_edit" class="form-control" type="text"/>
                        </div>
                        <div class="col-md-3">
                            <label class="col-form-label">SĐT<span class="text-danger">*</span></label>
                            <input id="input_phone_edit" class="form-control" type="text"/>
                        </div>
                        <div class="col-md-3">
                            <label class="col-form-label">Mật khẩu<span class="text-danger">*</span></label>
                            <input id="input_password_edit" class="form-control" type="text"/>
                        </div>
                        <div class="col-md-3">
                            <label class="col-form-label">Email<span class="text-danger">*</span></label>
                            <input id="input_email_edit" class="form-control" type="text"/>
                        </div>
                        <div class="col-md-6 form-group mt-3">
                            <label>Ngày sinh</label>
                            <input id="input_date_of_birth_edit" type="date" name="date_of_birth"
                                   class="form-control @error('date_of_birth') is-invalid @enderror"
                                   placeholder="Nhập ngày sinh" value="{{old('date_of_birth')}}">
                            @error('date_of_birth')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group mt-3">
                            <label>Vai trò</label>
                            <select id="select_role_id_edit" class="form-select" aria-label="Default select example">
                                @foreach($roles as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3" style="display: none;">
                            <label class="me-3">Giới tính</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender_edit" id="input_gender_edit" checked>
                                <label class="form-check-label" for="input_gender_edit">Nam</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender_edit" id="inlineRadio2_edit">
                                <label class="form-check-label" for="inlineRadio2_edit">Nữ</label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-end">
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary" onclick="confirmEditUser()">Cập nhật</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')

    <script>

        let idEdited, tableRowEdited, table;

        function confirmAddUser() {
            if (!isEmptyInput("input_name", true, "Tên đang trống", true)
                && !isEmptyInput("input_email", true, "Email đang trống", true)
                && !isEmptyInput("input_phone", true, "Số điện thoại đang trống", true)
                && !isEmptyInput("input_password", true, "Mật khẩu đang trống", true)) {
                showLoading()
                callAjax(
                    "POST",
                    "{{route('administrator.employees.store')}}",
                    {
                        name: $("#input_name").val(),
                        phone: $("#input_phone").val(),
                        password: $("#input_password").val(),
                        email: $("#input_email").val(),
                        date_of_birth: $("#input_date_of_birth").val(),
                        role_id: $("#select_role_id").val(),
                        is_admin: 1,
                        gender_id: isCheckedInput("input_gender") ? 1 : 2,
                    },
                    (response) => {
                        hideModal("modal_add_user")
                        console.log(response)

                        window.location.reload()

                        // $('.table-users').DataTable().row.add([
                        //     response.id,
                        //     response.role?.name,
                        //     response.name,
                        //     response.phone,
                        //     response.email,
                        //     getOnlyDate(response.date_of_birth),
                        //     response.gender?.name,
                        //     getFormattedDate(response.created_at),
                        //     `  <td>
                        //                         <a class="btn btn-outline-secondary btn-sm edit" data-id="${response.id}">Sửa</a>
                        //
                        //                         <a href="/administrator/users/delete/${response.id}" data-url="/administrator/users/delete/${response.id}" class="btn btn-danger btn-sm delete">
                        //                             Xóa
                        //                         </a>
                        //                     </td>`
                        // ]).draw();
                    },
                    (error) => {

                    }
                )
            }

        }

        function confirmEditUser() {
            if (!isEmptyInput("input_name_edit", true, "Tên đang trống", true)
                && !isEmptyInput("input_email_edit", true, "Email đang trống", true)
                && !isEmptyInput("input_phone_edit", true, "Số điện thoại đang trống", true)) {
                showLoading()
                callAjax(
                    "PUT",
                    "/administrator/employees/update/" + idEdited,
                    {
                        name: $("#input_name_edit").val(),
                        phone: $("#input_phone_edit").val(),
                        password: $("#input_password_edit").val(),
                        email: $("#input_email_edit").val(),
                        role_id: $("#select_role_id_edit").val(),
                        date_of_birth: $("#input_date_of_birth_edit").val(),
                        gender_id: isCheckedInput("input_gender_edit") ? 1 : 2,
                    },
                    (response) => {
                        hideModal("modal_edit_user")

                        window.location.reload()

                        // table.row(tableRowEdited).data([
                        //     response.id,
                        //     response.role?.name,
                        //     response.name,
                        //     response.phone,
                        //     response.email,
                        //     getOnlyDate(response.date_of_birth),
                        //     response.gender?.name,
                        //     getFormattedDate(response.created_at),
                        //     `  <td>
                        //                         <a class="btn btn-outline-secondary btn-sm edit" data-id="${response.id}">Sửa</a>
                        //
                        //                         <a href="/administrator/users/delete/${response.id}" data-url="/administrator/users/delete/${response.id}" class="btn btn-danger btn-sm delete">
                        //                             Xóa
                        //                         </a>
                        //                     </td>`,
                        // ]).draw();

                    },
                    (error) => {

                    }
                )
            }

        }

        function exportExcel() {
            window.location.href = "{{route('administrator.employees.export')}}" + window.location.search
        }

        function editUser(id, tableRow = null) {

            idEdited = id
            tableRowEdited = tableRow

            callAjax(
                "GET",
                "/administrator/employees/" + id,
                {},
                (response) => {
                    showModal("modal_edit_user")
                    console.log(response)

                    $('#input_name_edit').val(response.name)
                    $('#input_phone_edit').val(response.phone)
                    $('#input_email_edit').val(response.email)
                    $('#input_date_of_birth_edit').val(response.date_of_birth)
                    $('#select_role_id_edit').val(response.role_id)

                    if (response.gender_id == 2) {
                        $('#inlineRadio2_edit').prop('checked', true)
                    } else {
                        $('#input_gender_edit').prop('checked', true)
                    }

                },
                (error) => {

                }
            )
        }

        $( document ).ready(function() {

            $(".table-users").dataTable().fnDestroy();

            table = $('.table-users').DataTable({
                scrollX: true,
            });
            $('.table-users tbody').on('click', 'a.delete', function (e) {
                event.preventDefault()
                actionDelete(e, $(this).data('url'), table, $(this).parents('tr'))
            });

            $('.table-users tbody').on('click', 'a.edit', function (e) {
                event.preventDefault()
                var tableRow = table.row($(this).parents('tr'));
                editUser($(this).data('id'), tableRow)
            });

        });

    </script>

@endsection
