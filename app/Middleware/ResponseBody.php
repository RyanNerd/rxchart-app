<?php
declare(strict_types=1);

namespace Willow\Middleware;

use JsonException;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Psr7\Headers;
use Slim\Psr7\Response;

class ResponseBody extends ResponseCodes
{
    private static ?array $parsedRequest = null;
    protected bool $isAuthenticated = false;
    protected bool $isAdmin = false;

    /**
     * The response data
     * @var null|array<array>
     */
    protected ?array $data = null;

    /**
     * HTTP status code
     */
    protected int $status = 200;

    /**
     * Response messages
     * @var array<string>
     */
    protected array $messages = [];

    /**
     * Missing parameters
     */
    protected array $missing = [];

    /**
     * Primary key of User when authenticated
     */
    protected ?int $userId = null;

    /**
     * ResponseBody constructor.
     * @param array $parsedRequest
     */
    public function __construct(array $parsedRequest) {
        $this->setParsedRequest($parsedRequest);
    }

    /**
     * Serialize the payload and Return a Response object
     * @return ResponseInterface
     * @throws JsonException
     */
    public function __invoke(): ResponseInterface {
        return new Response(
            $this->status,
            (new Headers(['content-type' => 'application/json'])),
            (new StreamFactory())->createStream(json_encode([
                'authenticated' => $this->isAuthenticated,
                'success' => ($this->status === 200),
                'status' => $this->status,
                'data' => $this->data,
                'missing' => $this->missing,
                'message' => $this->messages,
                'timestamp' => time()
            ], JSON_THROW_ON_ERROR))
        );
    }

    /**
     * Set the parsed request array
     * @param array $parsedRequest
     */
    private function setParsedRequest(array $parsedRequest): void {
        self::$parsedRequest = $parsedRequest;
    }

    /**
     * Returned the parsed request
     * @return array
     */
    final public function getParsedRequest(): array {
        return self::$parsedRequest;
    }

    /**
     * Indicate that the request is an administrator
     * @return ResponseBody
     */
    final public function setIsAdmin(): self {
        $clone = clone $this;
        $clone->isAdmin = true;
        return $clone;
    }

    /**
     * Indicate that the request is authenticated
     * @return ResponseBody
     */
    final public function setIsAuthenticated(): self {
        $clone = clone $this;
        $clone->isAuthenticated = true;
        return $clone;
    }

    /**
     * Returns true if the request is authenticated
     * @return bool
     */
    final public function getIsAuthenticated(): bool {
        return $this->isAuthenticated;
    }

    /**
     * Set the primary key of the User table when successfully authenticated
     * @param int|null $userId
     * @return $this
     */
    final public function setUserId(?int $userId): self {
        $clone = clone $this;
        $clone->userId = $userId;
        return $clone;
    }

    /**
     * Returns the primary key in User when authenticated
     * @return int
     */
    final public function getUserId(): int {
        return $this->userId;
    }

    /**
     * Returns true if there are missing or required datapoints in the request
     * @return bool
     */
    final public function hasMissingRequiredOrInvalid(): bool {
        return (isset($this->missing['invalid']) || isset($this->missing['required']));
    }

    /**
     * Register a parameter as optional, required or invalid.
     * @param string $section
     * @param string $name
     * @param string|null $type
     * @param string|null $message
     */
    final public function registerParam(string $section, string $name, ?string $type, ?string $message = null): void {
        assert(in_array($section, ['optional', 'required', 'invalid']));
        assert($name !== '');

        if ($type === null) {
            $type = 'unknown';
        }

        $data = $this->missing[$section] ?? [];
        $data[$name] = $data[$name] ?? $type;
        $this->missing[$section] = $data;

        if ($message !== null) {
            $this->messages[] = $message;
        }
    }

    /**
     * Set the response data.
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
     * Set the response messages
     * @param string|array $message
     * @return ResponseBody
     */
    final public function setMessage(string|array $message): self {
        if (is_string($message)) {
            assert($message !== '');
            $message = [$message];
        }
        $messages = ($this->messages);
        foreach ($message as $msg) {
            $messages[] = $msg;
        }
        $clone = clone $this;
        $clone->messages = $messages;
        return $clone;
    }
}
