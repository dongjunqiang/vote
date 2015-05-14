define('app/vote',function(require) {
	var Vote = {
		init: function(){
			this.praise();
			this.quickSelect();
			this.showMore();
		},

		praise: function(){
			$('.prise').on('click', function(event) {
		        var $modal = $('#myModal');
		        var voteid = $(this).data('voteid');
		        $modal.find('form #voteid').val(voteid);
		        $modal.modal('toggle');
		    });
		},

		quickSelect: function(){
			$('#quickSelect').on('change', function(){
			    var $selected = $(this).children('option:selected');
			    if($selected.index()){
			        $('#content').val($selected.val());
			    }else{
			        $('#content').val('');
			    }
			});
		},

		showMore: function(){
			
		    $('.showmore').on('click', function(){
		    	var $this = $(this),
		        	optionId = $this.prev().data('voteid'),
		        	$showlog = $this.parent().parent().next('.showlog'),
		        	$icon = $this.children('span');
				if($this.attr('data-type') == 1){
					$icon.removeClass('glyphicon-minus').addClass('glyphicon-plus');
		        	$this.attr('data-type', 0);
					$showlog.hide();
				}else{
					$icon.removeClass('glyphicon-plus').addClass('glyphicon-minus');
					$this.attr('data-type', 1);
					if($showlog.length > 0){
						$showlog.show();
						return;
					}
		        	
			        $.ajax({
			            url: '/vote/detail',
			            type: 'GET',
			            dataType: 'json',
			            data: { id: optionId },
			        })
			        .done(function(res) {
			            if(res.list){
			            	require.async('template', function(template){
				        		var html = template('log', res);
								$this.parent().parent().after(html);
				        	});
			            }
			        });
				}
		        
		    });
		}
	};
	Vote.init();
});