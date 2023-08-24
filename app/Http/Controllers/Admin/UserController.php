<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ModelExport;
use App\Http\Controllers\Controller;
use App\Models\AssignUserModel;
use App\Models\CampaignAd;
use App\Models\Formatter;
use App\Models\Helper;
use App\Models\Role;
use App\Models\User;
use App\Models\UserType;
use App\Services\AssignUserService;
use App\Services\Common;
use App\Services\UserService;
use App\Traits\BaseControllerTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use function view;

class UserController extends Controller
{
    use BaseControllerTrait;

    public function __construct(User $model, Role $role)
    {
        $this->initBaseModel($model);
        $this->isSingleImage = false;
        $this->isMultipleImages = false;
        $this->title = "Publishers";
        $this->shareBaseModel($model);
        $this->role = $role;
        $userTypes = UserType::all();
        $this->commonService = new Common();
        $this->assignUserService = new AssignUserService();
        $this->userService = new UserService();
        View::share('userTypes', $userTypes);
    }

    public function index(Request $request)
    {
        $listApiPublisherId = [];
        $listUserAssign = [];

//        if (!Gate::check('register-product-list')){
//            return redirect()->route('administrator.dashboard.index');
//        }
//        if (auth()->user()->is_admin == 2 || optional(auth()->user()->role)->name == "Admin") {
        $items = Helper::callGetHTTP("https://api.adsrv.net/v2/user?page=1&per-page=10000&filter[idrole]=4") ?? [];
//        } else {
//            $items = Helper::callGetHTTP("https://api.adsrv.net/v2/user?page=1&per-page=10000&filter[idrole]=4&filter[idmanager]=" . auth()->user()->api_publisher_id) ?? [];
//        }
        foreach ($items as $item)
        {
            $listApiPublisherId[] = $item['id'];
        }

        // Nếu là Publisher manager thì chỉ được nhìn các publisher tạo được ass
        foreach ($items as $key => $item) {
            $publisherInfo = User::where('api_publisher_id', $item['id'])->first();
            if (empty($publisherInfo))
                continue;

            // Lấy thông tin các publisher được assign
            $listUserAssign[$item['id']] = !empty($publisherInfo->getFirstUserAssign()->id) ? ($publisherInfo->getFirstUserAssign()->getInfoAssign()->name) : (empty($publisherInfo->manager_id) ? '' : User::find($publisherInfo->manager_id)->name);

            if (auth()->user()->is_admin == 1 && auth()->user()->role->id == User::ROLE_PUBLISHER_MANAGER) {
                if ((!empty($publisherInfo->getFirstUserAssign()->user_id) && $publisherInfo->getFirstUserAssign()->user_id != auth()->user()->id) || empty($publisherInfo->getFirstUserAssign())) {
                    unset($items[$key]);
                }
            }
        }

//        $users = $this->model->searchByQuery($request, ['is_admin' => 0]);
        $users = User::whereIn('api_publisher_id', $listApiPublisherId)->get();

        $urls = Helper::callGetHTTP('https://api.adsrv.net/v2/site?per-page=10000000');

        $items = Formatter::paginator($request, $items);

        $data = [
            'items' => $items,
            'users' => $users,
            'urls' => $urls,
            'listUserAssign' => $listUserAssign,
            'listUserGroupAdmin' => $this->commonService->listUserGroupAdmin()
        ];
        return view('administrator.' . $this->prefixView . '.index', $data);
    }

    public function get(Request $request, $id)
    {
        return $this->model->findById($id);
    }

    public function create()
    {
        return view('administrator.' . $this->prefixView . '.add');
    }

