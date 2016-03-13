<?php

use Facebook\WebDriver\Remote\RemoteWebDriver as RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities as DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy as WebDriverBy;
use Facebook\WebDriver\WebDriverKeys as WebDriverKeys;

class SensoVidaTest extends PHPUnit_Framework_TestCase {

    protected $webDriver;

    public function setUp()
    {
        // This would be the url of the host running the server-standalone.jar
        $host = 'http://localhost:4444/wd/hub'; // this is the default
        $this->webDriver = RemoteWebDriver::create($host, DesiredCapabilities::firefox());
    }

    protected $url = 'http://panel.sensovida.com';

    public function testSensoVidaTitle()
    {
        $this->webDriver->get($this->url);
        $this->assertContains('Sensovida - Login Site', $this->webDriver->getTitle());
    }

    public function testWrongLogin()
    {
        $this->webDriver->get($this->url);
	    $userForm = $this->webDriver->findElement(WebDriverBy::name('LoginForm[username]'));
        $userForm->click();
	    $this->webDriver->getKeyboard()->sendKeys('badUsername');

	    $passwordForm = $this->webDriver->findElement(WebDriverBy::name('LoginForm[password]'));
        $passwordForm->click();
	    $this->webDriver->getKeyboard()->sendKeys('badPassword');

	    $this->webDriver->getKeyboard()->pressKey(WebDriverKeys::ENTER);

        $errorMessage = $this->webDriver->findElements(
            // some CSS selectors can be very long:
            WebDriverBy::cssSelector('div.form-group.has-error > p.help-block')
        );
        $this->assertContains('incorrectos', $errorMessage[1]->getText());
    }

    public function tearDown()
    {
        $this->webDriver->quit();
    }
}
?>
