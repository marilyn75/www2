@if ($errors->any())
                            
    <div class="ui_kit_message_box w-100">
        <div class="alert alart_style_four alert-dismissible fade show" role="alert">
            {{ $errors->all()[0] }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>	
    
@endif

@if (Session::has('error_message'))
    
    <div class="ui_kit_message_box w-100">
        <div class="alert alart_style_four alert-dismissible fade show" role="alert">
            {{ Session::get('error_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>	
    
@endif

@if (Session::has('success_message'))
    <div class="ui_kit_message_box w-100">
        <div class="alert alart_style_three alert-dismissible fade show" role="alert">
            {{ Session::get('success_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>	
@endif