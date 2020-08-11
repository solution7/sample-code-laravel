<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgreementType extends Model
{
    const DRAFT_STATUS = 1;
    const SENT_STATUS = 2;
    const PERSONAL_CONTRACT_STATUS = 3;

    protected $guarded = [];
    protected $hidden = ['content_key', 'created_at', 'updated_at'];
}
