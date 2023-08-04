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
                                    <th>Manager</th>
                                    <th>Email</th>
                                    <th>Website</th>
                                    <th class="text-center">Verified</th>
                                    <th>Active</th>
                                    <th>Money</th>
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
                                                    {{optional($itemUser->manager)->name}}
                                                    @break
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($users as $itemUser)
                                                @if($item['id'] == $itemUser->api_publisher_id)
                                                    <form action="{{ route('administrator.imperrsonate') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ $itemUser->id }}">
                                                        <button class="btn btn-primary"> {{$item['email']}}</button>
                                                    </form>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <ul>
                                                @foreach($urls as $url)
                                                    @if($item['id'] == $url['publisher']['id'])
                                                        @if($url['status']['id'] == 3500)
                                                            <a href="{{ route('administrator.websites.index') }}?publisher_id={{ $item['id'] }}" style="color: #41C866; display: block">
                                                                {{ $url['url'] }}
                                                            </a>
                                                        @elseif($url['status']['id'] == 3525 || $url['status']['id'] == 3510)
                                                            <a href="{{ route('administrator.websites.index') }}?publisher_id={{ $item['id'] }}" style="color: #ff0000; display: block">
                                                                {{ $url['url'] }}
                                                            </a>
                                                        @else
                                                            <a href="{{ route('administrator.websites.index') }}?publisher_id={{ $item['id'] }}" style="color: #ffc500; display: block">
                                                                {{ $url['url'] }}
                                                            </a>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="text-center">
                                            @foreach($users as $itemUser)
                                                @if($item['id'] == $itemUser->api_publisher_id)
                                                    <i class="fa fa-check-circle" style="color: {{ (isset($itemUser['email_verified_at']) && !empty($itemUser['email_verified_at']) ? '#41C866' : '#aaaaaa') }}"></i>
                                                    @break
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <a style="cursor: pointer;" onclick="onEditActiveModal('{{$item['id']}}','{{$item['is_active'] ? 'true' : 'false'}}')" data-bs-toggle="modal"
                                               data-bs-target="#editActiveModal">
                                                {{$item['is_active'] ? "Yes" : "No"}}
                                            </a>
                                        </td>
                                        <td>
                                            @php
                                                $money = 0;
                                            @endphp
                                            @foreach($users as $itemUser)
                                                @if($item['id'] == $itemUser->api_publisher_id)
                                                    @php
                                                        $money = $itemUser->money;
                                                    @endphp
                                                    @break
                                                @endif
                                            @endforeach
                                            {{ '$'. $money }}
                                        </td>

                                        <td>{{$item['created_at']}}</td>
                                        <td>

                                            <a href="javascript:void(0)" onclick="edit({{ $item['id'] }})"
                                               title="Edit">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                            <a href="{{route('administrator.websites.index' , ['publisher_id'=> $item['id'] ])}}"
                                               title="Web">
                                                <i class="fa-solid fa-globe"></i>
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

    <div class="modal fade" id="editPulisher" role="dialog" aria-labelledby="editPulisher" aria-hidden="true"></div>

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
            var $this = $('#editPulisher');
            callAjax(
                'GET',
                '{{route('administrator.users.edit')}}'+ '?id='+id,
                {},
                (response) => {
                    if(!response.status)
                    {
                        alert(response.message)
                    }else{
                        $this.html(response.html);
                        $this.modal('show');
                    }
                }
            )
        }

        function update(id) {
            var $this = $('#editPulisher');
            callAjax(
                'PUT',
                '{{route('administrator.users.update')}}'+ '?id='+id,
                {
                    password: $this.find('input[name="password"]').val(),
                    manager_id: $this.find('select[name="manager_id"]').val(),
                    user_status_id: $this.find('select[name="user_status_id"]').val(),
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
    </script>
@endsection
