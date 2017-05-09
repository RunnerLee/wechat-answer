<?php
/**
 * @author: RunnerLee
 * @email: runnerleer@gmail.com
 * @time: 2017-04
 */

namespace Runner\WechatAnswer;

use EasyWeChat\Message\Text;
use EasyWeChat\Support\Collection;
use Runner\WechatAnswer\Exceptions\NotHandlerMatchedException;

class Dispatcher
{
    /**
     * @var HandlerCollection
     */
    protected $handlers;

    /**
     * @var HandlerInterface
     */
    protected $defaultHandler;

    /**
     * @var HandlerInterface
     */
    protected $exceptionHandler;

    /**
     * Dispatcher constructor.
     *
     * @param HandlerCollection $handlers
     */
    public function __construct(HandlerCollection $handlers)
    {
        $this->handlers = $handlers;
    }

    /**
     * @param HandlerInterface $handler
     *
     * @return $this
     */
    public function setDefaultHandler(HandlerInterface $handler)
    {
        $this->defaultHandler = $handler;

        return $this;
    }

    /**
     * @param HandlerInterface $handler
     *
     * @return $this
     */
    public function setExceptionHandler(HandlerInterface $handler)
    {
        $this->exceptionHandler = $handler;

        return $this;
    }

    public function dispatch(Collection $message)
    {
        try {
            $handler = $this->handlers->match($message);
            $response = $handler->handle($message, $this);
        } catch (\Exception $e) {
            if (($e instanceof NotHandlerMatchedException) && !is_null($this->defaultHandler)) {
                $response = $this->defaultHandler->handle($message);
            } elseif (!is_null($this->exceptionHandler)) {
                $response = $this->exceptionHandler->handle($message);
            }
        }

        is_string($response) && $response = new Text([
            'content' => $response,
        ]);

        return $response;
    }

    /**
     * @return \ArrayIterator|\Traversable
     */
    public function handlers()
    {
        return $this->handlers->getIterator();
    }
}
