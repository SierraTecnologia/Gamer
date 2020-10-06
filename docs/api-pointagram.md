Api header

All calls to our Api endpoint must contain a header that identifies the caller. The header should contain the following attributes:

api_key: Your key.

Content-Type: application/json.

api_user: Your Pointagram login (email-address).
 
Test Endpoint

This is just a test endpoint. Use it to try out your credentials.

# End point address: https://app.pointagram.com/server/externalapi.php/test

Verb: POST

Body: [None]
test_call_api	
Endpoints for managing players
Create Player

This endpoint is used to create new players in Pointagram. If player allready exists the endpoint will return a Http conflict error. A call needs to at least contain a player name.

# End point address: https://app.pointagram.com/server/externalapi.php/create_player

Verb: POST

JSON Body example:

{
“player_name”: “Axl Rose”,
“player_email”: “axl@pointagram.com”,
“player_external_id”: “121212”,
“offline”: “1”
}

Attributes

Player_name: The name of the player in Pointagram

Player_email: The email address of the player. Used for sending invitation.

Player_external_id: Optional id you can provide as an unique identifier for the player.

offline: Set 1 for offline or 0 for online player. An online player will receive an invitation to log on to Pointagram. Note, you can create players as offline players and convert them later in Pointagram.
List Players

This endpoint fetches players in Pointagram.

# End point address: https://app.pointagram.com/server/externalapi.php/list_players

Verb: GET

Attributes

search_by: Email, Name or External Id

filter: Search value.

JSON Result:

[
{
“id”: “18667”,
“Name”: “Johnny”,
“emailaddress”: “johnny@example.com”,
“external_id”: “ff:3168822”
},
{
“id”: “18831”,
“Name”: “Peter”,
“emailaddress”: “peter@example.com”,
“external_id”: “peter@example.com”
}
]
Remove Player 

This endpoint is used to remove players. Players will be soft deleted. In order to completely remove and anonymize the players you have to look up the deleted players in Pointagram and anonymize them. 

If player isn’t found the endpoint responds with http ok and an error message. 

Admin users can’t be removed, calls to remove admin users are ignored, 

# End point address: https://app.pointagram.com/server/externalapi.php/remove_player 

Verb: POST 

JSON Body example: 

{ 
“player_name”: “Axl Rose”, 
“player_email”: “axl@pointagram.com”, 
“player_external_id”: “121212”  
} 

Attributes 

These attributes are only used to identify the player to be removed. 

Player_name: The name of the player in Pointagram.  

Player_email: The email address of the player. Used for sending invitation. 

Player_external_id: Optional id you can provide as an unique identifier for the player. 
List Teams

This endpoint fetches teams in Pointagram.

# End point address: https://app.pointagram.com/server/externalapi.php/list_teams

Verb: GET

JSON Result:
[
{
                   “id”: “80”,
                   “name”: “Red Eyed Bear”,
                   “icon”: “Bears.png”
          },
          {
                   “id”: “84”,
                   “name”: “Mighty Sharks”,
                   “icon”: “Sharks.png”
          }
]
Add player to team

This endpoint is used to add players to a team in Pointagram.

# End point address: https://app.pointagram.com/server/externalapi.php/add_to_team

Verb: POST

JSON Body example:

{
“player_id”: “121212”,
“teamid”: “1”
}

Attributes

player_id: Players id.

team_id: The team id.

player_external_id: You can pass external id instead of player_id.

player_email: You can pass players email instead of player_id.
Remove player from team

This endpoint is used to remove a player from a team in Pointagram.

# End point address: https://app.pointagram.com/server/externalapi.php/remove_from_team

Verb: DELETE

JSON Body example:

{
“player_id”: “121212”,
“teamid”: “1”
}

Attributes

player_id: Players id.

teamiid: The team id.

player_external_id: You can pass external id instead of player_id.

player_email: You can pass players email instead of player_id.
Endpoints for adding points

This endpoint is used to add points to Pointagram. A call needs to at least contain information on:

    Who scored.
    What Score Series.
    How many points.

# End point address: https://app.pointagram.com/server/externalapi.php/add_score

Verb: POST

Json body example:

{ “player_external_id”: “121212”, “points”: 120, “scoreseries_name”: “Points”}

Attributes

Player attributes, supply at least one:

player_id:

player_name:

player_email:

player_external_id:

Score attributes:

scoreseries_name: Name of the score series to add points to.

scoreseries_id: Id of the score series to add points to. Use either this attribute or scoreseries_name.

points: Number of points to add to the Score Series.

point_type_name: Name of the point type to set. Use either this or the points attribute.

source_score_id: Optional field that identifies this transaction. If you call again using a matching score_source_id it will revoke (delete) the old transaction and add a new one.

comment: Optional field that describes this score. Will be visible in the news feed.

score_time: Optional field that sets the date and time of the transaction.

tags: Optional field where you can add tags to be displayed along with the scored point. The tag attribute must be in an array like this: “tags”: [{“name”:”North”},{“name”:”Services”}].

create_player: Players will be created automatically if they are missing in Pointagram if you set this attribute to 1.
Endpoint for competitions
List Competitions

This endpoint fetches competitions in Pointagram.

# End point address: https://app.pointagram.com/server/externalapi.php/list_competitions

Verb: GET

Attributes

search_by: Email, Name or External Id

filter: Search value. Lists only competitions for the given player.

competition_id: List only competitions for the given competition id.

accesskey: List only competitions for the given access id.
List Competition Players

This endpoint fetches competitions in Pointagram.

# End point address: https://app.pointagram.com/server/externalapi.php/list_competition_players

Verb: GET
Endpoint for score series
Score Series
This endpoint fetches score series in Pointagram.

# End point address: https://app.pointagram.com/server/externalapi.php/list_score_series

Verb: GET

List score series point types

This endpoint fetches point types for a specific score series in Pointagram.

# End point address: https://app.pointagram.com/server/externalapi.php/list_score_series_point_types

Verb: GET

Attributes

Scoreseries: Id of the score series to fetch Point Types for.
