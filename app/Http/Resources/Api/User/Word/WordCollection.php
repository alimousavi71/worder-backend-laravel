<?php

namespace App\Http\Resources\Api\User\Word;

use Illuminate\Http\Resources\Json\ResourceCollection;

class WordCollection extends ResourceCollection
{
    private array $pagination;

    public static $wrap = 'words';

    public function __construct($resource)
    {
        $this->pagination = [
            'total' => $resource->total(),
            'count' => $resource->count(),
            'per_page' => $resource->perPage(),
            'current_page' => $resource->currentPage(),
            'total_pages' => $resource->lastPage(),
        ];

        $resource = $resource->getCollection();

        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'status' => 200,
            'message' => trans('api.user.word.success'),
            'words' => WordResponse::collection($this->collection),
            'paginate' => $this->pagination,
        ];
    }
}
