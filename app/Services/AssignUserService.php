<?php

namespace App\Services;

use App\Models\AssignUserModel;

class AssignUserService
{

    public function __construct()
    {

    }

    public function saveAssignUser($type, $serviceId, $listUserId, $created_at)
    {
        $this->removeAssign($type, $serviceId, $created_at);
        $data = [];
        foreach ($listUserId as $userId)
        {
            $data[] = [
                'type' => $type,
                'service_id' => $serviceId,
                'user_id' => $userId,
                'created_at' => $created_at
            ];
        }

        return AssignUserModel::insert($data);
    }

    public function removeAssign($type, $serviceId, $created_at)
    {
        return AssignUserModel::where('type', $type)->where('service_id', $serviceId)->update([
            'is_delete' => Common::IS_DELETE,
            'updated_at' => $created_at
        ]);
    }
}
