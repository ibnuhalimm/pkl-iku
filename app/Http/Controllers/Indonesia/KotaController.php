<?php

namespace App\Http\Controllers\Indonesia;

use App\Http\Controllers\Controller;
use App\Http\Requests\Indonesia\Kota\SelectTwoRequest;
use App\Http\Resources\Indonesia\KotaSelectResource;
use App\Models\City;
use Illuminate\Http\Request;

class KotaController extends Controller
{
    /**
     * Handle select2 ajax
     *
     * @param  \App\Http\Requests\Indonesia\Kota\SelectTwoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function selectTwo(SelectTwoRequest $request)
    {
        $provinceId = $request->get('provinceId');
        $page = $request->get('page');
        $search = $request->get('search', '');
        $allowAll = boolval($request->get('allowAll', false));

        $limit = 20;
        $offset = ($page - 1) * $limit;

        $cities = City::selectRaw('id, name')
                        ->filterProvince($provinceId)
                        ->searchSelectTwo($search)
                        ->orderBy('id', 'asc')
                        ->take($limit)
                        ->skip($offset)
                        ->get();

        $citiesCount = City::filterProvince($provinceId)->searchSelectTwo($search)->count();

        if ($allowAll) {
            $cityAll = new City();
            $cityAll->id = 0;
            $cityAll->name = '- Semua Kabupaten/Kota -';
            $cities->prepend($cityAll);
        }

        return response()->json([
            'results' => KotaSelectResource::collection($cities),
            'pagination' => [
                'more' => ($page * $limit) < $citiesCount
            ]
        ]);
    }
}
