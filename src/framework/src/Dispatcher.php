<?php declare(strict_types=1);

namespace Swoft;

use Swoft\Contract\DispatcherInterface;

/**
 * Class Dispatcher
 * @since 2.0
 */
abstract class Dispatcher implements DispatcherInterface
{
    /**
     * User defined middlewares
     *
     * @var array
     */
    protected $middlewares = [];

    /**
     * Default middleware name
     *
     * @var string
     */
    protected $defaultMiddleware;

    /**
     * @var array
     */
    private $preMiddlewares = [];

    /**
     * @var array
     */
    private $afterMiddlewares = [];

    public function init(): void
    {
        $this->preMiddlewares   = $this->preMiddleware();
        $this->afterMiddlewares = $this->afterMiddleware();
    }

    /**
     * Request middleware
     *
     * @return array
     */
    public function requestMiddleware(): array
    {
        return $this->middlewares ?
            \array_merge($this->preMiddlewares, $this->middlewares, $this->afterMiddlewares) :
            \array_merge($this->preMiddlewares, $this->afterMiddlewares);
    }

    /**
     * Pre middleware
     *
     * @return array
     */
    public function preMiddleware(): array
    {
        return [];
    }

    /**
     * After middleware
     *
     * @return array
     */
    public function afterMiddleware(): array
    {
        return [];
    }

    /**
     * Before dispatcher
     *
     * @param array ...$params
     */
    public function before(...$params): void
    {
    }

    /**
     * After dispatcher
     *
     * @param array ...$params
     */
    public function after(...$params): void
    {
    }
}
