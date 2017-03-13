$( document ).ready(function() {

    var idoc;
    var preset_data;
    var current_parent;

    $('#external_content').on('load', function(){
        idoc = document.getElementById('external_content').contentDocument;
        
        $(idoc).on('mouseup', function () {
            //get the variable name
            var var_name = $('input[name=variable]:checked').val();
            //get the variable color
            var var_color = $('input[name=variable]:checked').attr('color');

            selectText(var_color, var_name);
        });

        $(idoc).on('mousedown', function () {
            //get the variable name
            var var_name = $('input[name=variable]:checked').val();
            unselectText(var_name);
        });
    });


    function selectText(hexColor, name) {

        var selection = idoc.getSelection().getRangeAt(0);
        var selectedText = selection.extractContents();
        var span = idoc.createElement('span');
        span.style.backgroundColor = hexColor;
        span.className = "variable_item "+name;
        span.appendChild(selectedText);
        selection.insertNode(span);
    }

    function unselectText(name){
        $(idoc).find('.'+name).contents().unwrap();

    }

    
 
});

    function change_frame_url(){
        var request_url = $('#scrape_url').val();
        $('#external_content').attr('src', 'http://paul.local/pias/localize?url='+encodeURIComponent(request_url) );
    }

     function add_variable(){
        
        var variable_name = $('#variable_name').val();
        var variable_color = $('#variable_color').val();

     
        $( "#the_varibles" ).append('<input type="radio" name="variable" value="'+variable_name+"pias"+'" color="'+variable_color+'"><span style="background-color:'+variable_color+'">'+variable_name+'</span> <br>');
        $( "#the_varibles" ).append('<input type="hidden" class="scrape_vars" id="'+variable_name+"pias"+'" >');
        $('#variable_name').val("");
        $('#variable_color').val("");
    }

    function findParent(){
        var current_lineage_layer = parseInt($('#parent_lineage_level').val());
        var selected_element = $( "#external_content" ).contents().find( "span.variable_item" ).first();
        var parent_el = selected_element.parent();
        parent_el.css('background-color', 'yellow');
        parent_el.attr('pias_parent_level', current_lineage_layer);
        $('#parent_lineage_level').val(current_lineage_layer+1);
        current_parent = parent_el;

        var type_of = current_parent.prop('tagName');
        console.log('Found parent of type '+ type_of);
    }

    function nextParent(){
        var current_lineage_layer = parseInt($('#parent_lineage_level').val());
        current_parent.css('background-color', 'initial');
        var next_parent = current_parent.parent();
        next_parent.css('background-color', 'yellow');
        next_parent.attr('pias_parent_level', current_lineage_layer+1);
        $('#parent_lineage_level').val(current_lineage_layer+1);
        current_parent = next_parent;

    }

    function previousParent(){
        var current_lineage_layer = parseInt($('#parent_lineage_level').val());
        current_parent.css('background-color', 'initial');
        var last_parent = current_parent.children('[pias_parent_level]');
        last_parent.css('background-color', 'yellow');
        
        $('#parent_lineage_level').val(current_lineage_layer-1);

        current_parent = last_parent;
    }

   
    function predictNext(){
        
        var current_lineage_layer = parseInt($('#parent_lineage_level').val());
         
        //find variables list 
        var selected_variables = $('#the_varibles').find('input[type=radio]');
        //for each variable 
        selected_variables.each(function(){
            var counter = 0;
            var coordinateObj = [];
            var selector_class = $(this).val();

            console.log(selector_class);

            var cur_el = $( "#external_content" ).contents().find('.'+selector_class).parent();
            while(cur_el.attr('pias_parent_level') != current_lineage_layer){
                counter++;
                var type_of = cur_el.prop('tagName');
                //get parent 
                var item_parent = cur_el.parent();
                //find all the elements of type in that parent
                var matched_elements = item_parent.children(type_of);

                var index = matched_elements.index(cur_el);

                coordinateObj[counter] = {'type_of': type_of, 'index': index};

                cur_el = cur_el.parent();
            }
            //go back throug the coordinates in the next parent 
            var next_element = current_parent.next();
            var the_location = next_element;
            for (i = counter; i > 0; i--) {
                console.log("type "+coordinateObj[i].type_of+" at index "+ coordinateObj[i].index);
                the_location = the_location.children(coordinateObj[i].type_of).eq(coordinateObj[i].index);

            } 
            
            the_location.css('background-color', $(this).attr('color'));
        });
            //go up a level to element's parent
            //check for siblings of same type
            //if has siblings of same type, get element index (nth child)
            //prepend coordinate and add to page hidden 
            //check if parent is selected repeating element (if so stop)

        //un-highlight previous repeating element
        //find next of repeating element and highlight
            //highlight child elements using given coordinates

        var type_of = current_parent.prop('tagName');
        //var repeater_wrapper = current_parent.parent();
        alert("attempting to find next of type "+ type_of);
        el_index = current_parent.index();

        var next_element = current_parent.next();
        //var next_element = repeater_wrapper.find(type_of+":nth-child(3)");
        current_parent.css('background-color', 'initial');
        next_element.css('background-color', 'yellow');
        
        
    }










