<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Publisher</h5>
            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form autocomplete="off">
            <div class="modal-body">
                <div class="mb-3">
                    <label>Email<span class="text-danger">*</span></label>
                    <input type="text" name="email" class="form-control" value="{{ $item->email }}" disabled>
                </div>
                <div class="mb-3">
                    <label>Mật khẩu<span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control">
                </div>
                @if(auth()->user()->role->id != \App\Models\User::ROLE_PUBLISHER_MANAGER)
                <div class="mb-3">
                    <label>Assign User</label>
                    <select id="assign_user" class="form-control choose_value select2_init" required
                            name="assign_user">

                        <option value='null'>-Select-</option>
                        @foreach($listUserGroupAdmin as $userAdmin)
                            <option value="{{$userAdmin->id}}" {{in_array($userAdmin->id, $item->getArrayUserAssign() ?? []) ? 'selected' : ''}}>{{$userAdmin->name}}</option>
                        @endforeach
                    </select>
{{--                    <input type="text" hidden name="manager_id" class="form-control" value="0">--}}
{{--                    <div class="form-group mt-3">--}}
{{--                        <label>Manager @include('user.components.lable_require')</label>--}}
{{--                        <select id="manager_id" class="form-control choose_value select2_init" required--}}
{{--                                name="manager_id">--}}
{{--                            <option value="0">-Select-</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    @include('administrator.components.select_category' , ['label' => 'Manager','name' => 'manager_id' ,'html_category' => \App\Models\User::getCategory(isset($item) ? optional($item)->manger_id : '')])--}}
                </div>
                @endif
                <div class="mb-3">
                    <label>Active? @include('user.components.lable_require')</label>
                    <select class="form-control choose_value select2_init" name="user_status_id">
                        @foreach(\App\Models\UserStatus::all() as $itemUserStatus)
                            <option
                                value="{{$itemUserStatus->id}}" {{$itemUserStatus->id == $item->user_status_id ? 'selected' : ''}}>{{$itemUserStatus->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" onclick="update({{ $item->api_publisher_id }})">Save</button>
            </div>
        </form>
    </div>
</div>
