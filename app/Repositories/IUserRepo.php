<?php

namespace App\Repositories;

use App\Models\Login;
use App\Models\OtpCode;
use App\Models\User;
use App\Models\UserWord;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface IUserRepo
{
    /* Auth Login */
    public function find($id): User;

    public function login(string $email): User;

    public function exist(string $email): ?User;

    public function registerSocial($email, $firstName, $lastName): User;

    public function creatOtpCode(string $email): OtpCode;

    public function checkOtpExist(string $email): ?OtpCode;

    public function checkOtpVerify(string $email, string $code): ?OtpCode;

    public function checkOtpRemove(string $email);

    /* Profile */
    public function updateProfile(int $userId, string $firstName, string $lastName);

    public function updatePassword(int $userId, string $password);

    /* Regular */
    public function logLogin(User $user): Login;

    /* Avatar */
    public function updateAvatar(User $user, string $avatar);

    /* My words */
    public function wordsById(int $userId): Collection;

    public function learnWordById(int $userId): Collection;

    public function pendingWordById(int $userId): Collection;

    public function words(User $user): LengthAwarePaginator;

    public function pickedWord(int $userId, int $wordId): bool;

    public function pickWord(int $userId, int $wordId): UserWord;
}
