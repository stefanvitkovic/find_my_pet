<?php

namespace App\Http\Responses;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class JsonResponse
{
    /**
     * @var bool $success
     */
    public bool $success = true;

    /**
     * @var mixed $data
     */
    public $data = null;

    /**
     * @var array|null
     */
    public ?array $links = null;

    /**
     * @var array $messages
     */
    public ?array $messages = null;

    /**
     * @var int|null $errorCode
     */
    public ?int $errorCode = 0;

    /**
     * @var string|null $errorMessage
     */
    public ?string $errorMessage = null;

    /**
     * JsonResponse constructor.
     *
     * @param $data
     * @param bool $success
     * @param int|null $errorCode
     * @param string|null $errorMessage
     * @param array|null $messages
     */
    public function __construct($data, bool $success = true, ?int $errorCode = null, ?string $errorMessage = null, ?array $messages = null)
    {
        $this->success = $success;

        $this->data = $data;
        // ASKED BY MILOS xD
        $this->messages = $messages === null && $errorMessage !== null
            ? ['message' => $errorMessage]
            : $messages;

        $this->errorCode = $errorCode;
        $this->errorMessage = $errorMessage;

        if($data instanceof ResourceCollection && $data->resource instanceof LengthAwarePaginator) {
            $this->links = [
                'current_page' => $data->currentPage(),
                'first_page_url' => $data->url(1),
                'from' => $data->firstItem(),
                'last_page' => $data->lastPage(),
                'last_page_url' => $data->url($data->lastPage()),
                'next_page_url' => $data->nextPageUrl(),
                'path' => $data->path(),
                'per_page' => $data->perPage(),
                'prev_page_url' => $data->previousPageUrl(),
                'total' => $data->total(),
            ];
        }
    }

}
