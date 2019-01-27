<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQAPapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q_a_papers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 1000)->comment('试卷标题');
            $table->string('title_md5',50)->unique();
            $table->text('introduce')->comment('试卷简介')->nullable();
            $table->integer('can_use_time')->default(0)->comment('考试规定可用时长，以分钟为单位，0:无时间限定');
            $table->integer('questions_count')->default(0)->comment('相关问题数量');
            $table->tinyInteger('type')->default(0)->comment('试卷类别，1: 语文，2：英语，3：历史');
            $table->tinyInteger('train_level')->default(0)->comment('难度级别，1: 一级，2：二级 ... 以此类推到 10：十级');
            $table->tinyInteger('status')->default(-1)->comment('上线状态，-1: 未上线，1：在线');
            $table->integer('creater_id')->default(0)->comment('试卷创建者，关联admin表中的 id');
            $table->integer('updater_id')->default(0)->comment('试卷修改者，关联admin表中的 id');
            $table->timestamps();
            $table->comment = '试卷(分类)表';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('q_a_papers');
    }
}
