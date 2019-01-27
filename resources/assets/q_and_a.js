function addQuestion(){
    newQuestionIndex = parseInt($("input[name='questions_count']").val());
    $("input[name='questions_count']").val(newQuestionIndex + 1);
    var reg1=/question_default_/g;
    var reg2=/question\[default\]/g;
    question_content ='<br><div class="question-box" id="question-box-'+newQuestionIndex+'">';
    question_content = question_content + $('#question-box-default').html().replace(reg1,'question_'+newQuestionIndex+'_');
    question_content = question_content.replace('class="question-index-value">default<\/span>','class="question-index-value">'+(newQuestionIndex+1)+'<\/span>');
    question_content = question_content.replace('onclick="deleteQustion(default)"','onclick="deleteQustion('+newQuestionIndex+')"');
    question_content = question_content.replace(reg2,'question['+newQuestionIndex+']');
    question_content = question_content + '<\/div>';
    $('#question-container').append(question_content);
}

function deleteQustion(id) {
    var message = '确定删除问题'+(id+1)+'?';
    if(confirm(message)){
        questionCount = parseInt($("input[name='questions_count']").val());
        $("input[name='questions_count']").val(questionCount - 1);

        $('#question-box-'+id).remove();

        container_content = $('#question-container').html();
        for ($i=id+1;$i<=questionCount-1;$i++){
            container_content = container_content.replace('question-box-'+$i,'question-box-'+($i-1));
            var reg1 =new RegExp("question_" + $i +"_" ,"g");
            container_content = container_content.replace(reg1,'question_'+($i-1)+'_');
            container_content = container_content.replace('class="question-index-value">'+($i+1)+'<\/span>','class="question-index-value">'+($i)+'<\/span>');
            container_content = container_content.replace('onclick="deleteQustion('+$i+')"','onclick="deleteQustion('+($i-1)+')"');
            var reg2 =new RegExp("question\\["+ $i +"\\]","g");
            container_content = container_content.replace(reg2,'question['+($i-1)+']');
        }

        $('#question-container').html(container_content);
    }

}