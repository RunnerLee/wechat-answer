<?php
/**
 * @author: RunnerLee
 * @email: runnerleer@gmail.com
 * @time: 2017-04
 */

namespace Runner\WechatAnswer;

use Countable, ArrayIterator, IteratorAggregate;
use EasyWeChat\Support\Collection;
use Runner\WechatAnswer\Exceptions\MessageTypeNotSupportedException;
use Runner\WechatAnswer\Exceptions\NotHandlerMatchedException;

class HandlerCollection implements Countable, IteratorAggregate
{

    /**
     * @var array
     */
    protected $handlers;

    /**
     * @var array
     */
    protected $supportedMessageType = [
        'event',
        'text',
    ];

    public function add($type, AbstractMessageHandler $handler)
    {
        if (!$this->validateMessageTypeSupported($type)) {
            throw new MessageTypeNotSupportedException();
        }
        $this->handlers[$type][] = $handler;

        return $this;
    }

    /**
     * @param Collection $message
     * @return AbstractMessageHandler
     */
    public function match(Collection $message)
    {
        if (!$this->validateMessageTypeSupported($message->get('MsgType'))) {
            throw new MessageTypeNotSupportedException();
        }

        $content = $this->getMessageContent($message);

        foreach ($this->handlers[$message->get('MsgType')] as $handler) {
            if (!$handler->match($content)) {
                continue;
            }
            return $handler;
        }

        throw new NotHandlerMatchedException("message: {$content}");
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

    protected function validateMessageTypeSupported($type)
    {
        return false !== array_search($type, $this->supportedMessageType);
    }

    protected function getMessageContent(Collection $message)
    {
        switch ($message->get('MsgType')) {
            case 'event':
                return $message->get('EventKey');
            default:
                return $message->get('Content');
        }
    }
}
