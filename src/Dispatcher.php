<?php
/**
 * @author: RunnerLee
 * @email: runnerleer@gmail.com
 * @time: 2017-04
 */

namespace Runner\WechatAnswer;

use EasyWeChat\Message\Text;

class Dispatcher
{

    protected $handlers;

    public function __construct(array $handlers)
    {
        $this->handlers = new HandlerCollection($handlers);
    }

    public function dispatch($message)
    {
        $handler = $this->handlers->match($message);

        $response = $handler->handle($message, $this);

        is_string($response) && $response = new Text($response);

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
