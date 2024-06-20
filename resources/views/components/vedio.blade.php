@props([
  'col' => '' ,
])







<div class="container pt-4">
    <div class="row justify-content-center">
        <div class="col-md-{{ $col ? $col : '8' }}">
            <div class="card">
                <div class="card-header text-center">
                    <h5>تحميل فيديو</h5>
                </div>

                <div class="card-body">
                    <div id="upload-container" class="text-center">
                        <a href="#" type="button" id="browseFile"
                            class="btn btn-primary">ملفات الجهاز</a>
                    </div>
                    <div style="display: none" class="progress mt-3"
                        style="height: 25px">
                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                            role="progressbar" aria-valuenow="10"
                            aria-valuemin="0" aria-valuemax="25"
                            style="width: 75%; height: 100%">75%</div>
                    </div>
                </div>

                <div class="card-footer p-4" style="display: none">
                    <video id="videoPreview" src="" controls
                        style="width: 100%; height: auto"></video>
                </div>

            </div>
            <p>الصيغ المتاحة : mp4 - flv - m3u8 - ts - 3gp - mov - avi - wmv -
                mkv</p>
        </div>
    </div>
</div>
