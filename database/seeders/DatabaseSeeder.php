<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mv;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Admin User if not exists
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'firstname' => 'Admin',
                'lastname' => 'User',
                'email' => 'admin@example.com',
                'phoneNumber' => '0612345678',
                'password' => bcrypt('password123'),
            ]);
        }

        // Seed realistic Fonctionnaires
        $firstnames = ['Amine', 'Sarah', 'Youssef', 'Layla', 'Mehdi', 'Sofia', 'Omar', 'Nour', 'Hamza', 'Rania', 'Khadija', 'Tariq', 'Meryem', 'Anass', 'Zineb'];
        $lastnames = ['El Amrani', 'Benjelloun', 'Alami', 'Tazi', 'Naji', 'Chraibi', 'Idrissi', 'Saber', 'Mansouri', 'Kabbaj', 'Rami', 'Bennani', 'Filali', 'Sadiki', 'El Fassi'];
        
        for ($i = 0; $i < 25; $i++) {
            $fn = $firstnames[array_rand($firstnames)];
            $ln = $lastnames[array_rand($lastnames)];
            $email = strtolower($fn . '.' . $ln . rand(1, 99) . '@poste.ma');
            
            // Check uniqueness
            if (!User::where('email', $email)->exists()) {
                User::create([
                    'firstname' => $fn,
                    'lastname' => $ln,
                    'email' => $email,
                    'phoneNumber' => '06' . rand(10000000, 99999999),
                    'password' => bcrypt('password123'),
                ]);
            }
        }

        // Seed realistic MVs
        $vmNames = [
            'web-server-prod', 'database-master', 'mail-gateway', 'backup-node-01', 
            'ldap-directory', 'staging-app-01', 'monitoring-agent', 'jenkins-ci-cd', 
            'cache-redis', 'dns-primary', 'load-balancer-nginx', 'gitlab-server', 
            'docker-registry', 'analytics-db', 'vpn-gateway', 'log-stash-01',
            'api-gateway-prod', 'kubernetes-worker-1', 'kubernetes-worker-2', 'elasticsearch-cluster'
        ];
        
        foreach ($vmNames as $name) {
            Mv::create([
                'name' => $name,
                'ipadress' => '192.168.10.' . rand(10, 254),
                'statut' => (rand(0, 4) > 0) ? 'Active' : 'Inactive', // 80% active
            ]);
        }
    }
}
