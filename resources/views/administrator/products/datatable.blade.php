@foreach($items as $index => $item)
    <tr id="{{$item->id}}">
        <td class="text-center">
            <input type="checkbox" class="checkbox-delete-item" value="{{$item->id}}">
        </td>
        <td>{{$item->id}}</td>
        <td>{{\App\Models\Formatter::getShortDescriptionAttribute($item->name, 10)}}</td>
        <td>
            <img class="rounded-circle" src="{{$item->avatar()}}" alt="">
        </td>
        <td>
            {{optional($item->category)->name}}
        </td>
        <td>

        </td>
        <td>

            <a onclick="editProduct({{$item->id}})" type="button" data-bs-toggle="modal"
               data-bs-target="#exampleModal">
                <i class="fa-solid fa-pen text-warning"></i>
            </a>


            <a href="{{route('administrator.products.delete' , ['id'=> $item->id])}}"
               data-url="{{route('administrator.products.delete' , ['id'=> $item->id])}}"
               class="delete action_delete">
                <i class="fa-solid fa-x text-danger"></i>
            </a>

        </td>
    </tr>
@endforeach
