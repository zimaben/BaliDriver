<?php

namespace rbt\admin;

Class SlackIntegration {


	private static $simpleIntegration = array(
		'bot_name'=>'New Assessment Bot',
		'bot_channel'=> 'assessments',
		'webhook'=>'https://hooks.slack.com/services/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'
		#'bot_name' => 'Sorce Sales',
		#'bot_channel' => 'temp_testing',
		#'webhook' => 'https://hooks.slack.com/services/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'
	);

	public $err = false;

	public function __construct(  $name, $args = array() ){
		$this->name = $name ? $this->checkName($name) : false;
		$this->args = $this->checkArgs($args);

	}
	private function createProp($prop, $value){
        $this->{$prop} = $value;
    }
	public function checkArgs( $args ){
		if(empty($args)) return false;

		foreach($args as $key=>$value){
			if(in_array($key, self::$allowed_args)){
				$this->createProp($key, $value);
			}
		}
		return $args;
	}
	public function checkName( $name ){
		$info = $this->getBotInfo( $name );
		if(is_array($info)){
			foreach($info as $k=>$v){
				$this->createProp($k,$v);
			}
			return $name;
		} else {
			$this->err = $info;
			return false;
		}
	}
	public function getWebhook(){
		return isset($this->webhook) ? $this->webhook : false;
	}
	public function getId(){
		return isset($this->id) ? $this->id : false;
	}
	public function getChannel(){
		return isset($this->channel) ? $this->channel : false;
	}
	public function postMessage( $message = null ){
		$this->err = false;
		if(!$message) $message = (isset($this->message) && $this->message) ? $this->message : false;
		if($message){
			if(isset($this->webhook)){
				
				$body = array('text'=>$message);
				#if(isset($this->channel)) $body['channel'] = $this->channel;
				
				if( !\wp_remote_post($this->webhook,
						array(
							'headers'=> array('content-type'=>'application/json'),
							'body'=> json_encode($body)
						)
					) 
				){
					$this->err = 'Problem with Post Request';
				}

			} else { $this->err = 'Webhook not Set'; }
			
		} else { $this->err = 'Message not Set'; }
	}

	private function getBotInfo( $string ){
		$return_array = array();
		if(!isset(self::$simpleIntegration)){
			$bots = \carbon_get_theme_option( 'slack_bots', 'complex');
			if(!$bots) $bots = \carbon_get_theme_option( 'slack_bots' );
			#still nothing maybe this was called before carbon_fields has registered
			if(!$bots) $bots = \get_option('_slack_bots');
			#$bots = self::$integrations;
			if(is_array($bots) && !empty($bots)){
	
				foreach($bots as $bot){
	
					$name = $bots['slack_bot_name'];
					if( trim(strtolower($name)) === trim(strtolower($string)) ){
						$channel = $bots['slack_bot_channel'];
						$webhook = $bots['slack_bot_webhook'];
	
						$return_array['name'] = $name;
						$return_array['channel'] = $channel;
						$return_array['webhook'] = $webhook;
					}
				}
				return (empty($return_array)) ? 'Could not find that Integration' : $return_array;
			} else {
				return 'No bots set up';
			}	
		} else {
			return array(
				'name'=>self::$simpleIntegration['bot_name'], 
				'channel'=>self::$simpleIntegration['bot_channel'],
				'webhook'=>self::$simpleIntegration['webhook']
			);
		}	
	}
}