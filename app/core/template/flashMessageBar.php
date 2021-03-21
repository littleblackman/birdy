<?php if (isset($_SESSION['flashMessage'])):?>
    <div id="flashMessageBar">
        <?php foreach ($_SESSION['flashMessage'] as $message):?>
            <div class="flashMessageBarContent <?= $message['type']; ?>">
                <?php echo $message['message']; ?>
            </div>
        <?php endforeach; ?>
        <?php $_SESSION['flashMessage'] = [];?>
    </div>

    <script>
        setInterval(function(){ 
            let flashMessageBar = document.getElementById('flashMessageBar');
            flashMessageBar.style.display = "none";
        }, 5000);
    </script>

<?php endif; ?>
