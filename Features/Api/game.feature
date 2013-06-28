
@skip
# WIP --

Feature: API - Playing a Game
  In order to play a game
  As a client
  I have access to a RESTful API

  Background:
    Given I am logged in
    And there is a game of size 3 with id 1
    And I represent the black player in this game

  Scenario: Play

    # black/play/030 => POST vars ?!7
    # moreover, i think we should not write the route here
    When I POST /game/1/move/black/play/030
    Then the game #1 should look like this :

    """
  |   |   |
-- --- --- --
  |   |   |
-- ---█--- --
  |   |   |
-- --- --- --
  |   |   |   |   |   |   |   |   |   |   |   |
-- --- --- --- --- --- --- --- --- --- --- --- --
  |   |   |   |   |   |   |   |   |   |   |   |
-- --- --- --- --- --- --- --- --- --- --- --- --
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
