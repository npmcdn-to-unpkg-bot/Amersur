<div class="social-icons">
    <ul>
        @if($comSocial->facebook <> "")
        <li class="facebook">
            <a href="{{ $comSocial->facebook }}" target="_blank">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                </span>
            </a>
        </li>
        @endif

        @if($comSocial->instagram <> "")
        <li class="instagram">
            <a href="{{ $comSocial->instagram }}" target="_blank">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
                </span>
            </a>
        </li>
        @endif

        @if($comSocial->google <> "")
        <li class="google">
            <a href="{{ $comSocial->google }}" target="_blank">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
                </span>
            </a>
        </li>
        @endif

        @if($comSocial->pinterest <> "")
        <li class="pinterest">
            <a href="{{ $comSocial->pinterest }}" target="_blank">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-pinterest-p fa-stack-1x fa-inverse"></i>
                </span>
            </a>
        </li>
        @endif

        @if($comSocial->tumblr <> "")
        <li class="tumblr">
            <a href="{{ $comSocial->tumblr }}" target="_blank">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-tumblr fa-stack-1x fa-inverse"></i>
                </span>
            </a>
        </li>
        @endif

        @if($comSocial->twitter <> "")
        <li class="twitter">
            <a href="{{ $comSocial->twitter }}" target="_blank">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                </span>
            </a>
        </li>
        @endif

        @if($comSocial->youtube <> "")
        <li class="youtube">
            <a href="{{ $comSocial->youtube }}" target="_blank">
                <span class="fa-stack fa-lg">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-youtube-play fa-stack-1x fa-inverse"></i>
                </span>
            </a>
        </li>
        @endif
    </ul>
</div>