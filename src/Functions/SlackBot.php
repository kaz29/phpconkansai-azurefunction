<?php
namespace App\Functions;

use App\Lib\AzureFunction;

class SlackBot extends AzureFunction
{
	public function __construct($req = 'req', $res = 'res')
	{
		$this->init(getenv($req), getenv($res));
	}

	public function run()
	{
	    $params = $this->httpParams();
	    if (!isset($params['user_name']) || $params['user_name'] === 'slackbot') {
	        return;
        }

        $response = [
            'text' => '',
            'username' => 'phpconkansai2017demo',
            'icon_emoji' => ':phpkansai:',
            'attachments' => [[
                "color" => '#00BFFF', // blue
                "title" => 'メッセージを受信しました',
                "fields" => [[
                    'title' => 'ユーザー',
                    'value' => $params['user_name'],
                    "short" => true
                ],[
                    'title' => 'メッセージ',
                    'value' => $params['text'],
                    "short" => true
                ]]
            ]]
        ];

	    $this->writeResponse(json_encode($response));
	}
}