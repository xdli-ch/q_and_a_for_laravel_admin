<div class="content-box">
    <div class="box-header clearfix" style="margin-bottom: 40px;">
        <div class="top-nav">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="@if(!Session::has('question_active')) active  @endif">
                    <a href="#paper" aria-controls="paper" role="tab" data-toggle="tab" > &nbsp;&nbsp;&nbsp;试卷&nbsp;&nbsp;&nbsp; </a>
                </li>
                <li role="presentation" class="@if(Session::has('question_active')) active  @endif">
                    <a href="#question" aria-controls="question" role="tab" data-toggle="tab" > &nbsp;&nbsp;&nbsp;考题&nbsp;&nbsp;&nbsp; </a>
                </li>
            </ul>
        </div>
    </div>

    <form class="form-horizontal paper-form" role="form" action="{{ route('q_and_a.update', ['id'=> $paper->id]) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="boxbody">

            <div class="tab-content">

                {{--试卷--}}
                <div class="tab-pane fade @if(!Session::has('question_active') and !Session::has('question_error')) active in @endif" id="paper" role="tabpanel">
                    @if(Session::has('paper_active'))
                        <div class="alert alert-error fade  in">
                            <button type="button" class="close close-sm" data-dismiss="alert">
                                <i class="fa fa-times"></i>
                            </button>
                            表单验证不通过，请认真检查表单！
                        </div>
                    @endif

                    @if(Session::has('paper_error'))
                        <div class="alert alert-error fade  in">
                            <button type="button" class="close close-sm" data-dismiss="alert">
                                <i class="fa fa-times"></i>
                            </button>
                            {{Session::get('paper_error')}}
                        </div>
                    @endif

                    <div class="form-group row">
                        <label for="paper_title" class="col-sm-6 col-md-1 col-form-label text-md-right">标题</label>
                        <div class="col-sm-6 col-md-11">
                            <input id="paper_title" type="text" class="form-control{{ ($errors->has('paper_title') || $errors->has('title_md5'))  ? ' is-invalid' : '' }}" name="paper_title" value="{{ old('paper_title',$paper->title) }}" placeholder="请输入试卷标题">
                            @if ($errors->has('paper_title') || $errors->has('title_md5'))
                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('paper_title')?$errors->first('paper_title'):$errors->first('title_md5') }}</strong></span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="paper_introduce" class="col-sm-6 col-md-1 col-form-label text-md-right">备注</label>
                        <div class="col-sm-6 col-md-11">
                            <textarea id="paper_introduce" class="form-control{{ ($errors->has('paper_introduce')) ? ' is-invalid' : '' }}" name="paper_introduce" rows="2" placeholder="请输入试卷备注,内容不能超过500字">{{ old('paper_introduce',$paper->paper_introduce) }}</textarea>
                            @if ($errors->has('paper_introduce'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('paper_introduce')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-6 col-md-1 col-form-label text-md-right">上线状态</label>
                        <div class="col-sm-6 col-md-2">
                            @foreach($status as $saus_key => $saus_value)
                            <label><input name="status" class="" type="radio" @if(old('status',$paper->status) == $saus_key) checked @endif value="{{$saus_key}}" />&nbsp;{{$saus_value}}</label>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                            @endforeach
                            @if ($errors->has('status'))
                                <span class="invalid-feedback" style="display:block" role="alert">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    @if(count(config('q_and_a.type')) > 0)
                    <div class="form-group row">
                        <label for="paper_type" class="col-sm-6 col-md-1 col-form-label text-md-right">试卷类别</label>
                        <div class="col-sm-6 col-md-2">
                            <select id="paper_type" name="paper_type" class="form-control{{ $errors->has('paper_type') ? ' is-invalid' : '' }} selectpicker">
                                <option value="0">选择类别</option>
                                @foreach($paper_type as $key => $value)
                                    <option value="{{$key}}" @if(old('paper_type',$paper->type) == $key) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('paper_type'))
                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('paper_type') }}</strong>
                    </span>
                            @endif
                        </div>
                    </div>
                    @endif

                    @if(count(config('q_and_a.train_level')) > 0)
                    <div class="form-group row">
                        <label for="train_level" class="col-sm-6 col-md-1 col-form-label text-md-right">试卷等级</label>
                        <div class="col-sm-6 col-md-2">
                            <select id="train_level" name="train_level" class="form-control{{ $errors->has('train_level') ? ' is-invalid' : '' }} selectpicker">
                                <option value="0">选择级别</option>
                                @foreach($train_level as $key => $value)
                                    <option value="{{$key}}" @if(old('train_level',$paper->train_level) == $key) selected @endif>{{$value}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('train_level'))
                                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('train_level') }}</strong>
                        </span>
                            @endif
                        </div>
                    </div>
                    @endif

                    <div class="form-group row">
                        <label for="can_use_time" class="col-sm-6 col-md-1 col-form-label text-md-right">考试时长<span>(分钟)</span></label>
                        <div class="col-sm-6 col-md-2">
                            <input id="can_use_time" type="number" class="form-control{{ $errors->has('can_use_time') ? ' is-invalid' : '' }}" name="can_use_time" value="{{ old('can_use_time',$paper->can_use_time) }}" placeholder="请输入数值">
                            @if ($errors->has('can_use_time'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('can_use_time') }}</strong>
                                </span>
                            @endif
                            <span>注:0 表示没有时间限制</span>
                        </div>
                    </div>

                </div>

                {{--考题--}}
                <div class="tab-pane fade @if(Session::has('question_active') or Session::has('question_error')) active in @endif" id="question" role="tabpanel">
                    @if(Session::has('question_active'))
                        <div class="alert alert-error fade  in">
                            <button type="button" class="close close-sm" data-dismiss="alert">
                                <i class="fa fa-times"></i>
                            </button>
                            表单验证不通过，请认真检查表单！
                        </div>
                    @endif
                    @if(Session::has('question_error'))
                        <div class="alert alert-error fade  in">
                            <button type="button" class="close close-sm" data-dismiss="alert">
                                <i class="fa fa-times"></i>
                            </button>
                            {{Session::get('question_error')}}
                        </div>
                    @endif
                    {{--问题个数（隐藏）--}}
                    <input type="hidden" name="questions_count" value="{{old('questions_count',$questions_count)}}">
                    {{--问题内容--}}
                    @if(0)
                        {{old('questions_count',$questions_count)}}
                        {{var_dump($paper->toArray())}}
                        {{var_dump($errors->all())}}
                        {{var_dump(old())}}
                    @else
                    <div id="question-container">
                        @for( $i = 0 ; $i <= old('questions_count',$questions_count)-1 ;$i++)
                            <div class="question-box" id="question-box-{{$i}}">
                                <div class="question-index">
                                    <p class="" style="float: left;margin:9px 0 9px 10px;"><i class="fa fa-square" aria-hidden="true" style="font-size: 14px;color: #3c8dbc;"></i> 问题<span class="question-index-value">{{$i+1}}</span>:</p>
                                    <p class="" style="float: right;margin: 7px 10px 7px 0;"><a onclick="deleteQustion({{$i}})" class="text-right delete-btn">删除</a></p>
                                    <p class="clearfix"></p>
                                </div>

                                <div class="form-group row">
                                    <label for="question_{{$i}}_title" class="col-sm-6 col-md-1 col-form-label text-md-right">题目</label>
                                    <div class="col-sm-6 col-md-11">
                                        <input id="question_{{$i}}_title" name="question[{{$i}}][title]" type="text" class="form-control{{ $errors->has('question.'.$i.'.title') ? ' is-invalid' : '' }}" value="{{ old('question.'.$i.'.title',$paper->questions[$i]->title??'') }}" placeholder="请输入题目内容">
                                        @if ($errors->has('question.'.$i.'.title'))
                                            <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('question.'.$i.'.title') }}</strong></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="question_{{$i}}_right_options" class="col-sm-6 col-md-1 col-form-label text-md-right">正确答案</label>
                                    <div class="col-sm-6 col-md-11">
                                        @foreach($question_options as $q_option)
                                            <label style="line-height: 36px; margin-bottom: 0;"><input id="question_{{$i}}_right_options"  name="question[{{$i}}][right_options]" class="" type="radio" @if(old('question.'.$i.'.right_options',$paper->questions[$i]->right_option_keys??'') == $q_option) checked @endif value="{{$q_option}}" />&nbsp;&nbsp;{{strtoupper($q_option)}}&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                        @endforeach
                                        @if ($errors->has('question.'.$i.'.right_options'))
                                            <span class="invalid-feedback" style="display: block;" role="alert"><strong>{{ $errors->first('question.'.$i.'.right_options') }}</strong></span>
                                        @endif
                                    </div>
                                </div>

                                @foreach($question_options as $q_option)
                                    <div class="form-group row">
                                        <label for="question_{{$i}}_option_{{$q_option}}" class="col-sm-6 col-md-1 col-form-label text-md-right">选项{{strtoupper($q_option)}}</label>
                                        <div class="col-sm-6 col-md-11">
                                            <input id="question_{{$i}}_option_{{$q_option}}" name="question[{{$i}}][option][{{$q_option}}]" type="text" class="form-control{{ $errors->has('question.'.$i.'.option.'.$q_option) ? ' is-invalid' : '' }}" value="{{ old('question.'.$i.'.option.'.$q_option,$paper->questions[$i]->options[$q_option]??'') }}" placeholder="请输入选项内容">
                                            @if ($errors->has('question.'.$i.'.option.'.$q_option))
                                                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('question.'.$i.'.option.'.$q_option) }}</strong></span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endfor
                    </div>
                    @endif

                    <div style="text-align: center;margin-top: 20px;color: #fff;font-weight: unset">
                        <a class="btn btn-primary" onclick="addQuestion()"> 添加问题 + </a>
                    </div>
                </div>
            </div>

        </div>

        <div class="boxfooter">
            <a href="{{ route('q_and_a.index') }}" class="btn btn-default">取消</a>
            <button type="submit" class="btn btn-primary pull-right">确定</button>
        </div>

    </form>

    <div style="display: none;">
        <div class="question-box" id="question-box-default">
            <div class="question-index">
                <p class="" style="float: left;margin:9px 0 9px 10px;"><i class="fa fa-square" aria-hidden="true" style="font-size: 14px;color: #3c8dbc;"></i> 问题<span class="question-index-value">default</span>:</p>
                <p class="delete-qustion" style="float: right;margin: 7px 10px 7px 0;"><a onclick="deleteQustion(default)" class="text-right delete-btn">删除</a></p>
                <p class="clearfix"></p>
            </div>

            <div class="form-group row">
                <label for="question_default_title" class="col-sm-6 col-md-1 col-form-label text-md-right">题目</label>
                <div class="col-sm-6 col-md-11">
                    <input id="question_default_title" name="question[default][title]" type="text" class="form-control" value="" placeholder="请输入题目内容">
                </div>
            </div>
            <div class="form-group row">
                <label for="question_default_right_options" class="col-sm-6 col-md-1 col-form-label text-md-right">正确答案</label>
                <div class="col-sm-6 col-md-11">
                    @foreach($question_options as $q_option)
                        <label style="line-height: 36px; margin-bottom: 0;"><input id="question_default_right_options"  name="question[default][right_options]" class="" type="radio" value="{{$q_option}}" >&nbsp;&nbsp;{{strtoupper($q_option)}}&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                    @endforeach
                </div>
            </div>

            @foreach($question_options as $q_option)
                <div class="form-group row">
                    <label for="question_default_option_{{$q_option}}" class="col-sm-6 col-md-1 col-form-label text-md-right">选项{{strtoupper($q_option)}}</label>
                    <div class="col-sm-6 col-md-11">
                        <input id="question_default_option_{{$q_option}}" name="question[default][option][{{$q_option}}]" type="text" class="form-control" value="" placeholder="请输入选项内容">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script src="{{asset('vendor/q_and_a/q_and_a.js')}}"></script>
<link href="{{asset('vendor/q_and_a/q_and_a.css')}}" rel="stylesheet">