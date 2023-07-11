<tr id="item{{$item->id}}">
    <td class="text-center">
        <input type="checkbox" class="checkbox-delete-item" value="{{$item->id}}">
    </td>
    <td>{{$item->id}}</td>
    <td>{{$item->name}}</td>
    <td>
        <img class="rounded-circle" src="{{$item->avatar()}}" alt="">
    </td>
    <td>
        <div class="form-check">
            <input class="form-check-input" id="show_home" onchange="showHome({{ $item->id }}, {{ $item->show_home == 1 ? 0 : 1 }})" type="checkbox" {{ (isset($item) && !empty($item) && $item->show_home == 1) ? 'checked' : '' }}>
            <label class="form-check-label" for="show_home"></label>
        </div>
    </td>
    <td>{{\App\Models\Formatter::getDateTime($item->created_at)}}</td>
    <td>
        <a href="{{route('administrator.'.$prefixView.'.edit' , ['id'=> $item->id ])}}"
           class="btn btn-outline-secondary btn-sm edit" title="Edit">
            <i class="fa-solid fa-pen"></i>
        </a>

        <a href="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item->id])}}"
           data-url="{{route('administrator.'.$prefixView.'.delete' , ['id'=> $item->id])}}"
           class="btn btn-outline-danger btn-sm delete action_delete"
           title="Delete">
            <i class="fa-solid fa-x"></i>
        </a>
    </td>
</tr>
