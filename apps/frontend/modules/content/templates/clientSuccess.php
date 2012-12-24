<script type="text/javascript" src="/js/jscolor/jscolor.js"></script>

<h3>I am a client page!!</h3>

<div id="container">

    <div id="thumbs">
        <ul>
            <?php
            foreach ($images as $image) {
                ?>

                <li>
                    <div class="thumb-container" style="width:100px; height:100px; overflow:hidden;">
                        <img class="img-rounded" src="/uploads/images/<?php echo $image->getImageFile() ?>"/>
                    </div>
                </li>


                <?php } ?>
        </ul>
    </div>

    <div id="image-container">
        <canvas id="canvas" width="650" height="800"></canvas>

        <div id="controls">
            <button class="btn btn-primary" id="loadCanvas">Reload</button>
            <button class="btn btn-primary" id="clearCanvas">Clear</button>
            <button class="btn btn-primary" id="saveCanvas">Save</button>
            Select a color: <input id="color-input" class="color" value="66ff00" style="width:150px;">

            <select id="method-select">
                <option value="1">Draw lines</option>
                <option value="2">Place numbers</option>
            </select>

        </div>
    </div>

    <div id="comments">
    </div>


</div>