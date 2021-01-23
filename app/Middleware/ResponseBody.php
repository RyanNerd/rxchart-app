<?php
declare(strict_types=1);

namespace Willow\Middleware;

use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response;

class ResponseBody
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
     *
     * @var array
     */
    protected array $missing = [];

    protected ?int $userId = null;

    /**
     * Generate the response
     */
    public function __invoke(): ResponseInterface
    {
        $payload = [
            'authenticated' => $this->isAuthenticated,
            'success' => ($this->status === 200),
            'status' => $this->status,
            'data' => $this->data,
            'missing' => $this->missing,
            'message' => $this->message,
            'timestamp' => time()
        ];

        $response = new Response();
        $response->getBody()->write(json_encode($payload));
        return $response
            ->withStatus($this->status)
            ->withHeader('content-type', 'application\json');
    }

    /**
     * Set the parsed request array
     *
     * @param array $parsedRequest
     * @return ResponseBody
     */
    public function setParsedRequest(array $parsedRequest): self
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
    public function getParsedRequest(): array
    {
        return $this->parsedRequest;
    }

    /**
     * Indicate that the request is an administrator
     *
     * @return ResponseBody
     */
    public function setIsAdmin(): self
    {
        $clone = clone $this;
        $clone->isAdmin = true;
        return $clone;
    }

    /**
     * Indicate that the request is authenticated
     *
     * @return ResponseBody
     */
    public function setIsAuthenticated(): self
    {
        $clone = clone $this;
        $clone->isAuthenticated = true;
        return $clone;
    }

    /**
     * Returns true if the request is authenticated
     *
     * @return bool
     */
    public function getIsAuthenticated(): bool
    {
        return $this->isAuthenticated;
    }

    public function setUserId(?int $userId): self
    {
        $clone = clone $this;
        $clone->userId = $userId;
        return $clone;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
    /**
     * Returns true if there are missing or required datapoints in the request
     *
     * @return bool
     */
    public function hasMissingRequiredOrInvalid(): bool
    {
        return (isset($this->missing['invalid']) || isset($this->missing['required']));
    }

    /**
     * Register a parameter as optional, required or invalid.
     *
     * @param string $section
     * @param string $name
     * @param string | null $type
     */
    public function registerParam(string $section, string $name, ?string $type): void
    {
        assert(in_array($section, ['optional', 'required', 'invalid']));
        assert($name !== '');

        if ($type === null) {
            $type = 'unknown';
        }

        $data = $this->missing[$section] ?? [];
        $data[$name] = $data[$name] ?? $type;
        $this->missing[$section] = $data;
    }

    /**
     * Set the response data.
     *
     * @param array|null $data
     * @return ResponseBody
     */
    public function setData(?array $data): self
    {
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
    public function setStatus(int $status): self
    {
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
    public function setMessage(string $message): self
    {
        assert($message !== '');

        $clone = clone $this;
        $clone->message = $message;
        return $clone;
    }
}
