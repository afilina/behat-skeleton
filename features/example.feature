Feature: Example

  Scenario: HTTP request
    # Given ...
    When I visit "/home"
    Then I should see "Example Domain"

  Scenario: Database state
    Given A discount of 5 percent on all products
    # When ...
    # Then ...
