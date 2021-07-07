<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ResetPasswordRequest;
use App\Models\User;
use App\Notifications\ResetPasswordAdminNotif;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ResetPasswordAdminController extends Controller
{
    /**
     * Reset admin password
     *
     * @param  \App\Http\Requests\Admin\ResetPasswordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResetPasswordRequest $request)
    {
        try {
            $user = User::admin()->where('id', $request->id)->first();

            if ($user) {
                $plainPassword = Str::random(5);

                $user->password = bcrypt($plainPassword);
                $user->save();

                $user->notify(new ResetPasswordAdminNotif($user, $plainPassword));
            }

            return $this->apiResponse(Response::HTTP_OK, 'Email reset password berhasil dikirim.');

        } catch (\Throwable $th) {
            report($th);

            return $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR, 'Terjadi kesalahan. ' . $th->getMessage());
        }
    }
}
