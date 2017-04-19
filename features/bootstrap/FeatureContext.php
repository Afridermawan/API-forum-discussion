<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use GuzzleHttp\Client;

/**
 * Defines application features from the specific context.
 */

require_once  __DIR__ . '/../../vendor/autoload.php';

class FeatureContext extends MinkContext implements Context
{
    public function __construct()
    {
        /**
    * @When I GET url :arg1
    */
    }
    public function iGetUrl($arg1)
    {
       $this->dbConnect();

       $client = new GuzzleHttp\Client();
       $res = $client->request('GET', 'http://localhost/' . $args1);
       $this->response['status_code'] = $res->getStatusCode();
       $this->response['body'] = $res->getBody();
    }    
    /**
    * @Then I get response code :arg1
    */
    public function iGetResponseCode($arg1)
    {
       $status_code = $this->response['status_code'];
       if(!($status_code == $args1)) {
           echo "Invalid Response Code (" . $status_code . ")\n"; exit();
       }
    }

    /**
    * @Then I have multiple json response that contain key :arg1
    */
    public function iHaveMultipleJsonResponseThatContainKey($arg1)
    {
       throw new PendingException();
    }
}
