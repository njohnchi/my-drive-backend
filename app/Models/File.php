<?php

namespace App\Models;

use App\Traits\HasModifier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class File extends Model
{
    use HasModifier, NodeTrait, SoftDeletes;

    public function isOwner(int $user_id): bool
    {
        return $this->created_by === $user_id;
    }
}
