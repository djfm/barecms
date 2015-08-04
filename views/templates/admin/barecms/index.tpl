<style>
    .cms-entry {
        margin-bottom: 10px;
    }

    .cms-entry a, .cms-entry a:hover {
        text-decoration: none;
    }
</style>

<div class="panel">
    <div class="panel-heading">{l s='Your CMS pages' mod='barecms'}</div>
    <p>Click on the labels to edit them.</p>
    {foreach from=$pages item=page}
        <div class="row cms-entry">
            <div class="col-xs-3">
                <a href="{$page['edit_url']}">
                    <span class="label label-default">{$page.meta_title}</span>
                </a>
            </div>
            <div class="col-xs-9">
                {$page.meta_description}
            </div>
        </div>
    {/foreach}
</div>
