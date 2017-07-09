<?php
namespace App\Test\TestCase\Functions;

use App\Test\Lib\TestCase;
use App\Functions\SlackBot;

class SLackBotTest extends TestCase
{
    var $slackBot = null;

    public function setUp()
    {
        parent::setUp();

    }

    public function tearDown()
    {
        unset($this->slackBot);
        parent::tearDown();
    }

    /**
     * @test
     */
    public function 通常の書き込みのテスト()
    {
        $params = [
            'token' => 'DUMMY',
            'user_name' => 'userA',
            'text' => 'メッセージ'
        ];
        $this->makeHttpRequest($params);
        $this->makeResponse();

        $this->slackBot = new SlackBot();
        $this->slackBot->run();

        $result = json_decode($this->getResponse(), true);
        $expected = [
            'text' => '',
            'attachments' => [[
                "color" => '#00BFFF',
                "User" => "userA",
                "Message" => "メッセージ",
            ]]
        ];
        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     */
    public function ボットの書き込みを無視するテスト()
    {
        $params = [
            'token' => 'DUMMY',
            'user_name' => 'slackbot',
            'text' => 'メッセージ'
        ];
        $this->makeHttpRequest($params);
        $this->makeResponse();

        $this->slackBot = new SlackBot();
        $this->slackBot->run();

        $result = $this->getResponse();
        $this->assertEquals("", $result);
    }
}
