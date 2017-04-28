<?php
/**
 * @author: RunnerLee
 * @email: runnerleer@gmail.com
 * @time: 2017-04
 */

use Runner\WechatAnswer\HandlerInterface;
use Runner\WechatAnswer\Dispatcher;
use EasyWeChat\Message\News;

class OrderHandler implements HandlerInterface
{

    /**
     * @return string
     */
    public function name()
    {
        return '订单号查询';
    }

    /**
     * @return string
     */
    public function description()
    {
        return '根据订单号查询订单, 例如: 订单123456';
    }

    /**
     * @param string $message
     * @return bool
     */
    public function match($message)
    {
        return '订单' === mb_substr($message, 0, 2);
    }

    /**
     * @param $message
     * @param \Runner\WechatAnswer\Dispatcher $dispatcher
     * @return mixed
     */
    public function handle($message, Dispatcher $dispatcher)
    {
        return new News([
            'title'         => '订单详情',
            'description'   => '这是订单的详细信息',
            'url'           => 'https://github.com/RunnerLee',
            'image'         => '',
        ]);
    }
}