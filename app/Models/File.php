<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Scopes\CountryScope;

class File extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];
    protected $visible = ['id', 'name', 'path', 'file_type_id'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new CountryScope);
    }

    public function getPathAttribute($value)
    {
        return $this->getFilePath($value);
    }

    public function getFilePath($value)
    {
        $path = ($this->s3_upload)? env('AWS_URL').$value : url($value);

        if ($this->checkfileType($path)) {
            return "http://view.officeapps.live.com/op/view.aspx?src=".$path;
        }

        return $path;
    }

    public function checkfileType($fileName)
    {
        $temp = explode(".", $fileName);
        $allowedExts = ["doc","docx","docm","xlsx","pptx","xls","ppt"];
        $extension = end($temp);

        return in_array($extension, $allowedExts) ? true : false;
    }

    public function scopefileCheck($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }
}
