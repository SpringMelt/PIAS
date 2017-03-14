<html>
    <head>
        <title>PIAS</title>
        <style type="text/css">
            .scrape_page{
                width: 60%;
                float: left;
                margin-left:20px;
                margin-right: 20px;
                background-color: gray;
                border-radius: 20px;
                padding: 20px;
                box-shadow: 5px 5px 5px #888888;
            }

            .controls_wrapper{
                width: 30%;
                float: left;
                
            }


            .controls{
                width: 100%;
                background-color: green;
                border-radius: 20px;
                padding: 20px;
                margin-bottom: 40px;
                box-shadow: 5px 5px 5px #888888;
            }

            .parent_selector{
                width: 100%;
                background-color: yellow;
                border-radius: 20px;
                padding: 20px ;
                box-shadow: 5px 5px 5px #888888;
            }

            iframe{
                width: 100%;
                height: 1000px;
            }

            iframe.a{
                cursor: text;
            }
            input#scrape_url{
                height: 1.5em;
                width:80%;
                margin-bottom: 20px;
            }
            input#select_url{
                width: 15%;
            }
          

 
        </style>
        
        
    </head>
    <body>
        <h1>PIAS (Paul's Interactive Scraper)</h1>


            

        <div class="scrape_page">
            <h2> Input URL here</h2>
            
            <form id="select_url" onsubmit="event.preventDefault();change_frame_url();">
                <input id="scrape_url" type="text" value="https://comoxvalley.craigslist.ca/search/hhh">
                <input value="go" type="submit">
            </form>

            <iframe src="" id="external_content" name="targetframe" allowTransparency="true" scrolling="yes" frameborder="1" ></iframe>
        </div>
        
        <div class="controls_wrapper">

            <div class="controls">
                <form id="add_variable" onsubmit="event.preventDefault(); add_variable();" >
                    
                    <label for="variable_name">New Variable Name</label>
                    <input name="variable_name" id="variable_name" type="text" value="Title">
                    <label for="variable_color">New Variable Colour</label>
                    <input name="variable_color" id="variable_color" type="text" value="#0099ff">
                    <input value="add" type="submit">

                </form>

                <form id="the_varibles" method="post" >
                    <input type="hidden" name="tracer_coordinates" id="tracer_coordinates" >
                    <input type="hidden" name="page_url" id="page_url">
                    <input type="submit" name="scrape" value="SCRAPE IT">
                </form>

            </div>

            <div class="parent_selector">
                <button onclick="findParent()">Find Parent</button>
                <button onclick="nextParent()">Up Level</button>
                <button onclick="previousParent()">Down Level</button>
                <input type="hidden" id="parent_lineage_level" value="1">
                
                <button onclick="predictNext()">Predict Next</button>

            </div>


        </div>


    </body>
    <script src="js/jquery-3.1.1.js"></script>
    <script src="js/main.js"></script>
</html>












