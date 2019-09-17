<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    public function getAssetAspectIdAttribute($value){
        return AssetAspect::where('id', $value)->first();
    }

    public function getAssetTypeIdAttribute($value){
        return AssetType::where('id', $value)->first();
    }

    public function getAssetsByTypeName($assetTypeName){
        return $this->where('asset_type_id', AssetType::where('name', $assetTypeName)->first()->id)->get();
    }

    public function getAssetsByTypeId($assetTypeId){
        return $this->where('asset_type_id', $assetTypeId)->get();
    }
}
