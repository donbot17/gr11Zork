<?php

require('conn.php');


$scenes = array(
    '00' => "Court Yard + Buggy, ride buggy?",
    '10' => "Court Yard Enterance",
    '20' => "Court Yard",
    '30' => "Green House",
    '01' => "Hallway E",
    '11' => "Medbay, there is a medkit here",
    '21' => "Hallway G",
    '31' => "Hanger, there is a spacesuit here",
    '41' => "Rocket",
    '02' => "Generator",
    '12' => ["Control Room, there is a key here",1,1,0],
    '22' => "Weapons, there is a blaster here",
    '42' => "Pathway",
    '03' => "Cafeteria",
    '13' => "Lounge",
    '23' => "Hallway O",
    '33' => "Barracks, there is a pager and map here",
    '43' => "Observatory, it seems to be locked",
    '99' => 'You are on board a space out-post with 5 other crew, who youve lived with for 2 years, you are a mechanic. <br> This space out-post has been used to study alien life forms and collect samples to send back to earth. <br> This extensive base feels big for just five crew, and sometimes, you feel as though when you stare out into the stars, <br> something stares back...'
);

echo mysqli_real_escape_string($conn, json_encode($scenes));