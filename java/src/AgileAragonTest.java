import junit.framework.Assert;

import org.junit.AfterClass;
import org.junit.Before;
import org.junit.BeforeClass;
import org.junit.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.openqa.selenium.support.ui.WebDriverWait;


public class AgileAragonTest {

	static WebDriver driver;
	static org.openqa.selenium.support.ui.Wait<WebDriver> wait;	
	
	@BeforeClass
	public static void setUpBeforeClass() {
		driver = new FirefoxDriver();
		wait = new WebDriverWait(driver, 30);
	}
	
	@Before
	public void setUp() throws Exception {
		driver.get("http://agile-aragon.org/2013/02/25/testing-hacklab-en-marzo/");
	}

	@AfterClass
	public static void tearDownClass() throws Exception {
		driver.close();
	}

	@Test
	public void testImageDontAppearInPost() {
		Assert.assertFalse(isElementPresent("attachment_65"));
	}
	
	@Test
	public void testAgileAragonSearchWorks() {
		
		WebElement element = driver.findElement(By.id("s"));
		element.click();
		element.sendKeys("kata");
		
		element = driver.findElement(By.id("searchsubmit"));
		element.click();
		
		Assert.assertTrue(isElementPresent("attachment_65"));
	}
	
	
	private boolean isElementPresent(String id) {
		try {
			driver.findElement(By.id(id));
		} catch (Exception e) {
			return false;
		}
		return true;
	}

}
