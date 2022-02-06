<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\BreakingBadCharacterApi;
use App\Models\Character;
use App\Models\CharacterOccupation;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Collection;

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

    /**
     * Collection of characters that will be inserted
     *
     * @var string
     */
    protected Collection $characters;

    /**
     *
     *
     *
     */
    protected $progress;

    /**
     *
     *
     *
     */
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
        $this->info('Collecting Characters From API');
        $this->characters = collect($this->api->characters());
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

    public function insertCharacter( $character ) {
        Character::create( $this->parseCharacter( $character ) );
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(  )
    {
        $this->resetdb();
        $this->collectCharacters();
        $this->info("Inserting Characters into database");

        $this->progress = $this->output->createProgressBar(count($this->characters));
        $this->progress->start();

        $this->characters->each(function( $character ){
            $this->insertCharacter( $character );
            //$this->info('character inserted');
            $this->progress->advance();
        });

        $this->progress->finish();

        $this->info("\nAll Characters Inserted");

        return 0;
    }
}
