<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\CompanyModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CompanyService extends Controller
{
    private $companyModel;
    public function __construct()
    {
        $this->companyModel = new CompanyModel();
    }
    private function search(Request $request,Builder $data): Builder
    {
        if($name = $request->name)
            $data = $data->where('name','like',$name);
        if($ownerName = $request->owner_name)
            $data = $data->where('owner_name','like',$ownerName);
        if($sectorName = $request->sector_name)
            $data = $data->whereHas('getSector',function($q) use ($sectorName){
                $q->where("name",$sectorName);
            });
        return $data;
    }
    public function list(Request $request): array
    {
        $data = $this->companyModel->with("getSector");
        $data = $data->orderBy($request->order_field??"id", $request->order??"desc");
        $data = $this->search($request, $data);
        if($limit = $request->limit)
            $data = $data->limit($limit);
        return $data->get()->toArray() ?? [];
    }
    public function pagination(Request $request): LengthAwarePaginator | array
    {
        $data = $this->companyModel->with("getSector");
        $data = $data->orderBy($request->order_field??"id", $request->order??"desc");
        $data = $this->search($request, $data);
        if(!$data->first())
            return [];
        return $data->paginate($request->page??10);
    }
}
