<?php

namespace App\Console\Commands;

use App\Modules\User\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';


    public function handle()
    {
        User::create([
            'name' => 'Admin',
            'email' => $this->argument('email'),
            'password' => Hash::make($this->argument('password')),
        ]);
        $this->info('User -> ' . $this->argument('email') . ' created');

        return true;
    }
}
