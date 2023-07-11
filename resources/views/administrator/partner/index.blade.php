@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">
                        @include('administrator.'.$prefixView.'.search')
                    </div>

                    <div class="card-body">

                        @include('administrator.components.checkbox_delete_table')

                        <div class="table-responsive product-table">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th><input id="check_box_delete_all" type="checkbox" class="checkbox-parent" onclick="onSelectCheckboxDeleteItem()"></th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>URL</th>
                                    <th>Ads.txt</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody class="list__data">

                                @foreach($items as $item)
                                    <tr class="item{{ $item['id'] }}">
                                        <td class="text-center">
                                            <input type="checkbox" class="checkbox-delete-item" value="{{$item['id']}}">
                                        </td>
                                        <td>{{$item['id']}}</td>
                                        <td>
                                            @foreach($users as $itemUser)
                                                @if($item['id'] == $itemUser->api_publisher_id)
                                                    <form action="{{ route('administrator.imperrsonate') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ $itemUser->id }}">
                                                        <button class="btn btn-primary"> {{$item['name']}}</button>
                                                    </form>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($users as $itemUser)
                                                @if($item['id'] == $itemUser->api_publisher_id)
                                                    {{ $itemUser->url }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($users as $itemUser)
                                                @if($item['id'] == $itemUser->api_publisher_id)
                                                    {{ $itemUser->partner_code }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{$item['created_at']}}</td>
                                        <td>

                                            <a href="javascript:void(0)" onclick="edit({{ $item['id'] }})"
                                               title="Edit">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>

                                            <a class="delete action_delete"
                                               href="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item['id'] ])}}"
                                               data-url="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item['id'] ])}}"
                                               title="Delete">
                                                <i class="fa-solid fa-x text-danger"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                            @include('administrator.components.footer_table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Individual column searching (text inputs) Ends-->
    <!-- Container-fluid Ends-->

    <!-- Modal -->
    <div class="modal fade" id="editActiveModal" aria-labelledby="editActiveModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="editActiveModalLabel">Change status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mt-3">
                        <label class="bold">Active? @include('administrator.components.lable_require')</label>
                        <select name="active_id" class="form-control select2_init" required>
                            <option value="true">Yes</option>
                            <option value="false">No</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" onclick="onSubmitEditActive()">Update now</button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="editPartner" role="dialog" aria-labelledby="editPartner" aria-hidden="true"></div>

@endsection

@section('js')
    <script>

        let id_user
        let id_status


        function onEditActiveModal(id, idstatus) {
            id_user = id;
            $('select[name="active_id"]').val(idstatus).change()
        }

        function onSubmitEditActive() {

            $.ajax({
                type: "PUT",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: true,
                data: {
                    is_active: $('select[name="active_id"]').val() == "true" ? 1 : 0,
                },
                url: "{{route('administrator.users.update.active')}}"+ '?id='+id_user,
                beforeSend: function () {
                    showLoading()
                },
                success: function (response) {
                    if(response.status == true){
                        $('#editActiveModal').modal('hide');
                        $('.list__data').find('.item'+id_user).find('td:nth-child(6)').html('<a style="cursor: pointer;" onclick="onEditActiveModal('+id_user+','+response.is_active+')" data-bs-toggle="modal" data-bs-target="#editActiveModal" data-bs-original-title="" title="">'+response.is_active+'</a>');
                        Swal.fire(
                            {
                                icon: 'success',
                                title: response.message,
                            }
                        );
                    }else{
                        Swal.fire(
                            {
                                icon: 'error',
                                title: response.message,
                            }
                        );
                    }
                },
                error: function (err) {
                    hideLoading()
                    Swal.fire(
                        {
                            icon: 'error',
                            title: err.responseText,
                        }
                    );
                    console.log(err)
                },
            })
        }

        function edit(id) {
            var $this = $('#editPartner');
            callAjax(
                'GET',
                '{{route('administrator.partner.edit')}}'+ '?id='+id,
                {},
                (response) => {
                    $this.html(response.html);
                    $this.modal('show');
                }
            )
        }

        function update(id) {
            var $this = $('#editPartner');
            callAjax(
                'PUT',
                '{{route('administrator.partner.update')}}'+ '?id='+id,
                {
                    name: $this.find('input[name="name"]').val(),
                    password: $this.find('input[name="password"]').val(),
                    // manager_id: $this.find('select[name="manager_id"]').val(),
                    idcloudrole: 3,
                    url : $this.find('input[name="url"]').val(),
                    partner_code: $this.find('textarea[name="partner_code"]').val(),
                    //user_status_id: $this.find('select[name="user_status_id"]').val(),
                },
                (response) => {
                    if(response.status == true){
                        $this.modal('hide');
                        Swal.fire(
                            {
                                icon: 'success',
                                title: response.message,
                            }
                        );
                        $('.list__data').find('.item'+id).after(response.html).remove();
                    }else{
                        Swal.fire(
                            {
                                icon: 'error',
                                title: response.message,
                            }
                        );
                    }
                }
            )
        }

        $('select[name="web_site_id_publisher"]').select2({
            dropdownParent: $('#createWebsiteModal')
        });

        $('#edit_select_idpublisher_site').select2({
            dropdownParent: $('#editWebsiteModal')
        });
    </script>
@endsection
