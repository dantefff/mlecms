{$form_start}

<div class="pageoverflow">
		<p class="pagetext">{$title}:</p>
		<p class="pageinput">{$input}</p>
</div>

<fieldset>
<legend>{$title_source}</legend>
{foreach from=$langs item=lang}
<div class="pageoverflow">
		<p class="pagetext">{$lang.name}:</p>
		<p class="pageinput">
                {$lang.textarea}
                </p>
</div>
{/foreach}
</fieldset>
<div class="pageoverflow">
		<p class="pagetext"></p>
		<p class="pageinput"> {$form_details_cancel} {$form_details_apply} {$form_details_submit}</p>
</div>

{$form_end}