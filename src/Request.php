<?php
declare(strict_types=1);

namespace Elephox\Psr7;

use Elephox\Http\Contract\Request as ElephoxRequest;
use Elephox\Http\CustomRequestMethod;
use Elephox\Http\RequestMethod;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

class Request extends Message implements RequestInterface
{
    public function __construct(
        protected ElephoxRequest $request
    ) {
        parent::__construct($request);
    }

    public function getRequestTarget()
    {
        // TODO: Implement getRequestTarget() method.
    }

    public function withRequestTarget($requestTarget)
    {
        // TODO: Implement withRequestTarget() method.
    }

    public function getMethod()
    {
        return $this->request->getRequestMethod()->getValue();
    }

    public function withMethod($method)
    {
        $requestMethod = RequestMethod::tryFrom($method);
        $requestMethod ??= new CustomRequestMethod($method);

        return $this->request->withRequestMethod($requestMethod);
    }

    public function getUri()
    {
        return $this->request->getUrl();
    }

    public function withUri(UriInterface $uri, $preserveHost = false)
    {
        // TODO: Implement withUri() method.
    }
}
