<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use Spatie\Permission\Models\Role as BaseRole;

class Role extends BaseRole
{
    use HasFactory,UsesTenantConnection;
}
