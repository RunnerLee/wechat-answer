# Wechat Answer

基于 [easywechat](https://github.com/overtrue/wechat) 的用户文字消息处理回复.

## 使用

消息处理
```
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
```

实例化调度器
```
use Runner\WechatAnswer\Dispatcher;

$dispatcher = new Dispatcher([
    new DemoHandler(),
]);

$server->setMessageHandler(function ($message) use ($dispatcher) {
    return $dispatcher->dispatch($message->get('Content'));
});

$app->server->serve()->send();

```