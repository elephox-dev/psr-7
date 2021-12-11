<?php
declare(strict_types=1);

namespace Elephox\Psr7;

use Elephox\Http\CustomResponseCode;
use Elephox\Http\Contract\Response as ElephoxResponse;
use Elephox\Http\ResponseCode;
use JetBrains\PhpStorm\Pure;
use Psr\Http\Message\ResponseInterface as Psr7Response;

class Response extends Message implements Psr7Response
{
    #[Pure] public function __construct(
        private ElephoxResponse $response
    ) {
        parent::__construct($response);
    }

    public function getStatusCode()
    {
        $this->response->getResponseCode()->getCode();
    }

    public function withStatus($code, $reasonPhrase = '')
    {
        $responseCode = ResponseCode::tryFrom($code);
        $responseCode ??= new CustomResponseCode($code, $reasonPhrase);

        $this->response->withResponseCode($responseCode);
    }

    public function getReasonPhrase()
    {
        $this->response->getResponseCode()->getMessage();
    }
}
