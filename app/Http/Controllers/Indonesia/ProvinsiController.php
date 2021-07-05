<?php

namespace App\Http\Controllers\Indonesia;

use App\Http\Controllers\Controller;
use App\Http\Requests\Indonesia\Provinsi\SelectTwoRequest;
use App\Http\Resources\Indonesia\ProvinsiSelectResource;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    /**
     * Handle select2 ajax
     *
     * @param  \App\Http\Requests\Indonesia\Provinsi\SelectTwoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function selectTwo(SelectTwoRequest $request)
    {
        $page = $request->get('page');
        $search = $request->get('search', '');
        $allowAll = boolval($request->get('allowAll', false));

        $limit = 20;
        $offset = ($page - 1) * $limit;

        $provinces = Province::selectRaw('id, name')
                        ->searchSelectTwo($search)
                        ->orderBy('id', 'asc')
                        ->take($limit)
                        ->skip($offset)
                        ->get();

        $provincesCount = Province::searchSelectTwo($search)->count();

        if ($allowAll) {
            $provinceAll = new Province();
            $provinceAll->id = 0;
            $provinceAll->name = '- Semua Provinsi -';
            $provinces->prepend($provinceAll);
        }

        return response()->json([
            'results' => ProvinsiSelectResource::collection($provinces),
            'pagination' => [
                'more' => ($page * $limit) < $provincesCount
            ]
        ]);
    }
}
