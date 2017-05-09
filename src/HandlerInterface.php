<?php
/**
 * @author: RunnerLee
 * @email: runnerleer@gmail.com
 * @time: 2017-05
 */

namespace Runner\WechatAnswer;

use EasyWeChat\Message\AbstractMessage;
use EasyWeChat\Support\Collection;

interface HandlerInterface
{
    /**
     * @param Collection $message
     *
     * @return AbstractMessage|string
     */
    public function handle(Collection $message);
}
