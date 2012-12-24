<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL);
if ($sf_user->hasCredential('read_project')) 
{ ?>
<script type="text/javascript">
    $('#search').hide();
</script>
<?php } ?>

<?php
if ($projectAllowed) {
    ?>

<script type="text/javascript" xmlns="http://www.w3.org/1999/html" src="/js/jscolor/jscolor.js"></script>

<?php if (isset($_GET['url'])) { ?>
    <div style="margin: 0 auto;text-align: center;">
        <button class="btn btn-primary" id="image-view" title="The view where you can comment to the image">Comments View</button>
        <button class="btn btn-primary" id="html-view" title="The view where you can comment to the image" style="width:120px;">Live Html</button>
        <a href="<?php echo $url ?>" class="btn btn-primary" id="popup" rel="tooltip" title="The view where you can comment to the image" style="width:110px;">open popup</a>
    </div>
    <?php } ?>

<div id="new-message-div" style="margin: 0 auto;text-align: center;display: none;">
    <div class="btn btn-primary">There is a new comment please click to the image thumbnail.</div>
</div>

<div id='role-div' style="display:none"><?php echo $userRole ?></div>

<div id="container" style="margin-top:20px;">

    <div id="thumbs">
        <ul id="thumbs-list">
            <?php
            foreach ($images as $image) {
				$path = realpath(".").'/uploads/images/'.$image->getImageFile();
				list($width, $height) = getimagesize( $path );
                ?>

                <li>
                    <div class="thumb-container" style="width:100px; height:100px; overflow:hidden;">
                        <img 
                        id="<?php echo $image->getId() ?>" 
                        class="img-rounded" 
                        src="/uploads/images/<?php echo $image->getImageFile() ?>"
                        value="<?php echo $width.' '.$height; ?>"
                        />
                    </div>
                </li>


                <?php } ?>
        </ul>
    </div>

    <div id="image-container" style="">
        <!--<div id="controls">
            <button class="btn btn-primary" id="loadCanvas">Reload</button>
            <button class="btn btn-primary" id="clearCanvas">Clear</button>
            <button class="btn btn-primary" id="saveCanvas">Save</button>
            <input id="color-input" class="color" value="66ff00" style="width:150px;display: none;">

            <select id="method-select" style="display:none;">
                <option value="1">Draw lines</option>
                <option value="2" selected>Place numbers</option>
            </select>

        </div>-->

        <div id="testLoad" style="display: none;">
            <iframe frameborder="none" width="650" height="800" src="<?php echo $url ?>">
            </iframe>
        </div>

        <canvas id="canvas"></canvas>

    </div>

    <div id="comments">
        <div id="comments-text" style="max-height: 500px;overflow: auto;"></div>
        <div id="comment-form-div" style="width:150px;display:none;">
            <textarea id="comment-textarea" rows="10" cols="" style="width:140px;height:70px;"></textarea>
            <button id="submit-comment-button" class="btn btn-mini btn-primary" type="submit">comment</button>
            <?php if ($sf_user->hasCredential('read_project')) { ?>
            	<button id="cancel-comment-button" class="btn btn-mini btn-danger" type="submit">cancel</button>
            <?php } ?>
        </div>
    </div>


</div>

<?php } else { ?>

<h3 class="list-title">You are not allowed to access this project.</h3>

<?php } ?>


