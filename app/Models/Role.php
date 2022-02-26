<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }

    public function users(){
        return $this->belongsToMany(User::class,'users_roles');
    }

    public function hasAccess(array $permissions){
           foreach($permissions as $permission){
               if($this->hasPermission($permission)){
                   return true;
               }
           }
           return false;
    }

    public function hasPermission(string $permission){
        $permissions=json_decode($this->permissions,true);
        foreach($permissions as $val){
            if($val['slug'] == $permission){
               return true;
            }
        }
        return false;
    }
}