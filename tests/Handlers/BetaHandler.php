<?php

/**
 * @author: RunnerLee
 * @email: runnerleer@gmail.com
 * @time: 2017-05
 */

use Runner\WechatAnswer\AbstractMessageHandler;

class BetaHandler extends AbstractMessageHandler
{

    /**
     * @param \EasyWeChat\Support\Collection $message
     * @return \EasyWeChat\Message\AbstractMessage|string
     */
    public function handle(\EasyWeChat\Support\Collection $message)
    {
        throw new Exception('hhh');
    }

    /**
     * @param string $message
     * @return bool
     */
    public function match($message)
    {
        return 'beta' === substr($message, 0, 4);
    }
}
