/* global window */
/* global document */
/* global jQuery */

/* Place all your JavaScript modifications below */
(function ($, ctx) {
    'use strict';

    var locked = false;
    
    var selectors = {
        'wrapper':      '.snax-voting',
        'upvoteLink':   '.snax-voting-upvote',
        'downvoteLink': '.snax-voting-downvote',
        'guestVoting':  '.snax-guest-voting',
        'voted':        '.snax-user-voted'
    };

    ctx.votes = function () {
        // Catch event on wrapper to keep it working after box content reloading
        $('body').on('click', selectors.upvoteLink + ', ' + selectors.downvoteLink, function (e) {
            e.preventDefault();

            if (locked) {
                return;
            }

            locked = true;

            var $link       = $(e.target);
            var voteType    = $link.is(selectors.upvoteLink) ? 'upvote' : 'downvote';
            var $wrapper    = $link.parents(selectors.wrapper);
            var nonce       = $.trim($link.attr('data-snax-nonce'));
            var itemId      = parseInt($link.attr('data-snax-item-id'), 10);
            var authorId    = parseInt($link.attr('data-snax-author-id'), 10);
            var postId      = parseInt($link.attr('data-snax-mod-wp-post-id'), 10);
            var isType      = $.trim( $link.attr( 'data-snax-mod-is-type' ) );

            ctx.vote({
                'isType':  isType,
                'postId':   postId,
                'itemId':   itemId,
                'authorId': authorId,
                'type':     voteType,
            }, nonce, $wrapper);
        });

        // Remove all guest votes if there are not related cookies.
        $(selectors.voted + selectors.guestVoting).each(function () {
            var $link  = $(this);
            var itemId = parseInt($link.attr('data-snax-item-id'), 10);
            var type   = $link.is(selectors.upvoteLink) ? 'upvote' : 'downvote';
            var itemVoteType = ctx.readCookie('snax_vote_item_' + itemId);

            if (type !== itemVoteType) {
                $(this).removeClass(classes.voted);
            }
        });
    };

    ctx.vote = function (data, nonce, $box) {
        var config = $.parseJSON(window.snax_front_config);

        if (!config) {
            ctx.log('Item voting failed. Global config is not defined!');
            return;
        }

        /*
         * Apply new voting box state before ajax response.
         */
        var $userVoted      = $box.find('.snax-user-voted');
        var userUpvoted     = $userVoted.length > 0 && $userVoted.is('.snax-voting-upvote');
        var userDownvoted   = $userVoted.length > 0 && $userVoted.is('.snax-voting-downvote');
        var $score          = $box.find('.snax-voting-score > strong');
        var score           = parseInt($score.text(), 10);
        var diff            = 'upvote' === data.type ? 1 : -1;
        //var post_id1         = $box.find('.snax-voting-score < .post');
        //var post_id2         = $box.find('.post < .snax-voting-score');
        //var post_id1         = $box.find('.snax-voting-score < <article>');
        //var post_id2         = $box.find('<article> < .snax-voting-score');
        //var post_id = $('.')

        // User reverted his vote.
        if (userUpvoted && 'upvote' === data.type || userDownvoted && 'downvote' === data.type) {
            diff *= -1;

            $box.find('.snax-user-voted').removeClass('snax-user-voted');

        // User voted opposite.
        } else if (userUpvoted && 'downvote' === data.type || userDownvoted && 'upvote' === data.type) {
            diff *= 2;

            $box.find('.snax-user-voted').removeClass('snax-user-voted');
            $box.find('.snax-voting-' + data.type).addClass('snax-user-voted');

        // User added new vote.
        } else {
            $box.find('.snax-voting-' + data.type).addClass('snax-user-voted');
        }

        // Update score.
        $score.text(score + diff);

        // Send ajax.
        var xhr = $.ajax({
            'type': 'POST',
            'url': config.ajax_url,
            'dataType': 'json',
            'data': {
                'action':               'snax_vote_item',
                'security':             nonce,
                'snax_mod_is_type':     data.isType,
                'snax_mod_wp_post_id':  data.postId,
                'snax_item_id':         data.itemId,
                'snax_author_id':       data.authorId,
                'snax_vote_type':       data.type,
                'snax_user_voted':      ctx.readCookie( 'snax_vote_item_' + data.itemId )
            }
        });

        xhr.done( function ( res ) {
            if ( res.status === 'success' ) {
                // Replace just box content to keep assigned to it events
                $box.html( $( res.args.html ).html() );

                ctx.updateVoteState( data.itemId, data.type, $box );
                
                alert( res.message );
            } else {
                alert( res.message );
            }

            locked = false;
        } );
    };
    
    
})(jQuery, snax);
/*
(function ($) {

    "use strict";

    $(document).ready(function () {

        $('.g1-canvas-global').css('left',0-$('.g1-canvas-global').width());

    });

    $(window).load(function () {

        // YOUR "WINDOW READY" CODE GOES HERE ...

    });

})(jQuery);
*/

