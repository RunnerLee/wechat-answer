<?php
/**
 * @author: RunnerLee
 * @email: runnerleer@gmail.com
 * @time: 2017-04
 */

namespace Runner\WechatAnswer;

abstract class AbstractHandler
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
     * @return bool
     */
    abstract public function match($message);

    /**
     * @param $message
     * @param Dispatcher $dispatcher
     * @return mixed
     */
    abstract public function handle($message, Dispatcher $dispatcher);
}
