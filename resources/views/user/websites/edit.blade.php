@extends('user.layouts.master')

@include('user.'.$prefixView.'.header')

@section('css')

@endsection

@section('content')

    <div class="container-fluid list-products">
        <div class="row">

            <form action="{{route('user.'.$prefixView.'.update', ['id'=> $item->id]) }}" method="post"
                  enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="col-md-12">
                    @include('user.components.require_input_text' , ['name' => 'title' , 'label' => 'Title'])

                    @include('user.components.require_input_text' , ['name' => 'name' , 'label' => 'Website'])

                    @include('user.components.select_category' , ['label' => 'Category', 'name' => 'category_web' ,'html_category' => \App\Models\TypeCategory::getCategory(isset($item) ? optional($item)->category_id : ''), 'can_create' => true])

                    @include('user.components.input_text' , ['name' => 'description' , 'label' => 'Description'])

                    @include('user.components.button_save')

                </div>
            </form>

        </div>
    </div>
@endsection

@section('js')

<script>
   $('input[name="name"]').attr('disabled');

</script>

@endsection
