<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRole\DatatableRequest;
use App\Http\Requests\UserRole\DeleteRequest;
use App\Http\Requests\UserRole\StoreRequest;
use App\Http\Requests\UserRole\UpdateRequest;
use App\Models\User;
use App\Notifications\NewAdminNotification;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.user-role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserRole\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $plainPassword = Str::random(5);

            $user = new User();
            $user->name = trim($request->name);
            $user->email = trim($request->email);
            $user->username = trim($request->username);
            $user->password = bcrypt($plainPassword);
            $user->role_id = User::ROLE_ADMIN;
            $user->save();

            $user->notify(new NewAdminNotification($user, $plainPassword));

            return $this->apiResponse(Response::HTTP_OK, 'User berhasil ditambahkan.');

        } catch (\Throwable $th) {
            report($th);

            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'Terjadi kesalahan. ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRole\UpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        try {
            $userId = $request->id;

            $user = User::admin()->where('id', $userId)->first();
            $user->name = trim($request->name);
            $user->email = trim($request->email);
            $user->save();

            return $this->apiResponse(Response::HTTP_OK, 'Data User berhasil disimpan.');

        } catch (\Throwable $th) {
            report($th);

            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'Terjadi kesalahan. ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\UserRole\DeleteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteRequest $request)
    {
        try {
            $userId = $request->id;

            User::admin()->where('id', $userId)->delete();

            return $this->apiResponse(Response::HTTP_OK, 'User berhasil dihapus.');

        } catch (\Throwable $th) {
            report($th);

            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'Terjadi kesalahan. ' . $th->getMessage());
        }
    }

    /**
     * Handle server-side datatable
     *
     * @param  \App\Http\Requests\UserRole\DatatableRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function dataTable(DatatableRequest $request)
    {
        $start = $request->get('start', 0);
        $limit = $request->get('length', 10);
        $search = $request->get('search')['value'] ?? '';

        $orderColumn = $request->get('order')[0]['column'] ?? 0;
        $orderDir = $request->get('order')[0]['dir'] ?? 0;

        $availableColumn = [
            'id', 'name', 'username', 'email'
        ];

        $columnName = $availableColumn[$orderColumn] ?? $availableColumn[0];

        $adminUsers = User::admin()
                        ->selectRaw('id, name, username, email')
                        ->searchDatatable($search)
                        ->orderBy($columnName, $orderDir)
                        ->take($limit)
                        ->skip($start)
                        ->get();

        $adminUsersCount = User::admin()->searchDatatable($search)->count();

        return DataTables::of($adminUsers)
                ->addColumn('action', function($user) {
                    return '
                        <button type="button" class="btn-action--yellow" title="Reset Password"
                            data-id="'. $user->id .'"
                            onClick="resetPasswordUser(this)">
                            <i class="fas fa-key"></i>
                        </button>
                        <button type="button" class="btn-action--green" title="Edit"
                            data-id="'. $user->id .'"
                            data-name="'. $user->name .'"
                            data-username="'. $user->username .'"
                            data-email="'. $user->email .'"
                            onClick="editUserRole(this)">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button type="button" class="btn-action--red" title="Hapus"
                            data-id="'. $user->id .'"
                            onClick="deleteUserRole(this)">
                            <i class="fas fa-trash"></i>
                        </button>
                    ';
                })
                ->skipPaging(true)
                ->setTotalRecords($adminUsersCount)
                ->addIndexColumn()
                ->make(true);
    }
}
