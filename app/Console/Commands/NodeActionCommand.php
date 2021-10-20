<?php
/**
 *
 * PHP version >= 7.0
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */

namespace App\Console\Commands;


use App\Models\Author;
use App\Models\Token;
use Exception;
use Illuminate\Console\Command;



/**
 * Class deletePostsCommand
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */
class NodeActionCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "liteblog:register-node {action} {node?} {token?}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "节点系统(register show)";


    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        switch ($this->argument('action')){
            case "register";

            case 'show';

            default:
                $this->error('操作只支持create edit delete show');
        }

    }
}
