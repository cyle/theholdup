$(document).ready(function() {
	
	$('#project-list').sortable({
		stop: function( event, ui ) {
			var ids_order = [];
			$('#project-list .project').each(function(index) {
				ids_order.push($(this).attr('data-id'));
			});
			$.ajax({
				url: 'resort.php',
				type: 'post',
				dataType: 'text',
				data: { order: ids_order },
				success: function(data) {
					if (data != 'ok') {
						alert(data);
					}
				}
			});
		}
	});
	
	$('#project-list').disableSelection();
	
	$('.project-done-checkbox').click(function() {
		//alert($(this).attr('data-id') + ' ' + ($(this).prop('checked') * 1));
		var this_id = $(this).attr('data-id');
		var this_checked = $(this).prop('checked') * 1;
		$.ajax({
			url: 'done.php',
			type: 'post',
			dataType: 'text',
			data: { id: this_id, d: this_checked },
			success: function(data) {
				if (data != 'ok') {
					alert(data);
				}
			}
		});
		if (this_checked == 1) {
			$(this).parent().parent().parent().hide('drop');
		}
	});
	
	$('.project-status').dblclick(function() {
		//alert($(this).html());
		var oops_old = $(this).html();
		var current_status_text = $(this).find('span.project-current-status').html();
		$(this).html('<form action="new_status.php" method="post"><input type="hidden" name="id" value="'+$(this).attr('data-id')+'" /> <input name="s" type="text" placeholder="new status?" value="'+current_status_text+'" /> <input type="submit" value="save" /> <input type="button" value="cancel" class="cancel-btn" /></form>');
		$(this).find('input.cancel-btn').click(function() { $(this).parent().html(oops_old); });
	});
	
	$('.project-name').dblclick(function() {
		var oops_old = $(this).html();
		$(this).html('<form action="rename.php" method="post"><input type="hidden" name="id" value="'+$(this).attr('data-id')+'" /> <input name="n" type="text" placeholder="new name?" value="'+oops_old+'" /> <input type="submit" value="save" /> <input type="button" value="cancel" class="cancel-btn" /></form>');
		$(this).find('input.cancel-btn').click(function() { $(this).parent().parent().html(oops_old); });
	});
	
	$('#public-checkbox').click(function() {
		if ($(this).prop('checked')) {
			//alert('making public');
			$.get('makepublic.php?v=1');
		} else {
			//alert('making private');
			$.get('makepublic.php?v=0');
		}
	});
	
});