<div class="modal fade modal-report" id="pop-report" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i>
                </button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-warning"></i> Report</h4>
            </div>
            <div class="modal-body">
                <form id="report-form" method="POST" action="ajax/movie_report">
                    <p>Please help us to describe the issue so we can fix it asap.</p>
                    <input type="hidden" name="movie_id" value="14452">
                    <div class="form-group report-list">
                        <div class="rl-block">
                            <div class="block rl-title"><strong>Movie</strong>
                            </div>
                            <label for="radios-1" class="fg-radio">
                                <input type="checkbox" value="movie_broken" name="issue[]" class="needsclick"> Broken
                            </label>
                            <label for="radios-2" class="fg-radio">
                                <input type="checkbox" value="movie_wrong" name="issue[]" class="needsclick">Wrong movie</label>
                            <label for="radios-3" class="fg-radio">
                                <input type="checkbox" value="movie_others" name="issue[]" class="needsclick">Others</label>
                            <div class="clearfix"></div>
                        </div>
                        <div class="rl-block">
                            <div class="block rl-title"><strong>Audio</strong>
                            </div>
                            <label for="radios-5" class="fg-radio">
                                <input type="checkbox" value="audio_not_synced" name="issue[]" class="needsclick">Not Synced</label>
                            <label for="radios-6" class="fg-radio">
                                <input type="checkbox" value="audio_wrong" name="issue[]" class="needsclick">There's no Audio
                            </label>
                            <label for="radios-7" class="fg-radio">
                                <input type="checkbox" value="audio_others" name="issue[]" class="needsclick">Others</label>
                            <div class="clearfix"></div>
                        </div>
                        <div class="rl-block">
                            <div class="block rl-title"><strong>Subtitle</strong>
                            </div>
                            <label for="radios-8" class="fg-radio">
                                <input type="checkbox" value="sub_not_synced" name="issue[]" class="needsclick">Not Synced</label>
                            <label for="radios-9" class="fg-radio">
                                <input type="checkbox" value="sub_wrong" name="issue[]" class="needsclick">Wrong subtitle</label>
                            <label for="radios-10" class="fg-radio">
                                <input type="checkbox" value="sub_missing" name="issue[]" class="needsclick">Missing subtitle
                            </label>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="report-textarea mt10">
                        <textarea name="message" class="form-control" placeholder="Describe the issue here (Optional)" maxlength="255" minlength="3"></textarea>
                    </div>
                    <div class="report-btn text-center mt20">
                        <button id="report-submit" type="submit" class="btn btn-success mr5">Send</button>
                        <button data-dismiss="modal" class="btn btn-default">Cancel</button>
                        <div style="display: none;" id="report-loading" class="cssload-center">
                            <div class="cssload"><span></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>