    public function store(Request $request)
    {
        $requestParams = $request->all();

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'user_status_id' => 'required',
        ], [
            'user_status_id.required' => 'Please choose a option',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        } else {
            $item = $this->model->storeByQuery($request);

            if (Helper::isErrorAPIAdserver($item)) {
                Session::flash("error", json_encode($item));
                return response()->json([
                    'status' => false,
                    'message' => json_encode($item),
                ], 500);
            }
            // Lưu dữ liệu vào assign user
            if (!empty($requestParams['assign_user']))
            {
                $this->assignUserService->saveAssignUser(AssignUserModel::TYPE['PUBLISHER'], $item->id, [$requestParams['assign_user']]);
            }

            $item['user_id'] = $item->id;
            return response()->json([
                'html' => view('administrator.' . $this->prefixView . '.add_table', compact('item'))->render(),
                'status' => true,
                'message' => 'Add successful',
            ]);
            //return redirect()->route('administrator.users.index');
        }
    }

    public function edit(Request $request)
    {
        $item = $this->model->where('api_publisher_id', $request->id)->first();

        if (empty($item))
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy thông tin user trong database',
            ]);

        $itemAdserver = Helper::callGetHTTP("https://api.adsrv.net/v2/user/" . $item->api_publisher_id);
        if (Helper::isErrorAPIAdserver($itemAdserver))
            return response()->json([
                'status' => false,
                'message' => 'Không tìm thấy thông tin trên hệ thống AdServer',
            ]);

        $data = [
            'item' => $item,
            'itemAdserver' => $itemAdserver,
            'listUserGroupAdmin' => $this->commonService->listUserGroupAdmin()
        ];
        return response()->json([
            'status' => true,
            'html' => view('administrator.' . $this->prefixView . '.edit', $data)->render()
        ]);

        //return view('administrator.' . $this->prefixView . '.edit', compact('item','itemAdserver'));
    }

    public function update(Request $request)
    {
        $requestParams = $request->all();
        $users = $this->model->searchByQuery($request, ['is_admin' => 0]);
        $item = $this->model->updateByQuery($request, $request->id);

        // Lưu dữ liệu vào assign user
        if (!empty($requestParams['assign_user']))
        {
            $this->assignUserService->saveAssignUser(AssignUserModel::TYPE['PUBLISHER'], $item->id, [$requestParams['assign_user']]);
        }

        if (Helper::isErrorAPIAdserver($item)) {
            Session::flash("error", json_encode($item));
            return back();
        }
        return response()->json([
            'html' => view('administrator.' . $this->prefixView . '.add_table', compact('item', 'users'))->render(),
            'status' => true,
            'message' => 'Update successful',
        ]);
        //return redirect()->route('administrator.users.index');
    }

    public function delete(Request $request, $id)
    {
        $item = $this->model->where(['api_publisher_id' => $id])->first();

        $sites = Helper::callGetHTTP('https://api.adsrv.net/v2/site?filter[idpublisher]=' . $id);

        Helper::callDeleteHTTP('https://api.adsrv.net/v2/user/' . $id);
        if (!empty($item)) {
            $item->forceDelete();
        }

        foreach ($sites as $site) {

            $zones = Helper::callGetHTTP('https://api.adsrv.net/v2/zone?idsite=' . $site['id']);

            foreach ($zones as $key => $zone) {
                $items2 = Helper::callGetHTTP('https://api.adsrv.net/v2/campaign/?filter[name]' . $zone['id']);
                foreach ($items2 as $item2) {
//                    Helper::callDeleteHTTP('https://api.adsrv.net/v2/campaign/'.$item2['id']);
                    $result = CampaignAd::where(['campaign_id' => $item2['id']])->first();
                    if (!empty($result)) {
                        $result->forceDelete();
                    }
                }
            }

            Helper::callDeleteHTTP('https://api.adsrv.net/v2/site/' . $site['id']);

            Helper::callDeleteHTTP('https://api.adsrv.net/v2/zone?idsite=' . $site['id']);

        }

        return response()->json([
            'code' => 200,
            'message' => 'success',
        ], 200);

    }

    public function deleteManyByIds(Request $request)
    {
        foreach ($request->ids as $id) {
            $item = $this->model->where(['api_publisher_id' => $id])->first();

            $sites = Helper::callGetHTTP('https://api.adsrv.net/v2/site?filter[idpublisher]=' . $id);

            Helper::callDeleteHTTP('https://api.adsrv.net/v2/user/' . $id);
            if (!empty($item)) {
                $item->forceDelete();
            }

            foreach ($sites as $site) {

                $zones = Helper::callGetHTTP('https://api.adsrv.net/v2/zone?idsite=' . $site['id']);

                foreach ($zones as $key => $zone) {
                    $items2 = Helper::callGetHTTP('https://api.adsrv.net/v2/campaign/?filter[name]' . $zone['id']);
                    foreach ($items2 as $item2) {
//                        Helper::callDeleteHTTP('https://api.adsrv.net/v2/campaign/'.$item2['id']);
                        $result = CampaignAd::where(['campaign_id' => $item2['id']])->first();
                        if (!empty($result)) {
                            $result->forceDelete();
                        }
                    }
                }

                Helper::callDeleteHTTP('https://api.adsrv.net/v2/site/' . $site['id']);

                Helper::callDeleteHTTP('https://api.adsrv.net/v2/zone?idsite=' . $site['id']);

            }
        }

        return response()->json([
            'code' => 200,
            'message' => 'success',
        ], 200);

    }

    public function export(Request $request)
    {
        return Excel::download(new ModelExport($this->model, $request), $this->prefixView . '.xlsx');
    }

    public function updateActive(Request $request)
    {
        $params = [];

        if (isset($request->is_active)) {
            $params['is_active'] = $request->is_active;
        }

        if (isset($request->idstatus)) {
            $params['idstatus'] = $request->idstatus;
        }

        $item = Helper::callPutHTTP("https://api.adsrv.net/v2/user/" . $request->id, $params);

        if ($item['is_active'] == true) {
            $is_active = 'Yes';
        } else {
            $is_active = 'No';
        }

        if (Helper::isErrorAPIAdserver($item)) {
            return response()->json($item, 400);
        }

        optional(User::where('api_publisher_id', $request->id))->update([
            'active' => $item['is_active'] == true ? 1 : 0,
            'user_status_id' => $item['is_active'] == true ? 1 : 2,
        ]);

        return response()->json([
            'item' => $item,
            'status' => true,
            'message' => 'Update successful',
            'is_active' => $is_active,
        ]);
    }

    //access to user account
    public function imperrsonate(Request $request)
    {

        $user_id = $request->user_id;
//        if (session()->get('hasClonedUser') == 1) {
//            auth()->loginUsingId(session()->remove('hasClonedUser'));
//            session()->remove('hasClonedUser');
//            return redirect()->route('administrator.users.index');
//        }

        //only run for developer, clone selected user and create a cloned session
        session()->put('hasClonedUser', auth()->user()->id);
        auth()->loginUsingId($user_id);
        return redirect()->route('user.dashboard.index');
    }

    //Partner
    public function indexPartner(Request $request)
    {

        $title = 'Partners';
        $prefixView = 'partner';

        if (auth()->user()->is_admin != 2) {
            $items = Helper::callGetHTTP("https://api.adsrv.net/v2/user?page=1&per-page=10000&filter[idrole]=3&filter[idmanager]=" . auth()->user()->api_publisher_id) ?? [];
        } else {
            $items = Helper::callGetHTTP("https://api.adsrv.net/v2/user?page=1&per-page=10000&filter[idrole]=3") ?? [];
        }

        $users = $this->model->searchByQuery($request, ['is_admin' => 0]);

        $urls = Helper::callGetHTTP('https://api.adsrv.net/v2/site?per-page=10000000');

        $items = Formatter::paginator($request, $items);

        return view('administrator.partner.index', compact('items', 'urls', 'users', 'title', 'prefixView'));
    }

    public function storePartner(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'url' => 'required|url',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ]);
        } else {
            $item = $this->model->storeByQuery($request);


            if (Helper::isErrorAPIAdserver($item)) {
                Session::flash("error", json_encode($item));
                return back();
            }

            $item['user_id'] = $item->id;

            return response()->json([
                'html' => view('administrator.partner.add_table', compact('item'))->render(),
                'status' => true,
                'message' => 'Add successful',
            ]);
        }
    }

    public function editPartner(Request $request)
    {
        $item = $this->model->where('api_publisher_id', $request->id)->first();

        if (empty($item)) return abort(404);

        return response()->json([
            'html' => view('administrator.partner.edit', compact('item'))->render()
        ]);
    }

    public function updatePartner(Request $request)
    {
        $users = $this->model->searchByQuery($request, ['is_admin' => 0]);

        $item = $this->model->updateByQuery($request, $request->id);
        if (Helper::isErrorAPIAdserver($item)) {
            Session::flash("error", json_encode($item));
            return back();
        }

        return response()->json([
            'html' => view('administrator.partner.add_table', compact('item', 'users'))->render(),
            'status' => true,
            'message' => 'Update successful',
        ]);
    }

}
