<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ListUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:list {--role= : Filter by role (admin/user)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $role = $this->option('role');
        
        $query = User::query();
        
        if ($role) {
            if (!in_array($role, ['admin', 'user'])) {
                $this->error('Role must be either "admin" or "user"');
                return 1;
            }
            $query->where('role', $role);
        }
        
        $users = $query->get(['id', 'name', 'email', 'role', 'created_at']);
        
        if ($users->isEmpty()) {
            $this->info('No users found.');
            return 0;
        }
        
        $headers = ['ID', 'Name', 'Email', 'Role', 'Created At'];
        $rows = $users->map(function ($user) {
            return [
                $user->id,
                $user->name,
                $user->email,
                $user->role,
                $user->created_at->format('Y-m-d H:i:s')
            ];
        });
        
        $this->table($headers, $rows);
        
        return 0;
    }
}
