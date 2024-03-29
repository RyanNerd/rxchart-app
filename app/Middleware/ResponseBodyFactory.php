<?php
declare(strict_types=1);

namespace Willow\Middleware;

use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Routing\RouteContext;

class ResponseBodyFactory
{
    /**
     * Inject a new ResponseBody object into the middleware setting the deserialized request array.
     * @param Request $request
     * @param RequestHandler $handler
     * @return ResponseInterface
     */
    public function __invoke(Request $request, RequestHandler $handler): ResponseInterface {
        /** @noinspection NullPointerExceptionInspection */
        $arguments = RouteContext::fromRequest($request)->getRoute()->getArguments();
        return $handler
            ->handle(
                $request
                    ->withAttribute(
                        'response_body',
                        self::create(
                            array_merge(
                                $arguments,
                                $request->getQueryParams(),
                                $request->getParsedBody() ?? [],
                                ['uploaded_files' => $request->getUploadedFiles()]
                            )
                        )
                    )
            );
    }

    /**
     * @param array $parsedRequest
     * @return ResponseBody
     */
    public static function create(array $parsedRequest): ResponseBody {
        return new ResponseBody($parsedRequest);
    }
}
