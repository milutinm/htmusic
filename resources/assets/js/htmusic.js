/**
 * Created by Milutin Milovanovic on 14/01/16.
 */

$(function(){
   $('form.prompt-confirm').submit(function(e){
       return confirm($(this).attr('msg'));
   });
});