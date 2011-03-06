	$(window).ready(function() {
	
		
		$('.repairField').blur(function() { 
			
			o = $(this);
			if (o.val()=='') { 
				//console.log('resetting default');
				o.css('color','#CCC');
				o.val(o.attr('default'));
			}
		});

		$('.repairField').focus(function() { 
			
			o = $(this);
			 if (o.val()==o.attr('default')) {
				o.css('color','#000');
				o.val('');
			}

		});

		$('.repairField').blur();
	
		$('form.valid').validate();
	
	
	});


	function markAlertAsRead(id) { 
		var command = API + "?method=alert.markAsRead&id=" + escape(id);	
		$.getJSON(command,function(alert) { 
			if (alert.error) {
				alert(alert.error);
			} else {
				$('#alert_'+alert.id).hide();
			}
		
		});
	}
	
	function togglePostOption(option) {
	
		add_option = $('#add_' + option);
		post_option = $('#post_' + option);
		
		if (add_option.hasClass('active')) { // option is off, need to turn it on
			add_option.removeClass('active');
			post_option.hide();
		} else {
			add_option.addClass('active');
			post_option.show();		
		}
		return false;
	}


		var comment_ajax;

/* Post Comments Management */

		function reply(commentId,nick) { 
			if ($('#comment')) { 
				$('#comment').val($('#comment').val() + '<a href="#' +commentId + '">@' + nick + '</a> ');
			}
				return false;
		}
		
		function startSpinner() {
		
			$('#spinner').html('<img src="' + themeRoot + '/img/spinner.gif" />');
		}
		function stopSpinner() {
		
			$('#spinner').html('FEED BACK');
		}

		function addComment(docId,comment) { 
			$('#comment').css('color','#CCC');
			var command = API + "?method=addComment&docId=" + docId + "&comment=" + escape(comment);
			startSpinner();
			$.getJSON(command,function(comment) {
				if (comment.error) {
					alert(comment.error);
				} else {
					stopSpinner();
					$('#comment').css('color','#000');
					$('#comment').val('');
				}
			});
			return false;
		}



		function getComments(doc) { 
			var command = API + "?method=getComments&docId=" + doc;
			$('#comments').load(command);
			// FIX THIS
			// this could be a bit more sophisticated.
			setTimeout('getComments(' + doc + ')',3000);
			return false;				
		}

		
		function removeComment(commentId) { 
			if (confirm('Are you sure you want to permanently comment this, permanently, forever?')) { 
				var command = API + "?method=removeComment&comment=" + escape(commentId);
				$('#comment' + commentId).hide();
				$.getJSON(command,function(comment) { 				
					if (comment.error) {
						$('#comment' + comment.id).show();
						alert(comment.error);
					} else {
						$('#comment' + comment.id).hide();
					}
				
				});
			}		
			return false;
	
		}
		
/* Dashboard Comment Management */

		
		
		function markAsRead(docId) { 
		
			var command = API + "?method=markAsRead&docId=" + docId;
			$.getJSON(command,function(doc) { 
				if (doc.error) {
					alert(doc.error);
				} else {
					$('#option_mark_as_read_' + doc.id).html('&#x2714; Read');
	
				}					
			});
			return false;
		}


