<?php

namespace App\Services;

use App\Http\Requests\FileRequest;
use App\Models\Group;

class GroupsSynchronizer
{
    public function getName(FileRequest $fileRequest)
    {
        $groupName = $fileRequest->groups_text ?: $fileRequest->groups;

        return $groupName;
    }

    public function getId($groupName)
    {
        $group = Group::firstOrcreate(['name' => $groupName]);
        return $group->id;
    }
}
