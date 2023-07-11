<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Ad Unit Code</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="modal-body__getcode">
                <div class="getcode__intro">
                    <p>Place this ad code into the block of every page of your website, where you want the banner to be shown.</p>
                    <p>The code can be used only ONCE/PAGE. If you need another code, feel free to create another ad unit.</p>
                </div>
                <div class="getcode__info">
                    <div class="getcode__info--name">
                        <label for="adunitname">Ad Unit name</label>
                        <input type="text" class="form-control" value="{{ $name }}" disabled>
                    </div>
                    <div class="getcode__info--code">
                        <label for="showcode">Code</label>
                        <ul class="nav nav-pills">
                            @foreach($codes as $key => $code)
                                @if($key < 3)
                                <li class="nav-item">
                                    <a class="nav-link" href="#code{{ $key }}">{{ $code['title'] }}</a>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach($codes as $key => $code)
                                @if($key < 3)
                                <div class="tab-item" id="code{{ $key }}">
                                    <div class="text-wrap" style="position: relative">
                                        <textarea style="padding: 10px;padding-right: 50px;" name="" class="form-control" id="text{{ $key }}" cols="30" rows="10">{{ $code['code'] }}</textarea>
                                        <i class="fa-regular fa-paste" onclick="myFunction({{ $key }})" style="position: absolute; left: 2%; top: 10%"></i>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="getcode__end">
                    <p>
                        We STRONGLY recommend you to put the code in the place where the banner will be in maximum visibility & accessibility for site visitors,
                        since the efficiency of the Spot in terms of conversions directly affects eCPM.
                    </p>
                    <p>
                        Keep in mind as well, that the full optimization will be need some time to kich in, so give our algorithms time to do its magic.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    //active tab
    function activeTab(obj)
    {
        $('.getcode__info--code ul li a').removeClass('active');

        $(obj).addClass('active');

        var id = $(obj).attr('href');

        $('.tab-item').hide();

        $(id).show();
    }

    $('.getcode__info--code ul li a').click(function(){
        activeTab(this);
        return false;
    });

    activeTab($('.getcode__info--code ul li:first-child a'));

    function myFunction(id) {
        // Get the text field
        var copyText = document.getElementById("text"+id);

        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);

        // Alert the copied text
        alert("Copied successfull");
    }
</script>
