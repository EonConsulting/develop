<form action="{{ $url }}" name="ltiLaunchForm" id="ltiLaunchForm" method="post" target="basicltiLaunchFrame" encType="application/x-www-form-urlencoded">
    @foreach($inputs as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}"/>
    @endforeach
</form>

<iframe class="lti_frameResize" name="basicltiLaunchFrame" id="basicltiLaunchFrame" src="" scrolling="no" frameborder="0" style="overflow:hidden;height:100%;width:100%" width="100%" height="800px" transparency>
    <p>frames_required</p>
</iframe>

<script>
    window.onload = function(){  document.forms['ltiLaunchForm'].submit()}
</script>