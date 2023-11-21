<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\MailNotiUserNew;
use App\Models\Helper;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Services\Common;
use App\Services\SiteService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Mews\Captcha\Facades\Captcha;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/email/verify';
    private static $api_publisher_id = 0;

    private $request;

    private $siteService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, SiteService $siteService)
    {
        $this->request = $request;
        $this->siteService = $siteService;
        $this->middleware('guest');
    }


    public function showRegistrationForm()
    {
        return view('publisher.pages.sign-up');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $name = explode('@', $data['email'])[0] ?? 'publisher';
        $params = [
            'name' => $name,
            'email' => $data['email'],
            'idrole' => 4,
        ];

        $response = Helper::callPostHTTP("https://api.adsrv.net/v2/user", $params);

        if (empty($response) ||( is_array($response) && isset($response['errors']) )){
            $data['email'] = 'admin';
        }else{

            $user = User::where('email', $data['email'])->first();

            if (empty($user)) {
                $dataCreate = [
                    'name' => $name,
                    'role_id' => '0',
                    'referral_code' => $data['referral_code'] ?? null,
                    'phone' => $data['phone'] ?? null,
                    'api_publisher_id' => $response['id'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'device' => request()->userAgent(),
                    'ip_register' => request()->ip(),
                ];

                // lưu tài khoản mạng xã hội
                switch ($data['style_messenger'] ?? null)
                {
                    case User::SKYPE:
                        $dataCreate['skype'] = $data['nick_messenger'] ?? '';
                        break;
                    case User::TELEGRAM:
                        $dataCreate['telegram'] = $data['nick_messenger'] ?? '';
                        break;
                    case User::WHATSAPP:
                        $dataCreate['whats_app'] = $data['nick_messenger'] ?? '';
                        break;
                    default:
                        break;
                }

                $userInfoNew = User::create($dataCreate);

                $dataCreate['api_publisher_id'] = $userInfoNew->api_publisher_id;
                $dataCreate['userId'] = $userInfoNew->id;

                // Nếu có user điền site thì lưu site
                if (!empty($data['url'])) {

                    if (!preg_match("~^(?:https?://)~i", $data['url'])) {
                        $data['url'] = "https://" . $data['url'];
                    } elseif (strpos($data['url'], "http://") === 0) {
                        $data['url'] = str_replace("http://", "https://", $data['url']);
                    }

                    $dataCreate['url'] = $data['url'];
                    $dataCreate['impression'] = $data['impression'] ?? null;
                    $dataCreate['geo'] = $data['geo'] ?? null;
                    $dataCreate['file_report'] = null;

                    // Save file reports
                    if(request()->hasFile('file_report')){
                        $dataCreate['file_report'] = Storage::putFile('files', request()->file('file_report'));
                    }
                    $resultSite = $this->siteService->storeSite($dataCreate);
                    if (!$resultSite['status'])
                    {
                        Log::error('site register error'. $resultSite['message'] ?? '');
                    }
                }

                // Sau khi user đăng ký thành công thì bắn mail về cho sale director và Admin
                $userAdminAndSale = User::where('role_id', [1, 4])->where('active', Common::ACTIVE)->orWhere('email', 'rachel@maxvalue.media')->get();
                foreach ($userAdminAndSale as $adminSale)
                {
                    if (!filter_var($adminSale->email, FILTER_VALIDATE_EMAIL)) {
                        continue;
                    }

                    $formEmail = [
                      'userAdmin' => $adminSale->name,
                      'nameUser' => $userInfoNew->name,
                      'emailUser' => $userInfoNew->email,
                      'dateUser' => $userInfoNew->created_at,
                    ];

                    try {
                        Mail::to($adminSale->email)->send(new MailNotiUserNew($formEmail));
                    } catch (\Exception $e) {
                        Log::error('mail error' . $e->getMessage());
                    }
                }

                $data['email'] = Helper::randomString();
            }
        }


        return Validator::make($data, [
            'email' => ['required', 'string', 'max:255','unique:users,email'],
            'password' => ['required']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
//        $dataCreate = [
//            'name' => 'Publisher',
//            'role_id' => '0',
//            'api_publisher_id' => $data['api_publisher_id'],
//            'email' => $data['email'],
//            'password' => Hash::make($data['password']),
//            'ip_register' => request()->ip(),
//        ];
//
//        return User::create($dataCreate);
        return User::where('email', $data['email'])->first();
    }

    public function refreshCaptcha()
    {
        return response()->json([
            'captcha' => Captcha::img()
        ]);
    }
}
