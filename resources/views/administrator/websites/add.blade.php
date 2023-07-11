@extends('administrator.layouts.master')

@include('administrator.'.$prefixView.'.header')

@section('css')


@endsection

@section('content')

    <div class="container-fluid list-products">
        <form action="{{route('administrator.'.$prefixView.'.store')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">

                            @include('administrator.components.input_text' , ['name' => 'name' , 'label' => 'Name'])

                            <div class="form-group mt-3">
                                <label>Publisher @include('user.components.lable_require')</label>
                                <select
                                    class="form-control choose_value select2_init @error("idpublisher") is-invalid @enderror"
                                    required name="idpublisher">
                                    @foreach($publishers as $publisher)
                                        <option value="{{$publisher['id']}}">{{$publisher['name']}}</option>
                                    @endforeach
                                </select>
                                @error('idpublisher')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="form-group mt-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="active" id="inlineRadio1" value="1" checked>
                                    <label class="form-check-label" for="inlineRadio1">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="active" id="inlineRadio2" value="0">
                                    <label class="form-check-label" for="inlineRadio2">InActive</label>
                                </div>
                            </div>

                            @include('administrator.components.require_input_text' , ['name' => 'url' , 'label' => 'Website URL'])

                            <div class="form-group mt-3">
                                <label>Category @include('user.components.lable_require')</label>
                                <select
                                    class="form-control choose_value select2_init @error("idcategory") is-invalid @enderror"
                                    required name="idcategory">
                                    <option value="13">Arts &amp; Entertainment</option>
                                    <option value="33">Automotive</option>
                                    <option value="34">Business</option>
                                    <option value="35">Careers</option>
                                    <option value="36">Education</option>
                                    <option value="37">Family &amp; Parenting</option>
                                    <option value="39">Food &amp; Drink</option>
                                    <option value="28">Health &amp; fitness</option>
                                    <option value="10">Hobbies &amp; Interests</option>
                                    <option value="41">Home &amp; Garden</option>
                                    <option value="42">Law, Government, &amp; Politics</option>
                                    <option value="11">News &amp; Media</option>
                                    <option value="7">Personal Finance</option>
                                    <option value="47">Pets</option>
                                    <option value="52">Real Estate</option>
                                    <option value="46">Science</option>
                                    <option value="23">Shopping</option>
                                    <option value="8">Society</option>
                                    <option value="5">Sports</option>
                                    <option value="49">Style &amp; Fashion</option>
                                    <option value="6">Technology &amp; Computing</option>
                                    <option value="51">Travel</option>
                                    <option value="31">Uncategorized</option>
                                </select>
                                @error('idcategory')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>

                            @include('administrator.components.input_text' , ['name' => 'description' , 'label' => 'Description'])

                            @include('administrator.components.button_save')
                        </div>
                    </div>
                </div>
            </div>


        </form>


    </div>

@endsection

@section('js')


@endsection

