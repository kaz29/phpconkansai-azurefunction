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
            'attachments' => [[
                "color" => '#00BFFF', // blue
                "User" => $params['user_name'],
                "Message" => $params['text'],
            ]]
        ];

	    $this->writeResponse(json_encode($response));
	}
}