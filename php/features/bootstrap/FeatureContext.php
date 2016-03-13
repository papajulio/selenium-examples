<?php

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Hook\Scope\AfterScenarioScope;

use Facebook\WebDriver\Remote\RemoteWebDriver as RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities as DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy as WebDriverBy;
use Facebook\WebDriver\WebDriverKeys as WebDriverKeys;

/**
 * Behat context class.
 */
class FeatureContext implements SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets it's own context object.
     * You can also pass arbitrary arguments to the context constructor through behat.yml.
     */
    protected $webDriver;

    public function __construct()
    {
        // This would be the url of the host running the server-standalone.jar
        $host = 'http://localhost:4444/wd/hub'; // this is the default
        $this->webDriver = RemoteWebDriver::create($host, DesiredCapabilities::firefox());
    }

    /**
     * @Given we have access to the app
     */
    public function weHaveAccessToTheApp()
    {
    }

    /**
     * @When we enter in :url
     */
    public function weEnterIn($url)
    {
        $this->webDriver->get("http://".$url);
    }

    /**
     * @Then we see the title :title
     */
    public function weSeeTheTitle($title)
    {
        $this->webDriver->getTitle();
        PHPUnit_Framework_Assert::assertContains(
            $this->webDriver->getTitle(),
            $title
        );
    }

    /**
     * @Given we are in :url
     */
    public function weAreIn($url)
    {
        $this->webDriver->get("http://".$url);
    }

    /**
     * @When we try to login with :username and :password
     */
    public function weTryToLoginWithAnd($username, $password)
    {
	    $userForm = $this->webDriver->findElement(WebDriverBy::name('LoginForm[username]'));
        $userForm->click();
	    $this->webDriver->getKeyboard()->sendKeys($username);

	    $passwordForm = $this->webDriver->findElement(WebDriverBy::name('LoginForm[password]'));
        $passwordForm->click();
	    $this->webDriver->getKeyboard()->sendKeys($password);
	    $this->webDriver->getKeyboard()->pressKey(WebDriverKeys::ENTER);
    }

    /**
     * @Then we should see the error that contains :errorMsg
     */
    public function weShouldSeeTheErrorThatContains($errorMsg)
    {
        $errorMessage = $this->webDriver->findElements(
            // some CSS selectors can be very long:
            WebDriverBy::cssSelector('div.form-group.has-error > p.help-block')
        );
        PHPUnit_Framework_Assert::assertContains(
            $errorMsg,
            $errorMessage[1]->getText()
        );
    }

    /**
      * @AfterScenario
      */
     public function cleanBrowsers(AfterScenarioScope $scope)
     {
        $this->webDriver->quit();
     }
}
