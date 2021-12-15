<?php
declare(strict_types=1);

namespace Elephox\Psr7;

use Elephox\Http\Contract\Request as ElephoxRequest;
use Elephox\Http\CustomRequestMethod;
use Elephox\Http\RequestMethod;
use Elephox\Http\Url;
use InvalidArgumentException;
use JetBrains\PhpStorm\Pure;
use Psr\Http\Message\RequestInterface as Psr7Request;
use Psr\Http\Message\UriInterface;

class Request extends Message implements Psr7Request
{
    #[Pure] public function __construct(
        protected ElephoxRequest $request
    ) {
        parent::__construct($request);
    }

    #[Pure] public function getRequestTarget()
    {
        $path = $this->request->getUrl()->getPath();
        $query = $this->request->getUrl()->getQuery();
        $fragment = $this->request->getUrl()->getFragment();

        if (empty($path)) {
            $path = "/";
        }

        if ($query !== '') {
            $path .= "?" . $query;
        }

        if ($fragment !== '') {
            $path .= "#" . $fragment;
        }

        return $path;
    }

    public function withRequestTarget($requestTarget)
    {
        if (!is_string($requestTarget)) {
            throw new InvalidArgumentException("Request target must be a string.");
        }

        if (str_contains($requestTarget, ' ')) {
            throw new InvalidArgumentException("Request target cannot contain spaces.");
        }

        $url = Url::fromString($requestTarget);

        return $this->request->withUrl($url);
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

    #[Pure] public function getUri()
    {
        return new Uri($this->request->getUrl());
    }

    public function withUri(UriInterface $uri, $preserveHost = false)
    {
        return $this->request->withUrl(Uri::toElephox($uri), $preserveHost);
    }
}
