<style>
</style>

<div class="panel">
    <div class="panel-heading">
        Edit "{$page->meta_description}"
    </div>
    <form id="page" class="form-horizontal" method="POST" action="{$update_url}">
        <div class="form-group">
            <label for="title" class="col-lg-3 control-label">
                {l s='Title' mod='barecms'}
            </label>
            <div class="col-lg-9">
                <input class="form-control" type="text" id="title" name="title" value="{$page->meta_description}">
            </div>
        </div>
        <div class="form-group">
            <label for="description" class="col-lg-3 control-label">
                {l s='Description' mod='barecms'}
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" type="text" id="description" name="description" value="{$page->meta_description}">
            </div>
        </div>

        <div class="form-group">
            <label for="code" class="col-lg-3 control-label">
                {l s='CODE' mod='barecms'}
            </label>
            <div class="col-lg-9">
                <textarea class="form-control" type="text" id="code" name="code">{$page->content}</textarea>
            </div>
        </div>

        <div class="panel-footer">
		    <button type="submit" class="btn btn-default pull-right">
                <i class="process-icon-save"></i>Save
            </button>
	    </div>
    </form>
</div>

<script>
    $(document).ready(function () {
        var codeTextArea = document.getElementById('code');
        var editor = CodeMirror(function (elt) {
          codeTextArea.parentNode.replaceChild(elt, codeTextArea);
        }, {
            value: codeTextArea.value,
            lineWrapping: true
        });
        /*$('#page').submit(function (event) {
            event.preventDefault();
            var form = $(event.target);
            var data = form.serializeArray();
            var postData = {};
            for (var i in data) {
                if (data.hasOwnProperty(i)) {
                    postData[data[i].name] = data[i].value;
                }
            }
            postData.code = editor.getValue();
            var url = form.attr('action');
            console.log(url);*/
        });
    })
</script>
