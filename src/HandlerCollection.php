<?php
/**
 * @author: RunnerLee
 * @email: runnerleer@gmail.com
 * @time: 2017-04
 */

namespace Runner\WechatAnswer;

use Countable, ArrayIterator, IteratorAggregate;
use Runner\WechatAnswer\Exceptions\NotHandlerMatchedException;

class HandlerCollection implements Countable, IteratorAggregate
{

    /**
     * @var HandlerInterface[]
     */
    protected $handlers;

    /**
     * HandlerCollection constructor.
     * @param HandlerInterface[] $handles
     */
    public function __construct(array $handles)
    {
        foreach ($handles as $handle) {
            $this->add($handle);
        }
    }

    public function add(HandlerInterface $handler)
    {
        $this->handlers[] = $handler;
    }

    public function match($message)
    {
        foreach ($this->handlers as $handler) {
            if (!$handler->match($message)) {
                continue;
            }
            return $handler;
        }

        throw new NotHandlerMatchedException("message: {$message}");
    }

    /**
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->handlers);
    }

    public function count()
    {
        return count($this->handlers);
    }
}
