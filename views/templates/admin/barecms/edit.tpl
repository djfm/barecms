<style>
</style>

<form class="form-horizontal">
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
            {l s='Description' mod='barecms'}
        </label>
        <div class="col-lg-9">
            <textarea class="form-control" type="text" id="code" name="code">{$page->content}</textarea>
        </div>
    </div>

</form>

<script>
    $(document).ready(function () {
        var codeTextArea = document.getElementById('code');
        var editor = CodeMirror(function (elt) {
          codeTextArea.parentNode.replaceChild(elt, codeTextArea);
        }, {
            value: codeTextArea.value,
            lineWrapping: true
        });
    })
</script>
