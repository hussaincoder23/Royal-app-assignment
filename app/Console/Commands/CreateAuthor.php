<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class CreateAuthor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-author';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Will add author from command ...';

    /**
     * Execute the console command.
     */
    
    public function handle()
    {
        // Prompt user for author details
        $firstName = $this->ask('Enter first name');
        $lastName = $this->ask('Enter last name');
        $birthday = $this->ask('Enter birthday (YYYY-MM-DD)');
        $biography = $this->ask('Enter biography');
        $gender = $this->ask('Enter gender');
        $placeOfBirth = $this->ask('Enter place of birth');

        // Validate birthday format
        if (!\Carbon\Carbon::createFromFormat('Y-m-d', $birthday)) {
            $this->error('Invalid birthday format. Please use YYYY-MM-DD.');
            return;
        }
        
        $loginapi_response = Http::post('https://candidate-testing.com/api/v2/token',['email'=>config('app.admin_email'),'password'=>config('app.admin_password')]);

        session(['token'=>$loginapi_response['token_key']]);

         $api_response =  Http::withHeaders([
            'Authorization' => 'Bearer '.$loginapi_response['token_key'],
        ])->post('https://candidate-testing.com/api/v2/authors',[
            'first_name' => $firstName,
            'last_name' => $lastName,
            'birthday' => $birthday,
            'biography' => $biography,
            'gender' => $gender,
            'place_of_birth' => $placeOfBirth,
        ]);


        $this->info("Author {$firstName} created successfully.");
    }
}


