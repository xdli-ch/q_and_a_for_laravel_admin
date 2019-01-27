<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQAUserTrainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q_a_user_trains', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('答题者的用户id');
            $table->integer('paper_id')->comment('试卷id');
            $table->integer('all_use_time')->default(0)->comment('总用时，以秒s为单位');
            $table->string('answers', 1000)->default('{}')->comment('问题回答json消息，里面有选项 question_id 和 选项值,格式：{"18":"a","20":"c","23":"a"}');
            $table->integer('questions_count')->default(0)->comment('该文章的问题总个数');
            $table->string('right_question_ids')->default('')->comment('回答正确的问题id,用;分割');
            $table->integer('right_count')->default(0)->comment('正确回答问题的个数');
            $table->string('error_question_ids')->default('')->comment('回答错误的问题id,用;分割');
            $table->integer('error_count')->default(0)->comment('回答错误的问题的个数');
            $table->decimal('right_ratio',8,2)->default(0)->comment('正确率');
            $table->timestamps();
            $table->comment = '用户答题记录表';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('q_a_user_trains');
    }
}
