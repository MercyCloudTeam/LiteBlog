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
use Illuminate\Support\Str;


/**
 * Class deletePostsCommand
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */
class TokenActionCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "liteblog:token-action {action} {id?} {permissions?}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Token操作(create edit delete show) ";


    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        switch ($this->argument('action')) {
            case "create":
                $token = Str::random(64);
                $arr['token'] = $token;
                if (!empty($this->argument('id'))){
                    $author = Author::find($this->argument('id'));
                    if (!empty($author)){
                        $arr['author_id'] = $author->id;
                    }
                }
                $arr['permissions'] = $this->argument('permissions') ?? 'user';
                $status = Token::create($arr);
                if ($status){
                    $this->line($token);
                }else{
                    $this->line('创建失败');
                }
                break;

            case "show":
                if ($this->argument('id')) {
                    $token = Token::find($this->argument('id'));
                    $this->table(['ID','Token','作者','权限组','创建时间','更新时间'],[$token->toArray()]);
                    $author = $token->author->toArray();
                    $this->table(['ID','Token','作者','权限组','创建时间','更新时间'],[$author]);
                }else{
                    $this->table(['ID','Token','作者','权限组','创建时间','更新时间'],Token::all()->toArray());
                }
                break;

            default:
                $this->error('目前只支持show create delete操作');

        }

    }
}
