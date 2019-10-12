@if(!empty(config('services.google-analytics.id')))
<script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.google-analytics.id') }}"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '{{ config('services.google-analytics.id') }}');
</script>
@endif