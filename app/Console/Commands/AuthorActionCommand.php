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
class AuthorActionCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "liteblog:author-action {action} {id?} {email?} {name?} {desc?}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "作者操作(create edit delete show)";


    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        switch ($this->argument('action')){
            case "create";
                $status = Author::create([
                    'email'=>$this->argument('email'),
                    'name'=>$this->argument('name'),
                    'desc'=>$this->argument('desc'),
                ]);
                if ($status){
                    $this->line("创建成功(ID:{$status->id})");
                }else{
                    $this->line('创建失败') ;
                }
                break;
            case 'edit';
                $author = Author::find($this->argument('id'));
                if ($author){
                    $author->update([
                        'email'=>$this->argument('email'),
                        'name'=>$this->argument('name'),
                        'desc'=>$this->argument('desc'),
                    ]);
                    $this->line('修改成功');
                }else{
                    $this->error('未找到该作者');
                }
                break;
            case 'show';
                if ($this->argument('id')){
                    $author = Author::find($this->argument('id'))->load('tokens');
                    if ($author){
                        $this->table(['ID','邮箱','社交方式','名称','介绍','头像','创建时间','更新时间','TOKEN'],[$author->toArray()]);
                    }else{
                        $this->error('未找到该作者');
                    }
                }else{
                    $this->table(['ID','邮箱','社交方式','名称','介绍','头像','创建时间','更新时间'],Author::all()->toArray());
                }
                break;
            case 'delete';
                $author = Author::find($this->argument('id'));
                if ($author){
                    $this->line("删除 ID:{$author->id} {$author->name}[{$author->email}]");
                    $author->delete();
                }else{
                    $this->error('未找到该作者');
                }
                break;
            default:
                $this->error('操作只支持create edit delete show');
        }

    }
}
