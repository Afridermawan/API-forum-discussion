Feature: list treads

@mink:selenium2
    Scenario: json list of tread
        When I GET url "/api/tread/list"
        Then I get response code "200"
        And I have multiple json response that contain key "id, id_parent"

    Scenario: json get treads by parent id
        When I GET url "api/tread/list/parent/0"
        Then I get response code "200"
        And I have multiple json response that contain key "id, id_parent"
