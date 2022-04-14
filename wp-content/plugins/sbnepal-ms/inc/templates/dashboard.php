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
                                <td style="cursor:pointer;">
                                    <small><code>[sbnepal-ms-login title="Login" register="/register"]</code></small>
                                </td>
                                <td>Login Form</td>
                            </tr>
                            <tr>
                                <td style="cursor:pointer;">
                                    <small><code>[sbnepal-ms-register title="Register" register="/login"]</code></small>
                                </td>
                                <td>Register Form</td>
                            </tr>
                            <tr>
                                <td style="cursor:pointer;">
                                    <small><code>[sbnepal-ms-guest title="SBNepal" login="/login" register="/register"]</code></small>
                                </td>
                                <td>Guest Form</td>
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

    <div id="dashboard-widgets-wrap">
        <div id="postbox-container-1" class="postbox-container">
            <div class="card">
                <h2 class="title">Total Commissions Earned</h2>
                <p>NRS. <?php echo number_format(10000); ?></p>
            </div>
        </div>

        <div id="postbox-container-2" class="postbox-container">
            <div class="card">
                <h2 class="title">Today</h2>

                <p>NRS. <?php echo number_format(500); ?></p>
            </div>
        </div>
    </div>

    <div class="dashboard-widgets-wrap">
        <div class="metabox-holder">
            <div class="postbox-container">
                <div id="dashboard_activity" class="postbox ">
                    <div class="postbox-header"><h2 class="hndle ui-sortable-handle">Activity</h2>
                    </div>
                    <div class="inside">
                        <div id="activity-widget">
                            <div id="latest-comments" class="activity-block table-view-list">
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
                                            <span class="count">(<span class="mine-count">0</span>)</span></a>
                                    </li>
                                </ul>

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