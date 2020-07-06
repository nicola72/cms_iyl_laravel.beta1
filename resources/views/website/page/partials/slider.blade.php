<div class="bannercontainer">
    <div class="fullscreenbanner-container">
        <div class="fullscreenbanner">
            <ul>
                @if($slider->images)
                    @foreach($slider->images as $img)
                        <li data-transition="slidehorizontal" data-slotamount="5" data-masterspeed="700" data-title="Slide 1">
                            <img src="{{ $website_config['slider_dir'].$img->path }}" alt="{{ $seo->alt ?? '' }}" data-bgfit="cover" data-bgposition="top center" data-bgrepeat="no-repeat">
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>