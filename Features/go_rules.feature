
Feature: Enforcing the game rules
  In order to be honorable
  As a player
  I will respect the rules

  Background:
    Given I am white in a game of size 3
      And it is my turn

  Scenario: Suicide
    Given the game looks like this :

"""
  |   |   |
-- ---█--- --
  |   |   |
--█--- ---█--
  |   |   |
--█---▒---█--
  |   |   |   |   |   |   |   |   |   |   |   |
--█---▒---▒---█--- --- --- --- --- --- --- --- --
  |   |   |   |   |   |   |   |   |   |   |   |
-- ---█---█--- --- --- --- --- --- --- --- --- --
  |   |   |   |   |   |   |   |   |   |   |   |
-- --- --- --- --- --- --- --- --- --- --- --- --
  |   |   |   |   |   |   |   |   |   |   |   |
-- --- --- --
  |   |   |
-- --- --- --
  |   |   |
-- --- --- --
  |   |   |
"""

    When I try to play at 0 3 0
    Then I the game should reject my move
     And it should still be my turn