<style>
</style>

<div class="panel">
    <div class="panel-heading">
        Edit your CMS CSS
    </div>
    <p class="lead">Your CSS will be included on all CMS pages.</p>
    <form class="form-horizontal" method="POST" action="{$update_css_url}">
        <div class="form-group">
            <label for="code" class="col-lg-2 control-label">
                {l s='CSS' mod='barecms'}
            </label>
            <div class="col-lg-10">
                <textarea class="form-control" type="text" id="code" name="code">{$css}</textarea>
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
            mode: 'css'
        });
    })
</script>
