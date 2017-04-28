<?php
/**
 * @author: RunnerLee
 * @email: runnerleer@gmail.com
 * @time: 2017-04
 */

namespace Runner\WechatAnswer;

use EasyWeChat\Message\AbstractMessage;

interface HandlerInterface
{

    /**
     * @return string
     */
    public function name();

    /**
     * @return string
     */
    public function description();

    /**
     * @param string $message
     * @return bool
     */
    public function match($message);

    /**
     * @param $message
     * @param Dispatcher $dispatcher
     * @return mixed
     */
    public function handle($message, Dispatcher $dispatcher);

}
