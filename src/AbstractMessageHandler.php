<?php
/**
 * @author: RunnerLee
 * @email: runnerleer@gmail.com
 * @time: 2017-04
 */

namespace Runner\WechatAnswer;

use EasyWeChat\Message\AbstractMessage;
use EasyWeChat\Support\Collection;

abstract class AbstractMessageHandler implements HandlerInterface
{
    protected $name;

    protected $description;

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function description()
    {
        return $this->description;
    }

    /**
     * @param string $message
     *
     * @return bool
     */
    abstract public function match($message);

    /**
     * @param Collection $message
     *
     * @return AbstractMessage|string
     */
    abstract public function handle(Collection $message);
}
