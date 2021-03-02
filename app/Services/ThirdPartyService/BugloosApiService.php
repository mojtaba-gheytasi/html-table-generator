<?php

namespace App\Services\ThirdPartyService;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class BugloosApiService
{
    private const PATH_MAPPER = [
        'companies' => 'api.bugloos.com/companies',
    ];

    private function request(string $path, array $params) : array
    {
        return [];
    }

    public function getTasks($listName, $params) : array
    {
        $path = self::PATH_MAPPER[$listName];

        $result = $this->request($path, [
            'per_page' => $params['rowPerPage'],
            'sort_by' => $params['sortBy'] ?? '',
            'sort_direction' => $params['sortDirection'] ?? '',
            'page_number' => $params['page'] ?? 1,
            'search' => $params['searchTerm'] ?? '',
            'searchable_column' => $params['searchableColumn'] ?? [],
        ]);

        $count = $this->getCount($result);
        $collection = $this->getCollection($result);

        return [
            $count,
            $collection,
        ];
    }

    private function getCount(array $result) : int
    {
        return 60;
    }

    private function getCollection(array $result) : Collection
    {
        $collection = collect(json_decode(Storage::get('json-data/companies.json')));

        return $collection->take(10);
    }
}
