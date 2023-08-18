<?php

namespace App\Repositories;

use App\Enums\Database\Word\WordStatus;
use App\Models\Word;
use App\Models\WordReport;
use Crypt;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class WordRepo implements IWordRepo
{
    public function findLearnWords(array $excludeIds, int $limit = 100): Collection
    {
        return Word::query()
            ->whereNotIn('id', $excludeIds)
            ->where('status', WordStatus::Publish)
            ->inRandomOrder()
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

    /**
     * @throws Exception
     */
    public function makeOptions(array $inIds = [], array $excludeIds = [], int $limit = 20, bool $isRand = false, bool $fieldOrder = false): Collection
    {
        if ($limit < 3) {
            throw new Exception('minimum limit is 3');
        }
        $words = Word::query()
            ->select(['id', 'word', 'translate'])
            ->whereNotNull('translate')
            ->where('status', WordStatus::Publish)
            ->when(! empty($excludeIds), function ($q) use ($excludeIds) {
                $q->whereNotIn('id', $excludeIds);
            })
            ->when(! empty($inIds), function ($q) use ($inIds) {
                $q->whereIn('id', $inIds);
            })
            ->when($isRand, function ($q) {
                $q->inRandomOrder();
            })
            ->when($fieldOrder, function ($q) use ($inIds) {
                $q->orderBy(DB::raw('FIELD(id, '.implode(',', $inIds).')'));
            })
            ->limit($limit)
            ->get();

        return $words->map(function (Word $item) use ($words) {
            $data['id'] = $item->id;
            $data['word'] = $item->word;

            $rawOptions = $words->where('id', '!=', $item->id)->random()->take(3)->pluck('translate')->toArray();
            $options[] = $item->translate;
            $options[] = $rawOptions[0];
            $options[] = $rawOptions[1];
            $options[] = $rawOptions[2];

            shuffle($options);

            $index = collect($options)->search(function ($i) use ($item) {
                return $i === $item->translate;
            });

            $data['option_1'] = $options[0];
            $data['option_2'] = $options[1];
            $data['option_3'] = $options[2];
            $data['option_4'] = $options[3];
            $data['answer'] = Crypt::encrypt($index);

            return $data;
        });
    }

    public function report(int $wordId, int $reasonId, int $userId): WordReport
    {
        return WordReport::query()->create([
            'word_id' => $wordId,
            'reason' => $reasonId,
            'is_seen' => false,
            'user_id' => $userId,
        ]);
    }
}
