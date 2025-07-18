<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ChangeUserRoleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:role {email} {role}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change user role (admin/user)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $role = $this->argument('role');

        // Validate role
        if (!in_array($role, ['admin', 'user'])) {
            $this->error('Role must be either "admin" or "user"');
            return 1;
        }

        // Find user
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("User with email {$email} not found!");
            return 1;
        }

        // Update role
        $user->update(['role' => $role]);

        $this->info("User role updated successfully!");
        $this->info("User: {$user->name} ({$email})");
        $this->info("New role: {$role}");

        return 0;
    }
}
