<?php

namespace App\Services;

use App\Mail\MailAssignNotify;
use App\Mail\MailNotiUserNew;
use App\Models\AssignUserModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AssignUserService
{

    public function __construct()
    {

    }

    public function saveAssignUser($type, $serviceId, $listUserId)
    {
        // Kiểm tra xem assign có bị thay đổi hay không
        $userAssigned = $this->getInfoAssign($type, $serviceId);

        $listUserId = array_map('strval', $listUserId);
        $userAssigned = array_map('strval', $userAssigned);
        $checkDuplicate = array_diff($listUserId, $userAssigned);

        if (empty($checkDuplicate))
        {
            return true;
        }

        $this->removeAssign($type, $serviceId);
        $data = [];
        foreach ($listUserId as $userId)
        {
            $data[] = [
                'type' => $type,
                'service_id' => $serviceId,
                'user_id' => $userId,
                'created_at' => Carbon::now()
            ];

            try {
                $userInfo = User::find($userId);
                $publisherInfo = User::find($serviceId);
                $formEmail = [
                    'username' => $userInfo->name,
                    'admin' => auth()->user()->name,
                    'publisherInfo' => $publisherInfo,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ];

                // bắn mail thông báo
                Mail::to($userInfo->email)->send(new MailAssignNotify($formEmail));
            }catch (\Exception $e)
            {
                Log::debug($e->getMessage());
            }
        }

        return AssignUserModel::insert($data);
    }

    public function removeAssign($type, $serviceId)
    {
        return AssignUserModel::where('type', $type)->where('service_id', $serviceId)->update([
            'is_delete' => Common::IS_DELETE,
            'updated_at' => Carbon::now()
        ]);
    }

    public function getInfoAssign($type, $serviceId)
    {
        return AssignUserModel::where('type', $type)
            ->where('service_id', $serviceId)
            ->where('is_delete', '<>',Common::IS_DELETE)
            ->pluck('user_id')->toArray();
    }
}
