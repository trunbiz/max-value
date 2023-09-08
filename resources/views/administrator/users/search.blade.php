<div>
{{--    @include('administrator.components.search')--}}

{{--    <div>--}}
{{--        <div class="float-start">--}}
{{--            <select name="limit" class="form-control select2_init">--}}
{{--                @foreach(config('_my_config.items_show_in_table') as $itemShowInTable)--}}
{{--                    <option--}}
{{--                        value="{{$itemShowInTable}}" {{request('limit') == $itemShowInTable ? 'selected' : ''}}>{{$itemShowInTable}}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <a href="{{route('administrator.'.$prefixView.'.create')}}" class="btn btn-outline-success float-end"><i--}}
{{--            class="fa-solid fa-plus"></i></a>--}}
    <form action="{{route('administrator.users.index')}}" method="GET">
    <div class="row">
            <div class="col-sm-3">
                <label>Manager</label>
                <select name="user_assign" class="form-control">
                    <option value=null>All</option>
                    @foreach($listUserGroupAdmin as $userAdmin)
                        <option value="{{$userAdmin->id}}">{{$userAdmin->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3">
                <label>Email</label>
                <input class="form-control" name="email" placeholder="Email">
            </div>
            <div class="col-sm-3">
                <label>Website</label>
                <input class="form-control" name="website" placeholder="Website">
            </div>
            <div class="col-sm-3">
                <label>Verify</label>
                <select name="verify" class="form-control">
                    <option value=null>All</option>
                    <option value=1>Verify</option>
                    <option value=0>No verify</option>
                </select>
            </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-3">
            <label>Status</label>
            <select name="active" class="form-control">
                <option value=null>All</option>
                <option value=1>Active</option>
                <option value=0>No active</option>
            </select>
        </div>
        <div class="col-sm-2">
            <label>Options</label>
            <button class="form-control btn btn-outline-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </div>
    </form>
    <a href="javascript:void(0)" class="btn btn-outline-success float-end" data-bs-toggle="modal"
       data-bs-target="#addPulisher"><i
            class="fa-solid fa-plus"></i></a>

{{--    <a href="{{route('administrator.'.$prefixView.'.export')}}" class="btn btn-outline-primary float-end me-2" data-bs-original-title="" title="Excel"><i class="fa-sharp fa-solid fa-file-excel"></i></i></a>--}}

    <div class="clearfix"></div>
</div>

<div class="modal fade" id="addPulisher" role="dialog" aria-labelledby="addPulisher" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Publisher</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form autocomplete="off">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Email<span class="text-danger">*</span></label>
                        <input type="text" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Mật khẩu<span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    @if(auth()->user()->role->id != \App\Models\User::ROLE_PUBLISHER_MANAGER)
                    <div class="mb-3">
                        <input type="text" hidden name="manager_id" class="form-control" value="{{auth()->user()->id}}">
{{--                        @include('administrator.components.select_category' , ['label' => 'Manager','name' => 'manager_id_add' ,'html_category' => \App\Models\User::getCategory(isset($item) ? optional($item)->manger_id : '')])--}}
                        <label>Assign User</label>
                        <select id="assign_user" class="form-control choose_value select2_init" required
                                name="assign_user">
                            <option value='null'>-Select-</option>
                            @foreach($listUserGroupAdmin as $userAdmin)
                                <option value="{{$userAdmin->id}}">{{$userAdmin->name}}</option>
                            @endforeach
                        </select>

                    </div>
                    @endif
                    <div class="mb-3">
                        <label>Active? @include('user.components.lable_require')</label>
                        <select class="form-control choose_value select2_init" name="user_status_id_add">
                            @foreach(\App\Models\UserStatus::all() as $itemUserStatus)
                                <option
                                    value="{{$itemUserStatus->id}}" {{$itemUserStatus->id == old('user_status_id') ? 'selected' : ''}}>{{$itemUserStatus->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" onclick="store()">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    $('select[name="limit"]').on('change', function () {
        addUrlParameter('limit', this.value)
    });

    function callAjax2(method, url, data, success) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: data,
            type: method,
            url: url,
            beforeSend: function() {
                $('#loader').removeClass('loading');
            },
            success: function( response, textStatus, jqXHR ) {
                success(response);
            },
            complete: function(){
                $('#loader').addClass('loading');
            },
            error: function( jqXHR, textStatus, errorThrown ) {
                alert( errorThrown );
            }
        })
    }

    function store() {
        var $this = $('#addPulisher');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{ route('administrator.users.store') }}',
            data: {
                email: $('input[name="email"]').val(),
                password: $('input[name="password"]').val(),
                manager_id: $('input[name="manager_id"]').val(),
                assign_user: $('select[name="assign_user"]').val(),
                user_status_id: $('select[name="user_status_id_add"]').val(),
            },
            beforeSend: function() {
                showLoading()
            },
            success: function( response, textStatus, jqXHR ) {
                if(response.status == true){
                    $this.modal('hide');
                    Swal.fire(
                        {
                            icon: 'success',
                            title: response.message,
                        }
                    );
                    $('.list__data').prepend(response.html);
                    $this.find('input[name="email"]').val('');
                    $this.find('input[name="password"]').val('');
                    location.reload();
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

</script>
