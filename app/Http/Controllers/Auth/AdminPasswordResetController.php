<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Notifications\AdminResetPasswordNotification;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AdminPasswordResetController extends Controller
{
    use ApiResponse;

    public function sendResetLinkEmail(Request $request): JsonResponse
    {
        $request->validate(['email' => 'required|email']);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            throw ValidationException::withMessages([
                'email' => ['We can\'t find an admin with that email address.'],
            ]);
        }

        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $admin->email],
            [
                'token' => Hash::make($token),
                'created_at' => now()
            ]
        );

        $admin->notify(new AdminResetPasswordNotification($token, $admin->email));

        return $this->successResponse(
            null,
            'Password reset link sent to your email'
        );
    }

    public function reset(Request $request): JsonResponse
    {
        $request->validate([
            'token' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $resetRecord = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$resetRecord || !Hash::check($request->token, $resetRecord->token)) {
            throw ValidationException::withMessages([
                'email' => ['This password reset token is invalid.'],
            ]);
        }

        if (now()->subHours(1)->gt($resetRecord->created_at)) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            throw ValidationException::withMessages([
                'email' => ['This password reset token has expired.'],
            ]);
        }

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            throw ValidationException::withMessages([
                'email' => ['We can\'t find an admin with that email address.'],
            ]);
        }

        $admin->password = Hash::make($request->password);
        $admin->save();

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return $this->successResponse(
            null,
            'Password has been reset successfully'
        );
    }
}