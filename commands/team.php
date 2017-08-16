<?php
// Get the team.
$gym_team = trim(strtolower(substr($update['message']['text'], 5)));

// Match team names.
$teams = array(
    'mystic'    => 'mystic',
    'instinct'  => 'instinct',
    'valor'     => 'valor',
    'red'       => 'valor',
    'blue'      => 'mystic',
    'yellow'    => 'instinct',
    'r'         => 'valor',
    'b'         => 'mystic',
    'y'         => 'instinct'
);

// Valid team name.
if ($teams[$gym_team]) {
    // Build Query.
    my_query(
        "
        UPDATE    raids
        SET       gym_team = '{$teams[$gym_team]}'
          WHERE   user_id = {$update['message']['from']['id']}
        ORDER BY id DESC LIMIT 1
        "
    );
    // Send the message.
    sendMessage($update['message']['chat']['id'], 'Gym team set to ' . ucfirst($teams[$gym_team]));

// Invalid team name.
} else {
    // Send the message.
    sendMessage($update['message']['chat']['id'], 'Invalid team name - type Mystic, Valor, Instinct or Blue, Red, Yellow');
}
