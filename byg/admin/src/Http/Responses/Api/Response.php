<?php
namespace Byg\Admin\Http\Responses\Api;

use Illuminate\Http\JsonResponse;

class Response extends JsonResponse
{
    /** @var array */
    private $responseData = [
        'message'   => 'success',
        'status'    => true,
        'data'      => []
    ];

    /**
     * Response constructor.
     *
     * @param array $responseData
     * @param integer $status
     * @param array $headers
     * @param integer $options
     *
     */
    public function __construct(array $responseData = [], int $statusCode = 200, array $headers = [], int $options = 0)
    {
        $this->encodingOptions = $options;

        /* http code >= 300，data 需符合格式 */
        if ($statusCode >= 300) {
            $responseData += [
                'status' => false
            ];
        }

        parent::__construct(array_replace_recursive($this->responseData, $responseData), $statusCode, $headers);
    }

    /**
     * @param array $responseData
     * @param integer $statusCode
     * @param array $headers
     * @param integer options
     * 
     * @return static
     */
    public static function json()
    {
        return new static(...func_get_args());
    }
}