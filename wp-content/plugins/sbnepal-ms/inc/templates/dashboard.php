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
                </ul>
            </div>

            <div class="contextual-help-sidebar">
                <p><strong>For more information:</strong></p>
                <p>
                    <a href="https://raisachin.com.np/plugins/sbnepal-ms">
                        Documentation on Managing Plugins
                    </a>
                </p>

                <p><a href="https://raisachin.com.np">Support</a></p>
            </div>

            <div class="contextual-help-tabs-wrap">

                <div id="tab-panel-overview" class="help-tab-content active" style="">
                    <p>
                        Plugin specially created for Smart Business in Nepal.
                    </p>
                </div>

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
                                    <small><code>[sbnepal-ms-login title="Login" dashboard="/dashboard" register="/register"]</code></small>
                                </td>
                                <td>Login Form</td>
                            </tr>
                            <tr>
                                <td style="cursor:pointer;">
                                    <small><code>[sbnepal-ms-register title="Register" dashboard="/dashboard" login="/login"]</code></small>
                                </td>
                                <td>Register Form</td>
                            </tr>
                            <tr>
                                <td style="cursor:pointer;">
                                    <small><code>[sbnepal-ms-guest title="SBNepal" dashboard="/dashboard" login="/login" register="/register]</code></small>
                                </td>
                                <td>Guest Form</td>
                            </tr>

                            <tr>
                                <td style="cursor:pointer;">
                                    <small><code>[sbnepal-ms-dashboard title="SBNepal" login="/login" register="/register"]</code></small>
                                </td>
                                <td>Dashboard Form</td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <div id="tab-panel-compatibility-problems" class="help-tab-content" style="display: none;">
                    <p>Under Construction</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="screen-meta-links">
    <div id="contextual-help-link-wrap" class="hide-if-no-js screen-meta-toggle">
        <button type="button" id="contextual-help-link" class="button show-settings"
                aria-controls="contextual-help-wrap-2" aria-expanded="false">
            Help
        </button>
    </div>
</div>

<div class="wrap">
    <h2><?php _e('Dashboard', 'sbnepal-ms'); ?></h2>

    <p>You can manage the agents and their commission using this plugin.</p>

    <?php
    $totalCommission = reset(sbnepal_ms_wallet_get_commission_sum(get_current_user_id()))->total_commission;

    $commissionEarned =  ($totalCommission > 0 ? $totalCommission : 0);
    ?>

    <div id="dashboard-widgets-wrap">
        <div id="postbox-container-1" class="postbox-container">
            <div class="card">
                <h2 class="title">Total Commissions Earned</h2>
                <p>NRS. <?php echo number_format($commissionEarned); ?></p>
            </div>
        </div>

<!--        <div id="postbox-container-2" class="postbox-container">-->
<!--            <div class="card">-->
<!--                <h2 class="title">Today</h2>-->
<!---->
<!--                <p>NRS. --><?php //echo number_format(500); ?><!--</p>-->
<!--            </div>-->
<!--        </div>-->
    </div>

<!--    <div class="dashboard-widgets-wrap">-->
<!--        <div class="metabox-holder">-->
<!--            <div class="postbox-container">-->
<!--                <div id="dashboard_activity" class="postbox ">-->
<!--                    <div class="postbox-header"><h2 class="hndle ui-sortable-handle">Activity</h2>-->
<!--                    </div>-->
<!--                    <div class="inside">-->
<!--                        <div id="activity-widget">-->
<!--                            <div id="latest-comments" class="activity-block table-view-list">-->
<!--                                <ul id="the-comment-list" data-wp-lists="list:comment">-->
<!--                                    <li id="comment-1" class="comment even thread-even depth-1 comment-item approved">-->
<!---->
<!--                                        <img alt=""-->
<!--                                             src="http://1.gravatar.com/avatar/d7a973c7dab26985da5f961be7b74480?s=50&amp;d=mm&amp;r=g"-->
<!--                                             srcset="http://1.gravatar.com/avatar/d7a973c7dab26985da5f961be7b74480?s=100&amp;d=mm&amp;r=g 2x"-->
<!--                                             class="avatar avatar-50 photo hoverZoomLink" height="50" width="50"-->
<!--                                             loading="lazy">-->
<!---->
<!--                                        <div class="dashboard-comment-wrap has-row-actions  has-avatar">-->
<!--                                            <p class="comment-meta">-->
<!--                                                From <cite class="comment-author"><a href="https://wordpress.org/"-->
<!--                                                                                     rel="external nofollow ugc"-->
<!--                                                                                     class="url">A WordPress-->
<!--                                                        Commenter</a></cite> on <a-->
<!--                                                        href="http://sbnepal.web/2022/04/07/hello-world/">Hello-->
<!--                                                    world!</a> <span class="approve">[Pending]</span></p>-->
<!---->
<!--                                            <blockquote><p>Hi, this is a comment. To get started with moderating,-->
<!--                                                    editing, and deleting comments, please visit the Comments screen-->
<!--                                                    in…</p></blockquote>-->
<!--                                            <p class="row-actions"><span class="approve"><a-->
<!--                                                            href="comment.php?action=approvecomment&amp;p=1&amp;c=1&amp;_wpnonce=162b15fe45"-->
<!--                                                            data-wp-lists="dim:the-comment-list:comment-1:unapproved:e7e7d3:e7e7d3:new=approved"-->
<!--                                                            class="vim-a aria-button-if-js"-->
<!--                                                            aria-label="Approve this comment" role="button">Approve</a></span><span-->
<!--                                                        class="unapprove"><a-->
<!--                                                            href="comment.php?action=unapprovecomment&amp;p=1&amp;c=1&amp;_wpnonce=162b15fe45"-->
<!--                                                            data-wp-lists="dim:the-comment-list:comment-1:unapproved:e7e7d3:e7e7d3:new=unapproved"-->
<!--                                                            class="vim-u aria-button-if-js"-->
<!--                                                            aria-label="Unapprove this comment"-->
<!--                                                            role="button">Unapprove</a></span><span-->
<!--                                                        class="reply hide-if-no-js"> | <button type="button"-->
<!--                                                                                               onclick="window.commentReply &amp;&amp; commentReply.open('1','1');"-->
<!--                                                                                               class="vim-r button-link hide-if-no-js"-->
<!--                                                                                               aria-label="Reply to this comment">Reply</button></span><span-->
<!--                                                        class="edit"> | <a href="comment.php?action=editcomment&amp;c=1"-->
<!--                                                                           aria-label="Edit this comment">Edit</a></span><span-->
<!--                                                        class="spam"> | <a-->
<!--                                                            href="comment.php?action=spamcomment&amp;p=1&amp;c=1&amp;_wpnonce=6e1b21f884"-->
<!--                                                            data-wp-lists="delete:the-comment-list:comment-1::spam=1"-->
<!--                                                            class="vim-s vim-destructive aria-button-if-js"-->
<!--                                                            aria-label="Mark this comment as spam"-->
<!--                                                            role="button">Spam</a></span><span class="trash"> | <a-->
<!--                                                            href="comment.php?action=trashcomment&amp;p=1&amp;c=1&amp;_wpnonce=6e1b21f884"-->
<!--                                                            data-wp-lists="delete:the-comment-list:comment-1::trash=1"-->
<!--                                                            class="delete vim-d vim-destructive aria-button-if-js"-->
<!--                                                            aria-label="Move this comment to the Trash" role="button">Trash</a></span><span-->
<!--                                                        class="view"> | <a class="comment-link"-->
<!--                                                                           href="http://sbnepal.web/2022/04/07/hello-world/#comment-1"-->
<!--                                                                           aria-label="View this comment">View</a></span>-->
<!--                                            </p>-->
<!--                                        </div>-->
<!--                                    </li>-->
<!--                                </ul>-->
<!--                                <h3 class="screen-reader-text">View more comments</h3>-->
<!--                                <ul class="subsubsub">-->
<!--                                    <li class="all"><a-->
<!--                                                href="http://sbnepal.web/wp-admin/edit-comments.php?comment_status=all">All-->
<!--                                            <span class="count">(<span class="all-count">1</span>)</span></a> |-->
<!--                                    </li>-->
<!--                                    <li class="mine"><a-->
<!--                                                href="http://sbnepal.web/wp-admin/edit-comments.php?comment_status=mine&amp;user_id=1">Mine-->
<!--                                            <span class="count">(<span class="mine-count">0</span>)</span></a>-->
<!--                                    </li>-->
<!--                                </ul>-->
<!---->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->


    <form method="post">
        <input type="hidden" name="page" value="ttest_list_table">
    </form>
</div>