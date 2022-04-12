<div id="screen-meta" class="metabox-prefs">

    <div id="contextual-help-wrap-2" class="hidden" tabindex="-1" aria-label="Contextual Help Tab">
        <div id="contextual-help-back"></div>
        <div id="contextual-help-columns">
            <div class="contextual-help-tabs">
                <ul>

                    <li id="tab-link-overview" class="active">
                        <a href="#tab-panel-overview" aria-controls="tab-panel-overview">
                            Overview </a>
                    </li>

                    <li id="tab-link-overview" class="">
                        <a href="#tab-panel-shortcodes-overview" aria-controls="tab-panel-shortcodes-overview">
                            Shortcodes </a>
                    </li>

                    <li id="tab-link-compatibility-problems" class="">
                        <a href="#tab-panel-compatibility-problems" aria-controls="tab-panel-compatibility-problems">
                            Troubleshooting </a>
                    </li>

                    <li id="tab-link-plugins-themes-auto-updates" class="">
                        <a href="#tab-panel-plugins-themes-auto-updates"
                           aria-controls="tab-panel-plugins-themes-auto-updates">
                            Auto-updates </a>
                    </li>
                </ul>
            </div>

            <div class="contextual-help-sidebar">
                <p><strong>For more information:</strong></p>
                <p><a href="https://wordpress.org/support/article/managing-plugins/">Documentation on Managing
                        Plugins</a></p>
                <p><a href="https://wordpress.org/support/article/plugins-themes-auto-updates/">Learn more: Auto-updates
                        documentation</a></p>
                <p><a href="https://wordpress.org/support/">Support</a></p></div>

            <div class="contextual-help-tabs-wrap">

                <div id="tab-panel-overview" class="help-tab-content active" style="">
                    <p>Plugins extend and expand the functionality of WordPress. Once a plugin is installed, you may
                        activate it or deactivate it here.</p>
                    <p>The search for installed plugins will search for terms in their name, description, or author.
                        <span id="live-search-desc" class="hide-if-no-js">The search results will be updated as you type.</span>
                    </p>
                    <p>If you would like to see more plugins to choose from, click on the “Add New” button and you will
                        be able to browse or search for additional plugins from the <a
                                href="https://wordpress.org/plugins/">WordPress Plugin Directory</a>. Plugins in the
                        WordPress Plugin Directory are designed and developed by third parties, and are compatible with
                        the license WordPress uses. Oh, and they’re free!</p></div>

                <div id="tab-panel-shortcodes-overview" class="help-tab-content active" style="">
                    <p>Available Shortcodes :</p>

                    <table>
                        <thead>
                            <tr>
                                <td>Shortcodes</td>
                                <td>Description</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="cursor:pointer;"><code>[sbnepal-ms-login title="Login" register="/register"]</code></td>
                                <td>Login Form</td>
                            </tr>
                            <tr>
                                <td style="cursor:pointer;"><code>[sbnepal-ms-register title="Register" register="/login"]</code></td>
                                <td>Register Form</td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <div id="tab-panel-compatibility-problems" class="help-tab-content" style="display: none;">
                    <p>Most of the time, plugins play nicely with the core of WordPress and with other plugins.
                        Sometimes, though, a plugin’s code will get in the way of another plugin, causing compatibility
                        issues. If your site starts doing strange things, this may be the problem. Try deactivating all
                        your plugins and re-activating them in various combinations until you isolate which one(s)
                        caused the issue.</p>
                    <p>If something goes wrong with a plugin and you can’t use WordPress, delete or rename that file in
                        the <code>/var/www/html/@client/sbnepal/wp-content/plugins</code> directory and it will be
                        automatically deactivated.</p></div>

                <div id="tab-panel-plugins-themes-auto-updates" class="help-tab-content" style="display: none;">
                    <p>Auto-updates can be enabled or disabled for each individual plugin. Plugins with auto-updates
                        enabled will display the estimated date of the next auto-update. Auto-updates depends on the
                        WP-Cron task scheduling system.</p>
                    <p>Auto-updates are only available for plugins recognized by WordPress.org, or that include a
                        compatible update system.</p>
                    <p>Please note: Third-party themes and plugins, or custom code, may override WordPress
                        scheduling.</p></div>
            </div>
        </div>
    </div>
</div>

<div id="screen-meta-links" style="margin: 0;">
    <div id="contextual-help-link-wrap" class="hide-if-no-js screen-meta-toggle">
        <button type="button" id="contextual-help-link" class="button show-settings"
                aria-controls="contextual-help-wrap-2" aria-expanded="false">Help
        </button>
    </div>
