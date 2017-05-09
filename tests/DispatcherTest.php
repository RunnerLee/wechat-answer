<?php
/**
 * @author: RunnerLee
 * @email: runnerleer@gmail.com
 * @time: 2017-04
 */
use Runner\WechatAnswer\Dispatcher;

class DispatcherTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Dispatcher
     */
    protected $dispatcher;

    public function setUp()
    {
        include_once __DIR__.'/Handlers/AlphaHandler.php';
        include_once __DIR__.'/Handlers/BetaHandler.php';
        include_once __DIR__.'/Handlers/DefaultHandler.php';
        include_once __DIR__.'/Handlers/ExceptionHandler.php';

        $collection = new \Runner\WechatAnswer\HandlerCollection();

        $collection
            ->add('text', new AlphaHandler())
            ->add('text', new BetaHandler());

        $this->dispatcher = new Dispatcher($collection);

        $this->dispatcher->setExceptionHandler(new ExceptionHandler())->setDefaultHandler(new DefaultHandler());
    }

    public function testDispatch()
    {
        $message = new \EasyWeChat\Support\Collection([
            'MsgType' => 'text',
            'Content' => 'alpha567',
        ]);
        $response = $this->dispatcher->dispatch($message);

        $this->assertEquals('alpha success', $response->get('content'));
    }

    public function testDefaultHandler()
    {
        $message = new \EasyWeChat\Support\Collection([
            'MsgType' => 'text',
            'Content' => 'apha567',
        ]);
        $response = $this->dispatcher->dispatch($message);

        $this->assertEquals('nothing', $response->get('content'));
    }

    public function testExceptionHandler()
    {
        $message = new \EasyWeChat\Support\Collection([
            'MsgType' => 'text',
            'Content' => 'beta123',
        ]);
        $response = $this->dispatcher->dispatch($message);

        $this->assertEquals('something wrong.', $response->get('content'));
    }
}
