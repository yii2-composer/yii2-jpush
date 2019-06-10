<?php

namespace lspbupt\Jpush;

use JPush\Client;
use JPush\Config;
use \Yii;
use \yii\base\Component;
use \yii\base\InvalidConfigException;

class Jpush extends Component
{
    public $app_key;
    public $app_secret;

    public $logFile = Config::DEFAULT_LOG_FILE;

    private $jpush;

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function init()
    {
        parent::init();
        if (empty($this->app_key) || empty($this->app_secret)) {
            throw new InvalidConfigException("app_key和app_secret必须设置");
        }
        $this->jpush = new Client($this->app_key, $this->app_secret, $this->logFile);
    }

    public function __call($method, $args = [])
    {
        return call_user_func_array(array($this->jpush, $method), $args);
    }
}
