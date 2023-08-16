<?php

namespace App\Services;

use App\Models\AssignUserModel;
use Carbon\Carbon;

class AssignUserService
{

    public function __construct()
    {

    }

    public function saveAssignUser($type, $serviceId, $listUserId)
    {
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
}
