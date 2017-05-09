<?php

/**
 * @author: RunnerLee
 * @email: runnerleer@gmail.com
 * @time: 2017-05
 */
use Runner\WechatAnswer\AbstractMessageHandler;

class AlphaHandler extends AbstractMessageHandler
{
    /**
     * @param string $message
     *
     * @return bool
     */
    public function match($message)
    {
        return 'alpha' === substr($message, 0, 5);
    }

    /**
     * @param \EasyWeChat\Support\Collection $message
     *
     * @return \EasyWeChat\Message\AbstractMessage
     */
    public function handle(\EasyWeChat\Support\Collection $message)
    {
        return 'alpha success';
    }
}
