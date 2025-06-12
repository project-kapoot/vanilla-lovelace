<?php

namespace App\Controller;

use App\Entity\User;

class QuizController 
{
    public function question(): array
    {
        return ['question.php', [
            'role' => 'player',
        ]];
    }

    public function waiting(): array
    {
        $user = new User(['player']);

        return ['waiting_room.php', [
            'user' => $user,
        ]];
    }

    public function score(): array
    {
        return ['score.php'];
    }

    public function presenter(): array
    {
        return ['presentateur.php'];
    }
}