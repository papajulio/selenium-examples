<?php

use Facebook\WebDriver\Remote\RemoteWebDriver as RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities as DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy as WebDriverBy;
use Facebook\WebDriver\WebDriverKeys as WebDriverKeys;

class LoginPage {

    protected $url = 'http://panel.sensovida.com';

    public function load()
    {
        $host = 'http://localhost:4444/wd/hub'; // this is the default
        $this->webDriver = RemoteWebDriver::create($host, DesiredCapabilities::firefox());
        $this->webDriver->get($this->url);
    }

    public function getTitle()
    {
        return  $this->webDriver->getTitle();
    }

    public function close()
    {
        $this->webDriver->quit();
    }

    public function setLoginValues($username, $password)
    {
	    $userForm = $this->webDriver->findElement(WebDriverBy::name('LoginForm[username]'));
        $userForm->click();
	    $this->webDriver->getKeyboard()->sendKeys($username);

	    $passwordForm = $this->webDriver->findElement(WebDriverBy::name('LoginForm[password]'));
        $passwordForm->click();
	    $this->webDriver->getKeyboard()->sendKeys($password);
    }

    public function login()
    {
	    $this->webDriver->getKeyboard()->pressKey(WebDriverKeys::ENTER);
    }

    public function getErrorMessage()
    {
        $errorMessage = $this->webDriver->findElements(
            // some CSS selectors can be very long:
            WebDriverBy::cssSelector('div.form-group.has-error > p.help-block')
        );
        return $errorMessage[1]->getText();

    }

}
?>
