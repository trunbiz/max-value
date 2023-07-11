<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EmployeeExport;
use App\Exports\ModelExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\Helper;
use App\Models\Role;
use App\Models\TransectionUser;
use App\Models\User;
use App\Traits\BaseControllerTrait;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use function view;

class EmployeeController extends Controller
{
    use BaseControllerTrait;
    use DeleteModelTrait;

    public function __construct(User $model)
    {
        $roles = Role::all();
        $this->initBaseModel($model);
        $this->isSingleImage = true;
        $this->isMultipleImages = false;
        $this->prefixView = 'employees';
        $this->shareBaseModel($model);
        View::share('roles', $roles);
    }

    public function index(Request $request)
    {
        $items = $this->model->searchByQuery($request, ['is_admin' => 1]);
        return view('administrator.'.$this->prefixView.'.index', compact('items'));
    }

    public function get(Request $request, $id)
    {
        return $this->model->findById($id);
    }

    public function create()
    {
        return view('administrator.'.$this->prefixView.'.add');
    }

    public function store(UserAddRequest $request)
    {
        DB::beginTransaction();

        try {



            $params = [
                'name' => $request->name == '' ? $request->email : $request->name,
                'email' => $request->email,
                'idrole' => 2,
                'is_active' => 1,
            ];

            $itemApi = Helper::callPostHTTP("https://api.adsrv.net/v2/user", $params);


            if (Helper::isErrorAPIAdserver($itemApi)){
                DB::rollback();
                return $itemApi;
            }

            $dataInsert = [
                'name' => $request->name == '' ? $request->email : $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'user_type_id' => $request->user_type_id ?? 1,
                'date_of_birth' => $request->date_of_birth,
                'gender_id' => $request->gender_id ?? 1,
                'email_verified_at' => now(),
                'password' => Hash::make($request->password),
                'manager_id' => $request->manager_id ?? 0,
                'api_publisher_id' => $itemApi['id'],
                'user_status_id' => $request->user_status_id ?? 1,
                'is_admin' => 1,
                'role_id' => $request->role_id,
            ];

            $item = User::firstOrCreate($dataInsert);

            if (!empty($request->is_admin && $request->is_admin == 1 && isset($request->role_ids))){
                $item->roles()->attach($request->role_ids);
            }

            $item->refresh();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

        return $item;

    }

    public function edit($id)
    {
        $item = $this->model->findById($id);
        $rolesOfUser = $item->roles;
        return view('administrator.'.$this->prefixView.'.edit', compact('item','rolesOfUser'));
    }

    public function update($id, UserEditRequest $request)
    {
        $dataInsert = [
            'name' => $request->name == '' ? $request->email : $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'user_type_id' => $request->user_type_id ?? 1,
            'date_of_birth' => $request->date_of_birth,
            'gender_id' => $request->gender_id ?? 1,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'manager_id' => $request->manager_id ?? 0,
            'api_publisher_id' => 0,
            'user_status_id' => $request->user_status_id ?? 1,
            'is_admin' => 1,
            'role_id' => $request->role_id,
        ];

        $item = User::find($id)->update($dataInsert);

        return $item;
    }

    public function delete($id)
    {
        $item = User::findOrFail($id);

        Helper::callDeleteHTTP('https://api.adsrv.net/v2/user/' . $item->api_publisher_id);

        return $this->deleteModelTrait($id, $this->model, true);
    }

    public function deleteManyByIds(Request $request)
    {
        return $this->model->deleteManyByIds($request, $this->forceDelete);
    }

    public function export(Request $request)
    {
        return Excel::download(new ModelExport($this->model, $request), $this->prefixView . '.xlsx');
    }
}
