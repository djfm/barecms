<style>
</style>

<div class="panel">
    <div class="panel-heading">
        Edit "{$page->meta_title}"
    </div>
    <p class="lead">
        Here you can edit the HTML of the page.<br>Inline styles are BAD. If you want to customize the appearance of the page, please head over to <a href="{$edit_css_url}" target="_blank">the CSS section</a>.
    </p>
    <form class="form-horizontal" method="POST" action="{$update_url}">
        <div class="form-group">
            <label for="title" class="col-lg-2 control-label">
                {l s='Title' mod='barecms'}
            </label>
            <div class="col-lg-10">
                <input class="form-control" type="text" id="title" name="title" value="{$page->meta_title}">
            </div>
        </div>
        <div class="form-group">
            <label for="description" class="col-lg-2 control-label">
                {l s='Description' mod='barecms'}
            </label>
            <div class="col-lg-10">
                <input type="text" class="form-control" type="text" id="description" name="description" value="{$page->meta_description}">
            </div>
        </div>

        <div class="form-group">
            <label for="code" class="col-lg-2 control-label">
                {l s='CODE' mod='barecms'}
            </label>
            <div class="col-lg-10">
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
        var codeTextArea    = document.getElementById('code');
        var codeMirror      = CodeMirror.fromTextArea(codeTextArea, {
            lineWrapping: true,
            lineNumbers: true,
            mode: 'htmlmixed'
        });
    })
</script>
