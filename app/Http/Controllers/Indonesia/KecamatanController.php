<?php

namespace App\Http\Controllers\Indonesia;

use App\Http\Controllers\Controller;
use App\Http\Requests\Indonesia\Kecamatan\SelectTwoRequest;
use App\Http\Resources\Indonesia\KecamatanSelectResource;
use App\Models\District;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    /**
     * Handle select2 ajax
     *
     * @param  \App\Http\Requests\Indonesia\Kecamatan\SelectTwoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function selectTwo(SelectTwoRequest $request)
    {
        $cityId = $request->get('cityId');
        $page = $request->get('page');
        $search = $request->get('search', '');
        $allowAll = boolval($request->get('allowAll', false));

        $limit = 20;
        $offset = ($page - 1) * $limit;

        $districts = District::selectRaw('id, name')
                        ->filterCity($cityId)
                        ->searchSelectTwo($search)
                        ->orderBy('id', 'asc')
                        ->take($limit)
                        ->skip($offset)
                        ->get();

        $districtsCount = District::filterCity($cityId)->searchSelectTwo($search)->count();

        if ($allowAll) {
            $districtAll = new District();
            $districtAll->id = 0;
            $districtAll->name = '- Semua Kecamatan -';
            $districts->prepend($districtAll);
        }

        return response()->json([
            'results' => KecamatanSelectResource::collection($districts),
            'pagination' => [
                'more' => ($page * $limit) < $districtsCount
            ]
        ]);
    }
}
