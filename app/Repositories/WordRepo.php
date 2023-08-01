<?php

namespace App\Repositories;

use App\Enums\Database\Word\WordStatus;
use App\Models\Word;
use Illuminate\Support\Collection;

class WordRepo implements IWordRepo
{
    public function findLearnWords(array $excludeIds, int $limit = 100): Collection
    {
        return Word::query()
            ->whereNotIn('id', $excludeIds)
            ->where('status', WordStatus::Publish)
            ->limit($limit)
            ->get();
    }

    public function findById(int $id): ?Word
    {
        return Word::query()
            ->where('id', $id)
            ->first();
    }

    public function findByWord(string $word): ?Word
    {
        return Word::query()
            ->where('word', $word)
            ->first();
    }

    public function createUserWord(string $word, string $translate, int $userId): Word
    {
        return Word::query()
            ->create([
                'word' => $word,
                'translate' => $translate,
                'status' => WordStatus::Pending,
                'user_id' => $userId,
            ])->fresh();
    }
}
