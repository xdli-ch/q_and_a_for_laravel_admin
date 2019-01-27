<?php

namespace Xdli\Q_And_A\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'q_and_a:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the q_and_a package';

    /**
     * The views that need to be exported.
     *
     * @var array
     */

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->initAdmin();

        $this->initApi();

        $this->initDatabase();

        $this->info('Authentication scaffolding generated successfully.');
    }

    /**
     * init Admin for q_and_a
     *
     * @return void
     */
    public function initAdmin()
    {
        $dir = app_path('Admin/Controllers/Q_And_A');
        if(!is_dir($dir))
        {
            echo "目录 ".$dir." 不存在,进行创建".PHP_EOL;
            if(mkdir($dir,0777,true)){
                echo "目录 ".$dir." 创建成功".PHP_EOL;
            }else{
                echo "目录 ".$dir." 创建失败".PHP_EOL;
            }
        }

        file_put_contents(
            $dir.'/Box.php',
            file_get_contents(__DIR__.'/stubs/Http/Controllers/Box.stub')
        );

        file_put_contents(
            $dir.'/Q_And_AController.php',
            file_get_contents(__DIR__.'/stubs/Http/Controllers/Q_And_AController.stub')
        );

        file_put_contents(
            $dir.'/TongJiController.php',
            file_get_contents(__DIR__.'/stubs/Http/Controllers/TongJiController.stub')
        );
    }

    /**
     * init Api for q_and_a
     *
     * @return void
     */
    public function initApi()
    {
        $dir = app_path('Http/Controllers/Api/Q_And_A');
        if(!is_dir($dir))
        {
            echo "目录 ".$dir." 不存在,进行创建".PHP_EOL;
            if(mkdir($dir,0777,true)){
                echo "目录 ".$dir." 创建成功".PHP_EOL;
            }else{
                echo "目录 ".$dir." 创建失败".PHP_EOL;
            }
        }

        file_put_contents(
            $dir.'/Train.php',
            file_get_contents(__DIR__.'/stubs/Http/Controllers/Api/Train.stub')
        );

        file_put_contents(
            base_path('routes/api.php'),
            file_get_contents(__DIR__.'/stubs/routes/api.stub'),
            FILE_APPEND
        );
    }

    /**
     * Create tables and seed it.
     *
     * @return void
     */
    public function initDatabase()
    {
        $dir = app_path('Models/Q_And_A');
        if(!is_dir($dir))
        {
            echo "目录 ".$dir." 不存在,进行创建".PHP_EOL;
            if(mkdir($dir,0777,true)){
                echo "目录 ".$dir." 创建成功".PHP_EOL;
            }else{
                echo "目录 ".$dir." 创建失败".PHP_EOL;
            }
        }

        file_put_contents(
            $dir.'/Paper.php',
            file_get_contents(__DIR__.'/stubs/Models/Paper.stub')
        );

        file_put_contents(
            $dir.'/Question.php',
            file_get_contents(__DIR__.'/stubs/Models/Question.stub')
        );

        file_put_contents(
            $dir.'/UserTrain.php',
            file_get_contents(__DIR__.'/stubs/Models/UserTrain.stub')
        );
    }

}
