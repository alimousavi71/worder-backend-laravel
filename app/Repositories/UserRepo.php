<?php

namespace App\Repositories;

use App\Enums\Database\Word\WordStatus;
use App\Helper\Helper;
use App\Models\Login;
use App\Models\OtpCode;
use App\Models\User;
use App\Models\UserWord;
use App\Models\Word;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserRepo implements IUserRepo
{
    public function find($id): User
    {
        return User::query()->find($id);
    }

    public function login(string $email): User
    {
        return User::query()
            ->where('email', $email)
            //->where('is_block', false)
            ->whereNotNull('verify_at')
            ->first();
    }

    public function exist($email): ?User
    {
        return User::query()
            ->where('email', $email)
            ->first();
    }

    public function registerSocial($email, $firstName, $lastName): User
    {
        return User::create([
            'email' => $email,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'verify_at' => now(),
        ])->fresh();
    }

    public function logLogin(User $user): Login
    {
        return $user->logins()->create([
            'login_at' => now(),
            'agent' => request()->userAgent(),
            'ip' => request()->ip(),
        ])->fresh();
    }

    public function creatOtpCode(string $email): OtpCode
    {
        return OtpCode::query()
            ->create([
                'email' => $email,
                'code' => Helper::randNumeric(4),
                'expired_at' => now()->addSeconds(60),
            ]);
    }

    public function checkOtpExist(string $email): ?OtpCode
    {
        return OtpCode::query()
            ->where('email', $email)
            ->where('expired_at', '>', now()->format('Y-m-d H:i:s'))
            ->first();
    }

    public function checkOtpVerify(string $email, string $code): ?OtpCode
    {
        return OtpCode::query()
            ->where('email', $email)
            ->where('code', $code)
            ->where('expired_at', '>', now()->format('Y-m-d H:i:s'))
            ->first();
    }

    public function checkOtpRemove(string $email)
    {
        return OtpCode::query()
            ->where('email', $email)
            ->delete();
    }

    public function updateAvatar(User $user, string $avatar)
    {
        return $user->update([
            'avatar' => $avatar,
        ]);
    }

    public function wordsById(int $userId): Collection
    {
        return UserWord::query()
            ->where('user_id', $userId)
            ->get();
    }

    public function pickedWord(int $userId, int $wordId): bool
    {
        return UserWord::query()
            ->where('user_id', $userId)
            ->where('word_id', $wordId)
            ->exists();
    }

    public function pickWord(int $userId, int $wordId): UserWord
    {
        return UserWord::query()
            ->create([
                'user_id' => $userId,
                'word_id' => $wordId,
            ]);
    }

    public function words(User $user): LengthAwarePaginator
    {
        return $user->words()->latest()->paginate(10);

    }

    public function learnWordById(int $userId): Collection
    {
        return UserWord::query()
            ->where('user_id', $userId)
            ->where('is_knew', true)
            ->get();
    }

    public function pendingWordById(int $userId): Collection
    {
        return Word::query()
            ->where('user_id', $userId)
            ->where('status', WordStatus::Pending)
            ->get();
    }

    public function updateProfile(int $userId, string $firstName, string $lastName)
    {
        return User::query()
            ->where('id', $userId)
            ->update([
                'firstname' => $firstName,
                'lastname' => $lastName,
            ]);
    }

    public function updatePassword(int $userId, string $password)
    {
        return User::query()
            ->where('id', $userId)
            ->update([
                'password' => bcrypt($password),
            ]);
    }
}
