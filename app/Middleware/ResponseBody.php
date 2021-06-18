<?php
declare(strict_types=1);

namespace Willow\Middleware;

use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Headers;
use Slim\Psr7\Response;

class ResponseBody extends ResponseCodes
{
    protected ?array $parsedRequest = null;
    protected bool $isAuthenticated = false;
    protected bool $isAdmin = false;

    /**
     * The response data
     *
     * @var array | null
     */
    protected ?array $data = null;

    /**
     * HTTP status code
     *
     * @var int
     */
    protected int $status = 200;

    /**
     * Response informational string
     *
     * @var string
     */
    protected string $message = '';

    /**
     * Missing parameters
     */
    protected array $missing = [];

    /**
     * Messages from registerParam()
     */
    protected array $messages = [];

    protected ?int $userId = null;

    protected ?StreamFactory $streamFactory;

    /**
     * ResponseBody constructor.
     * @param StreamFactory $streamFactory
     */
    public function __construct(StreamFactory $streamFactory) {
        $this->streamFactory = $streamFactory;
    }

    /**
     * Generate the response
     */
    public function __invoke(): ResponseInterface {
        return $this->response([
            'authenticated' => $this->isAuthenticated,
            'success' => ($this->status === 200),
            'status' => $this->status,
            'data' => $this->data,
            'missing' => $this->missing,
            'message' => $this->message,
            'timestamp' => time()
        ]);
    }

    /**
     * Serialize the $payload and Return a Response object
     * @param array $payload
     * @return Response
     */
    private function response(array $payload): Response {
        return new Response(
            $this->status,
            new Headers(['content-type' => 'application\json']),
            $this->streamFactory->createStream(json_encode($payload))
        );
    }

    /**
     * Set the parsed request array
     *
     * @param array $parsedRequest
     * @return ResponseBody
     */
    final public function setParsedRequest(array $parsedRequest): self
    {
        $clone = clone $this;
        $clone->parsedRequest = $parsedRequest;
        return $clone;
    }

    /**
     * Returned the parsed request
     *
     * @return array
     */
    final public function getParsedRequest(): array {
        return $this->parsedRequest;
    }

    /**
     * Indicate that the request is an administrator
     *
     * @return ResponseBody
     */
    final public function setIsAdmin(): self {
        $clone = clone $this;
        $clone->isAdmin = true;
        return $clone;
    }

    /**
     * Indicate that the request is authenticated
     *
     * @return ResponseBody
     */
    final public function setIsAuthenticated(): self {
        $clone = clone $this;
        $clone->isAuthenticated = true;
        return $clone;
    }

    /**
     * Returns true if the request is authenticated
     *
     * @return bool
     */
    final public function getIsAuthenticated(): bool {
        return $this->isAuthenticated;
    }

    final public function setUserId(?int $userId): self {
        $clone = clone $this;
        $clone->userId = $userId;
        return $clone;
    }

    final public function getUserId(): int {
        return $this->userId;
    }
    /** trashed records
     * Returns true if there are missing or required datapoints in the request
     *
     * @return bool
     */
    final public function hasMissingRequiredOrInvalid(): bool {
        return (isset($this->missing['invalid']) || isset($this->missing['required']));
    }

    /**
     * Register a parameter as optional, required or invalid.
     *
     * @param string $section
     * @param string $name
     * @param string | null $type
     * @param string|null $message
     */
    final public function registerParam(string $section, string $name, ?string $type, ?string $message = null): void {
        assert(in_array($section, ['optional', 'required', 'invalid']));
        assert($name !== '');

        if ($type === null) {
            $type = 'unknown';
        }

        // Not implemented
        $data = $this->missing[$section] ?? [];
        $data[$name] = $data[$name] ?? $type;
        $this->missing[$section] = $data;
        if ($message !== null) {
            $messages = $this->messages[$name] ?? [];
            $messages[] = $message;
            $this->messages[$name] = $messages;
        }
    }

    /**
     * Set the response data.
     *
     * @param array|null $data
     * @return ResponseBody
     */
    final public function setData(?array $data): self {
        $clone = clone $this;
        $clone->data = $data;
        return $clone;
    }

    /**
     * Set the response status code.
     *
     * @param int $status
     * @return self
     */
    final public function setStatus(int $status): self {
        assert($status > 99 && $status < 1000);
        $clone = clone $this;
        $clone->status = $status;
        return $clone;
    }

    /**
     * Set the response message
     *
     * @param string $message
     * @return ResponseBody
     */
    final public function setMessage(string $message): self {
        assert($message !== '');
        $clone = clone $this;
        $clone->message = $message;
        return $clone;
    }
}
