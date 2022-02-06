<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\BreakingBadCharacterApi;
use App\Models\Character;
use App\Models\CharacterOccupation;
use Illuminate\Support\Facades\Artisan;

class InitCharacterDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'init:characters {--hide-extra-output=false: shows extra output to the user when running}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initliaze Character DB';

    protected $characters;

    protected $progressbar;

    protected $api;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct( BreakingBadCharacterApi $api )
    {
        parent::__construct();
        $this->api = $api;

    }

    public function resetdb(){
        Artisan::call('migrate:fresh');
        $this->info('Database Reset And Migrated');
    }

    public function collectCharacters(){
        $this->characters = collect($this->api->characters());
        return $this->characters;
    }

    public function parseCharacter($character) {
        return [
            'char_id' => $character['char_id'],
            'name' => $character['name'],
            'birthday' => ($character['birthday'] == 'Unknown') ? null : $character['birthday'],
            'img' => $character['img'],
            'status' => strtolower($character['status']),
            'occupations' => $character['occupation'],
            'nickname' => $character['nickname'],
            'portrayed' => $character['portrayed'],
            'category' => $character['category'],
            'better_call_saul_appearance' => $character['better_call_saul_appearance']
        ];
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(  )
    {

        $this->progressbar = $this->output->createProgressBar( $this->characters->count() );

        $this->info("Inserting Characters into database");
/*
        $this->characters->map(function( &$character ){
            $character = $this->parseCharacter( $character );
            $this->progressbar->advance();
            return Character::create($character);
        });
*/
        $this->progressbar->finish();

        $this->info("\nCommand Finished");

        return 0;
    }
}