</div>

<div class="wrap">
    <h2><?php _e('Dashboard', 'sbnepal-ms'); ?></h2>

    <p>If you have posts or comments in another system, WordPress can import those into this site. To get started,
        choose a system to import from below:</p>

    <div class="card">
        <h2 class="title">SBNepal Management System</h2>
        <p>
            If you want to convert your categories to tags (or vice versa), use the <a href="import.php">Categories and
                Tags Converter</a> available from the Import screen. </p>
    </div>

    <div class="dashboard-widgets-wrap">
        <div class="metabox-holder">
            <div class="postbox-container">
                <div id="dashboard_activity" class="postbox ">
                    <div class="postbox-header"><h2 class="hndle ui-sortable-handle">Activity</h2>
                        <div class="handle-actions hide-if-no-js">
                            <button type="button" class="handle-order-higher" aria-disabled="false"
                                    aria-describedby="dashboard_activity-handle-order-higher-description"><span
                                        class="screen-reader-text">Move up</span><span class="order-higher-indicator"
                                                                                       aria-hidden="true"></span>
                            </button>
                            <span class="hidden" id="dashboard_activity-handle-order-higher-description">Move Activity box up</span>
                            <button type="button" class="handle-order-lower" aria-disabled="false"
                                    aria-describedby="dashboard_activity-handle-order-lower-description"><span
                                        class="screen-reader-text">Move down</span><span class="order-lower-indicator"
                                                                                         aria-hidden="true"></span>
                            </button>
                            <span class="hidden" id="dashboard_activity-handle-order-lower-description">Move Activity box down</span>
                            <button type="button" class="handlediv" aria-expanded="true"><span
                                        class="screen-reader-text">Toggle panel: Activity</span><span
                                        class="toggle-indicator" aria-hidden="true"></span></button>
                        </div>
                    </div>
                    <div class="inside">
                        <div id="activity-widget">
                            <div id="published-posts" class="activity-block"><h3>Recently Published</h3>
                                <ul>
                                    <li><span>Today, 5:28 am</span> <a
                                                href="http://sbnepal.web/wp-admin/post.php?post=1&amp;action=edit"
                                                aria-label="Edit “Hello world!”">Hello world!</a></li>
                                </ul>
                            </div>
                            <div id="latest-comments" class="activity-block table-view-list"><h3>Recent Comments</h3>
                                <ul id="the-comment-list" data-wp-lists="list:comment">
                                    <li id="comment-1" class="comment even thread-even depth-1 comment-item approved">

                                        <img alt=""
                                             src="http://1.gravatar.com/avatar/d7a973c7dab26985da5f961be7b74480?s=50&amp;d=mm&amp;r=g"
                                             srcset="http://1.gravatar.com/avatar/d7a973c7dab26985da5f961be7b74480?s=100&amp;d=mm&amp;r=g 2x"
                                             class="avatar avatar-50 photo hoverZoomLink" height="50" width="50"
                                             loading="lazy">

                                        <div class="dashboard-comment-wrap has-row-actions  has-avatar">
                                            <p class="comment-meta">
                                                From <cite class="comment-author"><a href="https://wordpress.org/"
                                                                                     rel="external nofollow ugc"
                                                                                     class="url">A WordPress
                                                        Commenter</a></cite> on <a
                                                        href="http://sbnepal.web/2022/04/07/hello-world/">Hello
                                                    world!</a> <span class="approve">[Pending]</span></p>

                                            <blockquote><p>Hi, this is a comment. To get started with moderating,
                                                    editing, and deleting comments, please visit the Comments screen
                                                    in…</p></blockquote>
                                            <p class="row-actions"><span class="approve"><a
                                                            href="comment.php?action=approvecomment&amp;p=1&amp;c=1&amp;_wpnonce=162b15fe45"
                                                            data-wp-lists="dim:the-comment-list:comment-1:unapproved:e7e7d3:e7e7d3:new=approved"
                                                            class="vim-a aria-button-if-js"
                                                            aria-label="Approve this comment" role="button">Approve</a></span><span
                                                        class="unapprove"><a
                                                            href="comment.php?action=unapprovecomment&amp;p=1&amp;c=1&amp;_wpnonce=162b15fe45"
                                                            data-wp-lists="dim:the-comment-list:comment-1:unapproved:e7e7d3:e7e7d3:new=unapproved"
                                                            class="vim-u aria-button-if-js"
                                                            aria-label="Unapprove this comment"
                                                            role="button">Unapprove</a></span><span
                                                        class="reply hide-if-no-js"> | <button type="button"
                                                                                               onclick="window.commentReply &amp;&amp; commentReply.open('1','1');"
                                                                                               class="vim-r button-link hide-if-no-js"
                                                                                               aria-label="Reply to this comment">Reply</button></span><span
                                                        class="edit"> | <a href="comment.php?action=editcomment&amp;c=1"
                                                                           aria-label="Edit this comment">Edit</a></span><span
                                                        class="spam"> | <a
                                                            href="comment.php?action=spamcomment&amp;p=1&amp;c=1&amp;_wpnonce=6e1b21f884"
                                                            data-wp-lists="delete:the-comment-list:comment-1::spam=1"
                                                            class="vim-s vim-destructive aria-button-if-js"
                                                            aria-label="Mark this comment as spam"
                                                            role="button">Spam</a></span><span class="trash"> | <a
                                                            href="comment.php?action=trashcomment&amp;p=1&amp;c=1&amp;_wpnonce=6e1b21f884"
                                                            data-wp-lists="delete:the-comment-list:comment-1::trash=1"
                                                            class="delete vim-d vim-destructive aria-button-if-js"
                                                            aria-label="Move this comment to the Trash" role="button">Trash</a></span><span
                                                        class="view"> | <a class="comment-link"
                                                                           href="http://sbnepal.web/2022/04/07/hello-world/#comment-1"
                                                                           aria-label="View this comment">View</a></span>
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                                <h3 class="screen-reader-text">View more comments</h3>
                                <ul class="subsubsub">
                                    <li class="all"><a
                                                href="http://sbnepal.web/wp-admin/edit-comments.php?comment_status=all">All
                                            <span class="count">(<span class="all-count">1</span>)</span></a> |
                                    </li>
                                    <li class="mine"><a
                                                href="http://sbnepal.web/wp-admin/edit-comments.php?comment_status=mine&amp;user_id=1">Mine
                                            <span class="count">(<span class="mine-count">0</span>)</span></a> |
                                    </li>
                                    <li class="moderated"><a
                                                href="http://sbnepal.web/wp-admin/edit-comments.php?comment_status=moderated">Pending
                                            <span class="count">(<span class="pending-count">0</span>)</span></a> |
                                    </li>
                                    <li class="approved"><a
                                                href="http://sbnepal.web/wp-admin/edit-comments.php?comment_status=approved">Approved
                                            <span class="count">(<span class="approved-count">1</span>)</span></a> |
                                    </li>
                                    <li class="spam"><a
                                                href="http://sbnepal.web/wp-admin/edit-comments.php?comment_status=spam">Spam
                                            <span class="count">(<span class="spam-count">0</span>)</span></a> |
                                    </li>
                                    <li class="trash"><a
                                                href="http://sbnepal.web/wp-admin/edit-comments.php?comment_status=trash">Trash
                                            <span class="count">(<span class="trash-count">0</span>)</span></a></li>
                                </ul>
                                <form method="get">
                                    <div id="com-reply" style="display:none;">
                                        <div id="replyrow" style="display:none;">
                                            <fieldset class="comment-reply">
                                                <legend>
                                                    <span class="hidden" id="editlegend">Edit Comment</span>
                                                    <span class="hidden" id="replyhead">Reply to Comment</span>
                                                    <span class="hidden" id="addhead">Add new Comment</span>
                                                </legend>

                                                <div id="replycontainer">
                                                    <label for="replycontent" class="screen-reader-text">Comment</label>
                                                    <div id="wp-replycontent-wrap"
                                                         class="wp-core-ui wp-editor-wrap html-active">
                                                        <link rel="stylesheet" id="editor-buttons-css"
                                                              href="http://sbnepal.web/wp-includes/css/editor.min.css?ver=5.9.3"
                                                              media="all">
                                                        <div id="wp-replycontent-editor-container"
                                                             class="wp-editor-container">
                                                            <div id="qt_replycontent_toolbar"
                                                                 class="quicktags-toolbar hide-if-no-js"><input
                                                                        type="button" id="qt_replycontent_strong"
                                                                        class="ed_button button button-small"
                                                                        aria-label="Bold" value="b"><input type="button"
                                                                                                           id="qt_replycontent_em"
                                                                                                           class="ed_button button button-small"
                                                                                                           aria-label="Italic"
                                                                                                           value="i"><input
                                                                        type="button" id="qt_replycontent_link"
                                                                        class="ed_button button button-small"
                                                                        aria-label="Insert link" value="link"><input
                                                                        type="button" id="qt_replycontent_block"
                                                                        class="ed_button button button-small"
                                                                        aria-label="Blockquote" value="b-quote"><input
                                                                        type="button" id="qt_replycontent_del"
                                                                        class="ed_button button button-small"
                                                                        aria-label="Deleted text (strikethrough)"
                                                                        value="del"><input type="button"
                                                                                           id="qt_replycontent_ins"
                                                                                           class="ed_button button button-small"
                                                                                           aria-label="Inserted text"
                                                                                           value="ins"><input
                                                                        type="button" id="qt_replycontent_img"
                                                                        class="ed_button button button-small"
                                                                        aria-label="Insert image" value="img"><input
                                                                        type="button" id="qt_replycontent_ul"
                                                                        class="ed_button button button-small"
                                                                        aria-label="Bulleted list" value="ul"><input
                                                                        type="button" id="qt_replycontent_ol"
                                                                        class="ed_button button button-small"
                                                                        aria-label="Numbered list" value="ol"><input
                                                                        type="button" id="qt_replycontent_li"
                                                                        class="ed_button button button-small"
                                                                        aria-label="List item" value="li"><input
                                                                        type="button" id="qt_replycontent_code"
                                                                        class="ed_button button button-small"
                                                                        aria-label="Code" value="code"><input
                                                                        type="button" id="qt_replycontent_close"
                                                                        class="ed_button button button-small"
                                                                        title="Close all open tags" value="close tags">
                                                            </div>
                                                            <textarea class="wp-editor-area" rows="20" cols="40"
                                                                      name="replycontent" id="replycontent"></textarea>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div id="edithead" style="display:none;">
                                                    <div class="inside">
                                                        <label for="author-name">Name</label>
                                                        <input type="text" name="newcomment_author" size="50" value=""
                                                               id="author-name">
                                                    </div>

                                                    <div class="inside">
                                                        <label for="author-email">Email</label>
                                                        <input type="text" name="newcomment_author_email" size="50"
                                                               value="" id="author-email">
                                                    </div>

                                                    <div class="inside">
                                                        <label for="author-url">URL</label>
                                                        <input type="text" id="author-url" name="newcomment_author_url"
                                                               class="code" size="103" value="">
                                                    </div>
                                                </div>

                                                <div id="replysubmit" class="submit">
                                                    <p class="reply-submit-buttons">
                                                        <button type="button" class="save button button-primary">
                                                            <span id="addbtn" style="display: none;">Add Comment</span>
                                                            <span id="savebtn"
                                                                  style="display: none;">Update Comment</span>
                                                            <span id="replybtn"
                                                                  style="display: none;">Submit Reply</span>
                                                        </button>
                                                        <button type="button" class="cancel button">Cancel</button>
                                                        <span class="waiting spinner"></span>
                                                    </p>
                                                    <div class="notice notice-error notice-alt inline hidden">
                                                        <p class="error"></p>
                                                    </div>
                                                </div>

                                                <input type="hidden" name="action" id="action" value="">
                                                <input type="hidden" name="comment_ID" id="comment_ID" value="">
                                                <input type="hidden" name="comment_post_ID" id="comment_post_ID"
                                                       value="">
                                                <input type="hidden" name="status" id="status" value="">
                                                <input type="hidden" name="position" id="position" value="-1">
                                                <input type="hidden" name="checkbox" id="checkbox" value="0">
                                                <input type="hidden" name="mode" id="mode" value="dashboard">
                                                <input type="hidden" id="_ajax_nonce-replyto-comment"
                                                       name="_ajax_nonce-replyto-comment" value="8c035b7259"><input
                                                        type="hidden" id="_wp_unfiltered_html_comment"
                                                        name="_wp_unfiltered_html_comment" value="500d767b60">
                                            </fieldset>
                                        </div>
                                    </div>
                                </form>
                                <div class="hidden" id="trash-undo-holder">
                                    <div class="trash-undo-inside">
                                        Comment by <strong></strong> moved to the Trash. <span class="undo untrash"><a
                                                    href="#">Undo</a></span>
                                    </div>
                                </div>
                                <div class="hidden" id="spam-undo-holder">
                                    <div class="spam-undo-inside">
                                        Comment by <strong></strong> marked as spam. <span class="undo unspam"><a
                                                    href="#">Undo</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <form method="post">
        <input type="hidden" name="page" value="ttest_list_table">
    </form>
</div>