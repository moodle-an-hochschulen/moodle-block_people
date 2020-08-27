@block @block_people
Feature: Using the block_people plugin
  In order to display the block_people plugin
  As admin
  I need to be able to configure the plugin block_people

  Background:
    Given the following "courses" exist:
      | fullname | shortname |
      | Course 1 | C1        |
    And the following "users" exist:
      | username   | firstname           | lastname |
      | teacher1   | Teacher             | 1        |
      | noneditor1 | Non-editing teacher | 1        |
    And the following "course enrolments" exist:
      | user       | course | role           |
      | teacher1   | C1     | editingteacher |
      | noneditor1 | C1     | teacher        |

  Scenario: Show participants in the block with the roles "Teacher" and "Non-editing teacher"
    # The values are the position 3 (Teacher) and 4 (Non-editing Teacher) in the current list.
    # If the list will be sorted in another way in the future this could break the test.
    Given the following config values are set as admin:
      | config | value | plugin       |
      | roles  | 3, 4  | block_people |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage with editing mode on
    And I add the "People" block
    Then the user "Teacher 1" should be listed in the section with the role "Teacher"
    And the user "Non-editing teacher 1" should be listed in the section with the role "Non-editing teacher"

  # Javascript is needed for Scenarios with visibility checks.
  @javascript
  Scenario: Counter check: Do not show any roles
    Given the following config values are set as admin:
      | config | value | plugin       |
      | roles  | 0     | block_people |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage with editing mode on
    And I add the "People" block
    Then ".block_people div.teachers" "css_element" should not be visible

  Scenario: Show participants in the block with the roles "Teacher" and ""Non-editing teacher" with setting "Show multiple roles" enabled
    Given the following config values are set as admin:
      | config        | value | plugin       |
      | multipleroles | 1     | block_people |
      | roles         | 3, 4  | block_people |
    And the following "users" exist:
      | username       | firstname | lastname |
      | multiroleuser  | Multirole | User     |
    And the following "course enrolments" exist:
      | user          | course | role           |
      | multiroleuser | C1     | editingteacher |
    And the following "system role assigns" exist:
      | user          | course   | role      |
      | multiroleuser | Course 1 | teacher   |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage with editing mode on
    And I add the "People" block
    Then the user "Teacher 1" should be listed in the section with the role "Teacher"
    And the user "Multirole User" should be listed in the section with the role "Teacher"
    And the user "Non-editing teacher 1" should be listed in the section with the role "Non-editing teacher"
    And the user "Multirole User" should be listed in the section with the role "Non-editing teacher"

  Scenario: Enable "Show link to the participants page"
    Given the following config values are set as admin:
      | config               | value | plugin       |
      | linkparticipantspage | 1     | block_people |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage with editing mode on
    And I add the "People" block
    Then I should see "Show participants list" in the ".block_people .participants" "css_element"
    When I click on "Show participants list" "link"
    Then I should see "Participants" in the "region-main" "region"

  Scenario: Counter check: Disable "Show link to the participants page"
    Given the following config values are set as admin:
      | config               | value | plugin       |
      | linkparticipantspage | 0     | block_people |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage with editing mode on
    And I add the "People" block
    Then ".block_people .participants" "css_element" should not exist

  Scenario: Enable "Hiding the block"
    Given the following config values are set as admin:
      | config    | value | plugin       |
      | hideblock | 1     | block_people |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage with editing mode on
    And I add the "People" block
    When I open the action menu in "People" "block"
    Then I should see "Hide People block"
    When I click on "Hide People block" "link"
    When I turn editing mode off
    Then "People" "block" should not exist
    When I turn editing mode on
    And I open the action menu in "People" "block"
    And I click on "Show People block" "link"
    Then "People" "block" should exist

  Scenario: Counter check: Disable "Hiding the block"
    Given the following config values are set as admin:
      | config    | value | plugin       |
      | hideblock | 0     | block_people |
    When I log in as "teacher1"
    And I am on "Course 1" course homepage with editing mode on
    And I add the "People" block
    When I open the action menu in "People" "block"
    Then I should not see "Hide People block"

  Scenario: Reset visibility of hidden People blocks
    When I log in as "teacher1"
    And I am on "Course 1" course homepage with editing mode on
    And I add the "People" block
    And I open the action menu in "People" "block"
    And I click on "Hide People block" "link"
    Then "People" "block" should not exist
    And I log out
    When I log in as "admin"
    And I navigate to "Plugins > Blocks > People" in site administration
    And I set the field "Reset visibility" to "1"
    And I press "Save changes"
    And I log out
    And I log in as "teacher1"
    And I am on "Course 1" course homepage
    Then "People" "block" should exist
