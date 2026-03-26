<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use function Laravel\Prompts\{text, password, info};

class MakeUserCommand extends Command
{
    protected $signature = 'make:user';

    protected $description = 'Crea un nuovo utente';

    public function handle(): void
    {
        $name = text(
            label: "Qual'è il tuo nome?",
            placeholder: 'Mario Rossi',
            required: true,
            hint: 'Verrà visualizzato sul tuo profilo.',
        );

        $email = text(
            label: 'Qual è la tua email?',
            placeholder: 'mario.rossi@example.com',
            required: true,
            hint: 'Verrà utilizzata per il login.',
        );

        $password = password(
            label: 'Inserisci una password',
            required: true,
        );

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);

        info('Utente creato con successo!');
    }
}
