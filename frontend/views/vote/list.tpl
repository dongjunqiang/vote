<{set title="<{$data.name}>"}>
<style>
    table td,table th{
        text-align:center;
    }
    td li{
        text-align: left;
        border-bottom: 2px solid #bce8f1;
    }
    textarea{
        width:100%; height: 200px;
    }
</style>
    <h2 align="center"><{$data.name}></h2>
    <table class="table">
        <tr>
            <th>排名</th>
            <th>地点</th>
            <th>人气</th>
            <th>操作</th>
        </tr>
        <{foreach $data.voteOption as $k => $option}>
        <tr>
            <td><{$k+1}></td>
            <td><{$option.name}></td>
            <td>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <{$option.count}>%;">
                    </div>
                    <{$option.count}>票
                </div>
            </td>
            <td>
                <button class="btn btn-primary prise" data-voteid="<{$option.id}>">赞</button>
                <button type="button" class="btn btn-default showmore" data-type="0">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </button>
            </td>
        </tr>
        
        <{/foreach}>
    </table>
    <!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
          <{use class='yii\widgets\ActiveForm' type='block'}>
          <{ActiveForm assign='form' id='voteLog' action="<{url route='vote/vote'}>"}>
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">说说你的看法呗</h4>
              </div>
              <div class="modal-body">

                    <div class="form-group">
                        <label for="">快速选择栏：</label>
                        <select id="quickSelect">
                            <option>我要自己填写</option>
                            <option>就选这里，没理由</option>
                            <option>这里很好，很喜欢</option>
                        </select>
                    </div>
                    <textarea name="voteLog[message]" id="content"></textarea>
                    <input type="hidden" name="voteLog[option_id]" value="" id="voteid">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="submit" class="btn btn-primary submit">提交</button>
              </div>
          <{/ActiveForm}>
	    </div>
	  </div>
	</div>
	<script type="text/html" id="log">
		<tr class="showlog">
            <td colspan="4">
                <div class="alert alert-info" role="alert">
                    <table class="table">
                    {{each list as value i}}
                        <tr>
                            <td>{{i+1}}</td>
                            <td>{{value.username}}</td>
                            <td>{{value.message}}</td>
                            <td>{{value.add_time}}</td>
                        </tr>
                    {{/each}}
                    </table>
                </div>
            </td>
        </tr>
	</script>
<{registerJsFile url='/js/sea.js' position='POS_END'}>
<{registerJs key='show' position='POS_LOAD'}>
    seajs.use('app/vote');
<{/registerJs}>