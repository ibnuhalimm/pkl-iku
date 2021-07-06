<?php

namespace App\Http\Controllers\Indonesia;

use App\Http\Controllers\Controller;
use App\Http\Requests\Indonesia\Desa\SelectTwoRequest;
use App\Http\Resources\Indonesia\DesaSelectResource;
use App\Models\Village;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    /**
     * Handle select2 ajax
     *
     * @param  \App\Http\Requests\Indonesia\Desa\SelectTwoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function selectTwo(SelectTwoRequest $request)
    {
        $districtId = $request->get('districtId');
        $page = $request->get('page');
        $search = $request->get('search', '');
        $allowAll = boolval($request->get('allowAll', false));

        $limit = 20;
        $offset = ($page - 1) * $limit;

        $villages = Village::selectRaw('id, name')
                        ->filterDistrict($districtId)
                        ->searchSelectTwo($search)
                        ->orderBy('id', 'asc')
                        ->take($limit)
                        ->skip($offset)
                        ->get();

        $villagesCount = Village::filterDistrict($districtId)->searchSelectTwo($search)->count();

        if ($allowAll) {
            $villageAll = new Village();
            $villageAll->id = 0;
            $villageAll->name = '- Semua Desa/Kelurahan -';
            $villages->prepend($villageAll);
        }

        return response()->json([
            'results' => DesaSelectResource::collection($villages),
            'pagination' => [
                'more' => ($page * $limit) < $villagesCount
            ]
        ]);
    }
}
