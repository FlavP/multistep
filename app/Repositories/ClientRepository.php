<?php


namespace App\Repositories;


use App\Models\Client;

class ClientRepository
{
    /**
     * @param $aData
     * @return mixed
     */
    public function getClients($aData) {
        $query = Client::where(function ($q) use ($aData){
            if (isset($aData['match']) && isset($aData['search_column']))
                $q->where($aData['search_column'], 'like', '%' . $aData['match'] . '%');
        });
        if (isset($aData['order']) && isset($aData['filter_column'])){
            $query->orderBy($aData['filter_column'], $aData['order']);
        }
        else
            $query->orderBy('id', 'asc');
        return $query;
    }
}
