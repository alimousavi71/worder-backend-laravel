<?php

namespace App\Repositories;

use App\Models\Word;
use Illuminate\Support\Collection;

interface IWordRepo
{
    public function findLearnWords(array $excludeIds, int $limit = 100): Collection;

    public function findById(int $id): ?Word;

    public function findByWord(string $word): ?Word;

    public function createUserWord(string $word, string $translate, int $userId): Word;
}
