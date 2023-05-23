<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyModel extends Model
{
    use SoftDeletes;
    protected $table = 'company';
    protected $primaryKey = 'id';
    protected $fillable = ["sector_id","logo","name","owner_name"];
    public $timestamps = true;

    function getSector(): HasOne
    {
        return $this->hasOne(SectorModel::class, "id", "sector_id");
    }
}