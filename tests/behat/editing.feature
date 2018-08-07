@tool @tool_dravek @javascript
Feature: Creating, editing and deleting entries
  In order to manage entries
  As a teacher
  I need to be able to add, edit and delete entries

  Background:
    Given the following "users" exist:
      | username | firstname | lastname | email                |
      | teacher | teacher   | test       | teacher@moodle.com |
    And the following "courses" exist:
      | fullname | shortname | format |
      | Be Happy | behappy | weeks |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | teacher | behappy     | editingteacher |

  Scenario: Add and edit an entry
    When I log in as "teacher"
    And I am on "Be Happy" course homepage
    And I navigate to "My ToDo Moodle plugin" in current page administration
    And I click on "New" "link" in the "region-main" "region"
    And I set the following fields to these values:
      | Name      | test entry 1 |
      | Completed | 0            |
    And I press "Add"
    Then the following should exist in the "tool_dravek_table" table:
      | Name         | Completed |
      | test entry 1 | No        |
    And I click on "Edit" "link" in the "test entry 1" "table_row"
    And I set the following fields to these values:
      | Completed | 1            |
    And I press "Modify"
    And the following should exist in the "tool_dravek_table" table:
      | Name         | Completed |
      | test entry 1 | Yes       |
    And I log out

  Scenario: Delete an entry
    When I log in as "teacher"
    And I am on "Be Happy" course homepage
    And I navigate to "My ToDo Moodle plugin" in current page administration
    And I click on "New" "link" in the "region-main" "region"
    And I set the field "Name" to "test entry 1"
    And I press "Add"
    And I click on "New" "link" in the "region-main" "region"
    And I set the field "Name" to "test entry 2"
    And I press "Add"
    And I click on "Delete" "link" in the "test entry 1" "table_row"
    And I click on "Yes" "button" in the "Delete" "dialogue"
    Then I should see "test entry 2"
    And I should not see "test entry 1"
    And I log out

  Scenario: Check Cancel Button
    When I log in as "teacher"
    And I am on "Be Happy" course homepage
    And I navigate to "My ToDo Moodle plugin" in current page administration
    And I click on "New" "link" in the "region-main" "region"
    And I press "Cancel"
    And I click on "New" "link" in the "region-main" "region"
    And I set the field "Name" to "test entry 3"
    And I press "Add"
    Then I should see "test entry 3"
    And I log out

  Scenario: Add and edit an entry with editor
    When I log in as "teacher"
    And I am on "Be Happy" course homepage
    And I navigate to "My ToDo Moodle plugin" in current page administration
    And I click on "New" "link" in the "region-main" "region"
    And I set the following fields to these values:
      | Name      | test entry 1   |
      | Comments  | Bye            |
    And I press "Add"
    Then the following should exist in the "tool_dravek_table" table:
      | Name         | Description |
      | test entry 1 | Bye         |
    And I click on "Edit" "link" in the "test entry 1" "table_row"
    And I set the following fields to these values:
      | Completed | 1            |
    And I press "Modify"
    And the following should exist in the "tool_dravek_table" table:
      | Name         | Description |
      | test entry 1 | Bye         |
    And I log out