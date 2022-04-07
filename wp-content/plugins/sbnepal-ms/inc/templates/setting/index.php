<div class="wrap">

    <h2><?php _e( 'Setting', 'sbnepal-ms' ); ?></h2>

    <div class="dashboard-widgets-wrap">
        <div class="metabox-holder">
            <div id="dashboard_activity" class="postbox ">
                <div class="postbox-header">
                    <h2 class="hndle">
                        Manage the Global Setting
                    </h2>
                </div>
                <div class="inside">
                    <form name="post" action="" method="post" style="padding-top: 10px">
                        <div class="input-text-wrap" id="title-wrap">
                            <label for="title" style="display: inline-block;margin-bottom: 4px;">
                                Title
                            </label>
                            <input type="text" name="post_title" id="title" autocomplete="off" style="width: 100%;">
                        </div>

                        <div class="input-text-wrap" id="title-wrap">
                            <label for="toggleRegister" style="display: inline-block;margin-bottom: 4px;">
                                Enable/Disable Registration
                            </label>
                            <select name="toggle_register" id="toggleRegister" style="width: 100%">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>

                        <div class="textarea-wrap" id="description-wrap">
                            <label for="content" style="display: inline-block;margin-bottom: 4px;">Content</label>
                            <textarea style="width: 100%;" name="content" id="content" placeholder="What’s on your mind?" class="mceEditor" rows="3" cols="15" autocomplete="off"></textarea>
                        </div>

                        <p>
                            <input type="submit" name="save" id="save-post" class="button button-primary" value="Update">
                            <br class="clear">
                        </p>

                    </form>
                    <div id="activity-widget">
                        <div id="published-posts" class="activity-block">
                            <span>Last Updated, 5:28 am</span>
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