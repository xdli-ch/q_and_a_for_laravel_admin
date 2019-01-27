<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQAQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('q_a_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('paper_id')->comment('所属试卷id，');
            $table->string('title', 1000)->comment('题目');
            $table->string('title_md5',50);
            $table->tinyInteger('type')->default(1)->comment('问题类型，单选：1，多选：2');//必须保留该字段，因为当多选题中的正确答案只有1个的时候，我们并不能根据下面字段 'right_option_keys'的内容 推断出该题目到底是不是多选
            $table->string('options',1200)->comment('选项key和对应的value,json 字符串格式,例如：{"a":"xxxx1","b":"xxxx2","c":"xxxx3","d":"xxxx4"}');
            $table->string('right_option_keys',500)->comment('正确选项,如果多选的话用英文逗号分隔，例如 a,b,c');
            $table->timestamps();
            $table->comment = '试卷中的问题与选项表';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('q_a_questions');
    }
}
