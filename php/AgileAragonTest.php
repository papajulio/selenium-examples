<?php
class WebTest extends PHPUnit_Extensions_Selenium2TestCase
{
    protected function setUp()
    {
        $this->setBrowser('firefox');
        $this->setBrowserUrl('http://agile-aragon.org/2013/02/25/testing-hacklab-en-marzo/');
    }

    /**
     * @expectedException PHPUnit_Extensions_Selenium2TestCase_WebDriverException
    */
    public function testImageDontAppearInPost()
    {
        $image = $this->byId('attachment_65');
    }


    public function testAgileAragonSearchWorks()
    {
        $input = $this->byId('s');
        $input->click();
        $this->keys('kata');


        $button = $this->byId('searchsubmit');
        $button->click();

        $image = $this->byId('attachment_65');
    }

}
?>
