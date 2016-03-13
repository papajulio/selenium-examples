Feature: Login
  In order to user the app
  As a customer
  I need to be able to login in the app

  Scenario: Enter the login page
    Given we have access to the app
    When we enter in "panel.sensovida.com"
    Then we see the title "Sensovida - Login Site"

  Scenario: Wrong login
    Given we are in "panel.sensovida.com"
    When we try to login with "badUsername" and "badPassword"
    Then we should see the error that contains "incorrectos"
