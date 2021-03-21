<?php if(ENV == "dev"):?>
    <div style="position:absolute; top: 0px; left: 0px; z-index: 1999; background-color: black; color: white;">
        <div id="buttonSessionBarContent" style="background-color: black; color: white; cursor: pointer; width: 30px; height: 30px">
            X
        </div>
        <div style="display: none; width: 100%" id="showSessionBarContent">
            <pre>
                <?php print_r($_SESSION);?>
            </pre>
        </div>
    </div>
    <script>
        let myButtonSessionBarContent = document.getElementById('buttonSessionBarContent');
        let showSessionBarContent = document.getElementById('showSessionBarContent');
        myButtonSessionBarContent.addEventListener("click", function() {
            if(showSessionBarContent.style.display == "none") {
                showSessionBarContent.style.display = "block";
            } else {
                showSessionBarContent.style.display = "none";
            }
        })
       
    </script>
<?php endif;?>