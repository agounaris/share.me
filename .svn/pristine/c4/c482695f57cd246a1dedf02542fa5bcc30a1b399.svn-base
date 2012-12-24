<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $Project->getId() ?></td>
    </tr>
    <tr>
      <th>Client:</th>
      <td><?php echo $Project->getClientId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $Project->getName() ?></td>
    </tr>
    <tr>
      <th>Created by:</th>
      <td><?php echo $Project->getCreatedBy() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $Project->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $Project->getCreatedAt() ?></td>
    </tr>
  </tbody>
</table>

<a href="<?php echo url_for('project/edit?id='.$Project->getId()) ?>"><button class="btn btn-primary">Edit</button></a>
&nbsp;
<a href="<?php echo url_for('project/index') ?>"><button class="btn btn-primary">List</button></a>

<div style="margin-top:20px;">
<?php foreach ($images as $image) { ?>
  <div class="thumb-container" style="width:150px; height:200px; float:left; margin:10px;">
    <img id="<?php echo $image->getId() ?>" class="img-rounded" src="/uploads/images/<?php echo $image->getImageFile() ?>"/>
  </div>
<?php } ?>
</div>

<script type="text/javascript">

$(function () {
    $('.thumb-container').mouseover(function(){
        var el=$(this);

        $.ajax({
            type: "GET",
            url: "/image_comment/imgshow",
            data: {id: el.find('img').attr('id')},
            dataType: "json",
            success: function(data) {

				var comments = '';
            	$.each(data, function (i, val) {
            		comments = comments + '<blockquote class="alert alert-info comment">' + val[1] + '<small>' + val[2] + ' at ' + val[3] + '</small></blockquote>';;
            	});

                if ( comments == '' ) {
                	el.attr("data-content", 'This image has no comments');
                }else{
                	el.attr("data-content", comments);
                }
                
                el.popover({trigger:'manual'}); 
                el.popover('show'); 
            }
        });
    });

    $('.thumb-container').mouseout(function(){
    	$(this).popover('hide'); 
    });
});
</script>
