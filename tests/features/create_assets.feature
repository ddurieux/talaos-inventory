Feature: Handling some computers with softwares

  Background:
    Given the api backend is available
    And I create the asset type "computer"
    And I create the asset type "software"
    And I create the following "computer" assets
      | name        |
      | Computer 1  |
      | Computer 2  |
      | Computer 3  |
      | Computer 11 |
      | Computer 21 |
      | Computer 31 |
      | Computer 41 |
      | Computer 111 |


  Scenario: Retrieve every computers
        When I am looking for asset types "computer"
        Then I must retrieve a list of "8" computers

  Scenario: Retrieve computers starting with a string
        When I am looking for asset types starting with "Computer 1"
        Then I must retrieve a list of "3" computers

