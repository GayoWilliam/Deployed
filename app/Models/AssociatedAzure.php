<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociatedAzure extends Model
{
    use HasFactory;

    protected $table = "associated_azure_accounts";

    protected $fillable = ['azure_account', 'password', 'account_type'];

    public function users()
    {
        return $this->hasMany(User::class, 'azure_account_id');
    }
}
