{literal}
    <style type="text/css">
        #trans input { width: 100%; }
        #trans span { display: block; cursor: pointer; }
    </style>
{/literal}

{assign var=pLangs value=$langsArray.langs}
{assign var=firstLang value=$pLangs[0].locale}
{assign var=xml value=$langsArray.xml}

<table id="trans" cellspacing="0" class="pagetable">

    <tr id="label">
        {foreach from=$pLangs item=pLang}
            <th><span>{$pLang.name}</span></th>
        {/foreach}

            <th class="pageicon"></th>
    </tr>

    <br />

    

    {foreach from=$keysArray item=item key=key name=itemsLoop}
        <tr id="{$key}" class="keys{if $smarty.foreach.itemsLoop.index is odd} row2{else} row1{/if}">
            {foreach from=$pLangs item=aLang name=parser}
                {assign var=loopLang value=$aLang.locale}

                <td data-lang="{$loopLang}">
                    <span>
                        {if $xml.$loopLang.items.$key}{$xml.$loopLang.items.$key}{else}{$key}{/if}
                    </span>
                </td>

            {/foreach}
            <td><a class='del' href="#">{$deleteIcon}</a></td>
        </tr>
    {/foreach}

</table>

{literal}
<script type="text/javascript">

    $(window).load(function(){
       //$('#trans .keys td').css('width', $('#trans').width() / $('#trans th').size());
    });

    $(document).ready(function(){
        $('#trans .keys td span').live('click', function(){
            $(this).hide();
            $(this).parents('td').append('<input type="text" value="" />');
            $(this).siblings('input').val($.trim($(this).text())).focus().select();
        });

        /** remove events */
        $('#trans .del').bind('click', function(event){
            var confirmBox = window.confirm('Are you sure?');
            if (confirmBox){
                $.myvars = {};
                $.myvars.thisObj = $(this);
                event.preventDefault();
                var delKey = $(this).parents('tr').attr('id');

                $.ajax({
                    type: 'POST',
                    url: '{/literal}{$ajaxLink}{literal}',
                    dataType: 'json',
                    data: ({
                        'delKey': delKey,
                        'sp_': '{/literal}{$smarty.get.sp_}{literal}',
                        'module': '{/literal}{$smarty.get.module}{literal}',
                        'showtemplate': 'false',
                        'aAction': 'remove'
                    }),
                    complete: function(){
                        $.myvars.thisObj.parents('tr').find('td').css('background-color','yellow').parents('tr').fadeOut('slow', function(){
                            $(this).remove();
                            $('#trans tr').removeClass('row2');
                            $('#trans tr:even').addClass('row2');
                        });
                    }
                });
            } // end confirmBox
        })

        /** update events */
        $('#trans tr td input').live('blur', function(){
            var $this = this;
            $.ajax({
                type: 'POST',
                url: '{/literal}{$ajaxLink}{literal}',
                dataType: 'json',
                data: ({
                    'editKey': $(this).parents('tr').attr('id'),
                    'editValue': $.trim($(this).val()),
                    'editLang': $(this).parents('td').attr('data-lang'),
                    'sp_': '{/literal}{$smarty.get.sp_}{literal}',
                    'module': '{/literal}{$smarty.get.module}{literal}',
                    'showtemplate': 'false',
                    'aAction': 'update'
                }),
                complete: function(){
                    $($this).hide();
                    $($this).siblings('span').text($.trim($($this).val())).show();
                    $($this).remove();
                }
            });
        });
    })
</script>
{/literal}
