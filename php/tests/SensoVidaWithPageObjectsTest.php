<?php

require 'tests/LoginPage.php';

class SensoVidaTestPO extends PHPUnit_Framework_TestCase {

    protected $webDriver;

    public function setUp()
    {
        $this->loginPage = new LoginPage();
        $this->loginPage->load();
    }

    public function testSensoVidaTitlePO()
    {
        $this->assertContains('Sensovida - Login Site', $this->loginPage->getTitle());
    }

    public function testWrongLoginPO()
    {

        $this->loginPage->setLoginValues("badUsername", "badPassword");
        $this->loginPage->login();

        $this->assertContains('incorrectos', $this->loginPage->getErrorMessage());
    }

    public function tearDown()
    {
        $this->loginPage->close();
    }
}
?>
