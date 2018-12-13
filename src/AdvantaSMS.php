<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 3/13/18
 * Time: 12:09 AM
 */

namespace CraftedSystems\Advanta;

use Unirest\Request;

class AdvantaSMS
{
    /**
     * Base URL.
     *
     * @var string
     */
    const BASE_URL = 'http://messaging.advantasms.com/sendsms.jsp';

    /**
     * Get Balance endpoint.
     *
     * @var string
     */
    const GET_BALANCE_ENDPOINT = 'sms/balance';

    /**
     * settings .
     *
     * @var array.
     */
    protected $settings;

    /**
     * MicroMobileSMS constructor.
     * @param $settings
     * @throws \Exception
     */
    public function __construct($settings)
    {
        $this->settings = (object)$settings;

        if (
            empty($this->settings->user) ||
            empty($this->settings->password) ||
            empty($this->settings->sender)
        ) {
            throw new \Exception('Please ensure that all Advanta configuration variables have been set.');
        }
    }

    /**
     * @param $recipient
     * @param $message
     * @return mixed
     * @throws \Exception
     */
    public function send($recipient, $message)
    {
        if (!is_string($message)) {

            throw new \Exception('The Message Should be a string');
        }

        if (!is_string($recipient)) {
            throw new \Exception('The Phone number should be a string');
        }

        $sender = $this->settings->sender;
        $user = $this->settings->user;
        $password = $this->settings->password;

        $str = self::BASE_URL . "?user=$user&password=$password&mobiles=$recipient&sender=$sender&sms=$message";

        $response = Request::get($str);

        return $response->body;

    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function getDeliveryReports(\Illuminate\Http\Request $request)
    {
        return json_decode($request->getContent());
    }

    /**
     * @return float
     */
    public function getBalance()
    {

        return 100;
    }

}