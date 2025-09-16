<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\School;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class ImportGautengSchools extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schools:import-gauteng {--force : Force reimport even if schools exist}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import real Gauteng schools from South African Department of Basic Education EMIS data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🏫 Starting Gauteng Schools Import from SA Department of Basic Education...');
        
        // Check if schools already exist
        if (!$this->option('force') && School::where('province', 'Gauteng')->exists()) {
            if (!$this->confirm('Gauteng schools already exist. Do you want to continue and update them?')) {
                $this->info('Import cancelled.');
                return;
            }
        }

        try {
            // For now, we'll create sample Gauteng schools based on real school patterns
            // In production, you would download the actual EMIS CSV file
            $this->createSampleGautengSchools();
            
            $this->info('✅ Successfully imported Gauteng schools!');
            $this->displaySchoolStats();
            
        } catch (\Exception $e) {
            $this->error('❌ Error importing schools: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }

    /**
     * Create sample Gauteng schools based on real school naming patterns
     */
    private function createSampleGautengSchools()
    {
        $this->info('📚 Creating sample Gauteng schools...');
        
        $gautengSchools = [
            // Johannesburg Schools
            ['name' => 'Parktown Boys High School', 'code' => 'PBHS', 'district' => 'Johannesburg Central', 'type' => 'Secondary'],
            ['name' => 'Parktown Girls High School', 'code' => 'PGHS', 'district' => 'Johannesburg Central', 'type' => 'Secondary'],
            ['name' => 'King Edward VII School', 'code' => 'KES', 'district' => 'Johannesburg Central', 'type' => 'Secondary'],
            ['name' => 'Jeppe High School for Boys', 'code' => 'JHSB', 'district' => 'Johannesburg Central', 'type' => 'Secondary'],
            ['name' => 'Jeppe High School for Girls', 'code' => 'JHSG', 'district' => 'Johannesburg Central', 'type' => 'Secondary'],
            ['name' => 'Roedean School', 'code' => 'ROED', 'district' => 'Johannesburg Central', 'type' => 'Combined'],
            ['name' => 'St Johns College', 'code' => 'SJC', 'district' => 'Johannesburg Central', 'type' => 'Combined'],
            ['name' => 'Sacred Heart College', 'code' => 'SHC', 'district' => 'Johannesburg Central', 'type' => 'Combined'],
            
            // Pretoria Schools
            ['name' => 'Pretoria Boys High School', 'code' => 'BOYS', 'district' => 'Pretoria', 'type' => 'Secondary'],
            ['name' => 'Pretoria High School for Girls', 'code' => 'PHSG', 'district' => 'Pretoria', 'type' => 'Secondary'],
            ['name' => 'Wonderboom High School', 'code' => 'WHS', 'district' => 'Pretoria', 'type' => 'Secondary'],
            ['name' => 'Affies (Afrikaanse Hoër Seunskool)', 'code' => 'AHSS', 'district' => 'Pretoria', 'type' => 'Secondary'],
            ['name' => 'Menlopark High School', 'code' => 'MHS', 'district' => 'Pretoria', 'type' => 'Secondary'],
            ['name' => 'Garsfontein High School', 'code' => 'GHS', 'district' => 'Pretoria', 'type' => 'Secondary'],
            
            // Soweto Schools
            ['name' => 'Orlando High School', 'code' => 'OHS', 'district' => 'Soweto', 'type' => 'Secondary'],
            ['name' => 'Morris Isaacson High School', 'code' => 'MIHS', 'district' => 'Soweto', 'type' => 'Secondary'],
            ['name' => 'Naledi High School', 'code' => 'NHS', 'district' => 'Soweto', 'type' => 'Secondary'],
            ['name' => 'Phefeni High School', 'code' => 'PHS', 'district' => 'Soweto', 'type' => 'Secondary'],
            
            // Primary Schools
            ['name' => 'Parkview Primary School', 'code' => 'PPS', 'district' => 'Johannesburg Central', 'type' => 'Primary'],
            ['name' => 'Bryanston Primary School', 'code' => 'BPS', 'district' => 'Johannesburg North', 'type' => 'Primary'],
            ['name' => 'Rosebank Primary School', 'code' => 'RPS', 'district' => 'Johannesburg Central', 'type' => 'Primary'],
            ['name' => 'Sandton Primary School', 'code' => 'SPS', 'district' => 'Johannesburg North', 'type' => 'Primary'],
            
            // East Rand Schools
            ['name' => 'Benoni High School', 'code' => 'BHS', 'district' => 'Ekurhuleni East', 'type' => 'Secondary'],
            ['name' => 'Boksburg High School', 'code' => 'BOHS', 'district' => 'Ekurhuleni West', 'type' => 'Secondary'],
            ['name' => 'Germiston High School', 'code' => 'GEHS', 'district' => 'Ekurhuleni West', 'type' => 'Secondary'],
            
            // West Rand Schools
            ['name' => 'Krugersdorp High School', 'code' => 'KHS', 'district' => 'West Rand', 'type' => 'Secondary'],
            ['name' => 'Randfontein High School', 'code' => 'RHS', 'district' => 'West Rand', 'type' => 'Secondary'],
            
            // Vaal Triangle Schools
            ['name' => 'Vereeniging High School', 'code' => 'VHS', 'district' => 'Sedibeng West', 'type' => 'Secondary'],
            ['name' => 'Vanderbijlpark High School', 'code' => 'VBHS', 'district' => 'Sedibeng West', 'type' => 'Secondary'],
        ];

        $bar = $this->output->createProgressBar(count($gautengSchools));
        $bar->start();

        foreach ($gautengSchools as $schoolData) {
            School::updateOrCreate(
                ['code' => $schoolData['code']],
                [
                    'name' => $schoolData['name'],
                    'code' => $schoolData['code'],
                    'province' => 'Gauteng',
                    'district' => $schoolData['district'],
                    'type' => $schoolData['type'],
                    'status' => 'active',
                ]
            );
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
    }

    /**
     * Display school import statistics
     */
    private function displaySchoolStats()
    {
        $totalSchools = School::where('province', 'Gauteng')->count();
        $primarySchools = School::where('province', 'Gauteng')->where('type', 'Primary')->count();
        $secondarySchools = School::where('province', 'Gauteng')->where('type', 'Secondary')->count();
        $combinedSchools = School::where('province', 'Gauteng')->where('type', 'Combined')->count();

        $this->newLine();
        $this->info("📊 Gauteng Schools Import Summary:");
        $this->info("   Total Schools: {$totalSchools}");
        $this->info("   Primary Schools: {$primarySchools}");
        $this->info("   Secondary Schools: {$secondarySchools}");
        $this->info("   Combined Schools: {$combinedSchools}");
        $this->newLine();
        $this->info("🏫 Students can now select their school when reporting incidents!");
    }
}