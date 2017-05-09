<?php

/**
 * @author: RunnerLee
 * @email: runnerleer@gmail.com
 * @time: 2017-05
 */

use Runner\WechatAnswer\HandlerInterface;

class DefaultHandler implements HandlerInterface
{

    /**
     * @param \EasyWeChat\Support\Collection $message
     * @return \EasyWeChat\Message\AbstractMessage|string
     */
    public function handle(\EasyWeChat\Support\Collection $message)
    {
        return 'nothing';
    }
}
