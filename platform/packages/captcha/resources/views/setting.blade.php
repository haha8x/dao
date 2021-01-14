<div class="flexbox-annotated-section">
    <div class="flexbox-annotated-section-annotation">
        <div class="annotated-section-title pd-all-20">
            <h2>Nội dung thông báo đầu trang</h2>
        </div>
    </div>

    <div class="flexbox-annotated-section-content">
        <div class="wrapper-content pd-all-20">
            <div class="form-group">
                {!! render_editor('header_announcement', setting('header_announcement'), false, ['without-buttons' =>
                true, 'class' => 'form-control']) !!}
            </div>
        </div>
    </div>
</div>

<div class="flexbox-annotated-section">
    <div class="flexbox-annotated-section-annotation">
        <div class="annotated-section-title pd-all-20">
            <h2>Nội dung thông báo cuối trang</h2>
        </div>
    </div>

    <div class="flexbox-annotated-section-content">
        <div class="wrapper-content pd-all-20">
            <div class="form-group">
                {!! render_editor('footer_announcement', setting('footer_announcement'), false, ['without-buttons' =>
                true, 'class' => 'form-control']) !!}
            </div>
        </div>
    </div>
</div>