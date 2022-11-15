<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\File;

class FilesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        File::create([
            'id'                => 1,
            'name'              => 'Demo.pdf',
            'file_path'         =>  '/Users/pavani/web/storage/app/public/PDF/261.pdf',
        
        ]);
    }
}