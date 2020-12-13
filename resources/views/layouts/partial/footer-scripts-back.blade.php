 

<!--<script src="{{--  URL::asset('public/js/jquery-ui/jquery.ui.min.js') --}}" type="text/javascript"></script>-->
{{ csrf_field() }}

 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.2/umd/popper.min.js" type="text/javascript"></script>


<script src="{{ URL::asset('public/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>

  
<script  src="{{ asset('public/js/summernote.min.js') }}"  type="text/javascript"></script>
<script src="{{  URL::asset('public/js/custom_js/compose.js') }}" type="text/javascript"></script>
  
<!----- Datepicker ------->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 

 

  <!-- Admin -->
   <!-- Bootstrap core JavaScript 
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script  src="{{  URL::asset('public/sbadmin/jquery-easing/jquery.easing.min.js') }}"  ></script>

  <!-- Custom scripts for all pages-->
  <script   src="{{  URL::asset('public/sbadmin/js/sb-admin-2.min.js') }}" src="js/sb-admin-2.min.js"></script>
 
 <script>

$(function () {
	
        $( ".datepicker" ).datepicker({

            altField: "#datepicker",
            closeText: 'Fermer',
            prevText: 'Précédent',
            nextText: 'Suivant',
            currentText: 'Aujourd\'hui',
            monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
            dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
            dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
            dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
            weekHeader: 'Sem.',
            buttonImage: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABEAAAATCAYAAAB2pebxAAABGUlEQVQ4jc2UP06EQBjFfyCN3ZR2yxHwBGBCYUIhN1hqGrWj03KsiM3Y7p7AI8CeQI/ATbBgiE+gMlvsS8jM+97jy5s/mQCFszFQAQN1c2AJZzMgA3rqpgcYx5FQDAb4Ah6AFmdfNxp0QAp0OJvMUii2BDDUzS3w7s2KOcGd5+UsRDhbAo+AWfyU4GwnPAYG4XucTYOPt1PkG2SsYTbq2iT2X3ZFkVeeTChyA9wDN5uNi/x62TzaMD5t1DTdy7rsbPfnJNan0i24ejOcHUPOgLM0CSTuyY+pzAH2wFG46jugupw9mZczSORl/BZ4Fq56ArTzPYn5vUA6h/XNVX03DZe0J59Maxsk7iCeBPgWrroB4sA/LiX/R/8DOHhi5y8Apx4AAAAASUVORK5CYII=",

            firstDay: 1,
            dateFormat: "dd/mm/yy"

        });
         });
 </script>
 
 <?php if  ($view_name == 'messagechat-messagerie')   { ?>

 
<script>  
$(document).ready(function(){


    fetch_user();

    setInterval(function(){
        //update_last_activity();
        fetch_user();
        update_chat_history_data();
        //fetch_group_chat_history();
    }, 5000);


    function fetch_user()
    {
        $.ajax({
            url:"{{url('/')}}/fetchuser/"+{{auth::user()->id}},
            method:"get",
            success:function(data){
                //alert(data);
                $('#user_details').html(data);
            }
        })
    }

    function update_last_activity()
    {
        $.ajax({
            url:"update_last_activity.php",
            success:function()
            {

            }
        })
    }

    function make_chat_dialog_box(to_user_id, to_user_name)
    {
        var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" title="Vous communiquez avec :'+to_user_name+'">';
        modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
        modal_content += fetch_user_chat_history(to_user_id);
        modal_content += '</div>';
        modal_content += '<div class="form-group">';
        modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control chat_message"></textarea>';
        modal_content += '</div><div class="form-group" align="right">';
        modal_content+= '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Envoyer</button></div></div>';
        $('#user_model_details').html(modal_content);
    }

    $(document).on('click', '.start_chat', function(){
        var to_user_id = $(this).data('touserid');
        var to_user_name = $(this).data('tousername');
        make_chat_dialog_box(to_user_id, to_user_name);
        $("#user_dialog_"+to_user_id).dialog({
            autoOpen:false,
            width:400
        });
        $('#user_dialog_'+to_user_id).dialog('open');
       // var messageBody = document.querySelector('#chat_history_'+to_user_id);
       // messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
       //var chatHistory = document.getElementById('chat_history_'+to_user_id);

       var chatHistory = document.querySelector('#chat_history_'+to_user_id);
       chatHistory.scrollTop = chatHistory.scrollHeight;

    $('#chat_message_'+to_user_id).emojioneArea({
            pickerPosition:"top",
            toneStyle: "bullet"
        });
    });

    $(document).on('click', '.send_chat', function(){
        var to_user_id = $(this).attr('id');
        var chat_message = $.trim($('#chat_message_'+to_user_id).val());
        if(chat_message != '')
        {
            $.ajax({
                url:"{{url('/')}}/insertchat/",
                method:"get",
                data:{to_user_id:to_user_id, chat_message:chat_message},
                success:function(data)
                {
                   // $('#chat_message_'+to_user_id).val('');
                   var element = $('#chat_message_'+to_user_id).emojioneArea();
                    element[0].emojioneArea.setText('');
                    $('#chat_history_'+to_user_id).html(data);
                   //var messageBody = document.querySelector('#chat_history_'+to_user_id);
                   // messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;

                    var chatHistory = document.getElementById('chat_history_'+to_user_id);
                     chatHistory.scrollTop = chatHistory.scrollHeight;
                }
            })
        }
        else
        {
            alert('Ecrivez quelque chose');
        }
    });

    function fetch_user_chat_history(to_user_id)
    {
        $.ajax({
            url:"{{url('/')}}/fetch_user_chat_history/"+to_user_id,
            method:"get",
            data:{to_user_id:to_user_id},
            success:function(data){
                $('#chat_history_'+to_user_id).html(data);
            }
        })
    }

    function update_chat_history_data()
    {
        $('.chat_history').each(function(){
            var to_user_id = $(this).data('touserid');
            fetch_user_chat_history(to_user_id);
        });
    }



    $(document).on('click', '.ui-button-icon', function(){
        $('.user_dialog').dialog('destroy').remove();
        $('#is_active_group_chat_window').val('no');
    });

    $(document).on('focus', '.chat_message', function(){
        var is_type = 'yes';
        $.ajax({
            url:"{{url('/')}}/update_is_type_status/"+{{Auth::user()->id}},
            method:"get",
            data:{is_type:is_type},
            success:function(data)
            {
                //alert(data);
            }
        })
    });

    $(document).on('blur', '.chat_message', function(){
        var is_type = 'no';
        $.ajax({
            url:"{{url('/')}}/update_is_type_status/"+{{Auth::user()->id}},
            method:"get",
            data:{is_type:is_type},
            success:function(data)
            {
               //alert(data); 
            }
        })
    });

    $('#group_chat_dialog').dialog({
        autoOpen:false,
        width:400
    });

    $('#group_chat').click(function(){
        $('#group_chat_dialog').dialog('open');
        $('#is_active_group_chat_window').val('yes');
        fetch_group_chat_history();
    });

    $('#send_group_chat').click(function(){
        var chat_message = $.trim($('#group_chat_message').html());
        var action = 'insert_data';
        if(chat_message != '')
        {
            $.ajax({
                url:"group_chat.php",
                method:"POST",
                data:{chat_message:chat_message, action:action},
                success:function(data){
                    $('#group_chat_message').html('');
                    $('#group_chat_history').html(data);
                }
            })
        }
        else
        {
            alert('Type something');
        }
    });

    function fetch_group_chat_history()
    {
        var group_chat_dialog_active = $('#is_active_group_chat_window').val();
        var action = "fetch_data";
        if(group_chat_dialog_active == 'yes')
        {
            $.ajax({
                url:"group_chat.php",
                method:"POST",
                data:{action:action},
                success:function(data)
                {
                    $('#group_chat_history').html(data);
                }
            })
        }
    }

    $('#uploadFile').on('change', function(){
        $('#uploadImage').ajaxSubmit({
            target: "#group_chat_message",
            resetForm: true
        });
    });

    $(document).on('click', '.remove_chat', function(){
        var chat_message_id = $(this).attr('id');
        if(confirm("Are you sure you want to remove this chat?"))
        {
            $.ajax({
                url:"remove_chat.php",
                method:"POST",
                data:{chat_message_id:chat_message_id},
                success:function(data)
                {
                    update_chat_history_data();
                }
            })
        }
    });
    
});  
</script>
 
<?php } ?>
 
 
 @yield('footer_scripts')

