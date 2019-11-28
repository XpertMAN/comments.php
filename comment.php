<?

	if ( isset( $user ) && ( $commentdata['user_id'] == $post_author || $user->has_cap( 'moderate_comments' ) || current_user_can('contributor') ) ) {
		// The author and the admins get respect.
		$approved = 1;
	} else {
		// Everyone else's comments will be checked.
		if ( check_comment(
			$commentdata['comment_author'],
			$commentdata['comment_author_email'],
			$commentdata['comment_author_url'],
			$commentdata['comment_content'],
			$commentdata['comment_author_IP'],
			$commentdata['comment_agent'],
			$commentdata['comment_type']
		) ) {
			$approved = 1;
		} else {
			$approved = 0;
		}

		if ( wp_blacklist_check(
			$commentdata['comment_author'],
			$commentdata['comment_author_email'],
			$commentdata['comment_author_url'],
			$commentdata['comment_content'],
			$commentdata['comment_author_IP'],
			$commentdata['comment_agent']
		) ) {
			$approved = EMPTY_TRASH_DAYS ? 'trash' : 'spam';
		}
	}


?>