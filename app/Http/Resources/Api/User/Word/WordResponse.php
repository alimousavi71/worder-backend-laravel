<?php

namespace App\Http\Resources\Api\User\Word;

use App\Models\Word;
use Illuminate\Http\Resources\Json\JsonResource;

class WordResponse extends JsonResource
{
    public function toArray($request)
    {
        /**
         * @var $this Word
         */
        $r['id'] = $this->id;
        $r['word'] = $this->word;
        $r['translate'] = $this->translate ?? '';
        $r['description'] = $this->description ?? '';
        if (! empty($this->pivot)) {
            $r['is_knew'] = (bool) $this->pivot->is_knew;
            $r['correct_answer'] = $this->pivot->correct_answer;
            $r['wrong_answer'] = $this->pivot->wrong_answer;
            $r['repeat'] = $this->pivot->repeat;
        }

        return $r;
    }
}