/* Flag toggles! */
		function addWatch(docId) { 

			var addWatch = $('#addWatch_' + docId);
			var removeWatch = $('#removeWatch_' + docId);
			addWatch.hide();
			removeWatch.show();
					
			var command = API + "?method=addWatch&docId=" + docId;
			$.getJSON(command,function(doc) { 
			
				var addWatch = $('#addWatch_' + doc.id);
				var removeWatch = $('#removeWatch_' + doc.id);
				if (doc.error) {	
					addWatch.show();
					removeWatch.hide();
					alert(doc.error);
				} else {
					addWatch.hide();
					removeWatch.show();
				}			
			});
			return false;
		}

		function removeWatch(docId) { 

			var addWatch = $('#addWatch_' + docId);
			var removeWatch = $('#removeWatch_' + docId);
			addWatch.show();
			removeWatch.hide();
					
			var command = API + "?method=removeWatch&docId=" + docId;
			$.getJSON(command,function(doc) { 
			
				var addWatch = $('#addWatch_' + doc.id);
				var removeWatch = $('#removeWatch_' + doc.id);
				if (doc.error) {	
					addWatch.hide();
					removeWatch.show();
					alert(doc.error);
				} else {
					addWatch.show();
					removeWatch.hide();
				}			
			});
			return false;
		}



		function addFavorite(docId) { 

			var addFavorite = $('#addFavorite_' + docId);
			var removeFavorite = $('#removeFavorite_' + docId);
			addFavorite.hide();
			removeFavorite.show();
					
			var command = API + "?method=addFavorite&docId=" + docId;
			$.getJSON(command,function(doc) { 
			
				var addFavorite = $('#addFavorite_' + doc.id);
				var removeFavorite = $('#removeFavorite_' + doc.id);
				if (doc.error) {	
					addFavorite.show();
					removeFavorite.hide();
					alert(doc.error);
				} else {
					addFavorite.hide();
					removeFavorite.show();
				}			
			});
			return false;
		}

		function removeFavorite(docId) { 

			var addFavorite = $('#addFavorite_' + docId);
			var removeFavorite = $('#removeFavorite_' + docId);
			addFavorite.show();
			removeFavorite.hide();
					
			var command = API + "?method=removeFavorite&docId=" + docId;
			$.getJSON(command,function(doc) { 
			
				var addFavorite = $('#addFavorite_' + doc.id);
				var removeFavorite = $('#removeFavorite_' + doc.id);
				if (doc.error) {	
					addFavorite.hide();
					removeFavorite.show();
					alert(doc.error);
				} else {
					addFavorite.show();
					removeFavorite.hide();
				}			
			});
			return false;
		}



		function addFriend(friendId) { 
			var command = API + "?method=addFriend&id=" + friendId;
			$.getJSON(command,function(newfriend) { 
				if (newfriend.error) {
					alert(newfriend.error);
				} else {
					var removeFriend = $('#removeFriend_' + newfriend.id);
					var addFriend = $('#addFriend_' + newfriend.id);
					
					removeFriend.show();
					addFriend.hide();			
				}
			});
			return false;
		}
		function removeFriend(friendId) { 
			var command = API + "?method=removeFriend&id=" + friendId;
			$.getJSON(command,function(newfriend) { 
				if (newfriend.error) {
					alert(newfriend.error);
				} else {
					var removeFriend = $('#removeFriend_' + newfriend.id);
					var addFriend = $('#addFriend_' + newfriend.id);
					
					removeFriend.hide();
					addFriend.show();			
				}
			});
			return false;
		}		


/* Group Member Management */

		function removeMember(gid,pid) { 
		
			var command = API + "?method=removeMember&group=" + gid + "&id=" + pid;
			$('#member_'+pid).hide();			
			$.getJSON(command,function(person) {
				if (person.error) {	
					$('#member_' + person.id).show();
					alert(person.error);
				} else {
					$('#member_' + person.id).hide();
				}			
			});
			return false;
		}

		function changeMemberType(gid,pid,type) { 
		
			var command = API + "?method=changeMemberType&group=" + gid + "&id=" + pid + "&type=" + type;
			$.getJSON(command,function(person) { 
				if (person.error) {	
					alert(person.error);
				} else {
					$('#member_invitee_' + person.id).hide();
					$('#member_member_' + person.id).hide();
					$('#member_manager_' + person.id).hide();
					type = person.membership;
					$('#member_type_' + person.id).html(type);
					if (type=='owner') { type='manager'; }
					$('#member_' + type + '_' + person.id).show();			
		
				}			
			});
			return false;
		}



/* Formatting */
		
		function pluralize(count,singular,plural) {
		
			if (count == 1) {  return singular; } else { return plural; } 
		}
		
		function deleteDocument(docId) { 
			if (confirm('Are you sure you want to permanently delete this, permanently, forever?')) { 
				var command = API + "?method=deleteDocument&id=" + escape(docId);
				$('#document_' + docId).hide();

				$.getJSON(command,function(doc) { 
					if (doc.error) {
						$('#document_' + doc.id).show();
						alert(doc.error);
					} else {
						$('#document_' + doc.id).hide();
					}
				});
			}
			return false;
		}		
