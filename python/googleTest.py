#!/usr/bin/python
import unittest, time
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.common.exceptions import NoSuchElementException

class TestBlogPostOfAgileAragon(unittest.TestCase):

    def setUp(self):
        self.driver = webdriver.Firefox()
        self.driver.get("http://agile-aragon.org/2013/02/25/testing-hacklab-en-marzo/")

    def test_image_dont_appear_in_post(self):
        driver = self.driver

        self.assertFalse(self.is_element_present(By.ID, "attachment_65"))

    def test_agile_aragon_search_works(self):
        driver = self.driver

        elem = driver.find_element(by=By.ID, value="s")
        elem.click()
        elem.send_keys("agile aragon")

        elem = driver.find_element(by=By.ID, value="searchsubmit")
        elem.click()

        self.assertTrue(self.is_element_present(By.ID, "attachment_65"))


    def tearDown(self):
        self.driver.quit()

    def is_element_present(self, how, what):
        try: self.driver.find_element(by=how, value=what)
        except NoSuchElementException: return False
        return True

if __name__ == "__main__":
    unittest.main()
