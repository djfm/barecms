<style>
    .cms-entry {
        margin-bottom: 10px;
    }

    .cms-entry a, .cms-entry a:hover {
        text-decoration: none;
    }
</style>

<div class="container">
    <h3>{l s='Here are your CMS pages:' mod='barecms'}</h3>
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
