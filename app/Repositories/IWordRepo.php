<?php

namespace App\Repositories;

use App\Models\Word;
use App\Models\WordReport;
use Illuminate\Support\Collection;

interface IWordRepo
{
    public function findLearnWords(array $excludeIds, int $limit = 100): Collection;

    public function findById(int $id): ?Word;

    public function findByWord(string $word): ?Word;

    public function report(int $wordId, int $reasonId, int $userId): WordReport;

    public function createUserWord(string $word, string $translate, int $userId): Word;

    public function makeOptions(array $inIds = [], array $excludeIds = [], int $limit = 20, bool $isRand = false, bool $fieldOrder = false): Collection;
}
