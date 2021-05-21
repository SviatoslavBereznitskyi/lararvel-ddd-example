<?php

namespace App\Http\Api\v1;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ApiResponse
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class ApiResponse extends JsonResponse
{

    /**
     * ApiResponse constructor.
     *
     * @param string $message
     * @param mixed $data
     * @param array $errors
     * @param int $status
     * @param array $meta
     * @param array $headers
     * @param bool $json
     */
    public function __construct(
        string $message,
        $data = null,
        array $errors = [],
        int $status = 200,
        array $meta = [],
        array $headers = [],
        bool $json = false
    ) {
        parent::__construct($this->format($message, $data, $errors, $status, $meta), $status, $headers, $json);
    }

    /**
     * Format the API response.
     *
     * @param string $message
     * @param mixed|null $data
     * @param array $errors
     * @param int $status
     * @param array $meta
     *
     * @return array
     *
     * @psalm-suppress MissingParamType
     * @codingStandardsIgnoreStart
     */
    private function format(string $message, $data = null, array $errors = [], int $status, array $meta = []): array
    {
        // @codingStandardsIgnoreEnd
        if ($data === null) {
            $data = [];
        }

        $response = [
            'status_code' => $status,
            'message' => $message,
            'data' => $data,
            'meta' => [],
            'errors' => [],
        ];

        if ($errors) {
            $response['errors'] = $errors;
        }

        if ($meta) {
            $response['meta'] = $meta;
        }

        return $response;
    }
}
