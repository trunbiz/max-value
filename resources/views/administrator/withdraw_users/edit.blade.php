{{--@extends('administrator.layouts.master')--}}

{{--@include('administrator.'.$prefixView.'.header')--}}

{{--@section('css')--}}

{{--@endsection--}}

{{--@section('content')--}}

{{--    <div class="container-fluid list-products">--}}
{{--        <div class="row">--}}

{{--            <form action="{{route('administrator.'.$prefixView.'.update', ['id'=> $item->id]) }}" method="post"--}}
{{--                  enctype="multipart/form-data">--}}
{{--                @method('PUT')--}}
{{--                @csrf--}}
{{--                <div class="col-xxl-6">--}}

{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="form-group mt-3">--}}
{{--                                <label>Title</label>--}}
{{--                                <input type="text" class="form-control" value="{{ $item->title }}" disabled>--}}
{{--                            </div>--}}

{{--                            <div class="form-group mt-3">--}}
{{--                                <label>Domain</label>--}}
{{--                                <input type="text" class="form-control" value="{{ $item->name }}" disabled>--}}
{{--                            </div>--}}

{{--                            <div class="form-group mt-3">--}}
{{--                                <label>Category</label>--}}
{{--                                <input type="text" class="form-control" value="{{ optional($item->getCategory)->name }}"--}}
{{--                                       disabled>--}}
{{--                            </div>--}}

{{--                            <div class="form-group mt-3">--}}
{{--                                <label>Description</label>--}}
{{--                                <input type="text" class="form-control" value="{{ $item->description }}" disabled>--}}
{{--                            </div>--}}


{{--                            <div class="form-group mt-3">--}}
{{--                                <label>Status</label>--}}
{{--                                <select class="form-control select2_init" name="withdraw_status_id">--}}
{{--                                    @foreach(\App\Models\WithdrawStatus::all() as $itemStatus)--}}
{{--                                        <option value="{{$itemStatus->id}}" {{ $itemStatus->id == $item->withdraw_status_id ? 'selected' : ''}}>{{$itemStatus->name}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                @error('withdraw_status_id')--}}
{{--                                <div class="alert alert-danger">{{$message}}</div>--}}
{{--                                @enderror--}}
{{--                            </div>--}}

{{--                            @include('administrator.components.button_save')--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </form>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

{{--@section('js')--}}

{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('input[name="title"]').attr('disabled', 'disabled');--}}
{{--            $('input[name="name"]').attr('disabled', 'disabled');--}}
{{--            $('select[name="category_web"]').attr('disabled', 'disabled');--}}
{{--            $('input[name="description"]').attr('disabled', 'disabled');--}}
{{--        })--}}
{{--    </script>--}}

{{--@endsection--}}

<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title" id="editActiveModalLabel">Change status</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <div class="mt-3">
                <label class="bold">Status? @include('administrator.components.lable_require')</label>
                <select name="status" class="form-control select2_init" required>
                    <option value="1" {{ isset($item) && !empty($item) && $item->withdraw_status_id == 1 ? 'selected' : '' }}>Pending</option>
                    <option value="2" {{ isset($item) && !empty($item) && $item->withdraw_status_id == 2 ? 'selected' : '' }}>Approved</option>
                    <option value="3" {{ isset($item) && !empty($item) && $item->withdraw_status_id == 3 ? 'selected' : '' }}>Reject</option>
                </select>
            </div>
        </div>

        <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" onclick="updateStatus({{$item->id}})">Update now</button>
        </div>

    </div>
</div>

<script>
    function updateStatus(id) {
        var $this = $('#changeStatus');
        callAjax(
            'PUT',
            '{{ route('administrator.withdraw_users.update') }}?id='+id,
            {
                'withdraw_status_id' : $this.find('select[name="status"]').val(),
                'position' : $('#wallet__table .item'+id).find('td:first-child').html(),
            },
            (response) => {
                if(response.status == true){
                    $this.modal('hide');
                    Swal.fire(
                        {
                            icon: 'success',
                            title: 'Add success',
                        }
                    );
                    $('#wallet__table').find('.item'+id).remove();
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

