<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use Spatie\Permission\Models\Permission as BasePermission;

class Permission extends BasePermission
{
    use HasFactory,UsesTenantConnection;
}
